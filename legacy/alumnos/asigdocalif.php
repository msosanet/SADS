<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexioncalif.php';

if (isset($_GET["submitx"])) //actualiza los docentes para cada materia
{
 $conexion = conectarcalif ();
 $curso=$_GET['curso'];

 $i=0;
 foreach ($_GET['asigna'] as $d)
	{	$es=$_GET['matmat'];
		$mate=$es[$i];
		$sql = "UPDATE matcur SET iddocente='$d' WHERE idmateria='$mate' AND idcurso='$curso'";

		$i++;
		mysql_query($sql);
	}
}

$conexion = conectarcalif ();
$usuario=$_SESSION['usuario'];
$materia=$_GET['materia'];
$cursox= (isset($_GET['curso']) ? $_GET['curso'] : false);

$cursosHabilitados = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by descripcion ASC,curso ASC,division ASC");
$cursosTodos = "";
while ($cursoH = mysql_fetch_assoc($cursosHabilitados)) $cursosTodos[$cursoH['idcurso']] = $cursoH['descripcion'];

$rr = mysql_query ("SELECT * FROM curso2 where idcurso='$cursox'");
$rr = mysql_fetch_array($rr);

$cursillo=$rr['descripcion'];

$cursotext = mysql_query ("SELECT * FROM materiax where curso='$cursillo'");
$cursotext = mysql_fetch_array($resulturno);

?>
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Docentes a materias</title>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>

<img src="Top Alumnos.png" alt="SID" style="vertical-align:bottom; display: block; margin-left: auto; margin-right: auto; max-width: 100%">
</head>
<body >
<div style="max-width: 980px; margin: auto">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
</div>
<div style="margin: auto; padding:20px; width: 80%">
<form method="GET" id="cur" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<h1>Asignar Docentes a:
<select form="cur" name="curso" onchange='this.form.submit()'>
<?PHP
foreach($cursosTodos AS $idc => $descc) printf("<option value='%s' %s>%s</option>",$idc,(($idc==$cursox)? "selected": ""),$descc);
?>
</select><input form="cur" type="submit" value="Mostrar" name="submitcurso"></h1><p>(El cambio solo aplica a los calificadores)</p>
</form>

<?PHP
if (!$cursox) { // Muestra aviso pidiendo que seleccione sección
?>

<div style="padding: 50px"><h2>Elija una secci&oacute;n para mostrar docentes a cargo</h2></div>

<?PHP
}
else {
?>
 <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">



<div align="center">

<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<th bgcolor="#EAEAEA" align="center"><b>Materia</b></th>
		<th bgcolor="#EAEAEA" align="center"><b>Docente</b></th>
	</tr>

<?php

			//echo "<td bgcolor='#EAEAEA' align='center'>";

			$result79 = mysql_query ("SELECT m.descripcion,mc.idcurso,mc.idmateria,mc.iddocente FROM matcur mc, materias m WHERE mc.idmateria=m.idmateria AND mc.idcurso='$cursox' AND mc.idmateria!=65");

				while ($fila79 = mysql_fetch_array($result79))
				{ echo "<tr>";
					$descri=$fila79['descripcion'];
					$materia=$fila79['idmateria'];
					$docente=$fila79['iddocente'];
					echo "<td bgcolor='#EAEAEA' align='center'><b>".$descri."</b></td>";
					echo "<td bgcolor='#EAEAEA' align='center'>";
					//que materia
					echo "<input name='matmat[]' type='hidden' value=$materia />";

					echo "<select name='asigna[".$materia."]' onchange='this.style.color = \"red\"'>";
							$listdocentex=mysql_query("SELECT DISTINCT (dni), CONCAT(apellido,  ' ', nombre) as nombredoc FROM docente WHERE identificacion='1' ORDER BY nombredoc ASC");

							while ($listdocentes = mysql_fetch_array($listdocentex))
							{	$docdoc=$listdocentes['dni'];
								$consulta=mysql_query("SELECT * FROM matcur where idcurso='$cursox' AND idmateria='$materia' AND iddocente='$docdoc'");
								$elegido = mysql_num_rows($consulta);

								if ($elegido!='0')
								{
								echo "<option selected value=".$listdocentes['dni'].">".$listdocentes['nombredoc']."</option>";
								}
								else
								{
								echo "<option value=".$listdocentes['dni'].">".$listdocentes['nombredoc']."</option>";
								}
							}
					echo "</select>";
					echo "</td>";
					echo "</td>";


			//echo "</td>";
			echo "</tr>";
		}

	?>


<input name="curso" type="hidden" value ="<?=$cursox?>"/>



						<tr>
							<td width="895" height="100" bgcolor="#EAEAEA" align="center" colspan="7">
							<br>
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:1000; float:center width:500px; height:125px; " /></td>

						</tr>


	</table></div>
	</form>
	<?PHP } //Muestra la tabla si se eligió la sección ?>
					<p align="right">&nbsp;</div>
				<?
include 'footer.php';
?>


</body>
</html>

<?PHP }
	else {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
} ?>
