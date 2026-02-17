<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion3.php';

$alumno = (isset($_GET['actor'])) ? $_GET['actor'] : "nadie";
$deriva = (isset($_GET['deriva'])) ? $_GET['deriva'] : "ninguna";
$intv = (isset($_GET['int'])) ? $_GET['int'] : "ninguna";

$conexion = conectar ();
$usuario=$_SESSION['usuario'];

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
if (!mysql_num_rows($resultusuario)) {
	header('Location: i_admin.php');
	exit;
}



//---------------- "Borrar" intervención ----------------
if (is_numeric($intv)) {
	
	$q_borraIntv = "UPDATE intervencion SET mostrar = 0 WHERE alumno = $alumno AND codigo = $intv";
	$_borraIntv = mysql_query($q_borraIntv);
	if (mysql_affected_rows()>0) $_SESSION["intBorradas"][] = $intv;
	else {
		$q_recuIntv = "UPDATE intervencion SET mostrar = 1 WHERE alumno = $alumno AND codigo = $intv";
		$_recuIntv = mysql_query($q_recuIntv);
		if (mysql_affected_rows()>0) {
			$recuperada = array_search($intv,$_SESSION["intBorradas"]);
			unset($_SESSION['intBorradas'][$recuperada]);
		}
	}
}


?>

