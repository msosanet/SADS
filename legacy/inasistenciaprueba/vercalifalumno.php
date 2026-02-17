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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="tablacalif.css" />
<title>Calificaciones <?=$_GET['nombre']?></title>
	
	<style>
      p {
        writing-mode: vertical-rl;
        text-orientation: mixed;
      }
    </style>

</head>
<?
include 'header.php';
$conexion = conectar ();
$conexioncalif = conectarcalif ();
/* $usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ; 
$curso=$_GET['curso']; */
$cicloLect = 2022;
$anio = $cicloLect;
// $anio = year(curdate();

?>

<body>

<form method="POST" action="vercalif.php">
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980">

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
if ($_SESSION['valor']==4) include 'menuppal4.php';
?>

</table> <!-- Fin tabla menu -->
</div></div>
<br><br>
<div align="center">
<h1>CALIFICADORES</h1>			
</div>	
<div align="center">		
<?
echo "</div>";

if(isset($_GET["dni"]))
{
 $alumnoq = "SELECT * FROM `alumno` WHERE `dni` = $_GET[dni] ";
 $alumno = mysql_query($alumnoq);
 $alu_existe = mysql_num_rows($alumno);
 $cursoq = "SELECT curso,divi FROM cursa WHERE alumno = $_GET[dni] AND anio = $cicloLect ORDER BY fecha DESC";
 if ($alu_existe) {
  $alu_datos = mysql_fetch_assoc($alumno);
  $ape_nom = strtoupper(trim($alu_datos['apellido'])) .", ". ucwords(strtolower(trim($alu_datos['nombre'])));
  if ($cursa = mysql_query($cursoq)){
   $cursaRes = mysql_fetch_assoc($cursa);
   $cur_div = $cursaRes['curso'] . "° " . $cursaRes['divi'];
   $curso = trim($cursaRes['curso']).trim($cursaRes['divi']);
  }
  else $cur_div = $curso ='';
 }
 else $ape_nom ='';

	echo "<br><br>";
	echo "<div align='center'>";
	echo "<table border=3 id='customers' >";
		echo "<tr>";
			echo "<td><span title='$_GET[dni]'><a href='alumno.php?dni=$_GET[dni]'><h3>".$ape_nom. ": " . $cur_div ."</h3></span></a></td>";
			$sqlnotas = "SELECT DISTINCT c.id,c.abreviado FROM calificaciones c, calificador2 cc WHERE cc.idnota=c.id ORDER BY id";
			$resultnotas = mysql_query ($sqlnotas);
			$cuantos=0;
			$array = [];
			
		while ($descrinota = mysql_fetch_array($resultnotas)) {
//			 echo "<td><h2>".$descrinota['abreviado']."</h2></td>";
			 $cuantos++;
//			 $array[$cuantos]=$descrinota['id'];
			 $array[$cuantos]['descripcion']=$descrinota['abreviado'];
			 $array[$cuantos]['id']=$descrinota['id'];
			 
			}
			
			//Para mostrar calificacion anual antes que diciembre
			$array[9] = $array [7];
			$array[7] = $array [6];
			$array[6] = $array [5];
			$array[5] = $array [9];
			array_pop($array);
			
			foreach ($array as $notas) {
				echo "<td><h2>". $notas['descripcion'] ."</h2></td>\n";
			} 
			
		echo "</tr>";
//		uksort($array,"instancias");
	
		$sqlmatcur="SELECT * FROM matcur mc ,materias m WHERE mc.idcurso='$curso' AND m.idmateria!='65' AND mc.idmateria=m.idmateria";
		$resultmatcur = mysql_query ($sqlmatcur);
		
		
		while ($matcur = mysql_fetch_array($resultmatcur))
			{echo "<tr>";
			
			echo "<td bgcolor=''><a href=''>".$matcur['descripcion']."</a></td>\n";
			for ($j=1;$j<=$cuantos;$j++)
				{
					$id_mat = $array[$j]['id'];
					$sqlmateria="SELECT * FROM calificador2 c,materias m WHERE c.dni='$_GET[dni]' AND c.materia='$matcur[idmateria]' AND m.idmateria='$matcur[idmateria]' AND c.anio=$anio AND c.idnota='$id_mat' ORDER BY c.nota DESC";
					// echo $array[$j]."<br>";
					$resultmateria = mysql_query ($sqlmateria);
					$materia = mysql_fetch_array($resultmateria);
					$cantidadx=mysql_num_rows($resultmateria);
						if ($cantidadx=='0' OR $cantidadx==NULL OR $cantidadx==0)
						{echo "<td align='center' bgcolor='".colores($cantidadx)."'><span title='$_GET[nombre] - $materia[descripcion] - $materia[nota]'> - </span></td>\n";	}
						else
						{ echo "<td align='center' bgcolor='".colores($materia['nota'])."'><span title='$_GET[nombre] - $materia[descripcion] - $materia[nota]'>".sincalif($materia['nota'])."</span></td>\n";	}
				}
			 echo "</tr>";
			
			}
			
			
			echo "<tr>";
				
				echo "<td><h2>Promedio</h2>(Materias calificadas)</td>";
				
				for ($j=1;$j<=$cuantos;$j++)
					{
						echo "<td align='center' bgcolor='".colores(promedio($array[$j]['id'],$_GET[dni]))."'><h2>".promedio($array[$j]['id'],$_GET[dni])."</h2></td>\n";
					}
				
			echo "</tr>";
			
}
		
	
	echo "</table>";
echo "</div>";
}
	
	
	
	
	
	
	
	










 ?>
 <!-- <?PHP// echo var_export($GLOBALS,true);?> -->