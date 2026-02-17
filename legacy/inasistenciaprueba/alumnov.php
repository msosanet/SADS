<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion5.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>DATOS DEL Alumno</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$actor=$_GET["dni"];

//echo $actor;
$consulta="SELECT * FROM alumno WHERE dni='$actor'";
//echo $consulta;
$resultt = mysql_query ($consulta);
$filatt = mysql_fetch_array($resultt);




?>

<body background="bgris.gif" >
<form method="GET" action="alumnov.php?dni=<? echo $actor; ?>">

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
include 'menuppal3.php'; //preceptor
}
?>
				<tr>
				

					<td>
					
					<BR><p align="left" class="text1b">DATOS DE CONTACTO DEL ALUMNO</p><BR>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">				<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="2" cellspacing="4">

						<tr>
						<td width="190" bgcolor="#EAEAEA" align="center" colspan=5><font size=5 color="<?echo $color;?>"><?echo $filatt['apellido']." ".$filatt['nombre'];?></td></font>
						</tr>

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							Direccion:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="direccion" size="30" maxlength="30" value="<?echo $filatt['domicilio'];?>" /></td>
							</td>
													
						</tr>
						<tr>
							<td width="190" bgcolor="#EAEAEA" align="right">
							E-mail:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="mail" size="50" maxlength="50" value="<?echo $filatt['mail'];?>" /></td>
							</td>
							
							
							</td>
						</tr>
										
						<tr>
						<?
	  					if ($errortelefono==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>


							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							Tel&eacute;fono:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="tel" size="30" maxlength="30" value="<?echo $filatt['tel'];?>" /></td>
							</td>
							
																						
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						<input type="hidden" name="dni" value="<?php echo $actor?>">
						<input type="hidden" name="apellidox" value="<?php echo $filatt['apellido'];?>">
						<input type="hidden" name="nombrex" value="<?php echo $filatt['nombre'];?>">

					</table>
						</form>
				

</html>
<? 



if (isset($_GET['submitx']))
{ 
$actor=$_GET['dni'];
$domicilio=$_GET['direccion'];
$mail=$_GET['mail'];
$tel=$_GET['tel'];
$apellido=$_GET['apellidox'];
$nombre=$_GET['nombrex'];

$sql="UPDATE alumno SET domicilio='$domicilio',mail='$mail',tel='$tel' WHERE dni='$actor'";
//echo $sql;
			if(mysql_query ($sql))
				{?>
				<script>
					var answer=alert("Datos del alumno modificados")
				</script> 
					<meta http-equiv='refresh' content='0; URL=veo_alumno.php?alumno=<? echo $apellido; ?>&muestra2=+++Buscar+++'>
				<?}
				else
				{?>
				<script>
					var answer=alert("No se pudieron modificar los datos.")
				</script> 
					
				<?}
			
}






} ?>