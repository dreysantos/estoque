<style>
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --accent:#ff8a00; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

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
   CONTAINER DO FORMULÁRIO
============================== */

form {
    max-width: 900px;
    margin: auto;
    background: #ffffff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
    border: none;
}


/* ==============================
   MENSAGEM DE ERRO
============================== */

.error-message {
    background: #fff4f4;
    color: #b91c1c;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    border-left: 4px solid #ef4444;
    font-weight: 600;
}


/* ==============================
   TÍTULOS
============================== */

h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 32px;
    letter-spacing: -0.5px;
    color: var(--primary);
    font-weight: 700;
}

h3 {
    margin: 30px 0 20px;
    font-size: 24px;
    color: var(--primary);
    font-weight: 700;
}


/* ==============================
   LABELS
============================== */

label {
    display: block;
    font-weight: 600;
    font-size: 14px;
    color: var(--muted);
    margin-bottom: 8px;
}


/* ==============================
   INPUTS, SELECT, TEXTAREA
============================== */

select,
input[type="number"],
textarea {
    width: 100%;
    margin-bottom: 20px;
    padding: 12px 16px;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    background: #f9fafb;
    color: #1a1a1a;
    font-size: 15px;
    transition: all 0.3s ease;
}

textarea {
    resize: vertical;
    min-height: 100px;
}


/* FOCUS */

select:focus,
input:focus,
textarea:focus {
    outline: none;
    border-color: var(--primary);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(11,61,145,0.1);
}


/* ==============================
   TABELA DE ITENS
============================== */

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    margin-bottom: 20px;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
}

th {
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #ffffff;
    text-align: left;
    padding: 12px;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.5px;
}

td {
    padding: 12px;
    border-bottom: 1px solid #f0f0f0;
}

tr:last-child td {
    border-bottom: none;
}

table input,
table select {
    margin-bottom: 0;
}


/* ==============================
   BOTÕES
============================== */

button {
    padding: 14px 28px;
    border-radius: 8px;
    border: none;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}


/* Botão principal */

button[type="submit"] {
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #ffffff;
    margin-top: 25px;
}

button[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(11,61,145,0.15);
}


/* Botão adicionar item */

button[type="button"] {
    background: #f3f4f6;
    color: var(--muted);
    padding: 10px 20px;
    border: 2px solid #e5e7eb;
    font-size: 14px;
    margin-top: 10px;
}

button[type="button"]:hover {
    background: #e5e7eb;
    border-color: var(--primary);
    color: var(--primary);
}


/* Botão remover */

td button {
    background: #ef4444;
    color: #ffffff;
    padding: 6px 12px;
    font-size: 12px;
}

td button:hover {
    background: #dc2626;
    transform: translateY(-1px);
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

<h2>Nova Saída</h2>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="error-message"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="post" action="index.php?rota=saida_create">
    <label>Solicitação (opcional)</label><br>
    <select name="id_solicitacao">
        <option value="">-- Nenhuma --</option>
        <?php foreach ($solicitacoes as $s): ?>
            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['id']) ?> - <?= htmlspecialchars($s['descricao']) ?></option>
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
        <option value="requisicao">Requisição</option>
        <option value="transferencia">Transferência</option>
        <option value="devolucao">Devolução</option>
        <option value="descarte">Descarte</option>
        <option value="ajuste">Ajuste</option>
        <option value="consumo">Consumo</option>
        <option value="doacao">Doação</option>
        <option value="venda">Venda</option>
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
                        <option value="<?= $eq['id'] ?>"><?= htmlspecialchars($eq['nome']) ?> (<?= htmlspecialchars($eq['marca']) ?>) - Qtde: <?= intval($eq['quantidade']) ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input type="number" name="quantidade[]" value="1" min="1" required></td>
            <td><button type="button" onclick="removeRow(this)">Remover</button></td>
        </tr>
    </table>

    <button type="button" onclick="addRow()">Adicionar Item</button>
    <br><br>
    <button type="submit">Salvar Saída</button>
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
        opt.text = '<?= addslashes($eq['nome']) ?> (<?= addslashes($eq['marca']) ?>) - Qtde: <?= intval($eq['quantidade']) ?>';
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
