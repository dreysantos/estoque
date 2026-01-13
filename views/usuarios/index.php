<style>
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --accent:#ff8a00; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', 'Segoe UI', 'Roboto', Arial, sans-serif; }

body { background: linear-gradient(180deg,var(--bg-1),var(--bg-2)); min-height: 100vh; padding: 50px; color: #111827; }
.container { max-width: 1000px; margin: 48px auto 0 auto; }

.header { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 18px; }
.header h2 { font-size: 30px; font-weight: 800; color: var(--primary); }

.btn { display: inline-block; text-decoration: none; padding: 10px 14px; border-radius: 10px; font-weight: 700; transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease; }
.btn-primary { background: linear-gradient(90deg,var(--primary),var(--primary-2)); color: #ffffff; box-shadow: 0 8px 20px rgba(11,61,145,0.15); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(11,61,145,0.2); }
.btn-secondary { background: #f6f9fc; color: var(--primary); border: 2px solid var(--primary); padding: 8px 12px; border-radius: 8px; }
.btn-secondary:hover { background: var(--primary); color: #fff; transform: translateY(-1px); }

.legend { background: #ffffff; border: none; padding: 14px 16px; border-radius: 14px; margin-bottom: 16px; color: var(--muted); box-shadow: 0 18px 50px rgba(11,61,145,0.06); }
.legend h3 { margin: 0 0 8px 0; font-size: 14px; font-weight: 800; color: var(--primary); }
.legend ul { margin: 0; padding-left: 18px; }
.legend li { margin-bottom: 6px; font-size: 13px; }

.table-wrap { background: #ffffff; border-radius: 14px; border: none; box-shadow: 0 18px 50px rgba(11,61,145,0.06); overflow: hidden; }
.table { width: 100%; border-collapse: separate; border-spacing: 0; }
.table thead th { background: linear-gradient(90deg,var(--primary),var(--primary-2)); color: #ffffff; text-align: left; padding: 14px 16px; font-weight: 800; font-size: 14px; }
.table tbody td { padding: 12px 16px; border-top: 1px solid #f0f0f0; font-size: 14px; color: var(--muted); }
.table tbody tr { background: #ffffff; transition: background 0.2s ease; }
.table tbody tr:nth-child(odd) { background: #f9fafb; }
.table tbody tr:hover { background: #f6f9fc; }

.actions-col { white-space: nowrap; }
.actions-col .btn { margin-right: 8px; }
.btn-danger { background: #ef4444; color: #fff; border-radius: 8px; padding: 8px 12px; }
.btn-danger:hover { background: #dc2626; transform: translateY(-1px); }

.footer-actions { margin-top: 12px; text-align: center; }
.footer-actions a { color: var(--primary); font-weight: 700; text-decoration: none; }
.footer-actions a:hover { text-decoration: underline; }

@media (max-width: 768px) {
    body { padding: 26px; }
    .container { margin-top: 32px; }
    .header h2 { font-size: 24px; }
}
</style>

<div class="container">
    <div class="header">
        <h2>Usuários</h2>
        <div class="actions">
            <?php if (session_status() !== PHP_SESSION_ACTIVE) session_start();
                $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
                if (in_array($nivel, ['avancado','administrador'], true)): ?>
                <a href="index.php?rota=usuario_create" class="btn btn-primary">➕ Criar Usuário</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="legend">
        <h3>NÍVEL DE ACESSO</h3>
        <ul>
            <li><strong>Avançado & Administrador:</strong> Podem alterar tudo.</li>
            <li><strong>Médio:</strong> Gerenciar EPI, funcionário, fornecedor; fazer entrada e saída de equipamentos; fazer solicitações.</li>
            <li><strong>Básico:</strong> Pode fazer solicitação.</li>
        </ul>
    </div>

    <div class="table-wrap">
        <?php if (!empty($lista)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Funcionário</th>
                        <th>Setor</th>
                        <th>Nível</th>
                        <th>Ativo</th>
                        <th>Matrícula</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $u): ?>
                        <tr>
                            <td><?= htmlspecialchars($u['id']) ?></td>
                            <td><?= htmlspecialchars($u['usuario']) ?></td>
                            <td><?= htmlspecialchars($u['funcionario']) ?></td>
                            <td><?= htmlspecialchars($u['setor']) ?></td>
                            <td><?= htmlspecialchars($u['nivel_acesso']) ?></td>
                            <td><?= !empty($u['ativo']) ? 'Sim' : 'Não' ?></td>
                            <td><?= htmlspecialchars($u['numero_matricula']) ?></td>
                            <td class="actions-col">
                                <?php if (session_status() !== PHP_SESSION_ACTIVE) session_start();
                                $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
                                if (in_array($nivel, ['avancado','administrador'])): ?>
                                    <a href="index.php?rota=usuario_edit&id=<?= urlencode((string)$u['id']) ?>" class="btn btn-secondary">Editar</a>
                                    <a href="index.php?rota=usuario_status&id=<?= urlencode((string)$u['id']) ?>" class="btn btn-primary">Ativar/Desativar</a>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty">Nenhum usuário encontrado.</div>
        <?php endif; ?>
    </div>

    <div class="footer-actions">
        <a href="index.php?rota=dashboard">⬅ Voltar para Dashboard</a>
    </div>
</div>
