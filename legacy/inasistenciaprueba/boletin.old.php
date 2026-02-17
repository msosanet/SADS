<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

//esto pasa las mayusculas acentuadas a minusculas acentuadas
function strtolowerExtended($str)
{
        $low = array(chr(193) => chr(225), //á
                    chr(201) => chr(233), //é
                    chr(205) => chr(237), //í­
                   chr(211) => chr(243), //ó
                   chr(218) => chr(250), //ú
                  chr(220) => chr(252), //ü
                    chr(209) => chr(241)  //ñ
                    );
 
      return strtolower(strtr($str,$low)); 
} 


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>
<title>SID</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';
?>
<body background="bgris.gif" >

<p>


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


<?PHP

if ($_SESSION['valor']==1)
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
	
// Make a MySQL Connection
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("sid") or die(mysql_error());

$con = conectar ();

echo "<br>";
echo "<br>";

$curso=$_GET['curso']; //SI TIENE VALOR
$division=$_GET['division'];//IDEM

$sql = "SELECT DISTINCT curso FROM alumnos_curso ORDER BY curso";
$result = mysql_query($sql);




echo "<form method='GET' action='boletin.php'>";
echo "Curso: ";
echo "<select name='curso'>";
while ($row = mysql_fetch_assoc($result))
{
if ($curso==$row['curso']) //SI YA HABIA UN CURSO SELECCIONADO LO DEJO COMO SELECTED
{echo "<option selected value=".$row['curso'].">".$row['curso']."</option>";}
else
{echo "<option value=".$row['curso'].">".$row['curso']."</option>";}
}
echo "</select>";


$sql = "SELECT DISTINCT division FROM alumnos_curso ORDER BY division";
$result = mysql_query($sql);

//CARGO LAS DIVISIONES RECORDANDO SI HABIA UNA ELEGIDA
echo "Division: ";
echo "<select name='division'>";

while ($row = mysql_fetch_assoc($result))
{
if ($division==$row['division']) //SI YA HABIA UN CURSO SELECCIONADO LO DEJO COMO SELECTED
{echo "<option selected value=".$row['division'].">".$row['division']."</option>";}
else
{echo "<option value=".$row['division'].">".$row['division']."</option>";}
}
echo "</select>";







echo "<br>";
echo "<br>";
echo "<br>";

 $meses = array();
 $meses[1] = "Enero";
 $meses[2] = "Febrero";
 $meses[3] = "Marzo";
 $meses[4] = "Abril";
 $meses[5] = "Mayo";
 $meses[6] = "Junio";
 $meses[7] = "Julio";
 $meses[8] = "Agosto";
 $meses[9] = "Septiembre";
 $meses[10] = "Octubre";
 $meses[11] = "Noviembre";
 $meses[12] = "Diciembre";
 
 if (isset($_GET['mes'])) 
 {$mex = $_GET['mes'];}
else
 {$mex=date("m");}
 
 
   // etc... etc... (completa tu la lista de meses)
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




