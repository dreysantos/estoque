<?php
require_once __DIR__ . '/../models/Equipamento.php';

class EquipamentoController {

    public function index() {
        $equip = new Equipamento();
        $lista = $equip->listar();
        require __DIR__ . '/../views/equipamentos/index.php';
    }

    public function create() {
        if ($_POST) {
            $equip = new Equipamento();
            $equip->criar(
                $_POST['nome'],
                $_POST['descricao'],
                $_POST['marca'],
                $_POST['tipo'],
                $_POST['ca'],
                $_POST['ca_validade'],
                $_POST['quantidade']
            );
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION['flash_success'] = 'Equipamento criado com sucesso.';
            header("Location: index.php?rota=equipamentos");
        }

        require __DIR__ . '/../views/equipamentos/create.php';
    }

    public function edit() {
        $equipModel = new Equipamento();

        // GET: mostrar formulário preenchido
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                echo "ID inválido";
                return;
            }
            $equip = $equipModel->find($id);
            if (!$equip) {
                echo "Equipamento não encontrado";
                return;
            }
            require __DIR__ . '/../views/equipamentos/equipamento_edit.php';
            return;
        }

        // POST: atualizar
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID inválido";
            return;
        }

        $equipModel->atualizar(
            $id,
            $_POST['nome'] ?? '',
            $_POST['descricao'] ?? '',
            $_POST['marca'] ?? '',
            $_POST['tipo'] ?? '',
            $_POST['ca'] ?? '',
            $_POST['ca_validade'] ?? null,
            $_POST['quantidade'] ?? 0
        );

        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $_SESSION['flash_success'] = 'Equipamento atualizado com sucesso.';
        header("Location: index.php?rota=equipamentos");
    }

    public function delete() {
        $equipModel = new Equipamento();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID inválido";
            return;
        }

        // GET: mostrar confirmação
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $equip = $equipModel->find($id);
            if (!$equip) {
                echo "Equipamento não encontrado";
                return;
            }
            require __DIR__ . '/../views/equipamentos/equipamento_delete.php';
            return;
        }

        // POST: excluir
        $equipModel->excluir($id);
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $_SESSION['flash_success'] = 'Equipamento excluído com sucesso.';
        header("Location: index.php?rota=equipamentos");
    }
}
