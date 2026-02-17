<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$iasisMeses = array(
    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
    5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
    9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
);

$iasisAuth = isset($_SESSION['estado']) && (int) $_SESSION['estado'] === 1;
$iasisLegacyModuleDir = IASIS_ROOT . DIRECTORY_SEPARATOR . 'legacy' . DIRECTORY_SEPARATOR . 'inasistencia';

$iasisCursoSeleccionado = isset($_GET['curso']) ? (string) $_GET['curso'] : '';
$iasisMesSeleccionado = isset($_GET['mes']) ? (int) $_GET['mes'] : (int) date('m');
$iasisMostrar = isset($_GET['mostrar']);

if ($iasisMesSeleccionado < 1 || $iasisMesSeleccionado > 12) {
    $iasisMesSeleccionado = (int) date('m');
}

$iasisCursos = array();
$iasisDiasHeaders = array();
$iasisPlanilla = array();
$iasisTitulo = '';
$iasisSubtitulo = '';

if (!$iasisAuth) {
    return;
}

require_once $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'conexion3.php';
if (function_exists('conectar')) {
    conectar();
}

function iasis_boletin_fetch_cursos()
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

function iasis_boletin_fetch_alumnos($curso, $division, $anio)
{
    $rows = array();
    $sql = "SELECT CONCAT(a.apellido, ' ', a.nombre) as alumno, a.dni
            FROM alumno a, cursa c
            WHERE c.alumno=a.dni
              AND c.curso='$curso'
              AND c.divi='$division'
              AND c.anio='$anio'
              AND c.control='1'
            ORDER BY alumno ASC";

    $result = mysql_query($sql);
    if (!$result) {
        return $rows;
    }

    while ($row = mysql_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function iasis_boletin_color_por_porcentaje($porcentaje)
{
    if ($porcentaje > 80) {
        return '#00FF00';
    }
    if ($porcentaje >= 50 && $porcentaje <= 79) {
        return '#FFFF00';
    }
    return '#FF0000';
}

function iasis_boletin_resumen_alumno($dni, $mes, $year)
{
    $justificadas = 0;
    $injustificadas = 0;

    $justificadasQ = "SELECT SUM(CASE WHEN a.tipo = 'TEDI' AND a.injus IN (0) THEN i.valorfalta / 2 ELSE i.valorfalta END) as total
                      FROM alumnos_faltas a, injus i
                      WHERE i.id=0 AND a.injus=i.id AND MONTH(fecha) = '$mes' AND YEAR(fecha) = '$year' AND a.dni='$dni'";
    $justificadax = mysql_query($justificadasQ);
    if ($justificadax) {
        $rowJ = mysql_fetch_assoc($justificadax);
        $justificadas = isset($rowJ['total']) ? (float) $rowJ['total'] : 0;
    }

    $injustificadasQ = "SELECT SUM(CASE WHEN a.tipo = 'TEDI' AND a.injus IN (1) THEN i.valorfalta / 2 ELSE i.valorfalta END) as total
                        FROM alumnos_faltas a, injus i
                        WHERE i.id=1 AND a.injus=i.id AND MONTH(fecha) = '$mes' AND YEAR(fecha) = '$year' AND a.dni='$dni'";
    $injustificadax = mysql_query($injustificadasQ);
    if ($injustificadax) {
        $rowI = mysql_fetch_assoc($injustificadax);
        $injustificadas = isset($rowI['total']) ? (float) $rowI['total'] : 0;
    }

    return array($justificadas, $injustificadas);
}

function iasis_boletin_celda_dia($dni, $fecha, $diaSemana)
{
    if ($diaSemana === '0') {
        return array('codigo' => 'D', 'bg' => '#f0f8ff', 'link' => '');
    }

    if ($diaSemana === '6') {
        return array('codigo' => 'S', 'bg' => '#f0f8ff', 'link' => '');
    }

    $feriado = mysql_query("SELECT * FROM feriados WHERE fecha='$fecha'");
    $feri = $feriado ? mysql_num_rows($feriado) : 0;
    if ($feri > 0) {
        return array('codigo' => 'F', 'bg' => '#f0f8ff', 'link' => '');
    }

    $consultalu = "SELECT * FROM alumnos_faltas a, injus i WHERE a.injus=i.id AND a.fecha='$fecha' AND a.dni='$dni'";
    $ausentex = mysql_query($consultalu);
    $total = $ausentex ? mysql_num_rows($ausentex) : 0;

    if ($total > 0) {
        $letras = array();
        while ($rowz = mysql_fetch_assoc($ausentex)) {
            $letras[] = $rowz['letra'];
        }
        return array(
            'codigo' => implode(' | ', $letras),
            'bg' => '#FF0000',
            'link' => 'alumnostarde.php?fecha=' . $fecha . '&dni=' . $dni,
        );
    }

    return array('codigo' => 'P', 'bg' => '#00FF00', 'link' => '');
}

$iasisCursos = iasis_boletin_fetch_cursos();

if ($iasisMostrar && $iasisCursoSeleccionado !== '') {
    $curso = substr($iasisCursoSeleccionado, 0, 1);
    $division = substr($iasisCursoSeleccionado, 1);

    $year = (int) date('Y');
    $mesActual = (int) date('m');
    $dias = cal_days_in_month(CAL_GREGORIAN, $iasisMesSeleccionado, $year);

    $re = $mesActual - $iasisMesSeleccionado;
    if ($re === 0) {
        $dias = (int) date('d');
    }
    if ($re < 0) {
        $dias = 0;
    }

    for ($j = 1; $j <= $dias; $j++) {
        $iasisDiasHeaders[] = $j . '/' . $iasisMesSeleccionado;
    }

    $iasisTitulo = 'PLANILLA DE ASISTENCIA ' . $iasisMesSeleccionado . '-' . $year;
    $iasisSubtitulo = 'Cantidad de dias del mes: ' . $dias;

    $alumnos = iasis_boletin_fetch_alumnos($curso, $division, $year);

    foreach ($alumnos as $alumno) {
        $dni = $alumno['dni'];
        $presente = 0;
        $celdas = array();

        for ($z = 1; $z <= $dias; $z++) {
            $fecha = sprintf('%04d-%02d-%02d', $year, $iasisMesSeleccionado, $z);
            $diaSemana = date('w', mktime(0, 0, 0, $iasisMesSeleccionado, $z, $year));
            $celda = iasis_boletin_celda_dia($dni, $fecha, $diaSemana);
            if ($celda['codigo'] === 'P') {
                $presente++;
            }
            $celdas[] = $celda;
        }

        list($justificadas, $injustificadas) = iasis_boletin_resumen_alumno($dni, $iasisMesSeleccionado, $year);
        $totalausentes = $justificadas + $injustificadas;
        $denominador = $totalausentes + $presente;
        $porcentaje = ($denominador > 0) ? round(100 - (($totalausentes / $denominador) * 100), 0) : 0;
        $color = iasis_boletin_color_por_porcentaje($porcentaje);

        $iasisPlanilla[] = array(
            'dni' => $dni,
            'alumno' => $alumno['alumno'],
            'celdas' => $celdas,
            'justificadas' => $justificadas,
            'injustificadas' => $injustificadas,
            'totalausentes' => $totalausentes,
            'presentes' => $presente,
            'porcentaje' => $porcentaje,
            'color_porcentaje' => $color,
        );
    }
}