if (isset($_GET['mostrar']))
{ 

$month = $_GET['mes']; //traigo el mes seleccionado
$year  = date(Y);
$day   = date(d);
$mec = date(m); //mes en curso

if (isset($_GET['mes'])) {
    $month = $_GET['mes'];
}

$days = cal_days_in_month(CAL_GREGORIAN, $month, $year); //CANTIDAD DE DIAS DEL MES SELECCIONADO

echo "<br>";
echo "<br>";echo "<br>";
echo "<br>";

echo "<h2>PLANILLA DE ASISTENCIA $month-$year</h2>";
echo "<h3>Cantidad de dias del mes: $days </h3>";

$re=$mec-$month;

if ($re==0) //si estamos en el mes en curso solo recorre hasta los dias que hayan pasado
{$days=date(d);	}
//CARGO LOS DIAS DEL MES

if ($re<0)//si el mes en curso es mayor no busca nada porque todavia no deberia haber novedades. esto puede cambiar mas adelante
{$days=0;	}
 
 
 
echo "<table border='1'>";
echo "<tablehead>";
echo "<tr>";
for ($j = 0; $j <= $days; $j++) {
    echo "<th>$j/$month</th>";
}
echo "<th>Total Ausencias</th>";
echo "<th>Total Presentes</th>";
echo "<th>%</th>";
echo "</tr>";
echo "</tablehead>";
//TRAE LOS ALUMNOS DEL CURSO Y DIVISION SELECCIONADO
$alumnos = mysql_query("SELECT * FROM alumnos WHERE curso='$curso' AND division='$division' ORDER BY alumno ASC") or die(mysql_error());
while($row = mysql_fetch_assoc($alumnos)) { 
echo "<tr>";
echo "<td>";
echo "<a href='http://inasistencias.colegiosobral.edu.ar/veo_alumnina.php?alumno=".$row['alumno']."&muestra2=+++Buscar+++' target='_blank'>".$row['alumno']."</a>"; 
echo "</td>";
$presente=0;
$ausentec=0;
$finde=0;
$injust=0;
$just=0;
$tarde=0;
for ($j = 1; $j <= $days; $j++) 
{ $fecha="$year-$month-$j";


$dia=date("w", strtotime($fecha));

	if($dia=="0" or $dia=="6"){ //SABADO O DOMINGO MARCA COMO FINDE 
	echo "<td align='center' bgcolor='#f0f8ff'>F</td>";
	$finde++;
		
	}	
	else {
  $ausentex=mysql_query("SELECT * FROM alumnos_faltas WHERE fecha='$fecha' AND dni='".$row['dni']."' ORDER BY tipo ASC");
  $total = mysql_num_rows($ausentex);
/*
si hay un registro y es de ef +0.5
si hay dos registros es +1
si no hay resgistros es P
*/
  
  
	if ($total==1){ //SI HAY UN REGISTRO MARCA AUSENTE
	 	while($rowz = mysql_fetch_assoc($ausentex)) { 
		if ($rowz["tipo"]='EF') //SI EL UNICO REGISTRO QUE HAY ES DE EF ENTONCES ASISTIO A CLASES PERO NO A EF porque clases tienen todos los dias. 
			{
				if ($rowz["injus"]='I')
				{$ausentec=$ausentec+0.5;
				 $presente=$presente+0.5; 
				 $injust++;
				 echo "<td align='center' bgcolor='#ffd700'>P/AI</td>";
				 }	
				if ($rowz["injus"]='J')
				{$ausentec=$ausentec+0.5;
				 $presente=$presente+0.5; 
				 $just++;
				 echo "<td align='center' bgcolor='#ffd700'>P/AJ</td>"; }	
				if ($rowz["injus"]='T')
				{$ausentec=$ausentec+0.25;
				 $presente=$presente+0.75;				
			echo "<td align='center' bgcolor='#ffd700'>P/T</td>";}}
			
		else 	 //SI HAY UN SOLO REGISTRO Y NO ES DE EF FALTO A CLASES PORQUE QUIZAS ESE DIA NO TIENE EF.
			{echo "<td align='center' bgcolor='#FF0000'>A</td>";
			 $ausentec++;		}
			 }}
	if ($total==0) //SI NO HAY REGISTRO ESTA PRESENTE
	{echo "<td align='center' bgcolor='#00FF00'>P</td>";
	$presente++;}
	if ($total==2) // SI HAY DOS REGISTROS FALTO A CLASES Y A EF.
	{
		$ausentec++;
		echo "<td align='center' bgcolor='#FF0000'>A</td>";}	
	
	} //aca termina el for
}

echo "<td>";
echo $ausentec; 
echo "</td>";
echo "<td>";
echo $presente; 
echo "</td>";
$porcentajex=(1-($ausentec/$presente))*100;
$porcentaje = number_format($porcentajex, 2, '.', '');
echo "<td>";
echo $porcentaje; 
echo "</td>";




echo "</tr>";
}
echo "</table>";
echo "<br>";
echo "<br>";
echo "<br>";echo "<br>";
echo "<br>";
echo "<br>";







}



if (isset($_GET['enviar']))
{ 
//$hoy = date("Y-m-d");
//$hoy = date('Y-m-d', strtotime($hoy));
/*$hoy=$_GET['fecha'];
$materia=$_GET['materia'];*/
foreach ($_GET['ausentes'] as $checkbox) 
{
//$sql = "INSERT INTO alumnos_faltas VALUES ('$checkbox','$hoy','$materia')";
//echo $sql;
//mysql_query($sql);
}?>
<script>var answer=alert("Datos Guardados")</script> 
<?
}

echo "</form>";

}?>



















