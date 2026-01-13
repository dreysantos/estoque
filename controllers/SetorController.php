<?php
require_once __DIR__ . '/../models/Setor.php';

class SetorController {

    public function index() {
        $setor = new Setor();
        $lista = $setor->listar();
        require __DIR__ . '/../views/setores/index.php';
    }

    public function create() {
        if ($_POST) {
            $setor = new Setor();
            $setor->criar($_POST['nome'], $_POST['descricao'], $_POST['telefone']);
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_success'] = 'Setor criado com sucesso.';
            header("Location: index.php?rota=setores");
        }
        require __DIR__ . '/../views/setores/create.php';
    }

    public function edit() {
        $setor = new Setor();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_error'] = 'ID do setor não informado.';
            header('Location: index.php?rota=setores');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $telefone = $_POST['telefone'] ?? '';

            $setor->atualizar($id, $nome, $descricao, $telefone);
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_success'] = 'Setor atualizado com sucesso.';
            header('Location: index.php?rota=setores');
            exit;
        }

        $dados = $setor->buscarPorId($id);
        if (!$dados) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_error'] = 'Setor não encontrado.';
            header('Location: index.php?rota=setores');
            exit;
        }

        require __DIR__ . '/../views/setores/edit.php';
    }
}
