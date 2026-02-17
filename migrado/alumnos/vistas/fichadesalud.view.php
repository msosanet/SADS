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

$materia=$_GET["materia"];

$resultdocente = mysql_query ("SELECT * FROM materias where id=$materia");
$filadocente = mysql_fetch_array($resultdocente); 

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

<form method="GET" action="calificador2.php?curso=<? echo $curso; ?>&divi=<? echo $divi; ?>">
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
					
					<p align="left" class="text1b">Cargar notas a los alumnos</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="8">

												<tr>
							<td colspan="8" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Materia: <b><?echo $filadocente['materia']; ?></b> </td>
						</tr>
						<tr>
	
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Otitis:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
								<SELECT NAME="otitis"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Tos convulsa:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="tos_convulsa"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>
							<td width="190" bgcolor="#EAEAEA" align="right">Hernias:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="hernias"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>
							<td width="190" bgcolor="#EAEAEA" align="right">Diabetes:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="diabetes"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>

							
						</tr>

						<tr>
	
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Celiaco:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
													<SELECT NAME="celiaco"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Bronquitis:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="bronquitis"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>
							<td width="190" bgcolor="#EAEAEA" align="right">Asma:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="asma"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>
							<td width="190" bgcolor="#EAEAEA" align="right">Reumatismo:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="reumatismo"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>

							
						</tr>
					<tr>
	
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">epilepsia:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
													<SELECT NAME="epilepsia"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Meningitis:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="meningitis"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>
							<td width="190" bgcolor="#EAEAEA" align="right">Cardiopatia:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="cardio"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>
							<td width="190" bgcolor="#EAEAEA" align="right">Sinusitis:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="sinusitis"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>

							
						</tr>

					<tr>
	
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Problemas de tiroides:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
													<SELECT NAME="tiroides"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Hepatitis:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="hepatitis"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>
							<td width="190" bgcolor="#EAEAEA" align="right">Alteraciones de la columna:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="alteraciones_columna"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>
							<td width="190" bgcolor="#EAEAEA" align="right">Problemas Neurologicos:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="neurologicos"> 
  							 	<OPTION VALUE="0">No</OPTION> 
   								<OPTION VALUE="1">Padece</OPTION> 
   								<OPTION VALUE="2">Padecio</OPTION> 
							</SELECT> 
							</td>

							
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">Otras:
							<input type="text" name="otras" size="130" maxlength="200" value="<?echo $_GET['otras'];?>" /></td>
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8"><B>ANTECEDENTES DE INTERES SOBRE EL ALUMNO</B>
							</td>
						</tr>
						<tr>
						

						</tr>

						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">¿Se encuentra actualmente bajo tratamiento medico?, ¿cual?:
							<input type="text" name="tratamiento_medico" size="80" maxlength="200" value="<?echo $_GET['tratamiento_medico'];?>" /></td>
						</tr>
				<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">¿Toma alguna medicacion?, ¿cual?:
							<input type="text" name="medicacion" size="85" maxlength="200" value="<?echo $_GET['medicacion'];?>" /></td>
						</tr>
				<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">¿Operaciones?:
							<input type="text" name="operaciones" size="85" maxlength="200" value="<?echo $_GET['operaciones'];?>" /></td>
						</tr>
				<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">Traumatismos/fracturas:
							<input type="text" name="fracturas" size="85" maxlength="200" value="<?echo $_GET['fracturas'];?>" /></td>
						</tr>
				<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">¿Tiene problemas de coagulacion?:
							<input type="text" name="coagulacion" size="85" maxlength="200" value="<?echo $_GET['coagulacion'];?>" /></td>
						</tr>
				<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">¿Usa anteojos?:
							<input type="text" name="anteojos" size="85" maxlength="200" value="<?echo $_GET['anteojos'];?>" /></td>
						</tr>
				<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">¿Alergias?:
							<input type="text" name="alergias" size="85" maxlength="200" value="<?echo $_GET['alergias'];?>" /></td>
						</tr>
				<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">¿Curso o cursa algun embarazo?:
							<input type="text" name="embarazo" size="85" maxlength="200" value="<?echo $_GET['embarazo'];?>" /></td>
						</tr>
				<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">Ingrese el grupo sanguineo y factor:
							<input type="text" name="gsanguineo" size="85" maxlength="200" value="<?echo $_GET['gsanguineo'];?>" /></td>
						</tr>
				<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">¿Tiene hijos?, ¿cuantos?, ¿edades?:
							<input type="text" name="hijos" size="85" maxlength="200" value="<?echo $_GET['hijos'];?>" /></td>
						</tr>
				<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">¿Tiene certificado de discapacidad?:
							<input type="text" name="disca" size="85" maxlength="200" value="<?echo $_GET['discapacidad'];?>" /></td>
						</tr>

						
						<tr>
						

						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="8">
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
<input type="hidden" name="dni" value="<?echo $dni;?>">

	</form>
</div>
</body>
<?
}
else
{





	$dni=$_GET['dni'];
	$otitis=$_GET['otitis'];
	$celiaco=$_GET['celiaco'];
	$epilepsia=$_GET['epilepsia'];
	$tiroides=$_GET['tiroides'];
	$tos_convulsa=$_GET['tos_convulsa'];
	$bronquitis=$_GET['bronquitis'];
	$meningitis=$_GET['meningitis'];
	$hepatitis=$_GET['hepatitis'];
	$hernias=$_GET['hernias'];
	$asma=$_GET['asma'];
	$cardio=$_GET['cardio'];
	$alteraciones_columna=$_GET['alteraciones_columna'];
	$diabetes=$_GET['diabetes'];
	$reumatismo=$_GET['reumatismo'];
	$sinusitis=$_GET['sinusitis'];
	$neurologicos=$_GET['neurologicos'];
	$otras=$_GET['otras'];
	$tratamiento_medico=$_GET['tratamiento_medico'];
	$medicacion=$_GET['medicacion'];
	$operaciones=$_GET['operaciones'];
	$fracturas=$_GET['fracturas'];
	$coagulacion=$_GET['coagulacion'];
	$anteojos=$_GET['anteojos'];
	$alergias=$_GET['alergias'];
	$embarazo=$_GET['embarazo'];
	$gsanguineo=$_GET['gsanguineo'];
	$hijos=$_GET['hijos'];
	$disca=$_GET['disca'];
	$now=date("Y-m-d");




	if (mysql_query ("INSERT INTO ficha_salud VALUES (0,$dni,'$now',$otitis,$celiaco,$epilepsia,$tiroides,$tos_convulsa,$bronquitis,$meningitis,$hepatitis,$hernias,$asma,$cardio,$alteraciones_columna,$diabetes,$reumatismo,$sinusitis,$neurologicos,'$otras','$tratamiento_medico','$medicacion','$operaciones','$fracturas','$coagulacion','$anteojos','$alergias','$embarazo','$gsanguineo','$hijos','$disca')"))
	{		

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=ficha2.php?dni=<?php echo $dni?>'>
				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD, puede que ya exista en la Base")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
		}
					
}

?>
</html>
<? } ?>
