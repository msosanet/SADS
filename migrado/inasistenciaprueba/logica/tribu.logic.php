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
	<meta http-equiv='refresh' content='0; URL=<?=$_SERVER['PHP_SELF']?>?actor=<?=$_POST['docente']?>'>
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
	<meta http-equiv='refresh' content='0; URL=<?=$_SERVER['PHP_SELF']?>?actor=<?=$_POST['estudiante']?>'>
	<? /* var_dump($_POST);
	 echo "<br>dni=" . $_POST['estudiante'] . " tribu=" . $nuevaTribu; */?>
 <? } }

 else echo "<meta http-equiv='refresh' content='2; URL=".$_SERVER['PHP_SELF']."'><h1>Debe seleccionar docente o estudiante</h1>";

}

else {

//include 'conexion.php';
?>

