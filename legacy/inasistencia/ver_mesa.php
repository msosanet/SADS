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
$mesa=$_GET["mesa"];

$resultt = mysql_query ("SELECT * FROM docentes_mesas WHERE codigo = $mesa");
$filatt = mysql_fetch_array($resultt);



$result1 = mysql_query ("SELECT * FROM docentes where dni='$filatt[dni1]'");
$fila1 = mysql_fetch_array($result1) ;

$result2 = mysql_query ("SELECT * FROM docentes where dni='$filatt[dni2]'");
$fila2 = mysql_fetch_array($result2) ;

$result3 = mysql_query ("SELECT * FROM docentes where dni='$filatt[dni3]'");
$fila3 = mysql_fetch_array($result3) ;

$result4 = mysql_query ("SELECT * FROM docentes where dni='$filatt[dni4]'");
$fila4 = mysql_fetch_array($result4) ;

$result5 = mysql_query ("SELECT * FROM mesas where codigo = $mesa");


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

						
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Curso/Plan:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<b><?echo $filatt['curso']; ?> - <?echo $filatt['plan']; ?></b>
							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Materia:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<b><?echo $filatt['materia']; ?></b>
							</td>
							
						</tr>
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<b><?echo $filatt['fecha']; ?></b>
							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Hora:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<b><?echo $filatt['hs']; ?></b>
							</td>
							
						</tr>
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Presidente:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<a href="mesas2.php?mesa=<?php echo $filatt[codigo]?>&dni=<?php echo $filatt[dni1]?>" target="_blank"><b><?echo $fila1['apellido'];?>, <?echo $fila1['nombre'];?></b></a>	</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Vocal 1:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<a href="mesas2.php?mesa=<?php echo $filatt[codigo]?>&dni=<?php echo $filatt[dni2]?>" target="_blank"><b><?echo $fila2['apellido'];?>, <?echo $fila2['nombre'];?></b></a>	</td>
							
						</tr>
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Vocal 2:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<a href="mesas2.php?mesa=<?php echo $filatt[codigo]?>&dni=<?php echo $filatt[dni3]?>" target="_blank"><b><?echo $fila3['apellido'];?>, <?echo $fila3['nombre'];?></b></a>	</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Suplente:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<a href="mesas2.php?mesa=<?php echo $filatt[codigo]?>&dni=<?php echo $filatt[dni4]?>" target="_blank"><b><?echo $fila4['apellido'];?>, <?echo $fila4['nombre'];?></b></a>	</td>
							
						</tr>												
						</table>
<br><br>

<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

							<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"><b>Alumnos</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<b>Anotados</b>	</td>
							
						</tr>	
		<?php while ($fila5 = mysql_fetch_array($result5))
		{
	$rest1 = substr($fila5[dni], 0, 2);
	$rest2 = substr($fila5[dni], 2, 3);
	$rest3 = substr($fila5[dni], 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;
$result6 = mysql_query ("SELECT * FROM alumnos_mesas where dni='$rest4'");
$fila6 = mysql_fetch_array($result6) ;
?>
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Alumno:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<b><a href="mesas3.php?dni=<?php echo $fila5[dni]?>" target="_blank"><?echo $fila6['alumno'];?>, <?echo $fila6['nombre'];?></a></b>	</td>


							
						</tr>					
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