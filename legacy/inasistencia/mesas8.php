<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<link rel="shortcut icon" href="../imag/favicon.ico">
<title></title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$descripcion=$_GET["actor"];

$resultt = mysql_query ("SELECT * FROM docentes_mesas WHERE dni1='$descripcion' or dni2='$descripcion' or dni3='$descripcion' or dni4='$descripcion' order by materia");



?>



<body background="bgris.gif" >
<form method="GET" action="ver_mesa.php?mesa=<?php echo $mesa?>">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
			<table border="0" width="980">
<?if ($_SESSION['valor']==1)
{		
include 'menuppal2.php';
}
if ($_SESSION['valor']==0)
 {		
include 'menuppal.php';
}
if ($_SESSION['valor']==3)
 {		
include 'menuppal3.php';
}
?>
				<tr>
				

					<td>
					
					<p align="left" class="text1b">Información de Mesas</p>
					<div align="center">
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						
						</table>
<br><br>

<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

							<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"><b>Alumnos</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<b>Anotados</b>	</td>
							
						</tr>	
		<?php while ($fila5 = mysql_fetch_array($resultt))
		{
?>
						<tr>
						

							<td width="174" bgcolor="#FF9999" align="right"><font color="<?echo $color;?>">Materia:</td>
							<td bgcolor="#FF9999" width="268" align="left">
							<b><?echo $fila5[materia];?> - <?echo $fila5[plan];?> - <?echo $fila5[curso];?></b></td>


							
						</tr>	
<?
$contador=0;


		$result6 = mysql_query ("SELECT * FROM mesas where codigo=$fila5[codigo]");
		while ($fila6 = mysql_fetch_array($result6))
		{
$contador=$contador+1;
	$rest1 = substr($fila6[dni], 0, 2);
	$rest2 = substr($fila6[dni], 2, 3);
	$rest3 = substr($fila6[dni], 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;
	$result7 = mysql_query ("SELECT * FROM alumnos_mesas where dni='$rest4'");
	$fila7 = mysql_fetch_array($result7) ;
?>
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Alumno <?echo $contador;?>:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<?echo $fila7[alumno];?></td>


							
						</tr>	
						<?
						}
						?>				
						<?
						}
						?>	
						</table>








						
					</p>
					<p align="center">&nbsp;</td>
				</tr>


			</table>
			</div>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>



</form>
 </td>

</div>

</body>

</html>
<? } ?>