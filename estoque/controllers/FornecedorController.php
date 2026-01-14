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
}
