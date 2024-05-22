<?php

require '../model/conexion.php';

//Create en Base de Datos...
if(!empty($_POST)){
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

            if($insert->execute()){
                die();
            }
        }
    }
}

//Read Base de Datos...

$records = array();

if($read = $connect->query("SELECT * FROM alumno")){
    if($read->num_rows){
        while($row = $read-fetch_object()){
            $records[] = $row;
        }
        $read->free();
    }
}

//Update Base de datos...

//Delete Base de datos...

if(!empty($_DELETE)){
    if(isset($_DELETE['ci_escolar'])){
        $ci_escolar = trim($_DELETE['ci_escolar']);

        if(!empty($ci_escolar)){
            $delete = $connect->query("DELETE FROM alumno WHERE ci_escolar = '$ci'");
        }
    }
}