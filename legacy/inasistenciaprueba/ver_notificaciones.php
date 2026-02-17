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

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Ver Notificaciones</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
?>

<body>

<form method="GET" action="ver_notificaciones.php?viejas=<?php echo $viejas?>">

<div align="center">

<table border="0" width="980" bgcolor="#F9F9F9">
	<tr>
		<td><div align="center">

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
$viejas=0;
?>
	</tr>
	<tr>
	<table border="0" width="905" cellpadding="5">
		<tr>
			<td><br><p class="titles1">Buscar Notificaci&oacute;n</p>
				
				
					<p>&nbsp;</p>
					<p>Ingrese texto de b&uacute;squeda: <input type="text" name="descripcion" id="descripcion" size="50" maxlength="50" value="" /><input type="submit" value="   Buscar   " name="muestra2"> <!-- style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" / --></p>
				<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">Buscar historial<p align="center">
							<input type="checkbox" name="viejas" value="1"></p>
					
					<!-- p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p -->
					<p align="left">&nbsp;</p>

<!-- /font -->
<?
$descripcion=$_GET['descripcion'];

	$historial=$_GET['viejas'];



if ($historial==1) $_pagi_sql="SELECT * FROM `notificaciones-2017` WHERE descripcion like '%$descripcion%' or codigo like '%$descripcion%' order by codigo DESC ";
else $_pagi_sql="SELECT * FROM notificaciones WHERE descripcion like '%$descripcion%' or codigo like '%$descripcion%' order by codigo DESC";

$_pagi_cuantos=20;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;

include("paginator.inc.php"); 
?>

<p class="titles1" align="left">

<?
echo "P&aacute;gina " . "$_pagi_navegacion"; 
?>
<!-- br><br -->
</p>
<p>&nbsp;</p>
		<div align="center">
		<table border="1" width="850" cellpadding="15" cellspacing="0" bordercolor="#C0C0C0">
				<tr>
					<td class="text1b" colspan="5" height="40" align="left">Resultado de la B&uacute;squeda</td>
				</tr>
				<tr>
					<td width="20" bgcolor="#808080" align="center" height="36">N&uacute;mero</td>
					<td bgcolor="#808080" width="400" align="center" height="36">Descripci&oacute;n</td>
					<td bgcolor="#808080" width="50" align="center" height="36">Registr&oacute;</td>
					<td bgcolor="#808080" width="50" align="center" height="36">Año;</td>
					<td bgcolor="#808080" width="50" align="center" height="36">Modificar</td>
				</tr>

<?php while ($fila2 = mysql_fetch_array($_pagi_result))
{	
?> 
				<tr>
					<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[codigo];?></td>
					<td width="20" bgcolor="#EAEAEA" align="left"><?echo $fila2[descripcion];?></td>
					<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[agente];?></td>
					<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[anio];?></td>
					<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="modif_notificacion.php?nota=<?php echo $fila2[codigo]?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Modificar Nota"></a></td>
				</tr>
<?
}
?>
		</table>
		</div>				
	</tr>
</table>
</div>
<p>&nbsp;</p>
<?
include 'footer.php';
?>

	</td>
	</tr>
</table>
</div>

</form>

</div>

</body>

</html>
<? } ?>
