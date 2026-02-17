<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$iasisAuth = isset($_SESSION['estado']) && (int) $_SESSION['estado'] === 1;
$iasisLegacyModuleDir = IASIS_ROOT . DIRECTORY_SEPARATOR . 'legacy' . DIRECTORY_SEPARATOR . 'inasistencia';

$iasisCursoSeleccionado = isset($_GET['curso']) ? (string) $_GET['curso'] : '';
$iasisMostrar = isset($_GET['mostrar']);
$iasisEnviar = isset($_GET['enviar']);
$iasisMateria = 'EF';
$iasisMensaje = '';
$iasisCursos = array();
$iasisAlumnos = array();

if (!$iasisAuth) {
    return;
}

require_once $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'conexion.php';
if (function_exists('conectar')) {
    conectar();
}

mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("base_sobral") or die(mysql_error());

function iasis_asistenciaef_fetch_cursos()
{
    $rows = array();
    $sql = "SELECT * FROM curso2 WHERE habilitado='1' order by curso,division ASC";
    $result = mysql_query($sql);
    if (!$result) {
        return $rows;
    }
    while ($row = mysql_fetch_assoc($result)) {
        if (isset($row['curso']) && $row['curso'] !== '') {
            $rows[] = $row;
        }
    }
    return $rows;
}

function iasis_asistenciaef_fetch_alumnos($cursoSeleccionado, $anio)
{
    $rows = array();
    $curso = substr($cursoSeleccionado, 0, 1);
    $division = substr($cursoSeleccionado, 1);

    $sql = "SELECT a.dni, CONCAT(a.apellido, ' ', a.nombre) as alumno
            FROM alumno a, cursa c
            WHERE c.control='1'
              AND c.anio='$anio'
              AND c.curso='$curso'
              AND c.divi='$division'
              AND c.alumno=a.dni
            ORDER by alumno";

    $result = mysql_query($sql);
    if (!$result) {
        return $rows;
    }

    while ($row = mysql_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function iasis_asistenciaef_guardar($ausentes, $ij)
{
    $hoy = date('Y-m-d');
    foreach ($ausentes as $dni) {
        $injus = isset($ij[$dni]) ? $ij[$dni] : '1';
        $sql = "INSERT INTO alumnos_faltas VALUES ('$dni','$hoy','EF','$injus')";
        mysql_query($sql);
    }
}

$iasisCursos = iasis_asistenciaef_fetch_cursos();

if ($iasisMostrar && $iasisCursoSeleccionado !== '') {
    $cicloLectivo = isset($_SESSION['cicloLectivo']) ? $_SESSION['cicloLectivo'] : date('Y');
    $iasisAlumnos = iasis_asistenciaef_fetch_alumnos($iasisCursoSeleccionado, $cicloLectivo);
}

if ($iasisEnviar) {
    $ausentes = (isset($_GET['ausentes']) && is_array($_GET['ausentes'])) ? $_GET['ausentes'] : array();
    $ij = (isset($_GET['ij']) && is_array($_GET['ij'])) ? $_GET['ij'] : array();
    iasis_asistenciaef_guardar($ausentes, $ij);
    $iasisMensaje = 'Datos Guardados';
}
