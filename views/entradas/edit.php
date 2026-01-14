<?php // views/entradas/edit.php ?>
<style>
:root{ --primary:#0b3d91; --primary-2:#0e5bb3; --accent:#ff8a00; --bg-1:#f4f7fb; --bg-2:#eef6ff; --muted:#536776 }

*{ margin:0; padding:0; box-sizing:border-box; font-family:'Inter','Segoe UI','Roboto',Arial,sans-serif; }

body{
    background: linear-gradient(180deg,var(--bg-1),var(--bg-2));
    min-height: 100vh;
    padding: 40px;
    color: #111827;
}

.container{ max-width: 900px; margin: 0 auto; }

h2{ text-align:center; margin-bottom: 18px; font-size: 32px; font-weight: 800; color: var(--primary); }

form{
    background:#fff;
    border-radius: 16px;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
    padding: 22px;
    border: 2px solid rgba(11,61,145,0.18);
}

.field{ margin-bottom: 14px; }
label{ display:block; margin-bottom: 8px; font-weight: 800; font-size: 13px; color: #2b3d5a; }

select, textarea{
    width:100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #cfe2ff;
    background: #ffffff;
    color:#111827;
    font-size: 14px;
}

textarea{ min-height: 120px; resize: vertical; }

.actions{ display:flex; gap:12px; margin-top: 10px; }

.btn{
    flex: 1;
    padding: 12px 14px;
    border-radius: 10px;
    border: none;
    cursor:pointer;
    font-weight: 800;
    font-size: 14px;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    transition: transform .15s ease, box-shadow .15s ease;
}

.btn-save{ background: linear-gradient(135deg,var(--primary),var(--primary-2)); color:#fff; box-shadow: 0 10px 26px rgba(11,61,145,0.14); }
.btn-save:hover{ transform: translateY(-2px); box-shadow: 0 14px 34px rgba(11,61,145,0.18); }

.btn-cancel{ background: #f3f4f6; color: #111827; }
.btn-cancel:hover{ transform: translateY(-1px); box-shadow: 0 10px 20px rgba(17,24,39,0.08); }

.note{ margin-top: 12px; color: var(--muted); font-size: 13px; text-align:center; }

@media (max-width: 768px) {
    body{ padding: 20px; }
    h2{ font-size: 24px; }
    .actions{ flex-direction: column; }
}
</style>

<div class="container">
    <h2>Editar Entrada #<?= htmlspecialchars((string)($entrada['id'] ?? '')) ?></h2>

    <form method="post" action="index.php?rota=entrada_edit&id=<?= urlencode((string)($entrada['id'] ?? '')) ?>">
        <div class="field">
            <label for="id_fornecedor">Fornecedor (opcional)</label>
            <select name="id_fornecedor" id="id_fornecedor">
                <option value="">— Nenhum —</option>
                <?php foreach (($fornecedores ?? []) as $f): ?>
                    <?php $selected = ((string)($entrada['id_fornecedor'] ?? '') === (string)($f['id'] ?? '')) ? 'selected' : ''; ?>
                    <option value="<?= htmlspecialchars((string)($f['id'] ?? '')) ?>" <?= $selected ?>>
                        <?= htmlspecialchars((string)($f['nome_fantasia'] ?? '')) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="field">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" required>
                <?php $tipoAtual = (string)($entrada['tipo'] ?? 'compra'); ?>
                <option value="compra" <?= $tipoAtual==='compra'?'selected':'' ?>>Compra</option>
                <option value="doacao" <?= $tipoAtual==='doacao'?'selected':'' ?>>Doação</option>
                <option value="transferencia" <?= $tipoAtual==='transferencia'?'selected':'' ?>>Transferência</option>
                <option value="devolucao" <?= $tipoAtual==='devolucao'?'selected':'' ?>>Devolução</option>
                <option value="ajuste" <?= $tipoAtual==='ajuste'?'selected':'' ?>>Ajuste</option>
            </select>
        </div>

        <div class="field">
            <label for="situacao">Situação</label>
            <?php $sitAtual = (string)($entrada['situacao'] ?? 'ativa'); ?>
            <select name="situacao" id="situacao" required>
                <option value="ativa" <?= $sitAtual==='ativa'?'selected':'' ?>>Ativa</option>
                <option value="cancelada" <?= $sitAtual==='cancelada'?'selected':'' ?>>Cancelada</option>
            </select>
        </div>

        <div class="field">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao"><?= htmlspecialchars((string)($entrada['descricao'] ?? '')) ?></textarea>
        </div>

        <div class="actions">
            <a class="btn btn-cancel" href="index.php?rota=entradas">Cancelar</a>
            <button class="btn btn-save" type="submit">Salvar</button>
        </div>

        <div class="note">Itens da entrada não são alterados nesta tela.</div>
    </form>
</div>
