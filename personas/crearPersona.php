<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <div class="topnav" id="myTopnav">
        <a href="../index.php">Home</a>
        <a href="javascript:history.back()">Volver</a>
    </div>
    <title>Nueva persona</title>
    <link rel="stylesheet" href="../AG.css" />
    <link rel="icon" 
          type="image/png" 
          href="tree.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <?php include '../utilidades/utilidades.php'; ?>

</head>
<body>
    <header>
        <h2>
            Insertar nueva persona en la base de datos
        </h2>
        <form action="../utilidades/update.php" method="post">
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="target" value="persona">

            <?php
            $fh = filter_input(INPUT_GET, 'fh');
            $fm = filter_input(INPUT_GET, 'fm');
            if ($fh) {
                echo '<input type="hidden" name="fh" value="' . $fh . '>';
            } else {
                echo '<input type="hidden" name="fm" value="' . $fm . '>';
            }
            ?>

            <?php
            $db = conectar_bd();
            $query_coleccion = "SELECT * FROM colecciones";
            $resultado_coleccion = mysqli_query($db, $query_coleccion);

            if ($fh) {
                $esposo = buscar_unico(consulta('familias', $fh), $db);
            } else if ($fm) {
                $esposa = buscar_unico(consulta('familias', $fm), $db);
            }
            ?>
            <select name="coleccion">
                <option value="">Selecciona colección</option>
                <?php
                while ($fila = mysqli_fetch_row($resultado_coleccion)) {
                    ?>
                    <option value="<?php echo $fila[0]; ?>"><?php echo $fila[1]; ?></option>
                    <?php
                }
                ?>
            </select>

            <label for="tomo">Tomo:</label>
            <input class="tercio" type="text" name="tomo" >
            <label for="folio">Folio:</label>
            <input class="tercio" type="text" name="folio" >
            <select class="tercio" name="vuelto">
                <option value="0">recto</option>
                <option value="1">vuelto</option>
            </select>
            <br>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" 
            <?php
            if ($fh) {
                echo ' value="' . $esposo['nombreMarido'] . '"';
            } else if ($fm) {
                echo ' value="' . $esposa['nombreEsposa'] . '"';
            }
            ?>>
            <label for="fechaNacimiento">Fecha de nacimiento:</label>
            <input type="text" name="fechaNacimiento" >
            <br>
            <label for="lugarNacimiento">Lugar de nacimiento (<a href="../lugares/crearLugar.php">➕</a>):</label>
            <select name="lugarNacimiento">
                <option value="">Selecciona lugar de nacimiento</option>
                <?php
                $query_lugares = "SELECT * FROM lugares ORDER BY nombre";
                $resultado_lugares = mysqli_query($db, $query_lugares);

                while ($fila = mysqli_fetch_row($resultado_lugares)) {
                    ?>
                    <option value="<?php echo $fila[0]; ?>">
                        <?php echo $fila[1]; ?></option>
                    <?php
                }
                ?>
            </select><br>
            <div class="subformulario">
                <h3>Padre</h3>
                <label for="nombrePadre">Nombre:</label>
                <input type="text" name="nombrePadre" <?php
                if ($fh) {
                    echo ' value="' . $esposo['nombrePadre_Marido'] . '"';
                } else if ($fm) {
                    echo ' value="' . $esposa['nombrePadre_Esposa'] . '"';
                }
                ?>>
                <label for="apellidoPadre">Apellido:</label>
                <input type="text" name="apellidoPadre" <?php
                if ($fh) {
                    echo ' value="' . $esposo['apellidoPadre_Marido'] . '"';
                } else if ($fm) {
                    echo ' value="' . $esposa['apellidoPadre_Esposa'] . '"';
                }
                ?>>
            </div>

            <div class="subformulario">
                <h3>Madre</h3>
                <label for="nombreMadre">Nombre:</label>
                <input type="text" name="nombreMadre" <?php
                if ($fh) {
                    echo ' value="' . $esposo['nombreMadre_Marido'] . '"';
                } else if ($fm) {
                    echo ' value="' . $esposa['nombreMadre_Esposa'] . '"';
                }
                ?>>
                <label for="apellidoMadre">Apellido:</label>
                <input type="text" name="apellidoMadre" <?php
                if ($fh) {
                    echo ' value="' . $esposo['apellidoMadre_Marido'] . '"';
                } else if ($fm) {
                    echo ' value="' . $esposa['apellidoMadre_Esposa'] . '"';
                }
                ?>>
            </div>
            <div class="clear"></div>
            <input type="Submit" value="Crear">
            <input type="reset">
        </form>
</body>
</html>
