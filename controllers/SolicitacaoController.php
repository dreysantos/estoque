<?php
require_once __DIR__ . '/../models/Solicitacao.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Setor.php';


class SolicitacaoController {

    public function index() {
        $sol = new Solicitacao();
        $lista = $sol->listar();
        require __DIR__ . '/../views/solicitacoes/index.php';
    }

    public function create() {
        $userModel = new Usuario();
        $usuarios = $userModel->listar();

        $setorModel = new Setor();
        $setores = $setorModel->listar();

        if ($_POST) {
            $sol = new Solicitacao();
            $id_usuario = $_POST['id_usuario'] ?? null;
            $id_setor = $_POST['id_setor'] ?? null;
            $descricao = $_POST['descricao'] ?? null;
            $id = $sol->criar($id_usuario, $id_setor, $descricao);
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_success'] = 'Solicitação criada com sucesso.';
            header('Location: index.php?rota=solicitacoes');
            return;
        }

        require __DIR__ . '/../views/solicitacoes/create.php';
    }
}
