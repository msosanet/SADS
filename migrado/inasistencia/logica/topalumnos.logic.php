<?PHP

session_start();
include "funciones.php";
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
if (loginvalido($usuario,$pass,$pagina)=="OK")
{		

include 'conexion3.php';
?>

