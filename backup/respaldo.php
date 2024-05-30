<?php

require '../model/conexion.php';

// Seleccionar la base de datos
mysqli_select_db($connect, $dataBase);

// Definir la ruta de la carpeta de copias de seguridad
$backup_folder = "../backup"; // Ajusta la ruta según tu configuración

// Generar el nombre del archivo de copia de seguridad
$backup_file_name = "bd_backup_" . date("Y-m-d_H-i-s") . ".sql";

// Obtener la ruta completa del archivo
$backup_file_path = realpath($backup_folder . $backup_file_name);

// Generar el nombre del archivo de copia de seguridad
$backup_file_name = "bd_backup_" . date("Y-m-d_H-i-s") . ".sql";

// Obtener todas las tablas de la base de datos
$tables = array();
$sql = "SHOW TABLES";
$result = mysqli_query($connect, $sql);

// Extraer los nombres de las tablas
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// Crear el archivo de copia de seguridad
$fp = fopen($backup_file_name, "w");

// Generar y escribir el contenido del script SQL
foreach ($tables as $table) {
    // Encabezado de la tabla
    fwrite($fp, "\n\n-- Estructura de la tabla `{$table}`\n");
    $table_structure = mysqli_query($connect, "SHOW CREATE TABLE `{$table}`");
    $table_structure_result = mysqli_fetch_row($table_structure);
    fwrite($fp, $table_structure_result[1] . ";\n\n");

    // Datos de la tabla
    fwrite($fp, "\n-- Datos de la tabla `{$table}`\n");
    $table_data = mysqli_query($connect, "SELECT * FROM `{$table}`");
    while ($table_row = mysqli_fetch_assoc($table_data)) {
        $sql = "INSERT INTO `{$table}` (`" . implode('`, `', array_keys($table_row)) . "`) VALUES ('" . implode("', '", array_values($table_row)) . "');\n";
        fwrite($fp, $sql);
    }
}

// Cerrar el archivo y la conexión
fclose($fp);
mysqli_close($connect);

// Mostrar mensaje de éxito
echo "Copia de seguridad creada correctamente: {$backup_file_name}";

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear copia de seguridad de la base de datos</title>
</head>
<body>
    <h1>Crear copia de seguridad de la base de datos</h1>

    <button onclick="createBackup()">Generar copia de seguridad</button>

    <script>
        function createBackup() {
            // Enviar una solicitud al script PHP para crear la copia de seguridad
            fetch('respaldo.php', {
                method: 'GET'
            })
            .then(response => response.text())
            .then(result => {
                // Mostrar el mensaje de éxito o error
                alert(result);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Se ha producido un error al crear la copia de seguridad.');
            });
        }
    </script>
</body>
</html>
