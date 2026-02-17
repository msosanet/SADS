<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$iasisAuth = isset($_SESSION['estado']) && (int) $_SESSION['estado'] === 1;
$iasisLegacyModuleDir = IASIS_ROOT . DIRECTORY_SEPARATOR . 'legacy' . DIRECTORY_SEPARATOR . 'inasistencia';

$iasisCursos = array();
$iasisAlumnos = array();
$iasisCursoSeleccionado = isset($_GET['curso']) ? (string) $_GET['curso'] : '';
$iasisMostrar = isset($_GET['mostrar']);
$iasisEnviar = isset($_GET['enviar']);
$iasisMateria = isset($_GET['materia']) ? (string) $_GET['materia'] : 'General';
$iasisMensaje = '';
$iasisFechaForm = date('d/m/y');

if (!$iasisAuth) {
    return;
}

require_once $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'conexion3.php';
if (function_exists('conectar')) {
    conectar();
}

// Se mantiene conexion legacy como en el flujo original.
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("base_sobral") or die(mysql_error());

function iasis_asistencia_fetch_cursos()
{
    $rows = array();
    $sql = "SELECT * FROM curso2 WHERE habilitado='1' order by curso,division ASC";
    $result = mysql_query($sql);
    if (!$result) {
        return $rows;
    }
    while ($row = mysql_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function iasis_asistencia_parse_curso($cursoSeleccionado)
{
    return array(substr($cursoSeleccionado, 0, 1), substr($cursoSeleccionado, 1));
}

function iasis_asistencia_fetch_alumnos($cursoSeleccionado, $cicloLectivo)
{
    $rows = array();
    list($curso, $division) = iasis_asistencia_parse_curso($cursoSeleccionado);

    $sql = "SELECT a.dni, CONCAT(a.apellido, ' ', a.nombre) as alumno
            FROM alumno a, cursa c
            WHERE c.control='1'
              AND c.curso='$curso'
              AND c.divi='$division'
              AND c.anio='$cicloLectivo'
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

function iasis_asistencia_guardar_faltas($ausentes, $ij, $materia)
{
    $hoy = date('Y-m-d');
    foreach ($ausentes as $dni) {
        $injus = isset($ij[$dni]) ? $ij[$dni] : '1';
        $sql = "INSERT INTO alumnos_faltas VALUES ('$dni','$hoy','$materia','$injus')";
        mysql_query($sql);
    }
}

$iasisCursos = iasis_asistencia_fetch_cursos();

if ($iasisMostrar && $iasisCursoSeleccionado !== '') {
    $cicloLectivo = isset($_SESSION['cicloLectivo']) ? $_SESSION['cicloLectivo'] : date('Y');
    $iasisAlumnos = iasis_asistencia_fetch_alumnos($iasisCursoSeleccionado, $cicloLectivo);
}

if ($iasisEnviar) {
    $ausentes = (isset($_GET['ausentes']) && is_array($_GET['ausentes'])) ? $_GET['ausentes'] : array();
    $ij = (isset($_GET['ij']) && is_array($_GET['ij'])) ? $_GET['ij'] : array();
    iasis_asistencia_guardar_faltas($ausentes, $ij, $iasisMateria);
    $iasisMensaje = 'Datos Guardados';
}
