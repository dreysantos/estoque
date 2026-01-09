<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Funcionario.php';

class UsuarioController {

    public function index() {
        $usuario = new Usuario();
        $lista = $usuario->listar();

        require_once __DIR__ . '/../views/usuarios/index.php';
    }

    public function create() {
        $func = new Funcionario();
        $funcionarios = $func->listar();

        if ($_POST) {
            $usuario = new Usuario();
            $usuario->criar(
                $_POST['id_funcionario'],
                $_POST['nome'],
                $_POST['senha'],
                $_POST['nivel'] ?? 'basico'
            );
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_success'] = 'Usuário criado com sucesso.';
            header("Location: index.php?rota=usuarios");
            return;
        }

        require_once __DIR__ . '/../views/usuarios/create.php';
    }
}
