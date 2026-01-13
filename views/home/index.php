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
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1a1a1a;
}


/* ==============================
   CONTAINER PRINCIPAL
============================== */

.welcome-container {
    max-width: 800px;
    width: 100%;
    text-align: center;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}


/* ==============================
   CARD DE BOAS-VINDAS
============================== */

.welcome-card {
    background: #fff;
    padding: 60px 50px;
    border-radius: 20px;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.8s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.welcome-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 6px;
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
}


/* ==============================
   ÍCONE
============================== */

.welcome-icon {
    font-size: 80px;
    margin-bottom: 25px;
    animation: bounce 2s ease infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}


/* ==============================
   TÍTULO
============================== */

h1 {
    font-size: 48px;
    color: var(--primary);
    font-weight: 700;
    margin-bottom: 20px;
    letter-spacing: -0.5px;
}


/* ==============================
   TEXTO
============================== */

.welcome-text {
    font-size: 20px;
    color: var(--muted);
    margin-bottom: 40px;
    line-height: 1.6;
    font-weight: 500;
}


/* ==============================
   BOTÕES DE AÇÃO
============================== */

.action-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary, .btn-secondary {
    padding: 16px 36px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    font-size: 16px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    letter-spacing: 0.5px;
}

.btn-primary {
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: white;
    box-shadow: 0 8px 20px rgba(11,61,145,0.12);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 26px rgba(11,61,145,0.16);
}

.btn-secondary {
    background: #f6f9fc;
    color: var(--primary);
    border: 2px solid var(--primary);
}

.btn-secondary:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(11,61,145,0.12);
}


/* ==============================
   FEATURES
============================== */



/* ==============================
   RESPONSIVO
============================== */

@media (max-width: 768px) {
    body {
        padding: 20px;
    }

    .welcome-card {
        padding: 40px 30px;
    }

    h1 {
        font-size: 32px;
    }

    .welcome-text {
        font-size: 16px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 15px;
    }

    .btn-primary, .btn-secondary {
        width: 100%;
        justify-content: center;
    }

    .features {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="welcome-container">
    <div class="welcome-card">
        <div class="welcome-icon"></div>
        <h1>Bem-vindo ao Sistema de Estoque</h1>
        <p class="welcome-text">Você está logado com sucesso! Gerencie seu estoque de forma eficiente e moderna.</p>
        
        <div class="action-buttons">
            <?php
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
            if ($nivel === 'basico'):
            ?>
                <a href="index.php?rota=solicitacoes" class="btn-primary">Ir para Solicitações</a>
            <?php else: ?>
                <a href="index.php?rota=dashboard" class="btn-primary">Ir para Dashboard</a>
                <a href="index.php?rota=equipamentos" class="btn-secondary">Ver Equipamentos</a>
            <?php endif; ?>
        </div>
</div>
</div>
