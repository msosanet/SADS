<?PHP
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

if (isset($_GET['mod'])) {
	switch($_GET['mod']) {
		case "cb":
		 $materias = "mat_cbceso";
		 $matricula = "q_alus_cbceso";
		 break;
		case "bt":
 		 $materias = "mat_pcest";
		 $matricula = "q_alus_pcest";
		 break;
		case "st":
 		 $materias = "mat_scest";
		 $matricula = "q_alus_scest";
		 break;
		case "on":
 		 $materias = "mat_cocn";
		 $matricula = "q_alus_cocn";
		 break;
		case "oc":
 		 $materias = "mat_cocom";
		 $matricula = "q_alus_cocom";
		 break;
		case "ot":
 		 $materias = "mat_cotur";
		 $matricula = "q_alus_cotur";
		 break;

	}
	$selected = $_GET['mod'];
}
else {
	$materias = "mat_cbceso";
	$matricula = "q_alus_cbceso";
	$selected = "cb";
}

$amREsp = mysql_select_db("calificadores");

$mat_cbceso = [47,34,43,67,59,6,4,32,17,27,22,44,66,41,71];
$mat_pcest = [47,34,43,67,59,6,4,32,17,27,22,44,66,41,71,68,87,69,73];
$mat_scest = [47,34,41,71,32,17,27,55,43,4,24,91,52,75,92,74,93,94,95,90,97,98];
$mat_cocn = [47,34,43,41,71,32,27,52,20,4,17,19,55,10,24,23,1,54,9,3];
$mat_cocom = [47,34,43,41,71,32,27,52,17,55,36,37,4,46,15,40,20,24,23,12,56,13];
$mat_cotur = [47,34,43,41,71,32,27,52,17,55,2,38,4,18,49,62,20,24,23,64,26,51,14];



