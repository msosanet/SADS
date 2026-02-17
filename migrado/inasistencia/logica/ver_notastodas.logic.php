<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$iasisAuth = isset($_SESSION['estado']) && (int) $_SESSION['estado'] === 1;
$iasisLegacyModuleDir = IASIS_ROOT . DIRECTORY_SEPARATOR . 'legacy' . DIRECTORY_SEPARATOR . 'inasistencia';

$iasisDescripcion = isset($_GET['descripcion']) ? trim((string) $_GET['descripcion']) : '';
$iasisBuscar = isset($_GET['muestra2']);
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

if ($iasisBuscar) {
    $desc = mysql_real_escape_string($iasisDescripcion);
    $sql = "SELECT * FROM notasnuevo WHERE descripcion like '%$desc%' or codigo like '%$desc%' ORDER BY anio DESC,codigo DESC";
    $r = mysql_query($sql);
    if ($r) {
        while ($fila = mysql_fetch_array($r)) {
            $iasisNotas[] = $fila;
        }
    }
}
