<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Administrador de Alumnos</title>

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
$id_pase=$_GET["id_pase"];

$resultt = mysql_query ("SELECT * FROM pase, alumno WHERE pase.id = $id_pase and pase.alumno=alumno.dni");
$filatt = mysql_fetch_array($resultt);

$dia=date("Y-m-d");

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

<form method="_GET" action="ver_pase.php?id_pase=<? echo $id_pase; ?>">
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

					<p align="left" class="text1b">Modificar pases</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">

					<div align="center">

					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">


						<tr>


							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<?echo $filatt['alumno']; ?>
							</td>



							<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Alumno:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<?echo $filatt['apellido']; ?>, <?echo $filatt['nombre']; ?>							</td>

						</tr>




							<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha solicitud:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="fecha" size="10" maxlength="10" value="<?echo $filatt['fecha_solicitud'];?>" /></td>
							</td>	</td>



							<td width="190" bgcolor="#EAEAEA" align="right">
							Establecimiento:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="establecimiento" size="20" maxlength="50" value="<?echo $filatt['establecimiento'];?>" /></td>
							</td>


						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Domicilio:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="domicilio" size="20" maxlength="50" value="<?echo $filatt['domicilio'];?>" /></td>
							</td>





							<td width="190" bgcolor="#EAEAEA" align="right">
							Ciudad:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="ciudad" size="20" maxlength="50" value="<?echo $filatt['ciudad'];?>" /></td>
							</td>


						</tr>

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Provincia:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="provincia" size="20" maxlength="50" value="<?echo $filatt['provincia'];?>" /></td>
							</td>





							<td width="190" bgcolor="#EAEAEA" align="right">
							CP:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="cp" size="10" maxlength="10" value="<?echo $filatt['cp'];?>" /></td>
							</td>


						</tr>

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Tel.:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="tel" size="20" maxlength="50" value="<?echo $filatt['telefono'];?>" /></td>
							</td>





							<td width="190" bgcolor="#EAEAEA" align="right">
							Email:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="email" size="50" maxlength="100" value="<?echo $filatt['email'];?>" /></td>
							</td>


						</tr>

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Numero:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="numero" size="10" maxlength="10" value="<?echo $filatt['numero'];?>" /></td>
							</td>





							<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha de confirmacion:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="fecha2" size="10" maxlength="10" value="<?echo $filatt['fecha_conf'];?>" /></td>
							</td>


						</tr>

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha retiro:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="fecha3" size="10" maxlength="10" value="<?echo $filatt['fecha_retiro'];?>" /></td>





							<td width="190" bgcolor="#EAEAEA" align="right">
							Archivo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="archivo" size="20" maxlength="10" value="<?echo $filatt['archivo'];?>" /></td>

						</tr>

						<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Descripcion:</td>
							<td bgcolor="#EAEAEA" width="265" align="left" colspan="3"><input type="text" name="descripcion" size="100" maxlength="200" value="<?echo $filatt['descripcion'];?>" /></td>
							</td>


						</tr>



						<tr>

						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						</table>
					</div>
					<p style="text-align: center"><a href="reciboCertPase_pdf.php?alumno=<?=$filatt['alumno']?>" style="font-size:1.75em" target="_blank">Imprimir constancia de recibido</a></div>
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
<input type="hidden" name="id_pase" value="<?echo $id_pase;?>">
<input type="hidden" name="actor" value="<?=$filatt['alumno']?>">
	</form>
</div>
</body>
<?
}
else
{


	$fecha=$_GET['fecha'];
	$establecimiento=$_GET['establecimiento'];
	$domicilio=$_GET['domicilio'];
	$ciudad=$_GET['ciudad'];
	$provincia=$_GET['provincia'];
	$cp=$_GET['cp'];
	$tel=$_GET['tel'];
	$email=$_GET['email'];
	$numero=$_GET['numero'];
	$fecha2=$_GET['fecha2'];
	$fecha3=$_GET['fecha3'];
	$descripcion=$_GET['descripcion'];
	$actor=$_GET['actor'];
    $archivo=$_GET['archivo'];



unset($udp_alumno);

$udp_alumno = mysql_query ("UPDATE alumno SET archivo='$archivo' WHERE dni = '$actor'");
// $q_udp_alumno = "UPDATE alumno SET archivo='$archivo' WHERE dni = '$actor'";


if (mysql_query ("UPDATE pase SET fecha_solicitud='$fecha', establecimiento='$establecimiento', domicilio='$domicilio', ciudad='$ciudad', provincia='$provincia', cp='$cp', telefono='$tel', email='$email', numero='$numero', fecha_conf='$fecha2', fecha_retiro='$fecha3', descripcion='$descripcion' where id=$id_pase") && $udp_alumno)
	{

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script>
				<meta http-equiv='refresh' content='0; URL=modif_pase.php'>

				<?
	}
	else {
				?>
				<script>
				var answer=alert("ATENCION:\nNo se pudo grabar en la BD")
				</script>
				<meta http-equiv='refresh' content='0; URL=modif_pase.php'>

				<?
		}


}

?>
</html>
<? } ?>

