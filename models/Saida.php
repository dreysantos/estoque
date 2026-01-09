<?php
require_once __DIR__ . '/../core/Database.php';

class Saida {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function listar() {
        return $this->db->query("SELECT * FROM view_saidas")->fetchAll();
    }

    public function criar($id_solicitacao, $id_usuario, $tipo, $descricao) {
        $stmt = $this->db->prepare("
            INSERT INTO saidas (id_solicitacao, id_usuario, tipo, descricao)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$id_solicitacao, $id_usuario, $tipo, $descricao]);
        return $this->db->lastInsertId();
    }
}
