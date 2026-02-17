<?PHP
session_start();
if ($_SESSION['estado']==1) { 

// include 'conexion.php';
 include 'conexioncalif.php';
// $conexion = conectar ();
 $conexioncalif = conectarcalif ();

// $cicloLect = 2022;
if (isset($_GET['cl'])) $cicloLect = $_GET['cl'];
else $cicloLect = $_SESSION['cicloLectivo'];


// $sqlalu='SELECT CONCAT(alumno.apellido, ", ",alumno.nombre) AS alumno, CONCAT(cursa.curso,cursa.divi) AS curso FROM cursa LEFT JOIN alumno ON cursa.alumno = alumno.dni WHERE cursa.alumno = ' . $_GET['dni'] . ' AND cursa.control=1';
$sqlalu='SELECT CONCAT(alumno.apellido, ", ",alumno.nombre) AS alumno, CONCAT(cursa.curso,cursa.divi) AS curso FROM cursa LEFT JOIN alumno ON cursa.alumno = alumno.dni WHERE cursa.alumno = ' . $_GET['dni'] . ' AND cursa.anio = '. $cicloLect .' ORDER BY cursa.fecha DESC LIMIT 1';

 $resultalu = mysql_query ($sqlalu);
 $alumno = mysql_fetch_assoc($resultalu);

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
<title>Calificaciones <?=$alumno['alumno']?></title>
	
	<style>
      p {
        writing-mode: vertical-rl;
        text-orientation: mixed;
      }
    </style>

</head>
<?
 include 'header.php';
 $usuario=$_SESSION['usuario'];
 $pass=$_SESSION['contrasenia'];
 $resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
 $filatt = mysql_fetch_array($resultt) ;
 //$curso=$_GET['curso'];
 $curso=$alumno['curso'];

?>

<body background="bgris.gif" >


<form method="POST" action="vercalif.php">

<div align="center">
<table border="0" width="980"><tr><th>
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
if ($_SESSION['valor']==4) include 'menuppal4.php';
?>
</th></tr>
<tr><td>
<br><br>
<div align="center">
<h1>CALIFICADORES</h1>			
</div>	
<div align="center">
<label for="cicloLectivo">año</label>
<select id="cicloLectivo" name="cicloLectivo">
<?
$sqlanio='SELECT DISTINCT anio FROM calificador2 WHERE dni = "$_GET[dni]"';
$resultanio = mysql_query ($sqlanio);
while ($anioC = mysql_fetch_assoc($resultanio)){
	if ($anioC['anio'] == $_SESSION['cicloLectivo']) echo "<option value='$anioC[anio]' selected>$anio[anio]C</option>\n";
	else echo "<option value='$anioC[anio]'>$anioC[anio]</option>\n";
}
echo "</select></div>";

if(isset($_GET["dni"]))
{
	
	
	echo "<br><br>";
	echo "<div align='center'>";
	echo "<table border=3 id='customers' style='width: 80%;'>";
		echo "<tr>";
			//echo "<td><span title='$_GET[dni]'><a href='alumno.php?dni=$_GET[dni]'><h3>".$alumno['alumno']. " - " . substr($curso, 0, 1) . "° " . substr($curso, 1) ."</h3></span></a></td>";
			echo "<td><span title='$_GET[dni]'><h3>".htmlentities(utf8_encode($alumno['alumno'])). " - " . substr($curso, 0, 1) . utf8_encode(°)  . substr($curso, 1) ."</h3></span></td>";
			$sqlnotas = "SELECT DISTINCT c.id,c.abreviado FROM calificaciones c, calificador2 cc WHERE cc.idnota=c.id ORDER BY idnota ASC";
			$resultnotas = mysqli_query ($linkcalif,$sqlnotas);
			$cuantos=0;
			$array = [];
			while ($descrinota = mysqli_fetch_array($resultnotas))
			{	
//			echo "<td><h2>".$descrinota['abreviado']."</h2></td>";
			$cuantos++;
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
				echo "<td><h4>". utf8_encode($notas['descripcion']) ."</h4></td>\n";
			} 
		echo "</tr>";
		
	
		$sqlmatcur="SELECT * FROM matcur mc ,materias m WHERE mc.idcurso='$curso' AND m.idmateria!='65' AND mc.idmateria=m.idmateria";
		//echo $sqlmatcur;
		$resultmatcur = mysqli_query ($linkcalif,$sqlmatcur);
		
		
		while ($matcur = mysqli_fetch_array($resultmatcur))
			{echo "<tr>";
			
			echo "<td bgcolor=''>".utf8_encode($matcur['descripcion'])."</td>\n";
			$cuantosx = count($array);
			//echo $cuantosx;
			for ($j=1;$j<=$cuantosx;$j++)
				{
					$id_mat = $array[$j]['id'];
					$sqlmateria="SELECT * FROM calificador2 c,materias m,notas n WHERE n.id=c.nota AND c.dni='$_GET[dni]' AND c.materia='$matcur[idmateria]' AND m.idmateria='$matcur[idmateria]' AND c.anio='$cicloLect' AND c.idnota='$id_mat' ORDER BY c.nota DESC";
					//echo $sqlmateria."<br>";
					//echo $array[$j]."<br>";
					$resultmateria = mysqli_query ($linkcalif,$sqlmateria);
					$materia = mysqli_fetch_array($resultmateria);
					$cantidadx=mysqli_num_rows($resultmateria);
					
					echo "<td align='center' bgcolor='".colornota($materia[valor])."'><span title='$alumno[alumno] - $materia[descripcion] - $materia[valor]'>".$materia[valor] ."</span></td>\n";		
						
						
						/*if ($cantidadx=='0' OR $cantidadx==NULL OR $cantidadx==0)
						{echo "<td align='center' bgcolor='".colores($cantidadx)."'><span title='$alumno[alumno] - $materia[descripcion] - $materia[nota]'>".sincalif($cantidadx)."</span></td>\n";	}
						else
						{ echo "<td align='center' bgcolor='".colores($materia[nota])."'><span title='$alumno[alumno] - $materia[descripcion] - $materia[nota]'>".sincalif($materia[nota]) ."</span></td>\n";	}*/
				}
			 echo "</tr>";
			
			}
			
			
			echo "<tr>";
				
				echo "<td><h2>Promedio</h2>(Materias calificadas)</td>";
				
				for ($j=1;$j<=$cuantosx;$j++)
					{
						//echo promedio($array[$j]['id']);
						$quenota=$array[$j]['id'];
						//$sqlprom="SELECT AVG(n.valor) as pr FROM calificador2 c,notas n WHERE c.nota=n.id AND c.dni='$_GET[dni]' AND c.idnota='$quenota' AND c.nota!='0' AND anio='$cicloLect'";
						//echo $sqlprom;
						//echo $array[$j]['id'];
						echo "<td align='center' bgcolor='".colornota(promedio($quenota,$_GET['dni']))."'><h2>".promedio($quenota,$_GET['dni'])."</h2></td>";
						//echo $quenota.$_GET['dni'];
					}
				
			echo "</tr>";
			
			}
		
	
	echo "</table>";
echo "</div>";
}
include "foot.php";
//echo "<!-- \n".var_export($sqlalu,true)." -->";
?>
</td></tr></table></div>
<?PHP 
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
		
function sincalif($calif) //la modifiqué para que en todos los casos muestre S/C en lugar de dejar el casillero vacío
		{
			if ($calif==NULL) $calif=' - ';
			if ($calif=='0') $calif='S/C';
			if ($calif==0) $calif='S/C';
			return $calif;
		}
		
		
function promedio($cual,$quien,$ciclo)
		{
			$sqlprom="SELECT AVG(nota) as pr FROM calificador2 c WHERE c.dni='$quien' AND c.idnota='$cual' AND c.nota!='0' AND c.anio = $ciclo";
			//echo $sqlprom;
			$resultprom = mysql_query ($sqlprom);
			$prom = mysql_fetch_array($resultprom);
			//echo $prom['pr'];
			return round($prom['pr'], 2);
		}
 ?>