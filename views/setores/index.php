<style>
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --accent:#ff8a00; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', 'Segoe UI', 'Roboto', Arial, sans-serif; }

body { background: linear-gradient(180deg,var(--bg-1),var(--bg-2)); min-height: 100vh; padding: 50px; color: #0f172a; }
.container { max-width: 1000px; margin: 48px auto 0 auto; }

.header { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 18px; }
.header h2 { font-size: 30px; font-weight: 800; color: #0f172a; }
.header .actions a {
    display: inline-block;
    text-decoration: none;
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #ffffff;
    padding: 12px 16px;
    border-radius: 10px;
    font-weight: 700;
    box-shadow: 0 8px 20px rgba(11,61,145,0.15);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.header .actions a:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(11,61,145,0.2); }

.table-wrap { background: #ffffff; border-radius: 14px; border: none; box-shadow: 0 18px 50px rgba(11,61,145,0.06); overflow: hidden; }
.table { width: 100%; border-collapse: separate; border-spacing: 0; }
.table thead th { background: linear-gradient(90deg,var(--primary),var(--primary-2)); color: #ffffff; text-align: left; padding: 14px 16px; font-weight: 800; font-size: 14px; }
.table tbody td { padding: 12px 16px; border-top: 1px solid #f0f0f0; font-size: 14px; color: var(--muted); }
.table tbody tr { background: #ffffff; transition: background 0.2s ease; }
.table tbody tr:nth-child(odd) { background: #f9fafb; }
.table tbody tr:hover { background: #f6f9fc; }

.btn-editar {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 8px;
    text-decoration: none;
    background: var(--primary);
    color: #fff;
    font-weight: 700;
    font-size: 12px;
    margin-right: 8px;
    transition: all 0.3s ease;
}
.btn-editar:hover {
    background: var(--primary-2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(11,61,145,0.2);
}

.btn-deletar {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 8px;
    text-decoration: none;
    background: #ef4444;
    color: #fff;
    font-weight: 700;
    font-size: 12px;
    transition: all 0.3s ease;
}
.btn-deletar:hover {
    background: #dc2626;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239,68,68,0.3);
}

.empty { padding: 24px 20px; color: #334155; font-weight: 600; }

@media (max-width: 768px) {
    body { padding: 26px; }
    .container { margin-top: 32px; }
    .header h2 { font-size: 24px; }
    .header .actions a { padding: 10px 14px; }
}
</style>

<div class="container">
    <div class="header">
        <h2>Setores</h2>
        <div class="actions">
            <a href="index.php?rota=setor_create">+ Novo Setor</a>
        </div>
    </div>

    <div class="table-wrap">
        <?php if (!empty($lista)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $s): ?>
                        <tr>
                            <td><?= $s['id'] ?></td>
                            <td><?= $s['nome'] ?></td>
                            <td><?= htmlspecialchars($s['descricao']) ?></td>
                            <td>
                                <?php
                                    $telefone = $s['telefone'];
                                    if(strlen($s['telefone']) == 8)
                                    {
                                        $telefone = substr($s['telefone'],0,4)."-".substr($s['telefone'],4,4);
                                    }
                                    else if(strlen($s['telefone']) == 9)
                                    {
                                        $telefone = substr($s['telefone'],0,1)." ".substr($s['telefone'],1,4)."-".substr($s['telefone'],5,4);
                                    }
                                    else if(strlen($s['telefone']) == 11)
                                    {
                                        $telefone = "(".substr($s['telefone'],0,2).") ".substr($s['telefone'],2,1)." ".substr($s['telefone'],3,4)."-".substr($s['telefone'],7,4);
                                    }
                                ?>
                                <?=$telefone?>
                            </td>
                            <td>
                                <a href="index.php?rota=setor_edit&id=<?= $s['id'] ?>" class="btn-editar">
                                    Editar
                                </a>
                                <a href="index.php?rota=setor_delete&id=<?= $s['id'] ?>" class="btn-deletar" onclick="return confirm('Tem certeza que deseja deletar este setor?')">
                                    Deletar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty">Nenhum setor cadastrado.</div>
        <?php endif; ?>
    </div>
</div>

