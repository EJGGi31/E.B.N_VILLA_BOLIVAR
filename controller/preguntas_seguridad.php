<?php

require '../model/conexion.php';
require '../controller/cod.php';

//create
$cod_pregunta = cod();

if (isset($_POST['1era_seguridad'], $_POST['respuesta_1'], $_POST['2da_seguridad'], $_POST['respuesta_2'])){
    $pregunta1 = trim($_POST['1era_seguridad']);
    $respuesta1 = trim($_POST['respuesta_1']);
    $pregunta2 = trim($_POST['2da_seguridad']);
    $respuesta2 = trim($_POST['respuesta_2']);

    if (!empty($pregunta1) && !empty($respuesta1) && !empty($pregunta2) && !empty($respuesta2)) {

            $pregunta = $connect->prepare("INSERT INTO preguntas_seguridad (cod_pregunta, 1era_seguridad, respuesta_1, 2da_seguridad, respuesta_2) VALUES (?, ?, ?, ?, ?)");
            $pregunta->bind_param('issss', $cod_pregunta, $pregunta1, $respuesta1, $pregunta2, $respuesta2);

            if ($pregunta->execute()) {
                die();
            } 
        }
}

//Read
    $records = array();

    if($read = $connect->query("SELECT * FROM preguntas_seguridad")){
        if($read->num_rows){
            while($row = $read->fetch_object()){
                $records[] = $row;
            }
            $read->free();
        }
    }

//Update
if (!empty($_POST) && isset($_POST['2'])) {
    $fields = [];
    $values = [];
    $types = '';

    if (isset($_POST['cod_pregunta']) && !empty(trim($_POST['cod_pregunta']))) {
        $fields[] = 'cod_pregunta = ?';
        $values[] = trim($_POST['cod_pregunta']);
        $types .= 'i';
    }
    if(isset($_POST['1era_seguridad']) && !empty(trim($_POST['1era_seguridad']))){
        $fields[] = '1era_seguridad = ?';
        $values[] = trim($_POST['1era_seguridad']);
        $types .= 's';
    }
    if(isset($_POST['respuesta_1']) && !empty(trim($_POST['respuesta_1']))){
        $fields[] = 'respuesta_1 = ?';
        $values[] = trim($_POST['respuesta_1']);
        $types .= 's';
    }
    if(isset($_POST['2da_seguridad']) && !empty(trim($_POST['2da_seguridad']))){
        $fields[] = '2da_seguridad = ?';
        $values[] = trim($_POST['2da_seguridad']);
        $types .= 's';
    }
    if(isset($_POST['respuesta_2']) && !empty(trim($_POST['respuesta_2']))){
        $fields[] = 'respuesta_2 = ?';
        $values[] = trim($_POST['respuesta_2']);
        $types .= 's';
    }

    if (!empty($fields)) {
        $query = "UPDATE preguntas_seguridad SET " . implode(', ', $fields) . " WHERE cod_pregunta = ?";
        $stmt = $connect->prepare($query);
        $values[] = $_POST['cod_pregunta'];
        $types .= 'i';
        $stmt->bind_param($types, ...$values);

        if (!$stmt->execute()) {
            die("Error al actualizar: " . $stmt->error);
        }
    }
}

?>

<!DOCTYPE html>

<html>
    <head>
        <title>preguntas</title>        
    </head>

    <h2>records</h2>
    <?php print_r($records); ?>

    <h2>preguntas</h2>
    <form action="preguntas_seguridad.php" method="POST">
            <div class="field">1era Pregunta Seguridad
                <select name="1era_seguridad" id="1era_seguridad">
                    <option value="Primera Mascota">Primera Mascota</option>
                    <option value="Primer Automovil">Primer Automovil</option>
                </select>

                <label for="respuesta_1"></label>
                <input type="password" name="respuesta_1" id="respuesta_1" autocomplete="off">
            </div>

            <div class="field">2da Pregunta de Seguridad
            <select name="2da_seguridad" id="2da_seguridad">
                    <option value="Primera Mascota">Primera Mascota</option>
                    <option value="Primer Automovil">Primer Automovil</option>
                </select>

                <label for="respuesta_2"></label>
                <input type="password" name="respuesta_2" id="respuesta_2" autocomplete="off">
            </div>

            <button>enviar</button>
    </form>

    <h2>preguntas_Actualizar</h2>
    <form action="preguntas_seguridad.php" method="POST">
            <input type="hidden" value="2">

            <div class="field">Codigo de pregunta
                <label for="cod_pregunta"></label>
                <input type="password" name="cod_pregunta" id="cod_pregunta" autocomplete="off">
            </div>

            <div class="field">1era Pregunta Seguridad
                <select name="1era_seguridad" id="1era_seguridad">
                    <option value="Primera Mascota">Primera Mascota</option>
                    <option value="Primer Automovil">Primer Automovil</option>
                </select>

                <label for="respuesta_1"></label>
                <input type="password" name="respuesta_1" id="respuesta_1" autocomplete="off">
            </div>

            <div class="field">2da Pregunta de Seguridad
            <select name="2da_seguridad" id="2da_seguridad">
                    <option value="Primera Mascota">Primera Mascota</option>
                    <option value="Primer Automovil">Primer Automovil</option>
                </select>

                <label for="respuesta_2"></label>
                <input type="password" name="respuesta_2" id="respuesta_2" autocomplete="off">
            </div>

            <button>actualizar</button>
    </form>