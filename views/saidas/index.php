<style>
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --accent:#ff8a00; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', 'Segoe UI', 'Roboto', Arial, sans-serif;
}

body {
    background: linear-gradient(180deg,var(--bg-1),var(--bg-2));
    min-height: 100vh;
    padding: 40px;
    color: #1a1a1a;
}

.container {
    max-width: 1200px;
    margin: auto;
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 36px;
    color: var(--primary);
    font-weight: 700;
    letter-spacing: -0.5px;
}

.btn-novo {
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #ffffff;
    padding: 12px 24px;
    font-size: 15px;
    margin-bottom: 25px;
    display: inline-block;
    border: none;
    border-radius: 8px;
    box-shadow: 0 8px 20px rgba(11,61,145,0.15);
    text-decoration: none;
    font-weight: 700;
}

.btn-novo:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(11,61,145,0.2);
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
    border-radius: 12px;
    overflow: hidden;
    border: none;
}

thead {
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
}

th {
    padding: 16px 14px;
    text-align: left;
    font-weight: 700;
    font-size: 14px;
    color: #ffffff;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

td {
    padding: 14px 14px;
    border-bottom: 1px solid #f0f0f0;
    color: var(--muted);
    font-size: 14px;
}

tbody tr {
    transition: all 0.3s ease;
}

tbody tr:hover {
    background: #f6f9fc;
}

tbody tr:last-child td {
    border-bottom: none;
}

.acoes { display: flex; gap: 8px; }
.btn { padding: 8px 14px; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; font-size: 13px; transition: all 0.3s ease; }
.btn-editar { background: var(--primary); color: #fff; }
.btn-editar:hover { background: var(--primary-2); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(11,61,145,0.2); }
.btn-deletar { background: #dc2626; color: #fff; }
.btn-deletar:hover { background: #b91c1c; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(220, 38, 38, 0.35); }

@media (max-width: 768px) {
    body { padding: 15px; }
    h2 { font-size: 26px; }
    th, td { padding: 12px 10px; }
}
</style>

<div class="container">
    <h2>Saídas</h2>
    <a href="index.php?rota=saida_create" class="btn btn-novo">+ Nova Saída</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Solicitação</th>
                <th>Data</th>
                <th>Tipo</th>
                <th>Funcionário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $s): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><?= $s['id_solicitacao'] ?></td>
                <td><?= $s['data_registro'] ?></td>
                <td><?= $s['tipo'] ?></td>
                <td><?= $s['funcionario'] ?></td>
                <td>
                    <div class="acoes">
                        <?php if (session_status() !== PHP_SESSION_ACTIVE) session_start();
                            $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
                            if (in_array($nivel, ['avancado','administrador'])): ?>
                            <a href="index.php?rota=saida_edit&id=<?= $s['id'] ?>" class="btn btn-editar">Editar</a>
                            <a href="index.php?rota=saida_delete&id=<?= $s['id'] ?>" class="btn btn-deletar" onclick="return confirm('Tem certeza?')">Deletar</a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
