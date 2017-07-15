<?php

function referencia($tomo, $folio, $vuelto) {
    $a = $tomo . "/" . str_pad($folio, 3, "0", STR_PAD_LEFT);
    if ($vuelto) {
        $a .= 'v';
    }
    return $a;
}

function mostrar_ref($tomo, $folio, $vuelto) {
    $a = referencia($tomo, $folio, $vuelto);
    echo $a;
}

function conectar_bd() {
    $a = new mysqli('localhost', 'u564681783_javi', 'familia escudero', 'u564681783_ag') or die(mysql_error());
    if ($a->connect_error) {
        die("Unable to connect database: " . $a->connect_error);
    }
    return $a;
}

function buscar_unico($query, $db) {
    $res_query = mysqli_query($db, $query);
    $resultado = mysqli_fetch_array($res_query);
    mysqli_free_result($res_query);
    return $resultado;
}

function columna($contenido, $centrado) {
    echo '<td';
    if ($centrado) {
        echo ' class="centrar"';
    }
    echo '>';
    echo $contenido;
    echo '</td>';
}

function nombre_completo($nombre, $apellido1, $apellido2) {
    $a = implode(' ', array($nombre, $apellido1));
    if ($apellido2 != 0) {
        $a .= ' ' . $apellido2;
    }
    return $a;
}

function consulta($database, $id) {
    switch ($database) {
        case 'personas':
            $query = searchbyid('personas', 'idPersona') . $id;
            break;
        case 'familias':
            $query = searchbyid('familias', 'idFamilia') . $id;
            break;
        case 'lugares':
            $query = searchbyid('lugares', 'idLugar') . $id;
            break;
    }
    return $query;
}

function searchbyid($tabla, $columna) {
    $query = 'SELECT * FROM ' . $tabla . ' WHERE ' . $columna . "=";
    return $query;
}

function y_o_e($siguiente_palabra) {
    if ($siguiente_palabra[0] == 'I' || $siguiente_palabra[0] == 'i') {
        echo ' e ';
    } else {
        echo ' y ';
    }
}

function fecha_completa($fecha) {
    $date = date_create($fecha);
    $dias = array("domingo", "lunes", "martes", "miercoles", "jueves", "viernes", "sábado");
    $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
    echo $dias[date_format($date, 'w')] . ", " . ltrim(date_format($date, 'd'), '0') . " de " . $meses[date_format($date, 'n') - 1] . " de " . date_format($date, 'Y');
}

function fecha_corta($fecha, $dia_semana) {
    $date = date_create($fecha);
    $dias = array("D", "L", "M", "X", "J", "V", "S");
    if ($dia_semana) {
        $return = $dias[date_format($date, 'w')] . ' ' . date_format($date, "d/m/Y");
    } else {
        $return = date_format($date, "d/m/Y");
    }
    return $return;
}
