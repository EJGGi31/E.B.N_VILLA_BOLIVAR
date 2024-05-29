<?php

require '../model/conexion.php';
require 'cod.php';

//Create en Base de Datos...
if(!empty($_POST) && isset($_POST['1'])){
    if(isset($_POST['lapso'], $_POST['resumen'])){
        $lapso = trim($_POST['lapso']);
        $resumen = trim($_POST['resumen']);
       

        if(!empty($lapso) && !empty($resumen)){

            $cod= cod();

            $insert = $connect->prepare("INSERT INTO cortes (cod_corte, lapso, resumen) VALUES (?,?,?)");
            $insert-> bind_param('iss', $cod, $lapso, $resumen);

            if(!$insert->execute()){
                die("Error al insertar: " . $connect->error);
            }
        }
    }
}

//Read Base de Datos...




$records = array();

    if($read = $connect->query("SELECT * FROM cortes")){
        if($read->num_rows){
            while($row = $read->fetch_object()){
                $records[] = $row;
            }
            $read->free();
        }
    }


// Update Base de datos...

if (!empty($_POST) && isset($_POST['3'])) {
    $fields = [];
    $values = [];
    $types = '';

    if (isset($_POST['cod_corte']) && !empty(trim($_POST['cod_corte']))) {
        $fields[] = 'cod_corte = ?';
        $values[] = trim($_POST['cod_corte']);
        $types .= 'i';
    }
    if(isset($_POST['lapso']) && !empty(trim($_POST['lapso']))){
        $fields[] = 'lapso = ?';
        $values[] = trim($_POST['lapso']);
        $types .= 's';
    }
    if(isset($_POST['resumen']) && !empty(trim($_POST['resumen']))){
        $fields[] = 'resumen = ?';
        $values[] = trim($_POST['resumen']);
        $types .= 's';
    }

    if (!empty($fields)) {
        $query = "UPDATE cortes SET " . implode(', ', $fields) . " WHERE cod_corte = ?";
        $stmt = $connect->prepare($query);
        $values[] = $_POST['cod_corte'];
        $types .= 's';
        $stmt->bind_param($types, ...$values);

        if (!$stmt->execute()) {
            die("Error al actualizar: " . $stmt->error);
        }
    }
}

//Delete Base de datos...

if(!empty($_POST) && isset($_POST['4'])){
    if(isset($_POST['cod_corte'])){
        $cod_corte = trim($_POST['cod_corte']);

        if(!empty($cod_corte)){
            $delete = $connect->prepare("DELETE FROM cortes WHERE cod_corte = ?");
            $delete->bind_param('i', $cod_corte);
            if(!$delete->execute()){
                die("Error al eliminar: " . $delete->error);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cortes</title>
</head>
<body>

    <h1>Records</h1>

    <?php print_r($records); ?>


    <h1>Formulario de cortes</h1>
    <form action="cortes.php" method="post">
        <label for="lapso">lapso:</label>
        <input type="text" id="lapso" name="lapso" required>

        <label for="resumen">resumen:</label>
        <textarea name="resumen"></textarea>

        <input type="submit" name="1" value="Registrar">
    </form>

    <h1>Actualizar Datos de un corte</h1>
    <form action="cortes.php" method="post">
        <label for="lapso">Codigo:</label>
        <input type="text" id="cod_corte" name="cod_corte" required>

        <label for="lapso">lapso:</label>
        <input type="text" id="lapso" name="lapso" required>

        <label for="resumen">resumen:</label>
        <textarea name="resumen"></textarea>

        <input type="submit" name="3" value= "Actualizar">
    </form>

    <h1>Eliminar Registro de cortes</h1>
    <form action="cortes.php" method="post">
        <label for="cod_corte">Codigo:</label>
        <input type="text" id="cod_corte" name="cod_corte" required>

        <input type="submit" name="4" value= "Eliminar">
    </form>
</body>
</html>