<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Intervenci&oacute;n</title>
<script type="text/javascript">
	function borrar(numInt) {
		confirm("Borrar la intervencion de fecha");
	}
</script>

</head>
<?
include 'header.php';
?>
<body>

<div id="menu">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
if ($_SESSION['valor']==4) include 'menuppal4.php';



if (is_numeric($alumno) AND is_numeric($deriva)) {

$hoy = date("Y-m-d");
$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM alumno where dni= $alumno");
$fila_alumno = mysql_fetch_array($resultdocente);

$result1 = mysql_query ("SELECT * FROM derivacion where id=$deriva");
$fila_deriva = mysql_fetch_array($result1);

// Obtiene las iniciales del nombre para mostrarlas en lugar del nombre completo
$iniciales = $fila_alumno['nombre'][0];
$palabra = 0;
while ($palabra = strpos($fila_alumno['nombre']," ",$palabra)) $iniciales.= $fila_alumno['nombre'][++$palabra];
$iniciales .=  $fila_alumno['apellido'][0];
$palabra = 0;
while ($palabra = strpos($fila_alumno['apellido']," ",$palabra)) $iniciales.= $fila_alumno['apellido'][++$palabra];

 $q_derivacion = "SELECT derivacion.*,alumno.apellido, alumno.nombre FROM `derivacion` LEFT JOIN alumno ON derivacion.alumno = alumno.dni WHERE `alumno` = $alumno AND id = $deriva ";
 $_derivacion = mysql_query($derivacion);

 $q_intervenciones = "SELECT * FROM `intervencion` WHERE `alumno` = $alumno AND idderiva = $deriva";
 $_intervenciones = mysql_query($q_intervenciones);
 $tr_registradas = (mysql_num_rows($_intervenciones)) ? [] : ["<td colspan=4>No hay intervenciones registradas</td>"];

 while ($_i = mysql_fetch_assoc($_intervenciones)) {
	 if (is_array($_SESSION['intBorradas'])) $borrada = (in_array($_i['codigo'],$_SESSION['intBorradas'])) ? true : false;
	 if ($borrada) $linea = "<td colspan=4 style='text-align: center;background-color:#ffaaaa'>Intervención borrada. <a href='" . $_SERVER["PHP_SELF"] . "?actor=" .$alumno. "&int=" . $_i['codigo'] . "&deriva=" . $deriva . "'>Restaurar</a></td>";
	 elseif ($_i['mostrar']) {
		 $linea = "<td>" . date("d/m/Y",strtotime($_i['fecha'])) . "</td>";
		 $linea .= "<td>" . $_i['tarea'] . "</td>";
		 $linea .= "<td>" . $_i['profesional'] . "</td>";
		 $linea .= "<td>" . "<a href='" . $_SERVER["PHP_SELF"] . "?actor=" .$alumno. "&int=" . $_i['codigo'] . "&deriva=" . $deriva . "'><img src='tacho.jpg' alt='Eliminar' ></a></td>";
	 }
	 if (isset($linea)) $tr_registradas[] = $linea;
	 unset($linea);
 }

?>

<h2 style="text-align:left" >Registrar intervenci&oacute;n de <?=$iniciales?> (<?=$alumno?>)</h2>
<h3 style="text-align:left">Hechos observados:</h3>
<p style="font-size: 1.2em;text-align:left"><?=$fila_deriva['hechos']?></p>
<h3 style="text-align:left">Derivado por: <?=$fila_deriva['observador']?></h3>

<form method="POST" action="<?=$_SERVER["PHP_SELF"]?>">
<table border="0" width="895" id="table1" cellpadding="0" cellspacing="0">

	<tr>

		<td width="174" bgcolor="#EAEAEA" align="right" >Intervención:</td>
		<td bgcolor="#EAEAEA" width="800" align="center" colspan="3"><TEXTAREA COLS=70 ROWS=10 NAME="observaciones" placeholder="Datos de la intervenci&oacute;n como libro y folio de acta de la misma, adultos involucrados, fecha de pr&oacute;xima revisi&oacute;n y cualquier otra informaci&oacute;n valiosa que no exponga datos sensibles"></TEXTAREA></td>

	</tr>

	<tr>

		<td width="190" bgcolor="#EAEAEA" align="right">Fecha:</td>
		<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="fecha" value="<?=$hoy?>" /></td>
		<td width="190" bgcolor="#EAEAEA" align="right">Profesional:
		</td></font>
		<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="profesional" required>
		</td>
	</tr>
	<input type="hidden" name="alumno" value="<?=$alumno?>"/>
	<input type="hidden" name="deriva" value="<?=$deriva?>"/>

	<tr>
		<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"></td>
	</tr>

	<tr>
		<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
		<p align="center">Estamos haciendo arreglos, se podra grabar cuando hayamos terminado <input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" disabled /></p></td>
	</tr>
	</table>
</form>
</div>

<br><br>

<div>
	<table class="tableam" style="border:solid 1px">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Registro de intervenci&oacute;n</th>
				<th>Realizada por:</th>
				<th></th>
			</tr>
		</thead>
<?PHP foreach ($tr_registradas as $linea) printf("<tr>%s</tr>",$linea)?>
	</table>
</div>

<?PHP

}
elseif (isset($_POST))
{
	extract($_POST);
	$alumno=$_POST['dni'];
	$id=$_POST['id'];

	$interviniendo = "INSERT INTO intervencion VALUES (0,'$observaciones','$profesional','$fecha','$alumno',$deriva,1)";

	printf("<p>No se guardaron datos</p><a href='%s?actor=%s&deriva=%s'>Volver</a>\n<p>%s </p>",$_SESSION["PHP_SELF"],$alumno,$deriva, $interviniendo);

	/* // if (mysql_query($interviniendo));
	if (false)
		{
		?>
		<script>
		var answer=alert("Datos Grabados Correctamente")
		</script>
		<meta http-equiv='refresh' content='0; URL=menu.php?'>
		<?

		}
	else {
		?>
		<script>
		var answer=alert("No se pudo grabar en la BD")
		</script>
		<meta http-equiv='refresh' content='0; URL=<?=$_SESSION["PHP_SELF"]?>?actor=48118425&deriva=264'>
		<?
	}*/
}



?>
</div>
</body>
<?PHP
include 'footer.php'
?>
</html>
<?
printf("<!-- %s -->",var_export($_SESSION,true));
 } ?>

