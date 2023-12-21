<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Probabilidades de Ajedrez</title>
</head>
<body>
    <h1>Calculadora de Probabilidades de Ajedrez</h1>
    <form method="post" action="">
        <label for="elo_blancas">Elo de las blancas:</label>
        <input type="number" name="elo_blancas" required value="<?php echo isset($_POST['elo_blancas']) ? $_POST['elo_blancas'] : ''; ?>"><br>

        <label for="elo_negras">Elo de las negras:</label>
        <input type="number" name="elo_negras" required value="<?php echo isset($_POST['elo_negras']) ? $_POST['elo_negras'] : ''; ?>"><br>

        <input type="submit" value="Calcular Probabilidades">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $elo_blancas = $_POST["elo_blancas"];
        $elo_negras = $_POST["elo_negras"];

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
        

        $suma_total = $probabilidad_blancas + $probabilidad_negras + $probabilidad_empate;

        echo "<h2>Resultados:</h2>";
        echo "Probabilidad de que las blancas ganen: $probabilidad_blancas%<br>";
        echo "Probabilidad de que las negras ganen: $probabilidad_negras%<br>";
        echo "Probabilidad de empate: $probabilidad_empate%<br>";

        if ($suma_total != 100) {
            echo "La suma total de probabilidades no es igual a 100. Se ha realizado un ajuste.";
        }
    }
    ?>
</body>
</html>
