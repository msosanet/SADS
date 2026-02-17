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

$resultt = mysql_query ("SELECT * FROM actopublico WHERE id = $actor");
$filatt = mysql_fetch_array($resultt);

$usuario=$_SESSION['usuario'];

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario);
$agente=$filausuario["nombre"];
$resulttipo = mysql_query ("SELECT * FROM tipoentrada order by descripcion asc ");



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

<body background="bgris.gif" >
<form method="GET" action="editar_acto.php?id=<?php echo $actor?>">

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

					<p align="left" class="text1b">Modificar Acto Público </p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
					</p><div align="left"><div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						<tr>

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Llamado:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<?echo $filatt['numero']; ?>
							</td>
					
							
							<td width="190" bgcolor="#EAEAEA" align="right">Materia:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<?echo $filatt['materia']; ?>
							</td>
							
						</tr>

						<tr>
	

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Estado:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="estado" size="30" maxlength="30" value="<?echo $filatt['estado']; ?>" />
							</td>
					
							
							<td width="190" bgcolor="#EAEAEA" align="right">Fecha Alta:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<input type="text" name="fecha" size="10" maxlength="10" value="<?echo $filatt['alta']; ?>" />
							</td>
							
						</tr>
						<tr>
>

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Dni:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="dni" size="30" maxlength="30" value="<?echo $filatt['dni']; ?>" />
							</td>
					
							
							<td width="190" bgcolor="#EAEAEA" align="right">Apellido:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<input type="text" name="apellido" size="60" maxlength="60" value="<?echo $filatt['apellido']; ?>" />
							</td>
							
						</tr>
						<tr>
	

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="nombre" size="30" maxlength="30" value="<?echo $filatt['nombre']; ?>" />
							</td>
					
							
							<td width="190" bgcolor="#EAEAEA" align="right">Telefono:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<input type="text" name="tel" size="60" maxlength="60" value="<?echo $filatt['tel']; ?>" />
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


<input type="hidden" name="id" value="<?echo $actor;?>">
</form>
 </td>

</div>

</body>
<?
}
else
{

	$estado=$_GET['estado'];
	$alta=$_GET['fecha'];
	$dni=$_GET['dni'];
	$apellido=$_GET['apellido'];
	$nombre=$_GET['nombre'];
	$tel=$_GET['tel'];
	$actor=$_GET[id];






if (mysql_query ("UPDATE actopublico SET estado='$estado', alta='$alta' , dni='$dni', apellido='$apellido' , nombre='$nombre', tel='$tel' where id=$actor"))
{	
				?>
				<script>
				var answer=alert("Datos Actualizados Correctamente")
				</script> 
						<meta http-equiv='refresh' content='0; URL=menu.php?'>
						<? 
}
				else {	
				printf("el actor es:",$actor);
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
