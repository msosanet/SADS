<?PHP
/*
 * Agregar columna para repitentes
 *
 * */

// Devuelve "alumnos cursando.csv" con tabla de alumnos con curso asignado
// en el presente ciclo lectivo. Datos: DNI/Apellido/Nombre/Sexo/Curso/División
// incorporados al curso entre las fechas 'desde' y 'hasta'

session_start();
if ($_SESSION['estado']!=1) exit();
include 'conexion.php';

$ext=".csv";
$nombre="alumnos cursando del ".date("Ymd").$ext;
$anio=date("Y");

function busca_edad($fecha_nacimiento){
 $dia=30;
 $mes=06;
 $ano=date("Y");

 $dianaz=date("d",strtotime($fecha_nacimiento));
 $mesnaz=date("m",strtotime($fecha_nacimiento));
 $anonaz=date("Y",strtotime($fecha_nacimiento));

//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

 if (($mesnaz == $mes) && ($dianaz > $dia)) $ano=($ano-1);

//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

 if ($mesnaz > $mes) $ano=($ano-1);

//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

 $edad=($ano-$anonaz);
 return $edad;
}


// Establece el formato del documento como planilla de Excel
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

if (isset($_GET["desde"]) && isset($_GET["hasta"])) {
//falta ordenar desde<<hasta *********************************************
$desde=date("Y-m-d",strtotime($_GET["desde"]));
$hasta=date("Y-m-d",strtotime($_GET["hasta"]));

// Conecta a la BD
$conexion = conectar ();

// Establece quién obtuvo el listado
$usuario = $_SESSION['usuario'];
$result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
$fila = mysql_fetch_array($result) ;

// Nombre y apellido de quién obtuvo el listado. Fecha de obtenido
	echo "Listado de estudiantes cursando desde el " . date("j/n/Y",strtotime($desde)) . " y al d�a " . date("j/n/Y",strtotime($hasta)) . " obtenido el " . date("j/n/Y") . " por " . $fila['nombre'] . " " . $fila['apellido'] . "\n";

// Encabezado de columnas
	echo "DNI;";
	echo "APELLIDO;";
	echo "NOMBRE;";
	echo "Sexo;";
	echo "Edad al 30/6;";
	echo "F. Nacimiento;";
	echo "Curso;";
	echo "Div;";
	echo "Fecha Ingreso;";
	echo "Fecha de Pase;";
	echo "Pais de nacimiento;";
	echo "CUD;";
	echo "At. especial;";
//	echo "Libro;";
//	echo "Folio";
	echo "\n";

// Consulta a la BD
//$result = mysql_query ("SELECT alumno.*,cursa.* FROM alumno,cursa,(SELECT alumno AS a,MAX(fecha) AS f FROM `cursa` WHERE `fecha` BETWEEN '$desde' AND '$hasta' AND curso NOT LIKE 'E' GROUP BY alumno ORDER BY alumno) AS ultMov WHERE cursa.alumno = ultMov.a AND cursa.fecha = ultMov.f AND alumno.dni = cursa.alumno ORDER BY cursa.curso,cursa.divi,alumno.apellido,alumno.nombre");
//$result = mysql_query ("SELECT alumno.*,cursa.*,folio.* FROM alumno,cursa,(SELECT alumno AS a,MAX(fecha) AS f FROM `cursa` WHERE `fecha` BETWEEN '$desde' AND '$hasta' AND curso NOT LIKE 'E' GROUP BY alumno ORDER BY alumno) AS ultMov,folio WHERE cursa.alumno = ultMov.a AND cursa.fecha = ultMov.f AND alumno.dni = cursa.alumno AND folio.dni = alumno.dni ORDER BY cursa.curso,cursa.divi,alumno.apellido,alumno.nombre");
//$result = mysql_query ("SELECT folio.libro,folio.folio,folio.archivo,alu_fechas.* FROM folio RIGHT JOIN (SELECT alumno.*,cursa.* FROM alumno,cursa,(SELECT alumno AS a,MAX(fecha) AS f FROM `cursa` WHERE `fecha` BETWEEN '$desde' AND '$hasta' AND curso NOT LIKE 'E' AND pase LIKE '0000-00-00' GROUP BY alumno ORDER BY alumno) AS ultMov WHERE cursa.alumno = ultMov.a AND cursa.fecha = ultMov.f AND alumno.dni = cursa.alumno) AS alu_fechas ON alu_fechas.dni = folio.dni ORDER BY curso,divi,apellido,nombre");
$result = mysql_query ("SELECT folio.libro,folio.folio,folio.archivo,alu_fechas.* FROM folio RIGHT JOIN (SELECT alumno.*,cursaParcial.* FROM alumno CROSS JOIN (SELECT cursa.* FROM cursa CROSS JOIN (SELECT alumno,MAX(fecha) AS ulMov FROM `cursa` WHERE `fecha` BETWEEN '$desde' AND '$hasta' AND curso NOT LIKE 'E' GROUP BY alumno) AS actual ON actual.alumno = cursa.alumno AND actual.ulMov = cursa.fecha WHERE (pase > '$hasta' OR pase LIKE '0000-00-00')) cursaParcial ON cursaParcial.alumno = alumno.dni) AS alu_fechas ON alu_fechas.dni = folio.dni ORDER BY curso,divi,apellido,nombre");


// Volcado de datos de la consulta en la tabla
	while ($fila2 = mysql_fetch_assoc($result)) {
		$docum = mysql_query("SELECT * FROM `docu_alu` WHERE `id` IN (19,22) AND alumno='$fila2[dni]'");
		while ($tiene = mysql_fetch_assoc($docum)){
		 switch ($tiene['id']) {
		  case 19:
		   if ($tiene['descripcion'] != "No") $cud = "Si"; // preguntar si prefiere la Obs.
		   break;
		  case 22:
		   if ($tiene['descripcion'] != "No") $at_esp = "Si";
		   break;
		 }
		}

		if ($fila2['f_nac'] == "0000-00-00" OR $fila2['f_nac'] == "0") $nacimiento = 'S/D';
		else $nacimiento = date("d/m/Y",strtotime($fila2['f_nac']));
		if ($fila2['f_ingreso'] == "0000-00-00" OR $fila2['f_ingreso'] == "0") $ingreso = 'S/D';
		else $ingreso = date("d/m/Y",strtotime($fila2['f_ingreso']));
		if ($fila2['pase'] == "0000-00-00" OR $fila2['pase'] == "0") $pase = '-';
		else $pase = date("d/m/Y",strtotime($fila2['pase']));
		if (!isset($cud)) $cud = "No";
		if (!isset($at_esp)) $at_esp = "No";

		echo"$fila2[dni];";
		echo"$fila2[apellido];";
		echo"$fila2[nombre];";
		echo"$fila2[sexo];";
		echo busca_edad($fila2['f_nac']) . ";";
		echo $nacimiento . ";";
		echo"$fila2[curso];";
		echo"$fila2[divi];";
		echo $ingreso . ";";
		echo $pase . ";";
		echo"$fila2[pais];";
		echo $cud . ";";
		echo $at_esp . ";";
//		echo "$fila2[libro];";
//		echo "$fila2[folio]";
		echo"\n";

		unset($cud);
		unset($at_esp);
	}
	mysql_free_result();
}
else { // En caso de no haber enviado las fechas "desde" y "hasta" en la URL
	echo "La consulta no devuelve datos\n";
}
?>
