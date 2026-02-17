<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$anio = $_SESSION['cicloLectivo'];
//$anio = 2024;

$curso = '';
$div = '';
if (isset($_GET['cyd'])) {
	$cyd=trim($_GET['cyd']);
	$curso = substr($cyd,0,1);
	$div = substr($cyd,-1);
	$tit_cd = $curso . "° " . $div . (is_numeric($div) ? "a" : "") . ": matr&iacute;cula";
}
else $tit_cd = "Ver cursos";

$Qcursos_y_divisiones = mysql_query("SELECT DISTINCT curso,divi FROM `cursa` WHERE control = 1 AND anio = $anio ORDER BY curso,divi");
$opcion_cd = "";
while($curso_y_division = mysql_fetch_assoc($Qcursos_y_divisiones)) {
	if ($curso_y_division['curso']==$curso AND $curso_y_division['divi']==$div) $selected = "selected";
	else $selected = "";
	$opcion_cd[] = "<option value='" . $curso_y_division['curso'] .  $curso_y_division['divi'] . "' " . $selected . " >" . $curso_y_division['curso'] . "° " .  $curso_y_division['divi'] . "</option>\n";
}


?>

