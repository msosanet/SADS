<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "fgoicoechea", "sobral2011", "sid");

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener la fecha seleccionada
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');

// Obtener el día de la semana en formato numérico (1 = Lunes, ..., 7 = Domingo)
$diaSemana = date('N', strtotime($fecha));

echo "<h2>Asistencia del día $fecha</h2>";

// Consulta de registros de asistencia
$sql = "SELECT dni, horario, tipo, lic FROM diario WHERE fecha = '$fecha' AND dia = '$diaSemana'";
$resultado = $conexion->query($sql);

// Mostrar la tabla con los datos
if ($resultado->num_rows > 0) {
    echo "<table>
            <tr>
                <th>DNI</th>
                <th>Horario</th>
                <th>Tipo</th>
                <th>Licencia</th>
                <th>Estado</th>
            </tr>";

    while ($fila = $resultado->fetch_assoc()) {
        $estado = ($fila['lic'] === NULL || $fila['lic'] === '') ? "? Asistió" : "?? Licencia";
        $color = ($fila['lic'] === NULL || $fila['lic'] === '') ? "asistio" : "ausente";

        echo "<tr>
                <td>{$fila['dni']}</td>
                <td>{$fila['horario']}</td>
                <td>{$fila['tipo']}</td>
                <td>{$fila['lic']}</td>
                <td class='$color'>$estado</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay registros para esta fecha.</p>";
}

// Cerrar conexión
$conexion->close();
?>

