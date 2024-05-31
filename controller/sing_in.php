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