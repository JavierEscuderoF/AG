<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <div class="topnav" id="myTopnav">
        <a href="index.php">Home</a>
        <a href="javascript:history.back()">Volver</a>
    </div>
    <title>Nueva persona</title>
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
            Insertar nueva persona en la base de datos
        </h2>
        <form action="update.php" method="post">
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="target" value="persona">

            <?php
            $db = conectar_bd();
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
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" >
            <label for="fechaNacimiento">Fecha de nacimiento:</label>
            <input type="text" name="fechaNacimiento" >
            <br>
            <div class="subformulario">
                <h3>Padre</h3>
                <label for="nombrePadre">Nombre:</label>
                <input type="text" name="nombrePadre" >
                <label for="apellidoPadre">Apellido:</label>
                <input type="text" name="apellidoPadre" >
            </div>

            <div class="subformulario">
                <h3>Madre</h3>
                <label for="nombreMadre">Nombre:</label>
                <input type="text" name="nombreMadre" >
                <label for="apellidoMadre">Apellido:</label>
                <input type="text" name="apellidoMadre" >
            </div>
            <div class="clear"></div>
            <input type="Submit" value="Crear">
            <input type="reset">
        </form>
</body>
</html>
