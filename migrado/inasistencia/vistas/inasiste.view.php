<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Asistencia por Plaza Agrupada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container py-4">
    <h2>Asistencia Docente por Plaza (Huella + Justificación + Parte Preceptor)</h2>

    <form method="get" class="mb-4">
        <input type="hidden" name="pagina" value="1">
        <label for="fecha">Seleccioná una fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fechaSeleccionada); ?>" class="form-control" required>
        <button type="submit" class="btn btn-primary mt-2">Consultar</button>
    </form>

<?php
if (!$fechaSeleccionada) {
    echo "<p class='text-muted'>Seleccione una fecha para consultar asistencia.</p>";
    exit;
}

$diasSemana = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo'];
$diaNumero = date('N', strtotime($fechaSeleccionada));
$diaTexto = isset($diasSemana[$diaNumero]) ? $diasSemana[$diaNumero] : '';

$sqlHorarios = "
SELECT plaza_id, hora_inicio, hora_fin
FROM horarios_plaza
WHERE CONVERT(dia USING utf8) = '$diaTexto'
ORDER BY plaza_id, hora_inicio
";
$resHorarios = $conexion->query($sqlHorarios);
if (!$resHorarios) {
    die("<p class='text-danger'>Error en consulta de horarios: " . $conexion->error . "</p>");
}

$plazasHorarios = array();
while ($row = $resHorarios->fetch_assoc()) {
    $pid = $row['plaza_id'];
    if (!isset($plazasHorarios[$pid])) {
        $plazasHorarios[$pid] = array();
    }
    $plazasHorarios[$pid][] = array(
        'inicio' => $row['hora_inicio'],
        'fin' => $row['hora_fin']
    );
}

$totalPlazas = count($plazasHorarios);
$plazasPaginadas = array_slice($plazasHorarios, $offset, $porPagina, true);

echo "<table class='table table-bordered table-hover'>";
echo "<thead class='table-light'><tr>
<th>Plaza ID</th><th>Materia / Cargo</th><th>Docente</th>
<th>Horarios</th><th>Asistencia</th><th>Justificación</th><th>Parte Preceptor</th></tr></thead><tbody>";

$contador = 0;

