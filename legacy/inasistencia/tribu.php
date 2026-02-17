<?PHP
session_start();
if ($_SESSION['estado']==1) {
include 'conexion.php';
$conexion = conectar ();

if (count($_POST)) {
//if (isset($_POST['yam']) OR isset($_POST['ona']) OR isset($_POST['esp'])) {
	switch (true) {
		case (isset($_POST['yam'])):
		case (isset($_POST['eyam'])):
		 $nuevaTribu = "Yamanas";
		 break;
		case (isset($_POST['ona'])):
		case (isset($_POST['eona'])):
		 $nuevaTribu = "Onas";
		 break;
		case (isset($_POST['esp'])):
		 $nuevaTribu = "Espiritu";
		 break;
		default:
		 unset($nuevaTribu);
	}

 if (isset($_POST['docente']) AND $_POST['docente']) {
	 mysql_select_db('sid');
	 if(mysql_query("UPDATE docentes SET tribu = '$nuevaTribu' WHERE dni = '$_POST[docente]' LIMIT 1")) {
?>
	<script>
		var answer=alert("Se asignó <? echo $nuevaTribu . ' a '	. $_POST['docente']?>")
	</script>
	<meta http-equiv='refresh' content='0; URL=tribu.php?actor=<?=$_POST['docente']?>'>
	<? /* var_dump($_POST);
	 echo "<br>dni=" . $_POST['docente'] . " tribu=" . $nuevaTribu . " ->" . count($_POST['docente']); */?>
 <? } }


 elseif (isset($_POST['estudiante']) AND $_POST['estudiante']) {
	 mysql_select_db('alumnos');
	 if(mysql_query("UPDATE alumno SET tribu = '$nuevaTribu' WHERE dni = '$_POST[estudiante]' LIMIT 1")) {
?>
	<script>
		var answer=alert("Se asignó <? echo $nuevaTribu . ' a ' . $_POST['estudiante']?>")
	</script>
	<meta http-equiv='refresh' content='0; URL=tribu.php?actor=<?=$_POST['estudiante']?>'>
	<? /* var_dump($_POST);
	 echo "<br>dni=" . $_POST['estudiante'] . " tribu=" . $nuevaTribu; */?>
 <? } }

 else echo "<meta http-equiv='refresh' content='2; URL=tribu.php'><h1>Debe seleccionar docente o estudiante</h1>";

}

else {

//include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Modificar Tribu</title>


</head>
<?
include 'header.php';
//$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;

/*
$db2 = mysql_connect("localhost", "fgoicoechea", "sobral2011");
mysql_select_db("DBF2MYSQL",$db2);

*/

?>

<body>

<div style="max-width:980px; align:center">


<?
include 'snipet_barramenu.php';
?>
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>

			<div align="center">
			<table border="0" width="980">
			<tr><th>
			</th></tr>
<? if($_SESSION['valor']==1) { ?>				<tr><form method="POST" action="tribu.php">
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Tribus asignadas a docentes</p>
						</p>
					<p align="center">&nbsp;

					</p>

					<div align="left">

					<table border="0">
						<tr>
							<td align="right" >Docente:</td>
							<td align="right" ></td>
							<td>
							 <input style="width:350px" list="docentes" name="docente">
							  <datalist id="docentes">
<?
$list_doc = mysql_query("SELECT dni, apellido, nombre, tribu FROM docentes WHERE dni != 0 ORDER BY apellido, nombre");
while ($actorD = mysql_fetch_assoc($list_doc)) {
	echo '<option value="' . $actorD["dni"] . '">' .
		ucwords(strtolower(trim($actorD["apellido"]))) . ', ' .
		ucwords(strtolower(trim($actorD["nombre"]))) . ' - ' .
		strtolower(trim($actorD["tribu"])) . '</option>\n';
}
?>
							  </datalist></td>
							<td align="right">
							 <input type="submit" value="   Yamana   " name="yam" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
							<td align="right">
							 <input type="submit" value="   Ona   " name="ona" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
							<td align="right">
							 <input type="submit" value="   Espiritu   " name="esp" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
					</table>
					</div>
					<p align="center">

					</p>
<?
if (count($_GET) AND $_GET['actor'] != '') {
	$q_docActualizado = mysql_query("SELECT * FROM docentes WHERE dni = '$_GET[actor]'");
	if ($docActualizado = mysql_fetch_assoc($q_docActualizado)) {
?>					<p style="color:red;text-align:left"><?=ucwords(strtolower(trim($docActualizado["apellido"]))) . ', ' .
		ucwords(strtolower(trim($docActualizado["nombre"]))) . ' - ' .
		strtolower(trim($docActualizado["tribu"]))?></p>
<?} }?>
					<p >&nbsp;</p>
					<p align="left">
					<?

	?>
					</p>
					</td>
				 </form>
				</tr> <? } ?>
				<tr><form method="POST" action="tribu.php">
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Tribus asignadas a estudiantes</p>
						</p>
					<p align="center">&nbsp;

					</p>

					<div align="left">

					<table border="0">
						<tr>
							<td align="right" >Estudiante:</td>
							<td align="right" ></td>
							<td>
							 <input style="width:350px" list="estudiantes" name="estudiante">
							  <datalist id="estudiantes">
<?
mysql_select_db('alumnos');
$list_alu = mysql_query("SELECT cursa.alumno AS dni,cursa.curso,cursa.divi,alumno.apellido,alumno.nombre,alumno.tribu FROM cursa LEFT JOIN alumno ON alumno.dni = cursa.alumno WHERE cursa.control = 1 AND cursa.anio = YEAR(CURRENT_DATE) ORDER BY alumno.apellido,alumno.nombre");
while ($actor = mysql_fetch_assoc($list_alu)) {
	echo '<option value="' . $actor["dni"] . '">' .
		ucwords(strtolower(trim($actor["apellido"]))) . ', ' .
		ucwords(strtolower(trim($actor["nombre"]))) . ' - ' .
		trim($actor["curso"]) . '° ' .
		trim($actor["divi"]) . ' - ' .
		strtolower(trim($actor["tribu"])) . '</option>\n';
}
?>
							  </datalist></td>
							<td align="right">
							 <input type="submit" value="   Yamana   " name="eyam" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
							<td align="right">
							 <input type="submit" value="   Ona   " name="eona" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
					</table>
					</div>
					<p align="center">

					</p>
<?
if (count($_GET) AND $_GET['actor'] != '') {
	$q_aluActualizado = mysql_query("SELECT * FROM alumno WHERE dni = '$_GET[actor]'");
	if ($aluActualizado = mysql_fetch_assoc($q_aluActualizado)) {
?>					<p style="color:red;text-align:left"><?=ucwords(strtolower(trim($aluActualizado["apellido"]))) . ', ' .
		ucwords(strtolower(trim($aluActualizado["nombre"]))) . ' - ' .
		strtolower(trim($aluActualizado["tribu"]))?></p>
<?} }?>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
					<?

	?>
					</p>
					</td>
				 </form>
				</tr>

			</div>

			</table>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>





</div>

</body>
</html>
<? }
}
else  echo '<meta http-equiv="refresh" content="0,i_admin.php">';?>
