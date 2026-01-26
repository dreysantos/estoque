<?php
// ============================
// INICIALIZAÇÃO
// ============================
ob_start();
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
// AUTORIZAÇÃO POR NÍVEL
// ============================
if (!in_array($rota, $rotasPublicas)) {
    $nivelSess = $_SESSION['usuario']['nivel_acesso'] ?? null;

    // Regras para nível básico
    if ($nivelSess === 'basico') {
        $allowed = ['home', 'solicitacoes', 'solicitacoes_create', 'logout'];
        if (!in_array($rota, $allowed)) {
            $_SESSION['flash_error'] = 'Acesso negado para seu nível de usuário.';
            header('Location: index.php?rota=solicitacoes');
            exit;
        }
    }

    // Regras para nível médio
    if ($nivelSess === 'medio') {
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
            'entradas', 'entrada_create', 'entrada_show', 'saidas', 'saida_create',
            // logout
            'logout'
        ];
        if (!in_array($rota, $allowed)) {
            $_SESSION['flash_error'] = 'Acesso negado para seu nível de usuário.';
            header('Location: index.php?rota=home');
            exit;
        }
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

    case 'setor_edit':
        (new SetorController())->edit();
        break;

    case 'setor_delete':
        (new SetorController())->delete();
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

    case 'usuario_edit':
        (new UsuarioController())->edit();
        break;

    case 'usuario_status':
        (new UsuarioController())->status();
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

    case 'fornecedor_edit':
        (new FornecedorController())->edit();
        break;

    case 'fornecedor_delete':
        (new FornecedorController())->delete();
        break;

    // -------- ENTRADAS --------
    case 'entradas':
        (new EntradaController())->index();
        break;

    case 'entrada_create':
        (new EntradaController())->create();
        break;

    case 'entrada_show':
        (new EntradaController())->show();
        break;

    case 'entrada_edit':
        (new EntradaController())->edit();
        break;

    case 'entrada_delete':
        (new EntradaController())->delete();
        break;

    // -------- SAÍDAS --------
    case 'saidas':
        (new SaidaController())->index();
        break;
    case 'saida_create':
        (new SaidaController())->create();
        break;

    case 'saida_edit':
        (new SaidaController())->edit();
        break;

    case 'saida_delete':
        (new SaidaController())->delete();
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

    case 'solicitacoes_delete':
        (new SolicitacaoController())->delete();
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

// Liberar o buffer de saída
if (ob_get_level() > 0) {
    ob_end_flush();
}
