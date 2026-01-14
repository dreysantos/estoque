<?php
require_once __DIR__ . '/../core/Database.php';

class Equipamento {

    private $db;
<<<<<<< HEAD
    private $lastError;

    public function __construct() {
        $this->db = Database::connect();
        $this->lastError = null;
    }

    public function getLastError() {
        return $this->lastError;
=======

    public function __construct() {
        $this->db = Database::connect();
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
    }

    public function listar() {
        return $this->db->query("SELECT * FROM equipamentos")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($nome, $descricao, $marca, $tipo, $ca, $ca_validade, $quantidade) {
        $stmt = $this->db->prepare("
            INSERT INTO equipamentos 
            (nome, descricao, marca, tipo, ca, ca_validade, quantidade)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $nome,
            $descricao,
            $marca,
            $tipo,
            $ca,
            $ca_validade,
            $quantidade
        ]);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM equipamentos WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $descricao, $marca, $tipo, $ca, $ca_validade, $quantidade) {
        $stmt = $this->db->prepare("UPDATE equipamentos SET nome = ?, descricao = ?, marca = ?, tipo = ?, ca = ?, ca_validade = ?, quantidade = ? WHERE id = ?");
        return $stmt->execute([
            $nome,
            $descricao,
            $marca,
            $tipo,
            $ca,
            $ca_validade,
            $quantidade,
            $id
        ]);
    }

    public function excluir($id) {
<<<<<<< HEAD
        $this->lastError = null;
        try {
            $stmt = $this->db->prepare("DELETE FROM equipamentos WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            // 23000/1451: violação de integridade (FK) — equipamento referenciado em outras tabelas
            $sqlState = $e->getCode();
            if ($sqlState === '23000') {
                $this->lastError = 'Não é possível excluir este equipamento pois existem registros vinculados a ele (entradas/saídas/solicitações).';
            } else {
                $this->lastError = 'Erro ao excluir equipamento.';
            }
            return false;
        }
=======
        $stmt = $this->db->prepare("DELETE FROM equipamentos WHERE id = ?");
        return $stmt->execute([$id]);
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
    }
}
