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
    max-width: 700px;
    margin: auto;
    background: #ffffff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 18px 50px rgba(11,61,145,0.06);
    border: none;
}


/* ==============================
   TÍTULOS
============================== */

h1, h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 32px;
    letter-spacing: -0.5px;
    color: var(--primary);
    font-weight: 700;
}


/* ==============================
   INPUTS E SELECT
============================== */

input,
select {
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

select {
    cursor: pointer;
    color: var(--muted);
    font-weight: 500;
}

select option {
    padding: 10px;
}


/* FOCUS */

input:focus,
select:focus {
    outline: none;
    border-color: var(--primary);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(11,61,145,0.1);
}


/* ==============================
   BOTÕES
============================== */

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

button:active {
    transform: translateY(-1px);
}


/* ==============================
   RESPONSIVO
============================== */

@media (max-width: 768px) {
    body {
        padding: 20px;
    }
    form {
        padding: 25px;
    }
    h1, h2 {
        font-size: 24px;
    }
}
</style>

<h2>Cadastrar Funcionário</h2>

<form method="post" action="index.php?rota=funcionario_create">
<select name="id_setor" required>
    <option value="">Setor</option>
    <?php foreach ($setores as $s): ?>
        <option value="<?= $s['id'] ?>"><?= $s['nome'] ?></option>
    <?php endforeach; ?>
</select>

<input name="nome" placeholder="Nome" required>
<input name="sobrenome" placeholder="Sobrenome" required>
<input name="telefone" placeholder="Telefone">
<input name="matricula" placeholder="Matrícula" required>
<input name="cpf" placeholder="CPF" required>

<button>Salvar</button>
</form>
