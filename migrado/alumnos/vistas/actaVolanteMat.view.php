<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="style2.css" />
<title>Arma mesas de ex&aacute;men</title>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>
</head>
<?
include 'encabezado.php';

?>

<?

$errordoc = 0;
$hayerrores = 0;



  $flag = 0;
  if (!isset($_GET["submitx"])) {
     // verifico los errores en los campos




}
 else
  {
    $flag = 1;
  }

if ($hayerrores OR $flag) {
?>


<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
			<?
include "snipet_barramenu.php";
?>
			<table border="0" width="980">
			<form method="POST" action="actaVolanteMat_pdf.php" target="_blank">

				<tr>


					<td>

<p align="left" class="text1b">Estudiantes que adeudan <?=$materia?></p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					</td>
					<td><input type = "checkbox" name="usaFecha" value="usaFecha" title="Marcar para que se imprima con fecha">
					Fecha de examen: <input type="date" value="<?=$fecha_hoy?>" name="fechaExamen">
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<table border="0" width="450" id="table1" cellpadding="0" cellspacing="4">



						<tr class="alte"><th>Seleccionar</th>
						<th>Apellido y Nombre</th>


<?
$anterior = 0;
mysql_data_seek($alum_ade,0);
while ($rinde = mysql_fetch_assoc($alum_ade)) {
	if ($rinde['alumno'] != $anterior) {
		echo "<tr class='alte'>\n";
		echo "<td align='right'><input type='checkbox' id='" . $rinde['alumno'] . "' name='agregar[" . $rinde['alumno'] . "]' value='" . $rinde['anio'] . "' checked></td>\n";
		echo "<td>" . $rinde['apeNom'] . "</td></tr>\n";
//		$datos = $datos . ";" . $rinde[alumno] . "=>" . $rinde[apeNom];
	}
	$anterior = $rinde['alumno'];
}
?>

						<!--<tr>
						<td colspan="2"><? //var_export($_POST);?></td></tr>
						<tr>
						<td colspan="2"><?// var_export($GLOBALS);?></td>
						</tr> -->



						<tr>

						</tr>
						<tr>
							<td bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Generar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></p></td>
						</tr>
						</table>

					<p align="right">&nbsp;</div>
					</td>
				</tr>
				<input type="hidden" name="materia" value="<? echo $_GET['materia'];?>">
				</form>
			</table>
			</div>


<?
include 'foot.php';
?>
		</td>
		</tr>
	</table>

</div>
<?
}
else
{
?>
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<?
include "snipet_barramenu.php";
?>
			</td>
		</tr>
		<tr><td>
			<table border="0" width="980">
			<form method="GET" action="actaVolanteMat.php">
			<tr style="height: 40px;"><td></td><td></td></tr>

			 <tr><td style="text-align:right">Espacio curricular:</td>
			     <td><input style="width:400px" list="materias" name="materia">
							  <datalist id="materias">
<?
$valido = mysql_select_db("alumnos");
// "SELECT * FROM materias2023 RIGHT JOIN (SELECT DISTINCT idmateria,curso FROM `previas`) AS todoPrevia ON todoPrevia.idmateria = materias2023.idmateria WHERE materias2023.idmateria < 1000 "
$q_materias = mysql_query("SELECT DISTINCT materia FROM `previas` ORDER BY materia ");
while ($mat_list = mysql_fetch_assoc($q_materias)) {
 echo '<option value="' . $mat_list["materia"] . '">' .
	$mat_list["materia"] . '</option>\n';
}
		?>
							 </datalist>&nbsp;
							 <input type="submit" value=" Listado " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; padding-left: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
			 </tr>
			 <tr style="height: 50px;"><td></td><td></td></tr>
			</form>
			</table>
		</td></tr>
		<tr><td>

</div>
<?
include 'foot.php';
?>
		</td></tr>
		</table>
<?
}
}
else
{
?>
<meta http-equiv="refresh" content="0;url=/i_admin.php">
<?}?>

