<?php
include "./db.php";
require_once 'Classes/PHPExcel/IOFactory.php'; // Carga PHPExcel
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ./index.php");
}
if (isset($_POST['submit'])) {
    $torneo = $_POST['torneo'];
    $ronda = $_POST['rondas'];
    $inicio = $_POST['inicio'];
    $resultado = ($_POST['opcion']=="Resultados")?"True":"False";
    //echo $resultado;
    if($resultado != "True"){
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $archivoTmp = $_FILES['archivo']['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($archivoTmp);
        $worksheet = $objPHPExcel->getActiveSheet();
        $data = [];
        $startRow = 7; // Fila donde comienzan los datos
        $endRow = $worksheet->getHighestRow();
    for ($rowIndex = $startRow; $rowIndex <= $endRow; $rowIndex++) {
        $rowData = [];
        $valoresConsideradosVacios = ["GM", "IM", "FM", "CM", "WGM", "WIM", "WFM", "WCM", "AGM", "AIM", "AFM", "ACM"];
            $rowData['nombreBlancas'] = $worksheet->getCellByColumnAndRow(2, $rowIndex)->getValue(); // Columna D
            $rowData['pts1'] = $worksheet->getCellByColumnAndRow(4, $rowIndex)->getValue(); // Columna F
            $rowData['pts2'] = $worksheet->getCellByColumnAndRow(6, $rowIndex)->getValue(); // Columna H
            $rowData['nombreNegras'] = $worksheet->getCellByColumnAndRow(7, $rowIndex)->getValue(); // Columna J     
        if((empty(($rowData['nombreBlancas'])) || in_array($rowData['nombreBlancas'], $valoresConsideradosVacios)) || empty($rowData['pts1']) || empty($rowData['pts2']) || empty($rowData['nombreNegras'])) {
            $rowData['nombreBlancas'] = $worksheet->getCellByColumnAndRow(3, $rowIndex)->getValue(); // Columna E
            $rowData['pts1'] = $worksheet->getCellByColumnAndRow(5, $rowIndex)->getValue(); // Columna G
            $rowData['pts2'] = $worksheet->getCellByColumnAndRow(7, $rowIndex)->getValue(); // Columna I
            $rowData['nombreNegras'] = $worksheet->getCellByColumnAndRow(9, $rowIndex)->getValue(); // Columna K
        }
        $data[] = $rowData;
    }
        foreach ($data as $row) {
            $nombreBlancas = $row['nombreBlancas'];
            $pts1 = $row['pts1'];
            $pts2 = $row['pts2'];
            $nombreNegras = $row['nombreNegras'];
            $sql = "INSERT INTO rondas (nombreTorneo, n°Ronda, nombreJugador1, pts1, nombreJugador2, pts2, Inicio) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $torneo, $ronda, $nombreBlancas, $pts1, $nombreNegras, $pts2, $inicio);
            //echo "".$torneo. $ronda. $nombreBlancas. $pts1. $nombreNegras. $pts2."</br>";
            $stmt->execute();
        }
        echo "Datos procesados y guardados en la base de datos.";
    } else {
        echo "Error al subir el archivo.";
    }}else{
        $archivoTmp = $_FILES['archivo']['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($archivoTmp);
        $worksheet = $objPHPExcel->getActiveSheet();
        $data = [];
        $startRow = 7; // Fila donde comienzan los datos
        $endRow = $worksheet->getHighestRow();    
        for ($rowIndex = $startRow; $rowIndex <= $endRow; $rowIndex++) {
            $rowData = [];
            $rowData['nombreJugador1'] = $worksheet->getCellByColumnAndRow(3, $rowIndex)->getValue(); // Columna C
            $rowData['nombreJugador2'] = $worksheet->getCellByColumnAndRow(9, $rowIndex)->getValue(); // Columna D
    
            // Verifica si la celda en la columna G (resultado) está vacía antes de acceder a su valor
            $resultadoCell = $worksheet->getCellByColumnAndRow(6, $rowIndex);
            if (!is_null($resultadoCell) && !empty($resultadoCell)) {
                $rowData['resultado'] = $resultadoCell->getValue(); // Columna G
            } else {
                $rowData['resultado'] = ''; // Establece un valor predeterminado en caso de celda vacía
            }
    
            $data[] = $rowData;
        }
    
        // Actualiza la tabla "rondas" si los datos coinciden
        foreach ($data as $row) {
            $nombreTorneo = $torneo;
            $nombreJugador1 = $row['nombreJugador1'];
            $nombreJugador2 = $row['nombreJugador2'];
            $resultado = $row['resultado'];
            //echo ";".$resultado;
            
            // Realiza la actualización de datos en la tabla "rondas" si la coincidencia existe
            $sql = "UPDATE rondas SET resultado = ? WHERE nombreTorneo = ? AND n°Ronda = ? AND nombreJugador1 = ? AND nombreJugador2 = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $resultado, $nombreTorneo, $ronda, $nombreJugador1, $nombreJugador2);
            //echo $querySQL;
            $stmt->execute();

            $query = "SELECT * FROM rondas WHERE resultado = '$resultado' AND nombreTorneo = '$nombreTorneo' AND n°Ronda = '$ronda' AND nombreJugador1 = '$nombreJugador1' AND nombreJugador2 = '$nombreJugador2'";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                $id_partida = $row['id'];
            }

            $query = "SELECT * FROM apuestas WHERE id_partida = '$id_partida'";
            $result = $conn->query($query);
            if (strlen($resultado) > 3) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $usuario = $row['usuario'];
                $prediccion = $row['prediccion'];
                $apuesta = $row['apuesta'];
                $cobra = $row['cobra'];
                $acerto = "";

                if ($resultado === "1 - 0") {
                    if ($prediccion == "Ganan Blancas") {
                        $acerto = "SI";
                    }if ($prediccion == "Ganan Negras") {
                        $acerto = "NO";
                    }if ($prediccion == "Empatan") {
                        $acerto = "NO";
                    }
                }else if ($resultado === "½ - ½") {
                    if ($prediccion == "Ganan Blancas") {
                        $acerto = "NO";
                    }if ($prediccion == "Ganan Negras") {
                        $acerto = "NO";
                    }if ($prediccion == "Empatan") {
                        $acerto = "SI";
                    }
                }else if ($resultado === "0 - 1") {
                    if ($prediccion == "Ganan Blancas") {
                        $acerto = "NO";
                    }if ($prediccion == "Ganan Negras") {
                        $acerto = "SI";
                    }if ($prediccion == "Empatan") {
                        $acerto = "NO";
                    }
                } else {
                    $acerto = "NADA";
                }


                $query86 = "SELECT * FROM users WHERE username = '$usuario'";
                $result86 = $conn->query($query86);
                while ($row86 = $result86->fetch_assoc()) {
                    $elo = $row86['elo'];
                }
                
                if ($acerto == "SI") {
                    $transaccion_final = "+".$apuesta;
                    $elo += $apuesta;
                }if ($acerto == "NO") {
                    $transaccion_final = "-".$cobra;
                    $elo -= $cobra;
                }if ($acerto == "NADA") {
                    $transaccion_final = "0";
                }if ($acerto == "") {
                    $transaccion_final = "0.0";
                }
                if ($id == "77") {
                    # code...
                }


                $sql8 = "UPDATE apuestas SET resultado = ?, transaccion_final = ?, transaccion_finalizada = ? WHERE id_partida = ? AND usuario = ?";
                $true = "TRUE";
                $stmt = $conn->prepare($sql8);
                $stmt->bind_param("sssss", $resultado, $transaccion_final, $true, $id_partida, $usuario);
                $querySQL2 = "UPDATE apuestas SET resultado = '$resultado', transaccion_final = '$transaccion_final', transaccion_finalizada = '$true' WHERE id_partida = '$id_partida' AND usuario = '$usuario";
                $stmt->execute();

                $sql9 = "UPDATE users SET elo = ? WHERE username = ?";
                $stmt = $conn->prepare($sql9);
                $stmt->bind_param("ss", $elo, $usuario);
                $querySQL = "UPDATE users SET elo = $elo WHERE username = $usuario";
                //echo $querySQL2."  //--//  ".$querySQL."<br>";
                $stmt->execute();
            }
        }



        }
    
    echo "Resultados actualizados en la base de datos.";

}
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subir Archivo XLSX</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="file"] {
            width: 100%;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007bff;
            display: block;
            margin-top: 10px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0 20px; /* Added padding to create left margin */
        }
        h1 {
            color: #007bff;
        }
        p {
            font-size: 16px;
            margin: 20px 0;
        }
        p strong {
            color: #333;
        }
        ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        a {
            text-decoration: none;
            color: #007bff;
            display: block;
            margin-top: 20px;
        }
    </style>
