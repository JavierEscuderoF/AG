<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <div class="topnav" id="myTopnav">
        <a href="../index.php">Home</a>
        <a href="javascript:history.back()">Volver</a>
    </div>
    <title>Matrimonio</title>
    <link rel="stylesheet" href="../AG.css" />
    <link rel="icon" type="image/png" href="tree.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <?php include '../utilidades/utilidades.php'; ?>
</head>
<body>
    <?php
    $db = conectar_bd();
    $id_Familia = filter_input(INPUT_GET, 'id');
    $hijo_get = filter_input(INPUT_GET, 'hijo');

    $query_datos = "
            SELECT R.tomo, R.folio, R.vuelto, F.fechaMatrimonio, P1.familia, P2.familia, 
                L.nombre, F.nombreMarido, F.apellidoMarido,
                F.nombreEsposa, F.apellidoEsposa, P1.idPersona, P2.idPersona, L.preposicion
            FROM Familias F 
                LEFT JOIN referenciasmatrimonio RM ON F.idFamilia = RM.idMatrimonioFK 
                LEFT JOIN referencias R ON RM.idReferenciaFK = R.idReferencia 
                LEFT JOIN lugares L ON F.lugarMatrimonio = idLugar
                LEFT JOIN personas P1 ON P1.idPersona = F.esposo
                LEFT JOIN personas P2 ON P2.idPersona = F.esposa
            WHERE F.idFamilia = " . $id_Familia . ";";

    $familia = buscar_unico($query_datos, $db);
    $familia_esposo = $familia[4];
    $familia_esposa = $familia[5];
    $lugar_matrimonio = $familia[6];
    $id_esposo = $familia[11];
    $id_esposa = $familia[12];
    ?>
    <header>
        <h2><a href="editarFamilia.php?id=<?php echo $id_Familia; ?>">✎</a> Matrimonio entre 
            <span class=smallcaps>
                <?php echo nombre_completo($familia['nombreMarido'], $familia['apellidoMarido'], 0); ?> 
            </span> <?php y_o_e($familia['nombreEsposa']); ?>
            <span class=smallcaps>
                <?php echo nombre_completo($familia['nombreEsposa'], $familia['apellidoEsposa'], 0); ?> 
            </span>
        </h2>

        <?php
        ?> 
        <p>
            <?php
            echo nombre_completo($familia['nombreMarido'], $familia['apellidoMarido'], 0);
            // Si el marido está conectado
            if ($familia_esposo) {
                echo ' <a href=familia.php?id=' . $familia_esposo . '&hijo=' . $id_esposo . '> 👨</a>';
            }
            y_o_e($familia['nombreEsposa']);
            //Si la mujer está conectada
            echo nombre_completo($familia['nombreEsposa'], $familia['apellidoEsposa'], 0);
            if ($familia_esposa) {
                echo '<a href=familia.php?id=' . $familia_esposa . '&hijo=' . $id_esposa . '> 👩</a>';
            }

            if ($familia['fechaMatrimonio'] || $lugar_matrimonio) {
                echo ' se casaron';
            }

            if ($familia['fechaMatrimonio']) {
                echo " el ";
                echo fecha_completa($familia['fechaMatrimonio']);
            }
            if ($lugar_matrimonio) {
                echo ' en ';
                if ($familia['preposicion']) {
                    echo $familia['preposicion'] . ' ';
                }
                echo $lugar_matrimonio;
            }
            if ($familia['tomo']) {
                echo " (Ref. ";
                mostrar_ref($familia['tomo'], $familia['folio'], $familia['vuelto']);
                echo ')';
            }
            ?>.
        </p>
    </header>
    <?php
    $query_hijos = "
        SELECT idPersona, tomo, folio, vuelto, nombre, 
            fechaNacimiento, nombrePadre, apellidoPadre, nombreMadre, apellidoMadre 
        FROM personas
            LEFT JOIN referenciaspersona ON idPersonaFK = idPersona
            LEFT JOIN referencias ON idReferenciaFK = idReferencia
        WHERE familia=" . $id_Familia . " ORDER BY 2,3,4;";
    $resultado_hijos = mysqli_query($db, $query_hijos);
    $numero_hijos = $resultado_hijos->num_rows;
    ?>
    <p>
        <?php
        switch ($numero_hijos) {
            case 0: echo "No se han encontrado hijos.";
                break;
            case 1: echo "Se ha encontrado el siguientes hijo:";
                break;
            default: echo 'Se han encontrado ' . $numero_hijos . ' hijos:';
        }
        ?>
    </p>
    <?php
    if ($numero_hijos > 0) {
        echo '<table><tr><th>Ref.</th><th>Nacim.</th><th>Nombre</th>'
        . "<th>Padre</th><th>Madre</th><th>Matrimonios</th></tr>";

        while ($hijo = mysqli_fetch_array($resultado_hijos)) {
            echo '<tr';
            if (isset($hijo_get) && $hijo_get == $hijo['idPersona']) {
                echo ' class="resaltar"';
            }
            echo '>';
            if ($hijo['tomo']) {
                columna(referencia($hijo['tomo'], $hijo['folio'], $hijo['vuelto']), 0);
            } else {
                columna('?', 1);
            }

            if ($hijo['fechaNacimiento']) {
                $fecha_nacimiento = date_create($hijo['fechaNacimiento']);
                columna(date_format($fecha_nacimiento, "Y") + 1, 1);
            } else {
                columna('', 0);
            }

            columna($hijo['nombre'], 0);
            columna(nombre_completo($hijo['nombrePadre'], $hijo['apellidoPadre'], 0), 0);
            columna(nombre_completo($hijo['nombreMadre'], $hijo['apellidoMadre'], 0), 0);

            echo '<td class="centrar">';

            $query_familias = "SELECT idFamilia FROM Familias WHERE esposo=" . $hijo['idPersona'] . ' OR esposa=' . $hijo['idPersona'];
            $resultado_f = mysqli_query($db, $query_familias);
            while ($matrimonios = mysqli_fetch_array($resultado_f)) {
                echo '<a href=familia.php?id=' . $matrimonios['idFamilia'] . '> 👪</a>';
            }
            echo '</td></tr>';
            mysqli_free_result($resultado_f);
        }
        mysqli_free_result($resultado_hijos);
        echo "</table>";
    }
    ?>
</body>
</html>
