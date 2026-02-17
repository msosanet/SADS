<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$iasisAuth = isset($_SESSION['estado']) && (int) $_SESSION['estado'] === 1;
$iasisLegacyModuleDir = IASIS_ROOT . DIRECTORY_SEPARATOR . 'legacy' . DIRECTORY_SEPARATOR . 'inasistencia';

$iasisDescripcion = isset($_GET['descripcion']) ? trim((string) $_GET['descripcion']) : '';
$iasisNotificaciones = array();

if (!$iasisAuth) {
    return;
}

require_once $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'conexion.php';
if (function_exists('conectar')) {
    conectar();
}

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
$pass = isset($_SESSION['contrasenia']) ? $_SESSION['contrasenia'] : '';
mysql_query("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");

$q = "SELECT * FROM notificaciones WHERE descripcion like '%$iasisDescripcion%' or codigo like '%$iasisDescripcion%' order by anio DESC,codigo desc";
$r = mysql_query($q);
if ($r) {
    while ($fila = mysql_fetch_array($r)) {
        $iasisNotificaciones[] = $fila;
    }
}
