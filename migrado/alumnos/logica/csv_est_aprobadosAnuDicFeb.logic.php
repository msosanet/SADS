<?PHP
/* csv_est_aprobadosAnuDicFeb.php
 * Devuelve "alumnos cursando.csv" con tabla de alumnos con curso asignado
 * en el presente ciclo lectivo. Datos: DNI/Apellido/Nombre/Sexo/Curso/DivisiÃ³n
 * incorporados al curso entre las fechas 'desde' y 'hasta'
 *
 * Incorporar para el ciclo 2025 una columna con cantidad de previas adeudadas. am
 */

session_start();
include 'conexion.php';


$ext=".csv";
$nombre="calificaciones de cierre al " . date("Y-m(M)-d")  .$ext;

$anio_cur = 2024;
$sig_anio = 2025;

// Establece el formato del documento como planilla de Excel
header("Content-type: application/vnd.ms-excel; charset=windows-1252" ) ;
header("Content-Disposition: attachment; filename=$nombre" );


$conexion = conectar ();

// elecciÃ³n de ciclo lectivo
if (isset($_GET['ciclo'])) $ciclo = ($_GET['ciclo']== 'o') ? 456 : 123;
else $ciclo = 123;

// Establece quiÃ©n obtuvo el listado
$usuario = $_SESSION['usuario'];
$result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
$fila = mysql_fetch_array($result) ;

mysql_select_db("calificadores");

//Cantidad de materias curriculares por seccion
$q_cantMat = "SELECT matcur.idcurso,count(matcur.idmateria) AS canti FROM `matcur` INNER JOIN materias ON materias.idmateria = matcur.idmateria WHERE curricular = 1 AND matcur.idmateria != 65 GROUP BY idcurso";
$__cantMat = mysql_query($q_cantMat);
$cantMat = [];
while($c = mysql_fetch_assoc($__cantMat)) $cantMat[$c['idcurso']] = $c['canti'];

//Espacios curriculares del diseÃ±o $espacios
$q_espacios['123'] = "SELECT * FROM materias WHERE materias.idmateria IN (SELECT DISTINCT idmateria FROM `matcur` WHERE `idcurso` LIKE '1_' OR `idcurso` LIKE '2_' OR `idcurso` LIKE '3_' /*todas las materias del CB*/) AND idmateria != 65 AND curricular != 0 ";
$q_espacios['456'] = "SELECT * FROM materias WHERE materias.idmateria IN (SELECT DISTINCT idmateria FROM `matcur` WHERE `idcurso` LIKE '4_' OR `idcurso` LIKE '5_' OR `idcurso` LIKE '6_' /*todas las materias del CB*/) AND idmateria != 65 AND curricular != 0 ";

$__espacios = mysql_query("$q_espacios[$ciclo]");
$espacios = [];
while($e = mysql_fetch_assoc($__espacios)) $espacios[$e['idmateria']] = $e;

//estudiantes que estuvieron hasta fin del ciclo $estudiantes
$f_desde = $anio_cur . "-01-31";
$f_hasta = $sig_anio . "-03-06";
$fin_anio = $anio_cur . "-12-31";

$q_estudiantes['123'] = "SELECT dni,apellido,nombre,sexo,curso,divi FROM alumno RIGHT JOIN (SELECT cursa.* FROM cursa RIGHT JOIN (SELECT alumno,MAX(fecha) AS fecha FROM cursa WHERE fecha BETWEEN '" . $f_desde . "' AND '" . $f_hasta . "' AND divi NOT LIKE '-%' AND anio = " . $anio_cur . " GROUP BY alumno) AS ucd ON ucd.alumno = cursa.alumno AND ucd.fecha = cursa.fecha WHERE `curso` IN ('1','2','3') /*ultimo curso y division para los que cursaron en el aÃ±o*/ AND (pase = 0 OR pase > '" . $fin_anio . "') /*solo los que estuvieron en el colegio*/) cursando ON cursando.alumno = alumno.dni";
$q_estudiantes['456'] = "SELECT dni,apellido,nombre,sexo,curso,divi FROM alumno RIGHT JOIN (SELECT cursa.* FROM cursa RIGHT JOIN (SELECT alumno,MAX(fecha) AS fecha FROM cursa WHERE fecha BETWEEN '" . $f_desde . "' AND '" . $f_hasta . "' AND divi NOT LIKE '-%' AND anio = " . $anio_cur . " GROUP BY alumno) AS ucd ON ucd.alumno = cursa.alumno AND ucd.fecha = cursa.fecha WHERE `curso` IN ('4','5','6') /*ultimo curso y division para los que cursaron en el aÃ±o*/ AND (pase = 0 OR pase > '" . $fin_anio . "') /*solo los que estuvieron en el colegio*/) cursando ON cursando.alumno = alumno.dni";

$__estudiantes = mysql_query($q_estudiantes[$ciclo]);
$estudiantes = [];
while($alu = mysql_fetch_assoc($__estudiantes)) $estudiantes[$alu['dni']] = $alu;

//calificaciones obtenidas por los estudiantes en las 3 instancias
$q_calificaciones['123'] = "SELECT calificador2.*, notas.valor FROM `calificador2` RIGHT JOIN notas ON calificador2.nota = notas.id WHERE (`curso` LIKE '1%' OR `curso` LIKE '2%' OR `curso` LIKE '3%') AND materia != 65 AND `anio` = " . $anio_cur . " AND `idnota` IN (7,8,9,10)";
$q_calificaciones['456'] = "SELECT calificador2.*, notas.valor FROM `calificador2` RIGHT JOIN notas ON calificador2.nota = notas.id WHERE (`curso` LIKE '4%' OR `curso` LIKE '5%' OR `curso` LIKE '6%') AND materia != 65 AND `anio` = " . $anio_cur . " AND `idnota` IN (7,8,9,10)";

