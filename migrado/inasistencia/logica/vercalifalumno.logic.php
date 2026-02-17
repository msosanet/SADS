<?PHP
session_start();
if ($_SESSION['estado']==1) {
//Para mostrar la tabla con todas las columnas

$dni = (isset($_GET["dni"])) ? $_GET['dni'] : false;

$imprime = (isset($_GET["imprime"])) ? false : true;


include 'conexion.php';
include 'conexioncalif.php';

function colores($calificacion)
{
	if ($calificacion>=1 AND $calificacion<=3 )
	 {$colormat='hsl(from darksalmon h s l / 0.5)';}
	if ($calificacion>=4 AND $calificacion<6 )
	 {$colormat='hsl(from gold h s l / 0.5)';}
	if ($calificacion>=6 AND $calificacion<=10 )
	 {$colormat='hsl(from mediumspringgreen h s l / 0.5)';}
	if ($calificacion=='0')
	{$colormat='E1EAFF';}

	return $colormat;
}

function sincalif($calif)
{
	if ($calif==NULL) $calif=' - ';
	if ($calif==1001 OR $calif==0) $calif='S/C';
	if ($calif==1000) $calif='Aus';
	return $calif;;
}

function promedio($cual,$quien,$ciclo)
{
	$sqlprom="SELECT AVG(nota) as pr FROM calificador2 c WHERE c.dni='$quien' AND c.idnota='$cual' and c.nota BETWEEN 1 AND 10 AND c.anio = $ciclo";
	//echo $sqlprom;
	$resultprom = mysql_query ($sqlprom);
	$prom = mysql_fetch_array($resultprom);
	//echo $prom['pr'];
	return round($prom['pr'], 2);
}



$conexion = conectar ();
$conexioncalif = conectarcalif ();


?>

