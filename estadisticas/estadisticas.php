<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <div class="topnav" id="myTopnav">
        <a href="../index.php">Home</a>
        <a href="../estadisticas/estadisticas.php">Estadísticas</a>
        <link rel="stylesheet" href="../AG.css" />
        <link rel="icon" 
              type="image/png" 
              href="tree.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php include '../utilidades/utilidades.php'; ?>
    </div>
    <meta charset="UTF-8">
    <title>Estadísticas</title>
</head>
<body>
    <h2>Estadísticas</h2>

    <div class="formEstad">
        <h3>Bautismos enlazados</h3>
        <?php
        $db = conectar_bd();
        if ($db->connect_error) {
            die("Unable to connect database: " . $db->connect_error);
        }
        $contar = "SELECT COUNT(familia), COUNT(*), ROUND(COUNT(familia)/COUNT(*)*100,2), tomo
FROM personas
    JOIN referenciaspersona ON idPersonaFK = idPersona
    JOIN referencias ON idReferenciaFK = idReferencia
GROUP BY tomo";
        $resultado_contar = mysqli_query($db, $contar);

        while ($fila = mysqli_fetch_row($resultado_contar)) {
            echo '<a href="../colecciones/coleccion.php?id=2'
            . '&tomo=' . $fila[3] . '">Tomo ' . $fila[3] . '</a>';
            echo ": " . $fila[0] . " de " . $fila[1] . " (" . $fila[2] . "%)<br>";
            echo '<div class="percentbar" ;">';
            echo '<div style="width:';
            echo round($fila[2]);
            echo '%;"></div>';
            echo '</div>';
        }
        echo '<br>';
        ?>
    </div>

    <div class="formEstad">
        <h3>Maridos enlazados</h3>
        <?php
        $contar = "
            SELECT COUNT(esposo), COUNT(*), ROUND(COUNT(esposo)/COUNT(*)*100,2), R.tomo
            FROM familias F 
                JOIN referenciasmatrimonio RM ON F.idFamilia = RM.idMatrimonioFK 
                JOIN referencias R ON RM.idReferenciaFK = R.idReferencia
            GROUP BY R.tomo;";
        $resultado_contar = mysqli_query($db, $contar);

        while ($fila = mysqli_fetch_row($resultado_contar)) {
            echo '<a href="../colecciones/coleccion.php?id=1'
            . '&tomo=' . $fila[3] . '">Tomo ' . $fila[3] . '</a>';
            echo ": " . $fila[0] . " de " . $fila[1] . " (" . $fila[2] . "%)<br>";
            echo '<div class="percentbar" ;">';
            echo '<div style="width:';
            echo round($fila[2]);
            echo '%;"></div>';
            echo '</div>';
        }
        echo '<br>';
        ?>
    </div>
    <div class="formEstad">
        <h3>Mujeres enlazadas</h3>
        <?php
        $contar = "
            SELECT COUNT(esposa), COUNT(*), ROUND(COUNT(esposa)/COUNT(*)*100,2), R.tomo
            FROM familias F 
                JOIN referenciasmatrimonio RM ON F.idFamilia = RM.idMatrimonioFK 
                JOIN referencias R ON RM.idReferenciaFK = R.idReferencia
            GROUP BY R.tomo;";
        $resultado_contar = mysqli_query($db, $contar);

        while ($fila = mysqli_fetch_row($resultado_contar)) {
            echo '<a href="../colecciones/coleccion.php?id=1'
            . '&tomo=' . $fila[3] . '">Tomo ' . $fila[3] . '</a>';
            echo ": " . $fila[0] . " de " . $fila[1] . " (" . $fila[2] . "%)<br>";
            echo '<div class="percentbar" ;">';
            echo '<div style="width:';
            echo round($fila[2]);
            echo '%;"></div>';
            echo '</div>';
        }
        echo '<br>';
        ?>
    </div>
    <div class="clear"/>
</body>
</html>
