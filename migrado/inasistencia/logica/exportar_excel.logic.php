<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=asistencia_" . date('Ymd_His') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

$conexion = new mysqli("localhost", "fgoicoechea", "sobral2011", "sid");
$conexionPreceptores = new mysqli("localhost", "fgoicoechea", "sobral2011", "base_sobral");

$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
if (!$fecha) {
    die("Fecha no especificada");
}

$diasSemana = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo'];
$diaNumero = date('N', strtotime($fecha));
$diaTexto = isset($diasSemana[$diaNumero]) ? $diasSemana[$diaNumero] : '';

$sqlHorarios = "SELECT plaza_id, hora_inicio, hora_fin FROM horarios_plaza WHERE CONVERT(dia USING utf8) = '$diaTexto' ORDER BY plaza_id, hora_inicio";
$resHorarios = $conexion->query($sqlHorarios);

$plazasHorarios = [];
while ($row = $resHorarios->fetch_assoc()) {
    $pid = $row['plaza_id'];
    $plazasHorarios[$pid][] = ['inicio' => $row['hora_inicio'], 'fin' => $row['hora_fin']];
}

echo "<table border='1'>";
echo "<tr><th>Plaza ID</th><th>Materia / Cargo</th><th>Docente</th><th>Horarios</th><th>Asistencia</th><th>Justificación</th><th>Parte Preceptor</th></tr>";

foreach ($plazasHorarios as $plazaId => $rangos) {
    // Construir horario manualmente
    $horarioStr = '';
    foreach ($rangos as $r) {
        $horarioStr .= $r['inicio'] . '-' . $r['fin'] . ' / ';
    }
    $horarioStr = rtrim($horarioStr, ' / ');

    // Materia
    $sqlMateria = "SELECT id, nombre FROM materia_cargo WHERE plaza = $plazaId";
    $resMateria = $conexion->query($sqlMateria);
    if (!$resMateria || $resMateria->num_rows == 0) continue;
    $materia = $resMateria->fetch_assoc();
    $materiaId = $materia['id'];
    $materiaNombre = utf8_encode($materia['nombre']);

    // Docente activo
    $sqlDocente = "SELECT docente FROM alta_baja WHERE materia = $materiaId AND activa = 1 ORDER BY id DESC LIMIT 1";
    $resDocente = $conexion->query($sqlDocente);
    if (!$resDocente || $resDocente->num_rows == 0) continue;
    $docenteDNI = $resDocente->fetch_assoc()['docente'];

    // Nombre docente
    $sqlNombre = "SELECT apellido, nombre FROM docentes WHERE dni = '$docenteDNI' LIMIT 1";
    $resNombre = $conexion->query($sqlNombre);
    $docenteNombre = ($resNombre && $resNombre->num_rows > 0)
        ? utf8_encode($resNombre->fetch_assoc()['apellido']) . ", " . utf8_encode($resNombre->fetch_assoc()['nombre'])
        : $docenteDNI;

    // Huella
    $sqlHuella = "SELECT horario, tipo FROM diario WHERE dni = '$docenteDNI' AND fecha = '$fecha' ORDER BY horario ASC";
    $resHuella = $conexion->query($sqlHuella);
    $marcas = [];
    if ($resHuella && $resHuella->num_rows > 0) {
        while ($h = $resHuella->fetch_assoc()) {
            $hora = substr($h['horario'], 0, 5);
            $tipo = ucfirst(strtolower($h['tipo']));
            $marcas[] = "$tipo: $hora";
        }
    }

    // Justificación
    $observacion = "—";
    $sqlInasistencia = "SELECT motivo FROM ausentes WHERE docente = '$docenteDNI' AND fecha_desde = '$fecha' LIMIT 1";
    $resInasistencia = $conexion->query($sqlInasistencia);
    if ($resInasistencia && $resInasistencia->num_rows > 0) {
        $motivoCodigo = $resInasistencia->fetch_assoc()['motivo'];
        $sqlMotivo = "SELECT descripcion FROM motivos WHERE codigo = '$motivoCodigo' LIMIT 1";
        $resMotivo = $conexion->query($sqlMotivo);
        $descMotivo = ($resMotivo && $resMotivo->num_rows > 0)
            ? utf8_encode($resMotivo->fetch_assoc()['descripcion'])
            : "motivo desconocido";
        $observacion = "Ausente justificado: $descMotivo";
    }

    // Parte del preceptor
    $sqlParte = "SELECT materia, observaciones, estado FROM partepreceptores WHERE docente = '$docenteDNI' AND fecha = '$fecha' ORDER BY registro DESC LIMIT 1";
    $resParte = $conexionPreceptores->query($sqlParte);
    if ($resParte && $resParte->num_rows > 0) {
        $parte = $resParte->fetch_assoc();
        $parteTexto = "Materia: " . utf8_encode($parte['materia']) . " - Estado: " . $parte['estado'] . " - Obs: " . utf8_encode($parte['observaciones']);
    } else {
        $parteTexto = "—";
    }

    echo "<tr>";
    echo "<td>$plazaId</td>";
    echo "<td>$materiaNombre</td>";
    echo "<td>$docenteNombre</td>";
    echo "<td>$horarioStr</td>";
    echo "<td>" . implode(" / ", $marcas) . "</td>";
    echo "<td>$observacion</td>";
    echo "<td>$parteTexto</td>";
    echo "</tr>";
}

echo "</table>";
?>

