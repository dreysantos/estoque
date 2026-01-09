<?php require_once __DIR__ . '/../layout/header.php'; ?>

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
    background: linear-gradient(135deg, #f5f5f4, #e7e5e4, #fef3ec);
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
    padding: 35px;
    border-radius: 14px;
    box-shadow: 0 4px 16px rgba(255, 160, 122, 0.15);
    border: 2px solid #d6d3d1;
}


/* ==============================
   TÍTULOS
============================== */

h1, h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 32px;
    letter-spacing: 1px;
    color: #57534e;
}


/* ==============================
   LABELS
============================== */

label {
    font-weight: 600;
    font-size: 14px;
    color: #78716c;
    display: block;
    margin-bottom: 8px;
}


/* ==============================
   INPUTS, SELECT, TEXTAREA
============================== */

input[type="text"],
input[type="number"],
input[type="date"],
select,
textarea {
    width: 100%;
    margin-bottom: 20px;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #d6d3d1;
    background: #ffffff;
    color: #1a1a1a;
    font-size: 14px;
    transition: all 0.3s ease;
}

textarea {
    resize: vertical;
    min-height: 90px;
}


/* FOCUS */

input:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: #FFA07A;
    box-shadow: 0 0 0 3px rgba(255, 160, 122, 0.2);
}


/* ==============================
   BOTÕES
============================== */

button {
    padding: 14px 28px;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    letter-spacing: 0.5px;
    width: 100%;
    font-size: 16px;
}

button[type="submit"] {
    background: linear-gradient(135deg, #FFA07A, #FF8C61);
    color: #ffffff;
    margin-top: 10px;
}

button[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(255, 160, 122, 0.35);
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

<h1>Cadastrar Equipamento</h1>

<form method="post" action="index.php?rota=equipamento_create">
    <label>Nome:</label>
    <input type="text" name="nome">

    <label>Descrição:</label>
    <input type="text" name="descricao">

    <label>Marca:</label>
    <input type="text" name="marca">

    <label>Tipo:</label>
    <select name="tipo">
        <option value="epi">EPI</option>
        <option value="epc">EPC</option>
        <option value="peca">Peça</option>
        <option value="ferramenta">Ferramenta</option>
        <option value="materia-prima">Matéria-Prima</option>
        <option value="outro">Outro</option>
    </select>

    <label>CA:</label>
    <input type="text" name="ca">

    <label>Validade CA:</label>
    <input type="date" name="ca_validade">

    <label>Quantidade:</label>
    <input type="number" name="quantidade">

    <button type="submit">Cadastrar</button>
</form>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
