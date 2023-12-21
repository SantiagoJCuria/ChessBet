<?php 

include './db.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: ./index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['nombre'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE (email='$email' or username='$username')";
		$result = mysqli_query($conn, $sql);
		if (!($result->num_rows > 0)) {
			$sql = "INSERT INTO users (username, email, contrasena, elo, rol, K)
					VALUES ('$username', '$email', '$password', '1500', 'user', '40')";
			$result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Usuario Registrado');</script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
                echo "<script>window.location.href = './index.php';</script>";
                exit; // Importante para detener la ejecución del script inmediatamente
            }else {
				echo "<script>alert('Algo salio mal')</script>";
			}
		} else {
			echo "<script>alert('Email o usuario ya registrado')</script>";
		}
		
	} else {
		echo "<script>alert('Las contraseñas no coinciden')</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: #ff0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registro</h1>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="nombre">Usuario:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $username; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email"  value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cpassword">Repetir Contraseña:</label>
                <input type="password" id="cpassword" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="submit" value="Registrarse">
            </div>
        </form>
    </div>
</body>
</html>
