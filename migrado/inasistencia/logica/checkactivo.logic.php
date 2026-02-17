<?php 
include 'conexion.php';
$conexion = conectar ();

$fechactual=date('Y-m-d');

$consultactivo="SELECT * FROM alta_baja ab WHERE activa = 1 AND fhasta < CURDATE() AND fhasta!='0000-00-00'";
$resultactivo = mysql_query ($consultactivo); 
while ($myrowc = mysql_fetch_array($resultactivo)) 
{			
	
	//echo $myrowc['id']." ".$myrowc['materia']." ".$myrowc['fhasta']."<br>";				
	$actualizar="UPDATE alta_baja SET activa=0 WHERE id='$myrowc[id]'";
	$actualizax = mysql_query ($actualizar); 
	$actualizar=mysql_real_escape_string($actualizar);
	$insertalog="INSERT INTO log (id,fecha,obs) VALUES ('',NOW(),'$actualizar')";
	echo $insertalog;
	$insertalogx=mysql_query ($insertalog);
	
	
		
	//echo $actualizar."<br>";

}
							

			
	
?>

