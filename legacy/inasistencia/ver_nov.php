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
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
?>

<body>

<?
$errordoc = 0;
$hayerrores = 0;
$flag = 0;
if (isset($_GET["submitx"])) {

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {

?>

<form method="GET" action="ver_nov.php">

<div align="center">
	<table border="0" width="980">
		<tr>
			<td>

<!-- ++++++++++++++++++++++++++++++++ BARRA DE MENUS +++++++++++++++++++++++ -->
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
<!-- ++++++++++++++++++++++++++++++++ FIN BARRA DE MENUS +++++++++++++++++++++++ -->
<div align="center">
			<table border="0" width="980">
				<tr>
					<td>
					<p class="titles1" align="left">Listado de novedades de alumnos - Modificar</p>
 
<?
$_pagi_sql="SELECT * FROM novedades where borrado=1 ORDER BY codigo DESC";

$_pagi_cuantos=20000;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 

echo"$_pagi_navegacion"; 
?>
<br><br>

<div align="center">
	<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr height="36" bgcolor="#AAAAAA" >
							<td width="20"align="center">ID</td>
							<td width="200"align="center">ALUMNO</td>
							<td width="20"align="center">CURSO</td>
							<td width="400" align="center">NOVEDAD</td>
							<td width="30" align="center">FECHA</td>
							<td width="60" align="center">NOTIFIC&Oacute;</td>
							<td width="20" align="center">ESTADO</td>
							<td width="20" align="center">CAMBIAR EST.</td>								

							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	


		?> 

						<tr bgcolor="#FFFFFF">
							<td align="center"><?echo $fila2[codigo];?></td>
							<td align="center"><?echo $fila2[alumno];?></td>
							<td align="center"><?echo $fila2[curso];?></td>
							<td align="left"><?echo $fila2[novedad];?></td>
							<td align="center"><?echo $fila2[fecha];?></td>
							<td align="center"><?echo $fila2[grabo];?></td>
							<td align="center">Publicado</td>							
    			<td align="center"><input name="afectado[]" type="checkbox" value="<?php echo $fila2[codigo]?>"></td>
						</tr>
						<?
						}
						?>

			</table>
</div>

				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
							<table border="0" width="100%" id="table10" cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<p align="center">&nbsp;<input type="submit" value="Modificar" name="submitx">
									</td>
								</tr>	
							</table>
							<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
							</div>
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
		if (mysql_query ("update novedades set borrado=0 where codigo=$afectado"))
		{	
				
		}
	}
				?>
				<script>
				var answer=alert("modificado Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
				
}

?>


</html>
<? } ?>



