<?php
require_once __DIR__ . '/../core/Database.php';

class Solicitacao {
    private $db;
<<<<<<< HEAD
    private $lastError;

    public function __construct() {
        $this->db = Database::connect();
        $this->lastError = null;
    }

    public function getLastError() {
        return $this->lastError;
    }

    public function temSaidasVinculadas($id_solicitacao) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM saidas WHERE id_solicitacao = ?");
        $stmt->execute([$id_solicitacao]);
        return ((int)$stmt->fetchColumn()) > 0;
=======

    public function __construct() {
        $this->db = Database::connect();
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
    }

    public function listar() {
        return $this->db->query(
            "SELECT solicitacoes.id as id, solicitacoes.data_registro as data_registro, setores.nome as setor, concat(funcionarios.nome, ' ', funcionarios.sobrenome) as funcionario, solicitacoes.descricao as descricao, solicitacoes.situacao as situacao FROM solicitacoes INNER JOIN usuarios on solicitacoes.id_usuario = usuarios.id INNER JOIN funcionarios on usuarios.id_funcionario = funcionarios.id INNER JOIN setores on solicitacoes.id_setor = setores.id ORDER BY solicitacoes.id desc"
        )->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT solicitacoes.id as id, solicitacoes.data_registro as data_registro, setores.nome as setor, concat(funcionarios.nome, ' ', funcionarios.sobrenome) as funcionario, solicitacoes.descricao as descricao, solicitacoes.situacao as situacao FROM solicitacoes INNER JOIN usuarios on solicitacoes.id_usuario = usuarios.id INNER JOIN funcionarios on usuarios.id_funcionario = funcionarios.id INNER JOIN setores on solicitacoes.id_setor = setores.id WHERE solicitacoes.id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function criar($id_usuario, $id_setor, $descricao) {
        $stmt = $this->db->prepare("
            INSERT INTO solicitacoes (id_usuario, id_setor, descricao)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$id_usuario, $id_setor, $descricao]);
        return $this->db->lastInsertId();
    }

    public function atualizarStatus($id, $status) {
        $stmt = $this->db->prepare("
            UPDATE solicitacoes SET situacao = ? WHERE id = ?
        ");
        return $stmt->execute([$status, $id]);
    }

    public function atualizarDescricao($id, $descricao) {
        $stmt = $this->db->prepare("UPDATE solicitacoes SET descricao = ? WHERE id = ?");
        return $stmt->execute([$descricao, $id]);
    }
<<<<<<< HEAD

    public function excluir($id) {
        $this->lastError = null;

        // Não permitir exclusão se já existir saída vinculada
        if ($this->temSaidasVinculadas($id)) {
            $this->lastError = 'Não é possível excluir esta solicitação pois existem saídas vinculadas a ela.';
            return false;
        }

        try {
            $this->db->beginTransaction();

            // Remover itens da solicitação primeiro
            $stmtItens = $this->db->prepare('DELETE FROM solicitacao_equipamentos WHERE id_solicitacao = ?');
            $stmtItens->execute([$id]);

            // Remover a solicitação
            $stmtSol = $this->db->prepare('DELETE FROM solicitacoes WHERE id = ?');
            $ok = $stmtSol->execute([$id]);

            $this->db->commit();
            return $ok;
        } catch (PDOException $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            // 23000: FK/constraint
            if ($e->getCode() === '23000') {
                $this->lastError = 'Não é possível excluir esta solicitação pois existem registros vinculados a ela.';
            } else {
                $this->lastError = 'Erro ao excluir solicitação.';
            }
            return false;
        }
    }
=======
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
}
