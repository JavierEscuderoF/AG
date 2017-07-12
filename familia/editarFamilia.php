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
    <title>Editar familia</title>
    <link rel="stylesheet" href="AG.css" />
    <link rel="icon" 
          type="image/png" 
          href="tree.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <?php include 'utilidades.php'; ?>
</head>
<body>
    <?php
    $id_Familia = filter_input(INPUT_GET, 'id');
    $db = conectar_bd();
    $query_nombres = "
        SELECT nombreMarido, apellidoMarido, nombreEsposa, apellidoEsposa, 
            tomo, folio, vuelto, 
            nombrePadre_Marido, apellidoPadre_Marido, nombreMadre_Marido, apellidoMadre_Marido,
            nombrePadre_Esposa, apellidoPadre_Esposa, nombreMadre_Esposa, apellidoMadre_Esposa, 
            esposo, esposa, fechaMatrimonio
        FROM familias
            LEFT JOIN referenciasmatrimonio ON idMatrimonioFK = idFamilia
            LEFT JOIN referencias ON idReferenciaFK = idReferencia
        WHERE idFamilia = " . $id_Familia . ";";
    $familia = buscar_unico($query_nombres, $db);
    ?>

    <header>
        <h2>
            <a href="familia.php?id=<?php echo $id_Familia; ?>">👪</a> Editar datos del matrimonio entre 
            <span class=smallcaps>
                <?php echo nombre_completo($familia['nombreMarido'], $familia['apellidoMarido'], 0); ?> 
            </span> y 
            <span class=smallcaps>
                <?php echo nombre_completo($familia['nombreEsposa'], $familia['apellidoEsposa'], 0); ?>
            </span>
            <span class=ref>
                <?php
                if ($familia['tomo']) {
                    echo "(Ref. ";
                    mostrar_ref($familia['tomo'], $familia['folio'], $familia['vuelto']);
                    echo ')';
                }
                ?>
            </span>
        </h2>
        <form action="update.php" method="post">
            <input type="hidden" name="ID" value="<?php echo $id_Familia; ?>">
            <input type="hidden" name="action" value="update">
            <label for="fechaMatrimonio">Fecha de matrimonio:</label>
            <input type="date" name="fechaMatrimonio" value="<?php echo $familia['fechaMatrimonio']; ?>">
            <br>
            <div class="subformulario">
                <h3>Esposo</h3>
                <input class=principal type="text" name="nombreMarido" value="<?php echo $familia['nombreMarido'] ?>">
                <input class=principal type="text" name="apellidoMarido" value="<?php echo $familia['apellidoMarido'] ?>">
                <br>
                <label for="nombrePadre_Marido">Nombre del padre:</label>
                <input type="text" name="nombrePadre_Marido" value="<?php echo $familia['nombrePadre_Marido'] ?>"
                <?php
                if ($familia['esposo']) {
                    echo "disabled";
                }
                ?>>
                <label for="apellidoPadre_Marido">Apellido del padre:</label>
                <input type="text" name="apellidoPadre_Marido" value="<?php echo $familia['apellidoPadre_Marido'] ?>"<?php
                if ($familia['esposo']) {
                    echo "disabled";
                }
                ?>>
                <label for="nombreMadre_Marido">Nombre de la madre:</label>
                <input type="text" name="nombreMadre_Marido" value="<?php echo $familia['nombreMadre_Marido'] ?>"<?php
                if ($familia['esposo']) {
                    echo "disabled";
                }
                ?>>
                <label for="apellidoMadre_Marido">Apellido de la madre:</label>
                <input type="text" name="apellidoMadre_Marido" value="<?php echo $familia['apellidoMadre_Marido'] ?>"<?php
                if ($familia['esposo']) {
                    echo "disabled";
                }
                ?>>
            </div>


            <div class="subformulario">
                <h3>Esposa</h3>
                <input class=principal type="text" name="nombreMujer" value="<?php echo $familia['nombreEsposa'] ?>">
                <input class=principal type="text" name="apellidoMujer" value="<?php echo $familia['apellidoEsposa'] ?>">
                <br>
                <label for="nombrePadre_Esposa">Nombre del padre:</label>
                <input type="text" name="nombrePadre_Esposa" value="<?php echo $familia['nombrePadre_Esposa'] ?>"<?php
                if ($familia['esposa']) {
                    echo "disabled";
                }
                ?>>
                <label for="apellidoPadre_Esposa">Apellido del padre:</label>
                <input type="text" name="apellidoPadre_Esposa" value="<?php echo $familia['apellidoPadre_Esposa'] ?>"<?php
                if ($familia['esposa']) {
                    echo "disabled";
                }
                ?>>
                <label for="nombreMadre_Esposa">Nombre de la madre:</label>
                <input type="text" name="nombreMadre_Esposa" value="<?php echo $familia['nombreMadre_Esposa'] ?>"<?php
                if ($familia['esposa']) {
                    echo "disabled";
                }
                ?>>
                <label for="apellidoMadre_Esposa">Apellido de la madre:</label>
                <input type="text" name="apellidoMadre_Esposa" value="<?php echo $familia['apellidoMadre_Esposa'] ?>"<?php
                if ($familia['esposa']) {
                    echo "disabled";
                }
                ?>>
            </div>
            <div class="clear"></div>
            <input type="Submit" value="Actualizar">
            <input type="reset">
        </form>
</body>
</html>
