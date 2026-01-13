<?php require_once __DIR__ . '/../layout/header.php'; ?>

<style>
/* Theme: Dax/Alpha palette (navy + orange accent) */
:root{
    --primary:#0b3d91;
    --primary-2:#0e5bb3;
    --accent:#ff8a00;
    --accent-2:#ff6a00;
    --bg-1:#f4f7fb;
    --bg-2:#eef6ff;
    --muted:#536776;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', 'Segoe UI', 'Roboto', Arial, sans-serif;
}

body{
    background: linear-gradient(180deg,var(--bg-1),var(--bg-2));
    color: #1f2937;
    min-height: 100vh;
    padding: 40px;
}

.container {
    max-width: 900px;
    margin: auto;
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
}

h2 {
    color: var(--primary);
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
}

h3 {
    color: var(--primary);
    font-size: 24px;
    font-weight: 700;
    margin-top: 30px;
    margin-bottom: 20px;
}

label {
    display: block;
    color: var(--muted);
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 14px;
}

input[type="text"],
input[type="number"],
select,
textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 15px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    background: #f9fafb;
}

input:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: var(--primary);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(11,61,145,0.1);
}

textarea {
    min-height: 100px;
    resize: vertical;
}

button[type="submit"],
.btn-primary {
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #fff;
    padding: 14px 28px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
}

button[type="submit"]:hover,
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(11,61,145,0.15);
}

button[type="button"] {
    background: #f3f4f6;
    color: var(--muted);
    padding: 10px 20px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
}

button[type="button"]:hover {
    background: #e5e7eb;
    border-color: var(--primary);
    color: var(--primary);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
}

table th {
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #fff;
    padding: 12px;
    text-align: left;
    font-weight: 700;
    font-size: 14px;
}

table td {
    padding: 12px;
    border-bottom: 1px solid #f0f0f0;
}

table tr:last-child td {
    border-bottom: none;
}

table input,
table select {
    margin-bottom: 0;
}

table button {
    background: #ef4444;
    color: #fff;
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

table button:hover {
    background: #dc2626;
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    body {
        padding: 20px;
    }

    .container {
        padding: 25px;
    }

    h2 {
        font-size: 24px;
    }
}
</style>
<div class="container">
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
    <button type="submit">Salvar Entrada</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>

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

