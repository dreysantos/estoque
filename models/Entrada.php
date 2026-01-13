<?php
require_once __DIR__ . '/../core/Database.php';

class Entrada {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function listar() {
        $sql = "
            SELECT
                e.id AS id,
                e.data_registro AS data_registro,
                e.tipo AS tipo,
                e.situacao AS situacao,
                COALESCE(f.nome_fantasia, '—') AS fornecedor,
                CONCAT(fn.nome, ' ', fn.sobrenome) AS funcionario
            FROM entradas e
            LEFT JOIN fornecedores f ON e.id_fornecedor = f.id
            INNER JOIN usuarios u ON e.id_usuario = u.id
            INNER JOIN funcionarios fn ON u.id_funcionario = fn.id
            ORDER BY e.id DESC
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($fornecedor, $usuario, $tipo, $descricao) {
        $stmt = $this->db->prepare("
            INSERT INTO entradas (id_fornecedor, id_usuario, tipo, descricao)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$fornecedor, $usuario, $tipo, $descricao]);
        return $this->db->lastInsertId();
    }

    public function buscarDetalhes($id) {
        $stmt = $this->db->prepare("
            SELECT
                e.id AS id,
                e.data_registro AS data_registro,
                e.tipo AS tipo,
                e.situacao AS situacao,
                e.descricao AS descricao,
                COALESCE(f.nome_fantasia, '—') AS fornecedor,
                CONCAT(fn.nome, ' ', fn.sobrenome) AS funcionario
            FROM entradas e
            LEFT JOIN fornecedores f ON e.id_fornecedor = f.id
            INNER JOIN usuarios u ON e.id_usuario = u.id
            INNER JOIN funcionarios fn ON u.id_funcionario = fn.id
            WHERE e.id = ?
            LIMIT 1
        ");
        $stmt->execute([(int) $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
