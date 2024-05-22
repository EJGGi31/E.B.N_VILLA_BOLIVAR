<?php

$host= 'localhost';
$user= 'root';
$pass= '';
$dataBase= 'ebn_villabolivar';

$connect= new mysqli($host,$user,$pass,$dataBase);

if($connect->connect_error){
    die ('la conexion fallo con exito');
}