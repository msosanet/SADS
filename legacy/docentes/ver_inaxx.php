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
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$dni=$_GET["actor"];
$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
?>

<body background="bgris.gif" >
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
				
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
</font>

<?

	$fecha_desde=$_GET["fecha_desde"];
	$fecha_hasta=$_GET["fecha_hasta"];
	$dni=$_GET["dni"];

	$_pagi_sql="SELECT * FROM ausentes WHERE fecha_desde >='$fecha_desde'  and fecha_hasta <= '$fecha_hasta' and docente='$dni' order by fecha_desde";

$_pagi_cuantos=50;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p>

<form method="GET" action="ver_inaxx.php">
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="9" height="40" align="left">
							&nbsp;Resultado del Filtro</td>
						</tr>
						<tr>
							<td width="200" bgcolor="#808080" align="center" height="36">Docente</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Fecha Desde</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Fecha Hasta</td>
							<td bgcolor="#808080" width="70" align="center"  height="36">Hora</td>
							<td bgcolor="#808080" width="200" align="center"  height="36">Motivo</td>
							<td bgcolor="#808080" width="200" align="center"  height="36">Observaciones</td>
							<td bgcolor="#808080" width="80" align="center"  height="36">Notific&oacute;</td>
							<td bgcolor="#808080" width="80" align="center"  height="36">F_Notif</td>
							<td bgcolor="#808080" width="80" align="center"  height="36">Justificado</td>									
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
			$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila2[docente]' ");
			$filaobs = mysql_fetch_array($resultobs);
			$resultmot = mysql_query ("SELECT * FROM motivos WHERE codigo = '$fila2[motivo]' ");
			$filamot = mysql_fetch_array($resultmot);
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaobs[apellido];?>,<?echo $filaobs[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[fecha_desde];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[fecha_hasta];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[hora];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filamot[descripcion];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[observaciones];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[notifico];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[f_notif];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center">
							<?php if ($fila2[justificada]==0 ) 
							{
							?><input name="afectado[]" type="checkbox" value="<?php echo $fila2[codigo];?>"></td><?php	
							}
							else
							{ 
							?>SI</td><?php

							}

?>

					
						</tr>
		<?
		}
		?>
					<tr>
						<td align="center" width="752" colspan="9">
						<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</td>
					</tr>
						</table>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
				<table border="0" width="100%" id="table10" cellspacing="0" cellpadding="0">
					<tr>
						<td>
						<p align="center">&nbsp;<input type="submit" value="Justificados" name="submitx"></td>
						</table>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
			</div>
	
					<hr>
					</td>
				</tr>
				<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>


<input type="hidden" name="dni" value="<?php echo $dni?>">
</form>
 </td>

</div>

</body>

<?
	if (isset($_GET['submitx']))

{




foreach ($_GET["afectado"] as $afectado)
	{


		if (mysql_query ("UPDATE ausentes SET justificada=1 where codigo=$afectado"))
		{	
		
		}
	}
				?>
				<script>
				var answer=alert("Justificadas Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
				
}
?>
</html>
<? } ?>