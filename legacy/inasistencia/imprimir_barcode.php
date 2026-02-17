<?PHP
session_start();

if ($_SESSION['estado']==1) {
// include 'generarCodigoComedor.php';
// printf("<!-- %s -->",generarCodigo(94835569));
$imprimir  = (isset($_GET['imp'])) ? $_GET['imp'] : [];

$imprimir = "50308802,50943832,51421250,50334678,49761804"; // 0808
//"49822486,48153622,51292965,49478050,50921360,51105933,51352383"; //0807
//$imprimir = "49761804,50308802,50334678,51421233,51421233,51421250,52175774"; //0702
//"48689177,47370749,52571595,50220872,50127670,51421233,52899279,50431694,52076496,50746636,48118373,50115322,49868556,52235570,51421265,48693314,49045962,50943544,53191111"; //0619
//"52235570,49868556";
//"48118043,48118095,49496214,51421265,52045906,52076570,48118486,53191111"; //0527
//"48344533,48844036,48918498,49496279,50220928,50431672,50944961,52481123,52481124,94922682,94922682,94922682,94922682";
//"49229876,48948807,49045908,49996205,49045383,49045565,48948867,47000434,48654126, 50220832,50943986,49229704,49911467,50431654,49045491,49996274,52899858,50431694,48948807,53191135,50431654,50746633,52289549,49911467,48948785,52175668,50337222,52571653,53278056,49996010,48918498,49462635,49996296,94922682,49496250,49996077,53283266,50943598,52175435,51589808,49496115,52571523,50746636,50220832,52995206,52177987,50943993,46334377,52899060,52480462,49496464,49496115,48655056,49341642"; // Autorizados en 2da instancia
// $imprimir .= ",46334377,48191486,48518748,48832784,48948855,49045540,49496231,49496464,49868902,49996077,50127677,50220868,50746633,51421473,51589819,52048911,52571567,52899862,52899889,94835569,95017579" ; // El anterior salió con código de verificación de 2 cifras

// ultimo movimiento de cada alumno "SELECT * FROM comedor_habilitados CROSS JOIN (SELECT dni_alumno d,MAX(fecha) u FROM `comedor_habilitados` GROUP BY dni_alumno) ult ON dni_alumno = d AND fecha = u ORDER BY habilitado"


$cant_columnas= 3; // cantidad de columnas en la impresión

include 'conexion.php';
?>
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
