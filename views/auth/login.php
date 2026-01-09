<style>
    
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; }

/* Paleta inédita para login: dark charcoal + neon lime + lilac */
body {
    min-height: 100vh;
    background: radial-gradient(circle at 15% 20%, rgba(160, 255, 120, 0.14), transparent 30%),
                            radial-gradient(circle at 80% 0%, rgba(192, 132, 252, 0.18), transparent 35%),
                            linear-gradient(135deg, #0c0f1a, #101726, #0d1320);
    color: #e5e7eb;
    padding: 120px 16px;
    display: flex;
    flex-direction: column; /* mantém o título acima do cartão */
    align-items: center;
    justify-content: center;
    gap: 64px;
}

body > h1 {
    color: #a3e635;
    font-size: 24px;
    font-weight: 800;
    text-align: center;
    text-shadow: 0 4px 14px rgba(163, 230, 53, 0.25);
    margin-bottom: 18px;
}

.card {
    width: 100%;
    max-width: 420px;
    background: rgba(16, 23, 38, 0.9);
    border: 1px solid rgba(160, 255, 120, 0.25);
    border-radius: 16px;
    padding: 28px;
    margin-top: 12px; /* separa ainda mais do título */
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(192, 132, 252, 0.15) inset;
    backdrop-filter: blur(8px);
}

.title { text-align: center; font-size: 28px; font-weight: 800; color: #a3e635; margin-bottom: 8px; }
.subtitle { text-align: center; color: #c084fc; margin-bottom: 18px; font-size: 14px; }

.flash {
    background: rgba(248, 113, 113, 0.1);
    border: 1px solid rgba(248, 113, 113, 0.45);
    color: #fecdd3;
    padding: 10px 12px;
    border-radius: 10px;
    margin-bottom: 14px;
    font-size: 14px;
}

.field { margin-bottom: 14px; }
input[type="text"], input[type="password"] {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid rgba(192, 132, 252, 0.4);
    background: #0e1524;
    color: #e5e7eb;
    font-size: 14px;
    transition: all 0.25s ease;
}
input::placeholder { color: #94a3b8; }
input:focus { outline: none; border-color: #a3e635; box-shadow: 0 0 0 3px rgba(163, 230, 53, 0.28); }

.actions { margin-top: 6px; }
button[type="submit"] {
    width: 100%;
    padding: 14px;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #a3e635, #6ee7b7, #c084fc);
    color: #0c0f1a;
    font-weight: 800;
    font-size: 15px;
    letter-spacing: 0.4px;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    box-shadow: 0 12px 32px rgba(163, 230, 53, 0.28);
}
button[type="submit"]:hover { transform: translateY(-2px); box-shadow: 0 14px 38px rgba(163, 230, 53, 0.36); }

@media (max-width: 520px) {
    body { padding: 24px 12px; }
    .card { padding: 22px; }
    .title { font-size: 24px; }
}
</style>

<div class="card">
    <div class="title">Login</div>
    <div class="subtitle">Acesse o sistema de estoque</div>

    <?php if (!empty($_SESSION['erro'])): ?>
        <div class="flash"><?php echo htmlspecialchars($_SESSION['erro']); unset($_SESSION['erro']); ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?rota=auth">
        <div class="field">
            <input type="text" name="nome" placeholder="Usuário" required>
        </div>
        <div class="field">
            <input type="password" name="senha" placeholder="Senha" required>
        </div>
        <div class="actions">
            <button type="submit">Entrar</button>
        </div>
    </form>
</div>
