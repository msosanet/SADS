<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Asistencia SIN c&oacute;digo</title>


</head>
<?
include 'header.php';
//$conexion = conectar ();
/*
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ; */


?>

<body>

<div style="max-width:980px; align:center">


<?
include 'snipet_barramenu.php';
if (isset($_SESSION['probando'])) printf("<p>PRUEBA PRUEBA PRUEBA PRUEBA PRUEBA PRUEBA PRUEBA PRUEBA </p>");
?>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div align="center">
	<table border="0">
		<tr>
		<td align="right" >Estudiante:</td>
		<td align="right" ></td>
		<td>
			<input style="width:350px" list="estudiantes" name="estudiante">
				<datalist id="estudiantes">
<?
$list_alu = mysql_query("SELECT a.apellido, a.nombre, a.dni,c.digito_control, COALESCE(c.habilitado, 0) AS habilitado FROM alumno AS a LEFT JOIN comedor_habilitados AS c ON a.dni = c.dni_alumno AND c.fecha = (SELECT MAX(fecha) FROM comedor_habilitados WHERE dni_alumno = a.dni) WHERE a.dni IN (SELECT alumno FROM `cursa` WHERE control = 1 AND anio = '$_SESSION[cicloLectivo]' AND divi NOT LIKE '-%' AND divi NOT LIKE 'E%' AND divi NOT LIKE 'L%' ) ORDER BY a.apellido ASC");
while ($actor = mysql_fetch_assoc($list_alu)) {
	$estId = ($actor["digito_control"]===NULL) ? $actor["dni"] : $actor["dni"] . "." . $actor["digito_control"];
	echo '<option value="' . $estId . '">' .
		ucwords(strtolower(trim($actor["apellido"]))) . ', ' .
		ucwords(strtolower(trim($actor["nombre"]))) . ' - ' .
		($actor["habilitado"] ? "Habilitada/o" : "No") . '</option>\n';
}
?>
				</datalist></td>
		<td align="right">
		 <input type="submit" value="   Confirmar   " name="ingresa" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #99ff99; font-weight:700; float:center" /></td>
		<td align="right">
		 <input type="submit" value="   Anular   " name="noIngresa" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff2222; font-weight:700; float:center" /></td>
	</tr>
	</table>
	</div>
 </form>
 <!-- ------------------------------------------------------------------------------------- -->
<?
if ($mensaje != "" ) printf("%s",$mensaje);
//printf("<pre>%s</pre>",var_export($_POST,true));
/*include 'generarCodigoBarra.php';
$rehace_check = [46334377,48191486,48518748,48832784,48948855,49045540,49496231,49496464,49868902,49996077,50127677,50220868,50746633,51421473,51589819,52048911,52571567,52899862,52899889,94835569,95017579];
foreach ($rehace_check AS $cadaUno) generarCodigoBarraFunc($cadaUno."1");
*/

?>

</div>

<?
include 'footer.php';
?>

</body>
</html>
<?
}
else  echo '<meta http-equiv="refresh" content="0,i_admin.php">';?>

