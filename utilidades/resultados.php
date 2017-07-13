<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resultados de la búsqueda</title>
        <link rel="stylesheet" href="../AG.css" />
        <link rel="icon" 
              type="image/png" 
              href="tree.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php include 'utilidades.php'; ?>
    </head>
    <body>
        <h2>Resultados de la búsqueda</h2>
        <?php
        $db = conectar_bd();

        $coleccion_matrimonio = filter_input(INPUT_POST, "coleccionMatrimonios");
        $coleccion_bautismos = filter_input(INPUT_POST, "coleccionBautismos");
        $fechaInicio = filter_input(INPUT_POST, "fechaInicio");
        $fechaFin = filter_input(INPUT_POST, "fechaFin");
        $idPersona = filter_input(INPUT_POST, "idPersona");
        $idMarido = filter_input(INPUT_POST, "idMarido");
        $idMujer = filter_input(INPUT_POST, "idMujer");
        $nombreMarido = filter_input(INPUT_POST, "nombreMarido");
        $apellidoMarido = filter_input(INPUT_POST, "apellidoMarido");
        $nombreMujer = filter_input(INPUT_POST, "nombreMujer");
        $apellidoMujer = filter_input(INPUT_POST, "apellidoMujer");

        $query = "
            SELECT F.idFamilia, R.tomo, R.folio, R.vuelto, F.nombreMarido, F.apellidoMarido, F.nombreEsposa, F.apellidoEsposa,
            F.fechaMatrimonio
            FROM Familias F 
                LEFT JOIN referenciasmatrimonio RM ON F.idFamilia = RM.idMatrimonioFK 
                LEFT JOIN Referencias R ON RM.idReferenciaFK = R.idReferencia 
            WHERE ";
        if ($coleccion_matrimonio != 0) {
            $query .= "R.coleccion = " . $coleccion_matrimonio . " AND ";
        }
        if ($fechaInicio) {
            $query .= " fechaMatrimonio>='" . $fechaInicio . "' AND";
        }
        if ($fechaFin) {
            $query .= " fechaMatrimonio>='" . $fechaFin . "' AND";
        }
        if ($nombreMarido) {
            $query .= ' nombreMarido LIKE "%' . $nombreMarido . '%" AND';
        }
        if ($apellidoMarido) {
            $query .= ' apellidoMarido LIKE "%' . $apellidoMarido . '%" AND';
        }
        if ($nombreMujer) {
            $query .= ' nombreEsposa LIKE "%' . $nombreMujer . '%" AND';
        }
        if ($apellidoMujer) {
            $query .= ' apellidoEsposa LIKE "%' . $apellidoMujer . '%"';
        }
        $query = rtrim($query, ' AND');
        $query .= " ORDER BY 2,3,4;";

        $resultado = mysqli_query($db, $query);

        if ($idPersona) {
            echo '<form action="matcher.php" method="post">';
            echo "<h3>Padres candidatos</h3>";
        } else if ($idMarido) {
            echo '<form action="elegirHijo.php" method="post">';
            echo "<h3>Padres candidatos del marido</h3>";
            echo '<input type="hidden" name="idMarido" value="' . $idMarido . '">';
        } else if ($idMujer) {
            echo '<form action="elegirHijo.php" method="post">';
            echo "<h3>Padres candidatos de la mujer</h3>";
            echo '<input type="hidden" name="idMujer" value="' . $idMujer . '">';
        }
        if ($resultado->num_rows > 0) {

            echo '<table><tr>';
            if ($idPersona || $idMarido || $idMujer) {
                echo '<th>Seleccionar</th>';
            }
            echo '<th>Ref.</th><th>Fecha</th><th>Marido</th><th>Mujer</th><th>Familia</th></tr>';

            while ($familia = mysqli_fetch_array($resultado)) {

                if ($idPersona || $idMarido || $idMujer) {
                    $radio = '<input type="radio" name="';
                    if ($idPersona) {
                        $radio .= 'familiaEscogida';
                    } else {
                        $radio .= 'padresEscogidos';
                    }
                    $radio .= '" value="' . $familia['idFamilia'] . '">';
                    columna($radio, 1);
                }

                if ($familia['tomo']) {
                    columna(referencia($familia['tomo'], $familia['folio'], $familia['vuelto']), 0);
                } else {
                    columna('?', 1);
                }

                echo "<td>";
                if ($familia['fechaMatrimonio']) {
                    $fecha_casamiento = date_create($familia['fechaMatrimonio']);
                    echo date_format($fecha_casamiento, "d/m/Y");
                }

                columna(nombre_completo($familia['nombreMarido'], $familia['apellidoMarido'], 0), 0);
                columna(nombre_completo($familia['nombreEsposa'], $familia['apellidoEsposa'], 0), 0);

                $enlace_familia = '<a href="../familias/familia.php?id=' . $familia['idFamilia'] . '">👪</a>';
                columna($enlace_familia, 1);

                echo '</tr>';
            }
            echo "</table>";
            mysqli_free_result($resultado);
        } else {
            echo "<p>No se han encontrado resultados.</p>";
        }

        echo '<p><a href="../familias/crearFamilia.php?datos=' . $idPersona . '">👪 Crear nueva familia.</a></p>';

        if ($idPersona) {
            echo '<h3>Hermanos candidatos</h3>';

            $query_hermanos = "
            SELECT P.idPersona, R.tomo, R.folio, R.vuelto, P.nombrePadre, P.apellidoPadre, P.nombreMadre, P.apellidoMadre,
            P.fechaNacimiento, nombre
            FROM Personas P 
                JOIN referenciaspersona RP ON P.idPersona = RP.idPersonaFK 
                JOIN Referencias R ON RP.idReferenciaFK = R.idReferencia 
            WHERE R.coleccion = " . $coleccion_bautismos . " AND familia IS NULL AND ";

            if ($nombreMarido) {
                $query_hermanos .= ' nombrePadre LIKE "%' . $nombreMarido . '%" AND';
            }
            if ($apellidoMarido) {
                $query_hermanos .= ' apellidoPadre LIKE "%' . $apellidoMarido . '%" AND';
            }
            if ($nombreMujer) {
                $query_hermanos .= ' nombreMadre LIKE "%' . $nombreMujer . '%" AND';
            }
            if ($apellidoMujer) {
                $query_hermanos .= ' apellidoMadre LIKE "%' . $apellidoMujer . '%"';
            }

            $query_hermanos = rtrim($query_hermanos, ' AND');
            $query_hermanos .= " ORDER BY 2,3,4;";

            $resultado_hermanos = mysqli_query($db, $query_hermanos);
            if ($resultado_hermanos->num_rows > 0) {
                echo '<table>';
                echo '<tr><th>Seleccionar</th><th>Ref.</th><th>Fecha</th><th>Nombre</th><th>Marido</th><th>Mujer</th></tr>';

                while ($hijo = mysqli_fetch_array($resultado_hermanos)) {
                    $checkbox = '<input type="checkbox" name="hermanosEscogidos[]" value="' . $hijo['idPersona'] . '">';
                    columna($checkbox, 1);
                    columna(referencia($hijo['tomo'], $hijo['folio'], $hijo['vuelto']), 0);

                    if ($hijo['fechaNacimiento']) {
                        $fecha_nacimiento = date_create($hijo['fechaNacimiento']);
                        columna(date_format($fecha_nacimiento, "Y") + 1, 1);
                    } else {
                        columna('', 0);
                    }

                    columna($hijo['nombre'], 0);
                    columna(nombre_completo($hijo['nombrePadre'], $hijo['apellidoPadre'], 0), 0);
                    columna(nombre_completo($hijo['nombreMadre'], $hijo['apellidoMadre'], 0), 0);

                    echo '</tr>';
                }
                echo "</table>";
                mysqli_free_result($resultado_hermanos);
            } else {
                echo "<p>No se han encontrado resultados.</p>";
            }
            echo '<input type="Submit" value="Enlazar">';
        } else if ($idMarido || $idMujer) {
            echo '<input type="Submit" value="Enlazar">';
        }
        ?>
        <br>
        <a href="javascript:history.back()">Volver</a>
    </body>
</html>
