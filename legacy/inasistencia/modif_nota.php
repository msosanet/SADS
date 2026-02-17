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

$resultt = mysql_query ("SELECT * FROM notasnuevo WHERE id = '$actor'");
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
<form method="GET" action="modif_nota.php?nota=<?php echo $actor?>">

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
</table>
				<br><br>
					
					<p align="center" class="text1b">Modificar Notas</p>
					<br>
					<div align="center">
					
					<table border="0" width="350" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
							<td width="60" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nota Nº:</td>
							<td bgcolor="#EAEAEA" width="100" align="left"><?echo $filatt['codigo']."/".$filatt['anio']; ?></td>
							<td width="60" bgcolor="#EAEAEA" align="right">GEN:</td></font>
							<td width="100" bgcolor="#EAEAEA" align="left"><input type="text" name="gen" size="15" maxlength="15" value="<?echo $filatt['gen']; ?>" /></td>
						</tr>
						
						<tr>
							<td width="60" bgcolor="#EAEAEA" align="right">Descripcion:</td></font>
							<td width="250" bgcolor="#EAEAEA" align="left" colspan=3>
							 <textarea name="descripcion" rows="5" cols="75" maxlength="500"><?php echo $filatt['descripcion']; ?></textarea>
							<!--<input type="text" name="descripcion" size="60" maxlength="500" value="<?echo $filatt['descripcion']; ?>" />-->
							</td>
							
						</tr>
										
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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
	$gen=$_GET['gen'];

	$consulta="UPDATE notasnuevo SET descripcion='$descripcion', agente='$agente', gen='$gen' where id='$actor'";
	//echo $consulta;
if (mysql_query ($consulta))
{	
				?>
				<script>
				var answer=alert("Datos Actualizados Correctamente")
				</script> 
						
						
						<? echo "<meta http-equiv='refresh' content='0; URL=ver_notas.php?descripcion=$descripcion&muestra2=+++Buscar+++'>";
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