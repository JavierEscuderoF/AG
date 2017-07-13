<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lugares</title>
        <link rel="stylesheet" href="../AG.css" />
        <link rel="icon" 
              type="image/png" 
              href="tree.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php include '../utilidades/utilidades.php'; ?>
    </head>
    <body>
        <header>
            <div class="topnav" id="myTopnav">
                <a href="../index.php">Home</a>
            </div>
        </header>
        <h2>Lista de lugares</h2>

        <?php
        $db = conectar_bd();
        $query = "
            SELECT *
            FROM Lugares;";
        $resultado = mysqli_query($db, $query);

        if ($resultado->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Lugar</th><th>Mapa</th></tr>';
            while ($lugares = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                columna($lugares['nombre'], 0);
                $mapa = '<a href=mapa.php?id=' . $lugares['idLugar'] . '>🌍</a>';
                columna($mapa, 1);
                echo '</tr>';
            }
            echo '</table>';
        }
        ?>
    </body>
</html>