foreach ($plazasPaginadas as $plazaId => $rangos) {
    $contador++;
    $collapseId = "partePreceptor" . $contador;

    $horariosUnidos = array();
    foreach ($rangos as $r) {
        $horariosUnidos[] = $r['inicio'] . "-" . $r['fin'];
    }
    $horarioStr = implode(" / ", $horariosUnidos);

    $sqlMateria = "SELECT id, nombre FROM materia_cargo WHERE plaza = $plazaId";
    $resMateria = $conexion->query($sqlMateria);
    if (!$resMateria || $resMateria->num_rows == 0) {
        echo "<tr><td>$plazaId</td><td colspan='6' class='text-danger'>Sin materia asignada</td></tr>";
        continue;
    }
    $materiaData = $resMateria->fetch_assoc();
    $materiaId = $materiaData['id'];
    $materiaNombre = utf8_encode($materiaData['nombre']);

    $sqlDocente = "SELECT docente FROM alta_baja WHERE materia = $materiaId AND activa = 1 ORDER BY id DESC LIMIT 1";
    $resDocente = $conexion->query($sqlDocente);
    if (!$resDocente || $resDocente->num_rows == 0) {
        echo "<tr><td>$plazaId</td><td>$materiaNombre</td><td colspan='5' class='text-danger'>Sin docente activo</td></tr>";
        continue;
    }
    $docenteDNI = $resDocente->fetch_assoc()['docente'];

    $sqlNombre = "SELECT apellido, nombre FROM docentes WHERE dni = '$docenteDNI' LIMIT 1";
    $resNombre = $conexion->query($sqlNombre);
    if ($resNombre && $resNombre->num_rows > 0) {
        $docData = $resNombre->fetch_assoc();
        $docenteNombre = utf8_encode($docData['apellido']) . ", " . utf8_encode($docData['nombre']);
    } else {
        $docenteNombre = $docenteDNI;
    }

    // ASISTENCIA (Huella)
    $sqlHuella = "
    SELECT horario, tipo FROM diario
    WHERE dni = '$docenteDNI'
    AND fecha = '$fechaSeleccionada'
    ORDER BY horario ASC
    ";
    $resHuella = $conexion->query($sqlHuella);
    $marcas = array();

    if ($resHuella && $resHuella->num_rows > 0) {
        while ($h = $resHuella->fetch_assoc()) {
            $hora = substr($h['horario'], 0, 5);
            $tipo = ucfirst(strtolower($h['tipo']));
            $marcas[] = "$tipo: $hora";
        }
    }

    // JUSTIFICACIÓN
    $observacion = "—";
    $sqlInasistencia = "SELECT motivo FROM ausentes WHERE docente = '$docenteDNI' AND fecha_desde = '$fechaSeleccionada' LIMIT 1";
    $resInasistencia = $conexion->query($sqlInasistencia);
    if ($resInasistencia && $resInasistencia->num_rows > 0) {
        $motivoCodigo = $resInasistencia->fetch_assoc()['motivo'];
        $sqlMotivo = "SELECT descripcion FROM motivos WHERE codigo = '$motivoCodigo' LIMIT 1";
        $resMotivo = $conexion->query($sqlMotivo);
        if ($resMotivo && $resMotivo->num_rows > 0) {
            $descMotivo = utf8_encode($resMotivo->fetch_assoc()['descripcion']);
            $observacion = "Ausente justificado: $descMotivo";
        } else {
            $observacion = "Ausente justificado (motivo desconocido)";
        }
    }

    // PARTE DEL PRECEPTOR
    $sqlParte = "
    SELECT materia, observaciones, estado FROM partepreceptores
    WHERE docente = '$docenteDNI'
    AND fecha = '$fechaSeleccionada'
    ORDER BY registro DESC
    LIMIT 1
    ";
    $resParte = $conexionPreceptores->query($sqlParte);
    if ($resParte && $resParte->num_rows > 0) {
        $parte = $resParte->fetch_assoc();
        $materiaParte = utf8_encode($parte['materia']);
        $obsParte = utf8_encode($parte['observaciones']);
        $estadoParte = $parte['estado'];

        $parteHTML = "
            <button class='btn btn-sm btn-outline-secondary' type='button' data-bs-toggle='collapse' data-bs-target='#$collapseId'>
                Ver parte
            </button>
            <div class='collapse mt-2' id='$collapseId'>
                <div class='card card-body p-2'>
                    <strong>Materia:</strong> $materiaParte<br>
                    <strong>Observaciones:</strong> $obsParte<br>
                    <strong>Estado:</strong> $estadoParte
                </div>
            </div>
        ";
    } else {
        $parteHTML = "—";
    }

    $color = (empty($marcas) && $observacion == "—" && $parteHTML == "—") ? '#ffd6d6' : 'white';

    echo "<tr style='background-color:$color'>";
    echo "<td>$plazaId</td>";
    echo "<td>$materiaNombre</td>";
    echo "<td>$docenteNombre</td>";
    echo "<td>$horarioStr</td>";
    echo "<td>" . (!empty($marcas) ? implode(" / ", $marcas) : "") . "</td>";
    echo "<td>$observacion</td>";
    echo "<td>$parteHTML</td>";
    echo "</tr>";
}

echo "</tbody></table>";

$totalPaginas = ceil($totalPlazas / $porPagina);

echo "<div class='d-flex justify-content-between align-items-center mt-4'>";

// Botón Exportar a Excel
echo "<form method='get' action='exportar_excel.php' class='mb-0'>";
echo "<input type='hidden' name='fecha' value='" . htmlspecialchars($fechaSeleccionada) . "'>";
echo "<button type='submit' class='btn btn-success'>??? Exportar a Excel</button>";
echo "</form>";

// Paginación
echo "<nav><ul class='pagination mb-0'>";

if ($pagina > 1) {
    $prev = $pagina - 1;
    echo "<li class='page-item'><a class='page-link' href='?fecha=$fechaSeleccionada&pagina=$prev'>« Anterior</a></li>";
}
echo "<li class='page-item disabled'><span class='page-link'>Página $pagina de $totalPaginas</span></li>";
if ($pagina < $totalPaginas) {
    $next = $pagina + 1;
    echo "<li class='page-item'><a class='page-link' href='?fecha=$fechaSeleccionada&pagina=$next'>Siguiente »</a></li>";
}

echo "</ul></nav>";
echo "</div>";
?>
</body>
</html>

