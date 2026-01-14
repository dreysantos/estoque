<?php
require_once __DIR__ . '/../models/Saida.php';
require_once __DIR__ . '/../models/Solicitacao.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Equipamento.php';
require_once __DIR__ . '/../models/SaidaEquipamento.php';

class SaidaController {

    public function index() {
        $saida = new Saida();
        $lista = $saida->listar();
        require __DIR__ . '/../views/saidas/index.php';
    }

    public function create() {
        $sol = new Solicitacao();
        $solicitacoes = $sol->listar();

        $user = new Usuario();
        $usuarios = $user->listar();

        $equip = new Equipamento();
        $equipamentos = $equip->listar();

        if ($_POST) {
            $id_solicitacao = empty($_POST['id_solicitacao']) ? null : $_POST['id_solicitacao'];
            $id_usuario = $_POST['id_usuario'];
            $tipo = $_POST['tipo'];
            $descricao = $_POST['descricao'] ?? null;

            $saida = new Saida();
            $id_saida = $saida->criar($id_solicitacao, $id_usuario, $tipo, $descricao);

            $se = new SaidaEquipamento();
            $ids = $_POST['equipamento_id'] ?? [];
            $qtds = $_POST['quantidade'] ?? [];
            try {
                foreach ($ids as $i => $id_equip) {
                    $qtd = intval($qtds[$i] ?? 0);
                    if ($id_equip && $qtd > 0) {
                        $se->baixar($id_saida, $id_equip, $qtd);
                    }
                }
            } catch (Exception $e) {
                // Em caso de erro, poderia setar mensagem de erro na sessão
                if (session_status() !== PHP_SESSION_ACTIVE) session_start();
                $_SESSION['flash_error'] = $e->getMessage();
                header("Location: index.php?rota=saidas");
                return;
            }

            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_success'] = 'Saída registrada com sucesso.';
            header("Location: index.php?rota=saidas");
            return;
        }

        require __DIR__ . '/../views/saidas/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_error'] = 'ID da saída não informado.';
            header('Location: index.php?rota=saidas');
            exit;
        }

        $saida = new Saida();
        $dados = $saida->buscarPorId($id);

        if (!$dados) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_error'] = 'Saída não encontrada.';
            header('Location: index.php?rota=saidas');
            exit;
        }

        $itens = $saida->listarItens($id);

        $sol = new Solicitacao();
        $solicitacoes = $sol->listar();

        $user = new Usuario();
        $usuarios = $user->listar();

        $equip = new Equipamento();
        $equipamentos = $equip->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_solicitacao = empty($_POST['id_solicitacao']) ? null : $_POST['id_solicitacao'];
            $id_usuario = $_POST['id_usuario'] ?? null;
            $tipo = $_POST['tipo'] ?? null;
            $descricao = $_POST['descricao'] ?? null;

            $ids = $_POST['equipamento_id'] ?? [];
            $qtds = $_POST['quantidade'] ?? [];
            $novosItens = [];
            foreach ($ids as $i => $idEquip) {
                $qtd = intval($qtds[$i] ?? 0);
                if (!empty($idEquip) && $qtd > 0) {
                    $novosItens[] = [
                        'id_equipamento' => $idEquip,
                        'quantidade' => $qtd,
                    ];
                }
            }

            if (!$saida->atualizarComItens($id, $id_solicitacao, $id_usuario, $tipo, $descricao, $novosItens)) {
                if (session_status() !== PHP_SESSION_ACTIVE) session_start();
                $_SESSION['flash_error'] = $saida->getLastError() ?: 'Não foi possível atualizar a saída.';
                header('Location: index.php?rota=saida_edit&id=' . urlencode($id));
                exit;
            }

            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_success'] = 'Saída atualizada com sucesso.';
            header('Location: index.php?rota=saidas');
            exit;
        }

        require __DIR__ . '/../views/saidas/edit.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_error'] = 'ID da saída não informado.';
            header('Location: index.php?rota=saidas');
            exit;
        }

        $saida = new Saida();
        if (!$saida->deletar($id)) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_error'] = $saida->getLastError() ?: 'Não foi possível deletar a saída.';
            header('Location: index.php?rota=saidas');
            exit;
        }

        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $_SESSION['flash_success'] = 'Saída deletada com sucesso.';
        header('Location: index.php?rota=saidas');
        exit;
    }
}
