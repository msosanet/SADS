<?php
$conexion = new mysqli("localhost", "fgoicoechea", "sobral2011", "sid");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$plaza_id = $_POST['plaza_id'];
$horas_inicio = $_POST['hora_inicio'];
$horas_fin = $_POST['hora_fin'];

if (empty($plaza_id)) {
    die("Error: La plaza es obligatoria.");
}

$errores = [];

// Eliminar horarios anteriores de la plaza (para que no se dupliquen)
$conexion->query("DELETE FROM horarios_plaza WHERE plaza_id = '$plaza_id'");

// Insertar nuevos horarios
foreach ($horas_inicio as $dia => $turnos) {
    foreach ($turnos as $index => $hora_inicio) {
        $hora_fin = $horas_fin[$dia][$index];

        if (!empty($hora_inicio) && !empty($hora_fin)) {
            $sql = "INSERT INTO horarios_plaza (plaza_id, dia, hora_inicio, hora_fin)
                    VALUES ('$plaza_id', '$dia', '$hora_inicio', '$hora_fin')";

            if (!$conexion->query($sql)) {
                $errores[] = "Error al guardar el horario de $dia (turno ".($index+1)."): " . $conexion->error;
            }
        }
    }
}

$conexion->close();
?>


