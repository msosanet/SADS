<?php
session_start();

if (isset($_SESSION['estado'])) if ($_SESSION['estado'] == 1) {
	header('Location: menu.php');
	exit;
}
include 'conexion.php';

if (isset($_POST['muestra']))
{
	conectar();
	$_SESSION['usuario']=$_POST['usuario'];
	$_SESSION['contrasenia']=$_POST['contrasenia'];
	$_SESSION['cicloLectivo']=2025;

	$es_usuario = mysql_query("SELECT * FROM `usuarios` WHERE `usuario` LIKE '$_POST[usuario]' AND `pass` LIKE '$_POST[contrasenia]' ");

	if(mysql_num_rows($es_usuario)==1) {
		$ingreso = mysql_fetch_assoc($es_usuario);
		$_SESSION['estado']=1;
		$_SESSION['valor']=$ingreso['valor'];
		$_SESSION['sector']=$ingreso['sector'];
		if (isset($_POST['ref'])) {
			$ref = base64_decode($_POST['ref']);
			$ref = 'Location: ' . $ref;
			header($ref);
		}
		else header('Location: menu.php');
		// echo "<meta http-equiv='refresh' content='0; URL=menu.php'>";
		exit;
	}
	else { ?>
		<script>
			alert("Datos incorrectos");
		</script>
		<meta http-equiv='refresh' content='0; URL=<?=$_SERVER["PHP_SELF"]?>'><?PHP
		exit;
	}


}
else
{
?>

<?php
include 'header.php';
?>
<title>Bienvenido a Alumnos</title>

<body >

<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">

<div align="center">
	<table border="0" width="980" cellspacing="0" cellpadding="0" height="440" background="todo.jpg">
		<tr>
			<td>&nbsp;<p>&nbsp;</p>
			<p>&nbsp; </p>


			<div align="center">
				<table border="0" width="78%">
					<tr>
						<td width="34%" colspan="2">
						<p align="right"><font face="Arial" size="4">Usuario&nbsp;&nbsp;&nbsp;
						</font></td>
						<td width="65%" colspan="2">
						<p align="center">
						<input name="usuario" size="20" style="float: left" autofocus></td>
					</tr>
					<tr>
						<td width="34%" colspan="2">&nbsp;</td>
						<td width="65%" colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="34%" colspan="2">
						<p align="right"><font face="Arial"><font size="4">Contrase&ntilde;a&nbsp;</font>&nbsp;&nbsp;
						</font></td>
						<td width="65%" colspan="2">
						<p align="center">
						<input type="password" name="contrasenia" size="20" style="float: left"></td>
					</tr>
					<tr>
						<td width="34%" colspan="2">&nbsp;</td>
						<td width="65%" colspan="2">&nbsp;</td>
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
<?php
			}
			?>



</body>

</html>
