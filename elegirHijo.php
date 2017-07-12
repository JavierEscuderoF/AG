<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="AG.css" />
        <link rel="icon" 
              type="image/png" 
              href="tree.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php include 'utilidades.php'; ?>
    </head>
    <body>
        <form action="matcher.php" method="post">

            <?php
            $db = conectar_bd();

            $idMarido = filter_input(INPUT_POST, "idMarido");
            $idMujer = filter_input(INPUT_POST, "idMujer");
            $idFamilia = filter_input(INPUT_POST, "padresEscogidos");

            if (isset($idMarido) && $idMarido) {
                echo '<input type="hidden" name="matrimonio" value="' . $idMarido . '">';
            } else {
                echo '<input type="hidden" name="matrimonio" value="' . $idMujer . '">';
            }



            echo '<h3>Selecciona ';
            if (isset($idMarido) && $idMarido) {
                echo 'el marido';
            } else {
                echo 'la mujer';
            }
            echo '</h3>';

            $query = "
            SELECT P.idPersona, R.tomo, R.folio, R.vuelto, P.nombrePadre, P.apellidoPadre, P.nombreMadre, P.apellidoMadre,
            P.fechaNacimiento, nombre
            FROM Personas P 
                LEFT JOIN referenciaspersona RP ON P.idPersona = RP.idPersonaFK 
                LEFT JOIN referencias R ON R.idReferencia = RP.idReferenciaFK
            WHERE P.familia = " . $idFamilia . " ORDER BY 2,3,4;";
            $resultado = mysqli_query($db, $query);

            if ($resultado->num_rows > 0) {
                echo '<table>';
                echo '<tr><th>Seleccionar</th><th>Ref.</th><th>Fecha</th><th>Nombre</th><th>Marido</th><th>Mujer</th></tr>';
                
                while ($hijo = mysqli_fetch_array($resultado)) {

                    if ((isset($idMarido) && $idMarido) || (isset($idMujer) && $idMujer)) {
                        $radio = '<input type="radio" name="';
                        if (isset($idMarido) && $idMarido) {
                            $radio .= 'marido';
                        } else {
                            $radio .= 'mujer';
                        }
                        $radio .= '" value="' . $hijo['idPersona'] . '">';
                        columna($radio, 1);
                    }

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

                    echo '</tr>';
                }
                echo "</table>";
            } else {
                echo "<p>No se han encontrado resultados.</p>";
            }
            echo '<input type="Submit" value="Enlazar">';
            ?>
        </form>
        <a href="javascript:history.back()">Volver</a>
    </body>
</html>
