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

<script language="javascript">
<!--
function abrir_ventana(enlace)
{
propiedades="width=400, height=300";
window.open(enlace,"_blank",propiedades);
}
//-->
</script> 

<link rel="shortcut icon" href="../imag/favicon.ico">
<title></title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$actor = $_SESSION['docente']; 



$rest1 = substr($actor, 0, 2);
$rest2 = substr($actor, 2, 3);
$rest3 = substr($actor, 5, 3);

$rest4 =$rest1.".".$rest2.".".$rest3;

$resultt = mysql_query ("SELECT * FROM alumnos WHERE dni = '$rest4'");
$filatt = mysql_fetch_array($resultt);






?>
<body background="bgris.gif" >
<form method="GET" action="ver_hs_todos.php?actor=<?php echo $actor?>">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
			<table border="0" width="980">
<?		
include 'menuppal2.php';

?>
				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Datos de:&nbsp;<font color="ff0000"><?echo $filatt[alumno] ?></font>
 </p>
						</p>
					
					
					<div align="left">
					
					
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
</font>
					
<?



$result77 = mysql_query ("SELECT * FROM mesas WHERE dni = '$actor' order by anio");
?>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="6" height="40" align="left">
							<center>MATERIAS EN LAS CUALES SE ANOTO
							</td>
						</tr>
						<tr>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Materia</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Curso</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Plan</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Fecha</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Hora</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>ACCIONES</b></td>
				

					</tr>

		<?php while ($fila77 = mysql_fetch_array($result77))
		{ 
		$resultxx = mysql_query ("SELECT * FROM docentes_mesas WHERE codigo = $fila77[codigo]");
		$filaxx = mysql_fetch_array($resultxx);
						$fechas=explode("-",$filaxx[fecha]);
						$fechas=$fechas[2]."/".$fechas[1]."/".$fechas[0];

?>
					<tr>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filaxx[materia];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filaxx[curso];?>	
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filaxx[plan];?>
						</td>

						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fechas;?>

						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filaxx[hs];?>

						<td bgcolor="#FFFFFF" width="82" align="center" bordercolor="#C0C0C0"><a href="javascript:abrir_ventana('borra_gob.php?codigo=<?php echo $fila77[codigo]?>&dni=<?php echo $fila77[dni]?>&anio=<?php echo $fila77[anio]?>')">Borrar</a></td>

	
					</tr>
		<?}?>

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
