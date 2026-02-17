<?PHP
// Devuelve "alumnos de 6to año datos y previas.csv" con tabla de alumnos de todos los 6tos, incorpora datos 
// personales, de archivo y trámites, ademàs las materias adeudadas.

session_start();
include 'conexion.php';


// $anio=date("Y");
$anio = 2022;
$curso = 5;
$ext=".csv";
//$ext=".html";
$nombre="previas por curso".$curso.$ext;

// Establece el formato del documento como planilla de Excel
header("Content-type: application/vnd.ms-excel" ) ;
//header("Content-type: text/html; charset=windows-1252" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

// Conecta a la BD
$conexion = conectar ();

// Establece quién obtuvo el listado
$usuario = $_SESSION['usuario'];
$result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
$fila = mysql_fetch_array($result) ;

// Establece el número de columnas de materias adeudadas para que quepan todas las que adeuda el estudiate con
// mayor cantidad de materias adeudadas

$total_adeudadas = mysql_query("SELECT MAX(adeuda) as materias FROM (SELECT p.alumno,COUNT(p.alumno) AS adeuda FROM previas AS p,(SELECT alumno FROM cursa WHERE curso = '$curso' AND anio = '$anio' AND control = 1) AS c WHERE p.`nota` < 6 AND p.alumno = c.alumno GROUP BY p.alumno) AS adeudan");
$consultaNroMat = mysql_fetch_assoc($total_adeudadas);
$max_ade = $consultaNroMat['materias']+1;

// Nombre y apellido de quién obtuvo el listado. Fecha de obtenido
	echo "Listado obtenido el " . date("j/n/Y") . " por " . $fila['nombre'] . " " . $fila['apellido'] . "\n";

// Encabezado de columnas
	echo "CURSO;";
	echo "DIV;";
	echo "TURNO;";
	echo "DNI;";
	echo "APELLIDO Y NOMBRE";
	for ($nro=1;$nro<$curso;$nro++) { 
		echo ";Año ". ($nro);
	}
	echo "\n";

// Consulta a la BD
	$est_curso_q = "SELECT cursa.curso,cursa.divi,cursa.alumno,UCASE(alumno.apellido) AS ape,LCASE(alumno.nombre) AS nom FROM cursa LEFT JOIN alumno ON cursa.alumno = alumno.dni WHERE cursa.curso = $curso AND cursa.control=1 ORDER BY cursa.curso,cursa.divi";
	$est_curso_r = mysql_query($est_curso_q);
	
// Volcado de datos de la consulta en la tabla 
	while ($est_curso = mysql_fetch_array($est_curso_r)) {
	 
		$adeuda_q = "SELECT materia FROM `previas` WHERE nota < 6 AND alumno = $est_curso[alumno]";
		$adeuda_r = mysql_query($adeuda_q);
		
		if (mysql_num_rows($adeuda_r)) {
			echo $curso . "; ";
			echo $est_curso['divi'] . "; ";
			echo "; ";
			echo $est_curso['alumno'] . "; ";
			echo trim($est_curso['ape']) . ", " . ucwords(trim($est_curso['nom']));
			for ($nro=1;$nro<$curso;$nro++) {
				$adeAlu_q = "SELECT materia FROM `previas` WHERE materia LIKE '%" .$nro."%' AND nota < 6 AND alumno = $est_curso[alumno]";
				$adeAlu_r = mysql_query($adeAlu_q);
				$adeudadas ="";
				while ($adeuda = mysql_fetch_assoc($adeAlu_r)) {
					$adeudadas .= trim($adeuda['materia']) . ", ";
				}
				echo ";" . rtrim($adeudadas,", ");
			}
			echo "\n";
		}
	 
	}
		
		
/*
		$previ=mysql_query("SELECT * FROM `previas` WHERE `nota`<6 AND alumno=$est_curso[alumno]"); //consulta previas
		$cant = mysql_num_rows($previ);
		if ($cant==0 ) {
			for ($col=1;$col<$max_ade;$col++) {
				echo";";
			}
			echo"\n";
		}
		else {
			$col=1;
			while ($ade=mysql_fetch_array($previ)) {
				echo $ade[materia] . ";";
				$col++;
			}
						for ($col;$col<$max_ade;$col++) {
				echo";";
			}
			echo"\n";
		} */
/*		if (mysql_num_rows($previ)){

			echo"<td align='center'>" . mysql_num_rows($previ) . "</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>" . mysql_error($previ). "</td>";}
		*/

?>
