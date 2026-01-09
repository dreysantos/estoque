<?php
require_once __DIR__ . '/../core/Database.php';

class EntradaEquipamento {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function adicionar($id_entrada, $id_equipamento, $qtd) {
        $this->db->beginTransaction();

        $stmt = $this->db->prepare("
            INSERT INTO entrada_equipamentos
            (id_entrada, id_equipamento, quantidade)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$id_entrada, $id_equipamento, $qtd]);

        $stmt = $this->db->prepare("
            UPDATE equipamentos
            SET quantidade = quantidade + ?
            WHERE id = ?
        ");
        $stmt->execute([$qtd, $id_equipamento]);

        $this->db->commit();
    }
}
