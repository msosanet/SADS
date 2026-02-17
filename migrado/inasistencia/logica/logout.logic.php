<?php
// Inicio la sesiÃ³n
session_start();
//printf("<!-- %s -->",var_export($_SERVER,true));
header("Cache-control: private"); // Arregla IE 6
 // descoloco todas la variables de la sesiÃ³n
 session_unset();

 // Destruyo la sesiÃ³n
 session_destroy();

 $_POST = [];


 //Y me voy al inicio
 header("Location: index.php");
   exit;
?>

