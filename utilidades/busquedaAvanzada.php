<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Búsqueda Avanzada</title>
        <link rel="stylesheet" href="../AG.css" />
        <link rel="icon" 
              type="image/png" 
              href="tree.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php include 'utilidades.php'; ?>
    </head>
    <body>
        <header>
            <div class="topnav" id="myTopnav">
                <a href="../index.php">Home</a>
                <b id="logout"><a href="../logout.php">Log Out</a></b>
            </div>
        </header>
        <?php
        $id_Persona = filter_input(INPUT_GET, 'persona');
        $id_FamiliaH = filter_input(INPUT_GET, 'marido');
        $id_FamiliaM = filter_input(INPUT_GET, 'mujer');
        $db = conectar_bd();

        if ($id_Persona) {
            $query_nombres = "
        SELECT nombrePadre, apellidoPadre, nombreMadre, apellidoMadre 
        FROM personas
        WHERE idPersona = " . $id_Persona . ";";
            $persona = buscar_unico($query_nombres, $db);
        } if ($id_FamiliaH || $id_FamiliaM) {
            $query_familias = "
        SELECT 
            nombrePadre_Marido, apellidoPadre_Marido, nombreMadre_Marido, apellidoMadre_Marido, 
            nombrePadre_Esposa, apellidoPadre_Esposa, nombreMadre_Esposa, apellidoMadre_Esposa
        FROM familias
        WHERE idFamilia=";
            if ($id_FamiliaH) {
                $query_familias .= $id_FamiliaH;
            } else {
                $query_familias .= $id_FamiliaM;
            }
            $query_familias .= " ;";
            $conyuge = buscar_unico($query_familias, $db);
        }
        ?>
        <form action="resultados.php" method="post">
            <?php
            if ($id_Persona) {
                echo '<input type="hidden" name="idPersona" value="' . $id_Persona . '">';
            } else if ($id_FamiliaH) {
                echo '<input type="hidden" name="idMarido" value="' . $id_FamiliaH . '">';
            } else if ($id_FamiliaM) {
                echo '<input type="hidden" name="idMujer" value="' . $id_FamiliaM . '">';
            }
            ?>
            <h2><?php
                if ($id_Persona) {
                    echo 'Búsqueda de candidatos';
                } else {
                    echo 'Búsqueda avanzada';
                }
                ?>
            </h2>
            <label for="coleccionMatrimonios">Buscar matrimonios en:</label>
            <select name="coleccionMatrimonios">
                <option value="0" selected>Todos</option>
                <option value="1" >Matrimonios de Santa María la Blanca</option>
            </select>
            <label for="coleccionBautismos">Buscar personas en:</label>
            <select name="coleccionBautismos">
                <option value="2" selected>Bautismos de Santa María la Blanca</option>
            </select>
            <br><br>
            <label for="fechaInicio">Fecha de inicio / fin:</label>
            <input type="date" name="fechaInicio" >
            <input type="date" name="fechaFin" >
            <br>
            <div class="subformulario">
                <h3>Marido</h3>
                <label for="nombreMarido">Nombre:</label><input type="text" name="nombreMarido" 
                <?php
                if ($id_Persona) {
                    echo ' value="' . $persona['nombrePadre'] . '"';
                } else if ($id_FamiliaH) {
                    echo ' value="' . $conyuge['nombrePadre_Marido'] . '"';
                } else if ($id_FamiliaM) {
                    echo ' value="' . $conyuge['nombrePadre_Esposa'] . '"';
                }
                ?>>
                <label for="apellidoMadre_Esposa">Apellido:</label><input type="text" name="apellidoMarido" 
                <?php
                if ($id_Persona) {
                    echo ' value="' . $persona['apellidoPadre'] . '"';
                } else if ($id_FamiliaH) {
                    echo ' value="' . $conyuge['apellidoPadre_Marido'] . '"';
                } else if ($id_FamiliaM) {
                    echo ' value="' . $conyuge['apellidoPadre_Esposa'] . '"';
                }
                ?>>
            </div>

            <div class="subformulario">
                <h3>Mujer</h3>
                <label for="nombreMujer">Nombre:</label><input type="text" name="nombreMujer"
                <?php
                if ($id_Persona) {
                    echo ' value="' . $persona['nombreMadre'] . '"';
                } else if ($id_FamiliaH) {
                    echo ' value="' . $conyuge['nombreMadre_Marido'] . '"';
                } else if ($id_FamiliaM) {
                    echo ' value="' . $conyuge['nombreMadre_Esposa'] . '"';
                }
                ?>>
                <label for="apellidoMujer">Apellido:</label><input type="text" name="apellidoMujer"
                <?php
                if ($id_Persona) {
                    echo ' value="' . $persona['apellidoMadre'] . '"';
                } else if ($id_FamiliaH) {
                    echo ' value="' . $conyuge['apellidoMadre_Marido'] . '"';
                } else if ($id_FamiliaM) {
                    echo ' value="' . $conyuge['apellidoMadre_Esposa'] . '"';
                }
                ?>>
            </div>
            <div class="clear"></div>
            <input type="Submit" value="Buscar">
            <input type="reset">
        </form>
    </body>
</html>
