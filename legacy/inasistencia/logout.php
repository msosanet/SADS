<?php
// Inicio la sesión
session_start();
//printf("<!-- %s -->",var_export($_SERVER,true));
header("Cache-control: private"); // Arregla IE 6
 // descoloco todas la variables de la sesión
 session_unset();

 // Destruyo la sesión
 session_destroy();

 $_POST = [];


 //Y me voy al inicio
 header("Location: index.php");
   exit;
?>
