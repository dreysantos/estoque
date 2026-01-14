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
<header class="site-header"><h1>Sistema De Gerenciamento De Estoque</h1></header>

<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!empty($_SESSION['flash_success'])) {
    echo '<div class="flash-success">' . htmlspecialchars($_SESSION['flash_success']) . '</div>';
    unset($_SESSION['flash_success']);
}

if (!empty($_SESSION['flash_error'])) {
    echo '<div class="flash-error">' . htmlspecialchars($_SESSION['flash_error']) . '</div>';
    unset($_SESSION['flash_error']);
}
?>
