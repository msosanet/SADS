<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
include 'conexioncalif.php';
ob_start();
?>

