<?PHP
session_start();
if ($_SESSION['estado']==1) { 
include 'conexion.php';

$conexion = conectar ();
$usuario = $_SESSION['usuario'];


if (true) {
// if (isset($_GET['materia'])) {
$materia = $_GET['materia'];
$curso = $_GET['curso'];
/*
$materia = "Biología";
$curso = "3"; */
$mate_curso = $materia . "%" . $curso . "%";

?>

