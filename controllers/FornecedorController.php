<?php
require_once __DIR__ . '/../models/Fornecedor.php';

class FornecedorController {

    public function index() {
        $forn = new Fornecedor();
        $lista = $forn->listar();
        require __DIR__ . '/../views/fornecedores/index.php';
    }

    public function create() {
        if ($_POST) {
            $forn = new Fornecedor();
            $forn->criar($_POST['nome'], $_POST['razao'], $_POST['cnpj']);
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_success'] = 'Fornecedor criado com sucesso.';
            header("Location: index.php?rota=fornecedores");
        }
        require __DIR__ . '/../views/fornecedores/create.php';
    }

    public function edit() {
        $forn = new Fornecedor();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_error'] = 'ID do fornecedor não informado.';
            header('Location: index.php?rota=fornecedores');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $razao = $_POST['razao'] ?? '';
            $cnpj = $_POST['cnpj'] ?? '';

            $forn->atualizar($id, $nome, $razao, $cnpj);
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_success'] = 'Fornecedor atualizado com sucesso.';
            header('Location: index.php?rota=fornecedores');
            exit;
        }

        $dados = $forn->buscarPorId($id);
        if (!$dados) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_error'] = 'Fornecedor não encontrado.';
            header('Location: index.php?rota=fornecedores');
            exit;
        }

        require __DIR__ . '/../views/fornecedores/edit.php';
    }

    public function delete() {
        $forn = new Fornecedor();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_error'] = 'ID do fornecedor não informado.';
            header('Location: index.php?rota=fornecedores');
            exit;
        }

        if ($forn->temEntradas($id)) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_error'] = 'Não é possível deletar este fornecedor pois existem entradas vinculadas a ele.';
            header('Location: index.php?rota=fornecedores');
            exit;
        }

        if (!$forn->deletar($id)) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_error'] = $forn->getLastError() ?: 'Não foi possível deletar o fornecedor.';
            header('Location: index.php?rota=fornecedores');
            exit;
        }

        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $_SESSION['flash_success'] = 'Fornecedor deletado com sucesso.';
        header('Location: index.php?rota=fornecedores');
        exit;
    }
}
