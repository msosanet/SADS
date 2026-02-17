<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
include 'conexioncalif.php';

function colores($calificacion)
{
	if ($calificacion>=1 AND $calificacion<=3 )
	 {$colormat='FF0000';}
	if ($calificacion>=4 AND $calificacion<6 )
	 {$colormat='FFFF00';}
	if ($calificacion>=6 AND $calificacion<=10 )
	 {$colormat='00FF00';}
	if ($calificacion=='0')
	{$colormat='E1EAFF';}

	return $colormat;
}

function sincalif($calif)
{
	if ($calif==NULL)
		 {$calif='-'; }
	if ($calif=='0')
		 {$calif='S/C'; }
	if ($calif==0)
		 {$calif='S/C'; }
	return $calif;
}

function promedio($cual,$quien)
{
	$sqlprom="SELECT AVG(nota) as pr FROM calificador2 c WHERE c.dni='$quien' AND c.idnota='$cual' and c.nota!='0'";
	//echo $sqlprom;
	$resultprom = mysql_query ($sqlprom);
	$prom = mysql_fetch_array($resultprom);
	//echo $prom['pr'];
	return round($prom['pr'], 2);
}
function instancias($a,$b){
	if ($a = 9 AND $b <7) return(1);
	if ($a = 9 AND $b >6) return(-1);
	if ($a < $b ) return(-1);
}
?>

