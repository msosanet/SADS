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
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="tablacalif.css" />
<title>Calificaciones</title>

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
		// background-image: url("data:image/svg+xml;base64,PHN2ZyBpZD0iZGlhZ3RleHQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+dGV4dCB7IGZpbGw6IGxpZ2h0Z3JheTsgZm9udC1mYW1pbHk6IEF2ZW5pciwgQXJpYWwsIEhlbHZldGljYSwgc2Fucy1zZXJpZjsgfTwvc3R5bGU+PGRlZnM+PHBhdHRlcm4gaWQ9InR3aXR0ZXJoYW5kbGUiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHdpZHRoPSI0MDAiIGhlaWdodD0iMjAwIj48dGV4dCB5PSIzMCIgZm9udC1zaXplPSI0MCIgaWQ9Im5hbWUiPnByb3Zpc29yaWFzPC90ZXh0PjwvcGF0dGVybj48cGF0dGVybiB4bGluazpocmVmPSIjdHdpdHRlcmhhbmRsZSI+PHRleHQgeT0iMTIwIiB4PSIyMDAiIGZvbnQtc2l6ZT0iMzAiIGlkPSJvY2N1cGF0aW9uIj5wcm92aXNvcmlhczwvdGV4dD48L3BhdHRlcm4+PHBhdHRlcm4gaWQ9ImNvbWJvIiB4bGluazpocmVmPSIjdHdpdHRlcmhhbmRsZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKC00NSkiPjx1c2UgeGxpbms6aHJlZj0iI25hbWUiIC8+PHVzZSB4bGluazpocmVmPSIjb2NjdXBhdGlvbiIgLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjY29tYm8pIiAvPjwvc3ZnPg==");
		}
    </style>

</head>
<?
if ($imprime) {
	include 'header.php';
	echo "<body>";
}
else echo "<body onload='window.print()' >";

if ($imprime) {
 echo '<div style="max-width:980px; align:center">';

 if ($_SESSION['valor']==1) include 'menuppal2.php';
 if ($_SESSION['valor']==0) include 'menuppal.php';
 if ($_SESSION['valor']==3) include 'menuppal3.php';
 if ($_SESSION['valor']==4) include 'menuppal4.php';
 echo "</div>";
}
?>


<?

if($dni)
{
 $alumnoq = "SELECT * FROM `alumno` WHERE `dni` = '$dni' ";
 $alumno = mysql_query($alumnoq);
 $alu_existe = mysql_num_rows($alumno);

 if ($alu_existe) {
  $alu_datos = mysql_fetch_assoc($alumno);
  $ape_nom = strtoupper(trim($alu_datos['apellido'])) .", ". ucwords(strtolower(trim($alu_datos['nombre'])));
  $q_ultCiclo = "SELECT MAX(anio) ucl FROM calificador2 WHERE dni = $dni";
  $_ultCiclo = mysql_query($q_ultCiclo);
  $ultCiclo	= mysql_fetch_assoc($_ultCiclo);
  //$ultCiclo['ucl'] = 2024; //Quitar o mejorar al fin de la carga de 1er informe

  $instancias = ($ultCiclo['ucl'] < 2024) ? [1,2,3,4,9,7,8,10] : [21,22,2,41,42,4,9,7,8,85,10];


   $cursoq = "SELECT curso,divi FROM cursa WHERE alumno = '$dni' AND anio = '$ultCiclo[ucl]' ORDER BY fecha DESC";
  if ($cursa = mysql_query($cursoq)){
   $cursaRes = mysql_fetch_assoc($cursa);

   $cur_div = $cursaRes['curso'] . "o " . ((is_numeric($cursaRes['divi'])) ? $cursaRes['divi'] . "a" : $cursaRes['divi']);
   $curso = trim($cursaRes['curso']).trim($cursaRes['divi']);
  }
  else $cur_div = $curso ='';
 }
 else $ape_nom ='';
?>
<br><br>
<div style="max-width:980px; align:center">
<h1>CALIFICACIONES <?=$ultCiclo['ucl']?> </h1>
</div>
	<br><br>
	<div style="max-width:980px; align:center">
	<table border=3 id='customers' >
		<thead><tr>
			<th><span title="<?=$dni?>"><a href="alumnopreceptor.php?dni=<?=$dni?>"><h3><?=$ape_nom?>: <?=$cur_div?></h3></span></a></th>
<?PHP
			$sqlnotas = "SELECT DISTINCT c.id,c.abreviado FROM calificaciones c, calificador2 cc WHERE cc.idnota=c.id ORDER BY id";
			$sqlnotas = "SELECT id,abreviado FROM calificaciones WHERE id IN (" . implode(",",$instancias) . ")";
			$resultnotas = mysql_query ($sqlnotas);
			$cuantos=0;
			$array = [];

		while ($descrinota = mysql_fetch_array($resultnotas)) {
			 $cuantos++;
			 $array[$cuantos]['descripcion']=$descrinota['abreviado'];
			 $array[$cuantos]['id']=$descrinota['id'];
			 $_nomInst[$descrinota['id']] =  $descrinota['abreviado'];

			}


			foreach ($instancias as $notas) {
				echo "<th><h2>". $_nomInst[$notas] ."</h2></th>\n";
			}

		echo "</tr></thead>";

		$sqlmatcur="SELECT * FROM matcur mc ,materias m WHERE mc.idcurso='$curso' AND m.idmateria!='65' AND mc.idmateria=m.idmateria";
		$resultmatcur = mysql_query ($sqlmatcur);


		while ($matcur = mysql_fetch_array($resultmatcur))
			{   ?>
			<tr>

			<td bgcolor=''><a href=''><?=$matcur['descripcion']?></a></td>
<?PHP
			$cuantosx = count($instancias);
			for ($j=0;$j<$cuantosx;$j++)
				{
					$id_mat = $instancias[$j];
					$sqlmateria="SELECT * FROM calificador2 c,materias m WHERE c.dni='$dni' AND c.materia='$matcur[idmateria]' AND m.idmateria='$matcur[idmateria]' AND c.anio= '$ultCiclo[ucl]'  AND c.idnota=$id_mat ORDER BY c.nota DESC";
					$resultmateria = mysql_query ($sqlmateria);
					$materia = mysql_fetch_array($resultmateria);
					$cantidadx=mysql_num_rows($resultmateria);
					if ($cantidadx=='0' OR $cantidadx==NULL OR $cantidadx==0)
						{echo "<td style='text-align: center; background-color: ".colores($cantidadx)."'><span title='$alumno[alumno]'> - </span></td>\n";	}
					else
						{ echo "<td style='text-align: center; background-color: ".colores($materia['nota'])."'><span title='$alumno[alumno] - $materia[descripcion] - $materia[nota]'>".sincalif($materia['nota']) ."</span></td>\n";	}
					//printf("<!-- %s -->", $sqlmateria);
				}
			 echo "</tr>";

			}


			echo "<tr>";

				echo "<td><h2>Promedio</h2>(Materias calificadas)</td>";

				for ($j=0;$j<$cuantos;$j++)
					{
						$_prom = promedio($instancias[$j],$dni,$ultCiclo['ucl']);
						echo "<td style='text-align: center; background-color: ".colores($_prom)."'><h2>".$_prom."</h2></td>";
					}

			echo "</tr>";

}


	echo "</table>";
echo "</div>";
}

if ($imprime) include 'footer.php';

 ?>
