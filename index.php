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
        <?php include 'utilidades.php'; ?>
    </head>
    <body>
        <img class="centrado" src="database.png" alt="Árbol genealógico">
        <br>
        <div class="card">
            <div class="container">
                <h3><b>👤 Personas</b></h3> 
                <p>Busca una persona en la base de datos (próximamente).</p> 
            </div>
        </div>
        <a href="busquedaAvanzada.php">

            <div class="card">
                <div class="container">
                    <h3><b>👪 Familias</b></h3> 
                    <p>Busca una familia en la base de datos.</p> 
                </div>
            </div></a>
        <a href="colecciones.php">
            <div class="card">
                <div class="container">
                    <h3><b>📚 Colecciones</b></h3> 
                    <p>Inspecciona los libros de bautismos, matrimonios...</p> 
                </div>
            </div></a>
        <a href="estadisticas.php">
            <div class="card">
                <div class="container">
                    <h3><b>📈 Estadísticas</b></h3> 
                    <p>Explora el grado de completitud e las colecciones.</p> 
                </div>
            </div></a>
        <div class="clear"></div>
    </body>
</html>
