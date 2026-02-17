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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Horarios de Plaza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>Editar / Eliminar Horarios</h2>

    <form method="get" class="mb-4">
        <label for="plaza_id">Seleccioná una Plaza:</label>
        <select name="plaza_id" id="plaza_id" class="form-select" onchange="this.form.submit()">
            <option value="">-- Elegir --</option>
            <?php while ($p = $resPlazas->fetch_assoc()) { ?>
                <option value="<?= $p['plaza'] ?>" <?= ($p['plaza'] == $plazaSeleccionada) ? "selected" : "" ?>>
                    <?= $p['plaza'] . " - " . $p['nombre'] ?>
                </option>
            <?php } ?>
        </select>
    </form>

<?php if ($plazaSeleccionada && count($horarios) > 0): ?>
    <form method="post" action="guardar_cambios_horarios.php">
        <input type="hidden" name="plaza_id" value="<?= $plazaSeleccionada ?>">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Día</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($horarios as $h): ?>
                    <tr>
                        <td>
                            <select name="dia[<?= $h['id'] ?>]" class="form-select" required>
                                <?php foreach (["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"] as $dia): ?>
                                    <option value="<?= $dia ?>" <?= ($dia == $h['dia']) ? "selected" : "" ?>><?= $dia ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="time" name="hora_inicio[<?= $h['id'] ?>]" class="form-control" value="<?= $h['hora_inicio'] ?>" required></td>
                        <td><input type="time" name="hora_fin[<?= $h['id'] ?>]" class="form-control" value="<?= $h['hora_fin'] ?>" required></td>
                        <td class="text-center"><input type="checkbox" name="eliminar[]" value="<?= $h['id'] ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
<?php elseif ($plazaSeleccionada): ?>
    <p class="alert alert-warning">No hay horarios cargados para esta plaza.</p>
<?php endif; ?>

</body>
</html>

<?php $conexion->close(); ?>
