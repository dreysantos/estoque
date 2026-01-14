<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="assets/css/theme.css">
    <style>
        /* garantir que o conteúdo não fique atrás do header fixo; aumentar espaço para flash/form */
        body { padding-top:96px !important; }
        .site-header{position:fixed;top:0;left:0;width:100%;text-align:center;padding:18px 12px;min-height:72px;height:auto;display:flex;align-items:center;justify-content:center;border-bottom:1px solid rgba(0,0,0,0.04);background:rgba(255,255,255,0.02);backdrop-filter:blur(4px);z-index:1200}
        .site-header h1{color:var(--primary, #0b3d91);margin:0;font-size:clamp(28px, 3vw, 40px);font-weight:800;line-height:1.1}
<<<<<<< HEAD

        /* Botão global "Voltar para Home" (reposicionado via JS para combinar com cada tela) */
        .global-home-wrap{display:flex;gap:10px;margin:0 0 16px 0}
        .global-home-wrap--in-actions{margin:0}
        .global-home-wrap--under-actions{margin:12px 0 0 0;justify-content:center}
        .global-home-btn{display:inline-flex;align-items:center;gap:8px;text-decoration:none;padding:10px 14px;border-radius:999px;font-weight:800;font-size:14px;line-height:1;border:1px solid rgba(11,61,145,0.25);background:rgba(255,255,255,0.90);color:var(--primary,#0b3d91);box-shadow:0 10px 30px rgba(11,61,145,0.12)}
        .global-home-btn:hover{background:rgba(11,61,145,0.10)}
        .global-home-btn:active{transform:translateY(1px)}

        @media (max-width: 560px) {
            body { padding-top:112px !important; }
            .site-header{padding:14px 10px}
            .site-header h1{font-size:22px}
            .global-home-wrap{margin:0 0 14px 0}
            .global-home-btn{padding:9px 12px;font-size:13px}
        }
=======
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
        .flash-success, .flash-error {
            max-width:1100px;
            margin:14px auto 18px; /* espaço maior entre header e formulário */
            padding:10px 12px;
            border-radius:6px;
            font-size:14px;
        }
        .flash-success { background:#d4edda; color:#155724; }
        .flash-error { background:#f8d7da; color:#721c24; }

        /* Regras globais de aparência (movidas do footer para evitar renderizar texto) */
        .header h2, h2 { color: var(--primary,#0b3d91) !important; }
        .table-wrap { border-color: var(--primary,#0b3d91) !important; }
        .table thead th { background: linear-gradient(135deg,var(--primary,#0b3d91),var(--primary-2,#0e5bb3)) !important; color: #fff !important; }
        .btn-primary, button[type=submit] { background: linear-gradient(135deg,var(--primary,#0b3d91),var(--primary-2,#0e5bb3)) !important; color:#fff !important; }
        button[type=submit].accent, .btn-accent { background: linear-gradient(135deg,var(--accent,#ff8a00),var(--accent-2,#ff6a00)) !important; color:#fff !important; }
        .card-link:hover { background: linear-gradient(135deg,var(--primary,#0b3d91),var(--primary-2,#0e5bb3)) !important; color:#fff !important; }
        .edit-form, .create-form { background: #ffffff !important; border: 2px solid var(--primary,#0b3d91) !important; box-shadow: 0 10px 30px rgba(11,61,145,0.06) !important; }
        label { color: var(--muted,#2b3d5a) !important; }
        .edit-form select, .edit-form textarea, .edit-form input[type="text"], .edit-form input[type="number"],
        .create-form select, .create-form textarea, .create-form input[type="text"], .create-form input[type="number"] { border: 1px solid #cfe2ff !important; }
        .card, .card-icon { box-shadow: 0 10px 30px rgba(11,61,145,0.06) !important; }
        .card-icon { background: linear-gradient(135deg,var(--primary,#0b3d91),var(--primary-2,#0e5bb3)) !important; }
        .dashboard-header { background: rgba(255,255,255,0.95) !important; border-radius: 20px !important; }
        .cards-grid .card:hover { box-shadow: 0 20px 60px rgba(11,61,145,0.12) !important; border-color: var(--primary,#0b3d91) !important; }
        .empty { color: var(--muted,#2b3d5a) !important; }
        .status-badge { background: #fff4ea !important; color: var(--muted,#2b3d5a) !important; }
    </style>
</head>
<body>
<<<<<<< HEAD
=======
<header class="site-header"><h1>Sistema De Gerenciamento De Estoque</h1></header>

>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

<<<<<<< HEAD
$rotaAtual = $_GET['rota'] ?? null;
?>
<header class="site-header">
    <h1>Sistema De Gerenciamento De Estoque</h1>
</header>

<?php
=======
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
if (!empty($_SESSION['flash_success'])) {
    echo '<div class="flash-success">' . htmlspecialchars($_SESSION['flash_success']) . '</div>';
    unset($_SESSION['flash_success']);
}

if (!empty($_SESSION['flash_error'])) {
    echo '<div class="flash-error">' . htmlspecialchars($_SESSION['flash_error']) . '</div>';
    unset($_SESSION['flash_error']);
}
?>
<<<<<<< HEAD

<?php
// Botão global de retorno: será reposicionado para o lugar certo por JS
// (não exibir em login/auth, nem na home, nem no dashboard)
$rotasSemBotaoHome = ['login', 'auth', 'home', 'dashboard'];
$mostrarBotaoHome = (!empty($_SESSION['usuario']) && !in_array($rotaAtual, $rotasSemBotaoHome, true));
if ($mostrarBotaoHome) {
        echo '<div class="global-home-wrap" data-global-home-wrap data-rota="' . htmlspecialchars((string)$rotaAtual) . '" style="display:none">'
                . '<a class="global-home-btn" href="index.php?rota=home">Voltar para Home</a>'
                . '</div>';
}
?>

<?php if ($mostrarBotaoHome): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var wrap = document.querySelector('[data-global-home-wrap]');
    if (!wrap) return;

    var rota = wrap.getAttribute('data-rota') || '';
    var isCreate = /_create$/.test(rota);

    if (!isCreate) {
        // Listagens: colocar acima da tabela, ao lado do outro botão
        var actions = document.querySelector('.header .actions');
        if (actions) {
            // Garantir que os botões não fiquem sobrepostos
            actions.style.display = 'flex';
            actions.style.alignItems = 'center';
            actions.style.justifyContent = 'flex-end';
            actions.style.gap = '10px';
            actions.style.flexWrap = 'wrap';

            wrap.classList.add('global-home-wrap--in-actions');
            actions.appendChild(wrap);
        } else {
            // fallback: topo do container
            var container = document.querySelector('.container');
            if (container) {
                container.insertAdjacentElement('afterbegin', wrap);
            } else {
                document.body.insertAdjacentElement('afterbegin', wrap);
            }
        }
    } else {
        // Telas de criação: colocar abaixo do botão de submit (div.actions)
        var form = document.querySelector('form');
        var formActions = form ? form.querySelector('.actions') : null;
        wrap.classList.add('global-home-wrap--under-actions');
        if (formActions) {
            formActions.insertAdjacentElement('afterend', wrap);
        } else if (form) {
            form.appendChild(wrap);
        } else {
            var container2 = document.querySelector('.container');
            if (container2) container2.insertAdjacentElement('afterbegin', wrap);
        }
    }

    wrap.style.display = 'flex';
});
</script>
<?php endif; ?>
=======
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
