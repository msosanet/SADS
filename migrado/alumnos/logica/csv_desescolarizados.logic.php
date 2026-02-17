<?PHP
// Devuelve "Estudiantes en riesgo de desescolarizacion.csv" para pedido
// de la DPES con datos de familiares y contacto. Incluye estadísticas de 
// ausencias en los meses de Julio/Agosto de 2022 contaiblizadas por semanas

session_start();
if ($_SESSION['estado']!=1) exit();
include 'conexion.php';

$ext=".csv";
$nombre="Estudiantes en riesgo de desescolarizacion ".$ext;


// Establece el formato del documento como planilla de Excel
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

if (true) {
$conexion = conectar ();

// Establece quiÃ©n obtuvo el listado
$usuario = $_SESSION['usuario'];
$result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
$fila = mysql_fetch_array($result) ;

// Nombre y apellido de quiÃ©n obtuvo el listado. Fecha de obtenido
	echo "Listado obtenido el " . date("j/n/Y") . " por " . $fila['nombre'] . " " . $fila['apellido'] . "\n";

// Encabezado de columnas
	echo "Ciudad;";
	echo "Nivel;";
	echo "Institución educativa;";
	echo "Curso;";
	echo "Div;";
	echo "Turno;";
	echo "Apellido y Nombre;";
	echo "DNI;";
	echo "Domicilio;";
	echo "Reponsable/s;";
	echo "Contacto;";
	echo "5 días;";
	echo "3 o 4 días;";
	echo "2 o menos";
	echo "\n";

// Consulta a la BD
$result = mysql_query ("SELECT riesgo2.curso,divi,turno,apeNom,dni,domicilio,tel,completa,3omas AS tresomas,menos3 FROM (SELECT curso,divi,apeNom,dni,domicilio,tel,completa,3omas,menos3 FROM (SELECT CONCAT(apellido,', ',nombre) AS apeNom,dni,domicilio,tel,completa,3omas,menos3 FROM `desescolarizados` LEFT JOIN alumno on alumno = dni) AS riesgo LEFT JOIN cursa ON cursa.alumno = dni WHERE cursa.control = 1) AS riesgo2, cursos WHERE cursos.curso = riesgo2.curso AND cursos.division = riesgo2.divi"); 

// Volcado de datos de la consulta en la tabla 
	while ($fila2 = mysql_fetch_assoc($result)) {
		$familiares = mysql_query("SELECT * FROM `alu_fami` WHERE alumno='$fila2[dni]'");
		while ($familiar = mysql_fetch_assoc($familiares)){
			$q_datoFamiliar = mysql_query("SELECT * FROM `familiares` WHERE dni = '$familiar[familiar]'");
 			if ($fila2['tel']!= '') $telResp = $fila2['tel']. " - ";
			while ($datosFami = mysql_fetch_assoc($q_datoFamiliar)) 
			{
				$responsable = $responsable . strtoupper($datosFami['apellido']) . ", " .
				 ucwords(strtolower($datosFami['nombre'])) . " - ";
				if ($datosFami['tel']) $telResp = $telResp . $datosFami['tel'] . " - ";
				if ($datosFami['tel_trabajo']) $telResp = $telResp . $datosFami['tel_trabajo'] . " - ";
			}
		}
		switch ($fila2['turno'])
		{
			case 1:
			 $turno = "Mañana";
			 break;
			case 2:
			case 4:
			 $turno = "Tarde";
			 break;
			case 3:
			 $turno = "Vespertino";
			 break;
		}
		
		echo"Ushuaia;";
		echo"Educación Secundaria;";
		echo"Colegio Provincial Dr. José María Sobral;";
		echo"$fila2[curso];";
		echo"$fila2[divi];";
		echo $turno.";";
		echo"$fila2[apeNom];";
		echo"$fila2[dni];";
		echo"$fila2[domicilio];";

		echo $responsable . ";";
		echo $telResp . ";";
		echo"$fila2[completa];";
		echo"$fila2[tresomas];";
		echo"$fila2[menos3]";
		
		echo"\n";
		
		unset($responsable);
		unset($telResp);
		unset($turno);
	}
	mysql_free_result();
}
else { // En caso de no haber enviado las fechas "desde" y "hasta" en la URL
	echo "La consulta no devuelve datos\n";
}
?>
