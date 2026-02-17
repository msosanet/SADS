<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
//$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
//$filatt = mysql_fetch_array($resultt) ;
$anio=$_SESSION['cicloLectivo'];

$descripcion = isset($_GET['descripcion']) ? $_GET['descripcion'] : "";
if (isset($_GET['muestra2'])) { // Resultado de la búsqueda o listado 6to año
	if (is_numeric(trim($descripcion))) {
		$_pagi_sql = "SELECT * FROM `alumno`,`cursa` WHERE `alumno`.`dni` LIKE '%$descripcion%' AND `cursa`.`curso`=6  AND `cursa`.`alumno`=`alumno`.`dni` ORDER BY `alumno`.`apellido`,`alumno`.`nombre`";
	}
	else {
		$_pagi_sql = "SELECT * FROM `alumno`,`cursa` WHERE `alumno`.`apellido` LIKE '%$descripcion%' AND  `cursa`.`curso`=6 AND `cursa`.`alumno`=`alumno`.`dni` ORDER BY `alumno`.`apellido`,`alumno`.`nombre`";
	}
} 
else {
	    $_pagi_sql = "SELECT * FROM `alumno`,`cursa` WHERE `cursa`.`anio`=$anio AND `cursa`.`control`=1 AND `cursa`.`curso`=6 AND `cursa`.`divi` <> '' AND `cursa`.`alumno`=`alumno`.`dni` ORDER BY `alumno`.`apellido`,`alumno`.`nombre`";
}

$_pagi_result = mysql_query($_pagi_sql);

$contenido_tabla = "";
while ($fila2 = mysql_fetch_array($_pagi_result)) $contenido_tabla[] = "<tr class='alte' onclick='ventanaSecundaria(\"const_final.php?dni=" . $fila2['dni'] . "\")'><td width='20' align='center'>" .  $fila2['dni'] . "</td><td width='20' align='center'>" . $fila2['apellido'] . ", " . $fila2['nombre'] . "</td></tr>";

?>

