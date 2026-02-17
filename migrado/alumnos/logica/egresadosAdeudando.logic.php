<?PHP
/* Muestra estudiantes egresados que adeudan materias,
** para cada espacio curricular de todos los años adeudados.
*
*  TODO Mostrar que no hay estudiantes para el espacio seleccionado en el año elegido
*/
session_start();

include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
if (!mysql_num_rows($resultt)) {
	header('Location: i_admin.php');
	exit;
}

if (isset($_GET['cl'])) {
	switch ($_GET['cl']) {
		//Esto debe modificarse para que pueda incorporar a egresados más recientes
		case 2018:
		 $_SESSION['anioEgreso'] = 2018;
		 break;
		case 2019:
		 $_SESSION['anioEgreso'] = 2019;
		 break;
		case 2020:
		 $_SESSION['anioEgreso'] = 2020;
		 break;
		case 2021:
		 $_SESSION['anioEgreso'] = 2021;
		 break;
		case 2022:
		 $_SESSION['anioEgreso'] = 2022;
		 break;
		case 2023:
		 $_SESSION['anioEgreso'] = 2023;
		 break;
	}
}

if (isset($_SESSION['anioEgreso'])) $ciclo = $_SESSION['anioEgreso'];
else {
	$ciclo = $_SESSION['cicloLectivo'];
	$ciclo--;
	$_SESSION['anioEgreso'] = $ciclo;
}


$q_pendientes = mysql_query("SELECT * FROM materias2023 WHERE idmateria IN (SELECT DISTINCT idmateria FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE `curso` LIKE '6' AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria < 1000)");

$pendientes = array();
while($datosPend = mysql_fetch_assoc($q_pendientes)) $pendientes[$datosPend['idmateria']] = $datosPend['descripcion'];

if (isset($_GET['idmat'])) $materia = $_GET['idmat'];
else $materia = ''; //$materia = array_rand($pendientes);

asort($pendientes);

$q_materias = mysql_query("SELECT * FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE `curso` LIKE '6' AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria = '$materia'");

$q_estudiantes = mysql_query("SELECT dni,CONCAT(apellido,' ',nombre) AS nya,tel,mail FROM alumno WHERE dni IN (SELECT DISTINCT alumno FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE `curso` LIKE '6' AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria = '$materia')");

$q_aniosEgreso = mysql_query("SELECT DISTINCT anio FROM `cursa` WHERE ((curso LIKE '6' AND `modalidad` < 6) OR (curso LIKE '7' AND `modalidad` = 6)) AND anio != YEAR(CURDATE()) ORDER BY anio");

$materias = array();
while($datosMat=mysql_fetch_assoc($q_materias)) $materias[$datosMat['alumno']][$datosMat['curso']] = $datosMat;

$estudiantes = array();
while($datosEst = mysql_fetch_assoc($q_estudiantes)) $estudiantes[$datosEst['dni']] = $datosEst;

$aniosEgreso = array();
while($datosAni = mysql_fetch_assoc($q_aniosEgreso)) $aniosEgreso[] = $datosAni['anio'];

?>

