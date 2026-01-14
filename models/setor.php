<?php
require_once __DIR__ . '/../core/Database.php';

class Setor {
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
        return $stmt = $this->db->query("SELECT * FROM setores")->fetchAll();
    }

    public function criar($nome, $descricao, $telefone) {
        $stmt = $this->db->prepare(
            "INSERT INTO setores (nome, descricao, telefone) VALUES (?, ?, ?)"
        );
        return $stmt->execute([$nome, $descricao, preg_replace('/[^0-9]/', '', $telefone)]);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM setores WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function atualizar($id, $nome, $descricao, $telefone) {
        $stmt = $this->db->prepare(
            "UPDATE setores SET nome = ?, descricao = ?, telefone = ? WHERE id = ?"
        );
        return $stmt->execute([$nome, $descricao, preg_replace('/[^0-9]/', '', $telefone), $id]);
    }

    public function temFuncionarios($id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM funcionarios WHERE id_setor = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }

    public function temSolicitacoes($id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM solicitacoes WHERE id_setor = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }

    public function deletar($id) {
        $this->lastError = null;
        try {
            $stmt = $this->db->prepare("DELETE FROM setores WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            // 23000/1451: violação de integridade (FK) — registro referenciado em outra tabela
            $this->lastError = 'Não é possível deletar este setor pois existem registros vinculados a ele.';
            return false;
        }
    }
}
