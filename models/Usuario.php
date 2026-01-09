<?php
require_once __DIR__ . '/../core/Database.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function listar() {
        return $this->db
            ->query("SELECT * FROM view_usuarios")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($id_funcionario, $nome, $senha, $nivel) {
        $stmt = $this->db->prepare("
            INSERT INTO usuarios (id_funcionario, nome, senha, nivel_acesso)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $id_funcionario,
            $nome,
            password_hash($senha, PASSWORD_DEFAULT),
            $nivel
        ]);
    }

    // ✅ MÉTODO NECESSÁRIO PARA LOGIN
    public function buscarPorNome($nome) {
        $stmt = $this->db->prepare("
            SELECT * 
            FROM usuarios 
            WHERE nome = ? 
              AND ativo = 1
        ");
        $stmt->execute([$nome]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
