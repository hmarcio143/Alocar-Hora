
<?php
    require_once("globals.php");
?>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<style>
		body {
			margin: 0;
			padding: 0;
			background-color: #F5F5F5;
			font-family: Arial, sans-serif;
			font-size: 16px;
			color: #333;
		}
		.container {
			margin: 0 auto;
			max-width: 600px;
			padding: 40px;
			background-color: #FFFFFF;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0,0,0,0.2);
		}
		h1 {
			text-align: center;
			margin-bottom: 30px;
			color: #1E90FF;
		}
		form {
			margin-top: 30px;
		}
		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
			color: #1E90FF;
		}
		input[type="email"], input[type="password"] {
			width: 100%;
			padding: 10px;
			margin-bottom: 20px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 0 5px rgba(0,0,0,0.2);
		}
		input[type="submit"] {
			display: block;
			width: 100%;
			padding: 10px;
			background-color: #1E90FF;
			color: #FFFFFF;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		.logo {
			text-align: center;
			margin-bottom: 20px;
		}
		img {
			max-width: 100%;
			height: auto;
		}
	</style>



    <main class="container">
        <div class="logo">
			<img src="img/logo.png" alt="Logo da Empresa">
		</div>
		<h1>Faça o Login</h1>
		<form method="post" action="<?=$BASE_URL?>login_process.php">
        <input type="hidden" name="type" value="create">
			<label for="username">E-mail:</label>
			<input type="email" name="email" placeholder="Digite seu E-mail" required>
			<label for="password">Senha:</label>
			<input type="password" name="password" placeholder="digite sua senha" required>
			<input type="submit" value="Entrar">
		</form>
    </main>