$__calificaciones = mysql_query($q_calificaciones[$ciclo]);
$calificaciones = [];
while($cal = mysql_fetch_assoc($__calificaciones)) {
	$estudiantes[$cal['dni']][$cal['materia']][$cal['idnota']] = $cal;
	if (!isset($estudiantes[$cal['dni']]['cd'])) $estudiantes[$cal['dni']]['cd'] = $cal['curso'];
}

//nombre de espacios

$estuLinea = [];
foreach($estudiantes AS $evaluado) {
	$estuLinea[$evaluado['dni']]['ape'] = $evaluado["apellido"];
	$estuLinea[$evaluado['dni']]['nom'] = $evaluado["nombre"];
	$estuLinea[$evaluado['dni']]['c'] = $evaluado["curso"];
	$estuLinea[$evaluado['dni']]['d'] = $evaluado["divi"];
	$estuLinea[$evaluado['dni']]['s'] = $evaluado["sexo"];

	foreach ($espacios AS $id => $mat) {
		if (isset($evaluado[$id])) {
			foreach ($evaluado[$id] AS $matCalifs) {
//				echo var_export($matCalifs,true);
				if ($matCalifs['idnota'] == 9) $resultados[9][$matCalifs['materia']] = $matCalifs['valor'];
				if (empty($resultados[9][$matCalifs['materia']])) $resultados[9][$matCalifs['materia']] = '';
				if ($matCalifs['idnota'] == 7) $resultados[7][$matCalifs['materia']] = $matCalifs['valor'];
				if (empty($resultados[7][$matCalifs['materia']])) $resultados[7][$matCalifs['materia']] = '';
				if ($matCalifs['idnota'] == 8) $resultados[8][$matCalifs['materia']] = $matCalifs['valor'];
				if (empty($resultados[8][$matCalifs['materia']])) $resultados[8][$matCalifs['materia']] = '';
				if ($matCalifs['idnota'] == 10) $resultados[10][$matCalifs['materia']] = $matCalifs['valor'];
				if (empty($resultados[10][$matCalifs['materia']])) $resultados[10][$matCalifs['materia']] = '';
			}
		}
		else $resultados[7][$id] = $resultados[8][$id] = $resultados[9][$id] = $resultados[10][$id] = "";
	}

	$estuLinea[$evaluado['dni']]['cantMat'] = $cantMat[$evaluado['cd']];

	$estuLinea[$evaluado['dni']] = $estuLinea[$evaluado['dni']] + $resultados;
//	echo $evaluado['dni'] . var_export($estuLinea[$evaluado['dni']],true) . "\n";
	$resultados = [];
}


//echo var_export($estuLinea,true) . "\n\n" . var_export($estudiantes,true);

// Encabezado de columnas
	echo "Documento;";
	echo "APELLIDO;";
	echo "NOMBRE;";
	echo "Sexo;";
	echo "Curso;";
	echo "Div;";
	echo "Instancia;";
	foreach ($espacios AS $nomMat) echo $nomMat['descripcion'] . ";";
//	echo "Fecha Ingreso";
	echo "cant. Materias;";
	echo "\n";

foreach ($estuLinea AS $alu => $tablaExcel) {
	if (isset($tablaExcel['9'])) {
		echo $alu . ";";
		echo $tablaExcel['ape'] . ";";
		echo $tablaExcel['nom'] . ";";
		echo $tablaExcel['s'] . ";";
		echo $tablaExcel['c'] . ";";
		echo $tablaExcel['d'] . ";";
		echo "a;";
		foreach($tablaExcel['9'] AS $nota) {
			echo $nota . ";";
		}
		echo $tablaExcel['cantMat'] . ";";
		echo "\n";
	}
	if (isset($tablaExcel['7'])) {
		echo $alu . ";";
		echo $tablaExcel['ape'] . ";";
		echo $tablaExcel['nom'] . ";";
		echo $tablaExcel['s'] . ";";
		echo $tablaExcel['c'] . ";";
		echo $tablaExcel['d'] . ";";
		echo "r;";
		foreach($tablaExcel['7'] AS $nota) {
			echo $nota . ";";
		}
		echo $tablaExcel['cantMat'] . ";";
		echo "\n";
	}
	if (isset($tablaExcel['8'])) {
		echo $alu . ";";
		echo $tablaExcel['ape'] . ";";
		echo $tablaExcel['nom'] . ";";
		echo $tablaExcel['s'] . ";";
		echo $tablaExcel['c'] . ";";
		echo $tablaExcel['d'] . ";";
		echo "f;";
		foreach($tablaExcel['8'] AS $nota) {
			echo $nota . ";";
		}
		echo $tablaExcel['cantMat'] . ";";
		echo "\n";
	}
	if (isset($tablaExcel['10'])) {
		echo $alu . ";";
		echo $tablaExcel['ape'] . ";";
		echo $tablaExcel['nom'] . ";";
		echo $tablaExcel['s'] . ";";
		echo $tablaExcel['c'] . ";";
		echo $tablaExcel['d'] . ";";
		echo "d;";
		foreach($tablaExcel['10'] AS $nota) {
			echo $nota . ";";
		}
		echo $tablaExcel['cantMat'] . ";";
		echo "\n";
	}

}

// Nombre y apellido de quiÃ©n obtuvo el listado. Fecha de obtenido
	echo "Listado obtenido el " . date("j/n/Y") . " por " . $fila['nombre'] . " " . $fila['apellido'] . "\n";

// printf("<pre>%s</pre>",htmlspecialchars(var_export($q_calificaciones,true)));

?>

