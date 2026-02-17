<?PHP
session_start();
if ($_SESSION['estado']==1) {
include 'conexion.php';
$conexion = conectar ();

// $_SESSION['probando'] = true; // Comentar en producción
$base = (isset($_SESSION['probando'])) ? "alumnos-prueba" : "alumnos";
mysql_select_db($base);
require_once('generarCodigoComedor.php');

if (count($_POST)) {
	extract($_POST,EXTR_PREFIX_ALL,"p");
	$hayEstudiante = true;
	$tieneCarControl = strpos($p_estudiante,".");
	if ($tieneCarControl !== false) {
		$actor = substr($p_estudiante,0,$tieneCarControl);
		$carControl = substr($p_estudiante,-1);
	}
	elseif (is_numeric($p_estudiante)) {
		$actor = $p_estudiante;
		$carControl = generarCodigo($actor);
	}
	else $hayEstudiante = false;


	if($hayEstudiante) { //comprobar que sea estudiante del colegio o hacer false a la var
		$_esAlumno = mysql_query("SELECT alumno FROM `cursa` WHERE alumno = $actor AND control = 1 AND anio = '$_SESSION[cicloLectivo]' AND divi NOT LIKE '-%' AND divi NOT LIKE 'E%' AND divi NOT LIKE 'L%'");
		$hayEstudiante =  (mysql_num_rows($_esAlumno)) ? true : false;
	}


	if ($hayEstudiante) {
	 if(isset($_POST['ingresa'])) {

		$_come = "INSERT INTO comedor_asistencia VALUES (''," . $actor . ",CURRENT_DATE,1," . $carControl . ")";
		$q_ingresos = mysql_query("SELECT CONCAT(apellido, ', ' , nombre) AS actor,id,dni FROM comedor_asistencia LEFT JOIN alumno ON alumno.dni = comedor_asistencia.dni_alumno WHERE dni_alumno = $actor AND fecha = CURRENT_DATE() AND permitido = 1");
		$ingresos = mysql_fetch_assoc($q_ingresos);
		if (mysql_num_rows($q_ingresos)) $mensaje = sprintf('<h1 style="color:red;text-align:left">%s ya ingres&oacute; al comedor el día de hoy</h1>',$ingresos['actor']);
		elseif (mysql_query($_come)) $mensaje = sprintf('<h1 style="color:green;text-align:left">Puede ingresar al comedor</h1>');
		else $mensaje = '<h1 style="color:purple">No se pudo grabar la asistencia</h1>';
	 }
	  if(isset($_POST['noIngresa'])) {
		 $_noCome = "UPDATE comedor_asistencia SET permitido = 0 WHERE `dni_alumno` = " . $actor . " AND fecha = CURRENT_DATE AND permitido = 1 AND digito_control = " . $carControl ;
		 if (mysql_query($_noCome)) $mensaje = '<h1 style="color:green;text-align:left">Ingreso anulado</h1>';

	  }


	}
	else $mensaje = "<h1 style='background-color: #ffbbbb'>Estudiante no encontrado</h1>";
}
else $mensaje = "";

//include 'conexion.php';
?>

