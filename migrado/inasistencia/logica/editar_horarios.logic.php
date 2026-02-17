<?php
$conexion = new mysqli("localhost", "fgoicoechea", "sobral2011", "sid");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener plazas activas
$sqlPlazas = "SELECT plaza, nombre FROM materia_cargo WHERE activo = 1 ORDER BY plaza ASC";
$resPlazas = $conexion->query($sqlPlazas);

$plazaSeleccionada = isset($_GET['plaza_id']) ? $_GET['plaza_id'] : null;

$horarios = [];
if ($plazaSeleccionada) {
    $sqlHorarios = "SELECT id, dia, hora_inicio, hora_fin FROM horarios_plaza WHERE plaza_id = '$plazaSeleccionada' ORDER BY FIELD(dia, 'Lunes','Martes','Miércoles','Jueves','Viernes'), hora_inicio";
    $resHorarios = $conexion->query($sqlHorarios);
    while ($row = $resHorarios->fetch_assoc()) {
        $horarios[] = $row;
    }
}
?>


