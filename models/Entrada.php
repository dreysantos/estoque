<?php
require_once __DIR__ . '/../core/Database.php';

class Entrada {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function listar() {
        return $this->db->query("SELECT * FROM view_entradas")->fetchAll();
    }

    public function criar($fornecedor, $usuario, $tipo, $descricao) {
        $stmt = $this->db->prepare("
            INSERT INTO entradas (id_fornecedor, id_usuario, tipo, descricao)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$fornecedor, $usuario, $tipo, $descricao]);
        return $this->db->lastInsertId();
    }
}
