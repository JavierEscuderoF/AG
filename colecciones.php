<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Colecciones</title>
        <link rel="stylesheet" href="AG.css" />
        <link rel="icon" 
              type="image/png" 
              href="tree.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php include 'utilidades.php'; ?>
    </head>
    <body>
        <div class="topnav" id="myTopnav">
            <a href="index.php">Home</a>
        </div>
        <form action="coleccion.php" method="get">
            <h3>Selecciona un tomo</h3>
            <label for="id">Colección:</label><select name="id">
                <option value=1>Matrimonios</option>
                <option value=2>Bautismos</option>
                <option value=3>Defunciones</option>
            </select>
            <label for="tomo">Tomo:</label><input type="text" name="tomo" />
            <input type="submit" />
        </form>
    </body>
</html>
