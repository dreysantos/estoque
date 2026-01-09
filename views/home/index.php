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
    background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #4facfe);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
    min-height: 100vh;
    padding: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1a1a1a;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}


/* ==============================
   CONTAINER PRINCIPAL
============================== */

.welcome-container {
    max-width: 800px;
    width: 100%;
    text-align: center;
}


/* ==============================
   CARD DE BOAS-VINDAS
============================== */

.welcome-card {
    background: rgba(255, 255, 255, 0.95);
    padding: 60px 50px;
    border-radius: 24px;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
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
    background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
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
    color: #1a202c;
    font-weight: 900;
    margin-bottom: 20px;
    letter-spacing: 1px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}


/* ==============================
   TEXTO
============================== */

.welcome-text {
    font-size: 20px;
    color: #4a5568;
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
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(102, 126, 234, 0.5);
}

.btn-secondary {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
    border: 2px solid #667eea;
}

.btn-secondary:hover {
    background: #667eea;
    color: white;
    transform: translateY(-3px);
}


/* ==============================
   FEATURES
============================== */

.features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 50px;
}

.feature-item {
    background: rgba(255, 255, 255, 0.9);
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(102, 126, 234, 0.2);
}

.feature-icon {
    font-size: 40px;
    margin-bottom: 15px;
}

.feature-title {
    font-size: 18px;
    font-weight: 700;
    color: #2d3748;
}


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
        <div class="welcome-icon">🎉</div>
        <h1>Bem-vindo ao Sistema de Estoque</h1>
        <p class="welcome-text">Você está logado com sucesso! Gerencie seu estoque de forma eficiente e moderna.</p>
        
        <div class="action-buttons">
            <a href="index.php?rota=dashboard" class="btn-primary">
                <span>📊</span>
                Ir para Dashboard
            </a>
            <a href="index.php?rota=equipamentos" class="btn-secondary">
                <span>📦</span>
                Ver Equipamentos
            </a>
        </div>
    </div>

    <div class="features">
        <div class="feature-item">
            <div class="feature-icon">⚡</div>
            <div class="feature-title">Rápido</div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">🔒</div>
            <div class="feature-title">Seguro</div>
        </div>
        <div class="feature-item">
            <div class="feature-icon">📱</div>
            <div class="feature-title">Responsivo</div>
        </div>
    </div>
</div>
