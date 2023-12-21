<?php
include "./db.php";
require_once 'Classes/PHPExcel/IOFactory.php'; // Carga PHPExcel
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ./index.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //echo $id;
if (isset($_POST['submit'])) {
	$nombre = $_POST['nombre'];
	$rondas = $_POST['rondas'];
	$inicio = $_POST['inicio'];
	$fin = $_POST['fin'];
    $lugar = $_POST['lugar'];
    $opcion = $_POST['opcion'];
    if ($nombre != "") {    
		$sql = "SELECT * FROM torneos WHERE nombre='$nombre'";
		$result = mysqli_query($conn, $sql);
		if (!($result->num_rows > 0)) {
			$sql = "INSERT INTO torneos (nombre, rondas, fechaInicio, fechaFinal, ubicacion)
					VALUES ('$nombre', '$rondas', '$inicio', '$fin', '$lugar')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "Torneo Creado!</br>";
			} else {
				echo "Error";
			}
        }
            $sql = "SELECT * FROM torneos WHERE nombre='$nombre'";
            $result2 = $conn->query($sql);
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $idj = $row2['id']."</li>";
                }
            }


// Verifica si se ha subido un archivo
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    $archivoTmp = $_FILES['archivo']['tmp_name'];

    // Carga el archivo XLSX
    $objPHPExcel = PHPExcel_IOFactory::load($archivoTmp);
    $worksheet = $objPHPExcel->getActiveSheet();

    // Obtén la fila 5 (donde se encuentran los nombres de columna)
    $columnNames = [];
    foreach ($worksheet->getRowIterator(5, 5) as $row) {
        $cellIterator = $row->getCellIterator();
        foreach ($cellIterator as $cell) {
            $columnNames[] = $cell->getValue();
        }
    }

    // Verifica si las celdas contienen "nombre" y "Elo"
    $nombreColumn = array_search("Nombre", $columnNames);
    //var_dump($columnNames);
    $eloColumn = array_search("Elo", $columnNames);
    $ptsColumn = array_search("Pts. ", $columnNames);

    if ($nombreColumn !== false && $eloColumn !== false) {
        $posicion = 1;
        // Itera a través de las filas del archivo XLSX a partir de la fila 6
        foreach ($worksheet->getRowIterator(6) as $row) {
            // Obtén los valores de cada celda en la fila
            $cellIterator = $row->getCellIterator();
            $datos = [];
            foreach ($cellIterator as $cell) {
                $datos[] = $cell->getValue();
            }
            $nombre = $datos[$nombreColumn];
            $elo = $datos[$eloColumn];
            $pts = $datos[$ptsColumn];
            $nombre = str_replace("'", " ", $nombre);
            //echo $datos[$ptsColumn];
            if ($id == 2) {
                if ($pts == "") {
                    $pts = 0;
                }
                //$pts = floatval($pts);
                
            
                $query = "UPDATE jugadorestorneo SET puntos = '$pts', posicionFinal = '$posicion' WHERE nombreJugador = '$nombre'";
                
                // Ejecutar la consulta SQL directamente (sin preparación)
                $result = $conn->query($query);
            
                // Imprimir la consulta SQL con los valores reales
                echo "Query: " . $query . "<br>";
            }
            // Verifica si ya existe un jugador con el mismo nombre en la base de datos
            $query = "SELECT COUNT(*) as count FROM jugadores WHERE nombre = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $nombre);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $count = $row['count'];
            if ($nombre) {
            // Inserta el jugador en la base de datos solo si no existe otro con el mismo nombre
            if ($count == 0 && $opcion="Si") {
                $sql = "INSERT INTO jugadores (nombre, elo) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $nombre, $elo);
                $stmt->execute();
                if ($elo > 2499) {
                    $acciones = 25;
                }elseif ($elo > 2449) {
                    $acciones = 27;
                }elseif ($elo > 2399) {
                    $acciones = 30;
                }elseif ($elo > 2299) {
                    $acciones = 40;
                }elseif ($elo > 2199) {
                    $acciones = 50;
                }elseif ($elo > 2099) {
                    $acciones = 70;
                }elseif ($elo > 1999) {
                    $acciones = 90;
                }elseif ($elo > 1899) {
                    $acciones = 100;
                }elseif ($elo == 0){
                    $acciones = 90;
                }else{
                    $acciones = 120;
                }
                $sql2 = "INSERT INTO mercado (nombre_jugador, acciones_disp) VALUES (?, ?)";
                $stmt = $conn->prepare($sql2);
                $stmt->bind_param("ss", $nombre, $acciones);
                $stmt->execute();
            } else if ($count > 0 && $opcion="Si") {
                $sql = "UPDATE jugadores SET elo = ? WHERE nombre = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $elo, $nombre);
                $stmt->execute();
            }
                $sql = "INSERT INTO jugadoresTorneo (nombreJugador, id_torneo) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $nombre, $idj);
                $stmt->execute();
            }
            $posicion++;
        }

        echo "Datos y archivo procesados y guardados en la base de datos.";		
    }else {
        echo "No hay Elo o Nombres en la tabla";
    }
}

}else {
    echo "No tiene Nombre";
}
}
}
?>

<!DOCTYPE html>
<html lang="en">
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
<head>
    <meta charset="UTF-8">
    <?php if ($id == 1) {?>
    <title>Subir Torneo</title>
</head>
<body>
    <h1>Subir Torneo</h1>
    <p><strong>Instrucciones:</strong></p>
        <ul>
            <li>Abrir el torneo en chess-results.</li>
            <li>Seleccionar "Ranking inicial".</li>
            <li>Seleccionar "No mostrar detalles del torneo".</li>
            <li>Seleccionar "No mostrar banderas".</li>
            <li>Seleccionar "Exportar a Excel (.xlsx)".</li>
        </ul>
    <?php } ?>
    <?php if ($id == 2) {?>
    <title>Subir Tabla final</title>
</head>
<body>
    <h1>Subir Tabla final</h1>
    <?php } ?>
    <form action="cargarTorneo.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
    <?php if ($id == 1) {?>
        <div>
            <label for="nombre">Nombre del torneo:</label>
            <input type="text" name="nombre"  >
        </div>
        <div>
            <label for="rondas">Cantidad de Rondas:</label>
            <input type="number" name="rondas"  >
        </div>
        <div>
            <label for="inicio">Fecha de Inicio:</label>
            <input type="date" name="inicio"  >
        </div>
        <div>
            <label for="fin">Fecha Final:</label>
            <input type="date" name="fin"  >
        </div>
        <div>
            <label for="lugar">Ubicación:</label>
            <input type="text" name="lugar" value="Argentina">
        </div>
        <div>
        <p>Es Valido para el elo FIDE Standard?</p>
        <input type="radio" name="opcion" value="Si" id="pareos" checked> Valido
        </div>
        <div>
        <?php } ?>
        <?php if ($id == 2) {?>
            <div>
        <label for="buscar">Buscar Torneo:</label>
        <input type="text" name="buscar" id="buscar">
        <input type="submit" name="busco" value="Buscar Torneo">
    </div>
    </form>
    <form action="cargarTorneo.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
    <div>
        <label for="nombre">Torneo:</label>
        <select name="nombre" id="nombre">
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
        <?php } ?>
            <label for="archivo">Archivo XLSX:</label>
            <input type="file" name="archivo" accept=".xlsx"  >
        </div>
        <div>
            <input type="submit" name="submit" value="Subir Archivo y Datos">
        </div>
    </form>
    <a href="./chessbet.php">Salir</a>
</body>
</html>
