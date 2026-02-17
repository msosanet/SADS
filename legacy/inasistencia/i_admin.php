<?PHP
session_start();

if (isset($_SESSION['estado'])) if ($_SESSION['estado'] == 1) {
	header('Location: menu.php');
	exit;
}

include 'conexion.php';
conectar();
if (isset($_POST['muestra']))
{
	$_SESSION['usuario']=$_POST['usuario'];
	$_SESSION['contrasenia']=$_POST['contrasenia'];
	$_SESSION['cicloLectivo']=2025;

	$es_usuario = mysql_query("SELECT * FROM `usuarios` WHERE `usuario` LIKE '$_POST[usuario]' AND `pass` LIKE '$_POST[contrasenia]' ");

	if(mysql_num_rows($es_usuario)) {
		if (isset($_POST['ref'])) {
			$ingreso = mysql_fetch_assoc($es_usuario);
			$_SESSION['estado']=1;
			$_SESSION['valor']=$ingreso['valor'];
			$_SESSION['sector']=$ingreso['sector'];
			$ref = base64_decode($_POST['ref']);
			$ref = 'Location: ' . $ref;
			header($ref);
			exit;
		}
		else header('Location: menu.php');
		exit;
/*	?><meta http-equiv='refresh' content='0; URL=menu.php?'><? */
	}
	else header('Location: menu.php');
	exit;
}
else
{
?>
<!DOCTYPE html >
<html>
<head>
<title>Administrador S.A.S.</title>
</head>
<?
include 'header.php';
?>
<body >

<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">

<div align="center">
	<table border="0" width="980" cellspacing="0" cellpadding="0" height="440" background="todo.jpg">
		<tr>
			<td>&nbsp;<p>&nbsp;</p>
			<p>&nbsp;</p>


			<div align="center">
				<table border="0" width="78%">
					<tr>
						<td width="34%" colspan="2">&nbsp;</td>
						<td width="65%" colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="34%" colspan="2" style="font-family: Arial, Helvetica, sans-serif; text-align: right; font-weight: bold;">Usuario</td>
						<td width="65%" colspan="2" style="padding-left:8px; font-family: Arial, Helvetica, sans-serif;">
						<input name="usuario" size="20" autofocus="true" style="float: left"></td>
					</tr>
					<tr>
						<td width="34%" colspan="2">&nbsp;</td>
						<td width="65%" colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="34%" colspan="2" style="font-family: Arial, Helvetica, sans-serif; text-align: right; font-weight: bold;">Contrase&ntilde;a</td>
						<td width="65%" colspan="2" style="padding-left:8px; font-family: Arial, Helvetica, sans-serif;">
						<input type="password" name="contrasenia" size="20" style="float: left"></td>
					</tr>
					<tr>
						<td align="center">
						<p align="center">
						&nbsp;</td>
						<td align="center" width="25%">
						&nbsp;</td>
						<td align="center" width="19%">
						<input type="submit" value="Enviar" name="muestra" style="float: right"></td>
						<td align="center" width="45%">
						&nbsp;</td>
					</tr>
				</table>
			</div>
			<p>&nbsp;</p>
			<p>&nbsp;</td>
		</tr>
	</table>
</div>

<?PHP
if (isset($_GET['ref'])) echo "<input hidden name='ref' value='" . $_GET['ref'] . "'>";
?>

</form>
<?
			}
?>



</body>

</html>
