<?php
$host = "192.168.0.249";
$user = "fgoicoechea";
$pass = "sobral2011";
$db = "sid";

$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>