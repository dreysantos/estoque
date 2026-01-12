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
        public function listarPorSolicitacao($id_solicitacao) {
            $stmt = $this->db->prepare("SELECT se.id as id, se.id_equipamento as id_equipamento, se.quantidade as quantidade, e.nome as nome, e.marca as marca FROM solicitacao_equipamentos se INNER JOIN equipamentos e ON se.id_equipamento = e.id WHERE se.id_solicitacao = ?");
            $stmt->execute([$id_solicitacao]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function deleteBySolicitacao($id_solicitacao) {
            $stmt = $this->db->prepare("DELETE FROM solicitacao_equipamentos WHERE id_solicitacao = ?");
            return $stmt->execute([$id_solicitacao]);
        }

}

