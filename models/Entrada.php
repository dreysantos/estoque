<?php
require_once __DIR__ . '/../core/Database.php';

class Entrada {
    private $db;
<<<<<<< HEAD
    private $lastError;

    public function __construct() {
        $this->db = Database::connect();
        $this->lastError = null;
    }

    public function getLastError() {
        return $this->lastError;
=======

    public function __construct() {
        $this->db = Database::connect();
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
    }

    public function listar() {
        $sql = "
            SELECT
                e.id AS id,
                e.data_registro AS data_registro,
                e.tipo AS tipo,
                e.situacao AS situacao,
                COALESCE(f.nome_fantasia, '—') AS fornecedor,
                CONCAT(fn.nome, ' ', fn.sobrenome) AS funcionario
            FROM entradas e
            LEFT JOIN fornecedores f ON e.id_fornecedor = f.id
            INNER JOIN usuarios u ON e.id_usuario = u.id
            INNER JOIN funcionarios fn ON u.id_funcionario = fn.id
            ORDER BY e.id DESC
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($fornecedor, $usuario, $tipo, $descricao) {
        $stmt = $this->db->prepare("
            INSERT INTO entradas (id_fornecedor, id_usuario, tipo, descricao)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$fornecedor, $usuario, $tipo, $descricao]);
        return $this->db->lastInsertId();
    }

    public function buscarDetalhes($id) {
        $stmt = $this->db->prepare("
            SELECT
                e.id AS id,
                e.data_registro AS data_registro,
                e.tipo AS tipo,
                e.situacao AS situacao,
                e.descricao AS descricao,
                COALESCE(f.nome_fantasia, '—') AS fornecedor,
                CONCAT(fn.nome, ' ', fn.sobrenome) AS funcionario
            FROM entradas e
            LEFT JOIN fornecedores f ON e.id_fornecedor = f.id
            INNER JOIN usuarios u ON e.id_usuario = u.id
            INNER JOIN funcionarios fn ON u.id_funcionario = fn.id
            WHERE e.id = ?
            LIMIT 1
        ");
        $stmt->execute([(int) $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
<<<<<<< HEAD

    public function buscarPorId($id) {
        $stmt = $this->db->prepare('SELECT * FROM entradas WHERE id = ?');
        $stmt->execute([(int)$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $id_fornecedor, $tipo, $situacao, $descricao) {
        $this->lastError = null;

        $tipos = ['compra','doacao','transferencia','devolucao','ajuste'];
        $situacoes = ['ativa','cancelada'];
        if (!in_array($tipo, $tipos, true)) {
            $this->lastError = 'Tipo inválido.';
            return false;
        }
        if (!in_array($situacao, $situacoes, true)) {
            $this->lastError = 'Situação inválida.';
            return false;
        }

        $stmt = $this->db->prepare('UPDATE entradas SET id_fornecedor = ?, tipo = ?, situacao = ?, descricao = ? WHERE id = ?');
        return $stmt->execute([
            $id_fornecedor,
            $tipo,
            $situacao,
            $descricao,
            (int)$id,
        ]);
    }

    public function deletar($id) {
        $this->lastError = null;

        try {
            $this->db->beginTransaction();

            // Itens da entrada (para estornar estoque)
            $stmtItens = $this->db->prepare('SELECT id_equipamento, quantidade FROM entrada_equipamentos WHERE id_entrada = ?');
            $stmtItens->execute([(int)$id]);
            $itens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);

            // Estornar estoque (subtrai o que foi adicionado)
            $stmtUpd = $this->db->prepare('UPDATE equipamentos SET quantidade = quantidade - ? WHERE id = ? AND quantidade >= ?');
            foreach ($itens as $item) {
                $qtd = (int)($item['quantidade'] ?? 0);
                $idEquip = (int)($item['id_equipamento'] ?? 0);
                if ($qtd <= 0 || $idEquip <= 0) continue;
                $stmtUpd->execute([$qtd, $idEquip, $qtd]);
                if ($stmtUpd->rowCount() === 0) {
                    throw new Exception('Não é possível deletar: estoque insuficiente para estornar um dos itens.');
                }
            }

            // Remove itens e depois a entrada
            $stmtDelItens = $this->db->prepare('DELETE FROM entrada_equipamentos WHERE id_entrada = ?');
            $stmtDelItens->execute([(int)$id]);

            $stmtDel = $this->db->prepare('DELETE FROM entradas WHERE id = ?');
            $ok = $stmtDel->execute([(int)$id]);

            $this->db->commit();
            return $ok;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            $this->lastError = $e->getMessage();
            return false;
        }
    }
=======
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
}
