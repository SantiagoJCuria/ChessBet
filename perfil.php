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
    <title>Perfil</title>
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
        .green {
        color: green;
    }

    .red {
        color: red;
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
<body>    <div class="header-container">
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
    <h1><strong><?php echo $_SESSION['username'];?></strong></h1>
    <h2>Tus apuestas</h2>
<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>Estado</th>
            <th>Torneo</th>
            <th>Ronda</th>
            <th>Jugador</th>
            <th>Resultado</th>
            <th>Jugador</th>
            <th>Apuesta</th>
            <th>Pago</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM apuestas WHERE usuario = '$_SESSION[username]'";
        $i = 1;
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sql2 = "SELECT * FROM rondas WHERE id = '$row[id_partida]'";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $juga = $row2['nombreJugador1'];
                        $jugb = $row2['nombreJugador2'];
                        $torneo = substr($row2['nombreTorneo'], 0, 10);
                        $ronda = $row2['n°Ronda'];
                        $sql3 = "SELECT * FROM torneos WHERE nombre = '$row2[nombreTorneo]'";
                        $result3 = mysqli_query($conn, $sql3);
                        if ($result3->num_rows > 0) {
                            while ($row3 = $result3->fetch_assoc()) {
                                $id = $row3['id'];
                            }
                        }
                    }
                }

                echo "<tr>";
                echo "<td>".$i."</td>";
                if (!$row['resultado']) {
                    echo "<td>En espera</td>";
                }else {
                    if ($row['transaccion_final'] > 0) {
                        echo "<td><span class='green'> Acertado </span></td>";
                    }else if($row['transaccion_final'] < 0){
                        echo "<td><span class='red'> No Acertado </span></td>";
                    }else {
                        echo "<td> No Cobrado</td>";

                    }
                }
                
                echo "<td><a href='./torneo.php?id={$id}'>" . $torneo . "</a></td>";
                echo "<td><a href='./ronda.php?id_torneo={$id}&ronda={$ronda}'>" . $ronda . "</a></td>";
                echo "<td>" . $juga . "</td>";
                echo "<td>" . $row['resultado'] . "</td>";
                echo "<td>" . $jugb  . "</td>";
                echo "<td>" . $row['prediccion'] . "</td>";
                if (!$row['resultado']) {
                echo "<td><span class='green'>+" . $row['apuesta'] . "</span> / <span class='red'> -" .$row['cobra'] . "</span></td>";
                }else{
                if ($row['transaccion_final'] > 0) {
                    echo "<td><span class='green'>" . $row['transaccion_final'] . "</span></td>";
                }else  if ($row['transaccion_final'] < 0){
                    echo "<td><span class='red'>" . $row['transaccion_final'] . "</span></td>";
                }else {
                    echo "<td>" . $row['transaccion_final'] . "</td>";
                }
                }
                echo "</tr>";
                $i++;
            }
        }else {
            echo "<td colspan='9'>No tienes apuestas registradas</td>";
        }
        ?>
    </tbody>
</table>
    		<a href="./chessbet.php">Salir</a>

</body>
</html>
