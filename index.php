<?php
include('login.php'); // Includes Login Script

if (isset($_SESSION['login_user'])) {
    header("location: main.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Javier Escudero</title>
        <link href="AG.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="main">
            <div id="login">
                <form action="login.php" method="post">
                    <h3>Formulario de acceso</h3>
                    <label for="name">Usuario:</label>
                    <input id="name" name="username" placeholder="nombre de usuario" type="text">
                    <label for="password">Contraseña:</label>
                    <input id="password" name="password" placeholder="**********" type="password"><br>
                    <input name="submit" type="submit" value="Entrar">
                    <span><?php echo $error; ?></span>
                </form>
            </div>
        </div>
    </body>
</html>
