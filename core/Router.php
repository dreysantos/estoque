<?php

// rota padrão
$rota = $_GET['rota'] ?? 'home';

// ==========================
// ROTAS
// ==========================
switch ($rota) {

    // ---------- LOGIN ----------
    case 'login':
        require_once __DIR__ . '/../controllers/AuthController.php';
        (new AuthController())->loginForm();
        break;

    case 'auth':
        require_once __DIR__ . '/../controllers/AuthController.php';
        (new AuthController())->login();
        break;

    case 'logout':
        require_once __DIR__ . '/../controllers/AuthController.php';
        (new AuthController())->logout();
        break;

    // ---------- HOME ----------
    case 'home':
        require_once __DIR__ . '/../views/home/index.php';
        break;

    // ---------- SETORES ----------
    case 'setores':
        require_once __DIR__ . '/../controllers/SetorController.php';
        (new SetorController())->index();
        break;

    case 'setor_create':
        require_once __DIR__ . '/../controllers/SetorController.php';
        (new SetorController())->create();
        break;

    // ---------- FUNCIONÁRIOS ----------
    case 'funcionarios':
        require_once __DIR__ . '/../controllers/FuncionarioController.php';
        (new FuncionarioController())->index();
        break;

    case 'funcionario_create':
        require_once __DIR__ . '/../controllers/FuncionarioController.php';
        (new FuncionarioController())->create();
        break;

    // ---------- USUÁRIOS ----------
    case 'usuarios':
        require_once __DIR__ . '/../controllers/UsuarioController.php';
        (new UsuarioController())->index();
        break;

    case 'usuario_create':
        require_once __DIR__ . '/../controllers/UsuarioController.php';
        (new UsuarioController())->create();
        break;

    // ---------- EQUIPAMENTOS ----------
    case 'equipamentos':
        require_once __DIR__ . '/../controllers/EquipamentoController.php';
        (new EquipamentoController())->index();
        break;

    case 'equipamento_create':
        require_once __DIR__ . '/../controllers/EquipamentoController.php';
        (new EquipamentoController())->create();
        break;
    case 'equipamento_edit':
        require_once __DIR__ . '/../controllers/EquipamentoController.php';
        (new EquipamentoController())->edit();
        break;
    case 'equipamento_delete':
        require_once __DIR__ . '/../controllers/EquipamentoController.php';
        (new EquipamentoController())->delete();
        break;

    // ---------- FORNECEDORES ----------
    case 'fornecedores':
        require_once __DIR__ . '/../controllers/FornecedorController.php';
        (new FornecedorController())->index();
        break;

    case 'fornecedor_create':
        require_once __DIR__ . '/../controllers/FornecedorController.php';
        (new FornecedorController())->create();
        break;

    // ---------- ENTRADAS ----------
    case 'entradas':
        require_once __DIR__ . '/../controllers/EntradaController.php';
        (new EntradaController())->index();
        break;

    case 'entrada_create':
        require_once __DIR__ . '/../controllers/EntradaController.php';
        (new EntradaController())->create();
        break;

    // ---------- SAÍDAS ----------
    case 'saidas':
        require_once __DIR__ . '/../controllers/SaidaController.php';
        (new SaidaController())->index();
        break;


    // ---------- SOLICITAÇÕES ----------
    case 'solicitacoes':
        require_once __DIR__ . '/../controllers/SolicitacaoController.php';
        (new SolicitacaoController())->index();
        break;

    case 'solicitacoes_create':
        require_once __DIR__ . '/../controllers/SolicitacaoController.php';
        (new SolicitacaoController())->create();
        break;

    // ---------- 404 ----------
    default:
        echo "<h2>Página não encontrada</h2>";
        break;
}
