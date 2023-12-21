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

    <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $pts = FALSE;
                $query2 = "SELECT nombre FROM torneos WHERE id = '$id'";
                $result2 = $conn->query($query2);
                if ($result2 === false) {
                    die("Error en la consulta SQL: " . $conn->error);
                }
                $row2 = $result2->fetch_assoc();
                if ($row2 !== null && isset($row2['nombre'])) {
                    $nombre = $row2['nombre'];
                } else {
                    $nombre = ""; // Establecer un valor predeterminado o manejar el error de otra manera
                }
                $query = "SELECT rondas FROM torneos WHERE id = '$id'";
                $result = $conn->query($query);
                if ($result === false) {
                    die("Error en la consulta SQL: " . $conn->error);
                }
                $row = $result->fetch_assoc();
                if ($row !== null && isset($row['rondas'])) {
                    $totalRondas = $row['rondas'];
                } else {
                    $totalRondas = 9; // Establecer un valor predeterminado o manejar el error de otra manera
                }

    for ($i = 1; $i <= $totalRondas; $i++) {
        $query3 = "SELECT n°Ronda FROM rondas WHERE nombreTorneo = '$nombre' AND n°Ronda = $i LIMIT 1 ";
        $result3 = $conn->query($query3);
        if ($result3 === false) {
            die("Error en la consulta SQL: " . $conn->error);
        }
        $row3 = $result3->fetch_assoc();
        if ($row3 !== null && isset($row3['n°Ronda'])) {
            echo "<a class='btn' href='./ronda.php?id_torneo=$id&ronda=$i'>Ronda $i  </a>";
        } else {
            //echo $query3."</br>";
        }
    }
        echo "<h2>Lista de Jugadores:</h2>";
        echo "<ul>";

        $query = "SELECT jt.*, j.Elo
          FROM jugadorestorneo jt
          INNER JOIN jugadores j ON jt.nombreJugador = j.nombre
          WHERE jt.id_torneo = $id
          ORDER BY j.Elo DESC";

        $query3 = "SELECT MAX(posicionFinal) as max_pos FROM jugadoresTorneo WHERE id_torneo = $id";
        $result3 = $conn->query($query3);
        $row3 = $result3->fetch_assoc();
        if ($row3['max_pos'] > 0) {
            $query = "SELECT jt.*, j.Elo
            FROM jugadorestorneo jt
            INNER JOIN jugadores j ON jt.nombreJugador = j.nombre
            WHERE jt.id_torneo = $id
            ORDER BY jt.posicionFinal ASC";

            $pts=TRUE;
        }

        $result = $conn->query($query);?>
<table>
    <thead>
        <tr>
            <th>Jugador</th>
            <th>Elo</th>
            <?php if ($pts) { // Solo muestra la columna de Puntos si $pts es verdadero ?>
                <th>Puntos</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nombreJugador'] . "</td>";
                echo "<td>" . $row['Elo'] . "</td>";
                if ($pts) { // Muestra la columna de Puntos solo si $pts es verdadero
                    echo "<td>" . $row['puntos'] . "</td>";
                }
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>
<?php } ?> <!-- Asegúrate de cerrar la etiqueta PHP correctamente -->

    		<a href="./chessbet.php">Salir</a>

</body>
</html>
