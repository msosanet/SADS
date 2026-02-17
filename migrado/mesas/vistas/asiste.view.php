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

