<?php
require_once __DIR__ . '/../core/Database.php';

class Fornecedor {
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
        return $this->db->query("SELECT * FROM fornecedores")->fetchAll();
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM fornecedores WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function criar($nome, $razao, $cnpj) {
        $stmt = $this->db->prepare("
            INSERT INTO fornecedores (nome_fantasia, razao_social, cnpj)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$nome, $razao, preg_replace('/[^0-9]/', '', $cnpj)]);
    }

    public function atualizar($id, $nome, $razao, $cnpj) {
        $stmt = $this->db->prepare(
            "UPDATE fornecedores SET nome_fantasia = ?, razao_social = ?, cnpj = ? WHERE id = ?"
        );
        return $stmt->execute([$nome, $razao, preg_replace('/[^0-9]/', '', $cnpj), $id]);
    }

    public function temEntradas($id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM entradas WHERE id_fornecedor = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return ($result['total'] ?? 0) > 0;
    }

    public function deletar($id) {
        $this->lastError = null;
        try {
            $stmt = $this->db->prepare("DELETE FROM fornecedores WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            $this->lastError = 'Não é possível deletar este fornecedor pois existem entradas vinculadas a ele.';
            return false;
        }
    }
}
