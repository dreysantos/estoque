<<<<<<< HEAD
<?php
// $dados vem do FornecedorController::edit()
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
    max-width: 700px;
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
    font-weight: 600;
    font-size: 14px;
    color: var(--muted);
    display: block;
    margin-bottom: 8px;
}

input[type="text"],
input {
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

input::placeholder {
    color: #9ca3af;
    font-weight: 400;
}

input:focus {
    outline: none;
    border-color: var(--primary);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(11,61,145,0.1);
}

button {
    padding: 14px 28px;
    border-radius: 8px;
    border: none;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    font-size: 16px;
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #ffffff;
    margin-top: 10px;
    box-shadow: 0 8px 20px rgba(11,61,145,0.15);
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(11,61,145,0.2);
}

@media (max-width: 768px) {
    body { padding: 20px; }
    form { padding: 25px; }
    h2 { font-size: 24px; }
}
</style>

<h2>Editar Fornecedor</h2>

<form method="post" action="index.php?rota=fornecedor_edit&id=<?= htmlspecialchars($dados['id']) ?>">
    <label for="nome">Nome Fantasia</label>
    <input id="nome" name="nome" placeholder="Nome Fantasia" value="<?= htmlspecialchars($dados['nome_fantasia']) ?>" required>

    <label for="razao">Razão Social</label>
    <input id="razao" name="razao" placeholder="Razão Social" value="<?= htmlspecialchars($dados['razao_social']) ?>" required>

    <label for="cnpj">CNPJ</label>
    <input id="cnpj" name="cnpj" placeholder="CNPJ" value="<?= htmlspecialchars($dados['cnpj']) ?>" required>

    <button type="submit">Salvar alterações</button>
</form>
=======
<?php
// $dados vem do FornecedorController::edit()
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
    max-width: 700px;
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
    font-weight: 600;
    font-size: 14px;
    color: var(--muted);
    display: block;
    margin-bottom: 8px;
}

input[type="text"],
input {
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

input::placeholder {
    color: #9ca3af;
    font-weight: 400;
}

input:focus {
    outline: none;
    border-color: var(--primary);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(11,61,145,0.1);
}

button {
    padding: 14px 28px;
    border-radius: 8px;
    border: none;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    font-size: 16px;
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #ffffff;
    margin-top: 10px;
    box-shadow: 0 8px 20px rgba(11,61,145,0.15);
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(11,61,145,0.2);
}

@media (max-width: 768px) {
    body { padding: 20px; }
    form { padding: 25px; }
    h2 { font-size: 24px; }
}
</style>

<h2>Editar Fornecedor</h2>

<form method="post" action="index.php?rota=fornecedor_edit&id=<?= htmlspecialchars($dados['id']) ?>">
    <label for="nome">Nome Fantasia</label>
    <input id="nome" name="nome" placeholder="Nome Fantasia" value="<?= htmlspecialchars($dados['nome_fantasia']) ?>" required>

    <label for="razao">Razão Social</label>
    <input id="razao" name="razao" placeholder="Razão Social" value="<?= htmlspecialchars($dados['razao_social']) ?>" required>

    <label for="cnpj">CNPJ</label>
    <input id="cnpj" name="cnpj" placeholder="CNPJ" value="<?= htmlspecialchars($dados['cnpj']) ?>" required>

    <button type="submit">Salvar alterações</button>
</form>
>>>>>>> 31348f86707aba1a2bf779fbbb100b9e9eb83351
