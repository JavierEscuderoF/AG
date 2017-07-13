<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Coleccion</title>
        <link rel="stylesheet" href="../AG.css" />
        <link rel="icon" 
              type="image/png" 
              href="../tree.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php include '../utilidades/utilidades.php'; ?>
    </head>
    <body>
        <?php
        $tomo = filter_input(INPUT_GET, "tomo");
        $id = filter_input(INPUT_GET, "id");
        ?>
        <header>
            <div class="topnav" id="myTopnav">
                <a href="../index.php">Home</a>
                <a href="./coleccion.php?id=<?php echo $id; ?>&tomo=<?php echo $tomo - 1; ?>">Tomo anterior</a>
                <a href="./coleccion.php?id=<?php echo $id; ?>&tomo=<?php echo $tomo + 1; ?>">Tomo siguiente</a>
            </div>
            <h1>Tomo de 
                <?php
                if ($id == 1) {
                    echo "matrimonios";
                } else {
                    echo "bautismos";
                }
                ?> número <?php echo $tomo; ?>
            </h1>
        </header>

        <?php
        $db = conectar_bd();
        $tipo_query = "
            SELECT *
            FROM colecciones
                JOIN tipocoleccion ON tipoColeccionFK = idTipoColeccion
            WHERE idColeccion=" . $id . ";";
        $tipo = buscar_unico($tipo_query, $db);
        
        switch ($tipo['idTipoColeccion']) {
            case 1:
                $query = "
                    SELECT *
                    FROM Familias F 
                        JOIN referenciasmatrimonio RM ON F.idFamilia = RM.idMatrimonioFK 
                        JOIN Referencias R ON RM.idReferenciaFK = R.idReferencia
                    WHERE R.coleccion = " . $id . " AND R.tomo = " . $tomo . " ORDER BY folio,vuelto,fechaMatrimonio;";

                $resultado = mysqli_query($db, $query);
                if ($resultado->num_rows > 0) {
                    echo '<table>';
                    echo '<tr><th>Folio</th><th>Fecha</th><th>Marido</th><th>Mujer</th><th>Familia</th></tr>';
                    while ($familia = mysqli_fetch_array($resultado)) {
                        echo '<tr>';
                        columna(referencia($tomo, $familia['folio'], $familia['vuelto']), 0);

                        if ($familia['fechaMatrimonio']) {
                            $a = fecha_corta($familia['fechaMatrimonio'], 0);
                        } else {
                            $a = '<a class="gris" href="../familia/editarFamilia.php?id=' . $familia['idFamilia'] . '">✎</a>';
                        }

                        columna($a, 1);

                        if ($familia['esposo']) {
                            $query_esp = "SELECT nombre, familia FROM personas where idPersona=" . $familia['esposo'];
                            $esposo = buscar_unico($query_esp, $db);

                            $a = '<a href=../familias/familia.php?id=' . $esposo['familia'] . '&hijo=' . $familia['esposo'] . '>';
                            $a .= nombre_completo($familia['nombreMarido'], $familia['apellidoMarido'], 0) . '</a>';

                            columna($a, 0);
                        } else {
                            echo '<td class=gris>';
                            echo nombre_completo($familia['nombreMarido'], $familia['apellidoMarido'], 0);
                            echo ' <a class="gris" href="../utilidades/busquedaAvanzada.php?marido=' . $familia['idFamilia'] . '">🔎</a></td>';
                        }

                        if ($familia['esposa']) {
                            $query_esp = "SELECT nombre, familia FROM personas where idPersona=" . $familia['esposa'];
                            $esposa = buscar_unico($query_esp, $db);

                            $string = '<a href=../familias/familia.php?id=' . $esposa['familia'] . '&hijo=' . $familia['esposa'] . '>';
                            $string .= nombre_completo($familia['nombreEsposa'], $familia['apellidoEsposa'], 0) . '</a>';

                            columna($string, 0);
                        } else {
                            echo '<td class=gris>';
                            echo $familia['nombreEsposa'] . " " . $familia['apellidoEsposa'] . ' <a class="gris" href="busquedaAvanzada.php?mujer=' . $familia['idFamilia'] . '">🔎</a></td>';
                        }

                        $enlace_fam = '<a href="../familias/familia.php?id=' . $familia['idFamilia'] . '">👪</a>';
                        columna($enlace_fam, 1);

                        echo '</tr>';
                    }
                    mysqli_free_result($resultado);
                    echo "</table>";
                } else {
                    echo "No se ha encontrado ninguna familia.";
                }
                break;
            case 2:

                $query = "
                    SELECT *
                    FROM personas P 
                        JOIN referenciaspersona RP ON P.idPersona = RP.idPersonaFK 
                        JOIN Referencias R ON RP.idReferenciaFK = R.idReferencia
                    WHERE R.coleccion = " . $id . " AND R.tomo = " . $tomo . " ORDER BY tomo,folio,vuelto,fechaNacimiento;";

                $resultado = mysqli_query($db, $query);
                if ($resultado->num_rows > 0) {
                    echo '<table>';
                    echo '<tr><th></th><th>Folio</th><th>Fecha nac.</th><th>Nombre</th><th>Padre</th><th>Madre</th><th>Familia</th></tr>';
                    while ($persona = mysqli_fetch_array($resultado)) {

                        if ($persona['familia']) {
                            echo "<tr>";
                        } else {
                            echo '<tr class="gris">';
                        }

                        if ($persona['familia']) {
                            columna('', 0);
                        } else {
                            $lupa = '<a class="gris" href="../utilidades/busquedaAvanzada.php?persona=' . $persona['idPersona'] . '">🔎</a>';
                            columna($lupa, 0);
                        }

                        columna(referencia($tomo, $persona['folio'], $persona['vuelto']), 0);

                        if ($persona['fechaNacimiento']) {
                            $fecha_casamiento = date_create($persona['fechaNacimiento']);
                            $a = date_format($fecha_casamiento, "Y") + 1;
                        } else {
                            $a = '<a class="gris" href="../personas/editarPersona.php?id=' . $persona['idPersona'] . '">✎</a>';
                        }

                        columna($a, 1);
                        columna($persona['nombre'], 0);
                        columna(nombre_completo($persona['nombrePadre'], $persona['apellidoPadre'], 0), 0);
                        columna(nombre_completo($persona['nombreMadre'], $persona['apellidoMadre'], 0), 0);

                        if ($persona['familia']) {
                            $enlace_familia = '<a href="../familias/familia.php?id=' . $persona['familia'] . '&hijo=' . $persona['idPersona'] . '">👪</a>';
                            columna($enlace_familia, 1);
                        } else {
                            columna(' ', 0);
                        }
                        echo '</tr>';
                    }
                    mysqli_free_result($resultado);
                    echo "</table>";
                } else {
                    echo "No se ha encontrado ninguna persona.";
                }
                break;
            case 3:
                break;
        }
        ?>
    </body>
</html>
