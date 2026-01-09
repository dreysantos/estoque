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

form {
	max-width: 700px;
	margin: auto;
	background: #ffffff;
	padding: 35px;
	border-radius: 14px;
	box-shadow: 0 4px 16px rgba(255, 160, 122, 0.15);
	border: 2px solid #d6d3d1;
}

label {
	font-weight: 600;
	font-size: 14px;
	color: #78716c;
	display: block;
	margin-bottom: 8px;
}

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

input:focus,
select:focus,
textarea:focus {
	outline: none;
	border-color: #FFA07A;
	box-shadow: 0 0 0 3px rgba(255, 160, 122, 0.2);
}

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

@media (max-width: 768px) {
	body {
		padding: 15px;
	}
	form {
		padding: 25px;
	}
}
</style>

<h1>Editar Equipamento</h1>

<form method="post" action="index.php?rota=equipamento_edit&id=<?= htmlspecialchars($equip['id'] ?? '') ?>">
	<label>Nome:</label>
	<input type="text" name="nome" value="<?= htmlspecialchars($equip['nome'] ?? '') ?>" required>

	<label>Descrição:</label>
	<input type="text" name="descricao" value="<?= htmlspecialchars($equip['descricao'] ?? '') ?>">

	<label>Marca:</label>
	<input type="text" name="marca" value="<?= htmlspecialchars($equip['marca'] ?? '') ?>">

	<label>Tipo:</label>
	<select name="tipo">
		<option value="epi" <?= (isset($equip['tipo']) && $equip['tipo'] === 'epi') ? 'selected' : '' ?>>EPI</option>
		<option value="epc" <?= (isset($equip['tipo']) && $equip['tipo'] === 'epc') ? 'selected' : '' ?>>EPC</option>
		<option value="peca" <?= (isset($equip['tipo']) && $equip['tipo'] === 'peca') ? 'selected' : '' ?>>Peça</option>
		<option value="ferramenta" <?= (isset($equip['tipo']) && $equip['tipo'] === 'ferramenta') ? 'selected' : '' ?>>Ferramenta</option>
		<option value="materia-prima" <?= (isset($equip['tipo']) && $equip['tipo'] === 'materia-prima') ? 'selected' : '' ?>>Matéria-Prima</option>
		<option value="outro" <?= (isset($equip['tipo']) && $equip['tipo'] === 'outro') ? 'selected' : '' ?>>Outro</option>
	</select>

	<label>CA:</label>
	<input type="text" name="ca" value="<?= htmlspecialchars($equip['ca'] ?? '') ?>">

	<label>Validade CA:</label>
	<input type="date" name="ca_validade" value="<?= htmlspecialchars($equip['ca_validade'] ?? '') ?>">

	<label>Quantidade:</label>
	<input type="number" name="quantidade" value="<?= htmlspecialchars($equip['quantidade'] ?? '') ?>">

	<button type="submit">Salvar alterações</button>
</form>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
