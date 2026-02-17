<?PHP
// Devuelve "alumnos cursando.csv" con tabla de alumnos con curso asignado 
// en el presente ciclo lectivo. Datos: DNI/Apellido/Nombre/Sexo/Curso/DivisiÃ³n
// incorporados al curso entre las fechas 'desde' y 'hasta'
/*
* SELECT alumno,curso2.idcurso,idmateria FROM `curso2`,cursa,matcur WHERE curso2.curso = cursa.curso AND curso2.division = cursa.divi AND matcur.idcurso = curso2.idcurso AND cursa.control = 1 AND cursa.anio = 2022
*
* CONCAT(calificador2.dni,calificador2.curso.,calificador2.materia)
* SELECT * FROM (SELECT CONCAT(alumno,curso2.idcurso,idmateria) acm,alumno,curso2.idcurso,idmateria FROM `curso2`,cursa,matcur WHERE curso2.curso = cursa.curso AND curso2.division = cursa.divi AND matcur.idcurso = curso2.idcurso AND cursa.control = 1 AND cursa.anio = 2022) AS est LEFT JOIN (SELECT CONCAT(alumno,curso2.idcurso,idmateria) acm,alumno,curso2.idcurso,idmateria FROM `curso2`,cursa,matcur WHERE curso2.curso = cursa.curso AND curso2.division = cursa.divi AND matcur.idcurso = curso2.idcurso AND cursa.control = 1 AND cursa.anio = 2022) AS connota ON est.acm = connota.acm
* CREATE OR REPLACE VIEW est AS SELECT CONCAT(alumno,curso2.idcurso,idmateria) acm,alumno,curso2.idcurso,idmateria FROM `curso2`,cursa,matcur WHERE curso2.curso = cursa.curso AND curso2.division = cursa.divi AND matcur.idcurso = curso2.idcurso AND cursa.control = 1 AND cursa.anio = 2022
*
*/
session_start();
if ($_SESSION['estado']!=1) exit();
include 'conexion.php';

$ext=".txt"; //csv
$nombre="sin calificacion anual ".date("Ymd").$ext;
$anio=$_SESSION['cicloLectivo'];
$anio--;

$aluMatCur_q = "SELECT alumno,curso2.idcurso,idmateria FROM `curso2`,cursa,matcur WHERE curso2.curso = cursa.curso AND curso2.division = cursa.divi AND matcur.idcurso = curso2.idcurso AND cursa.control = 1 AND cursa.anio = 2022 ";

$calificadosTodos = "SELECT * FROM `calificador2`,(SELECT alumno,curso2.idcurso,idmateria FROM `curso2`,cursa,matcur WHERE curso2.curso = cursa.curso AND curso2.division = cursa.divi AND matcur.idcurso = curso2.idcurso AND cursa.control = 1 AND cursa.anio = 2022 ) AS amc WHERE amc.alumno = calificador2.dni AND amc.idmateria = calificador2.materia AND amc.idcurso = calificador2.curso AND calificador2.idnota = 9";

$calificadosCero = "SELECT * FROM `calificador2`,(SELECT alumno,curso2.idcurso,idmateria FROM `curso2`,cursa,matcur WHERE curso2.curso = cursa.curso AND curso2.division = cursa.divi AND matcur.idcurso = curso2.idcurso AND cursa.control = 1 AND cursa.anio = 2022 ) AS amc WHERE amc.alumno = calificador2.dni AND amc.idmateria = calificador2.materia AND amc.idcurso = calificador2.curso AND calificador2.idnota = 9 AND calificador2.nota = 0 ";

function busca_edad($fecha_nacimiento){
 $dia=30;
 $mes=06;
 $ano=date("Y");

 $dianaz=date("d",strtotime($fecha_nacimiento));
 $mesnaz=date("m",strtotime($fecha_nacimiento));
 $anonaz=date("Y",strtotime($fecha_nacimiento));

//si el mes es el mismo pero el dÃ­a inferior aun no ha cumplido aÃ±os, le quitaremos un aÃ±o al actual

 if (($mesnaz == $mes) && ($dianaz > $dia)) $ano=($ano-1); 

//si el mes es superior al actual tampoco habrÃ¡ cumplido aÃ±os, por eso le quitamos un aÃ±o al actual

 if ($mesnaz > $mes) $ano=($ano-1);

//ya no habrÃ­a mas condiciones, ahora simplemente restamos los aÃ±os y mostramos el resultado como su edad
 
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

// Establece quiÃ©n obtuvo el listado
$usuario = $_SESSION['usuario'];
$result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
$fila = mysql_fetch_array($result) ;

// Nombre y apellido de quiÃ©n obtuvo el listado. Fecha de obtenido
	echo "Listado obtenido el " . date("j/n/Y") . " por " . $fila['nombre'] . " " . $fila['apellido'] . "\n";

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
	echo "Pais de nacimiento;";
	echo "CUD;";
	echo "At. especial";
	echo "\n";

// Consulta a la BD
$result = mysql_query ("SELECT alumno.dni, alumno.apellido, alumno.nombre, alumno.sexo, cursa.curso, cursa.divi, alumno.f_ingreso, alumno.pais,alumno.f_nac  FROM cursa RIGHT JOIN alumno ON alumno.dni = cursa.alumno WHERE cursa.anio = 2022 AND cursa.control = 1 AND cursa.fecha BETWEEN '$desde' AND '$hasta' ORDER BY cursa.curso,cursa.divi,alumno.apellido,alumno.nombre"); 

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
		if (!isset($cud)) $cud = "No";
		if (!isset($at_esp)) $at_esp = "No";
		
		echo"$fila2[dni];";
		echo"$fila2[apellido];";
		echo"$fila2[nombre];";
		echo"$fila2[sexo];";
		echo busca_edad($fila2['f_nac']) . ";";
		echo date("d/m/Y",strtotime($fila2[f_nac])) . ";";
		echo"$fila2[curso];";
		echo"$fila2[divi];";
		echo date("d/m/Y",strtotime($fila2[f_ingreso])) . ";";
		echo"$fila2[pais];";
		echo $cud . ";";
		echo $at_esp;
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
