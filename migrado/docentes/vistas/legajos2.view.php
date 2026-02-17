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
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>
<title>SIDOS</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';
?>
<body background="bgris.gif" >

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
$dni=$_GET['dni'];


$rr = mysql_query ("SELECT * FROM docente where dni='$dni'");
$rr = mysql_fetch_array($rr);

$r2 = mysql_query ("SELECT * FROM legajo where dni='$dni' order by legajo");

$r1 = mysql_query ("SELECT * FROM tipo order by codigo");


$dni=$rr['dni'];

$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos




}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="legajos2.php">
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
					<br>
					<p align="left" class="text1b">Asignación de Nº legajo a <?php echo $rr[apellido]; ?>, <?php echo $rr[nombre]; ?></p> <br>

					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
<br>
<table border="1" width="500" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
							<td width="80" bgcolor="#808080" align="center" height="36">Legajo</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Tipo</td>
							<td bgcolor="#808080" width="30" align="center" height="36">Cargo</td>
						</tr>

		<?php while ($fila2 = mysql_fetch_array($r2))
		{

		$resultz = mysql_query ("SELECT * FROM tipo WHERE codigo = $fila2[tipo]");
		$filaz = mysql_fetch_array($resultz) ;

					
		?> 

						<tr>
							<td width="80" bgcolor="#EAEAEA" align="center"><?echo $fila2[legajo];?></td>
							<td width="80" bgcolor="#EAEAEA" align="center"><?echo $filaz[descripcion];?></td>
							<td width="30" bgcolor="#EAEAEA" align="center"><?echo $fila2[cargo];?></td>

	
						</tr>
						<?
						}
						?>
						</table>
<br><br><br>
	
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

					
						<tr>
						
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Tipo:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
														<select size="1" name="tipo">
							<?	WHILE ($myrow6 = mysql_fetch_array($r1))
							{			
								if($_POST['tipo']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
								echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion]</option>";
							}
							?></select>
							</td>

						<td width="150" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nº Legajo:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="legajo" value="<?echo $_POST["legajo"]?>" maxlength="2" size="2"/>
    							</td>

						</tr>

						<tr>
						
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Cargo:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><input type="text" name="cargo" value="<?echo $_POST["cargo"]?>" maxlength="3" size="3"/>

														
							</td>

						<td width="150" bgcolor="#EAEAEA" align="right"></td>
						
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							
    							</td>

						</tr>

			
						<tr>
							
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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
	 <input type="hidden" name="dni" value="<?php echo $rr[dni]; ?>">.
	</form>
</div>
</body>
<?
}
else
{
	$dni=$_POST['dni'];
	$legajo=$_POST['legajo'];
	$tipo=$_POST['tipo'];
	$cargo=$_POST['cargo'];


	if (mysql_query ("INSERT INTO legajo VALUES ('$dni','$legajo',$tipo,$cargo)"))
	{
				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=legajos.php?'>
				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=legajos.php?'>
				<? 
		}

				
}

?>
</html>
<? } ?>
