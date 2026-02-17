<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<title></title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$actor=$_GET["actor"];

$resultt = mysql_query ("SELECT * FROM docentes WHERE dni = '$actor'");
$filatt = mysql_fetch_array($resultt);

$resulttipo = mysql_query ("SELECT * FROM estados order by descripcion asc ");




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
<form method="GET" action="legajo4.php?actor=<?php echo $actor?>">

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

	




$db2 = mysql_connect("localhost", "fgoicoechea", "sobral2011");
mysql_select_db("DBF2MYSQL",$db2);

$result77 = mysql_query ("SELECT * FROM movimientos WHERE baja IS NULL and espcur='$actor' GROUP BY dni order by nombre DESC");
?><br><br>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Espacio C.</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Docente</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Caracter</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Alta</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Baja</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Curso/div</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>hs</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Obs.</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Causa</b></td>

					</tr>

		<?php while ($fila77 = mysql_fetch_array($result77))
		{ ?>
					<tr>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[espcur];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[nombre];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[caracter];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[alta];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[baja];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[curso];?> / <? echo $fila77[division];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[hs];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[ob];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? echo $fila77[causa];?>
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
