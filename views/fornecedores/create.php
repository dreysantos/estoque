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
    background: linear-gradient(135deg, #E0FFFF, #D0F5F5, #C0EDED, #B0E5E5);
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
    background: linear-gradient(160deg, #ffffff 0%, #F0FFFF 100%);
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 12px 40px rgba(160, 200, 200, 0.2);
    border: 3px solid;
    border-image: linear-gradient(135deg, #B0E5E5, #90D5D5) 1;
}


/* ==============================
   TÍTULOS
============================== */

h1, h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 34px;
    letter-spacing: 1.5px;
    background: linear-gradient(135deg, #4A9A9A, #3A7A7A);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
}


/* ==============================
   LABELS
============================== */

label {
    font-weight: 600;
    font-size: 14px;
    color: #3A7A7A;
    display: block;
    margin-bottom: 8px;
}


/* ==============================
   INPUTS
============================== */

input[type="text"],
input[name="nome"],
input[name="razao"],
input[name="cnpj"],
input {
    width: 100%;
    margin-bottom: 22px;
    padding: 15px;
    border-radius: 10px;
    border: 2px solid #C0EDED;
    background: #ffffff;
    color: #1a1a1a;
    font-size: 15px;
    transition: all 0.3s ease;
}

input::placeholder {
    color: #5AAFAF;
    font-weight: 500;
}


/* FOCUS */

input:focus {
    outline: none;
    border-color: #70CFCF;
    box-shadow: 0 0 0 4px rgba(112, 207, 207, 0.2);
    background: #F0FFFF;
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
    background: linear-gradient(135deg, #70CFCF, #5AAFAF, #4A9A9A);
    color: #ffffff;
    margin-top: 10px;
    text-transform: uppercase;
    box-shadow: 0 6px 20px rgba(74, 154, 154, 0.3);
}

button:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(74, 154, 154, 0.4);
    background: linear-gradient(135deg, #5AAFAF, #70CFCF, #90D5D5);
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

<h2>Cadastrar Fornecedor</h2>

<form method="post" action="index.php?rota=fornecedor_create">
<input name="nome" placeholder="Nome Fantasia" required>
<input name="razao" placeholder="Razão Social" required>
<input name="cnpj" placeholder="CNPJ" required>
<button>Salvar</button>
</form>

