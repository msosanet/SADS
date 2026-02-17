<?PHP //6to 3ra mayo2024 muestra mal las columnas
session_start();
 $meses = [1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"];

if ($_SESSION['estado']==1) {

$mex = (isset($_GET['mes'])) ? $_GET['mes'] : date("m");

include 'conexion3.php';

?>



