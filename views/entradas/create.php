<style>
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
    background: linear-gradient(135deg, #f5f7fa, #ffffff, #f0f4f8);
    min-height: 100vh;
    padding: 40px;
    color: #1a1a1a;
}


/* ==============================
   CONTAINER DO FORMULÁRIO
============================== */

form {
    max-width: 900px;
    margin: auto;
    background: #ffffff;
    padding: 35px;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    border: 2px solid #1a73e8;
}


/* ==============================
   TÍTULOS
============================== */

h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 32px;
    letter-spacing: 1px;
    color: #1a73e8;
}

h3 {
    margin: 30px 0 15px;
    font-size: 22px;
    color: #1f5fb8;
    border-left: 4px solid #1a73e8;
    padding-left: 10px;
}


/* ==============================
   LABELS
============================== */

label {
    font-weight: 600;
    font-size: 14px;
    color: #333333;
}


/* ==============================
   INPUTS, SELECT, TEXTAREA
============================== */

select,
input[type="number"],
textarea {
    width: 100%;
    margin-top: 6px;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #d0d7de;
    background: #ffffff;
    color: #1a1a1a;
    font-size: 14px;
    transition: all 0.3s ease;
}

textarea {
    resize: vertical;
    min-height: 90px;
}


/* FOCUS */

select:focus,
input:focus,
textarea:focus {
    outline: none;
    border-color: #1a73e8;
    box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.15);
}


/* ==============================
   TABELA DE ITENS
============================== */

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th {
    background: linear-gradient(90deg, #1a73e8, #1f5fb8);
    color: #ffffff;
    text-align: left;
    padding: 14px;
    font-size: 14px;
    letter-spacing: 0.5px;
}

td {
    padding: 12px;
    background: #f8fafc;
    border-bottom: 1px solid #e0e6ed;
}

tr:hover td {
    background: #f0f7ff;
}


/* ==============================
   BOTÕES
============================== */

button {
    padding: 12px 22px;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    letter-spacing: 0.5px;
}


/* Botão principal */

button[type="submit"],
form>button:last-of-type {
    background: linear-gradient(135deg, #1a73e8, #1f5fb8);
    color: #ffffff;
    margin-top: 25px;
}

button[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(26, 115, 232, 0.3);
}


/* Botão adicionar item */

button[type="button"] {
    background: #f0f4f8;
    color: #1a73e8;
    border: 2px solid #1a73e8;
}

button[type="button"]:hover {
    background: #1a73e8;
    color: #ffffff;
}


/* Botão remover */

td button {
    background: #d32f2f;
    color: #ffffff;
    padding: 8px 14px;
}

td button:hover {
    background: #b71c1c;
}


/* ==============================
   RESPONSIVO
============================== */

@media (max-width: 768px) {
    body {
        padding: 15px;
    }
    form {
        padding: 25px;
    }
    table,
    thead,
    tbody,
    th,
    td,
    tr {
        font-size: 13px;
    }
    h2 {
        font-size: 26px;
    }
}
</style>
<h2>Nova Entrada</h2>

<form method="post" action="index.php?rota=entrada_create">
    <label>Fornecedor (opcional)</label><br>
    <select name="id_fornecedor">
        <option value="">-- Nenhum --</option>
        <?php foreach ($fornecedores as $f): ?>
            <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['nome_fantasia']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Usuário</label><br>
    <select name="id_usuario" required>
        <option value="">Selecione</option>
        <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['usuario']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Tipo</label><br>
    <select name="tipo" required>
        <option value="compra">Compra</option>
        <option value="doacao">Doação</option>
        <option value="transferencia">Transferência</option>
        <option value="devolucao">Devolução</option>
        <option value="ajuste">Ajuste</option>
    </select><br><br>

    <label>Descrição</label><br>
    <textarea name="descricao"></textarea><br><br>

    <h3>Itens</h3>
    <table id="itens">
        <tr>
            <th>Equipamento</th>
            <th>Quantidade</th>
            <th></th>
        </tr>
        <tr>
            <td>
                <select name="equipamento_id[]" required>
                    <option value="">Selecione</option>
                    <?php foreach ($equipamentos as $eq): ?>
                        <option value="<?= $eq['id'] ?>"><?= htmlspecialchars($eq['nome']) ?> (<?= htmlspecialchars($eq['marca']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input type="number" name="quantidade[]" value="1" min="1" required></td>
            <td><button type="button" onclick="removeRow(this)">Remover</button></td>
        </tr>
    </table>

    <button type="button" onclick="addRow()">Adicionar Item</button>
    <br><br>
    <button>Salvar Entrada</button>
</form>

<script>
function addRow() {
    const table = document.getElementById('itens');
    const row = table.insertRow(-1);
    const cell1 = row.insertCell(0);
    const cell2 = row.insertCell(1);
    const cell3 = row.insertCell(2);

    const sel = document.createElement('select');
    sel.name = 'equipamento_id[]';
    sel.required = true;
    const defaultOpt = document.createElement('option');
    defaultOpt.value = '';
    defaultOpt.text = 'Selecione';
    sel.appendChild(defaultOpt);
    <?php foreach ($equipamentos as $eq): ?>
        var opt = document.createElement('option');
        opt.value = '<?= $eq['id'] ?>';
        opt.text = '<?= addslashes($eq['nome']) ?> (<?= addslashes($eq['marca']) ?>)';
        sel.appendChild(opt);
    <?php endforeach; ?>

    const input = document.createElement('input');
    input.type = 'number';
    input.name = 'quantidade[]';
    input.value = 1;
    input.min = 1;
    input.required = true;

    const btn = document.createElement('button');
    btn.type = 'button';
    btn.textContent = 'Remover';
    btn.onclick = function() { removeRow(btn); };

    cell1.appendChild(sel);
    cell2.appendChild(input);
    cell3.appendChild(btn);
}

function removeRow(btn) {
    const row = btn.closest('tr');
    if (row && row.parentNode.rows.length > 2) {
        row.parentNode.removeChild(row);
    }
}
</script>

