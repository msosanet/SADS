<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$iasisAuth = isset($_SESSION['estado']) && (int) $_SESSION['estado'] === 1;
$iasisLegacyModuleDir = IASIS_ROOT . DIRECTORY_SEPARATOR . 'legacy' . DIRECTORY_SEPARATOR . 'inasistencia';

$dni = isset($_GET['dnix']) ? $_GET['dnix'] : '';
$fechafalta = isset($_GET['fechaxxx']) ? $_GET['fechaxxx'] : '';
$materia = isset($_GET['materiax']) ? $_GET['materiax'] : '';
$curso = isset($_GET['cursox']) ? $_GET['cursox'] : '';
$turno = isset($_GET['turnox']) ? $_GET['turnox'] : '';
$tipo = isset($_GET['tipox']) ? $_GET['tipox'] : '';
$vista = isset($_GET['vistax']) ? $_GET['vistax'] : '';
$iasisParamWarning = '';
$iasisParametrosCompletos = ($dni !== '' && $fechafalta !== '' && $materia !== '' && $curso !== '' && $turno !== '' && $tipo !== '');

$movi = ($tipo === 'T') ? 'tardanza' : 'inasistencia';
if ($turno === 'M') { $turno = 'Manana'; }
if ($turno === 'T') { $turno = 'Tarde'; }
if ($turno === 'V') { $turno = 'Vespertino'; }

$nya = '';
$domicilio = '';
$numero = '';

if (!$iasisAuth) {
    return;
}

if (!$iasisParametrosCompletos) {
    $iasisParamWarning = 'Faltan parametros para generar la cedula. Requeridos: dnix, fechaxxx, materiax, cursox, turnox, tipox, vistax.';
}

require_once $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'conexion3.php';
if (function_exists('conectar')) {
    conectar();
}

if ($iasisParametrosCompletos) {
    $resultDoc = mysql_query("SELECT CONCAT(D.apellido, ' ', D.nombre) as nombredoc,D.direccion,D.numero FROM docente D WHERE D.dni = '$dni'");
    if ($resultDoc) {
        $filaDoc = mysql_fetch_array($resultDoc);
        $nya = isset($filaDoc['nombredoc']) ? $filaDoc['nombredoc'] : '';
        $domicilio = (isset($filaDoc['direccion']) ? $filaDoc['direccion'] : '') . ' ' . (isset($filaDoc['numero']) ? $filaDoc['numero'] : '');
    }
}

$agente = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
$anio = $fechafalta ? strftime('%Y', strtotime($fechafalta)) : date('Y');
$asunto = "FALTA - $nya FECHA: $fechafalta MATERIA: $materia CURSO: $curso TURNO: $turno";

if ($iasisParametrosCompletos) {
    $enlace = mysql_connect('localhost', 'root', '');
    if ($enlace) {
        mysql_select_db('sid');
        $resultN = mysql_query("SELECT * FROM notificaciones WHERE descripcion='$asunto' AND anio='$anio'");
        $filaN = $resultN ? mysql_fetch_array($resultN) : array();
        $numero = isset($filaN['codigo']) ? $filaN['codigo'] : '';

        if ($vista === 'N' && $numero === '') {
            $countQ = mysql_query("SELECT COUNT(*) as ultimo FROM notificaciones WHERE anio=YEAR(NOW())");
            $countF = $countQ ? mysql_fetch_array($countQ) : array('ultimo' => 0);
            $ultimo = (isset($countF['ultimo']) ? (int) $countF['ultimo'] : 0) + 1;
            $ins = mysql_query("INSERT INTO notificaciones VALUES ('','$ultimo','$asunto','$agente','$anio','')");
            if ($ins) {
                $numero = (string) $ultimo;
            }
        }
    }
}

setlocale(LC_TIME, 'spanish');
$hoyTxt = strftime('%A %d de %B de %Y');
$faltaTxt = $fechafalta ? strftime('%d de %B de %Y', strtotime($fechafalta)) : '';

