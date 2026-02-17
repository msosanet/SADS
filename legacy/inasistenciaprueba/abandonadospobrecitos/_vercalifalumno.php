<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
include 'conexioncalif.php';
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
<title>Informe académico estudiante</title>
	
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
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
$curso=$_GET['curso'];

?>

<body background="bgris.gif" >


<form method="POST" action="vercalif.php">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980">

<?if ($_SESSION['valor']==1)
{		
include 'menuppal2.php';
}
if ($_SESSION['valor']==0)
{		
include 'menuppal.php';
}
if ($_SESSION['valor']==3) 
{		
include 'menuppal3.php';
}
if ($_SESSION['valor']==4) 
{		
include 'menuppal4.php';
}
?>

</table>
</div></div>
<br><br>
<div align="center">
<h1>Calificaciones</h1>			
</div>	
<div align="center">		
<?
			

		function colores($calificacion)
		{
				if ($calificacion>=1 AND $calificacion<=3 )
				 {$colormat='FF0000';}
				if ($calificacion>=4 AND $calificacion<=5 )
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
				 {$calif=''; }
			
			if ($calif=='0')
				 {$calif='S/C'; }
			 if ($calif==0)
				 {$calif=''; }
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

echo "</div>";

if(isset($_GET["dni"]))
{
	$curso=$_GET['curso'];
	$qApeNom = mysql_query("SELECT CONCAT(UCASE(apellido), ', ',LCASE(nombre)) AS actor FROM alumno WHERE dni = '$_GET[dni]'");
	$apeNom = mysql_fetch_assoc($qApeNom);
	
	
	echo "<br><br>";
	echo "<div align='center'>";
	echo "<table border=3 id='customers'>";
		echo "<tr>";
			echo "<td><span title='$_GET[dni]'><h1>".ucwords($apeNom['actor'])."</h1></span></td>";
			$sqlnotas = "SELECT DISTINCT c.abreviado FROM calificaciones c, calificador2 cc WHERE cc.dni='$_GET[dni]' AND cc.idnota=c.id";
		//	echo $sqlnotas;
			$resultnotas = mysql_query ($sqlnotas);
			$cuantos=0;
			while ($descrinota = mysql_fetch_array($resultnotas))
			{
					
			echo "<td><h2>".$descrinota['abreviado']."</h2></td>";
			$cuantos++;
			}
		echo "</tr>";
		
	
		$sqlmatcur="SELECT * FROM matcur mc ,materias m WHERE mc.idcurso='$curso' AND m.idmateria!='65' AND mc.idmateria=m.idmateria";
		$resultmatcur = mysql_query ($sqlmatcur);
		
		
		while ($matcur = mysql_fetch_array($resultmatcur))
			{echo "<tr>";
			
			echo "<td bgcolor=''><a href=''>".$matcur['descripcion']."</a></td>";
			for ($j=1;$j<=$cuantos;$j++)
				{
					$sqlmateria="SELECT * FROM calificador2 c,materias m WHERE c.dni='$_GET[dni]' AND c.materia='$matcur[idmateria]' AND m.idmateria='$matcur[idmateria]' AND c.anio=year(curdate()) AND c.idnota='$j' AND c.curso='$_GET[curso]'";
					$resultmateria = mysql_query ($sqlmateria);
					$materia = mysql_fetch_array($resultmateria);
					$cantidadx=mysql_num_rows($resultmateria);
						if ($cantidadx=='0' OR $cantidadx==NULL OR $cantidadx==0)
						{echo "<td align='center' bgcolor='".colores($cantidadx)."'><span title='$_GET[nombre] - $materia[descripcion] - $materia[nota]'>".sincalif($cantidadx)."</span></td>";	}
						else
						{ echo "<td align='center' bgcolor='".colores($materia[nota])."'><span title='$_GET[nombre] - $materia[descripcion] - $materia[nota]'>".sincalif($materia['nota'])."</span></td>";	}
				}
			 echo "</tr>";
			
			}
			
			
			echo "<tr>";
				
				echo "<td><h2>Promedio</h2>(Materias calificadas)</td>";
				
				for ($j=1;$j<=$cuantos;$j++)
					{
						echo "<td align='center' bgcolor='".colores(promedio($j,$_GET['dni']))."'><h2>".promedio($j,$_GET['dni'])."</h2></td>";
					}
				
			echo "</tr>";
			
			}
		
	
	echo "</table>";
echo "</div>";
}

 ?>