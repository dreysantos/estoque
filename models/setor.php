<?php
require_once __DIR__ . '/../core/Database.php';

class Setor {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
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
}
