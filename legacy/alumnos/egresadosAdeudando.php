<?PHP
/* Muestra estudiantes egresados que adeudan materias,
** para cada espacio curricular de todos los años adeudados.
*
*  TODO Mostrar que no hay estudiantes para el espacio seleccionado en el año elegido
*/
session_start();

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

if (isset($_GET['cl'])) {
	switch ($_GET['cl']) {
		//Esto debe modificarse para que pueda incorporar a egresados más recientes
		case 2018:
		 $_SESSION['anioEgreso'] = 2018;
		 break;
		case 2019:
		 $_SESSION['anioEgreso'] = 2019;
		 break;
		case 2020:
		 $_SESSION['anioEgreso'] = 2020;
		 break;
		case 2021:
		 $_SESSION['anioEgreso'] = 2021;
		 break;
		case 2022:
		 $_SESSION['anioEgreso'] = 2022;
		 break;
		case 2023:
		 $_SESSION['anioEgreso'] = 2023;
		 break;
	}
}

if (isset($_SESSION['anioEgreso'])) $ciclo = $_SESSION['anioEgreso'];
else {
	$ciclo = $_SESSION['cicloLectivo'];
	$ciclo--;
	$_SESSION['anioEgreso'] = $ciclo;
}


$q_pendientes = mysql_query("SELECT * FROM materias2023 WHERE idmateria IN (SELECT DISTINCT idmateria FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE `curso` LIKE '6' AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria < 1000)");

$pendientes = array();
while($datosPend = mysql_fetch_assoc($q_pendientes)) $pendientes[$datosPend['idmateria']] = $datosPend['descripcion'];

if (isset($_GET['idmat'])) $materia = $_GET['idmat'];
else $materia = ''; //$materia = array_rand($pendientes);

asort($pendientes);

$q_materias = mysql_query("SELECT * FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE `curso` LIKE '6' AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria = '$materia'");

$q_estudiantes = mysql_query("SELECT dni,CONCAT(apellido,' ',nombre) AS nya,tel,mail FROM alumno WHERE dni IN (SELECT DISTINCT alumno FROM `previas` WHERE alumno IN (SELECT alumno FROM `cursa` WHERE `curso` LIKE '6' AND `anio` LIKE '$ciclo') AND nota < 6 AND idmateria = '$materia')");

$q_aniosEgreso = mysql_query("SELECT DISTINCT anio FROM `cursa` WHERE ((curso LIKE '6' AND `modalidad` < 6) OR (curso LIKE '7' AND `modalidad` = 6)) AND anio != YEAR(CURDATE()) ORDER BY anio");

$materias = array();
while($datosMat=mysql_fetch_assoc($q_materias)) $materias[$datosMat['alumno']][$datosMat['curso']] = $datosMat;

$estudiantes = array();
while($datosEst = mysql_fetch_assoc($q_estudiantes)) $estudiantes[$datosEst['dni']] = $datosEst;

$aniosEgreso = array();
while($datosAni = mysql_fetch_assoc($q_aniosEgreso)) $aniosEgreso[] = $datosAni['anio'];

?>
<!DOCTYPE html >
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Language" content="es-ar">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="style2.css" />
<script src="js/ordenTabla.js" type="text/javascript"></script>

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script> -->
<title>Egresaron en <?=$ciclo?> y adeudan <?=$pendientes[$materia]?> </title>

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
<form method='GET' action='<?=$_SERVER['PHP_SELF']?>' >
	<div><br><br>
		<p>Espacio curricular:
		<select name="idmat" onchange='this.form.submit()'>
			<option value=''>Elegir espacio curricular</option>
<?php foreach($pendientes AS $id => $descrip) {
	if ($materia==$id) $sel = "selected";
	else $sel="";
	echo '<option value="' . $id . '" ' . $sel . '>' . $descrip . '</option>';
} ?>
		</select>
		</p>
	</div>
</form>
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
			<th onclick="sortTable(2,'sinTitular')">Nro. de Contacto</th>
			<th onclick="sortTable(3,'sinTitular')">Correo Electónico</th>
			<th onclick="sortTable(4,'sinTitular')">Años adeudados</th>
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
<script>
	sortTable(0,'sinTitular');
/*	< ?=($materia=="")?     ? >  */
</script>
			</div>
		</td>
	</tr>
</table>
<div>
	<table>
		<tr>
		<td>Año de egreso:</td>
		<?PHP
//		echo var_export($aniosEgreso,true);
		foreach ($aniosEgreso AS $a) printf("<td><a href='%s?cl=%s&idmat=%s'>%s</a></td>",$_SERVER['PHP_SELF'],$a,$materia,$a);?>
		</tr>
	</table>
</div>
</div>
<br>
<!-- <div><a href='<?=$_SERVER['PHP_SELF']?>'>Último año</a> - <a href='<?=$_SERVER['PHP_SELF']?>?cl=2021'>2021</a> - <a href='<?=$_SERVER['PHP_SELF']?>?cl=2019'>2019</a></div><br> -->
<?
include 'footer.php';
?>

</body>
<?

?>


</html>
