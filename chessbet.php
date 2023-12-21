<?php
session_start();
//error_reporting(0);
if (!isset($_SESSION['username'])) {
    header("Location: ./index.php");
}
include './db.php';
$sql = "SELECT * FROM torneos";
$result = $conn->query($sql);

$sql5 = "SELECT * FROM users Where username='$_SESSION[username]'";
$result5 = $conn->query($sql5);
$row5 = $result5->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneos en Curso</title>
    <style>
        /* Estilos CSS (puedes personalizarlos según tus preferencias) */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 960px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 24px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
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
    <div class="container">
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

    <h2>Torneos en Curso</h2>
    <?php
    if ($row5['rol'] == "admin") {
    ?>
        <a class='btn' href='./cargarTorneo.php?id=1'>Cargar Torneo</a>
        <a class='btn' href='./cargarRonda.php'>Cargar Ronda</a>
        <a class='btn' href='./cargarTorneo.php?id=2'>Cargar Tabla Final</a>
        <?php
        }
     if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $hoy = new DateTime(); // Obtiene la fecha actual
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'esp'); // Establece la configuración regional en español    
                $fechainicio = new DateTime($row['fechaInicio']);
                $formatoinicio = ($fechainicio->format('m') == $hoy->format('m')&& $fechainicio->format('Y') == $hoy->format('Y')) ? '%d de %B' : '%d de %B';
                $formatoinicio .= ($fechainicio->format('Y') != $hoy->format('Y')) ? ' %Y' : '';
                $inicio = utf8_encode(strftime($formatoinicio, $fechainicio->getTimestamp()));

                $fechafin = new DateTime($row['fechaFinal']);
                $formatofin = ($fechafin->format('m') == $hoy->format('m') && $fechafin->format('Y') == $hoy->format('Y')) ? '%d de %B' : '%d de %B';
                $formatofin.= ($fechafin->format('Y') != $hoy->format('Y')) ? ' %Y' : '';
                $fin = utf8_encode(strftime($formatofin, $fechafin->getTimestamp()));
                echo "<h3>{$row['nombre']}</h3>";
                echo "<p>{$row['ubicacion']}</p>";
                if ($fechainicio->format('Y-m-d') <= $hoy->format('Y-m-d') && $fechafin->format('Y-m-d') >= $hoy->format('Y-m-d')) {
                    echo "<p>En juego</p>";
                } elseif ($fechafin->format('Y-m-d') >= $hoy->format('Y-m-d')) {
                    echo "<p>Próximamente</p>";
                } else {
                    echo "<p>Finalizado</p>";
                }             
                echo "<p>Del: {$inicio} al {$fin}</p>";
                echo "<p>{$row['rondas']} Rondas</p>";
                echo "<a class='btn' href='./torneo.php?id=".$id."'>Ver Torneo</a>";
                echo "<hr>";
            }
        } else {
            echo "<p>No hay torneos en curso.</p>";
        }
        ?>
    </div>
</body>
</html>