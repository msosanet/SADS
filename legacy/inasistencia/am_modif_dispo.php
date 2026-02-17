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
$actor=$_GET["nota"];

// Si está establecida la variable $anio modifica una dispoosición del año especificado diferente del año en curso
if (!isset($_GET["anio"])) {
	$anio=date(Y);
	$bd_a_modif="dispo";
}
elseif ($_GET["anio"]<>date(Y)) {
	$anio=$_GET["anio"];
	$bd_a_modif="`dispo-2017`";
} else {
	$anio=date(Y);
	$bd_a_modif="dispo";
}

$resultt = mysql_query ("SELECT * FROM $bd_a_modif WHERE codigo = '$actor' AND anio = '$anio'");
$filatt = mysql_fetch_array($resultt);

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
<form method="GET" action="am_modif_dispo.php?nota=<?php echo $actor . "&amp;anio=" . $anio;?>">

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
					
					<p align="left" class="text1b">Modificar Disposiciones <?echo $anio?></p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">				<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						

							<td width="90" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">N&uacute;mero de Disposici&oacute;n:</td>
							<td bgcolor="#EAEAEA" width="88" align="center">
								<?echo $actor; ?>
							</td>
					
							
						<?
	  					if ($errordes==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="90" bgcolor="#EAEAEA" align="right">Descripci&oacute;n:
							</td></font>
							<td width="610" bgcolor="#EAEAEA" align="left">
							<input type="text" name="descripcion" size="60" maxlength="60" value="<?echo $filatt['descripcion']; ?>" />
							</td>
							
						</tr>
					
						
							

							
<!--							
						<tr>
					
							<td width="190" bgcolor="#EAEAEA" align="right">
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
												</td>

							
						</tr>
-->
			
						<tr>
							
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
<!--						
						<tr>
								<td width="100%">
									<a href="ver_dispo.php?descripcion=<?php echo urlencode($filatt['descripcion']); ?>&amp;<?php  if ($anio!=date(Y)) echo "viejas=1&amp;"; ?>muestra2=+++Buscar+++">Enlace prueba ver dispo</a>
								</td>
						</tr>
-->															
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
<input type="hidden" name="anio" value="<?echo $anio;?>">
</form>
 </td>

</div>

</body>
<?
}
else
{

	$descripcion=$_GET['descripcion'];

//				echo "<p>mysql_query (UPDATE " . $bd_a_modif . "SET descripcion='" . $descripcion . "', agente='" . $agente . "' WHERE codigo='" . $actor . "' AND anio = '" . $anio . "'</p>";

//if (1)
if (mysql_query ("UPDATE $bd_a_modif SET descripcion='$descripcion', agente='$agente' WHERE codigo='$actor' AND anio = '$anio'"))
{	

				?>
				<script>
				var answer=alert("Datos Actualizados Correctamente")
				</script>
				<!-- <meta http-equiv='refresh' content='0; URL=menu.php?'>
				-->
				<meta http-equiv='refresh' content='0; URL=ver_dispo.php?descripcion=<?php echo urlencode($filatt['descripcion']); ?>&amp;<?php  if ($anio!=date(Y)) echo "viejas=1&amp;"; ?>muestra2=+++Buscar+++'>
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