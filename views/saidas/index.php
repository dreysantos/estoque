<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
}

/* Fundo claro com tom âmbar (sem rosa) */
body {
    background: linear-gradient(135deg, #fff7ed, #ffedd5, #fde68a);
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
    color: #b45309;
    font-weight: 800;
    letter-spacing: 1px;
}

.btn-novo {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #ffffff;
    padding: 12px 24px;
    font-size: 15px;
    margin-bottom: 25px;
    display: inline-block;
    border: none;
    border-radius: 8px;
    box-shadow: 0 6px 18px rgba(245, 158, 11, 0.35);
    text-decoration: none;
    font-weight: 700;
}

.btn-novo:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(245, 158, 11, 0.45);
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    box-shadow: 0 10px 30px rgba(217, 119, 6, 0.2);
    border-radius: 12px;
    overflow: hidden;
    border: 2px solid #f59e0b;
}

thead {
    background: linear-gradient(90deg, #f59e0b, #d97706);
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
    border-bottom: 1px solid #ffedd5;
    color: #7c2d12;
    font-size: 14px;
}

tbody tr {
    transition: all 0.3s ease;
}

tbody tr:hover {
    background: #fff7ed;
    box-shadow: inset 0 0 10px rgba(217, 119, 6, 0.12);
}

.acoes { display: flex; gap: 8px; }
.btn { padding: 8px 14px; border-radius: 6px; border: none; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; font-size: 13px; transition: all 0.3s ease; }
.btn-editar { background: #f59e0b; color: #fff; }
.btn-editar:hover { background: #d97706; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(217, 119, 6, 0.35); }
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
