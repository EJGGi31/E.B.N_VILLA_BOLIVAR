<?php

require '../model/conexion.php';
require 'cod.php';

//Create en Base de Datos...
if(!empty($_POST) && isset($_POST['1'])){
    if(isset($_POST['lapso'], $_POST['resumen'])){
        $lapso = trim($_POST['lapso']);
        $resumen = trim($_POST['resumen']);
       

        if(!empty($lapso) && !empty($resumen)){

            $cod= cod();

            $insert = $connect->prepare("INSERT INTO cortes (cod_corte, lapso, resumen) VALUES (?,?,?)");
            $insert-> bind_param('iss', $cod, $lapso, $resumen);

            if(!$insert->execute()){
                die("Error al insertar: " . $connect->error);
            }
        }
    }
}

//Read Base de Datos...




$records = array();

    if($read = $connect->query("SELECT * FROM cortes")){
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

    if (isset($_POST['cod_corte']) && !empty(trim($_POST['cod_corte']))) {
        $fields[] = 'cod_corte = ?';
        $values[] = trim($_POST['cod_corte']);
        $types .= 'i';
    }
    if(isset($_POST['lapso']) && !empty(trim($_POST['lapso']))){
        $fields[] = 'lapso = ?';
        $values[] = trim($_POST['lapso']);
        $types .= 's';
    }
    if(isset($_POST['resumen']) && !empty(trim($_POST['resumen']))){
        $fields[] = 'resumen = ?';
        $values[] = trim($_POST['resumen']);
        $types .= 's';
    }

    if (!empty($fields)) {
        $query = "UPDATE cortes SET " . implode(', ', $fields) . " WHERE cod_corte = ?";
        $stmt = $connect->prepare($query);
        $values[] = $_POST['cod_corte'];
        $types .= 's';
        $stmt->bind_param($types, ...$values);

        if (!$stmt->execute()) {
            die("Error al actualizar: " . $stmt->error);
        }
    }
}

//Delete Base de datos...

if(!empty($_POST) && isset($_POST['4'])){
    if(isset($_POST['cod_corte'])){
        $cod_corte = trim($_POST['cod_corte']);

        if(!empty($cod_corte)){
            $delete = $connect->prepare("DELETE FROM cortes WHERE cod_corte = ?");
            $delete->bind_param('i', $cod_corte);
            if(!$delete->execute()){
                die("Error al eliminar: " . $delete->error);
            }
        }
    }
}
?>