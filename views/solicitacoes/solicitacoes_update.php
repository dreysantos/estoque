<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// $sol esperado do controller
if (empty($sol)) {
    $_SESSION['flash_error'] = 'Solicitação não encontrada.';
    header('Location: index.php?rota=solicitacoes');
    exit;
}
?>

<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; }
body { background: linear-gradient(135deg, #f8f5f2, #eee6dd, #f3eadf); min-height: 100vh; padding: 40px; color: #1f2937; }
.container { max-width: 860px; margin: auto; }
h2 { text-align: left; margin-bottom: 18px; font-size: 26px; font-weight: 800; color: #6B4F2A; }
form.edit-form { background: #ffffff; padding: 22px; border-radius: 14px; border: 2px solid #8B5E34; box-shadow: 0 10px 30px rgba(139,94,52,0.12); }
label { display:block; font-weight:700; color:#5b4a36; margin-bottom:6px; }
textarea, select, input[type="number"] { width:100%; padding:10px; border-radius:8px; border:1px solid #D6BC8C; font-size:14px; }
.row { margin-bottom:14px; }
.items-list .item-row { display:flex; gap:8px; align-items:center; margin-bottom:8px; }
.actions { margin-top:12px; display:flex; gap:12px; }
.btn-primary { padding:12px 18px; border-radius:10px; border:none; background:linear-gradient(135deg,#8B5E34,#A1683A); color:#fff; font-weight:700; }
.back { margin-top:12px; }
.back a { color:#8B5E34; font-weight:700; text-decoration:none; }
@media (max-width:768px){ body{padding:20px;} }
</style>

<div class="container">
    <h2>Editar Solicitação #<?= htmlspecialchars($sol['id']) ?></h2>
    <form method="post" action="index.php?rota=solicitacoes_update" class="edit-form">
        <input type="hidden" name="id" value="<?= htmlspecialchars($sol['id']) ?>">

        <div class="row">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" rows="4" required><?= htmlspecialchars($sol['descricao'] ?? '') ?></textarea>
        </div>

        <div class="row">
            <label for="situacao">Status</label>
            <?php
            $nivel = $_SESSION['usuario']['nivel_acesso'] ?? null;
            if ($nivel === 'administrador'):
            ?>
                <select name="situacao" id="situacao">
                    <option value="pendente" <?= ($sol['situacao'] ?? '') === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                    <option value="aprovada" <?= ($sol['situacao'] ?? '') === 'aprovada' ? 'selected' : '' ?>>Aprovada</option>
                    <option value="atendida" <?= ($sol['situacao'] ?? '') === 'atendida' ? 'selected' : '' ?>>Atendida</option>
                    <option value="parcial" <?= ($sol['situacao'] ?? '') === 'parcial' ? 'selected' : '' ?>>Parcial</option>
                    <option value="cancelada" <?= ($sol['situacao'] ?? '') === 'cancelada' ? 'selected' : '' ?>>Cancelada</option>
                    <option value="rejeitada" <?= ($sol['situacao'] ?? '') === 'rejeitada' ? 'selected' : '' ?>>Rejeitada</option>
                    <option value="analise" <?= ($sol['situacao'] ?? '') === 'analise' ? 'selected' : '' ?>>Em análise</option>
                </select>
            <?php else: ?>
                <div style="padding:10px 12px;border:1px solid #e6eefc;border-radius:8px;background:#f8fbff;"><?= htmlspecialchars(ucfirst($sol['situacao'] ?? 'pendente')) ?></div>
            <?php endif; ?>
        </div>

        <h3 style="margin-top:6px;margin-bottom:8px;color:#5b4a36;">Itens solicitados</h3>
        <div id="itens-list" class="items-list">
            <?php
            $idx = 0;
            if (!empty($itens)):
                foreach ($itens as $it):
            ?>
            <div class="item-row">
                <select name="itens[<?= $idx ?>][equipamento]">
                    <?php foreach ($equipamentos as $e): ?>
                        <option value="<?= $e['id'] ?>" <?= $e['id'] == $it['id_equipamento'] ? 'selected' : '' ?>><?= htmlspecialchars($e['nome']) ?> (<?= htmlspecialchars($e['marca']) ?>)</option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="itens[<?= $idx ?>][quantidade]" value="<?= htmlspecialchars($it['quantidade']) ?>" min="1" style="width:100px;">
                <button type="button" class="remove-item" style="padding:8px 10px">Remover</button>
            </div>
            <?php
                    $idx++;
                endforeach;
            endif;
            ?>
        </div>

        <button type="button" id="add-item" style="margin-top:6px;padding:8px 10px;">Adicionar item</button>

        <div class="actions">
            <?php if (($nivel ?? null) === 'administrador'): ?>
                <button type="submit" class="btn-primary">Salvar</button>
            <?php endif; ?>
            <div class="back"><a href="index.php?rota=solicitacoes">Cancelar</a></div>
        </div>
    </form>

    <template id="item-template">
        <div class="item-row">
            <select name="__NAME__"></select>
            <input type="number" name="__QTD__" value="1" min="1" style="width:100px;">
            <button type="button" class="remove-item" style="padding:8px 10px">Remover</button>
        </div>
    </template>

    <script>
        (function(){
            var equip = <?= json_encode($equipamentos ?? []) ?>;
            var idx = <?= $idx ?> || 0;
            function makeSelectHtml(name) {
                var s = '<select name="'+name+'">';
                for (var i=0;i<equip.length;i++) {
                    var e = equip[i];
                    s += '<option value="'+e.id+'">'+(e.nome+' ('+ (e.marca||'') +')')+'</option>';
                }
                s += '</select>';
                return s;
            }

            document.getElementById('add-item').addEventListener('click', function(){
                var container = document.getElementById('itens-list');
                var div = document.createElement('div');
                div.className = 'item-row';
                div.innerHTML = makeSelectHtml('itens['+idx+'][equipamento]') + '<input type="number" name="itens['+idx+'][quantidade]" value="1" min="1" style="width:100px;"> <button type="button" class="remove-item" style="padding:8px 10px">Remover</button>';
                container.appendChild(div);
                idx++;
            });

            document.getElementById('itens-list').addEventListener('click', function(e){
                if (e.target && e.target.classList && e.target.classList.contains('remove-item')) {
                    var row = e.target.closest('.item-row');
                    if (row) row.remove();
                }
            });
        })();
    </script>
</div>
