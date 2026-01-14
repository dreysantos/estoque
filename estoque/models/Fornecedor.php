<?php
require_once __DIR__ . '/../core/Database.php';

class Fornecedor {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function listar() {
        return $this->db->query("SELECT * FROM fornecedores")->fetchAll();
    }

    public function criar($nome, $razao, $cnpj) {
        $stmt = $this->db->prepare("
            INSERT INTO fornecedores (nome_fantasia, razao_social, cnpj)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$nome, $razao, preg_replace('/[^0-9]/', '', $cnpj)]);
    }
}
