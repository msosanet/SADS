<?php
$conexion = new mysqli("localhost", "fgoicoechea", "sobral2011", "sid");
$conexionPreceptores = new mysqli("localhost", "fgoicoechea", "sobral2011", "base_sobral");

if ($conexion->connect_error) {
    die("Conexión fallida (SID): " . $conexion->connect_error);
}
if ($conexionPreceptores->connect_error) {
    die("Conexión fallida (Preceptores): " . $conexionPreceptores->connect_error);
}

// Compatibilidad con PHP viejo
if (isset($_GET['fecha']) && $_GET['fecha'] != '') {
    $fechaSeleccionada = $_GET['fecha'];
    $diaNumero = date('N', strtotime($fechaSeleccionada));
    $nombreDias = array(1 => "Lunes", 2 => "Martes", 3 => "Miércoles", 4 => "Jueves", 5 => "Viernes");
    $nombreDiaActual = ($diaNumero >= 1 && $diaNumero <= 5) ? $nombreDias[$diaNumero] : '';
} else {
    $fechaSeleccionada = '';
    $diaNumero = null;
    $nombreDiaActual = '';
}

$datos = [];

if ($fechaSeleccionada && $diaNumero >= 1 && $diaNumero <= 5) {
    $sqlPlazas = "SELECT id, plaza, nombre FROM materia_cargo WHERE activo = 1 ORDER BY plaza ASC";
    $resPlazas = $conexion->query($sqlPlazas);

    while ($plaza = $resPlazas->fetch_assoc()) {
        $idMateria = $plaza['id'];

        $sqlDocente = "SELECT docente FROM alta_baja WHERE materia = '{$idMateria}' AND activa = 1 ORDER BY id DESC LIMIT 1";
        $resDocente = $conexion->query($sqlDocente);

        if ($resDocente && $resDocente->num_rows > 0) {
            $dniDocente = $resDocente->fetch_assoc()['docente'];

            $sqlInasistencia = "SELECT motivo FROM ausentes WHERE docente = '{$dniDocente}' AND fecha_desde = '{$fechaSeleccionada}' LIMIT 1";
            $resInasistencia = $conexion->query($sqlInasistencia);
            $inasistencia = '-';

            if ($resInasistencia && $resInasistencia->num_rows > 0) {
                $motivoCodigo = $resInasistencia->fetch_assoc()['motivo'];
                $sqlMotivo = "SELECT descripcion FROM motivos WHERE codigo = '{$motivoCodigo}' LIMIT 1";
                $resMotivo = $conexion->query($sqlMotivo);
                $inasistencia = ($resMotivo && $resMotivo->num_rows > 0) ? $resMotivo->fetch_assoc()['descripcion'] : 'Motivo desconocido';
            }

            $sqlNombre = "SELECT nombre, apellido FROM docentes WHERE dni = '{$dniDocente}' LIMIT 1";
            $resNombre = $conexion->query($sqlNombre);
            $nombreDocente = ($resNombre && $resNombre->num_rows > 0) ? $resNombre->fetch_assoc() : array("nombre" => "", "apellido" => "");

            $sqlHorarios = "SELECT MIN(hora_inicio) as entrada, MAX(hora_fin) as salida FROM horarios_plaza WHERE plaza_id = '{$plaza['plaza']}' AND dia = '{$nombreDiaActual}'";
            $resHorarios = $conexion->query($sqlHorarios);

            if ($resHorarios && $resHorarios->num_rows > 0) {
                $rango = $resHorarios->fetch_assoc();
                $horaInicio = $rango['entrada'];
                $horaFin = $rango['salida'];

                if ($horaInicio && $horaFin) {
                    $sqlAsistencia = "SELECT MIN(horario) as primera, MAX(horario) as ultima FROM diario WHERE dni = '{$dniDocente}' AND fecha = '{$fechaSeleccionada}' AND dia = '{$diaNumero}'";
                    $resAsistencia = $conexion->query($sqlAsistencia);

                    $detalle = "Ausente";
                    $vino = false;

                    if ($resAsistencia && $resAsistencia->num_rows > 0) {
                        $filaAsistencia = $resAsistencia->fetch_assoc();
                        if (!empty($filaAsistencia['primera']) && !empty($filaAsistencia['ultima'])) {
                            $vino = true;
                            $detalle = "Entrada: {$filaAsistencia['primera']} | Salida: {$filaAsistencia['ultima']}";
                        }
                    }

                    $sqlParte = "SELECT hora, estado, observaciones, anotaciones, materia 
                                 FROM partepreceptores 
                                 WHERE fecha = '{$fechaSeleccionada}' 
                                 AND docente = '{$dniDocente}'";
                    $resParte = $conexionPreceptores->query($sqlParte);
                    $detalleParte = array();

                    if ($resParte && $resParte->num_rows > 0) {
                        while ($filaParte = $resParte->fetch_assoc()) {
                            $idMateriaParte = $filaParte['materia'];

                            $sqlMateria = "SELECT descripcion FROM materias WHERE idmateria = '{$idMateriaParte}' LIMIT 1";
                            $resMateria = $conexionPreceptores->query($sqlMateria);
                            $materiaNombre = ($resMateria && $resMateria->num_rows > 0) ? $resMateria->fetch_assoc()['descripcion'] : "Materia desconocida";

                            $linea = "Hora {$filaParte['hora']} ({$materiaNombre}): Estado {$filaParte['estado']}";
                            if (!empty($filaParte['observaciones'])) {
                                $linea .= " | Obs: {$filaParte['observaciones']}";
                            }
                            if (!empty($filaParte['anotaciones'])) {
                                $linea .= " | Anot: {$filaParte['anotaciones']}";
                            }
                            $detalleParte[] = $linea;
                        }
                    }

                    $datos[] = array(
                        'plaza' => $plaza['plaza'],
                        'materia' => $plaza['nombre'],
                        'docente' => $nombreDocente['apellido'] . ' ' . $nombreDocente['nombre'],
                        'dni' => $dniDocente,
                        'horario' => $horaInicio . ' - ' . $horaFin,
                        'vino' => $vino,
                        'detalle' => $detalle,
                        'detalle_preceptor' => $detalleParte,
                        'inasistencia' => $inasistencia
                    );
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Control de Asistencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        td, th {
            vertical-align: middle !important;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4 text-center">Control de Asistencia Docente</h2>

    <form method="GET" class="mb-4 text-center">
        <label for="fecha">Seleccionar fecha:</label>
        <input type="date" name="fecha" id="fecha" class="form-control d-inline-block w-auto" value="<?php echo $fechaSeleccionada; ?>" onchange="this.form.submit()">
    </form>

    <?php if ($fechaSeleccionada && !empty($datos)): ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">Plaza</th>
                        <th class="text-center">Materia</th>
                        <th class="text-center">Docente</th>
                        <th class="text-center">DNI</th>
                        <th class="text-center">Horario</th>
                        <th class="text-center">Asistencia</th>
                        <th class="text-center">Inasistencia</th>
                        <th class="text-center">Parte Preceptor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $index => $fila): ?>
                        <?php
                            if ($fila['inasistencia'] !== '-') {
                                $claseFila = 'table-warning';
                            } elseif (!$fila['vino'] && empty($fila['detalle_preceptor'])) {
                                $claseFila = 'table-danger';
                            } else {
                                $claseFila = 'table-success';
                            }
                        ?>
                        <tr class="<?php echo $claseFila; ?>">
                            <td class="text-center"><?php echo $fila['plaza']; ?></td>
                            <td class="text-center"><?php echo $fila['materia']; ?></td>
                            <td class="text-center"><?php echo $fila['docente']; ?></td>
                            <td class="text-center"><?php echo $fila['dni']; ?></td>
                            <td class="text-center"><?php echo $fila['horario']; ?></td>
                            <td class="text-center"><?php echo $fila['detalle']; ?></td>
                            <td class="text-center"><?php echo $fila['inasistencia']; ?></td>
                            <td>
                                <?php if (!empty($fila['detalle_preceptor'])): ?>
                                    <div class="accordion" id="accordion<?php echo $index; ?>">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse<?php echo $index; ?>">
                                                    Ver detalle
                                                </button>
                                            </h2>
                                            <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#accordion<?php echo $index; ?>">
                                                <div class="accordion-body text-break">
                                                    <?php echo implode("<br>", $fila['detalle_preceptor']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">Sin parte</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php elseif ($fechaSeleccionada): ?>
        <p class="text-center text-muted">No se encontraron registros para la fecha seleccionada.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php 
$conexion->close(); 
$conexionPreceptores->close();
?>
