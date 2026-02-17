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
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Modificar datos de t&iacute;tulo</title>

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

$color = '';

$resultt = mysql_query ("SELECT * FROM titulo, alumno WHERE titulo.id = $dni and titulo.alumno=alumno.dni");
$filatt = mysql_fetch_array($resultt);

$dia = ($filatt['fecha'] == '0000-00-00') ? date("Y-m-d") : $filatt['fecha'];

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

<form method="_GET" action="<?=$_SERVER['PHP_SELF']?>">
<div style="max-width:980px; align:center" >
<?if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
			<table border="0" width="980">
				<tr>


					<td>

					<p align="left" class="text1b">Modificar Nº Titulos</p>
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
							Numero:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="number" name="numero" min='0' max="9999999999999999" value="<?echo $filatt['numero'];?>" /><? if ($filatt['anio']<>'0000') echo " / " . $filatt['anio']; ?></td>



							<td width="190" bgcolor="#EAEAEA" align="right">
							Caja:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="caja" size="6" maxlength="6" value="<?echo $filatt['caja'];?>" /></td>


						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Correo de env&iacute;o:</td>
							<td bgcolor="#EAEAEA" width="265" align="left" title="Direcci&oacute;n de correo electr&oacute;nico donde se envía el enlace"><input type="email" name="email" value="<?echo $filatt['email'];?>" /></td>





							<td width="190" bgcolor="#EAEAEA" align="right">
							Enlace:</td>
							<td bgcolor="#EAEAEA" width="265" align="left" title="Enlace de acceso al t&iacute;tulo"><input type="text" name="link" size="50" value="<?echo $filatt['link'];?>" /></td>


						</tr>



						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha de retiro/comunicaci&oacute;n:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="dia" size="10" maxlength="10" value="<?echo $dia;?>" /></td>





							<td width="190" bgcolor="#EAEAEA" align="right">
							Info de retiro/comunica&oacute;n:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="descripcion" size="50" maxlength="100" value="<?echo $filatt['descripcion'];?>" /></td>


						</tr>



						<tr>

						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						</table>
					</div>
					<p align="right">&nbsp;</p></div>
				 </td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
<input type="hidden" name="dni" value="<?echo $dni;?>">
	</form>
</div>
</body>
<?
}
else
{


	$numero=$_GET['numero'];
	$caja=$_GET['caja'];
	$descripcion=$_GET['descripcion'];
	$dia=$_GET['dia'];
	$correo=$_GET['email'];
	$enlace=$_GET['link'];











if (mysql_query ("UPDATE titulo SET numero='$numero', caja='$caja', descripcion='$descripcion', fecha='$dia', email = '$correo', link = '$enlace' WHERE id=$dni"))
	{

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script>
				<meta http-equiv='refresh' content='0; URL=bus_titulo2.php'>

				<?
	}
	else {
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script>
				<meta http-equiv='refresh' content='0; URL=bus_titulo2.php'>

				<?
		}


}

?>
</html>
<? } ?>
