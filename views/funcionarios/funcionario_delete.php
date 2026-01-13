<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once __DIR__ . '/../layout/header.php';
?>

<div class="edit-form" style="max-width:720px;margin:18px auto;padding:18px;border-radius:12px;">
    <h2>Confirmar exclusão</h2>

    <?php if (!empty($funcionario)): ?>
        <p>Você está prestes a excluir o funcionário:
            <strong><?= htmlspecialchars(($funcionario['nome'] ?? '') . ' ' . ($funcionario['sobrenome'] ?? '')) ?></strong>
            (ID #<?= htmlspecialchars((string)($funcionario['id'] ?? '')) ?>)
        </p>
    <?php endif; ?>

    <?php if (!empty($temUsuario)): ?>
        <div class="flash-error" style="margin-top:12px;">
            Existe pelo menos um usuário vinculado a este funcionário.
            Você pode desativar o usuário na tela de usuários ou, se não houver registros vinculados (solicitações/entradas/saídas), optar por excluí-lo abaixo.
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?rota=funcionario_delete&id=<?= htmlspecialchars((string)($_GET['id'] ?? '')) ?>" style="margin-top:16px;display:flex;flex-direction:column;gap:10px;">
        <?php if (!empty($temUsuario)): ?>
            <label style="display:flex;align-items:center;gap:8px;">
                <input type="checkbox" name="also_delete_user" value="1">
                Excluir também o(s) usuário(s) vinculado(s)
            </label>
        <?php endif; ?>

        <div style="display:flex;gap:10px;margin-top:12px;">
            <button type="submit" class="btn-primary">Confirmar exclusão</button>
            <a href="index.php?rota=funcionarios" class="btn-accent" style="text-decoration:none;padding:10px 14px;border-radius:8px;">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
