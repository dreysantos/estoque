<?php
require_once __DIR__ . '/../core/Database.php';

class Solicitacao {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function listar() {
        return $this->db->query(
            "SELECT solicitacoes.id as id, solicitacoes.data_registro as data_registro, setores.nome as setor, concat(funcionarios.nome, ' ', funcionarios.sobrenome) as funcionario, solicitacoes.descricao as descricao, solicitacoes.situacao as situacao FROM solicitacoes INNER JOIN usuarios on solicitacoes.id_usuario = usuarios.id INNER JOIN funcionarios on usuarios.id_funcionario = funcionarios.id INNER JOIN setores on solicitacoes.id_setor = setores.id ORDER BY solicitacoes.id desc"
        )->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT solicitacoes.id as id, solicitacoes.data_registro as data_registro, setores.nome as setor, concat(funcionarios.nome, ' ', funcionarios.sobrenome) as funcionario, solicitacoes.descricao as descricao, solicitacoes.situacao as situacao FROM solicitacoes INNER JOIN usuarios on solicitacoes.id_usuario = usuarios.id INNER JOIN funcionarios on usuarios.id_funcionario = funcionarios.id INNER JOIN setores on solicitacoes.id_setor = setores.id WHERE solicitacoes.id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch();
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

    public function atualizarDescricao($id, $descricao) {
        $stmt = $this->db->prepare("UPDATE solicitacoes SET descricao = ? WHERE id = ?");
        return $stmt->execute([$descricao, $id]);
    }
}
