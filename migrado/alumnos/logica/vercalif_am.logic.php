<?PHP
// Este script funciona en conjunto con modif_calif.php para modificar
// las calificaciones cargadas por los docentes. Fue desarrollado por
// el gran nÃºmero de pedidos que hubo de cambios de calificaciones en el 
// 1er informe para hacer la tarea mÃ¡s sencilla y robusta.
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
include 'conexioncalif.php';
?>

