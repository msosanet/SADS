<?PHP
session_start();
if ($_SESSION['estado']==1) { 

// include 'conexion.php';
 include 'conexioncalif.php';
// $conexion = conectar ();
 $conexioncalif = conectarcalif ();

// $cicloLect = 2022;
if (isset($_GET['cl'])) $cicloLect = $_GET['cl'];
else $cicloLect = $_SESSION['cicloLectivo'];


// $sqlalu='SELECT CONCAT(alumno.apellido, ", ",alumno.nombre) AS alumno, CONCAT(cursa.curso,cursa.divi) AS curso FROM cursa LEFT JOIN alumno ON cursa.alumno = alumno.dni WHERE cursa.alumno = ' . $_GET['dni'] . ' AND cursa.control=1';
$sqlalu='SELECT CONCAT(alumno.apellido, ", ",alumno.nombre) AS alumno, CONCAT(cursa.curso,cursa.divi) AS curso FROM cursa LEFT JOIN alumno ON cursa.alumno = alumno.dni WHERE cursa.alumno = ' . $_GET['dni'] . ' AND cursa.anio = '. $cicloLect .' ORDER BY cursa.fecha DESC LIMIT 1';

 $resultalu = mysql_query ($sqlalu);
 $alumno = mysql_fetch_assoc($resultalu);

?>

