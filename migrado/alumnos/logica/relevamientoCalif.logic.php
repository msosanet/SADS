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

