<?
session_start();
if ($_SESSION['estado'] == 1) { 
include 'conexion.php';
$conexion = conectar();
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<!-- meta http-equiv="Content-Type" content="text/html; charset=windows-1252" -->
<meta charset="windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css">
<title>CAMBIA ENTRADA A SALIDA</title>

</head>

<body>
<?
$dni = $_GET['dni'];
$fecha = $_GET['fecha'];
$horario = $_GET['horario']; 
$desde = $_GET['desde'];    
$hasta = $_GET['hasta'];

/*echo $dni . "<br>";
echo $fecha . "<br>";
echo $horario . "<br>"; 
echo $desde . "<br>";
echo $hasta . "<br>";*/

//$mysql = mysql_connect("localhost","fgoicoechea","sobral2011","sid");

$buscaregistro = mysql_query ("SELECT * FROM diario_sandbox WHERE dni = '$dni' AND fecha = '$fecha' AND horario = '$horario'");

$registro = mysql_fetch_array ($buscaregistro);

/*echo "VERIFICAR VARIABLES<br>";
echo $dni . "<br>";
echo $fecha . "<br>";
echo $horario . "<br>";  
echo $desde . "<br>";
echo $hasta . "<br>";

echo "DNI DESDE LA TABLA " . $registro[dni] . "<br>";*/

$mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");

$grabar = mysqli_query ($mysqli, "UPDATE diario_sandbox SET tipo = 'Salida' WHERE dni = '$dni' AND fecha = '$fecha' AND horario = '$horario'");
?>

<script>
var answer=alert("Tipo de movimiento cambiado a 'Salida'")
</script> 

<meta http-equiv="refresh" content="0; URL=diario_ver_todos.php?desde=<? echo $desde . "&hasta=" . $hasta; ?>" />

</body>
</html>
<? } ?>