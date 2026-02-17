<body >

<form method="POST" action="i_admin.php">

<div align="center">
	<table border="0" width="980" cellspacing="0" cellpadding="0" height="440" background="todo.jpg">
		<tr>
			<td>&nbsp;<p>&nbsp;</p>
			<p>&nbsp;</p>


			<div align="center">
				<table border="0" width="78%">
					<tr>
						<td width="34%" colspan="2">
						<p align="right"><font face="Arial" size="4">Usuario&nbsp;&nbsp;&nbsp;
						</font></td>
						<td width="65%" colspan="2">
						<p align="center">
						<input name="usuario" size="20" autofocus="true" style="float: left"></td>
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



</form>
<?
			}
echo "<p>" . var_export($_SERVER,true) . "</p>";			?>



</body>

</html>

