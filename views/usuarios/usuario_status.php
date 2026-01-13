<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once __DIR__ . '/../layout/header.php';
?>

<style>
.status-card{max-width:720px;margin:18px auto;padding:18px;border-radius:12px;background:#fff;border:2px solid var(--primary,#0b3d91);box-shadow:0 10px 30px rgba(11,61,145,0.06)}
.status-actions{display:flex;gap:10px;margin-top:14px}
.status-actions button{padding:10px 14px;border-radius:8px;border:none;cursor:pointer}
.status-actions .enable{background:linear-gradient(135deg,#2ecc71,#27ae60);color:#fff}
.status-actions .disable{background:linear-gradient(135deg,#e74c3c,#c0392b);color:#fff}
.info{margin-top:8px;color:#2b3d5a}
</style>

<div class="status-card">
  <h2>Gerenciar status do usuário</h2>
  <p>Você deseja desativar ou ativar o usuário?</p>

  <?php if (!empty($usuario)): ?>
    <div class="info">
      <p><strong>Usuário:</strong> <?= htmlspecialchars($usuario['nome'] ?? '') ?> (ID #<?= htmlspecialchars((string)$usuario['id'] ?? '') ?>)</p>
      <p><strong>Status atual:</strong> <?= !empty($usuario['ativo']) ? 'Ativo' : 'Inativo' ?></p>
    </div>
  <?php endif; ?>

  <?php if (isset($deps) && is_array($deps)): ?>
    <div class="info" style="display:flex;gap:16px;flex-wrap:wrap;margin-top:12px;">
      <span>Solicitações: <strong><?= (int)($deps['solicitacoes'] ?? 0) ?></strong></span>
      <span>Entradas: <strong><?= (int)($deps['entradas'] ?? 0) ?></strong></span>
      <span>Saídas: <strong><?= (int)($deps['saidas'] ?? 0) ?></strong></span>
    </div>
    <?php if (($deps['solicitacoes'] ?? 0) > 0 || ($deps['entradas'] ?? 0) > 0 || ($deps['saidas'] ?? 0) > 0): ?>
      <div class="flash-error" style="margin-top:10px;">
        Existem registros vinculados a este usuário. Recomenda-se <strong>desativar</strong> o usuário em vez de excluí-lo, ou <strong>transferir</strong> os registros antes da exclusão.
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <form method="post" action="index.php?rota=usuario_status&id=<?= htmlspecialchars((string)($_GET['id'] ?? '')) ?>" class="status-actions">
    <input type="hidden" name="status" value="1">
    <button type="submit" class="enable">Ativar</button>
  </form>

  <form method="post" action="index.php?rota=usuario_status&id=<?= htmlspecialchars((string)($_GET['id'] ?? '')) ?>" class="status-actions">
    <input type="hidden" name="status" value="0">
    <button type="submit" class="disable">Desativar</button>
  </form>

  <div class="status-actions">
    <a href="index.php?rota=usuarios" class="btn-accent" style="text-decoration:none;padding:10px 14px;border-radius:8px;">Cancelar</a>
  </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
