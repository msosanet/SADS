<?PHP
// Devuelve "Egresados sin titular del 'año anterior'.csv" con tabla de alumnos de todos los 6tos, 
// que adeudan materias. Incorpora datos de división, teléfono y domicilio.

session_start();
include 'conexion.php';

$anio = date("Y");
$anio--;
$ext=".csv";
$nombre="Egresados sin titular del ".$anio.$ext;

// Establece el formato del documento como planilla de Excel
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

// Conecta a la BD
$conexion = conectar ();

// Establece quién obtuvo el listado
$usuario = $_SESSION['usuario'];
$result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
$fila = mysql_fetch_array($result) ;

// Nombre y apellido de quién obtuvo el listado. Fecha de obtenido
	echo "Listado obtenido el " . date("j/n/Y") . " por " . $fila[nombre] . " " . $fila[apellido] . "\n";

// Encabezado de columnas
	echo "DNI;";
	echo "Apellido y Nombre;";
	echo "Curso;";
	echo "Div;";
	echo "Domicilio;";
	echo "Telefono";
	echo "\n";

// Consulta a la BD
		$result = mysql_query ("SELECT sTit.alumno,sTit.divi,alumno.apellido,alumno.nombre,alumno.domicilio,alumno.tel FROM (SELECT previas.alumno,egre.divi FROM `previas`,(SELECT alumno,divi FROM cursa WHERE curso = 'E' AND anio = $anio AND control = 1) as egre WHERE previas.alumno = egre.alumno AND previas.nota < 6 GROUP BY previas.alumno) AS sTit LEFT JOIN alumno ON sTit.alumno = alumno.dni "); //Esta consulta se realiza sobre los Egresados en lugar de 6to año

// Volcado de datos de la consulta en la tabla 
	while ($fila2 = mysql_fetch_array($result)) {
		
		echo "$fila2[alumno];";
		echo "$fila2[apellido]" .", ". "$fila2[nombre];";
		echo "6;";
		echo "$fila2[divi];";
		echo "$fila2[domicilio];";
		echo "$fila2[tel]";
		echo"\n";
/*		if (mysql_num_rows($previ)){

			echo"<td align='center'>" . mysql_num_rows($previ) . "</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>" . mysql_error($previ). "</td>";}
		*/
		}

?>