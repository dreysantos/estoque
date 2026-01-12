<?php // views/solicitacoes/create.php ?>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; }

/* Paleta: Dax/Alpha - Navy (primária) + Laranja (acento) */
body {
    background: linear-gradient(135deg, #f4f7fb, #eef6ff);
    min-height: 100vh;
    padding: 40px;
    color: #1f2937;
}

.container { max-width: 860px; margin: auto; }

h2 {
    text-align: center;
    margin-bottom: 24px;
    font-size: 30px;
    font-weight: 800;
    color: #0b3d91; /* navy */
}

form {
    background: #ffffff;
    padding: 28px;
    border-radius: 14px;
    border: 2px solid #0b3d91; /* navy */
    box-shadow: 0 10px 30px rgba(11, 61, 145, 0.08);
}

label { display: block; font-weight: 700; font-size: 14px; color: #2b3d5a; margin-bottom: 8px; }
.field { margin-bottom: 18px; }

select, textarea {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #cfe2ff;
    background: #ffffff;
    color: #1f2937;
    font-size: 14px;
    transition: all 0.3s ease;
}

textarea { min-height: 120px; resize: vertical; }

select:focus, textarea:focus { outline: none; border-color: #0e5bb3; box-shadow: 0 0 0 3px rgba(14, 91, 179, 0.12); }

.actions { margin-top: 8px; display: flex; gap: 12px; }

button[type="submit"] {
    flex: 1;
    padding: 14px 20px;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #ff8a00, #ff6a00); /* laranja acento */
    color: #ffffff;
    font-weight: 700;
    font-size: 16px;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.25s ease;
}

button[type="submit"]:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(255, 138, 0, 0.25); }

.back { margin-top: 14px; text-align: center; }
.back a { color: #0b3d91; font-weight: 700; text-decoration: none; }
.back a:hover { text-decoration: underline; }

@media (max-width: 768px) {
    body { padding: 20px; }
    form { padding: 22px; }
    h2 { font-size: 24px; }
}
</style>

<div class="container">
    <h2>Nova Solicitação</h2>
    <form method="post" action="index.php?rota=solicitacoes_create">
        <div class="field">
            <label for="id_setor">Setor</label>
            <select name="id_setor" id="id_setor" required>
                <option value="">Selecione</option>
                <?php foreach ($setores as $st): ?>
                    <option value="<?= htmlspecialchars($st['id']) ?>"><?= htmlspecialchars($st['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="field">
            <label for="id_usuario">Funcionário (usuário)</label>
            <select name="id_usuario" id="id_usuario" required>
                <option value="">Selecione</option>
                <?php foreach ($usuarios as $u): ?>
                    <option value="<?= htmlspecialchars($u['id']) ?>"><?= htmlspecialchars($u['usuario'] ?? ($u['nome'] ?? 'Usuário')) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="field">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" required></textarea>
        </div>

        <div class="actions">
            <button type="submit">Salvar</button>
        </div>
    </form>
    <div class="back">
        <a href="index.php?rota=solicitacoes">Voltar</a>
    </div>
</div>
<?php // footer incluído globalmente pelo layout principal ?>
