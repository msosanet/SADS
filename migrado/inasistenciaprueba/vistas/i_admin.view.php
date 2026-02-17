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
echo "<!-- " . var_export(base64_decode($_GET['ref']),true) . " -->";			?>



</body>

</html>

