<style>
/* ==============================
   RESET BÁSICO
============================== */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
}


/* ==============================
   FUNDO DA PÁGINA
============================== */

body {
    background: linear-gradient(135deg, #f5f7fa, #ffffff, #e8eef7);
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
    color: #0f2027;
    font-weight: 700;
    letter-spacing: 1px;
}


/* ==============================
   TABELA ESTILIZADA
============================== */

table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e0e6ed;
}

thead {
    background: linear-gradient(90deg, #1a73e8, #1f5fb8);
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
    border-bottom: 1px solid #e8eef7;
    color: #333333;
    font-size: 14px;
}

tbody tr {
    transition: all 0.3s ease;
}

tbody tr:hover {
    background: #f8fafc;
    box-shadow: inset 0 0 10px rgba(26, 115, 232, 0.08);
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
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-editar {
    background: #1a73e8;
    color: #ffffff;
}

.btn-editar:hover {
    background: #1557b0;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(26, 115, 232, 0.3);
}

.btn-deletar {
    background: #d32f2f;
    color: #ffffff;
}

.btn-deletar:hover {
    background: #b71c1c;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(211, 47, 47, 0.3);
}

.btn-novo {
    background: linear-gradient(135deg, #1a73e8, #1f5fb8);
    color: #ffffff;
    padding: 12px 24px;
    font-size: 15px;
    margin-bottom: 25px;
    display: inline-block;
    border: none;
}

.btn-novo:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(26, 115, 232, 0.3);
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


