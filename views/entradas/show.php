<style>
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --accent:#ff8a00; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

*{ margin:0; padding:0; box-sizing:border-box; font-family:'Inter','Segoe UI','Roboto',Arial,sans-serif; }

body{
    background: linear-gradient(180deg,var(--bg-1),var(--bg-2));
    min-height: 100vh;
    padding: 40px;
    color: #111827;
}

.container{ max-width: 1100px; margin: 0 auto; }

.header{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    gap: 16px;
    margin-bottom: 18px;
}

h2{ font-size: 34px; font-weight: 800; color: var(--primary); letter-spacing: -0.5px; }

.meta{
    background:#fff;
    border-radius: 14px;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
    padding: 16px;
    margin-bottom: 16px;
    color: var(--muted);
}

.meta strong{ color: #111827; }

.table-wrap{ background:#fff; border-radius: 14px; box-shadow: 0 18px 50px rgba(11,61,145,0.06); overflow:hidden; }

table{ width:100%; border-collapse: collapse; }

thead{ background: linear-gradient(90deg,var(--primary),var(--primary-2)); }

th{ padding: 14px 14px; text-align:left; font-weight: 800; font-size: 13px; color:#fff; text-transform: uppercase; letter-spacing: 0.5px; }

td{ padding: 12px 14px; border-bottom: 1px solid #f0f0f0; color: var(--muted); font-size: 14px; }

tr:last-child td{ border-bottom:none; }

.actions{ display:flex; gap: 10px; }

.btn{
    display:inline-block;
    text-decoration:none;
    border:none;
    border-radius: 10px;
    padding: 10px 14px;
    font-weight: 800;
    cursor: pointer;
    transition: transform .2s ease, box-shadow .2s ease;
}

.btn-primary{ background: linear-gradient(90deg,var(--primary),var(--primary-2)); color:#fff; box-shadow: 0 8px 20px rgba(11,61,145,0.15); }
.btn-primary:hover{ transform: translateY(-2px); box-shadow: 0 10px 24px rgba(11,61,145,0.2); }

.empty{ padding: 16px; color: var(--muted); }

@media (max-width: 768px){
    body{ padding: 18px; }
    h2{ font-size: 26px; }
}
</style>

<div class="container">
    <div class="header">
        <h2>Produtos da Entrada #<?= htmlspecialchars((string)($entrada['id'] ?? '')) ?></h2>
        <div class="actions">
            <a class="btn btn-primary" href="index.php?rota=entradas">⬅ Voltar</a>
        </div>
    </div>

    <div class="meta">
        <div><strong>Data:</strong> <?= htmlspecialchars((string)($entrada['data_registro'] ?? '—')) ?></div>
        <div><strong>Tipo:</strong> <?= htmlspecialchars((string)($entrada['tipo'] ?? '—')) ?></div>
        <div><strong>Situação:</strong> <?= htmlspecialchars((string)($entrada['situacao'] ?? '—')) ?></div>
        <div><strong>Fornecedor:</strong> <?= htmlspecialchars((string)($entrada['fornecedor'] ?? '—')) ?></div>
        <div><strong>Funcionário:</strong> <?= htmlspecialchars((string)($entrada['funcionario'] ?? '—')) ?></div>
        <?php if (!empty($entrada['descricao'])): ?>
            <div style="margin-top: 8px;"><strong>Descrição:</strong> <?= htmlspecialchars((string)$entrada['descricao']) ?></div>
        <?php endif; ?>
    </div>

    <div class="table-wrap">
        <?php if (!empty($itens)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Equipamento</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                        <th>Quantidade</th>
                        <th>CA</th>
                        <th>Validade CA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itens as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars((string)$item['nome']) ?></td>
                            <td><?= htmlspecialchars((string)$item['marca']) ?></td>
                            <td><?= htmlspecialchars((string)$item['tipo']) ?></td>
                            <td><?= htmlspecialchars((string)$item['quantidade']) ?></td>
                            <td><?= htmlspecialchars((string)$item['ca']) ?></td>
                            <td><?= htmlspecialchars((string)$item['ca_validade']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty">Nenhum produto registrado nesta entrada.</div>
        <?php endif; ?>
    </div>
</div>
