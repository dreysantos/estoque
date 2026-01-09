<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1 style="color: black; margin-bottom: 24px;">Sistema De Gerenciamento De Estoque </h1>

<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!empty($_SESSION['flash_success'])) {
    echo '<div style="background:#d4edda;color:#155724;padding:8px;border-radius:4px;margin-bottom:8px;">' . htmlspecialchars($_SESSION['flash_success']) . '</div>';
    unset($_SESSION['flash_success']);
}

if (!empty($_SESSION['flash_error'])) {
    echo '<div style="background:#f8d7da;color:#721c24;padding:8px;border-radius:4px;margin-bottom:8px;">' . htmlspecialchars($_SESSION['flash_error']) . '</div>';
    unset($_SESSION['flash_error']);
}
?>
