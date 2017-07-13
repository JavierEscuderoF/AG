<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lugares</title>
        <link rel="stylesheet" href="../AG.css" />
        <link rel="icon" 
              type="image/png" 
              href="tree.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php include '../utilidades/utilidades.php'; ?>
    </head>
    <body>
        <?php
        $id_Lugar = filter_input(INPUT_GET, 'id');
        $db = conectar_bd();
        $query_lugar = consulta('lugares', $id_Lugar);
        $lugar = buscar_unico($query_lugar, $db);
        ?>
        <h2>Mapa <?php echo 'de ' . $lugar['nombre']; ?></h2>
        <p>
            <?php
            $query = "http://www.wikidata.org/w/api.php?action=wbgetentities&sites=itwiki&titles=Pizza&format=json";
            $a = file_get_contents($query);
            echo $a;

            $inipath = php_ini_loaded_file();
            if ($inipath) {
                echo 'Loaded php.ini: ' . $inipath;
            } else {
                echo 'A php.ini file is not loaded';
            }
            
            
            ?>
        </p>
        <div id="map" style="width:100%;height:400px;"></div>

      <!--  <script>
            function myMap() {
                var myCenter = new google.maps.LatLng(51.508742, -0.120850);
                var mapCanvas = document.getElementById("map");
                var mapOptions = {center: myCenter, zoom: 5};
                var map = new google.maps.Map(mapCanvas, mapOptions);
                var marker = new google.maps.Marker({position: myCenter});
                marker.setMap(map);

                google.maps.event.addListener(marker, 'click', function () {
                    map.setZoom(9);
                    map.setCenter(marker.getPosition());
                });

            }
        </script>-->

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALHNwAsH3yW1iYycD7bcPglpPxeaYzHTc&callback=myMap"></script>

    </body>
</html>
