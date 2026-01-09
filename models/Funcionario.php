<?php
require_once __DIR__ . '/../core/Database.php';

class Funcionario {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function listar() {
        return $this->db->query("
            SELECT f.*, s.nome AS setor
            FROM funcionarios f
            INNER JOIN setores s ON f.id_setor = s.id
            ORDER BY f.id DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("
            SELECT f.*, s.nome AS setor
            FROM funcionarios f
            INNER JOIN setores s ON f.id_setor = s.id
            WHERE f.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($id_setor, $nome, $sobrenome, $telefone, $matricula, $cpf) {
        $stmt = $this->db->prepare("
            INSERT INTO funcionarios
            (id_setor, nome, sobrenome, telefone, numero_matricula, cpf)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$id_setor, $nome, $sobrenome, $telefone, $matricula, $cpf]);
    }

    public function atualizar($id, $id_setor, $nome, $sobrenome, $telefone, $matricula, $cpf) {
        $stmt = $this->db->prepare("
            UPDATE funcionarios
            SET id_setor = ?, nome = ?, sobrenome = ?, telefone = ?, numero_matricula = ?, cpf = ?
            WHERE id = ?
        ");
        return $stmt->execute([$id_setor, $nome, $sobrenome, $telefone, $matricula, $cpf, $id]);
    }

    public function deletar($id) {
        $stmt = $this->db->prepare("DELETE FROM funcionarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
