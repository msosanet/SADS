<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$iasisAuth = isset($_SESSION['estado']) && (int) $_SESSION['estado'] === 1;
$iasisLegacyModuleDir = IASIS_ROOT . DIRECTORY_SEPARATOR . 'legacy' . DIRECTORY_SEPARATOR . 'inasistencia';

$iasisDescripcion = isset($_GET['descripcion']) ? trim((string) $_GET['descripcion']) : '';
$iasisNotas = array();

if (!$iasisAuth) {
    return;
}

require_once $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'conexion.php';
if (function_exists('conectar')) {
    conectar();
}

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
$pass = isset($_SESSION['contrasenia']) ? $_SESSION['contrasenia'] : '';
mysql_query("SELECT * FROM usuarios WHERE usuario='$usuario' and pass='$pass'");

$palabras = array_filter(explode(' ', $iasisDescripcion));
$condiciones = array();
foreach ($palabras as $palabra) {
    $p = mysql_real_escape_string($palabra);
    $condiciones[] = "descripcion LIKE '%$p%' or codigo LIKE '%$p%' or gen LIKE '%$p%'";
}
if (count($condiciones) === 0) {
    $condiciones[] = "1=1";
}

$sql = "SELECT * FROM notasnuevo WHERE " . implode(' AND ', $condiciones) . " ORDER BY anio DESC,codigo DESC";
$r = mysql_query($sql);
if ($r) {
    while ($fila = mysql_fetch_array($r)) {
        $iasisNotas[] = $fila;
    }
}
