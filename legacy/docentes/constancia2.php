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

$result99 = mysql_query ("SELECT * FROM licencia_docente WHERE docente='$actor'  order by fecha_desde desc");
$result90 = mysql_query ("SELECT * FROM lic_fox WHERE docente='$actor'  order by desde desc");



$hayerrores = 0;

  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos

	 if (trim($_GET["apellido"]) == '' ) { $errorapellido = 1; $hayerrores = 1; }
	 if (trim($_GET["nombre"]) == '' ) { $errornombre = 1; $hayerrores = 1; }
	 if (trim($_GET["direccion"]) == '' ) { $errordireccion = 1; $hayerrores = 1; }
	 if (trim($_GET["numero"]) == '' ) { $errornumero = 1; $hayerrores = 1; }
	 if (trim($_GET["telefono"]) == '' ) { $errortelefono = 1; $hayerrores = 1; }

$result = mysql_query ("SELECT * FROM formulario where numero=$form");
$fila = mysql_fetch_array($result) ;

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<body background="bgris.gif" >
<form method="GET" action="constancia2.php?actor=<?php echo $actor?>">

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
					
					<p align="left" class="text1b"><br>Constancia de Servicios</p><br><td align="right"><a href="constserv.php?actor=<?php echo $actor?>" target="_blank"><img src="pdf.png" alt="exportar" height="48" width="48"></href></td> <br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">				<div align="center">
		
<?
$result77 = mysql_query ("SELECT * FROM materia_docente, materia WHERE materia_docente.docente='$actor' and materia_docente.materia=materia.codigo order by materia_docente.fecha_alta desc");
?>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="8" height="40" align="left">
							<center>Constancia de &nbsp;<?echo $filatt[apellido] ?>,&nbsp;<?echo $filatt[nombre] ?>
							</td>
						</tr>
						<tr>
						<td align="center" width="200" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Cargo o Asignatura</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>HS</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Curso</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Div</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Fecha Alta</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Fecha Baja</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Sit. Revista</b></td>



					</tr>

		<?php while ($fila77 = mysql_fetch_array($result77))
		{ 

$resultc = mysql_query ("SELECT * FROM caracter where codigo=$fila77[caracter]");
$filac = mysql_fetch_array($resultc);

$resultg = mysql_query ("SELECT * FROM licencia_docente where materia=$fila77[codigo] and docente='$actor'");
$filag = mysql_fetch_array($resultg);


?>
					<tr>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[nombre];?> <? echo $fila77[curso];?> <? echo $fila77[div];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[hs_consume];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[curso];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[div];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[fecha_alta];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[fecha_baja];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filac[descripcion];?>
						</td>



	
	
					</tr>
		<?}?>

</table>
<br>
<b>LICENCIA O COMISIÓN DE SERVICIO FOX</b>
<br><br>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>

						</tr>
						<tr>
						<td align="center" width="200" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Cargo o Asignatura</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Sit. Revista</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Desde</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Hasta</b></td>





					</tr>

		<?php while ($fila90 = mysql_fetch_array($result90))
		{ 



?>
					<tr>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila90[descripcion];?> </td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila90[estado];?>
						</td>

						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila90[desde];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila90[hasta];?>
						</td>


	
	
					</tr>
		<?}?>

</table>


<br>
<b>LICENCIA O COMISIÓN DE SERVICIO SISTEMA NUEVO (JUNIO 2016)</b>
<br><br>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>

						</tr>
						<tr>
						<td align="center" width="200" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Cargo o Asignatura</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>HS</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Sit. Revista</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Desde</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Hasta</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Motivo</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Observaciones</b></td>




					</tr>

		<?php while ($fila99 = mysql_fetch_array($result99))
		{ 

$mate10 = mysql_query ("SELECT * FROM materia where codigo=$fila99[materia]");
$mate10 = mysql_fetch_array($mate10);

$motivo10 = mysql_query ("SELECT * FROM licencia where codigo=$fila99[motivo]");
$motivo10 = mysql_fetch_array($motivo10);


?>
					<tr>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $mate10[nombre];?> <? echo $mate10[curso];?> <? echo $mate10[div];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila99[hs_consume];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila99[hs_consume];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila99[fecha_desde];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila99[fecha_hasta];?>
						</td>

						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $motivo10[descripcion];?>
						</td>

						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila99[observaciones];?>

						</td>

	
	
					</tr>
		<?}?>

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


<input type="hidden" name="actor" value="<?echo $actor;?>">
</form>
 </td>

</div>

</body>
<?
}
else
{

	$nombre=$_GET['nombre'];
	$apellido=$_GET['apellido'];
	$direccion=$_GET['direccion'];
	$numero=$_GET['numero'];
	$telefono=$_GET['telefono'];
	$celular=$_GET['celular'];
	$piso=$_GET['piso'];
	$depto=$_GET['depto'];
	$barrio=$_GET['barrio'];
	$mail=$_GET['mail'];
	$tipo=$_GET['tipo'];
	$sexo=$_GET['sexo'];


if (mysql_query ("UPDATE docentes SET nombre='$nombre',apellido='$apellido',direccion='$direccion',mail='$mail',sexo='$sexo',identificacion=$tipo,telefono='$telefono',piso='$piso',depto='$depto',numero=$numero,barrio='$barrio', celular='$celular' where dni='$actor'"))
{	
				?>
				<script>
				var answer=alert("Datos Actualizados Correctamente")
				</script> 
						<meta http-equiv='refresh' content='0; URL=menu.php?'>
						<? 
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