<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <div class="topnav" id="myTopnav">
        <a href="index.php">Home</a>
        <a href="javascript:history.back()">Volver</a>
        <a href="editarFamilia.php?id=<?php echo $_GET["id"] - 1; ?>">Editar anterior</a>
        <a href="editarFamilia.php?id=<?php echo $_GET["id"] + 1; ?>">Editar siguiente</a>
    </div>
    <title>Editar persona</title>
    <link rel="stylesheet" href="AG.css" />
    <link rel="icon" 
          type="image/png" 
          href="tree.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <?php include 'utilidades.php'; ?>
</head>
<body>
    <?php
    $id_Persona = filter_input(INPUT_GET, 'id');
    $db = conectar_bd();
    $query_nombres = "
        SELECT nombre, 
            tomo, folio, vuelto, 
            nombrePadre, apellidoPadre, nombreMadre, apellidoMadre,
            fechaNacimiento
        FROM personas P
            LEFT JOIN referenciaspersona RP ON P.idPersona = RP.idPersonaFK
            LEFT JOIN referencias R ON RP.idReferenciaFK = R.idReferencia
        WHERE P.idPersona = " . $id_Persona . ";";
    $persona = buscar_unico($query_nombres, $db);
    ?>

    <header>
        <h2>
            Editar datos del bautismo de
            <span class=smallcaps>
                <?php echo $persona['nombre'] . ','; ?> 
            </span>hijo de
            <span class=smallcaps>
                <?php echo $persona['nombrePadre'] . " " . $persona['apellidoPadre']; ?> 
            </span> <?php y_o_e($persona['nombreMadre']); ?>
            <span class=smallcaps>
                <?php echo $persona['nombreMadre'] . " " . $persona['apellidoMadre']; ?>
            </span>
            <span class=ref>
                <?php
                if ($persona['tomo']) {
                    echo "(Ref. ";
                    mostrar_ref($persona['tomo'], $persona['folio'], $persona['vuelto']);
                    echo ')';
                }
                ?>
            </span>
        </h2>
        <form action="update.php" method="post">
            <input type="hidden" name="idPersona" value="<?php echo $id_Persona; ?>">
            <input type="hidden" name="action" value="update">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $persona['nombre']; ?>">
            <label for="fechaNacimiento">Fecha de nacimiento:</label>
            <input type="text" name="fechaNacimiento" value="<?php echo $persona['fechaNacimiento']; ?>">
            <br>
            <div class="subformulario">
                <h3>Padre</h3>
                <label for="nombrePadre">Nombre:</label>
                <input type="text" name="nombrePadre" value="<?php echo $persona['nombrePadre'] ?>">
                <label for="apellidoPadre">Apellido:</label>
                <input type="text" name="apellidoPadre" value="<?php echo $persona['apellidoPadre'] ?>">
            </div>

            <div class="subformulario">
                <h3>Madre</h3>
                <label for="nombreMadre">Nombre:</label>
                <input type="text" name="nombreMadre" value="<?php echo $persona['nombreMadre'] ?>">
                <label for="apellidoMadre">Apellido:</label>
                <input type="text" name="apellidoMadre" value="<?php echo $persona['apellidoMadre'] ?>">
            </div>
            <div class="clear"></div>
            <input type="Submit" value="Actualizar">
            <input type="reset">
        </form>
</body>
</html>
