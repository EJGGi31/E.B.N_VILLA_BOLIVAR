<?php

require '../model/conexion.php';
require 'cod.php';
require 'select.php';

//Create en Base de Datos...
if(!empty($_POST) && isset($_POST['1'])){
    if(isset($_POST['alumno'], $_POST['nivel'],$_POST['lapso'], $_POST['resumen'])){
        $alumno = trim($_POST['alumno']);
        $nivel = trim($_POST['nivel']);
        $lapso = trim($_POST['lapso']);
        $resumen = trim($_POST['resumen']);
       

        if(!empty($alumno) && !empty($nivel) && !empty($lapso) && !empty($resumen)){

            $cod= cod();

            $insert = $connect->prepare("INSERT INTO cortes (cod_corte, alumno, nivel, lapso, resumen) VALUES (?,?,?,?,?)");
            $insert-> bind_param('issss', $cod, $alumno, $nivel, $lapso, $resumen);

            if(!$insert->execute()){
                die("Error al insertar: " . $connect->error);
            }
        }
    }
}

//Read Base de Datos...


if(isset($_POST['2'])){

$records = array();

    if($read = $connect->query("SELECT * FROM cortes")){
        if($read->num_rows){
            while($row = $read->fetch_object()){
                $records[] = $row;
            }
            $read->free();
        }
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
    if(isset($_POST['alumno']) && !empty(trim($_POST['alumno']))){
        $fields[] = 'alumno = ?';
        $values[] = trim($_POST['alumno']);
        $types .= 's';
    }
    if(isset($_POST['nivel']) && !empty(trim($_POST['nivel']))){
        $fields[] = 'nivel = ?';
        $values[] = trim($_POST['nivel']);
        $types .= 's';
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
        $ci_escolar = trim($_POST['cod_corte']);

        if(!empty($ci_escolar)){
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
    <title>Formulario de Alumnos</title>
</head>
<body>
    <h1>Formulario de cortes</h1>
    <form action="cortes.php" method="post">
        <select name="alumno">
            <?php $registros = alumno(); // Obtener los registros ?>
            <?php foreach ($registros as $registro): ?>
                <option value="<?php echo $registro['nombre_completo']; ?>">
                    <?php echo $registro['nombre_completo']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="nivel"></label>
        <input type="nivel" id="nivel" name="nivel" required>

        <label for="lapso">lapso:</label>
        <select name="lapso">
            <?php $registros = lapso(); // Obtener los registros ?>
            <?php foreach ($registros as $registro): ?>
                <option value="<?php echo $registro['lapso']; ?>">
                    <?php echo $registro['lapso']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="resumen">Resumen:</label>
        <textarea id="resumen" name="resumen"></textarea>

        <input type="submit" name="1" value="Registrar">
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos</title>
</head>
<body>
    <h1>Actualizar Datos del Alumno</h1>
    <form action="cortes.php" method="post">
        <label for="cod_corte">Codigo de corte:</label>
        <input type="integer" id="cod_corte" name="cod_corte" required>

        <label for="alumno">Alumno:</label>
        <input type="alumno" id="alumno" name="alumno" required>

        <label for="nivel"></label>
        <input type="nivel" id="nivel" name="nivel" required>

        <label for="lapso">lapso:</label>
        <select name="lapso">
        <?php foreach ($registros as $registro): ?>
            <option value="<?php echo $registro['lapso']; ?>"><?php echo $registro['lapso']; ?></option>
        <?php endforeach; ?>
        </select>

        <label for="resumen">Resumen:</label>
        <textarea id="resumen" name="resumen"></textarea>

        <input type="submit" name="3" value= "Actualizar">
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Registro</title>
</head>
<body>
    <h1>Eliminar Registro de Alumno</h1>
        <form action="cortes.php" method="post">
        <label for="cod_corte">Codigo de corte:</label>
        <input type="text" id="cod_corte" name="cod_corte" required>

        <input type="submit" name="4" value="Eliminar">
    </form>
</body>
</html>