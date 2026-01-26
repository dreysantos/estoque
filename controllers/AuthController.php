<?php
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {

    public function loginForm() {
        require __DIR__ . '/../views/auth/login.php';
    }

    public function login() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $nome  = $_POST['nome'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->buscarPorNome($nome);

        if ($usuario && empty($usuario['ativo'])) {
            $_SESSION['erro'] = 'Usuário desativado. Contate a administração.';
            header('Location: index.php?rota=login');
            exit;
        }

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario;
            header('Location: index.php?rota=home');
            exit;
        }

        $_SESSION['erro'] = 'Usuário ou senha inválidos';
        header('Location: index.php?rota=login');
        exit;
    }

    public function logout() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php?rota=login');
        exit;
    }
}
