<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
}

/* ==============================
   FUNDO GRADIENTE ANIMADO
============================== */

body {
    background: linear-gradient(135deg, #667eea, #764ba2, #f093fb, #4facfe);
    min-height: 100vh;
    padding: 40px;
    color: #1a1a1a;
}


/* ==============================
   CONTAINER PRINCIPAL
============================== */

.dashboard-container {
    max-width: 1100px;
    margin: 48px auto 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 28px;
    padding: 0 16px;
    min-height: calc(100vh - 160px);
}


/* ==============================
   HEADER DA DASHBOARD
============================== */

.dashboard-header {
    text-align: center;
    margin-bottom: 0;
    background: rgba(255, 255, 255, 0.95);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
    backdrop-filter: blur(6px);
    width: 100%;
    max-width: 820px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.dashboard-header h2 {
    font-size: 48px;
    color: #1a202c;
    font-weight: 900;
    margin-bottom: 15px;
    letter-spacing: 2px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    width: 100%;
}

.welcome-text {
    font-size: 22px;
    color: #4a5568;
    font-weight: 500;
}

.welcome-name {
    color: #667eea;
    font-weight: 700;
}


/* ==============================
   GRID DE CARDS
============================== */

.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
    list-style: none;
    width: 100%;
    max-width: 980px;
    margin: 18px auto 40px auto;
}

.card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.card:hover::before {
    transform: scaleX(1);
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(102, 126, 234, 0.3);
    border-color: #667eea;
}


/* ==============================
   ÍCONES DOS CARDS
============================== */

.card-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: bold;
    color: white;
    background: linear-gradient(135deg, #667eea, #764ba2);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}


/* ==============================
   TÍTULOS DOS CARDS
============================== */

.card-title {
    font-size: 22px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 20px;
}


/* ==============================
   LINKS/BOTÕES DOS CARDS
============================== */

.card-links {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.card-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 18px;
    background: linear-gradient(135deg, #f7fafc, #edf2f7);
    border-radius: 10px;
    text-decoration: none;
    color: #4a5568;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.card-link:hover {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    transform: translateX(5px);
    border-color: #667eea;
}

.card-link::after {
    content: '→';
    font-size: 18px;
    transition: transform 0.3s ease;
}

.card-link:hover::after {
    transform: translateX(5px);
}


/* ==============================
   CORES ESPECÍFICAS DOS CARDS
============================== */

.card:nth-child(1) .card-icon { background: linear-gradient(135deg, #667eea, #764ba2); }
.card:nth-child(2) .card-icon { background: linear-gradient(135deg, #f093fb, #f5576c); }
.card:nth-child(3) .card-icon { background: linear-gradient(135deg, #4facfe, #00f2fe); }
.card:nth-child(4) .card-icon { background: linear-gradient(135deg, #43e97b, #38f9d7); }
.card:nth-child(5) .card-icon { background: linear-gradient(135deg, #fa709a, #fee140); }
.card:nth-child(6) .card-icon { background: linear-gradient(135deg, #30cfd0, #330867); }
.card:nth-child(7) .card-icon { background: linear-gradient(135deg, #a8edea, #fed6e3); }
.card:nth-child(8) .card-icon { background: linear-gradient(135deg, #ff9a9e, #fecfef); }


/* ==============================
   RESPONSIVO
============================== */

@media (max-width: 768px) {
    body {
        padding: 20px;
    }

    .dashboard-header h2 {
        font-size: 32px;
    }

    .welcome-text {
        font-size: 16px;
    }

    .cards-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Dashboard</h2>
        <p class="welcome-text">Bem-vindo, <span class="welcome-name"><?= htmlspecialchars($_SESSION['usuario']['nome'] ?? 'Usuário') ?></span>!</p>
    </div>

    <?php if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
    ?>

    <ul class="cards-grid">
        <?php if ($nivel !== 'basico'): ?>
        <li class="card">
            <div class="card-icon">🏢</div>
            <h3 class="card-title">Setores</h3>
            <div class="card-links">
                <a href="index.php?rota=setores" class="card-link">Listar Setores</a>
                <a href="index.php?rota=setor_create" class="card-link">Criar Setor</a>
            </div>
        </li>

        <li class="card">
            <div class="card-icon">👥</div>
            <h3 class="card-title">Funcionários</h3>
            <div class="card-links">
                <a href="index.php?rota=funcionarios" class="card-link">Listar Funcionários</a>
                <a href="index.php?rota=funcionario_create" class="card-link">Criar Funcionário</a>
            </div>
        </li>

        <li class="card">
            <div class="card-icon">👤</div>
            <h3 class="card-title">Usuários</h3>
            <div class="card-links">
                <a href="index.php?rota=usuarios" class="card-link">Listar Usuários</a>
                <a href="index.php?rota=usuario_create" class="card-link">Criar Usuário</a>
            </div>
        </li>

        <li class="card">
            <div class="card-icon">📦</div>
            <h3 class="card-title">Equipamentos</h3>
            <div class="card-links">
                <a href="index.php?rota=equipamentos" class="card-link">Listar Equipamentos</a>
                <a href="index.php?rota=equipamento_create" class="card-link">Criar Equipamento</a>
            </div>
        </li>

        <li class="card">
            <div class="card-icon">🏭</div>
            <h3 class="card-title">Fornecedores</h3>
            <div class="card-links">
                <a href="index.php?rota=fornecedores" class="card-link">Listar Fornecedores</a>
                <a href="index.php?rota=fornecedor_create" class="card-link">Criar Fornecedor</a>
            </div>
        </li>

        <li class="card">
            <div class="card-icon">📥</div>
            <h3 class="card-title">Entradas</h3>
            <div class="card-links">
                <a href="index.php?rota=entradas" class="card-link">Listar Entradas</a>
                <a href="index.php?rota=entrada_create" class="card-link">Registrar Entrada</a>
            </div>
        </li>

        <li class="card">
            <div class="card-icon">📤</div>
            <h3 class="card-title">Saídas</h3>
            <div class="card-links">
                <a href="index.php?rota=saidas" class="card-link">Listar Saídas</a>
                <a href="index.php?rota=saida_create" class="card-link">Registrar Saída</a>
            </div>
        </li>

        <?php endif; ?>
        <li class="card">
            <div class="card-icon">📋</div>
            <h3 class="card-title">Solicitações</h3>
            <div class="card-links">
                <a href="index.php?rota=solicitacoes" class="card-link">Listar Solicitações</a>
            </div>
        </li>
    </ul>
</div>

