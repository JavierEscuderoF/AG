<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <div class="topnav" id="myTopnav">
        <a href="../index.php">Home</a>
        <a href="javascript:history.back()">Volver</a>
    </div>
    <title>Nuevo lugar</title>
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
            Insertar un lugar nuevo en la base de datos
        </h2>
        <form action="../utilidades/update.php" method="post">
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="target" value="lugar">

            <?php
            $db = conectar_bd();
            $query_lugarpadre = "SELECT * FROM lugares ORDER BY nombre";
            $query_categoria = "SELECT * FROM categorialugar ORDER BY tipoLugar";
            $resultado_lugarpadre = mysqli_query($db, $query_lugarpadre);
            $resultado_categorialugar = mysqli_query($db, $query_categoria);
            ?>
            <select name="lugarpadre">
                <option value="">Selecciona un lugar padre</option>
                <?php
                while ($fila = mysqli_fetch_array($resultado_lugarpadre)) {
                    ?>
                    <option value="<?php echo $fila['idLugar']; ?>"><?php echo $fila['nombre']; ?></option>
                    <?php
                }
                ?>
            </select>
            <select name="categoria">
                <option value="">Selecciona la categoría del lugar</option>
                <?php
                while ($fila = mysqli_fetch_array($resultado_categorialugar)) {
                    ?>
                    <option value="<?php echo $fila['idCategoriaLugar']; ?>"><?php echo $fila['tipoLugar']; ?></option>
                    <?php
                }
                ?>
            </select>
            <br>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" >
            <label for="wikidata">Wikidata:</label>
            <input type="text" name="wikidata" >
            <label for="preposicion">Preposicion:</label>
            <input type="text" name="preposicion" >

            <br>
            <div class="clear"></div>
            <input type="Submit" value="Crear">
            <input type="reset">
        </form>
</body>
</html>
