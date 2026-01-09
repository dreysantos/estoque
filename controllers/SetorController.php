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
}
