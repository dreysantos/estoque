<?php
require_once __DIR__ . '/../core/Database.php';

class Equipamento {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
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
        $stmt = $this->db->prepare("DELETE FROM equipamentos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
