<?PHP
// Devuelve "alumnos de 6to año datos y previas.csv" con tabla de alumnos de todos los 6tos, incorpora datos
// personales, de archivo y trámites, ademàs las materias adeudadas.

// TODO Revisar la determinación de año y curso para que funcione más allá de los cambios de año

session_start();
include 'conexion.php';

$ext=".csv";
$nombre="alumnos de 6to año desde 2020 Datos y previas".$ext;
//$anio=date("Y");
/*$anio = $_SESSION['cicloLectivo']-1;
$curso = 'E';*/
// Modificación transitoria para obtener egresados desde 2020
$anio = "(2020,2021,2022,2023,2024)";
$curso = "('E','L')"; //Mejorar acá

// Establece el formato del documento como planilla de Excel
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

// Conecta a la BD
$conexion = conectar ();

// Establece quién obtuvo el listado
$usuario = $_SESSION['usuario'];
$result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
$fila = mysql_fetch_array($result) ;

// Establece el número de columnas de materias adeudadas para que quepan todas las que adeuda el estudiate con
// mayor cantidad de materias adeudadas

$total_adeudadas = mysql_query("SELECT MAX(adeuda) as materias FROM (SELECT p.alumno,COUNT(p.alumno) AS adeuda FROM previas AS p,(SELECT alumno FROM cursa WHERE curso IN $curso AND anio IN $anio AND control = 1) AS c WHERE p.`nota` < 6 AND p.alumno = c.alumno GROUP BY p.alumno) AS adeudan");
$consultaNroMat = mysql_fetch_assoc($total_adeudadas);
$max_ade = $consultaNroMat['materias']+1;
//$_depuracion[] = mysql_error();

// Nombre y apellido de quién obtuvo el listado. Fecha de obtenido
	echo "Listado obtenido el " . date("j/n/Y") . " por " . $fila['nombre'] . " " . $fila['apellido'] . "\n";

// Encabezado de columnas
	echo "APELLIDO;";
	echo "NOMBRE;";
	echo "DNI;";
	echo "CURSO;";
	echo "DIV;";
	echo "Año;";
	echo "Libro;";
	echo "Folio;";
	echo "Disposicion;";
	echo "Nota informe";
	for ($nro=1;$nro<$max_ade;$nro++) {
		echo ";Adeuda ". $nro;
	}
	echo "\n";

// Consulta a la BD
// $result = mysql_query ("SELECT `alumno`.`apellido`,`alumno`.`nombre`,`cursa`.`alumno`,`cursa`.`divi`,`folio`.`libro`,`folio`.`folio`,`alumno`.`dispo`,`alumno`.`ninforme` FROM `cursa`,`alumno`,`folio` WHERE `cursa`.`curso` LIKE '$curso' AND `cursa`.`anio` = '$anio' AND `cursa`.`control` = 1 AND `alumno`.`dni` = `cursa`.`alumno` AND `folio`.`dni` = `cursa`.`alumno`"); //Esta consulta se realiza sobre los Egresados en lugar de 6to año
$result = mysql_query("SELECT egresados.*,folio.libro,folio.folio FROM (SELECT `alumno`.`apellido`,`alumno`.`nombre`,`cursa`.`alumno`,`cursa`.`divi`,`cursa`.`anio`,`alumno`.`dispo`,`alumno`.`ninforme` FROM `cursa`LEFT JOIN alumno ON alumno.dni = cursa.alumno WHERE `cursa`.`curso` IN $curso AND `cursa`.`anio` IN $anio AND `cursa`.`control` = 1) AS egresados LEFT JOIN folio ON egresados.alumno = folio.dni ");
//$_depuracion[] = mysql_error();

// Volcado de datos de la consulta en la tabla
	while ($fila2 = mysql_fetch_array($result)) {

		echo"$fila2[apellido];";
		echo"$fila2[nombre];";
		echo"$fila2[alumno];";
		echo"6;";
		echo"$fila2[divi];";
		echo"$fila2[anio];";
		echo"$fila2[libro];";
		echo"$fila2[folio];";
		echo"$fila2[dispo];";
		echo"$fila2[ninforme];";


//		$previ=mysql_query("SELECT * FROM `previas` WHERE `nota`<6 AND alumno=$fila2[alumno]"); //tabla obsoleta
		$previ=mysql_query("SELECT materias2023.*,previas.* FROM `previas` LEFT JOIN materias2023 ON materias2023.idmateria = previas.idmateria WHERE `nota`<6 AND alumno=$fila2[alumno]"); //consulta previas
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
				echo ucwords(strtolower($ade['descripcion'])) . " " . $ade['curso'] . ";";
				$col++;
			}
						for ($col;$col<$max_ade;$col++) {
				echo";";
			}
			echo"\n";
		}
/*		if (mysql_num_rows($previ)){

			echo"<td align='center'>" . mysql_num_rows($previ) . "</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>" . mysql_error($previ). "</td>";}
		*/
		}
//		echo var_export($_depuracion,true);

?>
