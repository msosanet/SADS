<?PHP
// Este script funciona en conjunto con vercalif_am.php para modificar
// las calificaciones cargadas por los docentes. Fue desarrollado por
// el gran número de pedidos que hubo de cambios de calificaciones en el 
// 1er informe para hacer la tarea más sencilla y robusta
// El único usuario habilitado para utilizarlo es amartinez según un criterio
// de desarrollo
session_start();
if ($_SESSION['estado']==1) { 
if ($_SESSION['usuario']!='amartinez') exit();

include 'conexion.php';

?>

