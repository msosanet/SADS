<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<title>SID</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';

?>
<body>

<p>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo6 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo7 {font-size: 16px; font-weight: bold; color: #FF0000; }
-->
</style>

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$dni=$_GET["dni"];

$resultt = mysql_query ("SELECT * FROM alumno WHERE dni = $dni");
$filatt = mysql_fetch_array($resultt);

$resemp3 = mysql_query ("SELECT * FROM cursa where alumno=$dni and control=1");
$totemp3 = mysql_fetch_array($resemp3);

$errordoc = 0;

?>

<form method="POST" action="aluregu.php">
</p>
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
				<table border="0" width="980" cellspacing="0" cellpadding="0">
					<tr>
						
					</tr>
				</table>
				
				<p></div>
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
					
					<p align="left" class="text1b">Confeccionar Constancia de Alumno Regular</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<?echo $filatt['dni']; ?>
							</td>
					
							

							<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Alumno:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<?echo $filatt['apellido']; ?>, <?echo $filatt['nombre']; ?>

							</td>	
							
						</tr>

						
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">curso:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"><?=$totemp3['curso']; ?></td>												

							

							<td width="190" bgcolor="#EAEAEA" align="right">Divisi&oacute;n: 
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><?=$totemp3['divi']; ?></td>
							</td>
							

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Observaciones:</td>
							<td bgcolor="#EAEAEA" width="265" align="left" colspan="3"><textarea name="observaciones" cols="50" rows="5" value="" placeholder="Si no se escribe nada en este espacio la constancia se genera sin observaciones"/></textarea></td>
							</td>
						</td>

							
						</tr>
		

			
						<tr>
							
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Generar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						</table>
					</div>
					<p align="right">&nbsp;</div>
					<hr>
					</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
			</div>
		</tr>
	</table>
<input type="hidden" name="dni" value="<?echo $dni;?>">
	</form>
</div>
</body>
</html>
<? } ?>
