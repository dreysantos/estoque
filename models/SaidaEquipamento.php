<?php
require_once __DIR__ . '/../core/Database.php';

class SaidaEquipamento {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function baixar($id_saida, $id_equipamento, $qtd) {
        $this->db->beginTransaction();

        $stmt = $this->db->prepare("
            INSERT INTO saida_equipamentos
            (id_saida, id_equipamento, quantidade)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$id_saida, $id_equipamento, $qtd]);

        $stmt = $this->db->prepare("
            UPDATE equipamentos
            SET quantidade = quantidade - ?
            WHERE id = ? AND quantidade >= ?
        ");
        $stmt->execute([$qtd, $id_equipamento, $qtd]);

        if ($stmt->rowCount() === 0) {
            $this->db->rollBack();
            throw new Exception("Estoque insuficiente");
        }

        $this->db->commit();
    }
}
