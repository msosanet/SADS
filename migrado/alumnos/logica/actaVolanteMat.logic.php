<?PHP
/* Se accede a esta página luego de elegir la materia que tiene estudiantes activos en el colegio
*  que la deben rendir previa
*/
// http://alumnos.colegiosobral.edu.ar/actaVolanteMat.php?materia=Biolog%C3%ADa&curso=3
session_start();
if ($_SESSION['estado']==1) {
include 'conexion.php';

$conexion = conectar ();
$usuario = $_SESSION['usuario'];

if (isset($_GET['materia'])) {
$materia = $_GET['materia'];
//$curso = $_GET['curso'];
$fecha_hoy = date("Y-m-d");
/*
$materia = "Biología";
$curso = "3"; */
$mate_curso = $materia; //$mate_curso = $materia . "%" . $curso . "%";
$datos = '';//$datos =& $_COOKIE[datosEstud];

$alum_ade = mysql_query("SELECT adeudan.alumno, CONCAT(apellido,', ',nombre) AS apeNom,anio,curso FROM alumno,(SELECT alumno FROM `previas` WHERE materia LIKE '$mate_curso' AND nota < 6 AND alumno = ANY (SELECT alumno FROM cursa WHERE control = 1 AND anio = 2022)) AS adeudan,cursa WHERE dni = adeudan.alumno AND cursa.alumno = adeudan.alumno AND control = 1 ORDER BY apeNom,adeudan.alumno,anio DESC");
$anterior = 0;
while ($rinde = mysql_fetch_assoc($alum_ade)) {
	if ($rinde['alumno'] != $anterior) {
		$datos = $datos . ";" . $rinde['alumno'] . "=>" . $rinde['apeNom'];
	}
	$anterior = $rinde['alumno'];
}
setcookie("datosEstud",$datos);
}
?>

