<?php
require_once __DIR__ . '/../core/Database.php';

class SolicitacaoEquipamento {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function adicionar($id_solicitacao, $id_equipamento, $qtd) {
        $stmt = $this->db->prepare("
            INSERT INTO solicitacao_equipamentos
            (id_solicitacao, id_equipamento, quantidade)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$id_solicitacao, $id_equipamento, $qtd]);
    }
}
