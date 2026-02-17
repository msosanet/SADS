<?PHP
/* Muestra estudiantes activos que adeudan materias,
** para cada espacio curricular todos los años adeudados.
*/
session_start();

// Está logueado el usuario?
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


$ciclo = $_SESSION['cicloLectivo'];


$q_pendientes = mysql_query("SELECT * FROM materias2023 WHERE idmateria IN (SELECT DISTINCT idmateria FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE control = 1 AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria < 1000) ORDER BY descripcion");

$pendientes = [];
while($datosPend = mysql_fetch_assoc($q_pendientes)) $pendientes[$datosPend['idmateria']] = $datosPend['descripcion'];

$materia = (isset($_GET['idmat'])) ? $_GET['idmat'] : array_rand($pendientes);
$materia = 4;


$q_materias = mysql_query("SELECT * FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE `curso` LIKE '6' AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria = '$materia'");

$q_estudiantes = mysql_query("SELECT dni,CONCAT(apellido,' ',nombre) AS nya,tel,mail FROM alumno WHERE dni IN (SELECT DISTINCT alumno FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE `curso` LIKE '6' AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria = '$materia')");

$q_adeudadas = mysql_query("SELECT previas.* FROM `previas` RIGHT JOIN cursa ON cursa.alumno = previas.alumno WHERE cursa.control = 1 AND cursa.anio = '$ciclo' AND previas.nota < 6 AND previas.idmateria = '$materia' ");


$materias = [];
while($datosMat=mysql_fetch_assoc($q_materias)) $materias[$datosMat['alumno']][$datosMat['curso']] = $datosMat;

$estudiantes = [];
while($datosEst = mysql_fetch_assoc($q_estudiantes)) $estudiantes[$datosEst['dni']] = $datosEst;

$adeudadas = [];
while ($__a = mysql_fetch_assoc($q_adeudadas)) {
	array_push($adeudadas[$__a['alumno']]['materia'],$__a['curso']);

	}


?>

