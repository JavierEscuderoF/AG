<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../AG.css" />
        <link rel="icon" 
              type="image/png" 
              href="tree.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php include 'utilidades.php'; ?>
    </head>
    <body>
        <?php
        $idFamilia = filter_input(INPUT_POST, "familiaEscogida");
        $idPadres = filter_input(INPUT_POST, "matrimonio");
        $idMarido = filter_input(INPUT_POST, "marido");
        $idMujer = filter_input(INPUT_POST, "mujer");

        if ($idFamilia) {
            $hermanos = implode(', ', $_POST['hermanosEscogidos']);

            $query = "
            UPDATE personas SET familia = " . $idFamilia .
                    " WHERE idPersona IN (" . $hermanos . ");";

            $db = conectar_bd();

            mysqli_query($db, $query);

            if (mysqli_affected_rows($db) >= 1) {
                echo "<p>Base de datos actualizada<p>";
            } else {
                echo "<p>No se ha podido actualizar<p>";
            }
        } else if ($idPadres) {
            $query = 'UPDATE familias SET espos';
            if (isset($idMarido) && $idMarido) {
                $query .= 'o=' . $idMarido;
            } else {
                $query .= 'a=' . $idMujer;
            }
            $query .= ' WHERE idFamilia=' . $idPadres . ';';
            $db = conectar_bd();
            
            mysqli_query($db, $query);

            if (mysqli_affected_rows($db) >= 1) {
                echo "<p>Base de datos actualizada<p>";
            } else {
                echo "<p>No se ha podido actualizar<p>";
            }
        }
        ?>
        <br>
        <a href="javascript:history.back()">Volver</a>
    </body>
</html>
