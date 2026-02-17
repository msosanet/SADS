<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';
include 'conexioncalif.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
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
$anio = $_SESSION['cicloLectivo'];
//$anio = 2024;

// Da error porque falta select_db antes de la consulta previa y no se usa en el resto del script
// $filatt = mysql_fetch_array($resultt) ;
$curso = (isset($_GET['curso'])) ? $_GET['curso'] : false;



?>

<body>




<div style="text-align: center; max-width:980px">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
if ($_SESSION['valor']==4) include 'menuppal4.php';
?>
</div>
<br><br>
<div align="center">
<h1>CALIFICADORES</h1>
</div>
<div align="center">
<?
echo "<form method='POST' action=" . $_SERVER['PHP_SELF'] . " >	";
	echo "<br><br>";
			$result79 = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by descripcion ASC,curso ASC,division ASC");


			echo "<select name=curso>";
				while ($fila79 = mysql_fetch_array($result79))
				{
					if (isset($_POST['curso']) && $_POST['curso']==$fila79['idcurso'])
					{echo "<option value=".$fila79['idcurso']." selected>".$fila79['descripcion']."</option>\n";}
					else
					{echo "<option value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>\n";}

				}

			echo "</select>";
	echo "<br>";

		$result79 = mysql_query ("SELECT DISTINCT cf.* FROM calificador2 c, calificaciones cf WHERE c.idnota=cf.id AND c.anio='$anio'");


			echo "<select name=quenota>";
				while ($fila79 = mysql_fetch_array($result79))
				{
					if (isset($_POST['quenota']) && $_POST['quenota']==$fila79['id'])
					{echo "<option value=".$fila79['id']." selected>".$fila79['descripcion']."</option>\n";}
					else
					{echo "<option value=".$fila79['id'].">".$fila79['descripcion']."</option>\n";}

				}

			echo "</select>";




		echo "<input type='submit' value='Ver' name='submitcurso' />";
		echo "<br><br>";
		echo "<a href='vercalif.php?curso=$_GET[curso]&quenota=$_GET[quenota]'>Volver</a>";


echo "</div>";

if(isset($_POST["submitcurso"]) OR isset($_GET["curso"]))
{


	$curso=$_POST['curso'];
	$quenota=$_POST['quenota'];

	if(isset($_GET["xmat"]))
	{$sqladd=" AND m.idmateria=$_GET[xmat] ";
	 $curso=$_GET["curso"];
	 $quenota=$_GET["quenota"];}


	$sqlmat = "SELECT * FROM matcur mc, materias m WHERE mc.idcurso='$curso' AND mc.idmateria=m.idmateria AND m.idmateria!='65' ".$sqladd." ORDER BY m.descripcion ASC ";
	//echo $sqlmat;
	$resultmat = mysql_query ($sqlmat);

	//DATOS DEL CURSO
	$sqlcurso = "SELECT * FROM curso2 WHERE idcurso='$curso' AND habilitado='1'";
	$resultcurso = mysql_query ($sqlcurso);
	$curdesc = mysql_fetch_array($resultcurso);
	$cursod=$curdesc['descripcion'];

	echo "<br><br>";
	echo '<div style="text-align: center; max-width:980px">';
	echo "<table border=3 id='customers'>";
		echo "<tr>";
			echo "<td colspam='2'><h1>".$cursod."</h1></td>";
			while ($mat = mysql_fetch_array($resultmat))
			{$colorx = dechex(rand(124,255)) . dechex(rand(124,255)) . dechex(rand(124,255));
			 // $colorx = substr(md5(rand()), 0, 6);
			 echo "<td bgcolor='$colorx' style='padding: 10px;' ><p><a href=vercalif.php?xmat=$mat[idmateria]&curso=$curso&quenota=$quenota>".$mat['descripcion']."</a></p></td>";
			 $array[] = $mat['idmateria'];
			 $color[] = $colorx;
			 $nombremat[] = $mat['descripcion'];
			}
		echo "</tr>";
		//print_r($array);
		$sqlalu="SELECT * FROM alumno a,calificador2 c,curso2 cc, cursa cu WHERE cu.alumno=c.dni AND cu.anio='$anio' AND c.dni=a.dni AND cc.idcurso='$curso' AND cc.idcurso=c.curso AND cc.habilitado='1' AND cc.curso=cu.curso AND cc.division=cu.divi GROUP BY c.dni ORDER BY a.apellido,a.nombre ASC";
		//echo $sqlalu;
		$resultalu = mysql_query ($sqlalu);
		$numeracion = 0;
		while ($alu = mysql_fetch_array($resultalu))
		{
			 echo "<tr>";
				$nombre=trim($alu['apellido']).", ".trim($alu['nombre']);
				$numeracion++;
			 echo "<td style='text-align: left'><a href='vercalifalumno.php?dni=$alu[dni]' target='_blank' >". sprintf('%02u. ',$numeracion) .htmlentities(utf8_encode($nombre))."</a></td>";
				$count = count($array);
				for ($i = 0; $i < $count; $i++)
				{$sqlcalif="SELECT * FROM calificador2 c WHERE c.dni='$alu[dni]' AND c.curso='$curso' AND c.materia='$array[$i]' AND idnota='$quenota' AND c.anio='$anio'";
				//echo $sqlcalif;
				 $resultcalif = mysql_query ($sqlcalif);
				 $cantidadx=mysql_num_rows($resultcalif);
				 $calif = mysql_fetch_array($resultcalif);

				if ($calif['nota']==1001)
				 {$calificacion='S/C';
				  $colormat='999999';}
				elseif ($calif['nota']==1000)
				 {$calificacion='Aus';
				  $colormat='FFFFFF';}
				else
				 {$calificacion=$calif['nota'];}





				if ($cantidadx==0)
				 {$calificacion='';
			 $colormat='999999';}

				 if ($calificacion>=1 AND $calificacion<=3 )
				 {$colormat='FF0000';}
				if ($calificacion>=4 AND $calificacion<=5 )
				 {$colormat='FFFF00';}
				if ($calificacion>=6 AND $calificacion<=10 )
				 {$colormat='00FF00';}



				  echo "<td bgcolor='$colormat' style='padding: 10px;  text-align: center;'><span title='$alu[apellido],$alu[nombre] - $nombremat[$i] - $calificacion'>".$calificacion."</span></td>";

				}
			 echo "</tr>";
			}


	echo "</table>";
echo "</div>";
}
if (isset($_POST['curso'])){
?>
<br><br>
	<div align="center">
	 <a href='planillaCalif_pdf2.php?cd=<? echo $_POST['curso']?>&qn=<? echo $_POST['quenota']?>' target="_blank">Imprimir tablas de calificaciones por estudiante</a>
	</div>
<? } ?>
	<br><br><br><br>
<?PHP
include 'foot.php';

} ?>
