<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Funcionario.php';

class UsuarioController {

    public function index() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        require_once __DIR__ . '/../core/auth.php';
        if (method_exists('Auth','nivelIn')) {
            Auth::nivelIn(['avancado', 'administrador']);
        } else {
            $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
            if (!in_array($nivel, ['avancado','administrador'])) die('Acesso negado');
        }
        $usuario = new Usuario();
        $lista = $usuario->listar();

        require_once __DIR__ . '/../views/usuarios/index.php';
    }

    public function create() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        require_once __DIR__ . '/../core/auth.php';
        if (method_exists('Auth','nivelIn')) {
            Auth::nivelIn(['avancado', 'administrador']);
        } else {
            $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
            if (!in_array($nivel, ['avancado','administrador'])) die('Acesso negado');
        }
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

    // Exibir e processar ativação/desativação do usuário
    public function status() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        require_once __DIR__ . '/../core/auth.php';
        if (method_exists('Auth','nivelIn')) {
            Auth::nivelIn(['avancado', 'administrador']);
        } else {
            $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
            if (!in_array($nivel, ['avancado','administrador'])) die('Acesso negado');
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['flash_error'] = 'Usuário não encontrado.';
            header('Location: index.php?rota=usuarios');
            exit;
        }

        $usuarioModel = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $usuario = $usuarioModel->buscarPorId($id);
            if (!$usuario) {
                $_SESSION['flash_error'] = 'Usuário não encontrado.';
                header('Location: index.php?rota=usuarios');
                exit;
            }
            $deps = $usuarioModel->contarDependencias($id);
            require_once __DIR__ . '/../views/usuarios/usuario_status.php';
            return;
        }

        $novoStatus = isset($_POST['status']) && $_POST['status'] === '1' ? 1 : 0;
        $ok = $usuarioModel->atualizarStatus($id, $novoStatus);

        if ($ok) {
            $_SESSION['flash_success'] = $novoStatus ? 'Usuário ativado com sucesso.' : 'Usuário desativado com sucesso.';
        } else {
            $_SESSION['flash_error'] = 'Falha ao atualizar status do usuário.';
        }

        header('Location: index.php?rota=usuarios');
        exit;
    }

    public function edit() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        require_once __DIR__ . '/../core/auth.php';
        if (method_exists('Auth','nivelIn')) {
            Auth::nivelIn(['avancado', 'administrador']);
        } else {
            $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
            if (!in_array($nivel, ['avancado','administrador'])) die('Acesso negado');
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['flash_error'] = 'Usuário não informado.';
            header('Location: index.php?rota=usuarios');
            exit;
        }

        $usuarioModel = new Usuario();
        $funcModel = new Funcionario();
        $funcionarios = $funcModel->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_funcionario = $_POST['id_funcionario'] ?? '';
            $nome = $_POST['nome'] ?? '';
            $nivel = $_POST['nivel'] ?? 'basico';
            $senha = $_POST['senha'] ?? null; // opcional

            $ok = $usuarioModel->atualizar($id, $id_funcionario, $nome, $nivel, $senha);
            if ($ok) {
                $_SESSION['flash_success'] = 'Usuário atualizado com sucesso.';
            } else {
                $_SESSION['flash_error'] = 'Falha ao atualizar usuário.';
            }
            header('Location: index.php?rota=usuarios');
            exit;
        }

        $usuario = $usuarioModel->buscarPorId($id);
        if (!$usuario) {
            $_SESSION['flash_error'] = 'Usuário não encontrado.';
            header('Location: index.php?rota=usuarios');
            exit;
        }

        require_once __DIR__ . '/../views/usuarios/edit.php';
    }
}
