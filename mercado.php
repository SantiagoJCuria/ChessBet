<?php
include('db.php');
session_start();
error_reporting(0);
if (!isset($_SESSION['username'])) {
    header("Location: ./index.php");
}
$sql5 = "SELECT * FROM users Where username='$_SESSION[username]'";
$result5 = $conn->query($sql5);
$row5 = $result5->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Información del Torneo</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        h2 {
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }li {
    margin-bottom: 10px;
    border: 1px solid #ddd;
    padding: 10px;
}

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }
        .header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;

}

.user-info {
    display: flex;
    align-items: center;
}

.user-label, .elo-label {
    margin-right: 10px;
}

.user-link, .elo {
    color: #007BFF;
    text-decoration: none;
    font-weight: bold;
    margin-right: 20px;
}

.logout-button {
    background-color: #007BFF;
    color: #fff;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
}

        /* Agrega más estilos según tus preferencias */
    </style>
<body>
<div class="header-container">
    <div class="user-info">
        <span class="user-label">Usuario:</span>
        <a class="user-link" href="perfil.php"><?=$_SESSION['username']?></a>
        <span class="elo-label">Elo:</span>
        <span class="elo"><?=$row5['elo']?></span>
    </div>
    <div class="logout-link">
        <a class="logout-button" href="./logout.php">Cerrar Sesión</a>
    </div>
</div>
    <h1>Información del Torneo</h1>
        <h2>Lista de Jugadores:</h2>
<table>
    <thead>
        <tr>
            <th>Jugador</th>
            <th>Elo</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Acciones</th>
            <th>Comprar</th>
            <th>Vender</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query="SELECT * FROM jugadores order by elo desc";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $query2="SELECT * FROM mercado WHERE nombre_jugador = '$row[nombre]'";
                $result2 = $conn->query($query2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        if ($row['elo'] == 0) {
                            $elo = 1500;
                        } else {
                            $elo = $row['elo'];
                        }
                        $preciocompra = number_format(($elo / ($row2['acciones_disp'])+1),2);
                        $precioventa = number_format(($elo / ($row2['acciones_disp'])-1),2);
                    }
                }
                echo "<tr>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['elo'] . "</td>";
                echo "<td>" . $preciocompra . "</td>";
                echo "<td>" . $precioventa . "</td>";
                echo "<td> 0 </td>";
                echo "<td>Comprar</td>";
                echo "<td>Vender</td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>
 <!-- Asegúrate de cerrar la etiqueta PHP correctamente -->

    		<a href="./chessbet.php">Salir</a>

</body>
</html>
