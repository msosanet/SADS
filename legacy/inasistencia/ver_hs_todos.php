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
$actor=$_GET["actor"];

$resultt = mysql_query ("SELECT * FROM docentes WHERE dni = '$actor'");
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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Datos de:&nbsp;<font color="ff0000"><?echo $filatt[apellido] ?>,&nbsp;<?echo $filatt[nombre] ?></font>
 </p>
						</p>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Telefonos:&nbsp;<font color="ff0000"><?echo $filatt[telefono] ?>&nbsp;&nbsp;</font>

					
					</p>

					
					<p align="center"><div class="titles1">&nbsp;<p align="left">Direccion:&nbsp;<font color="ff0000"><?echo $filatt[direccion] ?>&nbsp;&nbsp;</font>

					
					</p>
					
					<p align="center"><div class="titles1">&nbsp;<p align="left">Numero:&nbsp;<font color="ff0000"><?echo $filatt[numero] ?>&nbsp;&nbsp;</font>

					
					</p>
					
					<p align="center"><div class="titles1">&nbsp;<p align="left">Celular:&nbsp;<font color="ff0000"><?echo $filatt[celular] ?>&nbsp;&nbsp;</font>

					
					</p>
					
					<p align="center"><div class="titles1">&nbsp;<p align="left">Mail:&nbsp;<font color="ff0000"><?echo $filatt[mail] ?>&nbsp;&nbsp;</font>

					
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
include 'ORIGINALVD.php?actor=$actor';
$result77 = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' order by cod_dia");
?>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="5" height="40" align="left">
							<center>Horario Declarado por &nbsp;<?echo $filatt[apellido] ?>,&nbsp;<?echo $filatt[nombre] ?>
							</td>
						</tr>
						<tr>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Lunes</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Martes</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Miércoles</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Jueves</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Viernes</b></td>

					</tr>

		<?php while ($fila77 = mysql_fetch_array($result77))
		{ ?>
					<tr>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? if ($fila77[cod_dia] ==1) 
							{ echo $fila77[hs_entrada];?>&nbsp;a&nbsp;<?php echo $fila77[hs_salida]; }?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? if ($fila77[cod_dia] ==2) 
							{ echo $fila77[hs_entrada]?>&nbsp;a&nbsp;<?php echo $fila77[hs_salida]; }?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? if ($fila77[cod_dia] ==3) 
							{ echo $fila77[hs_entrada]?>&nbsp;a&nbsp;<?php echo $fila77[hs_salida]; }?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? if ($fila77[cod_dia] ==4) 
							{ echo $fila77[hs_entrada]?>&nbsp;a&nbsp;<?php echo $fila77[hs_salida]; }?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? if ($fila77[cod_dia] ==5) 
							{ echo $fila77[hs_entrada]?>&nbsp;a&nbsp;<?php echo $fila77[hs_salida]; }?>
						</td>

	
	
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