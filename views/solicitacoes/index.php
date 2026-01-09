<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; }

/* Paleta brown/tan para combinar com create */
body { background: linear-gradient(135deg, #f8f5f2, #eee6dd, #f3eadf); min-height: 100vh; padding: 40px; color: #1f2937; }
.container { max-width: 1000px; margin: auto; }


.header { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 18px; }
.header h2 { font-size: 30px; font-weight: 800; color: #6B4F2A; }
.header .actions a { display: inline-block; text-decoration: none; background: linear-gradient(135deg, #8B5E34, #A1683A); color: #ffffff; padding: 12px 16px; border-radius: 10px; font-weight: 700; box-shadow: 0 8px 20px rgba(161, 104, 58, 0.25); transition: transform 0.2s ease, box-shadow 0.2s ease; }
.header .actions a:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(161, 104, 58, 0.35); }

.table-wrap { background: #ffffff; border-radius: 14px; border: 2px solid #8B5E34; box-shadow: 0 10px 30px rgba(139, 94, 52, 0.18); overflow: hidden; }
.table { width: 100%; border-collapse: separate; border-spacing: 0; }
.table thead th { background: linear-gradient(135deg, #8B5E34, #A1683A); color: #ffffff; text-align: left; padding: 14px 16px; font-weight: 800; font-size: 14px; }
.table tbody td { padding: 12px 16px; border-top: 1px solid #f2e9dc; font-size: 14px; color: #1f2937; }
.table tbody tr { background: #ffffff; transition: background 0.2s ease; }
.table tbody tr:nth-child(odd) { background: #fbf7f1; }
.table tbody tr:hover { background: #f6efe4; }

.empty { padding: 24px 20px; color: #5b4a36; font-weight: 600; }

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
        <?php if (!empty($lista)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Setor</th>
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
                            <td><?= htmlspecialchars($s['funcionario']) ?></td>
                            <td><?= htmlspecialchars($s['situacao']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty">Nenhuma solicitação cadastrada.</div>
        <?php endif; ?>
    </div>
</div>


