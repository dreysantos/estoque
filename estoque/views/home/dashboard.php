<style>
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --accent:#ff8a00; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', 'Segoe UI', 'Roboto', Arial, sans-serif;
}

/* ==============================
   FUNDO CLEAN
============================== */

body {
    background: linear-gradient(180deg,var(--bg-1),var(--bg-2));
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
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
    width: 100%;
    max-width: 820px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.dashboard-header h2 {
    font-size: 48px;
    color: var(--primary);
    font-weight: 700;
    margin-bottom: 15px;
    letter-spacing: -0.5px;
    text-align: center;
    width: 100%;
}

.welcome-text {
    font-size: 22px;
    color: var(--muted);
    font-weight: 500;
}

.welcome-name {
    color: var(--primary);
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
    background: #fff;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
    transition: all 0.3s ease;
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
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.card:hover::before {
    transform: scaleX(1);
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 22px 60px rgba(11,61,145,0.12);
    border-color: var(--primary);
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
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    box-shadow: 0 8px 20px rgba(11,61,145,0.15);
}


/* ==============================
   TÍTULOS DOS CARDS
============================== */

.card-title {
    font-size: 22px;
    font-weight: 700;
    color: var(--primary);
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
    background: #f6f9fc;
    border-radius: 12px;
    text-decoration: none;
    color: var(--muted);
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.card-link:hover {
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: white;
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(11,61,145,0.15);
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

.card .card-icon { background: linear-gradient(90deg,var(--primary),var(--primary-2)); }


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
        <?php if (in_array($nivel, ['avancado','administrador'])): ?>
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
        <?php elseif ($nivel === 'medio'): ?>
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
                <div class="card-icon">👥</div>
                <h3 class="card-title">Funcionários</h3>
                <div class="card-links">
                    <a href="index.php?rota=funcionarios" class="card-link">Listar Funcionários</a>
                    <a href="index.php?rota=funcionario_create" class="card-link">Criar Funcionário</a>
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

