<?php

require '../model/conexion.php';

if(!empty($_GET)){
    if(isset($_GET['ci'],$_GET['contrasena'])){
        $ci= trim($_GET['ci']);
        $pass= trim($_GET['contrasena']);

        if(!empty($ci) && !empty($pass)){
            $query= $connect->query("SELECT * FROM usuario WHERE '$ci'=ci and '$pass'=contrasena");

            if(mysqli_num_rows($query)>0){
                $_SESSION['ci'] = $ci;
                return true;
            }else{
                return false;
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
        <form action="sing_in.php" method="GET">
            <div class="field">
                <label for="ci">Cedula</label>
                <input type="text" name="ci" id="ci" autocomplete="off">
            </div>

            <div class="field">
                <label for="contrasena">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" autocomplete="off">
            </div>

            <button type=>Enviar</button>
        </form>
    </body>