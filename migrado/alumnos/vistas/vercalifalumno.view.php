<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="tablacalif.css" />
<title>Calificaciones <?=$alumno['alumno']?></title>

	<style>
		div.container {
		overflow: scroll;
		}
		thead th {
		  position: -webkit-sticky; /* for Safari */
		  position: sticky;
		  top: 0;
		}

		tbody th {
		  position: -webkit-sticky; /* for Safari */
		  position: sticky;
		  left: 0;
		}
		p {
			writing-mode: vertical-rl;
			text-orientation: mixed;
		}
		body {
//			background-image: url("data:image/svg+xml;base64,PHN2ZyBpZD0iZGlhZ3RleHQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+dGV4dCB7IGZpbGw6IGxpZ2h0Z3JheTsgZm9udC1mYW1pbHk6IEF2ZW5pciwgQXJpYWwsIEhlbHZldGljYSwgc2Fucy1zZXJpZjsgfTwvc3R5bGU+PGRlZnM+PHBhdHRlcm4gaWQ9InR3aXR0ZXJoYW5kbGUiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHdpZHRoPSI0MDAiIGhlaWdodD0iMjAwIj48dGV4dCB5PSIzMCIgZm9udC1zaXplPSI0MCIgaWQ9Im5hbWUiPnByb3Zpc29yaWFzPC90ZXh0PjwvcGF0dGVybj48cGF0dGVybiB4bGluazpocmVmPSIjdHdpdHRlcmhhbmRsZSI+PHRleHQgeT0iMTIwIiB4PSIyMDAiIGZvbnQtc2l6ZT0iMzAiIGlkPSJvY2N1cGF0aW9uIj5wcm92aXNvcmlhczwvdGV4dD48L3BhdHRlcm4+PHBhdHRlcm4gaWQ9ImNvbWJvIiB4bGluazpocmVmPSIjdHdpdHRlcmhhbmRsZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKC00NSkiPjx1c2UgeGxpbms6aHJlZj0iI25hbWUiIC8+PHVzZSB4bGluazpocmVmPSIjb2NjdXBhdGlvbiIgLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjY29tYm8pIiAvPjwvc3ZnPg==");
		}
    </style>

</head>
<?
 include 'header.php';


 //Para ver correctamente las calificaciones de los egresados sean de bachiller o tï¿½cnica
 if (substr($alumno['curso'],0,1)=='E') {
	 $division = substr($alumno['curso'],1);
	 if (is_numeric($division)) $curso= "6" . $division;
	 else $curso= "7" . $division;
 }
 else $curso =  $alumno['curso'];

?>

<body >


<form method="POST" action="vercalifalumno.php">
<input hidden name="alumnox" value="<?=$dni?>">
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
	<table border=3 id='customers' style='width: auto;'>
		<tr><td colspan="2"><h2><a href="alumno.php?dni=<?=$dni?>"><?=$alumno['alumno']?></a></h2></td></tr>
		<tr><td><label for="cicloLectivo">Aï¿½o</label></td>

<?



$sqlanio="SELECT DISTINCT anio FROM calificador2 WHERE dni = '$dni'";
$resultanio = mysql_query ($sqlanio);
echo "<td>";
echo "<select id='cicloLectivo' name='cicloLectivo' onchange='this.style.backgroundColor = \"tomato\"; this.form.submit()'>";
while ($anioC = mysql_fetch_assoc($resultanio)) {
	$sel = ($anioC['anio'] == $cicloLect) ? "selected" : "";
	echo "<option value='$anioC[anio]' " . $sel . " >$anioC[anio]</option>";
}

echo "</select>";
echo "</td>";
echo " <input type='hidden' name='alumnox' value='$dni'>";
echo " <input type='hidden' name='cursox' value='$curso'>";
echo "<tr><td colspan='2' align='center'><input type='submit' value='Ver' name='submitx' /></td></tr>";
echo "</table></div>";
echo "</form>";


