<?php
session_start();
if ($_SESSION['estado']==1) {
include 'conexion.php';
$conexion = conectar();
$mysqli = mysqli_connect("localhost", "fgoicoechea", "sobral2011", "sid");
?>

