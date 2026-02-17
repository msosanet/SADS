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
<title>SID</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$dni=$_GET["actor"];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;




$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

?>
<body background="bgris.gif" >
<?
	$errordoc = 0;
	$hayerrores = 0;

  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos

	
}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="GET" action="baja_ina2.php?actor=<?php echo $dni?>">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Listado a dar de baja de &nbsp;<?echo $filadocente['apellido'];?>&nbsp;<?echo $filadocente['nombre'];?></p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
	
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>

					<p align="left">
</font>
 
<?






	$_pagi_sql="SELECT * FROM ausentes WHERE docente='$dni' order by fecha_desde";



$_pagi_cuantos=20;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>

</p>

 <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="9" height="40" align="left">
							&nbsp; Seleccione para borrar</td>
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
							<td bgcolor="#808080" width="80" align="center"  height="36">Borrar</td>								

							
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
							<td width="20" bgcolor="#EAEAEA" align="center"><input name="afectado[]" type="checkbox" value="<?php echo $fila2[codigo]?>"></td>
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
						<p align="center">&nbsp;<input type="submit" value="Borrar" name="submitx"></td>
						</table>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
			</div>
					<hr>
					</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
			</div>
		</tr>
<input name="actor" type="hidden" value ="<?php echo $dni ?>"/>
	</table>
	</form>
</div>
</body>
<?
}
else
{




foreach ($_GET["afectado"] as $afectado)
	{
		if (mysql_query ("DELETE from ausentes where codigo=$afectado"))
		{	
				
		}
	}
				?>
				<script>
				var answer=alert("horas borradas Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
				
}

?>

</html>
<? } ?>