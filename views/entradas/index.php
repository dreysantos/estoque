<style>
/* Theme: Dax/Alpha palette (navy + orange accent) */
:root{
    --primary:#0b3d91;
    --primary-2:#0e5bb3;
    --accent:#ff8a00;
    --accent-2:#ff6a00;
    --bg-1:#f4f7fb;
    --bg-2:#eef6ff;
    --muted:#2b3d5a;
}

body{
    background: linear-gradient(135deg,var(--bg-1),var(--bg-2));
    color: #1f2937;
}

/* Header */
.header h2, h2{ color: var(--primary); }
.header .actions a, .btn-primary{ background: linear-gradient(135deg,var(--primary),var(--primary-2)); color:#fff; }

/* Accent button */
button[type="submit"], .btn-accent{ background: linear-gradient(135deg,var(--accent),var(--accent-2)); color:#fff; }

/* Table */
.table-wrap{ border-color: var(--primary); }
.table thead th{ background: linear-gradient(135deg,var(--primary),var(--primary-2)); color:#fff; }
.table tbody tr:nth-child(odd){ background:#f8fbff; }
.table tbody tr:hover{ background:#eaf2ff; }

/* Card links */
.card-link:hover{ background: linear-gradient(135deg,var(--primary),var(--primary-2)); color:#fff; border-color:var(--primary); }

/* Small helpers */
.back a{ color: var(--primary); }

/* Ensure readable badges */
.status-badge{ padding:6px 8px; background:#faf5ef; border-radius:6px; color:var(--muted); }
</style>

<div class="container">
    <h2>Entradas</h2>
    <a href="?rota=entrada_create" class="btn btn-novo">+ Nova Entrada</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Tipo</th>
                <th>Situação</th>
                <th>Fornecedor</th>
                <th>Funcionário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $e): ?>
                <tr>
                    <td><?= $e['id'] ?></td>
                    <td><?= $e['data_registro'] ?></td>
                    <td><?= $e['tipo'] ?></td>
                    <td><?= $e['situacao'] ?></td>
                    <td><?= $e['fornecedor'] ?></td>
                    <td><?= $e['funcionario'] ?></td>
                    <td>
                        <div class="acoes">
                            <a href="?rota=entrada_edit&id=<?= $e['id'] ?>" class="btn btn-editar">Editar</a>
                            <a href="?rota=entrada_delete&id=<?= $e['id'] ?>" class="btn btn-deletar" onclick="return confirm('Tem certeza?')">Deletar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


