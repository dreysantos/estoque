<?php
require_once __DIR__ . '/../models/Entrada.php';
require_once __DIR__ . '/../models/Fornecedor.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Equipamento.php';
require_once __DIR__ . '/../models/entradaequipamentos.php';

class EntradaController {

    public function index() {
        $ent = new Entrada();
        $lista = $ent->listar();
        require __DIR__ . '/../views/entradas/index.php';
    }

    public function create() {
        $forn = new Fornecedor();
        $fornecedores = $forn->listar();

        $user = new Usuario();
        $usuarios = $user->listar();

        $equip = new Equipamento();
        $equipamentos = $equip->listar();

        if ($_POST) {
            $entrada = new Entrada();
            $id_fornecedor = empty($_POST['id_fornecedor']) ? null : $_POST['id_fornecedor'];
            $id_usuario = $_POST['id_usuario'];
            $tipo = $_POST['tipo'];
            $descricao = $_POST['descricao'] ?? null;

            $id_entrada = $entrada->criar($id_fornecedor, $id_usuario, $tipo, $descricao);

            $ee = new EntradaEquipamento();
            $ids = $_POST['equipamento_id'] ?? [];
            $qtds = $_POST['quantidade'] ?? [];
            foreach ($ids as $i => $id_equip) {
                $qtd = intval($qtds[$i] ?? 0);
                if ($id_equip && $qtd > 0) {
                    $ee->adicionar($id_entrada, $id_equip, $qtd);
                }
            }

            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_success'] = 'Entrada registrada com sucesso.';
            header("Location: index.php?rota=entradas");
            return;
        }

        require __DIR__ . '/../views/entradas/create.php';
    }

    public function show() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();

        $id = $_GET['id'] ?? null;
        if ($id === null || $id === '' || !ctype_digit((string) $id)) {
            $_SESSION['flash_error'] = 'Entrada inválida.';
            header('Location: index.php?rota=entradas');
            return;
        }

        $entradaModel = new Entrada();
        $entrada = $entradaModel->buscarDetalhes((int) $id);
        if (!$entrada) {
            $_SESSION['flash_error'] = 'Entrada não encontrada.';
            header('Location: index.php?rota=entradas');
            return;
        }

        $ee = new EntradaEquipamento();
        $itens = $ee->listarPorEntrada((int) $id);

        require __DIR__ . '/../views/entradas/show.php';
    }

    public function edit() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
        if (!in_array($nivel, ['avancado', 'administrador'], true)) {
            $_SESSION['flash_error'] = 'Acesso negado.';
            header('Location: index.php?rota=entradas');
            return;
        }

        $id = $_GET['id'] ?? null;
        if ($id === null || $id === '' || !ctype_digit((string)$id)) {
            $_SESSION['flash_error'] = 'Entrada inválida.';
            header('Location: index.php?rota=entradas');
            return;
        }

        $entradaModel = new Entrada();
        $entrada = $entradaModel->buscarPorId((int)$id);
        if (!$entrada) {
            $_SESSION['flash_error'] = 'Entrada não encontrada.';
            header('Location: index.php?rota=entradas');
            return;
        }

        $forn = new Fornecedor();
        $fornecedores = $forn->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_fornecedor = empty($_POST['id_fornecedor']) ? null : $_POST['id_fornecedor'];
            $tipo = $_POST['tipo'] ?? '';
            $situacao = $_POST['situacao'] ?? '';
            $descricao = $_POST['descricao'] ?? null;

            if (!$entradaModel->atualizar((int)$id, $id_fornecedor, $tipo, $situacao, $descricao)) {
                $_SESSION['flash_error'] = $entradaModel->getLastError() ?: 'Não foi possível atualizar a entrada.';
                header('Location: index.php?rota=entrada_edit&id=' . urlencode((string)$id));
                return;
            }

            $_SESSION['flash_success'] = 'Entrada atualizada com sucesso.';
            header('Location: index.php?rota=entradas');
            return;
        }

        require __DIR__ . '/../views/entradas/edit.php';
    }

    public function delete() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
        if (!in_array($nivel, ['avancado', 'administrador'], true)) {
            $_SESSION['flash_error'] = 'Acesso negado.';
            header('Location: index.php?rota=entradas');
            return;
        }

        $id = $_GET['id'] ?? null;
        if ($id === null || $id === '' || !ctype_digit((string)$id)) {
            $_SESSION['flash_error'] = 'Entrada inválida.';
            header('Location: index.php?rota=entradas');
            return;
        }

        $entradaModel = new Entrada();
        if (!$entradaModel->deletar((int)$id)) {
            $_SESSION['flash_error'] = $entradaModel->getLastError() ?: 'Não foi possível deletar a entrada.';
            header('Location: index.php?rota=entradas');
            return;
        }

        $_SESSION['flash_success'] = 'Entrada deletada com sucesso.';
        header('Location: index.php?rota=entradas');
        return;
    }
}