/* Anulado para que muestre las calificaciones del ciclo lectivo en
** curso cuando no se enviï¿½ formulario
 if(isset($_POST["submitx"]))
{
	$dni=$_POST["alumnox"];
	$curso=$_POST["cursox"];
	$cicloLect = $_POST["cicloLectivo"]; */
	echo "<br><br>";
	echo "<div id='containaer' style='align:center'>";
	echo "<table border=3 id='customers'>";
		echo "<thead><tr>";
			echo "<th><span title='$dni'><a href='alumno.php?dni=$dni'><h3>".$alumno['alumno']. " - " . substr($curso, 0, 1) . "º " . substr($curso, 1) ."</h3></span></a></th>";
			//$sqlnotas = "SELECT DISTINCT c.id,c.abreviado FROM calificaciones c, calificador2 cc WHERE cc.idnota=c.id ORDER BY idnota ASC";
			$sqlnotas = "SELECT id,abreviado FROM calificaciones WHERE id IN (" . implode(",",$instancias) . ")";
			$resultnotas = mysql_query ($sqlnotas);
			$cuantos=0;
			$array = [];
			while ($descrinota = mysql_fetch_array($resultnotas))
			{

			$cuantos++;
			$array[$cuantos]['descripcion']=$descrinota['abreviado'];
			$array[$cuantos]['id']=$descrinota['id'];
			$_nomInst[$descrinota['id']] =  $descrinota['abreviado'];
			}

			foreach ($instancias as $notas) {
				echo "<th><h2>". $_nomInst[$notas] ."</h2></th>\n";
			}
		echo "</tr></thead><!-- " . " -->";

		if ($cicloLect == $_SESSION['cicloLectivo']) $sqlmatcur = "SELECT * FROM matcur mc ,materias m WHERE mc.idcurso='$curso' AND m.idmateria!='65' AND mc.idmateria=m.idmateria";
		else $sqlmatcur = "SELECT * FROM materias WHERE idmateria IN (SELECT DISTINCT materia FROM calificador2 WHERE calificador2.curso = '$curso' AND anio = $cicloLect)";
		$resultmatcur = mysql_query ($sqlmatcur);


		while ($matcur = mysql_fetch_array($resultmatcur))
			{echo "<tr>";

			echo "<td bgcolor=''>".$matcur['descripcion']."</td>\n";
			$cuantosx = count($instancias);
			for ($j=0;$j<$cuantosx;$j++)
				{
					$id_mat = $instancias[$j];
					$sqlmateria="SELECT * FROM calificador2 c,materias m WHERE c.dni='$dni' AND c.materia='$matcur[idmateria]' AND m.idmateria='$matcur[idmateria]' AND c.anio=$cicloLect AND c.idnota=$id_mat ORDER BY c.nota DESC";
					$resultmateria = mysql_query ($sqlmateria);
					$materia = mysql_fetch_array($resultmateria);
					$cantidadx=mysql_num_rows($resultmateria);
						if ($cantidadx=='0' OR $cantidadx==NULL OR $cantidadx==0)
						{echo "<td style='text-align: center; background-color: ".colores($cantidadx)."'><span title='$alumno[alumno]'> - </span></td>\n";	}
						else
						{ echo "<td style='text-align: center; background-color: ".colores($materia['nota'])."'><span title='$alumno[alumno] - $materia[descripcion] - $materia[nota]'>".sincalif($materia['nota']) ."</span></td>\n";	}
				}
			 echo "</tr>";

			}


			echo "<tr>";

				echo "<td><h2>Promedio</h2>(Materias calificadas)</td>";

				for ($j=0;$j<$cuantos;$j++)
					{
						$_prom = promedio($instancias[$j],$dni,$cicloLect);
						echo "<td style='text-align: center; background-color: ".colores($_prom)."'><h2>".$_prom."</h2></td>";
					}

			echo "</tr>";

//			}


	echo "</table>";
echo "</div>";
}
include "foot.php";
// echo "<!-- \n".var_export($sqlmatcur,true)." -->";
?>
</td></tr></table></div>
<?PHP
function colores($calificacion)
{
	if ($calificacion>=1 AND $calificacion<=3 ) $colormat='hsl(from darksalmon h s l / 0.5)';
	elseif ($calificacion>=4 AND $calificacion<6 ) $colormat='hsl(from gold h s l / 0.5)';
	elseif ($calificacion>=6 AND $calificacion<=10 ) $colormat='hsl(from mediumspringgreen h s l / 0.5)';
	elseif ($calificacion==1001) $colormat='E1EAFF';
	else $colormat = "FFFFFF";

	return $colormat;
}

function sincalif($calif)
		{
			if ($calif==NULL) $calif=' - ';
			if ($calif==1001 OR $calif==0) $calif='S/C';
			if ($calif==1000) $calif='Aus';
			return $calif;
		}


function promedio($cual,$quien,$ciclo)
		{
			$sqlprom="SELECT AVG(nota) as pr FROM calificador2 c WHERE c.dni='$quien' AND c.idnota='$cual' AND c.nota NOT IN (1000,1001,0) AND c.anio = $ciclo";
			$resultprom = mysql_query ($sqlprom);
			$prom = mysql_fetch_array($resultprom);
			return round($prom['pr'], 2);
		}
 ?>

