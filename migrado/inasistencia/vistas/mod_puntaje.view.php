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
$codigo=$_GET["codigo"];
$id=$_GET["id"];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;




$resultdocente = mysql_query ("SELECT * FROM tomas where id='$dni'");
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

<form method="GET" action="mod_puntaje.php?actor=<?php echo $dni?>&codigo=<?php echo $codigo?>&id=<?php echo $id?>">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Puntaje a modificar de &nbsp;<?echo $filadocente['apellido'];?>&nbsp;<?echo $filadocente['nombre'];?></p>
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






	$_pagi_sql="SELECT * FROM tomas WHERE id='$dni'";



$_pagi_cuantos=2000;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
//echo"$_pagi_navegacion"; 
?>

</p>
<!-- +++++++++++ EMPIEZA FORMULARIO Y TABLA +++++++++++++++++ -->


 <table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">DNI</td>
							<td bgcolor="#808080" width="40" align="center" height="36">Apellido</td>
							<td bgcolor="#808080" width="40" align="center"  height="36">Nombre</td>
							<td bgcolor="#808080" width="10" align="center"  height="36">Letra</td>
							<td bgcolor="#808080" width="10" align="center"  height="36">Puntaje</td>


							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	

		?> 

						<tr>
							<td bgcolor="#EAEAEA" align="left"><?echo $fila2[dni];?></td>
							<td bgcolor="#EAEAEA" align="center"><input type="text" name="apellido" size="20" maxlength="20" value="<?echo $fila2[apellido];?>" /></td>
							<td bgcolor="#EAEAEA" align="left"><input type="text" name="nombre" size="20" maxlength="20" value="<?echo $fila2[nombre];?>" /></td>
							<td bgcolor="#EAEAEA" align="left"><input type="text" name="letra" size="5" maxlength="5" value="<?echo $fila2[letra];?>" /></td>
							<td bgcolor="#EAEAEA" align="center"><input type="text" name="puntaje" size="10" maxlength="10" value="<?echo $fila2[puntaje];?>" /></td>
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
						<p align="center">&nbsp;<input type="submit" value="Modificar" name="submitx"></td>
						</table>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
			</div>
					<hr>
					</td>
				</tr>

<!-- +++++++++++++++ FRANJA GRIS EN PIE DE PÁGINA ++++++++++++++ -->
				<?
include 'footer.php';
?>
			</table>
			</div>
		</tr>
<input name="actor" type="hidden" value ="<?php echo $dni ?>"/>
<input name="codigo" type="hidden" value ="<?php echo $codigo ?>"/>
<input name="id" type="hidden" value ="<?php echo $id ?>"/>
	</table>
	</form>
</div>
</body>
<?
}
else
{


$dni=$_GET["actor"];
$codigo=$_GET["codigo"];

$letra=$_GET["letra"];
$puntaje=$_GET["puntaje"];
$apellido=$_GET["apellido"];
$nombre=$_GET["nombre"];






	
		if (mysql_query ("update tomas set letra='$letra', puntaje=$puntaje, nombre='$nombre', apellido='$apellido' where id=$dni"))
		{	
				
		
	
				?>
				<script>
				var answer=alert("modificado Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=postulante_aux2.php?nota=<?php echo $codigo?>&id=<?php echo $id?>'>
				<? 
				}
}

?>

</html>
<? } ?>
