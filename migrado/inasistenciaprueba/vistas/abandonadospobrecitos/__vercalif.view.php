<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador de Alumnos</title>
	
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
<h1>CALIFICADORES</h1>			
</div>	
<div align="center">		
<?
		echo "<br><br>";
			$result79 = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by descripcion ASC,curso ASC,division ASC");
							
			
			echo "<select name=curso>";
				while ($fila79 = mysql_fetch_array($result79))
				{ 	
					if ($_POST['curso']==$fila79['idcurso'])
					{echo "<option value=".$fila79['idcurso']." selected>".$fila79['descripcion']."</option>";}
					else
					{echo "<option value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>";}
					
				}	
				
			echo "</select>";
		
	
		echo "<input type='submit' value='Ver' name='submitcurso' />";
		

echo "</div>";

if(isset($_POST["submitcurso"]))
{
	$curso=$_POST['curso'];
	$sqlmat = "SELECT * FROM matcur mc, materias m WHERE mc.idcurso='$curso'AND mc.idmateria=m.idmateria AND m.idmateria!='65' ORDER BY m.descripcion ASC ";
	//echo $sqlmat;
	$resultmat = mysql_query ($sqlmat);
	
	//DATOS DEL CURSO
	$sqlcurso = "SELECT * FROM curso2 WHERE idcurso='$curso' AND habilitado='1'";
	$resultcurso = mysql_query ($sqlcurso);
	$curdesc = mysql_fetch_array($resultcurso);
	$cursod=$curdesc['descripcion'];
	
	echo "<br><br>";
	echo "<div align='center'>";
	echo "<table border=3>";
		echo "<tr>";
			echo "<td><h1>".$cursod."</h1></td>";
			while ($mat = mysql_fetch_array($resultmat))
			{$colorx = dechex(rand(124,255)) . dechex(rand(124,255)) . dechex(rand(124,255));
			 // $colorx = substr(md5(rand()), 0, 6);
			 echo "<td bgcolor='$colorx' style='padding: 10px;' ><p>".$mat[descripcion]."</p></td>";
			 $array[] = $mat[idmateria];
			 $color[] = $colorx;					
			 $nombremat[] = $mat[descripcion];	
			}
		echo "</tr>";
		//print_r($array);
		$sqlalu="SELECT * FROM alumno a,calificador c,curso2 cc, cursa cu WHERE cu.alumno=c.dni AND cu.control='1' AND cu.anio='2022' AND c.dni=a.dni AND cc.idcurso='$curso' AND cc.idcurso=c.curso AND cc.habilitado='1' AND cc.curso=cu.curso AND cc.division=cu.divi GROUP BY c.dni ORDER BY a.apellido,a.nombre ASC";
		$resultalu = mysql_query ($sqlalu);
		while ($alu = mysql_fetch_array($resultalu))
			{echo "<tr>";

			 echo "<td bgcolor=''>".$alu['apellido'].",".$alu['nombre']."</td>";
				$count = count($array);
				for ($i = 0; $i < $count; $i++) 
				{$sqlcalif="SELECT * FROM calificador c WHERE c.dni='$alu[dni]' AND c.curso='$curso' AND c.materia='$array[$i]'";
				
				 $resultcalif = mysql_query ($sqlcalif);
				 $cantidadx=mysql_num_rows($resultcalif);
				 $calif = mysql_fetch_array($resultcalif);
				 if ($calif['nota1p']==0)
				 {$calificacion='S/C';
				  $colormat='999999';}
				 else
				 {$calificacion=$calif['nota1p'];}
				if ($cantidadx==0)
				 {$calificacion='';}
				 
				 if ($calificacion>=1 AND $calificacion<=3 )
				 {$colormat='FF0000';}
				if ($calificacion>=4 AND $calificacion<=5 )
				 {$colormat='FFFF00';}
				if ($calificacion>=6 AND $calificacion<=10 )
				 {$colormat='00FF00';}
				 
				 
				 
				 
				 /*switch($calificacion)
				 {
				 case 0:
				$colormat='';
				break;
				case 1:
				$colormat='';
				break;
				case 2:
				$colormat='';
				break;
				 }*/
				 echo "<td bgcolor='$colormat'style='padding: 10px;  text-align: center;'><span title='$alu[apellido],$alu[nombre] - $nombremat[$i] - $calificacion'>".$calificacion."</span></td>";
				}
			 echo "</tr>";
			}
		
	
	echo "</table>";
echo "</div>";
}
	
	
	
	
	
	
	
	










} ?>
