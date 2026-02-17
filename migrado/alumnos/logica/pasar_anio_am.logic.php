<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
if (!mysql_num_rows($resultt)) {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
}

mysql_select_db("alumnos-prueba"); // para pruebas

$curso=$_GET["curso"];
$division=$_GET["division"];

// Verifica que exista el curso
$q_curso_valido = mysql_query("SELECT * FROM `curso2` WHERE curso = $curso AND division = '$division'");
$curso_valido = mysql_num_rows($q_curso_valido) ? true : false;

// if ($curso_valido) {

$arraySeccion = mysql_fetch_assoc($q_curso_valido);

$cadenaSeccion = htmlspecialchars($arraySeccion['descripcion']);

$anio=date("Y");

$anio2=$anio;


$q_seccion = mysql_query("SELECT * FROM `curso2` WHERE (curso = $curso OR curso = ($curso +1)) AND plan = (SELECT plan FROM `curso2` WHERE curso = $curso AND division = '$division')ORDER BY habilitado DESC,curso,division");


?>

