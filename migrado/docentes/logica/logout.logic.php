<?php
// Inicio la sesiÃ³n
session_start();
header("Cache-control: private"); // Arregla IE 6

 // descoloco todas la variables de la sesiÃ³n
 session_unset();

 // Destruyo la sesiÃ³n
 session_destroy();
  
 $_POST = array();


 //Y me voy al inicio
 header("Location: http://docentes.colegiosobral.edu.ar");
     echo "
