<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; }

/* Paleta crimson/cream para combinar com create */
body { background: linear-gradient(135deg, #fff7f0, #f9f3ee, #fdeee6); min-height: 100vh; padding: 50px; color: #111827; }
.container { max-width: 1000px; margin: 48px auto 0 auto; }

.header { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 18px; }
.header h2 { font-size: 30px; font-weight: 800; color: #7f1d1d; }
.header .actions a { display: inline-block; text-decoration: none; background: linear-gradient(135deg, #F5DEB3, #E6CF9F); color: #1a1a1a; padding: 12px 16px; border-radius: 10px; font-weight: 700; box-shadow: 0 8px 20px rgba(245, 222, 179, 0.25); transition: transform 0.2s ease, box-shadow 0.2s ease; }
.header .actions a:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(245, 222, 179, 0.35); }

.table-wrap { background: #ffffff; border-radius: 14px; border: 2px solid #F5DEB3; box-shadow: 0 10px 30px rgba(245, 222, 179, 0.16); overflow: hidden; }
.table { width: 100%; border-collapse: separate; border-spacing: 0; }
.table thead th { background: linear-gradient(135deg, #F5DEB3, #E6CF9F); color: #1a1a1a; text-align: left; padding: 14px 16px; font-weight: 800; font-size: 14px; }
.table tbody td { padding: 12px 16px; border-top: 1px solid #faf5ef; font-size: 14px; color: #111827; }
.table tbody tr { background: #ffffff; transition: background 0.2s ease; }
.table tbody tr:nth-child(odd) { background: #fefdfb; }
.table tbody tr:hover { background: #faf5ef; }

.footer-actions { margin-top: 12px; text-align: center; }
.footer-actions a { color: #C4A661; font-weight: 700; text-decoration: none; }
.footer-actions a:hover { text-decoration: underline; }

@media (max-width: 768px) {
    body { padding: 26px; }
    .container { margin-top: 32px; }
    .header h2 { font-size: 24px; }
    .header .actions a { padding: 10px 14px; }
}
</style>

<div class="container">
    <div class="header">
        <h2>Usuários</h2>
        <div class="actions">
            <a href="index.php?rota=usuario_create">➕ Criar Usuário</a>
        </div>
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
