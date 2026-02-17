<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

//esto pasa las mayusculas acentuadas a minusculas acentuadas
function strtolowerExtended($str)
{
        $low = array(chr(193) => chr(225), //á
                    chr(201) => chr(233), //é
                    chr(205) => chr(237), //í­
                   chr(211) => chr(243), //ó
                   chr(218) => chr(250), //ú
                  chr(220) => chr(252), //ü
                    chr(209) => chr(241)  //ñ
                    );
 
      return strtolower(strtr($str,$low)); 
} 


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
$materia=$_GET['materia'];


$rr = mysql_query ("SELECT * FROM materia where codigo=$materia");
$rr = mysql_fetch_array($rr);
$materias=$rr[nombre];

$r2 = mysql_query ("SELECT * FROM materia_docente where materia=$materia order by fecha_baja");


$resultmotivo2 = mysql_query ("SELECT * FROM docente where numero=1 order by apellido");
$resultmotivo3 = mysql_query ("SELECT * FROM caracter order by codigo");


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

<form method="POST" action="alta_matdoc.php">
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
					<p align="left" class="text1b">Asignaci�n de <?php echo $rr[nombre]; ?> <?php echo $rr[curso]; ?> <?php echo $rr[div]; ?> a Docentes</p> <br>

					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
<br>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
							<td width="200" bgcolor="#808080" align="center" height="36">Docente</td>
							<td bgcolor="#808080" width="20" align="center" height="36">Caracter</td>
							<td bgcolor="#808080" width="20" align="center" height="36">Alta</td>
							<td bgcolor="#808080" width="50" align="center" height="36">Baja</td>
						

							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($r2))
		{

		$resultz = mysql_query ("SELECT * FROM docente WHERE dni = '$fila2[docente]'");
		$filaz = mysql_fetch_array($resultz) ;
		$resultx = mysql_query ("SELECT * FROM caracter WHERE codigo = '$fila2[caracter]'");
		$filax = mysql_fetch_array($resultx) ;
		$fecha1=explode("-",$fila2[fecha_alta]);
		$fecha1=$fecha1[2]."-".$fecha1[1]."-".$fecha1[0];
		$fecha2=explode("-",$fila2[fecha_baja]);
		$fecha2=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];
		if ($fecha2=="00-00-0000") {$color="#FF0000";
						$fecha2="Contin�a";
						$b="<b>";
						$nob="</b>";
						}
		else				{
						$color="#000000";
						$b="";
						$nob="";
						}
					
		?> 

						<tr>
							<td width="200" bgcolor="#EAEAEA" align="center"><?echo $filaz[apellido];?>, <?echo $filaz[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filax[descripcion];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fecha1;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><font color="<?echo $color;?>"><?echo $b;?><?echo $fecha2;?><?echo $nob;?></font></td>
	
						</tr>
						<?
						}
						?>
						</table>


<br><br><br>
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Docente (solo docentes en estado Activo):</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
														<select size="1" name="docente">
							<?	WHILE ($myrow6 = mysql_fetch_array($resultmotivo2))
							{			
								if($_POST['docente']==$myrow6[dni]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
								echo "<option value=$myrow6[dni] $seleccionado> $myrow6[apellido],$myrow6[nombre] </option>";
							}
							?></select>
							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Materia:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<b><?php echo $materias; ?></b>
							</td>
							
						</tr>
											
						<tr>
						
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Caracter:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
														<select size="1" name="caracter">
							<?	WHILE ($myrow6 = mysql_fetch_array($resultmotivo3))
							{			
								if($_POST['caracter']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
								echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion]</option>";
							}
							?></select>
							</td>
					
							

						<td width="150" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha de alta:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="falta" id="falta" value="<?echo $_POST["falta"]?>" maxlength="10"/>
    							<img src="calendario.png" width="16" height="16" border="0" title="" id="fechas1">
							</td>
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"falta",       // id del campo de texto 
	    					ifFormat:"%d-%m-%Y",            // formato de la fecha que se escriba en el campo de texto 
						button:"fechas1"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>
							
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
<input name="materin" type="hidden" value ="<?php echo $materia ?>"/>
	</form>
</div>
</body>
<?
}
else
{
	$materia=$_POST['materin'];
	$docente=$_POST['docente'];
	$caracter=$_POST['caracter'];
	$baja="0000-00-00";
	$falta=$_POST['falta'];
	$fec = explode("-", $falta);
	$falta=$fec[2]."-".$fec[1]."-".$fec[0];
	if (mysql_query ("INSERT INTO materia_docente VALUES ($materia,'$docente',$caracter,'$falta','$baja',0)"))
	{

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=buscar_mat.php?'>
				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=buscar_mat.php?'>
				<? 
	}
}
	

?>
</html>
<? } ?>