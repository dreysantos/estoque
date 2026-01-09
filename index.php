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
		* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; }

		/* Paleta inédita: navy + mint neon (ainda não usada) */
		body {
			background: radial-gradient(circle at 20% 20%, rgba(64, 224, 208, 0.18), transparent 30%),
									radial-gradient(circle at 80% 0%, rgba(126, 247, 212, 0.16), transparent 35%),
									linear-gradient(135deg, #0b1026, #0f223d, #0d2f3d);
			min-height: 100vh;
			color: #e2f3ff;
			padding: 40px 16px;
		}

		.container {
			max-width: 760px;
			margin: auto;
			background: rgba(9, 17, 35, 0.82);
			border: 1px solid rgba(126, 247, 212, 0.25);
			box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(64, 224, 208, 0.12) inset;
			border-radius: 18px;
			padding: 28px;
			backdrop-filter: blur(6px);
		}

		h1 { font-size: 30px; margin-bottom: 14px; color: #7ef7d4; }
		p { margin-bottom: 14px; line-height: 1.55; color: #d9e6f2; }
		strong { color: #7ef7d4; }
		em { color: #9feaf1; }

		form { margin: 18px 0; }

		button[type="submit"] {
			background: linear-gradient(135deg, #7ef7d4, #4dd0e1);
			color: #0b1026;
			font-weight: 800;
			border: none;
			padding: 14px 20px;
			border-radius: 12px;
			cursor: pointer;
			letter-spacing: 0.4px;
			transition: transform 0.2s ease, box-shadow 0.2s ease;
			box-shadow: 0 12px 30px rgba(78, 227, 204, 0.32), 0 0 0 1px rgba(126, 247, 212, 0.35);
		}

		button[type="submit"]:hover { transform: translateY(-2px); box-shadow: 0 14px 36px rgba(78, 227, 204, 0.42); }

		h2 { margin-top: 24px; margin-bottom: 10px; color: #9feaf1; }

		pre {
			background: #0c152d;
			color: #e2f3ff;
			border: 1px solid rgba(126, 247, 212, 0.25);
			border-radius: 12px;
			padding: 16px;
			white-space: pre-wrap;
			word-break: break-word;
			box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04);
		}

		a { color: #7ef7d4; font-weight: 700; text-decoration: none; }
		a:hover { text-decoration: underline; }

		.meta { margin-top: 16px; color: #c7d7e6; }

		@media (max-width: 640px) {
			body { padding: 24px 12px; }
			.container { padding: 22px; }
			h1 { font-size: 26px; }
		}
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

		<p class="meta"><strong>Após criar o usuário</strong>, acesse: <a href="public/index.php">Sistema</a></p>
	</div>
</body>
</html>

