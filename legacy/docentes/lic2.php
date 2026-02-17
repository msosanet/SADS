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
$actor=$_GET["actor"];

$resultt = mysql_query ("SELECT * FROM docente WHERE dni = '$actor'");
$filatt = mysql_fetch_array($resultt);

$suma=0;
$suma2=0;

$resultmotivo3 = mysql_query ("SELECT * FROM licencia order by codigo");


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
<form method="GET" action="lic2.php?actor=<?php echo $actor?>">

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
					
					<p align="left" class="text1b"><br>Asignar Licencias Especiales a: &nbsp;<?echo $filatt[apellido] ?>&nbsp;, <?echo $filatt[nombre] ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">				<div align="center">
		
<?
$result77 = mysql_query ("SELECT * FROM docente where dni='$actor'");
?>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
						<td align="center" width="200" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>DNI</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>DIRECCION</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>TEL</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>TRIBU</b></td>



					</tr>

		<?php while ($fila77 = mysql_fetch_array($result77))
		{ 

$resultb = mysql_query ("SELECT * FROM tribu where codigo=$fila77[tribu]");
$filab = mysql_fetch_array($resultb) ;
$resultz = mysql_query ("SELECT * FROM turno where codigo=$fila77[turno]");
$filaz = mysql_fetch_array($resultz) ;


?>
					<tr>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[dni];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[direccion];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[telefono];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filab[descripcion];?>
						</td>
	
					</tr>
		<?}?>

</table>



<br>
<b>Marque que MATERIAS se ven afectadas por la Licencia Especial</b><BR><BR>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
						<td align="center" width="20" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Codigo</b></td>
						<td align="center" width="200" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Curso</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Caracter</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Turno</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>HS</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Fecha alta</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Fecha baja</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Afectar</b></td>




					</tr>

		<?php 
$result78 = mysql_query ("SELECT * FROM materia_docente where docente=$actor order by fecha_baja,fecha_alta");
while ($fila78 = mysql_fetch_array($result78))
		{ 


$results = mysql_query ("SELECT * FROM materia where codigo=$fila78[materia]");
$filas = mysql_fetch_array($results) ;
$results2 = mysql_query ("SELECT * FROM caracter where codigo=$fila78[caracter]");
$filas2 = mysql_fetch_array($results2) ;
$results4 = mysql_query ("SELECT * FROM turno where codigo=$filas[turno]");
$filas4 = mysql_fetch_array($results4) ;

?>
					<tr>	<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila78[materia];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						<? if ($fila78[fecha_baja] == "0000-00-00")
								{ 
								if ($filas[codigo_cargo]==852) { $suma2=$suma+$filas[hs_consume]; } else  { $suma2=$suma2+1; }
									?><a href="materia2.php?actor=<?php echo $fila78[materia]?>" target="_blank"><font color="#ff0000"><? echo $filas[nombre];?> <? echo $filas[curso];?> <? echo $filas[div];?>
</font></href><?
								}
							else { 
								?><a href="materia2.php?actor=<?php echo $fila78[materia]?>" target="_blank"><font color="#000000"><? echo $filas[nombre];?> <? echo $filas[curso];?> <? echo $filas[div];?></font></href>
<?

							} ?>
							
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filas2[descripcion];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filas4[descripcion];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filas[hs_consume];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila78[fecha_alta];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila78[fecha_baja];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
						<? if ($fila78[fecha_baja]=="0000-00-00") { ?><input name="afectado[]" type="checkbox" value="<?php echo $fila78[materia]?>"><? } ?>

						</td>
						

	
	
					</tr>

		<?}?>

</table>



<br><br>

<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
						<td align="center" width="200" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Cant de Horas</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Cant de cargos</b></td>




					</tr>




					<tr>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $suma;?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $suma2;?>
						</td>

	
					</tr>
	
</table>

<br><br><br>
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="2">

						
											
						<tr>
						
					
					
							

						<td width="150" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha de alta:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="falta" id="falta" value="<?echo $_GET["falta"]?>" maxlength="10"/>
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
							
						</td>
						<td width="150" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha de baja:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="fbaja" id="fbaja" value="<?echo $_GET["fbaja"]?>" maxlength="10"/>
    							<img src="calendario.png" width="16" height="16" border="0" title="" id="fechas2">
							</td>
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"fbaja",       // id del campo de texto 
	    					ifFormat:"%d-%m-%Y",            // formato de la fecha que se escriba en el campo de texto 
						button:"fechas2"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>
							
						</td>

						</tr>

						<tr>
						<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Motivo:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
														<select size="1" name="motivo">
							<?	WHILE ($myrow6 = mysql_fetch_array($resultmotivo3))
							{			
								if($_POST['motivo']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
								echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion]</option>";
							}
							?></select>
							</td>
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Detalles:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><input type="text" name="descripcion" size="30" maxlength="50" value="<?echo $_GET['descripcion']; ?>" />


							</td>

						</tr>
			
						<tr>
							
						</tr>
						<tr>
							<td width="834" align="left" colspan="4">
							<p align="center"><input type="submit" value="Asignar Licencia Especial" name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /><br><br></td>
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


<input name="materin" type="hidden" value ="<?php echo $materia ?>"/>
<input name="actor" type="hidden" value ="<?php echo $actor ?>"/>
</form>
 </td>

</div>

</body>
<?
}
else
{

	$falta=$_GET['falta'];
	$fbaja=$_GET['fbaja'];

	$fec = explode("-", $falta);
	$falta=$fec[2]."-".$fec[1]."-".$fec[0];

	$fec2 = explode("-", $fbaja);
	$fbaja=$fec2[2]."-".$fec2[1]."-".$fec2[0];

	$motivo=$_GET['motivo'];
	$descripcion=$_GET['descripcion'];





foreach ($_GET["afectado"] as $afectado)
	{

		if (mysql_query ("INSERT INTO licencia_docente VALUES ($afectado,'$actor','$falta','$fbaja',$motivo,'$descripcion','-','0000-00-00')"))
		{	
				
		}
	}
				?>
				<script>
				var answer=alert("Licencia agregada correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
}
	

?>
</html>
<? } ?>