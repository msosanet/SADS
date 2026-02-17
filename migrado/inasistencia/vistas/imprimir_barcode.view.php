<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<title>Imprimir c&oacute;digos de barras</title>




</head>
<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
if (!mysql_num_rows($resultt)) exit("<h2>Sesi&oacute;n no iniciada</h2>") ;

$dir = "codigos";
$comando = "ls " . $dir . "/barcode-*jpg";

exec($comando,$listImg);
//array_pop($listImg); //quita la referencia a la carpeta viejos

mysql_select_db("alumnos");
if (count($imprimir)) $q_habilitados = "SELECT concat(dni_alumno,digito_control) AS codigo,concat(apellido,' ',nombre) AS nombre FROM (SELECT * FROM `comedor_habilitados` AS ch WHERE fecha = (SELECT MAX(fecha) FROM comedor_habilitados WHERE dni_alumno = ch.dni_alumno) AND habilitado = 1) AS sit_comedor LEFT JOIN alumno ON dni_alumno = dni WHERE dni_alumno IN ($imprimir) ORDER BY apellido,nombre";// "SELECT DISTINCT concat(dni_alumno,digito_control) AS codigo,concat(apellido,' ',nombre) AS nombre FROM `comedor_habilitados` LEFT JOIN alumno ON alumno.dni = comedor_habilitados.dni_alumno WHERE habilitado = 1 AND dni_alumno IN ($imprimir) ";
else $q_habilitados = "SELECT concat(dni_alumno,digito_control) AS codigo,concat(apellido,' ',nombre) AS nombre FROM (SELECT * FROM `comedor_habilitados` AS ch WHERE fecha = (SELECT MAX(fecha) FROM comedor_habilitados WHERE dni_alumno = ch.dni_alumno) AND habilitado = 1) AS sit_comedor LEFT JOIN alumno ON dni_alumno = dni ORDER BY apellido,nombre"; //"SELECT DISTINCT concat(dni_alumno,digito_control) AS codigo,concat(apellido,' ',nombre) AS nombre FROM `comedor_habilitados` LEFT JOIN alumno ON alumno.dni = comedor_habilitados.dni_alumno WHERE habilitado = 1 ";
$_habilitados = mysql_query($q_habilitados);
$habilitados = [];
while ($_h = mysql_fetch_assoc($_habilitados)) $habilitados[$_h['codigo']] = $_h["nombre"];
asort($habilitados);

$conjunto = [];
if (count($imprimir)) {
	foreach ($listImg AS $barcode) if (strpos($imprimir,substr($barcode,16,-5))!==false) $conjunto[substr($barcode,16,-4)] = $barcode;
}
else foreach ($listImg AS $barcode) $conjunto[substr($barcode,16,-4)] = $barcode;
?>

<body>


<?PHP // printf("<!-- %s  -->",var_export($conjunto,true)); ?>
<table>
<?PHP
$col = 0;
foreach ($habilitados AS $numCod => $nomEst) {
	switch($col) {
		case ($cant_columnas-1):
		 printf("<td><img src='%s'><br>%s</td></tr>",$conjunto[$numCod],$nomEst);
		 $col = 0;
		 break;
		case 0:
		 printf("<tr><td><img src='%s'><br>%s</td>",$conjunto[$numCod],$nomEst);
		 $col++;
		 break;
		default:
		 printf("<td><img src='%s'><br>%s</td>",$conjunto[$numCod],$nomEst);
		 $col++;
	}
}	?>
</table>

</body>

</html>
<? } ?>

