<?php 

include './db.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: ./chessbet.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE username= '$email' AND contrasena = '$password' ";
    echo $sql;
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: ./chessbet.php");
	} else {
		echo "<script>alert('Email o contrasena invalido')</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apuestas de Ajedrez</title>
    <style>
        /* Estilos anteriores */

        /* Estilos para el formulario de inicio de sesión */
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-login {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <!-- Encabezado anterior -->
    </header>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Iniciar Sesión</p>
			<div class="input-group">
				<input type="text" placeholder="Usuario" name="email" value="<?php echo $email; ?>" class='anadir' required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" class='anadir'  required>
			</div>
			<div class="input-group">
				<button name="submit" class="submit">Iniciar Sesión</button>
			</div>
			<p class="login-register-text">No tienes una cuenta? <a href="./register.php">Registrate aquí</a>.</p>
		</form>
    </div>
</body>
</html>
