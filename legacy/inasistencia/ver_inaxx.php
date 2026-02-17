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
$dni = $_GET["actor"];

$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass = '$pass'");
$filatt = mysql_fetch_array ($resultt);
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
    
    $fecha = $fecha_desde;
	$invert = explode("-",$fecha); 
	$fecha_invert1 = $invert[2]."-".$invert[1]."-".$invert[0]; 
	
	$fecha2 = $fecha_hasta;
	$invert2 = explode("-",$fecha2); 
	$fecha_invert2 = $invert2[2]."-".$invert2[1]."-".$invert2[0];
	$dni=$_GET["dni"];

	$_pagi_sql="SELECT * FROM ausentes WHERE fecha_desde >='$fecha_desde'  and fecha_hasta <= '$fecha_hasta' and docente = '$dni' order by fecha_desde";

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
<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<!-- tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="8" height="40" align="left">
							&nbsp;Resultado del Filtro</td>
						</tr -->	
                        <!-- ********************************* -->

<?
$resultdocente = mysql_query ("SELECT * FROM docentes WHERE dni = '$dni'");
$filadocente = mysql_fetch_array ($resultdocente);                         
?>                        
                        
                        <tr>
							<td class="text1b" colspan="6" height="40" align="left" colspan="8">
							Resultado del Filtro del <font color="#D08230"><? echo $fecha_invert1 . " al " . $fecha_invert2; ?></font><br>
                            Docente: <font color="#D08230"><? echo $filadocente[apellido] . ", " . $filadocente[nombre]; ?></font>
                            </td>
						</tr>	
                        <!-- ********************************* -->
                        <tr bgcolor="#cccccc" align="center" height="30">
							<!-- td width="200">Docente</td -->
							<td width="80">Fecha</td>
							<!-- td width="80">Fecha Hasta</td -->
							<!-- tdwidth="70">Hora</td-->
							<td width="200">Motivo</td>
							<td width="350">Observaciones</td>
							<td width="60">Notific&oacute;</td>
							<td width="80">F_Notif</td>
							<td width="50">Justific</td>
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
			$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila2[docente]' ");
			$filaobs = mysql_fetch_array($resultobs);
			$resultmot = mysql_query ("SELECT * FROM motivos WHERE codigo = '$fila2[motivo]' ");
			$filamot = mysql_fetch_array($resultmot);
		?> 

						<tr bgcolor="eaeaea">
							<!-- td align="center"><? //echo $filaobs[apellido] . ", " . $filaobs[nombre];?></td -->
							<td align="center"><?echo $fila2[fecha_desde];?></td>
							<!-- td align="center"><? //echo $fila2[fecha_hasta];?></td -->
							<!-- td width="20" bgcolor="#EAEAEA" align="center"><!-- ?echo $fila2[hora];? --></td -->
							<td align="center"><?echo $filamot[descripcion];?></td>
							<td align="center"><?echo $fila2[observaciones];?></td>
							<td align="center"><?echo $fila2[notifico];?></td>
							<td align="center"><?echo $fila2[f_notif];?></td>
							<td align="center">
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
						<p align="center">&nbsp;<input type="submit" value="   Justificados   " name="submitx"></td>
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