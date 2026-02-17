<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';

//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un guión.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}


$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$dni=$_GET['dni'];

$sig_anio = date("Y") + 1;
$color = "";




$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM alumno where dni=$dni");
$filadocente = mysql_fetch_array($resultdocente);

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario);



$anio=date("Y");

$ye2 = mysql_query ("SELECT * FROM cursa where alumno=$dni and anio='$anio'");
$yaesta2 = mysql_fetch_array($ye2);
?>

