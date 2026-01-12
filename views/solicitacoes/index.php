<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; }

/* Paleta: Dax/Alpha - Navy (primária) + Laranja (acento) */
body { background: linear-gradient(135deg, #f4f7fb, #eef6ff); min-height: 100vh; padding: 40px; color: #1f2937; }
.container { max-width: 1000px; margin: auto; }

.header { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 18px; }
.header h2 { font-size: 30px; font-weight: 800; color: #0b3d91; }
.header .actions a { display: inline-block; text-decoration: none; background: linear-gradient(135deg, #0b3d91, #0e5bb3); color: #ffffff; padding: 12px 16px; border-radius: 10px; font-weight: 700; box-shadow: 0 8px 20px rgba(11, 61, 145, 0.18); transition: transform 0.2s ease, box-shadow 0.2s ease; }
.header .actions a:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(14, 91, 179, 0.25); }

.table-wrap { background: #ffffff; border-radius: 14px; border: 2px solid #0b3d91; box-shadow: 0 10px 30px rgba(11, 61, 145, 0.08); overflow: hidden; }
.table { width: 100%; border-collapse: separate; border-spacing: 0; }
.table thead th { background: linear-gradient(135deg, #0b3d91, #0e5bb3); color: #ffffff; text-align: left; padding: 14px 16px; font-weight: 800; font-size: 14px; }
.table tbody td { padding: 12px 16px; border-top: 1px solid #e6eefc; font-size: 14px; color: #1f2937; }
.table tbody tr { background: #ffffff; transition: background 0.2s ease; }
.table tbody tr:nth-child(odd) { background: #f8fbff; }
.table tbody tr:hover { background: #eaf2ff; }

.empty { padding: 24px 20px; color: #2b3d5a; font-weight: 600; }

@media (max-width: 768px) {
    body { padding: 20px; }
    .header h2 { font-size: 24px; }
    .header .actions a { padding: 10px 14px; }
}
</style>

<div class="container">
    <div class="header">
        <h2>Solicitações</h2>
        <div class="actions">
            <a href="index.php?rota=solicitacoes_create">➕ Nova Solicitação</a>
        </div>
    </div>

    <div class="table-wrap">
        <?php
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $isAdmin = isset($_SESSION['usuario']) && (($_SESSION['usuario']['nivel_acesso'] ?? '') === 'administrador');
        ?>
        <?php if (!empty($lista)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Setor</th>
                        <th>Descrição</th>
                        <th>Funcionário</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $s): ?>
                        <tr>
                            <td><?= htmlspecialchars($s['id']) ?></td>
                            <td><?= htmlspecialchars($s['data_registro']) ?></td>
                            <td><?= htmlspecialchars($s['setor']) ?></td>
                            <td><?= htmlspecialchars($s['descricao'] ?? '') ?></td>
                            <td><?= htmlspecialchars($s['funcionario']) ?></td>
                            <td>
                                <?php if ($isAdmin): ?>
                                    <div style="display:flex;gap:8px;align-items:center;">
                                        <span style="padding:6px 8px;background:#faf5ef;border:1px solid #efe1d0;border-radius:6px;color:#3b2b1f;"><?= htmlspecialchars(ucfirst($s['situacao'] ?? '')) ?></span>
                                        <a href="index.php?rota=solicitacoes_edit&id=<?= htmlspecialchars($s['id']) ?>" style="display:inline-block;padding:6px 8px;background:#f3efe9;border:1px solid #d0c6ba;border-radius:6px;text-decoration:none;color:#3b2b1f;">Editar</a>
                                    </div>
                                <?php else: ?>
                                    <?= htmlspecialchars($s['situacao'] ?? '') ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty">Nenhuma solicitação cadastrada.</div>
        <?php endif; ?>
    </div>
</div>


