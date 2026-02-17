<?PHP
/* Muestra estudiantes activos que adeudan materias,
** para cada espacio curricular todos los años adeudados.
*/
session_start();

// Está logueado el usuario?
include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
if (!mysql_num_rows($resultt)) {
	header('Location: i_admin.php');
	exit;
}


$ciclo = $_SESSION['cicloLectivo'];


$q_pendientes = mysql_query("SELECT * FROM materias2023 WHERE idmateria IN (SELECT DISTINCT idmateria FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE control = 1 AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria < 1000) ORDER BY descripcion");

$pendientes = [];
while($datosPend = mysql_fetch_assoc($q_pendientes)) $pendientes[$datosPend['idmateria']] = $datosPend['descripcion'];

$materia = (isset($_GET['idmat'])) ? $_GET['idmat'] : array_rand($pendientes);
$materia = 4;


$q_materias = mysql_query("SELECT * FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE `curso` LIKE '6' AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria = '$materia'");

$q_estudiantes = mysql_query("SELECT dni,CONCAT(apellido,' ',nombre) AS nya,tel,mail FROM alumno WHERE dni IN (SELECT DISTINCT alumno FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE `curso` LIKE '6' AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria = '$materia')");

$q_adeudadas = mysql_query("SELECT previas.* FROM `previas` RIGHT JOIN cursa ON cursa.alumno = previas.alumno WHERE cursa.control = 1 AND cursa.anio = '$ciclo' AND previas.nota < 6 AND previas.idmateria = '$materia' ");


$materias = [];
while($datosMat=mysql_fetch_assoc($q_materias)) $materias[$datosMat['alumno']][$datosMat['curso']] = $datosMat;

$estudiantes = [];
while($datosEst = mysql_fetch_assoc($q_estudiantes)) $estudiantes[$datosEst['dni']] = $datosEst;

$adeudadas = [];
while ($__a = mysql_fetch_assoc($q_adeudadas)) {
	array_push($adeudadas[$__a['alumno']]['materia'],$__a['curso']);

	}


?>
<!DOCTYPE html >
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Language" content="es-ar">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="style2.css" />
<script src="js/ordenTabla.js" type="text/javascript"></script>


<title>Estudiantes que adeudan <?=$pendientes[$materia]?> </title>

</head>
<?
include 'header.php';

?>
<body>
<?

?>

<div align="center" style="max-width: 980px">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
<?PHP // Selector de materia ?>
<form method='GET' action='<?=$_SERVER['PHP_SELF']?>' >
	<div><br><br>
		<p>Espacio curricular:
		<select name="idmat" onchange='this.form.submit()'>
<?php foreach($pendientes AS $id => $descrip) {
	if ($materia==$id) $sel = "selected";
	else $sel="";
	echo '<option value="' . $id . '" ' . $sel . '>' . $descrip . '</option>';
} ?>
		</select>
		</p>
	</div>
</form>

<?PHP // Tabla de muestra ?>
<table border="0" width="980">
	<tr>
		<td>

			<div align="center">

<?
//echo "<!-- " . var_export($materias,true) . " -->";
?>
<br><br>

	<table border="1" id="sinTitular" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
		<thead><tr>
			<th onclick="sortTable(0,'sinTitular')">Apellido y Nombre</th>
			<th onclick="sortTable(1,'sinTitular')">DNI</th>
			<th onclick="sortTable(2,'sinTitular')">Curso</th>
			<th onclick="sortTable(3,'sinTitular')">Divisi&oacute;n</th>
			<th onclick="sortTable(4,'sinTitular')">A&ntilde;o/s adeudado/s</th>
		</tr></thead>
		<tbody>

<?php
foreach ($estudiantes AS $doc => $datos) {
	echo "<tr class='alte'><td>" . $datos['nya'] . "</td>";
	echo "<td>" . $datos['dni'] . "</td>";
	echo "<td>" . $datos['tel'] . "</td>";
	echo "<td>" . $datos['mail'] . "</td>";
	echo "<td>";
	foreach ($materias[$doc] AS $cur => $datosAde) if($cur==14) echo "A. A. "; else echo $cur . "° ";
	echo "</td>";
}
	echo "</tr>";
?>
		</tbody></table>
<script>sortTable(0,'sinTitular');</script>
			</div>
		</td>
	</tr>
</table>

</div>
<br>

<?
include 'footer.php';
?>

</body>
<?

?>


</html>
