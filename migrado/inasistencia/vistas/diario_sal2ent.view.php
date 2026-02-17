<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<!-- meta http-equiv="Content-Type" content="text/html; charset=windows-1252" -->
<meta charset="windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css">
<title>CAMBIA SALIDA A ENTRADA</title>

</head>

<body>
<?
$dni = $_GET['dni'];
$fecha = $_GET['fecha'];
$horario = $_GET['horario'];
$desde = $_GET['desde'];    
$hasta = $_GET['hasta'];

$buscaregistro = mysql_query ("SELECT * FROM diario_sandbox WHERE dni = '$dni' AND fecha = '$fecha' AND horario = '$horario'");

$registro = mysql_fetch_array ($buscaregistro);

$mysqli = mysqli_connect("localhost","fgoicoechea","sobral2011","sid");

$grabar = mysqli_query ($mysqli, "UPDATE diario_sandbox SET tipo = 'Entrada' WHERE dni = '$dni' AND fecha = '$fecha' AND horario = '$horario'");

?>

<script>
var answer=alert("Tipo de movimiento cambiado a 'Entrada'")
</script> 

<meta http-equiv="refresh" content="0; URL=diario_ver_todos.php?desde=<? echo $desde . "&hasta=" . $hasta; ?>" />
</body>
</html>
<? } ?>
