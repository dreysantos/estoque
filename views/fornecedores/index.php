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
    background: linear-gradient(135deg, #E0FFFF, #D0F5F5, #C0EDED, #B0E5E5);
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
    background: linear-gradient(135deg, #4A9A9A, #3A7A7A);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
    letter-spacing: 1px;
}


/* ==============================
   TABELA ESTILIZADA
============================== */

table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    box-shadow: 0 12px 40px rgba(160, 200, 200, 0.2);
    border-radius: 12px;
    overflow: hidden;
    border: 2px solid #B0E5E5;
}

thead {
    background: linear-gradient(90deg, #70CFCF, #5AAFAF);
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
    border-bottom: 1px solid #E0FFFF;
    color: #2A6A6A;
    font-size: 14px;
}

tbody tr {
    transition: all 0.3s ease;
}

tbody tr:hover {
    background: #F0FFFF;
    box-shadow: inset 0 0 10px rgba(112, 207, 207, 0.12);
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
    background: #70CFCF;
    color: #ffffff;
}

.btn-editar:hover {
    background: #5AAFAF;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(112, 207, 207, 0.35);
}

.btn-deletar {
    background: #4A9A9A;
    color: #ffffff;
}

.btn-deletar:hover {
    background: #3A7A7A;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(58, 122, 122, 0.35);
}

.btn-novo {
    background: linear-gradient(135deg, #70CFCF, #5AAFAF);
    color: #ffffff;
    padding: 12px 24px;
    font-size: 15px;
    margin-bottom: 25px;
    display: inline-block;
    border: none;
    box-shadow: 0 6px 20px rgba(112, 207, 207, 0.3);
}

.btn-novo:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(244, 63, 94, 0.5);
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
    <h2>Fornecedores</h2>
    <a href="?rota=fornecedor_create" class="btn btn-novo">+ Novo Fornecedor</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Fantasia</th>
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $f): ?>
                <tr>
                    <td><?= $f['id'] ?></td>
                    <td><?= $f['nome_fantasia'] ?></td>
                    <td><?= $f['razao_social'] ?></td>
                    <td>
                        <?php
                            $cnpj = $f['cnpj'];
                            if(strlen($cnpj) == 14)
                                $cnpj = substr($f['cnpj'],0,2).".".substr($f['cnpj'],2,3).".".substr($f['cnpj'],5,3)."/".substr($f['cnpj'],8,4)."-".substr($f['cnpj'],12,2);
                        ?>
                        <?= $cnpj ?>
                    </td>
                    <td>
                        <div class="acoes">
                            <a href="?rota=fornecedor_edit&id=<?= $f['id'] ?>" class="btn btn-editar">Editar</a>
                            <a href="?rota=fornecedor_delete&id=<?= $f['id'] ?>" class="btn btn-deletar" onclick="return confirm('Tem certeza?')">Deletar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

