<?php
// ============================
// INICIALIZAÇÃO
// ============================
session_start();

require_once __DIR__ . '/../core/Database.php';

// ============================
// CONTROLLERS
// ============================
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/SetorController.php';
require_once __DIR__ . '/../controllers/FuncionarioController.php';
require_once __DIR__ . '/../controllers/UsuarioController.php';
require_once __DIR__ . '/../controllers/EquipamentoController.php';
require_once __DIR__ . '/../controllers/FornecedorController.php';
require_once __DIR__ . '/../controllers/EntradaController.php';
require_once __DIR__ . '/../controllers/SaidaController.php';
require_once __DIR__ . '/../controllers/SolicitacaoController.php';

// ============================
// ROTA ATUAL
// ============================
// Se o usuário já estiver logado e não houver uma rota explícita,
// usar `home` como rota padrão. Caso contrário, usar `login`.
$rota = $_GET['rota'] ?? (isset($_SESSION['usuario']) ? 'home' : 'login');

// ============================
// ROTAS LIVRES (SEM LOGIN)
// ============================
$rotasPublicas = ['login', 'auth'];

// ============================
// AUTENTICAÇÃO
// ============================
if (!in_array($rota, $rotasPublicas)) {
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php?rota=login');
        exit;
    }
}

// ============================
// LAYOUT
// ============================
require_once __DIR__ . '/../views/layout/header.php';

// ============================
// DISPATCH
// ============================
switch ($rota) {

    // -------- LOGIN --------
    case 'login':
        (new AuthController())->loginForm();
        break;

    case 'auth':
        (new AuthController())->login();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    // -------- HOME --------
    case 'home':
        require_once __DIR__ . '/../views/home/index.php';
        break;

    // -------- DASHBOARD (pós-login) --------
    case 'dashboard':
        require_once __DIR__ . '/../views/home/dashboard.php';
        break;

    // -------- SETORES --------
    case 'setores':
        (new SetorController())->index();
        break;

    case 'setor_create':
        (new SetorController())->create();
        break;

    // -------- FUNCIONÁRIOS --------
    case 'funcionarios':
        (new FuncionarioController())->index();
        break;

    case 'funcionario_create':
        (new FuncionarioController())->create();
        break;

    case 'funcionario_edit':
        (new FuncionarioController())->edit();
        break;

    case 'funcionario_delete':
        (new FuncionarioController())->delete();
        break;

    // -------- USUÁRIOS --------
    case 'usuarios':
        (new UsuarioController())->index();
        break;

    case 'usuario_create':
        (new UsuarioController())->create();
        break;

    // -------- EQUIPAMENTOS --------
    case 'equipamentos':
        (new EquipamentoController())->index();
        break;

    case 'equipamento_create':
        (new EquipamentoController())->create();
        break;
    case 'equipamento_edit':
        (new EquipamentoController())->edit();
        break;
    case 'equipamento_delete':
        (new EquipamentoController())->delete();
        break;

    // -------- FORNECEDORES --------
    case 'fornecedores':
        (new FornecedorController())->index();
        break;

    case 'fornecedor_create':
        (new FornecedorController())->create();
        break;

    // -------- ENTRADAS --------
    case 'entradas':
        (new EntradaController())->index();
        break;

    case 'entrada_create':
        (new EntradaController())->create();
        break;

    // -------- SAÍDAS --------
    case 'saidas':
        (new SaidaController())->index();
        break;
    case 'saida_create':
        (new SaidaController())->create();
        break;


    // -------- SOLICITAÇÕES --------
    case 'solicitacoes':
        (new SolicitacaoController())->index();
        break;

    case 'solicitacoes_create':
        (new SolicitacaoController())->create();
        break;

    case 'solicitacoes_edit':
        (new SolicitacaoController())->edit();
        break;

    case 'solicitacoes_update':
        (new SolicitacaoController())->updateStatus();
        break;

    // -------- 404 --------
    default:
        echo "<h2>Página não encontrada</h2>";
        break;
}

// ============================
// FOOTER
// ============================
// em vez de incluí-lo, emito os fechamentos HTML diretamente até corrigi-lo.
// Layout footer
require_once __DIR__ . '/../views/layout/footer.php';
