<?PHP
session_start();
if ($_SESSION['estado']==1) {
//include 'conexion.php';
$mysqli = mysqli_connect("localhost", "fgoicoechea", "sobral2011", "sid");
?>

