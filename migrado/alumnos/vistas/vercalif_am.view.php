<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="tablacalif.css" />


<title>Calificaciones por curso</title>
	
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
// Da error porque falta select_db antes de la cunsulta previa y no se usa en el resto del script
// $filatt = mysql_fetch_array($resultt) ;
if (isset($_GET['curso'])) $curso=$_GET['curso'];


?>

<body>




<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980">
<tr><th>
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
?></th></tr>

</table>
</div></div>
<?
if (isset($_GET['mat']) && isset($_GET['sec']) && isset($_GET['alu'])) {
	$q_calif = mysql_query("SELECT c.nota1p,a.apellido,a.nombre,m.descripcion FROM calificador c, alumno a, materias m WHERE a.dni = '$_GET[alu]' AND c.dni = a.dni AND c.materia = '$_GET[mat]' AND c.materia = m.idmateria AND c.curso = '$_GET[sec]'");
	
	$cambiada = mysql_fetch_assoc($q_calif);
	echo "<p style='color:red;font-size:25px;writing-mode:horizontal-tb'>".
	 $cambiada['apellido'] . ", " . $cambiada['nombre'] .
	 " tiene un " . $cambiada['nota1p'] .
	 " en " . $cambiada['descripcion'] . "</p>";
}
?>
<br><br>
<div align="center">
<h1>CALIFICADORES</h1>			
</div>	
<div align="center">		
<?
echo "<form method='POST' action='$_SERVER[PHP_SELF]' >	";
	echo "<br><br>";
			$result79 = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by descripcion ASC,curso ASC,division ASC");
							
			
			echo "<select name=curso>";
				while ($fila79 = mysql_fetch_array($result79))
				{ 	
					if (isset($_POST['curso']) && $_POST['curso']==$fila79['idcurso'])
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
	echo "<table border=3 id='customers'>";
		echo "<tr>";
			echo "<td><h1>".$cursod."</h1></td>";
			while ($mat = mysql_fetch_array($resultmat))
			{$colorx = dechex(rand(124,255)) . dechex(rand(124,255)) . dechex(rand(124,255));
			 // $colorx = substr(md5(rand()), 0, 6);
			 echo "<td bgcolor='$colorx' style='padding: 10px;' ><p>".$mat['descripcion']."</p></td>";
			 $array[] = $mat['idmateria'];
			 $color[] = $colorx;					
			 $nombremat[] = $mat['descripcion'];	
			}
		echo "</tr>";
		//print_r($array);
		$sqlalu="SELECT * FROM alumno a,calificador c,curso2 cc, cursa cu WHERE cu.alumno=c.dni AND cu.control='1' AND cu.anio='2022' AND c.dni=a.dni AND cc.idcurso='$curso' AND cc.idcurso=c.curso AND cc.habilitado='1' AND cc.curso=cu.curso AND cc.division=cu.divi GROUP BY c.dni ORDER BY a.apellido,a.nombre ASC";
		$resultalu = mysql_query ($sqlalu);
		while ($alu = mysql_fetch_array($resultalu))
			{echo "<tr>";
				$nombre=$alu['apellido'].",".$alu['nombre'];
			 echo "<td bgcolor=''><a href='vercalifalumno.php?dni=$alu[dni]&nombre=$nombre' target='_blank' >".$alu['apellido'].",".$alu['nombre']."</a></td>";
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
			 $enlace = "modif_calif.php?mat=" . $calif['materia'] . 
				"&sec=" . $calif['curso'] .
				"&alu=" . $calif['dni'];
				 
			echo "<td bgcolor='".$color[$i]."'><a href='".$enlace. "'>".$calificacion."</a></td>";
				
				}
			 echo "</tr>";
			}
		
	
	echo "</table>";
echo "</div>";
}
if (isset($_POST['curso'])){
?>

	<div align="center">
	 <a href='planillaCalif_pdf.php?cd=<? echo $_POST['curso']?>' target="_blank">Imprimir tablas de calificaciones por estudiante</a>
	</div>
<? } ?>
	<br><br><br><br>
<?PHP	
include 'foot.php';

} ?>
