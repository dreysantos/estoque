<?php
require_once __DIR__ . '/../core/Database.php';

class Saida {
    private $db;
    private $lastError;

    public function __construct() {
        $this->db = Database::connect();
        $this->lastError = null;
    }

    public function getLastError() {
        return $this->lastError;
    }

    public function listar() {
        return $this->db->query("SELECT * FROM view_saidas")->fetchAll();
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM saidas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function listarItens($id_saida) {
        $stmt = $this->db->prepare(
            "SELECT se.id_equipamento, se.quantidade, e.nome, e.marca\n" .
            "FROM saida_equipamentos se\n" .
            "INNER JOIN equipamentos e ON e.id = se.id_equipamento\n" .
            "WHERE se.id_saida = ?\n" .
            "ORDER BY se.id"
        );
        $stmt->execute([$id_saida]);
        return $stmt->fetchAll();
    }

    public function criar($id_solicitacao, $id_usuario, $tipo, $descricao) {
        $stmt = $this->db->prepare("
            INSERT INTO saidas (id_solicitacao, id_usuario, tipo, descricao)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$id_solicitacao, $id_usuario, $tipo, $descricao]);
        return $this->db->lastInsertId();
    }

    public function atualizar($id, $id_solicitacao, $id_usuario, $tipo, $descricao) {
        $stmt = $this->db->prepare(
            "UPDATE saidas SET id_solicitacao = ?, id_usuario = ?, tipo = ?, descricao = ? WHERE id = ?"
        );
        return $stmt->execute([$id_solicitacao, $id_usuario, $tipo, $descricao, $id]);
    }

    public function atualizarComItens($id, $id_solicitacao, $id_usuario, $tipo, $descricao, $itens) {
        $this->lastError = null;

        if (!is_array($itens) || count($itens) === 0) {
            $this->lastError = 'Informe ao menos 1 item.';
            return false;
        }

        try {
            $this->db->beginTransaction();

            // Atualiza cabeçalho
            $stmt = $this->db->prepare(
                "UPDATE saidas SET id_solicitacao = ?, id_usuario = ?, tipo = ?, descricao = ? WHERE id = ?"
            );
            $stmt->execute([$id_solicitacao, $id_usuario, $tipo, $descricao, $id]);

            // Busca itens atuais para estornar estoque
            $stmt = $this->db->prepare("SELECT id_equipamento, quantidade FROM saida_equipamentos WHERE id_saida = ?");
            $stmt->execute([$id]);
            $itensAtuais = $stmt->fetchAll();

            foreach ($itensAtuais as $item) {
                $stmtUpd = $this->db->prepare("UPDATE equipamentos SET quantidade = quantidade + ? WHERE id = ?");
                $stmtUpd->execute([intval($item['quantidade']), intval($item['id_equipamento'])]);
            }

            // Remove itens atuais
            $stmtDelItens = $this->db->prepare("DELETE FROM saida_equipamentos WHERE id_saida = ?");
            $stmtDelItens->execute([$id]);

            // Insere itens novos e baixa estoque (com validação)
            $stmtIns = $this->db->prepare(
                "INSERT INTO saida_equipamentos (id_saida, id_equipamento, quantidade) VALUES (?, ?, ?)"
            );
            $stmtBaixa = $this->db->prepare(
                "UPDATE equipamentos SET quantidade = quantidade - ? WHERE id = ? AND quantidade >= ?"
            );

            foreach ($itens as $item) {
                $idEquip = intval($item['id_equipamento'] ?? 0);
                $qtd = intval($item['quantidade'] ?? 0);

                if ($idEquip <= 0 || $qtd <= 0) {
                    continue;
                }

                $stmtIns->execute([$id, $idEquip, $qtd]);
                $stmtBaixa->execute([$qtd, $idEquip, $qtd]);

                if ($stmtBaixa->rowCount() === 0) {
                    throw new Exception('Estoque insuficiente para um dos itens.');
                }
            }

            // Garante que pelo menos 1 item válido foi inserido
            $stmtCount = $this->db->prepare("SELECT COUNT(*) as total FROM saida_equipamentos WHERE id_saida = ?");
            $stmtCount->execute([$id]);
            $total = intval(($stmtCount->fetch()['total'] ?? 0));
            if ($total === 0) {
                throw new Exception('Informe ao menos 1 item válido.');
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) $this->db->rollBack();
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    public function deletar($id) {
        $this->lastError = null;

        try {
            $this->db->beginTransaction();

            // Itens da saída (para estornar estoque)
            $stmt = $this->db->prepare("SELECT id_equipamento, quantidade FROM saida_equipamentos WHERE id_saida = ?");
            $stmt->execute([$id]);
            $itens = $stmt->fetchAll();

            foreach ($itens as $item) {
                $stmtUpd = $this->db->prepare("UPDATE equipamentos SET quantidade = quantidade + ? WHERE id = ?");
                $stmtUpd->execute([intval($item['quantidade']), intval($item['id_equipamento'])]);
            }

            // Remove itens e depois a saída
            $stmtDelItens = $this->db->prepare("DELETE FROM saida_equipamentos WHERE id_saida = ?");
            $stmtDelItens->execute([$id]);

            $stmtDel = $this->db->prepare("DELETE FROM saidas WHERE id = ?");
            $ok = $stmtDel->execute([$id]);

            $this->db->commit();
            return $ok;
        } catch (PDOException $e) {
            if ($this->db->inTransaction()) $this->db->rollBack();
            $this->lastError = 'Não foi possível deletar a saída.';
            return false;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) $this->db->rollBack();
            $this->lastError = $e->getMessage();
            return false;
        }
    }
}
