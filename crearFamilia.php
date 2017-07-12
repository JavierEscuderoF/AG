<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <div class="topnav" id="myTopnav">
        <a href="index.php">Home</a>
        <a href="javascript:history.back()">Volver</a>
    </div>
    <title>Nueva familia</title>
    <link rel="stylesheet" href="AG.css" />
    <link rel="icon" 
          type="image/png" 
          href="tree.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <?php include 'utilidades.php'; ?>

</head>
<body>
    <header>
        <h2>
            Insertar nueva familia en la base de datos
        </h2>
        <form action="update.php" method="post">
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="target" value="familia">

            <?php
            $datos = filter_input(INPUT_GET, 'datos');

            $db = conectar_bd();

            if ($datos) {
                $persona = buscar_unico(consulta('personas', $datos),$db);
            }
            $query_coleccion = "SELECT * FROM colecciones";
            $resultado_coleccion = mysqli_query($db, $query_coleccion);
            ?>
            <select name="coleccion">
                <option value="">Selecciona lugar</option>
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
            <label for="fechaMatrimonio">Fecha del matrimonio:</label>
            <input type="text" name="fechaMatrimonio" >
            <br>
            <div class="subformulario">
                <h3>Esposo</h3>
                <input class=principal type="text" name="nombreMarido" 
                <?php
                if ($datos) {
                    echo 'value="' . $persona['nombrePadre'] . '"';
                }
                ?>>
                <input class=principal type="text" name="apellidoMarido" 
                <?php
                if ($datos) {
                    echo 'value="' . $persona['apellidoPadre'] . '"';
                }
                ?>>
                <br>
                <label for="nombrePadre_Marido">Nombre del padre:</label>
                <input type="text" name="nombrePadre_Marido" >
                <label for="apellidoPadre_Marido">Apellido del padre:</label>
                <input type="text" name="apellidoPadre_Marido" >
                <label for="nombreMadre_Marido">Nombre de la madre:</label>
                <input type="text" name="nombreMadre_Marido" >
                <label for="apellidoMadre_Marido">Apellido de la madre:</label>
                <input type="text" name="apellidoMadre_Marido" >
            </div>


            <div class="subformulario">
                <h3>Esposa</h3>
                <input class=principal type="text" name="nombreMujer" 
                <?php
                if ($datos) {
                    echo 'value="' . $persona['nombreMadre'] . '"';
                }
                ?>>
                <input class=principal type="text" name="apellidoMujer" 
                <?php
                if ($datos) {
                    echo 'value="' . $persona['apellidoMadre'] . '"';
                }
                ?>>
                <br>
                <label for="nombrePadre_Esposa">Nombre del padre:</label>
                <input type="text" name="nombrePadre_Esposa" >
                <label for="apellidoPadre_Esposa">Apellido del padre:</label>
                <input type="text" name="apellidoPadre_Esposa" >
                <label for="nombreMadre_Esposa">Nombre de la madre:</label>
                <input type="text" name="nombreMadre_Esposa" >
                <label for="apellidoMadre_Esposa">Apellido de la madre:</label>
                <input type="text" name="apellidoMadre_Esposa" >
            </div>
            <div class="clear"></div>
            <input type="Submit" value="Crear">
            <input type="reset">        
        </form>
</body>
</html>