$q_alus_cbceso = mysql_query(
	'SELECT CONCAT(alumno.apellido, " ",alumno.nombre) AS nya,alumno.dni,alumno.sexo,c.curso,c.divi 
	FROM alumno,( 
		SELECT cursa.* 
		FROM cursa,(SELECT alumno AS a,MAX(fecha) AS f FROM `cursa` WHERE `fecha` BETWEEN "2023-02-01" AND "2023-08-09" AND curso NOT LIKE "E" GROUP BY alumno ORDER BY alumno) ultima 
		WHERE cursa.alumno = ultima.a AND cursa.fecha = ultima.f AND (cursa.pase > "2023-06-15" OR cursa.pase = 0)) AS c 
	WHERE alumno.dni = c.alumno AND c.anio = 2023 AND c.curso IN (1,2,3) AND c.modalidad = 1 AND c.divi NOT LIKE "-" 
	ORDER BY curso,divi,nya');

$q_alus_pcest = mysql_query(
	'SELECT CONCAT(alumno.apellido, " ",alumno.nombre) AS nya,alumno.dni,alumno.sexo,c.curso,c.divi 
	FROM alumno,( 
		SELECT cursa.* 
		FROM cursa,(SELECT alumno AS a,MAX(fecha) AS f FROM `cursa` WHERE `fecha` BETWEEN "2023-02-01" AND "2023-08-09" AND curso NOT LIKE "E" GROUP BY alumno ORDER BY alumno) ultima 
		WHERE cursa.alumno = ultima.a AND cursa.fecha = ultima.f AND (cursa.pase > "2023-06-15" OR cursa.pase = 0)) AS c 
	WHERE alumno.dni = c.alumno AND c.anio = 2023 AND c.curso IN (1,2,3) AND c.modalidad = 2 AND c.divi NOT LIKE "-" 
	ORDER BY curso,divi,nya');

$q_alus_scest = mysql_query(
	'SELECT CONCAT(alumno.apellido, " ",alumno.nombre) AS nya,alumno.dni,alumno.sexo,c.curso,c.divi 
	FROM alumno,( 
		SELECT cursa.* 
		FROM cursa,(SELECT alumno AS a,MAX(fecha) AS f FROM `cursa` WHERE `fecha` BETWEEN "2023-02-01" AND "2023-08-09" AND curso NOT LIKE "E" GROUP BY alumno ORDER BY alumno) ultima 
		WHERE cursa.alumno = ultima.a AND cursa.fecha = ultima.f AND (cursa.pase > "2023-06-15" OR cursa.pase = 0)) AS c 
	WHERE alumno.dni = c.alumno AND c.anio = 2023 AND c.curso IN (4,5,6,7) AND c.modalidad = 2 AND c.divi NOT LIKE "-" 
	ORDER BY curso,divi,nya');

$q_alus_cocn = mysql_query(
	'SELECT CONCAT(alumno.apellido, " ",alumno.nombre) AS nya,alumno.dni,alumno.sexo,c.curso,c.divi 
	FROM alumno,( 
		SELECT cursa.* 
		FROM cursa,(SELECT alumno AS a,MAX(fecha) AS f FROM `cursa` WHERE `fecha` BETWEEN "2023-02-01" AND "2023-08-09" AND curso NOT LIKE "E" GROUP BY alumno ORDER BY alumno) ultima 
		WHERE cursa.alumno = ultima.a AND cursa.fecha = ultima.f AND (cursa.pase > "2023-06-15" OR cursa.pase = 0)) AS c 
	WHERE alumno.dni = c.alumno AND c.anio = 2023 AND c.curso IN (4,5,6) AND c.modalidad = 3 AND c.divi NOT LIKE "-" 
	ORDER BY curso,divi,nya');

$q_alus_cocom = mysql_query(
	'SELECT CONCAT(alumno.apellido, " ",alumno.nombre) AS nya,alumno.dni,alumno.sexo,c.curso,c.divi 
	FROM alumno,( 
		SELECT cursa.* 
		FROM cursa,(SELECT alumno AS a,MAX(fecha) AS f FROM `cursa` WHERE `fecha` BETWEEN "2023-02-01" AND "2023-08-09" AND curso NOT LIKE "E" GROUP BY alumno ORDER BY alumno) ultima 
		WHERE cursa.alumno = ultima.a AND cursa.fecha = ultima.f AND (cursa.pase > "2023-06-15" OR cursa.pase = 0)) AS c 
	WHERE alumno.dni = c.alumno AND c.anio = 2023 AND c.curso IN (4,5,6) AND c.modalidad = 4 AND c.divi NOT LIKE "-" 
	ORDER BY curso,divi,nya');

$q_alus_cotur = mysql_query(
	'SELECT CONCAT(alumno.apellido, " ",alumno.nombre) AS nya,alumno.dni,alumno.sexo,c.curso,c.divi 
	FROM alumno,( 
		SELECT cursa.* 
		FROM cursa,(SELECT alumno AS a,MAX(fecha) AS f FROM `cursa` WHERE `fecha` BETWEEN "2023-02-01" AND "2023-08-09" AND curso NOT LIKE "E" GROUP BY alumno ORDER BY alumno) ultima 
		WHERE cursa.alumno = ultima.a AND cursa.fecha = ultima.f AND (cursa.pase > "2023-06-15" OR cursa.pase = 0)) AS c 
	WHERE alumno.dni = c.alumno AND c.anio = 2023 AND c.curso IN (4,5,6) AND c.modalidad = 5 AND c.divi NOT LIKE "-" 
	ORDER BY curso,divi,nya');

$estud = array();
while ($estudiante = mysql_fetch_assoc($$matricula)) $estud[$estudiante['dni']] = $estudiante;


$notas = array();
$codigosMaterias = "(";
foreach ($$materias AS $idm) {
	$q_espacios = mysql_query("SELECT * FROM `calificador2` WHERE `materia` = '$idm' AND `anio` = '2023' AND `idnota` = 2 ");
	while ($espacios = mysql_fetch_assoc($q_espacios)) {
		$alu_esp = $espacios['dni'];
		$notas[$idm][$alu_esp] = $espacios['nota'];
	}
	$codigosMaterias .= $idm . ",";
}
$codigosMaterias = substr($codigosMaterias, 0, -1);
$codigosMaterias .= ")";

$q_nom_mat = mysql_query("SELECT * FROM `materias` WHERE idmateria IN $codigosMaterias");
$array_materias = array();
while ($nom_mat = mysql_fetch_assoc($q_nom_mat)) $array_materias[$nom_mat['idmateria']] = $nom_mat['descripcion'];

foreach ($estud AS $doc => $datos) {
	foreach ($$materias AS $idm) {
		if (isset($notas[$idm][$doc])) {
			switch ($notas[$idm][$doc]) {
			 case 1000:
			  $estud[$doc][$idm] = "S/VO";
			  break;
			 case 1001:
			  $estud[$doc][$idm] = "S/C";
			  break;
			 case NULL:
			  $estud[$doc][$idm] = "S/C";
			  break;
			 default:
			  $estud[$doc][$idm] = $notas[$idm][$doc];
			}
		}
		else $estud[$doc][$idm] = "S/C";
	}
	switch ($estud[$doc]['sexo']) {
		case "M":
		 $estud[$doc]['sexo'] = "Masculino";
		 break;
		case "F":
		 $estud[$doc]['sexo'] = "Femenino";
		 break;
		case "X":
		 $estud[$doc]['sexo'] = "No binario";
		 break;
	}
}

?>
<!DOCTYPE html >
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Language" content="es-ar">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="style2.css" />
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script> -->
<title>Relevamiento de trayectorias</title>

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
		<p>Modalidad y ciclo
		<select name="mod" onchange='this.form.submit()'>
		 <option value="cb" <?PHP if ($selected=="cb") echo "selected"; ?> >Ciclo básico Bachiller Orientado</option>
		 <option value="bt" <?PHP if ($selected=="bt") echo "selected"; ?>>Primer ciclo Educación Técnica</option>
		 <option value="on" <?PHP if ($selected=="on") echo "selected"; ?>>Ciclo orientado Bachiller en Ciencias Naturales</option>
		 <option value="oc" <?PHP if ($selected=="oc") echo "selected"; ?>>Ciclo orientado Bachiller en Comunicación Social</option>
		 <option value="ot" <?PHP if ($selected=="ot") echo "selected"; ?>>Ciclo orientado Bachiller en Turismo</option>
		 <option value="st" <?PHP if ($selected=="st") echo "selected"; ?>>Segundo ciclo Educación Técnica</option>
		</select>
		</p>
	</div>
</form>
<table border="0" width="980">
	<tr>
		<td>

			<div align="center">
 
<?
?>
<br><br>

	<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
		<thead><tr>
			<th>Apellido y Nombre</th>
			<th>DNI</th>
			<th>Género</th>
			<th>Discapacidad</th>
			<th>PPI</th>
<? foreach ($$materias AS $idm) echo "<th style='writing-mode: vertical-rl;'>" . $array_materias[$idm] . "</th>"; ?>
		</tr></thead>
		<tbody>

<?php
foreach ($estud AS $doc => $datos) {
	echo "<tr class='alte'><td>" . $datos['nya'] . "</td>";
	echo "<td>" . $datos['dni'] . "</td>";
	echo "<td>" . $datos['sexo'] . "</td>";
	echo "<td>" . $datos['curso'] . "</td>";
	echo "<td>" . $datos['divi'] . "</td>";
	foreach ($$materias AS $idm) echo "<td>" . $datos[$idm] . "</td>";
}
	echo "</tr>";
?>
		</tbody></table>

			</div>
<!-- <script>
		 let table = new DataTable('#table1', {
			language: {
				url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-AR.json',
		 },});
		 table.order([[3, 'asc'], [4,'asc'], [0,'asc']]).page.len( 40 ).draw();
</script> -->

		</td>
	</tr>
</table>
</div>
<?
include 'footer.php';
?>

</body>
<?

?>


</html>



