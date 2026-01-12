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

