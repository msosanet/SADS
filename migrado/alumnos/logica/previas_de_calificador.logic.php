<?PHP
session_start();
if ($_SESSION['estado']==1) { //verifica que hay usuario con sesión inciada

$anio = $_SESSION['cicloLectivo'];

include 'conexion.php';
?>

