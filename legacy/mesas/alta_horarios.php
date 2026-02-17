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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta/Edición de Horarios de Plaza</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 20px; }
        form { width: 60%; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        label, input, select { display: block; width: 100%; margin-bottom: 10px; }
        button, .btn-mas { background-color: #28a745; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover, .btn-mas:hover { background-color: #218838; }
        .dias-container { display: block; margin-bottom: 20px; background: #eef; padding: 10px; border-radius: 5px; }
        .sub-horario { margin-bottom: 15px; border-bottom: 1px dashed #ccc; padding-bottom: 10px; }
    </style>

    <script>
    const dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];

    function ajustarHoraFin(dia, index) {
        const tipo = document.getElementById("tipo").value;
        const horaInicioInput = document.getElementById(`hora_inicio_${dia}_${index}`);
        const horaFinInput = document.getElementById(`hora_fin_${dia}_${index}`);

        if (!horaInicioInput || !horaFinInput) return;

        const horaInicio = horaInicioInput.value;

        if (tipo === "hs_catedras" && horaInicio) {
            const inicio = new Date("1970-01-01T" + horaInicio + ":00Z");
            inicio.setMinutes(inicio.getMinutes() + 40);
            const horas = inicio.getUTCHours().toString().padStart(2, '0');
            const minutos = inicio.getUTCMinutes().toString().padStart(2, '0');
            horaFinInput.value = horas + ":" + minutos;
            horaFinInput.readOnly = true;
        } else {
            horaFinInput.readOnly = false;
        }
    }

    function agregarHorario(dia) {
        const tipo = document.getElementById("tipo").value;
        if (tipo !== "hs_catedras") return;

        const contenedor = document.getElementById(`contenedor_${dia}`);
        const index = contenedor.children.length;

        const div = document.createElement('div');
        div.className = 'sub-horario';
        div.innerHTML = `
            <label>Hora de Inicio:</label>
            <input type='time' id='hora_inicio_${dia}_${index}' name='hora_inicio[${dia}][]' onchange='ajustarHoraFin("${dia}", ${index})'>
            <label>Hora de Fin:</label>
            <input type='time' id='hora_fin_${dia}_${index}' name='hora_fin[${dia}][]'>
        `;
        contenedor.appendChild(div);
    }

    function mostrarOpciones() {
        const tipo = document.getElementById("tipo").value;
        dias.forEach(dia => {
            const contenedor = document.getElementById(`contenedor_${dia}`);
            const addBtn = document.getElementById(`btnAgregar_${dia}`);
            const subHorarios = contenedor.querySelectorAll('.sub-horario');
            subHorarios.forEach((el, index) => ajustarHoraFin(dia, index));
            if (addBtn) {
                addBtn.style.display = (tipo === "hs_catedras") ? "inline-block" : "none";
            }
        });
    }

    function cargarHorarios() {
        const plazaId = document.getElementById("plaza").value;
        if (plazaId) {
            window.location.href = "alta_horarios.php?plaza_id=" + plazaId;
        }
    }

    window.onload = function () {
        mostrarOpciones();
    };
    </script>
</head>
<body>

    <h2>Alta/Edición de Horarios para Plazas Activas</h2>
    <form action="guardar_horario.php" method="POST">
        <label for="plaza">Plaza:</label>
        <select id="plaza" name="plaza_id" required onchange="cargarHorarios()">
            <option value="">Seleccione una Plaza</option>
            <?php while ($fila = $resultadoPlazas->fetch_assoc()) { ?>
                <option value="<?= $fila['plaza'] ?>" <?= ($fila['plaza'] == $plazaSeleccionada) ? "selected" : "" ?>>
                    <?= $fila['plaza'] . " - " . $fila['nombre'] ?>
                </option>
            <?php } ?>
        </select>

        <label for="tipo">Tipo de Horario:</label>
        <select id="tipo" name="tipo" onchange="mostrarOpciones()" required>
            <option value="cargo">Cargo</option>
            <option value="hs_catedras">Hs Cátedras</option>
        </select>

        <h3>Ingrese los horarios para cada día (Lunes a Viernes)</h3>
        <?php
        $dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
        foreach ($dias as $dia) {
            echo "<div class='dias-container'>";
            echo "<h4>$dia <button type='button' class='btn-mas' id='btnAgregar_{$dia}' onclick=\"agregarHorario('$dia')\">+ Agregar</button></h4>";
            echo "<div id='contenedor_{$dia}'>";

            if (isset($horariosExistentes[$dia])) {
                foreach ($horariosExistentes[$dia] as $index => $horario) {
                    $horaInicio = $horario['hora_inicio'];
                    $horaFin = $horario['hora_fin'];
                    echo "<div class='sub-horario'>";
                    echo "<label>Hora de Inicio:</label>";
                    echo "<input type='time' id='hora_inicio_{$dia}_{$index}' name='hora_inicio[{$dia}][]' value='$horaInicio' onchange='ajustarHoraFin(\"$dia\", $index)'>";
                    echo "<label>Hora de Fin:</label>";
                    echo "<input type='time' id='hora_fin_{$dia}_{$index}' name='hora_fin[{$dia}][]' value='$horaFin'>";
                    echo "</div>";
                }
            } else {
                echo "<div class='sub-horario'>";
                echo "<label>Hora de Inicio:</label>";
                echo "<input type='time' id='hora_inicio_{$dia}_0' name='hora_inicio[{$dia}][]' onchange='ajustarHoraFin(\"$dia\", 0)'>";
                echo "<label>Hora de Fin:</label>";
                echo "<input type='time' id='hora_fin_{$dia}_0' name='hora_fin[{$dia}][]'>";
                echo "</div>";
            }

            echo "</div></div>";
        }
        ?>

        <button type="submit">Guardar Horario</button>
    </form>

</body>
</html>

<?php $conexion->close(); ?>