<body>
    <h1>Subir Archivo XLSX y Datos Adicionales</h1>
    <p><strong>Instrucciones:</strong></p>
        <ul>
            <li>Abrir el torneo en chess-results.</li>
            <li>Seleccionar la ronda.</li>
            <li>Seleccionar "No mostrar detalles del torneo".</li>
            <li>Seleccionar "No mostrar banderas".</li>
            <li>Seleccionar "Exportar a Excel (.xlsx)".</li>
            <li><strong>Importante:</strong> Debe subirse primero el pareo, y luego los resultados.</li>

        </ul>
    <form action="cargarRonda.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="buscar">Buscar Torneo:</label>
        <input type="text" name="buscar" id="buscar">
        <input type="submit" name="busco" value="Buscar Torneo">
    </div>
    </form>
    <form action="cargarRonda.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="nombre">Torneo:</label>
        <select name="torneo" id="torneo">
            <?php
            $query = "SELECT nombre FROM torneos";
            if (isset($_POST['buscar'])) {
                $buscar = $_POST['buscar'];
                $query .= " WHERE nombre LIKE '%$buscar%'";
            }
            $result = $conn->query($query);
            // Muestra los torneos como opciones en el campo de selección
            while ($row = $result->fetch_assoc()) {
                $nombreTorneo = $row['nombre'];
                echo "<option value='$nombreTorneo'>$nombreTorneo</option>";
            }
            ?>
        </select>
    </div>
    <div>
        <label for="rondas">Ronda N°:</label>
        <input type="number" name="rondas" required>
    </div>
    <div>
        <p>Son Emparejamientos o Resultados?</p>
        <input type="radio" name="opcion" value="Pareos" id="pareos" checked> Pareos
        <input type="radio" name="opcion" value="Resultados" id="resultados"> Resultados
    </div>
    <div>
        <label for="archivo">Archivo XLSX:</label>
        <input type="file" name="archivo" accept=".xlsx">
    </div>
    <div>
    <label for="inicio">Inicio:</label>
        <input type="datetime-local" name="inicio" id="inicio">
    </div>
    <div>
        <input type="submit" name="submit" value="Subir Archivo y Datos" onclick="return validarFormulario();">
    </div>
</form>

<script>
function validarFormulario() {
    var opcionPareos = document.getElementById('pareos').checked;
    var campoInicio = document.getElementById('inicio');

    if (opcionPareos && campoInicio.value === "") {
        alert("Es obligatorio poner un horario de inicio para evitar apuestas tardías");
        return false; // Evita que el formulario se envíe
    }
    return true; // Envía el formulario si todo está bien
}
</script>
<a href="./chessbet.php">Salir</a>
</body>
</html>