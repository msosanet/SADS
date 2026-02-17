<?PHP
session_start();

if (!isset($_SESSION['valor'])) { 
    header("location: i_admin.php");
    exit;
}

if ($_SESSION['estado']==1) { 
	include 'conexion.php'; //funciones para conectar db sid


$conexion = conectar();
$desde= $_SESSION['cicloLectivo'] . "-02-01";
$hasta= date("Y-m-d");
if (isset($_GET["desde"]) && isset($_GET["hasta"])) { 
//falta ordenar desde<<hasta *********************************************
	$desde=date("Y-m-d",strtotime($_GET["desde"]));
	$hasta=date("Y-m-d",strtotime($_GET["hasta"]));
}
?>

