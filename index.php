<?php
// Redireciona para o sistema principal (login)
// Página simples para criar usuário admin via web (apenas para conveniência).
// Recomenda-se remover este arquivo após a criação do usuário por segurança.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	ob_start();
	require_once __DIR__ . '/scripts/create_admin.php';
	$output = ob_get_clean();
}
?>
<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Criar Admin</title>
	<style>
	/* Dax/Alpha theme (navy + orange accent) for admin creation page */
	:root{
		--primary:#0b3d91;
		--primary-2:#0e5bb3;
		--accent:#ff8a00;
		--accent-2:#ff6a00;
		--bg-1:#f4f7fb;
		--bg-2:#eef6ff;
		--card-bg:#ffffff;
		--muted:#253444;
	}

	body{
		background: linear-gradient(135deg,var(--bg-1),var(--bg-2));
		min-height:100vh;
		color:var(--muted);
		padding:40px 16px;
		font-family:'Segoe UI','Roboto',Arial,sans-serif;
	}

	.container{
		max-width:760px;
		margin:auto;
		background:var(--card-bg);
		border:1px solid rgba(11,61,145,0.08);
		box-shadow:0 14px 40px rgba(11,61,145,0.06);
		border-radius:14px;
		padding:28px;
	}

	h1{ color:var(--primary); font-size:30px; margin-bottom:12px; }
	p{ color:#425567; margin-bottom:14px; line-height:1.5 }

	button[type="submit"]{
		background: linear-gradient(135deg,var(--accent),var(--accent-2));
		color:#fff; font-weight:700; padding:12px 18px; border-radius:10px; border:none; cursor:pointer;
	}

	pre{ background:#f6f9fc; border:1px solid rgba(11,61,145,0.06); padding:14px; border-radius:10px; color:#1f2d3d }

	a{ color:var(--primary); font-weight:600 }

	@media (max-width:640px){ body{ padding:24px 12px } .container{ padding:20px } h1{ font-size:26px } }
	</style>
</head>
<body>
	<div class="container">
		<h1>Criar usuário administrador</h1>
		<p>Ao clicar em <strong>Criar Admin</strong>, o sistema criará (se não existirem) um setor, um funcionário e o usuário <em>admin</em> (senha <em>admin123</em>).</p>
		<form method="post" action="index.php">
			<button type="submit">Criar Admin</button>
		</form>

		<?php if (!empty($output)): ?>
			<h2>Resultado</h2>
			<pre><?= htmlspecialchars($output) ?></pre>
		<?php endif; ?>

		<p class="meta"><strong>Após criar o usuário</strong>, acesse: <a href="public/index.php?rota=login">Sistema</a></p>
	</div>
</body>
</html>

