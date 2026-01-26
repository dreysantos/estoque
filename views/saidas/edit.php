<?php
// $dados, $itens, $solicitacoes e $usuarios vêm do SaidaController::edit()
?>
<style>
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

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

form {
    max-width: 900px;
    margin: auto;
    background: #ffffff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
    border: none;
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 32px;
    letter-spacing: -0.5px;
    color: var(--primary);
    font-weight: 700;
}

label {
    display: block;
    font-weight: 600;
    font-size: 14px;
    color: var(--muted);
    margin-bottom: 8px;
}

select,
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

select:focus,
textarea:focus {
    outline: none;
    border-color: var(--primary);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(11,61,145,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
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
    text-transform: uppercase;
}

td {
    padding: 12px;
    border-bottom: 1px solid #f0f0f0;
    color: var(--muted);
    font-size: 14px;
}

tr:last-child td {
    border-bottom: none;
}

button {
    padding: 14px 28px;
    border-radius: 8px;
    border: none;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

button[type="submit"] {
    width: 100%;
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #ffffff;
    margin-top: 25px;
}

button[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(11,61,145,0.15);
}

@media (max-width: 768px) {
    body { padding: 15px; }
    form { padding: 25px; }
    h2 { font-size: 26px; }
}
</style>

<h2>Editar Saída</h2>

<form method="post" action="index.php?rota=saida_edit&id=<?= htmlspecialchars($dados['id']) ?>">
    <label>Solicitação (opcional)</label>
    <select name="id_solicitacao">
        <option value="">-- Nenhuma --</option>
        <?php foreach ($solicitacoes as $s): ?>
            <option value="<?= $s['id'] ?>" <?= ($dados['id_solicitacao'] == $s['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($s['id']) ?> - <?= htmlspecialchars($s['descricao']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Usuário</label>
    <select name="id_usuario" required>
        <option value="">Selecione</option>
        <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id'] ?>" <?= ($dados['id_usuario'] == $u['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($u['usuario']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Tipo</label>
    <select name="tipo" required>
        <?php
            $tipos = ['requisicao','transferencia','devolucao','descarte','ajuste','consumo','doacao','venda'];
        ?>
        <?php foreach ($tipos as $t): ?>
            <option value="<?= $t ?>" <?= ($dados['tipo'] === $t) ? 'selected' : '' ?>>
                <?= ucfirst($t) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Descrição</label>
    <textarea name="descricao"><?= htmlspecialchars($dados['descricao'] ?? '') ?></textarea>

    <h3 style="margin-top: 10px; color: var(--primary); font-size: 22px;">Itens</h3>
    <table id="itens">
        <thead>
            <tr>
                <th>Equipamento</th>
                <th>Quantidade</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($itens)): ?>
                <?php foreach ($itens as $item): ?>
                    <tr>
                        <td>
                            <select name="equipamento_id[]" required>
                                <option value="">Selecione</option>
                                <?php foreach ($equipamentos as $eq): ?>
                                    <option value="<?= $eq['id'] ?>" <?= (intval($item['id_equipamento']) === intval($eq['id'])) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($eq['nome']) ?> (<?= htmlspecialchars($eq['marca']) ?>) - Qtde: <?= intval($eq['quantidade']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" name="quantidade[]" value="<?= intval($item['quantidade']) ?>" min="1" required></td>
                        <td><button type="button" onclick="removeRow(this)">Remover</button></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td>
                        <select name="equipamento_id[]" required>
                            <option value="">Selecione</option>
                            <?php foreach ($equipamentos as $eq): ?>
                                <option value="<?= $eq['id'] ?>">
                                    <?= htmlspecialchars($eq['nome']) ?> (<?= htmlspecialchars($eq['marca']) ?>) - Qtde: <?= intval($eq['quantidade']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="number" name="quantidade[]" value="1" min="1" required></td>
                    <td><button type="button" onclick="removeRow(this)">Remover</button></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <button type="button" style="width:100%; margin-top: 12px; background:#f3f4f6; color: var(--muted); border:2px solid #e5e7eb;" onclick="addRow()">Adicionar Item</button>

    <button type="submit">Salvar alterações</button>
</form>

<script>
function addRow() {
    const table = document.getElementById('itens').querySelector('tbody');
    const row = document.createElement('tr');

    const td1 = document.createElement('td');
    const td2 = document.createElement('td');
    const td3 = document.createElement('td');

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

    td1.appendChild(sel);
    td2.appendChild(input);
    td3.appendChild(btn);

    row.appendChild(td1);
    row.appendChild(td2);
    row.appendChild(td3);
    table.appendChild(row);
}

function removeRow(btn) {
    const tbody = document.getElementById('itens').querySelector('tbody');
    const row = btn.closest('tr');
    if (row && tbody.rows.length > 1) {
        tbody.removeChild(row);
    }
}
</script>
=======
<?php
// $dados, $itens, $solicitacoes e $usuarios vêm do SaidaController::edit()
?>
<style>
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

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

form {
    max-width: 900px;
    margin: auto;
    background: #ffffff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
    border: none;
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 32px;
    letter-spacing: -0.5px;
    color: var(--primary);
    font-weight: 700;
}

label {
    display: block;
    font-weight: 600;
    font-size: 14px;
    color: var(--muted);
    margin-bottom: 8px;
}

select,
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

select:focus,
textarea:focus {
    outline: none;
    border-color: var(--primary);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(11,61,145,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
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
    text-transform: uppercase;
}

td {
    padding: 12px;
    border-bottom: 1px solid #f0f0f0;
    color: var(--muted);
    font-size: 14px;
}

tr:last-child td {
    border-bottom: none;
}

button {
    padding: 14px 28px;
    border-radius: 8px;
    border: none;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

button[type="submit"] {
    width: 100%;
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #ffffff;
    margin-top: 25px;
}

button[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(11,61,145,0.15);
}

@media (max-width: 768px) {
    body { padding: 15px; }
    form { padding: 25px; }
    h2 { font-size: 26px; }
}
</style>

<h2>Editar Saída</h2>

<form method="post" action="index.php?rota=saida_edit&id=<?= htmlspecialchars($dados['id']) ?>">
    <label>Solicitação (opcional)</label>
    <select name="id_solicitacao">
        <option value="">-- Nenhuma --</option>
        <?php foreach ($solicitacoes as $s): ?>
            <option value="<?= $s['id'] ?>" <?= ($dados['id_solicitacao'] == $s['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($s['id']) ?> - <?= htmlspecialchars($s['descricao']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Usuário</label>
    <select name="id_usuario" required>
        <option value="">Selecione</option>
        <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id'] ?>" <?= ($dados['id_usuario'] == $u['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($u['usuario']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Tipo</label>
    <select name="tipo" required>
        <?php
            $tipos = ['requisicao','transferencia','devolucao','descarte','ajuste','consumo','doacao','venda'];
        ?>
        <?php foreach ($tipos as $t): ?>
            <option value="<?= $t ?>" <?= ($dados['tipo'] === $t) ? 'selected' : '' ?>>
                <?= ucfirst($t) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Descrição</label>
    <textarea name="descricao"><?= htmlspecialchars($dados['descricao'] ?? '') ?></textarea>

    <h3 style="margin-top: 10px; color: var(--primary); font-size: 22px;">Itens</h3>
    <table id="itens">
        <thead>
            <tr>
                <th>Equipamento</th>
                <th>Quantidade</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($itens)): ?>
                <?php foreach ($itens as $item): ?>
                    <tr>
                        <td>
                            <select name="equipamento_id[]" required>
                                <option value="">Selecione</option>
                                <?php foreach ($equipamentos as $eq): ?>
                                    <option value="<?= $eq['id'] ?>" <?= (intval($item['id_equipamento']) === intval($eq['id'])) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($eq['nome']) ?> (<?= htmlspecialchars($eq['marca']) ?>) - Qtde: <?= intval($eq['quantidade']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="number" name="quantidade[]" value="<?= intval($item['quantidade']) ?>" min="1" required></td>
                        <td><button type="button" onclick="removeRow(this)">Remover</button></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td>
                        <select name="equipamento_id[]" required>
                            <option value="">Selecione</option>
                            <?php foreach ($equipamentos as $eq): ?>
                                <option value="<?= $eq['id'] ?>">
                                    <?= htmlspecialchars($eq['nome']) ?> (<?= htmlspecialchars($eq['marca']) ?>) - Qtde: <?= intval($eq['quantidade']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="number" name="quantidade[]" value="1" min="1" required></td>
                    <td><button type="button" onclick="removeRow(this)">Remover</button></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <button type="button" style="width:100%; margin-top: 12px; background:#f3f4f6; color: var(--muted); border:2px solid #e5e7eb;" onclick="addRow()">Adicionar Item</button>

    <button type="submit">Salvar alterações</button>
</form>

<script>
function addRow() {
    const table = document.getElementById('itens').querySelector('tbody');
    const row = document.createElement('tr');

    const td1 = document.createElement('td');
    const td2 = document.createElement('td');
    const td3 = document.createElement('td');

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

    td1.appendChild(sel);
    td2.appendChild(input);
    td3.appendChild(btn);

    row.appendChild(td1);
    row.appendChild(td2);
    row.appendChild(td3);
    table.appendChild(row);
}

function removeRow(btn) {
    const tbody = document.getElementById('itens').querySelector('tbody');
    const row = btn.closest('tr');
    if (row && tbody.rows.length > 1) {
        tbody.removeChild(row);
    }
}
</script>
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
