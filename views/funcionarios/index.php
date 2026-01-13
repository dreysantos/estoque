<style>
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --accent:#ff8a00; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

/* ==============================
   RESET BÁSICO
============================== */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', 'Segoe UI', 'Roboto', Arial, sans-serif;
}


/* ==============================
   FUNDO DA PÁGINA
============================== */

body {
    background: linear-gradient(180deg,var(--bg-1),var(--bg-2));
    min-height: 100vh;
    padding: 40px;
    color: #1a1a1a;
}


/* ==============================
   CONTAINER PRINCIPAL
============================== */

.container {
    max-width: 1200px;
    margin: auto;
}

h1, h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 36px;
    color: var(--primary);
    font-weight: 700;
    letter-spacing: -0.5px;
}


/* ==============================
   TABELA ESTILIZADA
============================== */

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
    padding: 18px 15px;
    text-align: left;
    font-weight: 700;
    font-size: 15px;
    color: #ffffff;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    border: none;
}

td {
    padding: 16px 15px;
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


/* ==============================
   BOTÕES DE AÇÃO
============================== */

.acoes {
    display: flex;
    gap: 8px;
}

.btn {
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

.btn-editar {
    background: var(--primary);
    color: #ffffff;
}

.btn-editar:hover {
    background: var(--primary-2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(11,61,145,0.2);
}

.btn-deletar {
    background: #dc2626;
    color: #ffffff;
}

.btn-deletar:hover {
    background: #b91c1c;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.4);
}

.btn-disabled {
    background: #e5e7eb;
    color: #6b7280;
    cursor: not-allowed;
    border: 1px dashed #cbd5e1;
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
}

.btn-novo:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(11,61,145,0.2);
}


/* ==============================
   RESPONSIVO
============================== */

@media (max-width: 768px) {
    body {
        padding: 15px;
    }

    h1, h2 {
        font-size: 26px;
    }

    table {
        font-size: 12px;
    }

    th, td {
        padding: 12px 8px;
    }

    .btn {
        padding: 6px 12px;
        font-size: 12px;
    }
}
</style>

<div class="container">
    <h2>Funcionários</h2>
    <a href="?rota=funcionario_create" class="btn btn-novo">+ Novo Funcionário</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Setor</th>
                <th>Matrícula</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $f): ?>
                <tr>
                    <td><?= $f['id'] ?></td>
                    <td><?= $f['nome'] ?> <?= $f['sobrenome'] ?></td>
                    <td><?= $f['setor'] ?></td>
                    <td><?= $f['numero_matricula'] ?></td>
                    <td>
                        <div class="acoes">
                            <?php if (session_status() !== PHP_SESSION_ACTIVE) session_start();
                                $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
                                if (in_array($nivel, ['avancado','administrador'])): ?>
                                <a href="?rota=funcionario_delete&id=<?= $f['id'] ?>" class="btn btn-deletar" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

