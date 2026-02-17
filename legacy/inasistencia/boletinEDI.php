<?PHP //6to 3ra mayo2024 muestra mal las columnas
session_start();
 $meses = [1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"];

if ($_SESSION['estado']==1) {

$mex = (isset($_GET['mes'])) ? $_GET['mes'] : date("m");

include 'conexion3.php';

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="tablacalif.css" />

<!-- <link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script> -->
<title>Inasistencias del mes</title>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>
</head>
<?
include 'header.php';
?>
<body >

<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo6 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo7 {font-size: 16px; font-weight: bold; color: #FF0000; }
-->
</style>


<div style="max-width: 980px; align:center">

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>


</div>
<?
/*
// Make a MySQL Connection
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("base_sobral") or die(mysql_error());    */

$con = conectar ();

echo "<br>";
echo "<br>";

$curso=$_GET['curso']; //SI TIENE VALOR
$division=$_GET['division'];//IDEM

$sql = "SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC";
$result = mysql_query($sql);




echo "<form method='GET' action='" . $_SERVER['PHP_SELF'] . "'>";
echo "Curso: ";

echo "<select name='curso'>";
while ($row = mysql_fetch_assoc($result))
{ if ($curso==$row['idcurso']) echo "<option value=".$row['idcurso']." selected>".$row['descripcion']."</option>";
  else echo "<option value=".$row['idcurso'].">".$row['descripcion']."</option>";

}
echo "</select>";





echo "<br>";
echo "<br>";
echo "<br>";




   echo "Seleccione Mes: ";
   echo "<select name=\"mes\">";
   for($mes=1; $mes<=12; $mes++){ //si es el mes en curso lo marca como selected
      if ($mex == $mes){
         echo "<option value=\"$mes\" selected>$meses[$mes]</option>";
      }
      else {
         echo "<option value=\"$mes\">$meses[$mes]</option>";
      }
   }
   echo"</select>";


echo "<input type='submit' name='mostrar' value='Ver Planilla Asistencia'/>";


//echo "['".$row['fecha']."', ".$row['total'].", ".$row['tipo']".],";

if (isset($_GET['mostrar']))
{
$curso=substr($_GET['curso'], 0,1);
$division=substr($_GET['curso'], 1);
$mess = $mex; //traigo el mes seleccionado
$year  = date(Y);
$day   = date(d);
$mec = date(m); //mes en curso


$days = cal_days_in_month(CAL_GREGORIAN, $mess, $year); //CANTIDAD DE DIAS DEL MES SELECCIONADO

echo "<br>";
echo "<br>";echo "<br>";
echo "<br>";

echo "<h2>PLANILLA DE ASISTENCIA EDI $mess-$year</h2>";
echo "<h3>Cantidad de dias del mes: $days </h3>";

$re=$mec-$mess;

if ($re==0) //si estamos en el mes en curso solo recorre hasta los dias que hayan pasado
{$days=date(d);	}
//CARGO LOS DIAS DEL MES

if ($re<0)//si el mes en curso es mayor no busca nada porque todavia no deberia haber novedades. esto puede cambiar mas adelante
{$days=0;	}

?>

<table border='1' id='customers' >
<tablehead>
<tr>
<th width='25%'>Alumno</th>";
<?PHP for ($j = 1; $j <= $days; $j++) printf("<th>%s/%s</th>",$j,$mess); ?>
<th>Total A. Justificadas</th>
<th>Total A. Injustificadas</th>
<th>Total Ausencias (I+J+T)</th>
<th>Total Presentes</th>
<th>%</th>
</tr>
</tablehead>
<?PHP
//TRAE LOS ALUMNOS DEL CURSO Y DIVISION SELECCIONADO
$ano=date("Y");
$alumnos = mysql_query("SELECT CONCAT(a.apellido,  ' ', a.nombre) as alumno,a.dni FROM alumno a, cursa c WHERE c.alumno=a.dni AND c.curso='$curso' AND c.divi='$division' AND c.anio='$ano' AND c.control='1' ORDER BY alumno ASC") or die(mysql_error());
while($row = mysql_fetch_assoc($alumnos)) {

?>
<tr>
<td>
<?PHP printf("<a href='ver_alu.php?actor=%s' target='_blank'>%s</a>",$row['dni'],$row['alumno'])?>
</td>
<?PHP
$dni=$row['dni'];

$presente=0;
$ausentec=0;
$finde=0;
$injust=0;
$just=0;
$tarde=0;
//$z=1;
//$days = cal_days_in_month(CAL_GREGORIAN, $month, $year); //CANTIDAD DE DIAS DEL MES SELECCIONADO

for ($z = 1; $z <= $days; $z++)
{ $flag=0;
  $fecha="$year-$mess-$z";
  $dia=date("w",mktime(0,0,0,$mess,$z,$year));




			//CADA ALUMNO TIENE UN TURNO EN LA TABLA ALUMNOS, DEBERIA CREAR UNA TABLA CON LA FECHA Y EL TURNO DE LA "SUSPENSION" DE ACTIVIDADES,
			//SI EL ALUMNO ES DE TURNO X Y HAY SUSPENSION EN TURNO X ENTONCES INDICAR "SA" Y QUE NO CUENTE PARA LA ESTADISTICA DE ASISTENCIA.
			//ya esta creada la tabla hay que hacer el abm para las suspensiones asi lo pueden cargar los preceptores ya de paso hacemos para los feriados. "asuetos y suspension de actividades"


				if($dia=='0')//DOMINGO MARCA COMO FINDE
				{
					$flag=1;
					echo "<td align='center' bgcolor='#f0f8ff'>D</td>";
				}

				if($dia=='6')//SABADO MARCA COMO FINDE
				{  $flag=1;
					echo "<td align='center' bgcolor='#f0f8ff'>S</td>";
				}

				$feriado=mysql_query("SELECT * FROM feriados WHERE fecha='$fecha'");
				$feri = mysql_num_rows($feriado);

				if ($feri>'0'&& $flag=='0') //SI HAY ALGUN REGISTRO ES FERIADO
				{ $flag=1;
				  echo "<td align='center' bgcolor='#f0f8ff'>F</td>";}



				if ($flag=='0')
				{ //SI NO ES FINDE
					//$habiles++;

					$consultalu=("SELECT * FROM alumnos_faltas a, injus i WHERE a.tipo LIKE 'TEDI%' AND a.injus=i.id AND a.fecha='$fecha' AND a.dni='".$row['dni']."'");

					$ausentex=mysql_query($consultalu);
					$total = mysql_num_rows($ausentex);
					//$rowz = mysql_fetch_assoc($ausentex);

					if ($total > 0) {
						echo "<td align='center' bgcolor='#FF0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>";
						$letras = [];
						while ($rowz = mysql_fetch_assoc($ausentex)) {
							$letras[] = $rowz['letra'];
						}
						echo implode(' | ', $letras);
						//echo $consultalu;
						echo "</a></td>";
					} else {
						echo "<td align='center' bgcolor='#00FF00'>P</td>";
						$presente++;
					}





				}
}

$justificadas=0;
$injustificadas=0;


$justificadasQ=("SELECT SUM(CASE WHEN a.tipo = 'TEDI' AND a.injus IN (0) THEN i.valorfalta / 2 ELSE i.valorfalta END)) as total FROM alumnos_faltas a, injus i WHERE i.id=0 AND a.injus=i.id AND MONTH(fecha) = '".$mess."' AND YEAR(fecha) = '".$year."' AND a.dni='".$row['dni']."'");
$justificadax=mysql_query($justificadasQ);
if ($justificadax) {
    $row = mysql_fetch_assoc($justificadax);
    $justificadas = $row['total'];
    }



//$injustificadasQ=("SELECT SUM(i.valorfalta) as total FROM alumnos_faltas a, injus i WHERE i.id=1 AND a.injus=i.id AND MONTH(fecha) = '".$mess."' AND YEAR(fecha) = '".$year."' AND a.dni='".$row['dni']."'");
$injustificadasQ=("SELECT SUM(CASE WHEN a.tipo = 'TEDI' AND a.injus IN (1) THEN i.valorfalta / 2 ELSE i.valorfalta END) as total FROM alumnos_faltas a, injus i WHERE i.id=1 AND a.injus=i.id AND MONTH(fecha) = '".$mess."' AND YEAR(fecha) = '".$year."' AND a.dni='".$row['dni']."'");
$injustificadax=mysql_query($injustificadasQ);
if ($injustificadax) {
    $row = mysql_fetch_assoc($injustificadax);
    $injustificadas = $row['total'];

	}


$totalausentes=$justificadas+$injustificadas;
$porcentaje=round(100-(($totalausentes/($totalausentes+$presente))*100),0);

if ($porcentaje > 80) {
    $color = '#00FF00'; // Verde
} elseif ($porcentaje >= 50 && $porcentaje <= 79) {
    $color = '#FFFF00'; // Amarillo
} elseif ($porcentaje < 50) {
    $color = '#FF0000'; // Rojo
}





echo "<td align='center' bgcolor='#FFFFFF'>$justificadas</td>";
echo "<td align='center' bgcolor='#FFFFFF'>$injustificadas</td>";
echo "<td align='center' bgcolor='#FFFFFF'>$totalausentes</td>";
echo "<td align='center' bgcolor='#FFFFFF'>$presente</td>";
echo "<td align='center' bgcolor='$color'>$porcentaje</td>";




}//while
}//fin submit
echo "<br>";
echo "<br>";

//}









if (isset($_GET['enviar']))
{
//$hoy = date("Y-m-d");
//$hoy = date('Y-m-d', strtotime($hoy));
/*$hoy=$_GET['fecha'];
$materia=$_GET['materia'];*/
foreach ($_GET['ausentes'] as $checkbox)
{
//$sql = "INSERT INTO alumnos_faltas VALUES ('$checkbox','$hoy','$materia')";
//mysql_query($sql);
}?>
<script>var answer=alert("Datos Guardados")</script>
<?
}

echo "</form>";

}?>
