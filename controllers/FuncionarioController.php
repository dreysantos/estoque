<?php
require_once __DIR__ . '/../models/Funcionario.php';
require_once __DIR__ . '/../models/Setor.php';

class FuncionarioController {

    public function index() {
        $func = new Funcionario();
        $lista = $func->listar();
        require __DIR__ . '/../views/funcionarios/index.php';
    }

    public function create() {
        $setor = new Setor();
        $setores = $setor->listar();

        if ($_POST) {
            $func = new Funcionario();
            $func->criar(
                $_POST['id_setor'],
                $_POST['nome'],
                $_POST['sobrenome'],
                $_POST['telefone'],
                $_POST['matricula'],
                $_POST['cpf']
            );
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_success'] = 'Funcionário criado com sucesso.';
            header("Location: index.php?rota=funcionarios");
        }

        require __DIR__ . '/../views/funcionarios/create.php';
    }

    public function edit() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['flash_error'] = 'Funcionário não encontrado.';
            header('Location: index.php?rota=funcionarios');
            exit;
        }

        $func = new Funcionario();
        $setor = new Setor();
        $setores = $setor->listar();
        $funcionario = $func->buscarPorId($id);

        if (!$funcionario) {
            $_SESSION['flash_error'] = 'Funcionário não encontrado.';
            header('Location: index.php?rota=funcionarios');
            exit;
        }

        if ($_POST) {
            $ok = $func->atualizar(
                $id,
                $_POST['id_setor'],
                $_POST['nome'],
                $_POST['sobrenome'],
                $_POST['telefone'],
                $_POST['matricula'],
                $_POST['cpf']
            );

            if ($ok) {
                $_SESSION['flash_success'] = 'Funcionário atualizado com sucesso.';
            } else {
                $_SESSION['flash_error'] = 'Erro ao atualizar funcionário.';
            }

            header('Location: index.php?rota=funcionarios');
            exit;
        }

        require __DIR__ . '/../views/funcionarios/edit.php';
    }

    public function delete() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['flash_error'] = 'Funcionário não encontrado.';
            header('Location: index.php?rota=funcionarios');
            exit;
        }

        $func = new Funcionario();
        $ok = $func->deletar($id);

        if ($ok) {
            $_SESSION['flash_success'] = 'Funcionário deletado com sucesso.';
        } else {
            $_SESSION['flash_error'] = 'Erro ao deletar funcionário.';
        }

        header('Location: index.php?rota=funcionarios');
        exit;
    }
}
