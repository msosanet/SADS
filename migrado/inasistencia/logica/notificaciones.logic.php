<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$iasisAuth = isset($_SESSION['estado']) && (int) $_SESSION['estado'] === 1;
$iasisLegacyModuleDir = IASIS_ROOT . DIRECTORY_SEPARATOR . 'legacy' . DIRECTORY_SEPARATOR . 'inasistencia';

$iasisUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
$iasisAnio = date('Y');
$iasisAsunto = isset($_POST['asunto']) ? trim((string) $_POST['asunto']) : '';
$iasisErrores = array();
$iasisGuardado = false;
$iasisNotificacionNumero = '';
$iasisNotificacionAnio = '';

if (!$iasisAuth) {
    return;
}

require_once $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'conexion.php';
if (function_exists('conectar')) {
    conectar();
}

$usuarioQ = mysql_query("SELECT * FROM usuarios WHERE usuario='$iasisUsuario'");
$filaUsuario = $usuarioQ ? mysql_fetch_array($usuarioQ) : array();

if (isset($_POST['submitx'])) {
    if ($iasisAsunto === '') {
        $iasisErrores[] = 'Debe completar la descripcion de la notificacion.';
    }

    if (count($iasisErrores) === 0) {
        $asuntoInsert = ucfirst($iasisAsunto);
        $agente = isset($filaUsuario['nombre']) ? $filaUsuario['nombre'] : $iasisUsuario;

        $sqlCuenta = "SELECT COUNT(*) as ultimo, anio FROM notificaciones WHERE anio=YEAR(NOW()) GROUP BY anio";
        $resultUltimo = mysql_query($sqlCuenta);
        $filaUltimo = $resultUltimo ? mysql_fetch_array($resultUltimo) : array('ultimo' => 0);
        $ultimo = (isset($filaUltimo['ultimo']) ? (int) $filaUltimo['ultimo'] : 0) + 1;

        $sqlInsert = "INSERT INTO notificaciones VALUES ('','$ultimo','$asuntoInsert','$agente','$iasisAnio','')";
        if (mysql_query($sqlInsert)) {
            $iasisGuardado = true;
            $iasisNotificacionNumero = (string) $ultimo;
            $iasisNotificacionAnio = (string) $iasisAnio;
            $iasisAsunto = $asuntoInsert;
        } else {
            $iasisErrores[] = 'No se pudo guardar en la base de datos.';
        }
    }
}
