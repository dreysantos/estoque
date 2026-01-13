<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; }

body {
    background: linear-gradient(135deg, #f7fafc, #eef2f7, #e0f7ff);
    min-height: 100vh;
    padding: 40px;
    color: #0f172a;
}

.container { max-width: 800px; margin: auto; }

h2 {
    text-align: center;
    margin-bottom: 24px;
    font-size: 32px;
    font-weight: 800;
    color: #0f172a;
}

form {
    background: #ffffff;
    padding: 32px;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(6, 182, 212, 0.18);
    border: 2px solid #06b6d4;
}

label { display: block; font-weight: 600; font-size: 14px; color: #334155; margin-bottom: 8px; }

.field { margin-bottom: 18px; }

input[type="text"] {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #67e8f9;
    background: #ffffff;
    color: #0f172a;
    font-size: 14px;
    transition: all 0.3s ease;
}

input::placeholder { color: #0ea5e9; }

input:focus { outline: none; border-color: #06b6d4; box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.2); }

.actions { margin-top: 8px; }

button[type="submit"] {
    width: 100%;
    padding: 14px 20px;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: #ffffff;
    font-weight: 700;
    font-size: 16px;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

button[type="submit"]:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(6, 182, 212, 0.35); }

@media (max-width: 768px) {
    body { padding: 20px; }
    form { padding: 24px; }
    h2 { font-size: 26px; }
}
</style>

<div class="container">
    <h2>Editar Setor</h2>
    <form method="post" action="index.php?rota=setor_edit&id=<?= htmlspecialchars($dados['id']) ?>">
        <div class="field">
            <label for="nome">Nome</label>
            <input id="nome" type="text" name="nome" placeholder="Nome" value="<?= htmlspecialchars($dados['nome']) ?>" required>
        </div>
        <div class="field">
            <label for="descricao">Descrição</label>
            <input id="descricao" type="text" name="descricao" placeholder="Descrição" value="<?= htmlspecialchars($dados['descricao']) ?>">
        </div>
        <div class="field">
            <label for="telefone">Telefone</label>
            <input id="telefone" type="text" name="telefone" placeholder="Telefone" value="<?= htmlspecialchars($dados['telefone']) ?>">
        </div>
        <div class="actions">
            <button type="submit">Salvar alterações</button>
        </div>
    </form>
</div>
