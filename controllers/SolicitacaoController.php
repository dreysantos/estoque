<?php
require_once __DIR__ . '/../models/Solicitacao.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Setor.php';
require_once __DIR__ . '/../models/Funcionario.php';
require_once __DIR__ . '/../core/auth.php';


class SolicitacaoController {

    public function index() {
        $sol = new Solicitacao();
        $lista = $sol->listar();
        require __DIR__ . '/../views/solicitacoes/index.php';
    }

    public function create() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        Auth::check();

        $nivel = $_SESSION['usuario']['nivel_acesso'] ?? '';
        $isBasico = ($nivel === 'basico');

        $usuarioSessId = $_SESSION['usuario']['id'] ?? null;
        $loginSess = $_SESSION['usuario']['nome'] ?? '';
        $funcSessId = $_SESSION['usuario']['id_funcionario'] ?? null;
        $setorSessId = null;
        $setorSessNome = '';

        if ($isBasico) {
            $funcModel = new Funcionario();
            $func = $funcSessId ? $funcModel->buscarPorId($funcSessId) : null;
            $setorSessId = $func['id_setor'] ?? null;
            $setorSessNome = $func['setor'] ?? '';
        } else {
            $userModel = new Usuario();
            $usuarios = $userModel->listar();

            $setorModel = new Setor();
            $setores = $setorModel->listar();
        }

        if ($_POST) {
            $sol = new Solicitacao();
            $id_usuario = $_POST['id_usuario'] ?? null;
            $id_setor = $_POST['id_setor'] ?? null;
            $descricao = $_POST['descricao'] ?? null;

            // Usuário nível básico não escolhe solicitante/setor: força valores da sessão
            if ($isBasico) {
                $id_usuario = $usuarioSessId;
                $id_setor = $setorSessId;
            }

            if (!$id_usuario || !$id_setor) {
                $_SESSION['flash_error'] = 'Não foi possível identificar seu usuário/setor para criar a solicitação.';
                header('Location: index.php?rota=solicitacoes_create');
                return;
            }

            $id = $sol->criar($id_usuario, $id_setor, $descricao);
            $_SESSION['flash_success'] = 'Solicitação criada com sucesso.';
            header('Location: index.php?rota=solicitacoes');
            return;
        }

        require __DIR__ . '/../views/solicitacoes/create.php';
    }

    public function updateStatus() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        Auth::check();
        $isAdmin = (($_SESSION['usuario']['nivel_acesso'] ?? '') === 'administrador');

        if ($_POST) {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                $_SESSION['flash_error'] = 'ID da solicitação não informado.';
                header('Location: index.php?rota=solicitacoes');
                return;
            }

            $solModel = new Solicitacao();
            $okStatus = true;

            // atualizar status quando fornecido (apenas admin)
            if (isset($_POST['situacao'])) {
                if (!$isAdmin) {
                    $_SESSION['flash_error'] = 'Você não tem permissão para alterar o status.';
                    header('Location: index.php?rota=solicitacoes');
                    return;
                }
                $status = $_POST['situacao'] ?? null;
                $okStatus = $solModel->atualizarStatus($id, $status);
            }

            // atualizar descrição quando fornecida
            if (isset($_POST['descricao'])) {
                $descricao = $_POST['descricao'];
                $okDesc = $solModel->atualizarDescricao($id, $descricao);
                if (!$okDesc) {
                    $_SESSION['flash_error'] = 'Erro ao atualizar descrição.';
                }
            }

            // atualizar itens (substitui todos)
            if (isset($_POST['itens']) && is_array($_POST['itens'])) {
                require_once __DIR__ . '/../models/SolicitacaoEquipamento.php';
                $itmModel = new SolicitacaoEquipamento();
                $itmModel->deleteBySolicitacao($id);
                foreach ($_POST['itens'] as $item) {
                    $ide = $item['equipamento'] ?? null;
                    $qtd = $item['quantidade'] ?? null;
                    if ($ide && $qtd) {
                        $itmModel->adicionar($id, $ide, $qtd);
                    }
                }
            }

            if ($okStatus) {
                $_SESSION['flash_success'] = 'Solicitação atualizada com sucesso.';
            } else {
                $_SESSION['flash_error'] = 'Erro ao atualizar status.';
            }
        }

        header('Location: index.php?rota=solicitacoes');
        return;
    }

    public function edit() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        Auth::check();
        Auth::nivel('administrador');

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['flash_error'] = 'Solicitação não informada.';
            header('Location: index.php?rota=solicitacoes');
            return;
        }

        $solModel = new Solicitacao();
        $sol = $solModel->find($id);
        require_once __DIR__ . '/../models/Equipamento.php';
        require_once __DIR__ . '/../models/SolicitacaoEquipamento.php';

        $equipModel = new Equipamento();
        $equipamentos = $equipModel->listar();

        $itmModel = new SolicitacaoEquipamento();
        $itens = $itmModel->listarPorSolicitacao($id);
        if (!$sol) {
            $_SESSION['flash_error'] = 'Solicitação não encontrada.';
            header('Location: index.php?rota=solicitacoes');
            return;
        }

        require __DIR__ . '/../views/solicitacoes/solicitacoes_update.php';
    }

    public function delete() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        Auth::check();
        Auth::nivel('administrador');

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['flash_error'] = 'Solicitação não informada.';
            header('Location: index.php?rota=solicitacoes');
            return;
        }

        // Por segurança, só aceitar POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['flash_error'] = 'Ação inválida.';
            header('Location: index.php?rota=solicitacoes');
            return;
        }

        $solModel = new Solicitacao();
        $ok = $solModel->excluir($id);
        if ($ok) {
            $_SESSION['flash_success'] = 'Solicitação excluída com sucesso.';
        } else {
            $msg = method_exists($solModel, 'getLastError') ? $solModel->getLastError() : null;
            $_SESSION['flash_error'] = $msg ?: 'Não foi possível excluir a solicitação.';
        }
        header('Location: index.php?rota=solicitacoes');
        return;
    }
}
