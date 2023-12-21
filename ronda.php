<?php 

include './db.php';

//error_reporting(0);

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ./index.php");
}
$sql5 = "SELECT * FROM users Where username='$_SESSION[username]'";
$result5 = $conn->query($sql5);
$row5 = $result5->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enfrentamientos del Torneo</title>
    <style>
         .styled-table {
        border-collapse: collapse;
        width: 100%;
    }

    .styled-table th, .styled-table td {
        padding: 8px; /* Ajusta este valor para controlar el espaciado */
        border: 1px solid #ddd;
        text-align: center;
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
    </style>
</head>
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
    <div class="container">
        <h1>Enfrentamientos del Torneo</h1>
        <table class="styled-table">
        <thead>
            <tr>
                <th>Jugador</th>
                <th>Elo</th>
                <th>Pts.</th>
                <th>Resultado</th>
                <th>Pts.</th>
                <th>Jugador</th>
                <th>Elo</th>
            </tr>
        </thead>
        <tbody>
                <?php
                // Conexión a la base de datos (reemplaza con tus propios valores)
                // Consulta para obtener los enfrentamientos del torneo desde la base de datos
                if (isset($_GET['id_torneo'])) {
                    $id = $_GET['id_torneo'];
                    $ronda = $_GET['ronda'];
                    $queryTorneo = "SELECT nombre FROM torneos WHERE id = '$id'";
                    //echo $queryTorneo;
                    $resultTorneo = $conn->query($queryTorneo);
                    
                    if ($resultTorneo->num_rows > 0) {
                        $rowTorneo = $resultTorneo->fetch_assoc();
                        $nombreTorneo = $rowTorneo['nombre'];
                        //echo $nombreTorneo;
                    }
                    
                        // Luego, utiliza el nombre del torneo en la consulta para rondas
                        $queryRondas = "SELECT * FROM rondas WHERE nombreTorneo = '$nombreTorneo' AND n°Ronda = '$ronda'";
                        //echo $queryRondas;
                        $result = $conn->query($queryRondas);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Obtiene los datos del Jugador 1
                            $sql = "SELECT j1.nombre, j1.elo, r.pts1 
                                    FROM jugadores j1, rondas r 
                                    WHERE r.nombreJugador1 = '{$row['nombreJugador1']}' AND n°Ronda = '$ronda' AND
                                          j1.nombre = '{$row['nombreJugador1']}'";
                            $resultJugador1 = $conn->query($sql);
                            
                            // Obtiene los datos del Jugador 2
                            $sql = "SELECT j2.nombre, j2.elo , r.pts2
                                    FROM jugadores j2, rondas r 
                                    WHERE r.nombreJugador2 = '{$row['nombreJugador2']}' AND n°Ronda = '$ronda' AND 
                                          j2.nombre = '{$row['nombreJugador2']}'";
                            $resultJugador2 = $conn->query($sql);
                            
                            if ($resultJugador1->num_rows > 0 && $resultJugador2->num_rows > 0) {
                                $rowJugador1 = $resultJugador1->fetch_assoc();
                                $rowJugador2 = $resultJugador2->fetch_assoc();
                                
                                echo "<tr>";
                                echo "<td>" . $rowJugador1['nombre'] . "</td>";
                                echo "<td>" . $rowJugador1['elo'] . "</td>";
                                echo "<td>" . $rowJugador1['pts1'] . "</td>";
                                $query9 = "SELECT COUNT(*) as count FROM apuestas WHERE usuario = ? AND id_partida = ?";
                                $stmt = $conn->prepare($query9);
                                $stmt->bind_param("si", $_SESSION['username'], $row['id']);
                                $stmt->execute();
                                $inicio = $row['Inicio'];
                                date_default_timezone_set('America/Argentina/Buenos_Aires');
                                $fecha_actual = date("Y-m-d H:i:s");
                                $result9 = $stmt->get_result();
                                if ($result9 !== false) {
                                    while ($row9 = $result9->fetch_assoc()) {
                                        $count = $row9['count'];
                                    }
                                        if ($row['resultado']) {
                                            echo "<td>" . $row['resultado'] . "</td>";
                                        }else {
                                        if ($inicio < $fecha_actual) {
                                            echo "<td>En juego</td>";
                                        }else {

                                        if ($count == 0) {
                                            echo "<td><a href='subirApuesta.php?id=" . $row['id'] . "&torneo=" . $row['nombreTorneo'] . "'>Apostar</a></td>";
                                        }
                                     if ($count > 0) {
                                        echo "<td><a href='perfil.php'>Ver Apuestas</a></td>";} 
                                    }
                                }
                                echo "<td>" . $rowJugador2['pts2'] . "</td>";
                                echo "<td>" . $rowJugador2['nombre'] . "</td>";
                                echo "<td>" . $rowJugador2['elo'] . "</td>";
                                echo "</tr>";
                            }
                    }}
                } else {
                    echo "<tr><td colspan='5'>No hay enfrentamientos registrados.</td></tr>";
                }
            }
                ?>
            </tbody>
        </table>
    </div>
    <a href="./torneo.php?id=<?=$id?>">Salir</a>
</body>
</html>
