<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
}

/* ==============================
   FUNDO DA PÁGINA
============================== */

body {
    background: linear-gradient(135deg, #e0e7ff, #c7d2fe, #a5b4fc, #818cf8);
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
    background: linear-gradient(160deg, #ffffff 0%, #f5f3ff 100%);
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 12px 40px rgba(129, 140, 248, 0.3);
    border: 3px solid;
    border-image: linear-gradient(135deg, #818cf8, #6366f1) 1;
}


/* ==============================
   TÍTULOS
============================== */

h1, h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 34px;
    letter-spacing: 1.5px;
    background: linear-gradient(135deg, #6366f1, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
}


/* ==============================
   INPUTS E SELECT
============================== */

input,
select {
    width: 100%;
    margin-bottom: 22px;
    padding: 15px;
    border-radius: 10px;
    border: 2px solid #c7d2fe;
    background: #ffffff;
    color: #1a1a1a;
    font-size: 15px;
    transition: all 0.3s ease;
}

input::placeholder {
    color: #818cf8;
    font-weight: 500;
}

select {
    cursor: pointer;
    color: #4338ca;
    font-weight: 500;
}

select option {
    padding: 10px;
}


/* FOCUS */

input:focus,
select:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
    background: #faf5ff;
    transform: translateY(-2px);
}


/* ==============================
   BOTÕES
============================== */

button {
    padding: 16px 32px;
    border-radius: 10px;
    border: none;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    letter-spacing: 1px;
    width: 100%;
    font-size: 17px;
    background: linear-gradient(135deg, #6366f1, #818cf8, #a5b4fc);
    color: #ffffff;
    margin-top: 10px;
    text-transform: uppercase;
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
}

button:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(99, 102, 241, 0.5);
    background: linear-gradient(135deg, #4f46e5, #6366f1, #818cf8);
}

button:active {
    transform: translateY(-1px);
}


/* ==============================
   RESPONSIVO
============================== */

@media (max-width: 768px) {
    body {
        padding: 15px;
    }
    form {
        padding: 25px;
    }
    h1, h2 {
        font-size: 26px;
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
