<?php 

include './db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ./index.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $torneo = $_GET['torneo'];
    $query9 = "SELECT * FROM torneos WHERE nombre = '$torneo'";
    $result9 = $conn->query($query9);
    while ($row9 = $result9->fetch_assoc()) {
        $href="id_torneo=".$row9['id']."";
    }
    $query91 = "SELECT * FROM rondas WHERE id = '$id'";
    $result91 = $conn->query($query91);
    while ($row91 = $result91->fetch_assoc()) {
        $href .= "&ronda=" . $row91['n°Ronda'];
    }
    $query92 = "SELECT COUNT(*) as count FROM apuestas WHERE id_partida = ? AND usuario = ?";
    $stmt = $conn->prepare($query92);
    $stmt->bind_param("ss", $id, $_SESSION['username']);
    $stmt->execute();
    $result92 = $stmt->get_result();
    $row92 = $result92->fetch_assoc();
    $count = $row92['count'];
    
}
error_reporting(0);
if (isset($_POST['submit'])) {
    $seguro = "mostrar";
    $opcion = $_POST['opcion'];
    $valores_separados = explode(",", $opcion);
    $apuesta = $valores_separados[0];
    $paga = $valores_separados[1];
    $cobra = $valores_separados[2];
    $nuevo_elo_p = $valores_separados[3]-$cobra;
    $nuevo_elo_g = $valores_separados[3]+$paga;
    if (!$cobra) {
        $seguro = "nomostrar";
    }                

}
if (isset($_POST['apostar'])) {
    $apuesta = $_POST['apuesta'];
    $paga = $_POST['paga'];
    $cobra = $_POST['cobra'];
    $nuevo_elo_p = $_POST['nuevo_elo_p'];
    $nuevo_elo_g = $_POST['nuevo_elo_g'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $sql = "INSERT INTO apuestas (usuario, id_partida, prediccion, apuesta, cobra)
            VALUES ('$_SESSION[username]', '$id', '$apuesta', '$paga', '$cobra')";
    $result = mysqli_query($conn, $sql);
        // La inserción fue exitosa
        header("Location: ronda.php?".$href."");
        exit;
   
}
if (isset($_POST['cancelar'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];}
    $seguro = "nomostrar";
    header("Location: subirApuesta.php?id=".$id."&torneo=".$torneo."");
    exit;
}
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
    <title>Hacer Prediccion</title>
    <style>
            input[type='radio'] {
        display: none;
    }

         .styled-table {
        border-collapse: collapse;
        width: 100%;
    }

    .styled-table th, .styled-table td {
        padding: 8px; /* Ajusta este valor para controlar el espaciado */
        border: 1px solid #ddd;
        text-align: center;
    }
    .green {
        color: green;
        font-weight: bold; /* Hace que el texto sea más audaz */
    }

    .red {
        color: red;
        font-weight: bold; /* Hace que el texto sea más audaz */
    }
    .confirmation-message {
    text-align: center; /* Centra el contenido */
    background-color: #f4f4f4;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 10px;
    font-size: 18px; /* Aumenta el tamaño del texto */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Agrega sombra */
}

.confirmation-message p {
    margin: 10px 0;
}




    /* Estilo para las etiquetas de los radios */
    /* Estilo para los botones de radio personalizados */
    label.radio-button {
        display: inline-block;
        background-color: #007BFF; /* Color de fondo para el botón */
        color: #fff; /* Color del texto */
        padding: 8px 16px; /* Espaciado interno para el botón */
        border: 1px solid #007BFF; /* Borde del botón */
        border-radius: 5px; /* Bordes redondeados */
        cursor: pointer;
    }

    /* Estilo para los radios seleccionados */
    input[type='radio']:checked + label.radio-button {
        background-color: #28A745; /* Cambiar el color de fondo cuando se selecciona */
        border: 1px solid #28A745; /* Cambiar el borde cuando se selecciona */
    }
    .button-container {
    text-align: right;
    margin-top: 20px;
    width: 98%; /* Establece el ancho del contenedor al 90% del ancho disponible */
}

.custom-button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.custom-button:hover {
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
    <form method="POST">
    <?php if($count == 0){ if($seguro != "mostrar"){ ?>
        <h1>Enfrentamientos del Torneo</h1>
        <table class="styled-table">
        <thead>
            <tr>
                <th>Jugador Blancas</th>
                <th>Jugador Negras</th>
                <th>Pagan Blancas</th>
                <th>Ganan Blancas</th>
                <th>Pagan Negras</th>
                <th>Ganan Negras</th>
                <th>Paga Empate</th>
                <th>Empate</th>
            </tr>
        </thead>
        <tbody>

                <?php
                // Conexión a la base de datos (reemplaza con tus propios valores)
                // Consulta para obtener los enfrentamientos del torneo desde la base de datos
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $query = "SELECT * FROM rondas WHERE id = '$id'";
                    //echo $queryTorneo;
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $inicio = $row['Inicio'];
                            date_default_timezone_set('America/Argentina/Buenos_Aires');
                            $fecha_actual = date("Y-m-d H:i:s");
                            //echo $inicio."<br>";
                            //echo $fecha_actual;
                            if ($inicio > $fecha_actual) {
                            // Obtiene los datos del Jugador 1
                            $sql = "SELECT j1.nombre, j1.elo, r.pts1 
                                    FROM jugadores j1, rondas r 
                                    WHERE r.nombreJugador1 = '{$row['nombreJugador1']}' AND 
                                          j1.nombre = '{$row['nombreJugador1']}'";
                            $resultJugador1 = $conn->query($sql);
                            
                            // Obtiene los datos del Jugador 2
                            $sql = "SELECT j2.nombre, j2.elo , r.pts2
                                    FROM jugadores j2, rondas r 
                                    WHERE r.nombreJugador2 = '{$row['nombreJugador2']}' AND 
                                          j2.nombre = '{$row['nombreJugador2']}'";
                            $resultJugador2 = $conn->query($sql);
                            
                            if ($resultJugador1->num_rows > 0 && $resultJugador2->num_rows > 0) {
                                $rowJugador1 = $resultJugador1->fetch_assoc();
                                $rowJugador2 = $resultJugador2->fetch_assoc();
                                $elo_blancas = $rowJugador1['elo'];
                                $elo_negras = $rowJugador2['elo'];
                                $diferencia_elo = $elo_blancas - $elo_negras;
                                $probabilidad_blancas = 33;
                                $probabilidad_negras = 24;
                                $probabilidad_empate = 43;
                                $ajuste = 0;
                        
                                if ($diferencia_elo >= 400) {
                                    $probabilidad_blancas = 94;
                                    $probabilidad_negras = 2.1;
                                    $probabilidad_empate = 3.9;
                                } elseif ($diferencia_elo <= -400) {
                                    $probabilidad_blancas = 3.1;
                                    $probabilidad_negras = 93;
                                    $probabilidad_empate = 3.9;
                                } elseif ($diferencia_elo > 0) {
                                    $ajuste = ($diferencia_elo / 400) * 30;
                                    $probabilidad_blancas += ($ajuste*2);
                                    $probabilidad_negras -= $ajuste;
                                    $probabilidad_empate -= $ajuste;
                                    
                                    // Aplicar límite superior
                                    $probabilidad_blancas = min(94, $probabilidad_blancas);
                                } elseif ($diferencia_elo < 0) {
                                    $ajuste = (-$diferencia_elo / 400) * 30;
                                    $probabilidad_blancas -= ($ajuste*2);
                                    $probabilidad_negras += $ajuste;
                                    $probabilidad_empate -= $ajuste;
                                    
                                    // Aplicar límite inferior
                                    $probabilidad_blancas = max(2.1, $probabilidad_blancas);
                                }
                        
                                // Asegurarse de que las probabilidades no sean negativas
                                $probabilidad_blancas = max(2.1, $probabilidad_blancas);
                                $probabilidad_empate = max(2.1, $probabilidad_empate);
                                $probabilidad_negras = max(2.1, (100-($probabilidad_blancas+$probabilidad_empate)));                        
                                // Asegúrate de que la suma de las probabilidades sea igual a 100
                                $suma_total = $probabilidad_blancas + $probabilidad_negras + $probabilidad_empate;
                                if ($suma_total != 100) {
                                    // Realiza un ajuste para que la suma total sea igual a 100
                                    $ajuste_total = 100 - $suma_total;
                                    $probabilidad_empate -= $ajuste_total;
                                }
                                //echo $probabilidad_blancas."<br>";
                                //echo $probabilidad_negras."<br>";
                                //echo $probabilidad_empate."<br>";
                                $queryh = "SELECT * FROM users WHERE username = '$_SESSION[username]'";
                                $resulth = $conn->query($queryh);
                                if ($resulth->num_rows > 0) {
                                while ($rowth = $resulth->fetch_assoc()) {
                                        $K = $rowth['K'];
                                        $elo = $rowth['elo'];
                                    }
                                }
                                $paga_blancas =number_format((2/$probabilidad_blancas) * $K, 2);
                                $paga_negras =number_format((2/$probabilidad_negras) * $K, 2);
                                $paga_empate =number_format((2/$probabilidad_empate) * $K, 2);
                                //echo $paga_blancas."<br>";
                                //echo $paga_negras."<br>";
                                //echo $paga_empate."<br>";
                                $cobra_blancas = number_format(max((0.04*$K), $paga_blancas/3.6), 2);
                                $cobra_negras = number_format(max((0.04*$K), $paga_negras/3.6), 2);
                                $cobra_empate = number_format(max((0.04*$K), $paga_empate/3.6), 2);

                                $elo_int = intval($elo);
                                $cobra_empate_formatted = number_format($cobra_empate, 2);
                                //echo $probabilidad_blancas."<br>";
                                //echo $probabilidad_negras."<br>";
                                //echo $probabilidad_empate_inicial."<br>";
                                echo "<tr>";
                                echo "<td>" . $rowJugador1['nombre'] . " (" . $rowJugador1['elo'] .")</td>";
                                echo "<td>" . $rowJugador2['nombre'] . " (" . $rowJugador2['elo'] .")</td>";
                                echo "<td><span class='green'>+". $paga_blancas."</span> / <span class='red'>- ".$cobra_blancas."</span></td>";
                                echo "<td><input type='radio' name='opcion' value='Ganan Blancas,".$paga_blancas.",".$cobra_blancas.",".$elo_int."' id='radio_blancas'><label class='radio-button' for='radio_blancas'>Blancas</label></td>";
                                echo "<td><span class='green'>+".$paga_negras."</span> / <span class='red'>- ".$cobra_negras."</span></td>";
                                echo "<td><input type='radio' name='opcion' value='Ganan Negras,".$paga_negras.",".$cobra_negras.",".$elo_int."' id='radio_negras'><label class='radio-button' for='radio_negras'>Negras</label></td>";
                                echo "<td><span class='green'>+".$paga_empate."</span> / <span class='red'>- ".$cobra_empate."</span></td>";
                                echo "<td><input type='radio' name='opcion' value='Empatan,".$paga_empate.",".$cobra_empate.",".$elo_int."' id='radio_empate'><label class='radio-button' for='radio_empate'>Empate</label></td>";
                                echo "</tr>";
                            }
                    }elseif ($inicio < $fecha_actual) {
                        echo "<tr><td colspan='5'>Esta partida ya está en juego</td></tr>";
                    }
                }
                } else {
                    echo "<tr><td colspan='5'>No hay enfrentamientos registrados.</td></tr>";
                }
            }

        } if ($seguro == "mostrar") {
            echo "<div class='confirmation-message'>
                    <p>Vas a apostar por <strong>".$apuesta."</strong> en la partida: A vs B.</p>
                    <p>Si pierdes, Tu nuevo elo será: <strong>".$nuevo_elo_p."</strong>. Si ganas, tu nuevo elo será: <strong>".$nuevo_elo_g."</strong></p>
                  </div>";
        }} elseif ($count > 0) {
            echo "<tr><td colspan='5'>Ya hiciste una apuesta por esta partida</td></tr>";
        }
        
                ?>
            </tbody>
        </table>
        <div class="button-container">
            <?php if($seguro != "mostrar"){ if($count == 0){ ?>
            <input type='submit' name='submit' value='Apostar' class='custom-button'></input>
            <?php }} if($seguro == "mostrar"){ ?>
                <input type='hidden' name='apuesta' value='<?=$apuesta?>'></input>
                <input type='hidden' name='paga' value='<?=$paga?>'></input>
                <input type='hidden' name='cobra' value='<?=$cobra?>'></input>
                <input type='hidden' name='nuevo_elo_p' value='<?=$nuevo_elo_p?>'></input>
                <input type='hidden' name='nuevo_elo_g' value='<?=$nuevo_elo_g?>'></input>
                <input type='submit' name='apostar' value='Hacer Apuesta' class='custom-button'></input>
                <input type='submit' name='cancelar' value='Cancelar' class='custom-button'></input>
                <?php } ?>
        </div>
        </form>
    </div>
    <a href="./ronda.php?<?php echo $href; ?>">Salir</a>
</body>
</html>
