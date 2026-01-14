<style>
/* Refined Dax/Alpha Login - cleaner, professional, less square */
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --accent:#ff8a00; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

*{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%}
body{
    font-family: 'Inter', 'Segoe UI', Roboto, Arial, sans-serif;
    background: linear-gradient(180deg,var(--bg-1),var(--bg-2));
    color:var(--muted);
    display:flex;align-items:center;justify-content:center;padding:32px;
}

.login-wrap{width:100%;max-width:600px}

.card{
    background:#fff;border-radius:20px;padding:50px;border:none;
    box-shadow:0 18px 50px rgba(11,61,145,0.06);
}
.title{ text-align:center;font-size:40px;font-weight:700;color:var(--primary);margin-bottom:14px }
.subtitle{ text-align:center;color:#6b7280;font-size:19px;margin-bottom:26px }

.flash{ background:#fff4f4;border:1px solid rgba(248,113,113,0.18);color:#b91c1c;padding:16px;border-radius:10px;margin-bottom:20px;font-size:17px }

.form-row{margin-bottom:22px}
label.sr-only{position:absolute!important;height:1px;width:1px;overflow:hidden;clip:rect(1px,1px,1px,1px);white-space:nowrap}
input[type="text"], input[type="password"]{
    width:100%;padding:20px 22px;border-radius:12px;border:0;background:#f6f9fc;color:#102a43;font-size:20px;box-shadow:inset 0 1px 0 rgba(16,24,40,0.03)
}
input::placeholder{color:#9aa8bd;font-size:19px}
input:focus{outline:none !important;box-shadow:none !important}

.actions{margin-top:16px}
button[type="submit"]{width:100%;padding:20px;border-radius:12px;border:none;background:linear-gradient(90deg,var(--primary),var(--primary-2));color:#fff;font-weight:700;font-size:20px;cursor:pointer;box-shadow:0 8px 20px rgba(14,91,179,0.12);transition:transform .14s ease,box-shadow .14s ease}
button[type="submit"]:hover{transform:translateY(-2px);box-shadow:0 12px 26px rgba(14,91,179,0.16)}

.meta{margin-top:20px;text-align:center;color:#94a3b8;font-size:17px}

@media (max-width:520px){body{padding:18px}.card{padding:18px}.title{font-size:20px}}
</style>

<div class="login-wrap">
  <div class="card">
    <div class="title">Login</div>
    <div class="subtitle">Acesse o sistema de estoque</div>

    <?php if (!empty($_SESSION['erro'])): ?>
        <div class="flash"><?php echo htmlspecialchars($_SESSION['erro']); unset($_SESSION['erro']); ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?rota=auth" aria-label="Formulário de login">
        <div class="form-row">
            <label class="sr-only" for="input-nome">Usuário</label>
            <input id="input-nome" type="text" name="nome" placeholder="Usuário" required autocomplete="username">
        </div>
        <div class="form-row">
            <label class="sr-only" for="input-senha">Senha</label>
            <input id="input-senha" type="password" name="senha" placeholder="Senha" required autocomplete="current-password">
        </div>
        <div class="actions">
            <button type="submit">Entrar</button>
        </div>
    </form>

    <div class="meta">Acesse com suas credenciais.</div>
  </div>
</div>
