<?php require_once __DIR__ . '/../layout/header.php'; ?>

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
   LABELS
============================== */

label {
    font-weight: 600;
    font-size: 14px;
    color: var(--muted);
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


/* FOCUS */

input:focus,
select:focus,
textarea:focus {
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
}

button[type="submit"] {
    background: linear-gradient(90deg,var(--primary),var(--primary-2));
    color: #ffffff;
    margin-top: 10px;
}

button[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(11,61,145,0.15);
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
