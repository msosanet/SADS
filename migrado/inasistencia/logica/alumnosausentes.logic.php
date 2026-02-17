<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$iasisAuth = isset($_SESSION['estado']) && (int) $_SESSION['estado'] === 1;
$iasisLegacyModuleDir = IASIS_ROOT . DIRECTORY_SEPARATOR . 'legacy' . DIRECTORY_SEPARATOR . 'inasistencia';

$iasisFecha = date('Y-m-d');
$iasisAusentes = array();

if (!$iasisAuth) {
    return;
}

require_once $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'conexion.php';
if (function_exists('conectar')) {
    conectar();
}

// Se conserva la conexion legacy sin cambios funcionales.
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("sid") or die(mysql_error());

function iasis_ausentes_fetch_por_fecha($fecha)
{
    $rows = array();
    $sql = "SELECT ac.dni, ac.alumno, ac.curso, ac.division, af.tipo
            FROM alumnos ac, alumnos_faltas af
            WHERE ac.dni=af.dni AND af.fecha='$fecha'
            ORDER BY ac.curso, ac.division, ac.alumno";

    $result = mysql_query($sql);
    if (!$result) {
        return $rows;
    }

    while ($row = mysql_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

$iasisAusentes = iasis_ausentes_fetch_por_fecha($iasisFecha);
