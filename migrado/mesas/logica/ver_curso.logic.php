<?php
$conexion = new mysqli("localhost", "fgoicoechea", "sobral2011", "sid");

$curso = '1'; // o lo que estés testeando
$division = 'a';

$sql = "SELECT mc.plaza, mc.nombre AS materia, ab.docente
        FROM materia_cargo mc
        LEFT JOIN alta_baja ab ON ab.materia = mc.plaza
        WHERE mc.curso = '$curso' AND mc.division = '$division' AND mc.activo = 1
        ORDER BY mc.nombre";

$res = $conexion->query($sql);
echo \"<h3>Materias activas para $curso°$division</h3>\";
if ($res->num_rows == 0) {
    echo \"<p>No se encontró nada</p>\";
} else {
    while ($row = $res->fetch_assoc()) {
        echo \"<p><strong>{$row['materia']}</strong> - Docente: \" . ($row['docente'] != '' ? $row['docente'] : 'No asignado') . \"</p>\";
    }
}
$conexion->close();
?>

