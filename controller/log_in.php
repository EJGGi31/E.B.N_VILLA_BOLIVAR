<?php

require '../model/conexion.php';
require '../controller/cod.php';

if(!empty($_POST)){
    if(isset($_POST['nacionalidad'], $_POST['ci'],$_POST['nombre'], $_POST['apellido'],$_POST['contrasena'])){
        $nation= trim($_POST['nacionalidad']);
        $ci= trim($_POST['ci']);
        $name= trim($_POST['nombre']);
        $surname= trim($_POST['apellido']);
        $pass= trim($_POST['contrasena']);

        if(!empty($nation) && !empty($ci) && !empty($name) && !empty($surname) && !empty($pass) && !empty($seguridad_1era) && !empty($seguridad_2do)){
            $insert= $connect->prepare("INSERT INTO usuario (nacionalidad, ci, nombre, apellido, contrasena) VALUES (?,?,?,?,?)");
            $insert->bind_param('sssss',$nation, $ci, $name, $surname, $pass);

            if($insert->execute()){
                die();
            }
        }
    }
}

?>