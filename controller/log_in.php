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

<!DOCTYPE html>

<html>
    <head>
        <title>Registro</title>        
    </head>

    <body>
        <form action="log_in.php" method="POST">
            <div class="field">Cédula
                <select name="nacionalidad" id="nacionalidad">
                    <option value="V-">V-</option>
                    <option value="E-">E-</option>
                </select>

                <label for="ci"></label>
                <input type="text" name="ci" id="ci" autocomplete="off">
            </div>

            <div class="field">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" autocomplete="off">
            </div>

            <div class="field">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" autocomplete="off">
            </div>

            <div class="field">
                <label for="contrasena">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" autocomplete="off">
            </div>

            <button type=>Enviar</button>
        </form>
    </body>