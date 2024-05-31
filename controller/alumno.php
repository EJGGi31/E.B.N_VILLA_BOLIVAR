<?php

require '../model/conexion.php';

//Create en Base de Datos...
if(!empty($_POST) && isset($_POST['1'])){
    if(isset($_POST['ci_escolar'], $_POST['nombres'], $_POST['apellidos'], $_POST['genero'], $_POST['fecha_nac'], $_POST['lugar_nac'])){
        $ci_escolar = trim($_POST['ci_escolar']);
        $name = trim($_POST['nombres']);
        $surname = trim($_POST['apellidos']);
        $genre = trim($_POST['genero']);
        $birth = trim($_POST['fecha_nac']);
        $birth_place = trim($_POST['lugar_nac']);

        if(!empty($ci_escolar) && !empty($name) && !empty($surname) && !empty($genre) && !empty($birth) && !empty($birth_place)){
            $insert = $connect->prepare("INSERT INTO alumno (ci_escolar, nombres, apellidos, genero, fecha_nac, lugar_nac) VALUES (?,?,?,?,?,?)");
            $insert-> bind_param('ssssss',$ci_escolar,$name,$surname,$genre,$birth,$birth_place);

            if(!$insert->execute()){
                die("Error al insertar: " . $insert->error);
            }
        }
    }
}

//Read Base de Datos...




$records = array();

    if($read = $connect->query("SELECT * FROM alumno")){
        if($read->num_rows){
            while($row = $read->fetch_object()){
                $records[] = $row;
            }
            $read->free();
        }
    }


// Update Base de datos...

if (!empty($_POST) && isset($_POST['3'])) {
    $fields = [];
    $values = [];
    $types = '';

    if (isset($_POST['ci_escolar']) && !empty(trim($_POST['ci_escolar']))) {
        $fields[] = 'ci_escolar = ?';
        $values[] = trim($_POST['ci_escolar']);
        $types .= 's';
    }
    if(isset($_POST['nombres']) && !empty(trim($_POST['nombres']))){
        $fields[] = 'nombres = ?';
        $values[] = trim($_POST['nombres']);
        $types .= 's';
    }
    if(isset($_POST['apellidos']) && !empty(trim($_POST['apellidos']))){
        $fields[] = 'apellidos = ?';
        $values[] = trim($_POST['apellidos']);
        $types .= 's';
    }
    if(isset($_POST['genero']) && !empty(trim($_POST['genero']))){
        $fields[] = 'genero = ?';
        $values[] = trim($_POST['genero']);
        $types .= 's';
    }
    if(isset($_POST['fecha_nac']) && !empty(trim($_POST['fecha_nac']))){
        $fields[] = 'fecha_nac = ?';
        $values[] = trim($_POST['fecha_nac']);
        $types .= 's';
    }
    if(isset($_POST['lugar_nac']) && !empty(trim($_POST['lugar_nac']))){
        $fields[] = 'lugar_nac = ?';
        $values[] = trim($_POST['lugar_nac']);
        $types .= 's';
    }

    if (!empty($fields)) {
        $query = "UPDATE alumno SET " . implode(', ', $fields) . " WHERE ci_escolar = ?";
        $stmt = $connect->prepare($query);
        $values[] = $_POST['ci_escolar'];
        $types .= 's';
        $stmt->bind_param($types, ...$values);

        if (!$stmt->execute()) {
            die("Error al actualizar: " . $stmt->error);
        }
    }
}

//Delete Base de datos...

if(!empty($_POST) && isset($_POST['4'])){
    if(isset($_POST['ci_escolar'])){
        $ci_escolar = trim($_POST['ci_escolar']);

        if(!empty($ci_escolar)){
            $delete = $connect->prepare("DELETE FROM alumno WHERE ci_escolar = ?");
            $delete->bind_param('s', $ci_escolar);
            if(!$delete->execute()){
                die("Error al eliminar: " . $delete->error);
            }
        }
    }
}
?>