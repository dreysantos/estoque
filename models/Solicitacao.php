<?php
require_once __DIR__ . '/../core/Database.php';

class Solicitacao {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function listar() {
        return $this->db->query("SELECT * FROM view_solicitacoes")->fetchAll();
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
}
