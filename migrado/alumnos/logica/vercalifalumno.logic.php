<?PHP
session_start();
if ($_SESSION['estado']==1) {

// include 'conexion.php';
 include 'conexioncalif.php';
// $conexion = conectar ();
 $conexioncalif = conectarcalif ();


if (isset($_GET['cl'])) $cicloLect = $_GET['cl'];
else $cicloLect = $_SESSION['cicloLectivo'];

if (isset($_POST["cicloLectivo"])) $cicloLect = $_POST["cicloLectivo"];


if (isset($_GET['dni'])) $dni=$_GET['dni'];
if (isset($_POST['alumnox'])) $dni=$_POST['alumnox'];


// para que se muestre siempre el ï¿½ltimo con calificaciones

 $q_ultCiclo = "SELECT MAX(anio) ucl FROM calificador2 WHERE dni = $dni";
 $_ultCiclo = mysql_query($q_ultCiclo);
 $ultCiclo	= mysql_fetch_assoc($_ultCiclo);

 if ($cicloLect > $ultCiclo['ucl']) $cicloLect = $ultCiclo['ucl'];

$instancias = ($cicloLect < 2024) ? [1,2,3,4,9,7,8,10] : [21,22,2,41,42,4,9,7,8,85,10];

$sqlalu="SELECT CONCAT(alumno.apellido, ', ',alumno.nombre) AS alumno, CONCAT(cursa.curso,cursa.divi) AS curso FROM cursa LEFT JOIN alumno ON cursa.alumno = alumno.dni WHERE cursa.alumno = '$dni' AND cursa.anio = '$cicloLect' ORDER BY cursa.fecha DESC LIMIT 1";



 $resultalu = mysql_query ($sqlalu);
 $alumno = mysql_fetch_assoc($resultalu);

?>

