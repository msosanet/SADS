<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conexion = new mysqli("localhost", "fgoicoechea", "sobral2011", "sid");
$conexionPreceptores = new mysqli("localhost", "fgoicoechea", "sobral2011", "base_sobral");

$fechaSeleccionada = isset($_GET['fecha']) && $_GET['fecha'] != '' ? $_GET['fecha'] : null;
$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$porPagina = 60;
$offset = ($pagina - 1) * $porPagina;
?>


