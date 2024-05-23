<?php
// Generar un código aleatorio de 15 dígitos
function cod($longitud = 15) {
    $caracteres = '0123456789';
    $codigo = '';
    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $codigo;
}

?>