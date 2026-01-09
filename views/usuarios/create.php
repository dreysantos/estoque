<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; }

/* Paleta única: crimson/cream (não usada antes) */
body {
    background: linear-gradient(135deg, #fff7f0, #f9f3ee, #fdeee6);
    min-height: 100vh;
    padding: 40px;
    color: #111827;
}

.container { max-width: 860px; margin: auto; }

h2 {
    text-align: center;
    margin-bottom: 24px;
    font-size: 30px;
    font-weight: 800;
    color: #7f1d1d; /* deep crimson */
}

form {
    background: #ffffff;
    padding: 28px;
    border-radius: 14px;
    border: 2px solid #b91c1c; /* brick red */
    box-shadow: 0 10px 30px rgba(185, 28, 28, 0.16);
}

label { display: block; font-weight: 700; font-size: 14px; color: #7c2d12; margin-bottom: 8px; }
.field { margin-bottom: 18px; }

select, input[type="text"], input[type="password"] {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #fecaca; /* light rose border (not pink theme) */
    background: #ffffff;
    color: #111827;
    font-size: 14px;
    transition: all 0.3s ease;
}

input::placeholder { color: #ef4444; }

select:focus, input:focus { outline: none; border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.22); }

.actions { margin-top: 8px; }

button[type="submit"] {
    width: 100%;
    padding: 14px 20px;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    color: #ffffff;
    font-weight: 700;
    font-size: 16px;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.25s ease;
}

button[type="submit"]:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(185, 28, 28, 0.35); }

@media (max-width: 768px) {
    body { padding: 20px; }
    form { padding: 22px; }
    h2 { font-size: 24px; }
}
</style>

<div class="container">
    <h2>Novo Usuário</h2>
    <form method="post" action="index.php?rota=usuario_create">
        <div class="field">
            <label for="id_funcionario">Funcionário</label>
            <select name="id_funcionario" id="id_funcionario" required>
                <option value="">Selecione</option>
                <?php foreach ($funcionarios as $f): ?>
                    <option value="<?= htmlspecialchars($f['id']) ?>">
                        <?= htmlspecialchars($f['nome']) ?> <?= htmlspecialchars($f['sobrenome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="field">
            <label for="nome">Usuário</label>
            <input id="nome" name="nome" type="text" placeholder="Usuário" required>
        </div>

        <div class="field">
            <label for="senha">Senha</label>
            <input id="senha" type="password" name="senha" placeholder="Senha" required>
        </div>

        <div class="field">
            <label for="nivel">Nível</label>
            <select name="nivel" id="nivel">
                <option value="basico">Básico</option>
                <option value="medio">Médio</option>
                <option value="avancado">Avançado</option>
                <option value="administrador">Administrador</option>
            </select>
        </div>

        <div class="actions">
            <button type="submit">Salvar</button>
        </div>
    </form>
</div>
