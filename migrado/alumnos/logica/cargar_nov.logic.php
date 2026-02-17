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
$dni=$_GET['actor'];
$identificacion=$_GET['ident'];


$hora=date("H:i:s");

$resultalumno = mysql_query ("SELECT * FROM alumno where dni=$dni");
$filaalumnos = mysql_fetch_array($resultalumno);

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario);
$alumno=$filaalumnos['apellido'].",".$filaalumnos['nombre'];
//echo "ALUUUUMNOOOOO".$alumno;
?>

