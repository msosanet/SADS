<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';
include 'header.php';
$conexion = conectar ();
$actor=$_GET["dni"];


$resultt = mysql_query ("SELECT * FROM alumno WHERE dni = $actor");
$filatt = mysql_fetch_array($resultt);

$q_titulacion = mysql_query ("SELECT * FROM `titulo` WHERE `alumno` = '$actor'");
$titulacion = mysql_fetch_assoc($q_titulacion);

$apeNom = $filatt['apellido'] . " ". $filatt['nombre'];
$cuilpre = substr($filatt['cuil'],0,2);
$cuildni = substr($filatt['cuil'],2,-1);
$cuilsuf = substr($filatt['cuil'],-1,1);

$resulcc = mysql_query ("SELECT * FROM folio WHERE dni = $actor");


?>

