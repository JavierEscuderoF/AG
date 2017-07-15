<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AG</title>
        <link rel="stylesheet" href="AG.css" />
        <link rel="icon" 
              type="image/png" 
              href="tree.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php include './utilidades/utilidades.php'; ?>
    </head>
    <body>
        
        <div class="topnav">
            <a><b>¡Bienvenido <?php echo $usuario; ?>!</b></a>
            <b id="logout"><a href="logout.php">Log Out</a></b>
        </div>
        <!--<img class="centrado" src="database.png" alt="Árbol genealógico">
        <br>
        <div class="card">
            <div class="container">
                <h3><b>👤 Personas</b></h3> 
                <p>Busca una persona en la base de datos (próximamente).</p> 
            </div>
        </div>-->
        <a href="./utilidades/busquedaAvanzada.php">

            <div class="card">
                <div class="container">
                    <h3><b>👪 Familias</b></h3> 
                    <p>Busca una familia en la base de datos.</p> 
                </div>
            </div></a>
        <a href="./colecciones/colecciones.php">
            <div class="card">
                <div class="container">
                    <h3><b>📚 Colecciones</b></h3> 
                    <p>Inspecciona los libros de bautismos, matrimonios...</p> 
                </div>
            </div></a>
        <!--<a href="./lugares/lugares.php">
            <div class="card">
                <div class="container">
                    <h3><b>🌇 Lugares</b></h3> 
                    <p>Explora los lugares en los que ocurrieron los hechos del árbol.</p> 
                </div>
            </div></a>-->
        <a href="./estadisticas/estadisticas.php">
            <div class="card">
                <div class="container">
                    <h3><b>📈 Estadísticas</b></h3> 
                    <p>Varias métricas de las diferentes colecciones.</p> 
                </div>
            </div></a>
        <div class="clear"></div>
    </body>
</html>
