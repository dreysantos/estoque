<?php require_once __DIR__ . '/../layout/header.php'; ?>

<style>
body {
	background: linear-gradient(135deg, #fef3ec, #fff7ed);
	min-height: 100vh;
	padding: 40px;
	font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
	color: #1a1a1a;
}
.card {
	max-width: 700px;
	margin: auto;
	background: #ffffff;
	padding: 28px;
	border-radius: 12px;
	box-shadow: 0 8px 30px rgba(120,113,108,0.06);
	border: 2px solid #efe8e1;
}
.danger {
	color: #b91c1c;
	font-weight: 700;
	text-align: center;
	margin-bottom: 18px;
}
.details {
	margin-bottom: 20px;
	color: #44403c;
}
.actions {
	display: flex;
	gap: 12px;
}
.btn {
	flex: 1;
	padding: 12px 16px;
	border-radius: 8px;
	border: none;
	cursor: pointer;
	font-weight: 700;
}
.btn-cancel {
	background: #e6e6e6;
	color: #333;
	text-decoration: none;
	display: inline-flex;
	align-items: center;
	justify-content: center;
}
.btn-delete {
	background: #ef4444;
	color: #fff;
}
</style>

<div class="card">
	<h2 class="danger">Confirmar exclusão do equipamento</h2>

	<div class="details">
		<p><strong>Nome:</strong> <?= htmlspecialchars($equip['nome'] ?? '') ?></p>
		<p><strong>Marca:</strong> <?= htmlspecialchars($equip['marca'] ?? '') ?></p>
		<p><strong>Tipo:</strong> <?= htmlspecialchars($equip['tipo'] ?? '') ?></p>
		<p><strong>Quantidade:</strong> <?= htmlspecialchars($equip['quantidade'] ?? '') ?></p>
		<p><strong>CA:</strong> <?= htmlspecialchars($equip['ca'] ?? '') ?></p>
	</div>

	<form method="post" action="index.php?rota=equipamento_delete&id=<?= htmlspecialchars($equip['id'] ?? '') ?>">
		<div class="actions">
			<a href="?rota=equipamentos" class="btn btn-cancel">Cancelar</a>
			<button type="submit" class="btn btn-delete" onclick="return confirm('Deseja realmente excluir este equipamento?')">Excluir</button>
		</div>
	</form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>

