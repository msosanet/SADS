<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "fgoicoechea", "sobral2011", "sid");

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener las plazas activas (activo = 1)
$sqlPlazas = "SELECT plaza, nombre FROM materia_cargo WHERE activo = 1 ORDER BY plaza ASC";
$resultadoPlazas = $conexion->query($sqlPlazas);

// Obtener los horarios existentes de la plaza seleccionada
$plazaSeleccionada = isset($_GET['plaza_id']) ? $_GET['plaza_id'] : null;
$horariosExistentes = [];

if ($plazaSeleccionada) {
    $sqlHorarios = "SELECT dia, hora_inicio, hora_fin FROM horarios_plaza WHERE plaza_id = '$plazaSeleccionada'";
    $resultadoHorarios = $conexion->query($sqlHorarios);

    while ($fila = $resultadoHorarios->fetch_assoc()) {
        $horariosExistentes[$fila['dia']][] = [
            "hora_inicio" => $fila['hora_inicio'],
            "hora_fin" => $fila['hora_fin']
        ];
    }
}
?>


