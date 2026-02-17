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



?>

