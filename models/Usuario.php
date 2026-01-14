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
<<<<<<< HEAD
            WHERE nome = ?
=======
            WHERE nome = ? 
              AND ativo = 1
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
        ");
        $stmt->execute([$nome]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Excluir usuário(s) por id_funcionario
    public function deletarPorFuncionarioId($id_funcionario) {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id_funcionario = ?");
        return $stmt->execute([$id_funcionario]);
    }

    // Buscar usuário por ID
    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar status ativo (1/0)
    public function atualizarStatus($id, $ativo) {
        $stmt = $this->db->prepare("UPDATE usuarios SET ativo = ? WHERE id = ?");
        return $stmt->execute([$ativo ? 1 : 0, $id]);
    }

    // Listar IDs de usuários pelo id_funcionario
    public function listarIdsPorFuncionario($id_funcionario) {
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE id_funcionario = ?");
        $stmt->execute([$id_funcionario]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Verifica se o usuário possui registros vinculados em outras tabelas
    public function temDependencias($idUsuario) {
        // solicitacoes
        $q1 = $this->db->prepare("SELECT 1 FROM solicitacoes WHERE id_usuario = ? LIMIT 1");
        $q1->execute([$idUsuario]);
        if ($q1->fetch(PDO::FETCH_ASSOC)) return true;

        // entradas
        $q2 = $this->db->prepare("SELECT 1 FROM entradas WHERE id_usuario = ? LIMIT 1");
        $q2->execute([$idUsuario]);
        if ($q2->fetch(PDO::FETCH_ASSOC)) return true;

        // saidas
        $q3 = $this->db->prepare("SELECT 1 FROM saidas WHERE id_usuario = ? LIMIT 1");
        $q3->execute([$idUsuario]);
        if ($q3->fetch(PDO::FETCH_ASSOC)) return true;

        return false;
    }

    // Contagens de dependências (solicitações, entradas, saídas)
    public function contarDependencias($idUsuario) {
        $counts = [
            'solicitacoes' => 0,
            'entradas' => 0,
            'saidas' => 0,
        ];

        $q = $this->db->prepare("SELECT COUNT(*) FROM solicitacoes WHERE id_usuario = ?");
        $q->execute([$idUsuario]);
        $counts['solicitacoes'] = (int) $q->fetchColumn();

        $q = $this->db->prepare("SELECT COUNT(*) FROM entradas WHERE id_usuario = ?");
        $q->execute([$idUsuario]);
        $counts['entradas'] = (int) $q->fetchColumn();

        $q = $this->db->prepare("SELECT COUNT(*) FROM saidas WHERE id_usuario = ?");
        $q->execute([$idUsuario]);
        $counts['saidas'] = (int) $q->fetchColumn();

        return $counts;
    }

    // Atualizar dados do usuário; se $senha for null, mantém a atual
    public function atualizar($id, $id_funcionario, $nome, $nivel, $senha = null) {
        if ($senha !== null && $senha !== '') {
            $stmt = $this->db->prepare("
                UPDATE usuarios
                   SET id_funcionario = ?, nome = ?, nivel_acesso = ?, senha = ?
                 WHERE id = ?
            ");
            return $stmt->execute([
                $id_funcionario,
                $nome,
                $nivel,
                password_hash($senha, PASSWORD_DEFAULT),
                $id
            ]);
        } else {
            $stmt = $this->db->prepare("
                UPDATE usuarios
                   SET id_funcionario = ?, nome = ?, nivel_acesso = ?
                 WHERE id = ?
            ");
            return $stmt->execute([
                $id_funcionario,
                $nome,
                $nivel,
                $id
            ]);
        }
    }
}
