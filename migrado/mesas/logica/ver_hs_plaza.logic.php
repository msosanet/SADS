<?php
$conexion = new mysqli("localhost", "fgoicoechea", "sobral2011", "sid");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener las plazas activas
$sqlPlazas = "SELECT plaza, nombre FROM materia_cargo WHERE activo = 1 ORDER BY plaza ASC";
$resultadoPlazas = $conexion->query($sqlPlazas);

$plazaSeleccionada = isset($_GET['plaza_id']) ? $_GET['plaza_id'] : null;
$horarios = [];
$nombrePlaza = "";
$nombreDocente = "";
$dniDocente = "";

if ($plazaSeleccionada) {
    // Obtener nombre de la plaza (materia/cargo)
    $sqlNombre = "SELECT nombre FROM materia_cargo WHERE plaza = '$plazaSeleccionada'";
    $resNombre = $conexion->query($sqlNombre);
    $nombrePlaza = ($resNombre && $resNombre->num_rows > 0) ? $resNombre->fetch_assoc()['nombre'] : "";

    // PASO 1: Obtener ID de la materia
    $sqlIdMateria = "SELECT id FROM materia_cargo WHERE plaza = '$plazaSeleccionada' LIMIT 1";
    $resIdMateria = $conexion->query($sqlIdMateria);

    if ($resIdMateria && $resIdMateria->num_rows > 0) {
        $idMateria = $resIdMateria->fetch_assoc()['id'];

        // PASO 2: Buscar el alta activa más reciente
        $sqlAltaBaja = "SELECT docente FROM alta_baja WHERE materia = '$idMateria' AND activa = 1 ORDER BY id DESC LIMIT 1";
        $resAltaBaja = $conexion->query($sqlAltaBaja);

        if ($resAltaBaja && $resAltaBaja->num_rows > 0) {
            $dniDocente = $resAltaBaja->fetch_assoc()['docente'];

            // PASO 3: Buscar datos del docente
            $sqlDocente = "SELECT nombre, apellido FROM docentes WHERE dni = '$dniDocente' LIMIT 1";
            $resDocente = $conexion->query($sqlDocente);

            if ($resDocente && $resDocente->num_rows > 0) {
                $fila = $resDocente->fetch_assoc();
                $nombreDocente = $fila['nombre'] . " " . $fila['apellido'];
            }
        }
    }

    // Obtener horarios
    $sqlHorarios = "SELECT dia, hora_inicio, hora_fin FROM horarios_plaza WHERE plaza_id = '$plazaSeleccionada' ORDER BY FIELD(dia, 'Lunes','Martes','Miércoles','Jueves','Viernes'), hora_inicio";
    $resultadoHorarios = $conexion->query($sqlHorarios);

    while ($fila = $resultadoHorarios->fetch_assoc()) {
        $horarios[$fila['dia']][] = [
            'inicio' => $fila['hora_inicio'],
            'fin' => $fila['hora_fin']
        ];
    }
}
?>

<?php include('dashboard.php'); ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Consulta de Horarios por Plaza</h2>

    <form method="GET" class="text-center mb-4">
        <label for="plaza">Seleccione una Plaza:</label>
        <select name="plaza_id" id="plaza" onchange="this.form.submit()" class="form-select w-50 mx-auto">
            <option value="">-- Elija --</option>
            <?php while ($fila = $resultadoPlazas->fetch_assoc()) { ?>
                <option value="<?= $fila['plaza'] ?>" <?= ($fila['plaza'] == $plazaSeleccionada) ? "selected" : "" ?>>
                    <?= $fila['plaza'] . " - " . $fila['nombre'] ?>
                </option>
            <?php } ?>
        </select>
    </form>

    <?php if ($plazaSeleccionada): ?>
        <div class="bg-white p-4 rounded shadow">
            <h4 class="text-center mb-3">Horarios de la Plaza <?= $plazaSeleccionada ?> - <?= $nombrePlaza ?></h4>

            <?php if (!empty($nombreDocente)): ?>
                <h5 class="text-center text-muted mb-3">
                    Docente actual: <?= $nombreDocente ?> (DNI: <?= $dniDocente ?>)
                </h5>
            <?php endif; ?>

            <div class="text-center mb-3">
                <button class="btn btn-primary" onclick="exportToPDF()">Exportar a PDF</button>
                <button class="btn btn-success" onclick="exportToExcel()">Exportar a Excel</button>
                <button class="btn btn-secondary" onclick="window.print()">Imprimir</button>
            </div>

            <?php if (!empty($horarios)): ?>
                <div class="table-responsive" id="tablaHorarios">
                    <?php if (!empty($nombreDocente)): ?>
                        <p class="text-start mb-2 fw-bold">
                            Docente actual: <?= $nombreDocente ?> (DNI: <?= $dniDocente ?>)
                        </p>
                    <?php endif; ?>

                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <?php foreach (["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"] as $dia): ?>
                                    <th><?= $dia ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $maxFilas = 0;
                            foreach ($horarios as $dia => $turnos) {
                                if (count($turnos) > $maxFilas) {
                                    $maxFilas = count($turnos);
                                }
                            }
                            for ($i = 0; $i < $maxFilas; $i++): ?>
                                <tr>
                                    <?php foreach (["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"] as $dia): ?>
                                        <td>
                                            <?php if (isset($horarios[$dia][$i])): ?>
                                                <?= $horarios[$dia][$i]['inicio'] ?> - <?= $horarios[$dia][$i]['fin'] ?>
                                            <?php else: ?>
                                                &nbsp;
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-center text-muted">No hay horarios cargados para esta plaza.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    function exportToExcel() {
        let table = document.getElementById("tablaHorarios").outerHTML;
        let dataUri = 'data:application/vnd.ms-excel,' + encodeURIComponent(table);
        let link = document.createElement("a");
        link.href = dataUri;
        link.download = "horarios_plaza.xls";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function exportToPDF() {
        const printContents = document.getElementById("tablaHorarios").outerHTML;
        const ventana = window.open('', '', 'height=600,width=800');
        ventana.document.write('
