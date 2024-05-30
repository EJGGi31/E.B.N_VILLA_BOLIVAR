<?php

require '../model/conexion.php';

// Verificar si se ha enviado el formulario
if (isset($_FILES['backupFile'])) {

    // Obtener el archivo de copia de seguridad
    $backupFile = $_FILES['backupFile']['tmp_name'];

    // Abrir el archivo de copia de seguridad
    $fp = fopen($backupFile, "r");

    // Ejecutar las consultas SQL
    if ($fp) {
        while (!feof($fp)) {
            $line = fgets($fp);
            if (trim($line) != "" && !preg_match("/^--/", $line)) {
                // Reemplazar "tu_tabla" con el nombre real de la tabla
                if (strpos($line, "INSERT INTO `tu_tabla`") !== false) {
                    // Procesar la consulta de inserción para la tabla específica
                    $insert_query = $line;
                    // ... (código para procesar y ejecutar la consulta de inserción)
                } else {
                    // Ejecutar la consulta SQL directamente
                    mysqli_query($connect, $line);
                }
            }
        }
        fclose($fp);
    } else {
        echo "Error al abrir el archivo de copia de seguridad.";
    }

    // Reactivar las claves foráneas
    mysqli_query($connect, "SET FOREIGN_KEY_CHECKS = 1;");

    // Cerrar la conexión
    mysqli_close($connect);

    // Mostrar mensaje de éxito
    echo "Copia de seguridad restaurada correctamente.";

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurar copia de seguridad de la base de datos</title>
</head>
<body>
    <h1>Restaurar copia de seguridad de la base de datos</h1>

    <form action="restaurar.php" method="post" enctype="multipart/form-data">
        <label for="backupFile">Seleccionar archivo de copia de seguridad:</label>
        <input type="file" id="backupFile" name="backupFile" required>

        <button type="submit">Restaurar copia de seguridad</button>
    </form>
</body>
</html>