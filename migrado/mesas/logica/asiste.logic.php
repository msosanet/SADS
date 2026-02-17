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


