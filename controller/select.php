<?php

function lapso() {

    // Conexión a la base de datos (reemplace con sus credenciales)
    require '../model/conexion.php';

    // Consulta SQL para recuperar registros
    $sql = "SELECT lapso FROM lapso";
    $result = $connect->query($sql);

    // Almacenar los resultados en un array
    $registros = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $registros[] = $row;
        }
    } else {
        echo "No se encontraron registros";
    }

    return $registros; // Devolver el array de registros
}

function alumno() {

    // Conexión a la base de datos (reemplace con sus credenciales)
    require '../model/conexion.php';

    // Consulta SQL para recuperar registros
    $sql = "SELECT nombre_completo FROM alumno";
    $result = $connect->query($sql);

    // Almacenar los resultados en un array
    $registros = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $registros[] = $row;
        }
    } else {
        echo "No se encontraron registros";
    }

    return $registros; // Devolver el array de registros
}

function nivel(){
    
    // Conexión a la base de datos (reemplace con sus credenciales)
    require '../model/conexion.php';

    // Consulta SQL para recuperar registros
    $sql = "SELECT grado, seccion FROM nivel";
    $result = $connect->query($sql);

    // Almacenar los resultados en un array
    $registros = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $registros[] = $row;
        }
    } else {
        echo "No se encontraron registros";
    }

    return $registros; // Devolver el array de registros
}