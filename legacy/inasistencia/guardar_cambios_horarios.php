<?php
$conexion = new mysqli("localhost", "fgoicoechea", "sobral2011", "sid");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Validación mínima
if (!isset($_POST['plaza_id'])) {
    die("Error: plaza no especificada.");
}

$plazaId = intval($_POST['plaza_id']);
$dias = isset($_POST['dia']) ? $_POST['dia'] : array();
$inicios = isset($_POST['hora_inicio']) ? $_POST['hora_inicio'] : array();
$fines = isset($_POST['hora_fin']) ? $_POST['hora_fin'] : array();
$aEliminar = isset($_POST['eliminar']) ? $_POST['eliminar'] : array();

$actualizados = 0;
$eliminados = 0;

// Eliminación
if (!empty($aEliminar)) {
    foreach ($aEliminar as $id) {
        $id = intval($id);
        $sqlDelete = "DELETE FROM horarios_plaza WHERE id = $id AND plaza_id = $plazaId";
        if ($conexion->query($sqlDelete)) {
            $eliminados++;
        }
    }
}

// Actualización
foreach ($dias as $id => $dia) {
    $id = intval($id);

    // Si fue eliminado, no actualizar
    if (!empty($aEliminar) && in_array($id, $aEliminar)) {
        continue;
    }

    $dia = $conexion->real_escape_string($dia);
    $hora_inicio = isset($inicios[$id]) ? $conexion->real_escape_string($inicios[$id]) : null;
    $hora_fin = isset($fines[$id]) ? $conexion->real_escape_string($fines[$id]) : null;

    if ($hora_inicio && $hora_fin) {
        $sqlUpdate = "
            UPDATE horarios_plaza
            SET dia = '$dia', hora_inicio = '$hora_inicio', hora_fin = '$hora_fin'
            WHERE id = $id AND plaza_id = $plazaId
        ";
        if ($conexion->query($sqlUpdate)) {
            $actualizados++;
        }
    }
}

$conexion->close();

// Redirigir de nuevo al editor
header("Location: editar_horarios.php?plaza_id=$plazaId&ok=1&actualizados=$actualizados&eliminados=$eliminados");
exit;
?>
