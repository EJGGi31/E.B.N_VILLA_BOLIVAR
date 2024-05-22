<?php

require '../model/conexion.php';

if(!empty($_POST)){
    if(isset($_POST['ci'],$_POST['nombre'],$_POST['contrasena'])){
        $ci= trim($_POST['ci']);
        $name= trim($_POST['nombre']);
        $pass= trim($_POST['contrasena']);

        if(!empty($ci) && !empty($name) && !empty($pass)){
            $insert= $connect->prepare("INSERT INTO usuario (ci, nombre, contrasena) VALUES (?,?,?)");
            $insert->bind_param('sss', $ci, $name, $pass);

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
            <div class="field">
                <label for="ci">Cedula</label>
                <input type="text" name="ci" id="ci" autocomplete="off">
            </div>

            <div class="field">
                <label for="nombre">Nombre Completo</label>
                <input type="text" name="nombre" id="nombre" autocomplete="off">
            </div>

            <div class="field">
                <label for="contrasena">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" autocomplete="off">
            </div>

            <button type=>Enviar</button>
        </form>
    </body>