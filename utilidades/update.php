<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Actualizar</title>
        <link rel="stylesheet" href="../AG.css" />
        <link rel="icon" 
              type="image/png" 
              href="tree.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php include 'utilidades.php'; ?>
    </head>
    <body>
        <?php
        $db = conectar_bd();

        $id = filter_input(INPUT_POST, 'ID');
        $idPersona = filter_input(INPUT_POST, 'idPersona');
        $action = filter_input(INPUT_POST, 'action');
        $target = filter_input(INPUT_POST, 'target');

        switch ($action) {
            case "update":
                if ($id) {

                    $fechaMatrimonio = filter_input(INPUT_POST, "fechaMatrimonio");
                    $lugarMatrimonio = filter_input(INPUT_POST, "lugar");
                    $nombrePadre_Marido = filter_input(INPUT_POST, "nombrePadre_Marido");
                    $apellidoPadre_Marido = filter_input(INPUT_POST, "apellidoPadre_Marido");
                    $nombreMadre_Marido = filter_input(INPUT_POST, "nombreMadre_Marido");
                    $apellidoMadre_Marido = filter_input(INPUT_POST, "apellidoMadre_Marido");
                    $nombrePadre_Esposa = filter_input(INPUT_POST, "nombrePadre_Esposa");
                    $apellidoPadre_Esposa = filter_input(INPUT_POST, "apellidoPadre_Esposa");
                    $nombreMadre_Esposa = filter_input(INPUT_POST, "nombreMadre_Esposa");
                    $apellidoMadre_Esposa = filter_input(INPUT_POST, "apellidoMadre_Esposa");
                    $nombreMarido = filter_input(INPUT_POST, "nombreMarido");
                    $apellidoMarido = filter_input(INPUT_POST, "apellidoMarido");
                    $nombreMujer = filter_input(INPUT_POST, "nombreMujer");
                    $apellidoMujer = filter_input(INPUT_POST, "apellidoMujer");

                    $query = "UPDATE familias SET ";

                    if ($fechaMatrimonio) {
                        $query .= 'fechaMatrimonio="' . $fechaMatrimonio . '" ,';
                    }
                    if ($lugarMatrimonio) {
                        $query .= 'lugarMatrimonio=' . $lugarMatrimonio . ' ,';
                    }
                    if ($nombrePadre_Marido) {
                        $query .= ' nombrePadre_Marido="' . $nombrePadre_Marido . '", ';
                    }
                    if ($apellidoPadre_Marido) {
                        $query .= 'apellidoPadre_Marido="' . $apellidoPadre_Marido . '", ';
                    }
                    if ($nombreMadre_Marido) {
                        $query .= 'nombreMadre_Marido="' . $nombreMadre_Marido . '", ';
                    }
                    if ($apellidoMadre_Marido) {
                        $query .= 'apellidoMadre_Marido="' . $apellidoMadre_Marido . '", ';
                    }
                    if ($nombrePadre_Esposa) {
                        $query .= 'nombrePadre_Esposa="' . $nombrePadre_Esposa . '", ';
                    }
                    if ($apellidoPadre_Esposa) {
                        $query .= 'apellidoPadre_Esposa="' . $apellidoPadre_Esposa . '", ';
                    }
                    if ($nombreMadre_Esposa) {
                        $query .= 'nombreMadre_Esposa="' . $nombreMadre_Esposa . '", ';
                    }
                    if ($apellidoMadre_Esposa) {
                        $query .= 'apellidoMadre_Esposa="' . $apellidoMadre_Esposa . '", ';
                    }
                    if ($nombreMarido) {
                        $query .= 'nombreMarido="' . $nombreMarido . '", ';
                    }
                    if ($apellidoMarido) {
                        $query .= 'apellidoMarido="' . $apellidoMarido . '", ';
                    }
                    if ($nombreMujer) {
                        $query .= 'nombreEsposa="' . $nombreMujer . '", ';
                    }
                    if ($apellidoMujer) {
                        $query .= 'apellidoEsposa="' . $apellidoMujer . '"';
                    }

                    $query = rtrim($query, ',');
                    $query .= " WHERE idFamilia=" . $id . ";";

                    mysqli_query($db, $query);

                    if (mysqli_affected_rows($db) >= 1) {
                        echo "<p>($id) Base de datos actualizada<p>";
                    } else {
                        echo "<p>($id) No se ha podido actualizar<p>";
                    }
                    echo '<a href="javascript:history.back()">Volver</a>';
                } else if ($idPersona) {

                    $fechaNacimiento = filter_input(INPUT_POST, "fechaNacimiento");
                    $nombrePadre = filter_input(INPUT_POST, "nombrePadre");
                    $apellidoPadre = filter_input(INPUT_POST, "apellidoPadre");
                    $nombreMadre = filter_input(INPUT_POST, "nombreMadre");
                    $apellidoMadre = filter_input(INPUT_POST, "apellidoMadre");
                    $nombre = filter_input(INPUT_POST, "nombre");

                    $query = "UPDATE personas SET ";

                    if ($fechaNacimiento) {
                        $query .= "fechaNacimiento='" . $fechaNacimiento . "-00-00' , ";
                        $query .= "fechaBautismo='" . $fechaNacimiento . "-00-00' , ";
                    }
                    if ($nombrePadre) {
                        $query .= ' nombrePadre="' . $nombrePadre . '", ';
                    }
                    if ($apellidoPadre) {
                        $query .= 'apellidoPadre="' . $apellidoPadre . '", ';
                    }
                    if ($nombreMadre) {
                        $query .= 'nombreMadre="' . $nombreMadre . '", ';
                    }
                    if ($apellidoMadre) {
                        $query .= 'apellidoMadre="' . $apellidoMadre . '", ';
                    }
                    if ($nombre) {
                        $query .= 'nombre="' . $nombre . '", ';
                    }

                    $query = rtrim($query, ', ');
                    $query .= " WHERE idPersona=" . $idPersona . ";";

                    mysqli_query($db, $query);

                    if (mysqli_affected_rows($db) >= 1) {
                        echo "<p>($idPersona) Base de datos actualizada<p>";
                    } else {
                        echo "<p>($idPersona) No se ha podido actualizar<p>";
                    }
                    echo '<a href="javascript:history.back()">Volver</a>';
                }
                break;
            case "create":
                switch ($target) {
                    case "persona":
                        $coleccion = filter_input(INPUT_POST, "coleccion");
                        $tomo = filter_input(INPUT_POST, "tomo");
                        $folio = filter_input(INPUT_POST, "folio");
                        $vuelto = filter_input(INPUT_POST, "vuelto");
                        $fechaNacimiento = filter_input(INPUT_POST, "fechaNacimiento");
                        $nombrePadre = filter_input(INPUT_POST, "nombrePadre");
                        $apellidoPadre = filter_input(INPUT_POST, "apellidoPadre");
                        $nombreMadre = filter_input(INPUT_POST, "nombreMadre");
                        $apellidoMadre = filter_input(INPUT_POST, "apellidoMadre");
                        $nombre = filter_input(INPUT_POST, "nombre");
                        $lugarNacimiento = filter_input(INPUT_POST, "lugarNacimiento");
                        $fh = filter_input(INPUT_POST, "fh");
                        $fm = filter_input(INPUT_POST, "fm");

                        $query = "INSERT INTO personas (nombre";
                        if ($fechaNacimiento) {
                            $query .= ', fechaNacimiento, fechaBautismo';
                        }
                        $query .= ", lugarNacimiento, nombrePadre, apellidoPadre, nombreMadre, apellidoMadre) VALUES (";
                        $query .= '"' . $nombre . '",';
                        if ($fechaNacimiento) {
                            $query .= "'" . $fechaNacimiento . "-00-00',";
                            $query .= "'" . $fechaNacimiento . "-00-00',";
                        }
                        if ($lugarNacimiento) {
                            $query .= $lugarNacimiento . ',';
                        } else {
                            $query .= 'NULL,';
                        }
                        $query .= '"' . $nombrePadre . '",';
                        $query .= '"' . $apellidoPadre . '",';
                        $query .= '"' . $nombreMadre . '",';
                        $query .= '"' . $apellidoMadre . '");';


                        if (mysqli_query($db, $query)) {
                            if ($tomo) {
                                $id_Persona = mysqli_insert_id($db);
                                $busca_ref = "SELECT idReferencia FROM referencias WHERE coleccion=" . $coleccion
                                        . " AND tomo=" . $tomo . " AND folio=" . $folio . " AND vuelto=" . $vuelto . ";";
                                $resultado_ref = mysqli_query($db, $busca_ref);
                                $fila_r = mysqli_fetch_row($resultado_ref);
                                $id_Referencia = $fila_r[0];

                                $query_ref = "INSERT INTO referenciaspersona (idPersonaFK,idReferenciaFK) VALUES (" . $id_Persona . "," . $id_Referencia . ");";

                                if (mysqli_query($db, $query_ref)) {
                                    echo "Inserciones realizadas correctamente.";
                                } else {
                                    echo "Error en la inserción en la base de datos (referencia): " . "<br>" . mysqli_error($db);
                                }
                            } else if ($fh || $fm) {
                                $id_Persona = mysqli_insert_id($db);
                                if (isset($fh) && $fh) {
                                    $query_enlaza = "UPDATE familias SET esposo=$id_Persona WHERE idFamilia=$fh";
                                } else {
                                    $query_enlaza = "UPDATE familias SET esposa=$id_Persona WHERE idFamilia=$fm";
                                }
                                echo $query_enlaza;
                                if (mysqli_query($db, $query_enlaza)) {
                                    echo "Persona enlazada correctamente.";
                                } else {
                                    echo "Error en el enlace de la persona con la familia: " . "<br>" . mysqli_error($db);
                                }
                            } else {
                                echo "Persona añadida correctamente.";
                            }
                        } else {
                            echo "Error en la inserción en la base de datos (persona): " . "<br>" . mysqli_error($db);
                        }
                        break;
                    case "familia":
                        $coleccion = filter_input(INPUT_POST, "coleccion");
                        $tomo = filter_input(INPUT_POST, "tomo");
                        $folio = filter_input(INPUT_POST, "folio");
                        $vuelto = filter_input(INPUT_POST, "vuelto");
                        $fechaMatrimonio = filter_input(INPUT_POST, "fechaMatrimonio");
                        $nombrePadre_Marido = filter_input(INPUT_POST, "nombrePadre_Marido");
                        $apellidoPadre_Marido = filter_input(INPUT_POST, "apellidoPadre_Marido");
                        $nombreMadre_Marido = filter_input(INPUT_POST, "nombreMadre_Marido");
                        $apellidoMadre_Marido = filter_input(INPUT_POST, "apellidoMadre_Marido");
                        $nombrePadre_Esposa = filter_input(INPUT_POST, "nombrePadre_Esposa");
                        $apellidoPadre_Esposa = filter_input(INPUT_POST, "apellidoPadre_Esposa");
                        $nombreMadre_Esposa = filter_input(INPUT_POST, "nombreMadre_Esposa");
                        $apellidoMadre_Esposa = filter_input(INPUT_POST, "apellidoMadre_Esposa");
                        $nombreMarido = filter_input(INPUT_POST, "nombreMarido");
                        $apellidoMarido = filter_input(INPUT_POST, "apellidoMarido");
                        $nombreMujer = filter_input(INPUT_POST, "nombreMujer");
                        $apellidoMujer = filter_input(INPUT_POST, "apellidoMujer");

                        $query = "INSERT INTO familias (nombreMarido, apellidoMarido, nombreEsposa, apellidoEsposa";
                        if ($fechaMatrimonio) {
                            $query .= ', fechaMatrimonio';
                        }
                        $query .= ", nombrePadre_Marido, apellidoPadre_Marido, nombreMadre_Marido, apellidoMadre_Marido, "
                                . "nombrePadre_Esposa, apellidoPadre_Esposa, nombreMadre_Esposa, apellidoMadre_Esposa) VALUES (";
                        $query .= '"' . $nombreMarido . '",';
                        $query .= '"' . $apellidoMarido . '",';
                        $query .= '"' . $nombreMujer . '",';
                        $query .= '"' . $apellidoMujer . '",';
                        if ($fechaMatrimonio) {
                            $query .= "'" . $fechaMatrimonio . "',";
                        }
                        if ($nombrePadre_Marido) {
                            $query .= '"' . $nombrePadre_Marido . '",';
                        } else {
                            $query .= "NULL,";
                        }
                        if ($apellidoPadre_Marido) {
                            $query .= '"' . $apellidoPadre_Marido . '",';
                        } else {
                            $query .= "NULL,";
                        }
                        if ($nombreMadre_Marido) {
                            $query .= '"' . $nombreMadre_Marido . '",';
                        } else {
                            $query .= "NULL,";
                        }
                        if ($apellidoMadre_Marido) {
                            $query .= '"' . $apellidoMadre_Marido . '",';
                        } else {
                            $query .= "NULL,";
                        }
                        if ($nombrePadre_Esposa) {
                            $query .= '"' . $nombrePadre_Esposa . '",';
                        } else {
                            $query .= "NULL,";
                        }
                        if ($apellidoPadre_Esposa) {
                            $query .= '"' . $apellidoPadre_Esposa . '",';
                        } else {
                            $query .= "NULL,";
                        }
                        if ($nombreMadre_Esposa) {
                            $query .= '"' . $nombreMadre_Esposa . '",';
                        } else {
                            $query .= "NULL,";
                        }
                        if ($apellidoMadre_Esposa) {
                            $query .= '"' . $apellidoMadre_Esposa . '",';
                        } else {
                            $query .= "NULL,";
                        }
                        $query = rtrim($query, ',');
                        $query .= ");";

                        if (mysqli_query($db, $query)) {
                            if ($tomo) {
                                $id_Familia = mysqli_insert_id($db);
                                $busca_ref = "SELECT idReferencia FROM referencias WHERE coleccion=" . $coleccion
                                        . " AND tomo=" . $tomo . " AND folio=" . $folio . " AND vuelto=" . $vuelto . ";";
                                $resultado_ref = mysqli_query($db, $busca_ref);
                                $fila_r = mysqli_fetch_row($resultado_ref);
                                $id_Referencia = $fila_r[0];

                                $query_ref = "INSERT INTO referenciasmatrimonio (idMatrimonioFK,idReferenciaFK) VALUES (" . $id_Familia . "," . $id_Referencia . ");";

                                if (mysqli_query($db, $query_ref)) {
                                    echo "<p>Inserciones realizadas correctamente.</p>";
                                } else {
                                    echo "<p>Error en la inserción en la base de datos (referencia): </p>" . mysqli_error($db);
                                }
                            } else {
                                echo "<p>Familia añadida correctamente.</p>";
                            }
                        } else {
                            echo "<p>Error en la inserción en la base de datos (familia): </p>" . mysqli_error($db);
                        }
                        break;
                    case "lugar":
                        $categorialugar = filter_input(INPUT_POST, "categorialugar");
                        $lugarpadre = filter_input(INPUT_POST, "lugarpadre");
                        $nombre = filter_input(INPUT_POST, "nombre");
                        $wikidata = filter_input(INPUT_POST, "wikidata");
                        $preposicion = filter_input(INPUT_POST, "preposicion");

                        $query = 'INSERT INTO lugares (nombre,lugarPadre,categoria,preposicion,wikidata) VALUES ("' . $nombre . '",';
                        if ($lugarpadre) {
                            $query .= $lugarpadre . ',';
                        } else {
                            $query .= "NULL,";
                        }
                        if ($categorialugar) {
                            $query .= $categorialugar . ',';
                        } else {
                            $query .= "NULL,";
                        }
                        if ($preposicion) {
                            $query .= '"' . $preposicion . '",';
                        } else {
                            $query .= "NULL,";
                        }
                        if ($wikidata) {
                            $query .= substr($wikidata, 1) . ',';
                        } else {
                            $query .= "NULL,";
                        }

                        $query = rtrim($query, ',');
                        $query .= ");";

                        if (mysqli_query($db, $query)) {
                            echo "<p>Lugar insertado correctamente.</p>";
                        } else {
                            echo "<p>Error en la inserción en la base de datos (lugar): </p>" . mysqli_error($db);
                        }
                        break;
                }
                break;
        }
        ?>
    </body>
</html>
