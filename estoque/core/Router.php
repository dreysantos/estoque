<?php

// rota padrão
$rota = $_GET['rota'] ?? 'home';

// iniciar sessão e aplicar regras de acesso básicas
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$usuarioSess = $_SESSION['usuario'] ?? null;
$nivelSess = $usuarioSess['nivel_acesso'] ?? null;

// se não estiver autenticado, permitir apenas login/auth e home
$publicRoutes = ['login', 'auth', 'home'];
if (!$usuarioSess && !in_array($rota, $publicRoutes)) {
    header('Location: index.php?rota=login');
    exit;
}

// se for usuário básico, limitar rotas permitidas a solicitações e logout
if ($usuarioSess && $nivelSess === 'basico') {
    $allowed = ['home', 'solicitacoes', 'solicitacoes_create', 'solicitacoes', 'logout'];
    if (!in_array($rota, $allowed)) {
        $_SESSION['flash_error'] = 'Acesso negado para seu nível de usuário.';
        header('Location: index.php?rota=solicitacoes');
        exit;
    }
}

// se for usuário médio, limitar rotas permitidas a funcionalidades específicas
if ($usuarioSess && $nivelSess === 'medio') {
    $allowed = [
        'home', 'dashboard',
        // solicitações (apenas criação e listagem)
        'solicitacoes', 'solicitacoes_create',
        // equipamentos (apenas listagem e cadastro)
        'equipamentos', 'equipamento_create',
        // funcionários (apenas listagem e cadastro)
        'funcionarios', 'funcionario_create',
        // fornecedores (apenas listagem e cadastro)
        'fornecedores', 'fornecedor_create',
        // entradas/saídas (apenas listagem e cadastro)
        'entradas', 'entrada_create', 'saidas', 'saida_create',
        // logout
        'logout'
    ];
    if (!in_array($rota, $allowed)) {
        $_SESSION['flash_error'] = 'Acesso negado para seu nível de usuário.';
        header('Location: index.php?rota=home');
        exit;
    }
}

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

    case 'setor_edit':
        require_once __DIR__ . '/../controllers/SetorController.php';
        (new SetorController())->edit();
        break;

    case 'setor_delete':
        require_once __DIR__ . '/../controllers/SetorController.php';
        (new SetorController())->delete();
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
    case 'funcionario_edit':
        require_once __DIR__ . '/../controllers/FuncionarioController.php';
        (new FuncionarioController())->edit();
        break;

    case 'funcionario_delete':
        require_once __DIR__ . '/../controllers/FuncionarioController.php';
        (new FuncionarioController())->delete();
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
    case 'saida_create':
        require_once __DIR__ . '/../controllers/SaidaController.php';
        (new SaidaController())->create();
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

    case 'solicitacoes_edit':
        require_once __DIR__ . '/../controllers/SolicitacaoController.php';
        (new SolicitacaoController())->edit();
        break;

    case 'solicitacoes_update':
        require_once __DIR__ . '/../controllers/SolicitacaoController.php';
        (new SolicitacaoController())->updateStatus();
        break;

    // ---------- 404 ----------
    default:
        echo "<h2>Página não encontrada</h2>";
        break;
}
