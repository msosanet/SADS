<?PHP
session_start();
if ($_SESSION['estado']==1) {

$alumno = (isset($_GET['alumno'])) ? $_GET['alumno'] : "nadie";

include 'conexion3.php';
?>

