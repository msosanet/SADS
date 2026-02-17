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

$resultt = mysql_query ("SELECT * FROM materia WHERE codigo = '$actor'");
$filatt = mysql_fetch_array($resultt);



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
<form method="GET" action="materia2.php?actor=<?php echo $actor?>">

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
					
					<p align="left" class="text1b"><br>Informacion de la Materia: &nbsp;<?echo $filatt[nombre] ?>&nbsp;<?echo $filatt[curso] ?>°&nbsp;<?echo $filatt[divi] ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">				<div align="center">
		
<?
$result77 = mysql_query ("SELECT * FROM materia where codigo='$actor'");
?>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
						<td align="center" width="200" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Plan</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Turno</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>HS</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Cargo</b></td>



					</tr>

		<?php while ($fila77 = mysql_fetch_array($result77))
		{ 

$resultb = mysql_query ("SELECT * FROM plan where codigo=$fila77[plan]");
$filab = mysql_fetch_array($resultb) ;
$resultz = mysql_query ("SELECT * FROM turno where codigo=$fila77[turno]");
$filaz = mysql_fetch_array($resultz) ;


?>
					<tr>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filab[descripcion];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filaz[descripcion];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[hs_consume];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[codigo_cargo];?>
						</td>
	
					</tr>
		<?}?>

</table>
<br><br>

<div align="center">
					
		<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>

		<td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Miercoles</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Sabado</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Domingo</b></td>
	</tr>
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"></font></td>
	</tr>	
<?php 		$turno='M';
		$resultxx = mysql_query ("SELECT * FROM materia_horario where materia='$actor' and baja='0000-00-00' order by dia,hs");
		while ($filaxx = mysql_fetch_array($resultxx))
		{ 
			$resultx2 = mysql_query ("SELECT * FROM horas where codigo=$filaxx[hs]");
			$filax2 = mysql_fetch_array($resultx2) ;




		?>
	<tr>

			<td bgcolor="#EAEAEA" align="center"><?if ($filaxx[dia]==1){ echo $filax2[desde]; ?> a <? echo $filax2[hasta]; } ?></td>
			<td bgcolor="#EAEAEA" align="center"><?if ($filaxx[dia]==2){ echo $filax2[desde]; ?> a <? echo $filax2[hasta]; } ?></td>
			<td bgcolor="#EAEAEA" align="center"><?if ($filaxx[dia]==3){ echo $filax2[desde]; ?> a <? echo $filax2[hasta]; } ?></td>
			<td bgcolor="#EAEAEA" align="center"><?if ($filaxx[dia]==4){ echo $filax2[desde]; ?> a <? echo $filax2[hasta]; } ?></td>
			<td bgcolor="#EAEAEA" align="center"><?if ($filaxx[dia]==5){ echo $filax2[desde]; ?> a <? echo $filax2[hasta]; } ?></td>
			<td bgcolor="#EAEAEA" align="center"><?if ($filaxx[dia]==6){ echo $filax2[desde]; ?> a <? echo $filax2[hasta]; } ?></td>
			<td bgcolor="#EAEAEA" align="center"><?if ($filaxx[dia]==7){ echo $filax2[desde]; ?> a <? echo $filax2[hasta]; } ?></td>

		
	</tr><?}?>


</table>


<br>
<b>DOCENTES</b><BR>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
						<td align="center" width="20" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>DNI</b></td>
						<td align="center" width="200" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Docente</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Caracter</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Fecha alta</b></td>
						<td align="center" width="10" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Fecha baja</b></td>



					</tr>

		<?php 
$result78 = mysql_query ("SELECT * FROM materia_docente where materia=$actor order by fecha_alta");
while ($fila78 = mysql_fetch_array($result78))
		{ 

$resultc = mysql_query ("SELECT * FROM docente where dni=$fila78[docente]");
$filac = mysql_fetch_array($resultc) ;
$results = mysql_query ("SELECT * FROM caracter where codigo=$fila78[caracter]");
$filas = mysql_fetch_array($results) ;
?>
					<tr>	<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila78[docente];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? if ($fila78[fecha_baja] == "0000-00-00")
								{  
									?><a href="curso.php?actor=<?php echo $fila78[docente]?>" target="_blank"><font color="ff0000"><?echo $filac[apellido];?>, <?echo $filac[nombre];?></font></a><?
								}
							else { 
								?><a href="curso.php?actor=<?php echo $fila78[docente]?>" target="_blank"><font color="000000"><? echo $filac[apellido];?>, <?echo $filac[nombre];?></font></a><?

							} ?>

						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $filas[descripcion];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila78[fecha_alta];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila78[fecha_baja];?>
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