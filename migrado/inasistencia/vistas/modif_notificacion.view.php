<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<!-- link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<link rel="shortcut icon" href="../imag/favicon.ico" -->

<title>NOTIFICACIONES</title>

</head>

<?
include 'header.php';

$conexion = conectar ();
$actor=$_GET["nota"];
$resultt = mysql_query ("SELECT * FROM notificaciones WHERE id = '$actor'");
$filatt = mysql_fetch_assoc($resultt);
$usuario=$_SESSION['usuario'];
$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario);
$agente=$filausuario["nombre"];
$hayerrores = 0;
$flag = 0;

if (isset($_GET["submitx"])) {
     // verifico los errores en los campos

if (trim($_GET["descripcion"]) == '' ) { $errordes = 1; $hayerrores = 1; }
}
else
{
$flag = 1;
}
  
if ($hayerrores OR $flag) {

?>

<body background="bgris.gif" >
<form method="GET" action="modif_notificacion.php?nota=<?php echo $actor?>">
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
			<table border="0" width="960">
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
				

					<td><br>
						<p align="left" class="titles1">Modificar Notificaciones</p><br>
						<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?></p>

		<div align="left">
					<div align="center">
						<table border="0" id="table1" cellpadding="4" cellspacing="2">
							<tr height="30">
								<td width="120" bgcolor="#EAEAEA" align="center"><font color="<?echo $color;?>">Notificaci&oacute;n Nº: </td>
								<td bgcolor="#EAEAEA" width="50" align="center"><?=$filatt['codigo']?>/<?=$filatt['anio']?></td>
								
<?
if ($errordes==1) {$color="#FF0000";
	}
	else{$color="#000000";
	}
?>
							<td width="120" bgcolor="#EAEAEA" align="center">Descripcion: </td></font>
							<td bgcolor="#EAEAEA" align="left"><input type="text" name="descripcion" size="70" maxlength="60" value="<?=$filatt['descripcion']?>" /></td>
						</tr></font>
						<tr height="30">
							<td bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx"> <!-- style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" / --></td>
						</tr>
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


<input type="hidden" name="nota" value="<?echo $actor;?>">
</form>
 </td>

</div>

</body>
<?
}
else
{

	$descripcion=$_GET['descripcion'];



if (mysql_query ("UPDATE notificaciones SET descripcion='$descripcion', agente='$agente' where id='$actor'"))
{	
				?>
				<script>
				var answer=alert("Datos Actualizados Correctamente")
				</script> 
						<meta http-equiv='refresh' content='0; URL=menu.php?'>
						<? 
}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
					}					


}

?>
</html>
<? } ?>

