<style>
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --accent:#ff8a00; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', 'Segoe UI', 'Roboto', Arial, sans-serif;
}

body{
    background: linear-gradient(180deg,var(--bg-1),var(--bg-2));
    min-height: 100vh;
    padding: 40px;
    color: #1a1a1a;
}

.container{
    max-width: 1200px;
    margin: auto;
}

h2{
    text-align: center;
    margin-bottom: 30px;
    font-size: 36px;
    color: var(--primary);
    font-weight: 700;
    letter-spacing: -0.5px;
}

.acoes{ display: flex; gap: 8px; }

.btn{
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-novo{
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #ffffff;
    padding: 12px 24px;
    font-size: 15px;
    margin-bottom: 25px;
    display: inline-block;
    border: none;
    border-radius: 8px;
    box-shadow: 0 8px 20px rgba(11,61,145,0.15);
}

.btn-novo:hover{
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(11,61,145,0.2);
}

.btn-editar{ background: var(--primary); color: #fff; }
.btn-editar:hover{ background: var(--primary-2); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(11,61,145,0.2); }

.btn-ver{ background: #0ea5e9; color: #fff; }
.btn-ver:hover{ background: #0284c7; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(2, 132, 199, 0.28); }

.btn-deletar{ background: #dc2626; color: #fff; }
.btn-deletar:hover{ background: #b91c1c; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(220, 38, 38, 0.35); }

table{
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
    border-radius: 12px;
    overflow: hidden;
    border: none;
}

thead{
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
}

th{
    padding: 16px 14px;
    text-align: left;
    font-weight: 700;
    font-size: 14px;
    color: #ffffff;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

td{
    padding: 14px 14px;
    border-bottom: 1px solid #f0f0f0;
    color: var(--muted);
    font-size: 14px;
}

tbody tr{ transition: all 0.3s ease; }
tbody tr:hover{ background: #f6f9fc; }
tbody tr:last-child td{ border-bottom: none; }

@media (max-width: 768px) {
    body { padding: 15px; }
    h2 { font-size: 26px; }
    th, td { padding: 12px 10px; }
    .btn { padding: 6px 12px; font-size: 12px; }
}
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
                            <a href="?rota=entrada_show&id=<?= urlencode((string)$e['id']) ?>" class="btn btn-ver">Produtos</a>
                            <?php if (session_status() !== PHP_SESSION_ACTIVE) session_start();
                                $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
                                if (in_array($nivel, ['avancado','administrador'])): ?>
                                <span style="color: var(--muted); font-weight: 600;">—</span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


