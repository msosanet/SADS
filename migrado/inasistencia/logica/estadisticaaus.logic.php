<?php
// Database credentials
$dbHost = '192.168.0.254';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'sid';

// Create connection and select db
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if (isset($_GET['mostrar']))
{ 
$mess = $_GET['mes']; //traigo el mes seleccionado
}


echo "<form method='GET' action='estadisticaaus.php'>";

$mes=date("m");
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

echo "Seleccione Mes: ";
   echo "<select name=\"mes\">";           
   for($mex=1; $mex<=12; $mex++){ //si es el mes en curso lo marca como selected
      if ($mes == $mex){
         echo "<option value=\"$mex\" selected>$meses[$mex]</option>";
      }
      else {
         echo "<option value=\"$mex\">$meses[$mex]</option>";
      }
   }
   echo"</select>";
echo "<input type='submit' name='mostrar' value='Ver Estadistica'/>";


// Get data from database
//$result = $db->query("SELECT a.alumno,COUNT(*) as Total  FROM `alumnos_faltas` af, alumnos a WHERE a.dni=af.dni AND YEAR(af.fecha)=2018 GROUP BY a.alumno HAVING Total>10 ORDER BY Total DESC");
 // $result = $db->query("SELECT fecha,count(fecha) as total,tipo FROM alumnos_faltas WHERE MONTH(fecha)='$mess' AND YEAR(fecha)='2018' GROUP BY fecha,tipo ORDER BY fecha DESC");
  $result = $db->query("SELECT fecha,SUM(case when tipo='EF' then 1 else 0 end) as EduFisica,SUM(case when tipo='General' then 1 else 0 end) as General FROM alumnos_faltas WHERE MONTH(fecha)='$mess' AND YEAR(fecha)='2018' GROUP BY fecha ORDER BY fecha DESC");

//SELECT fecha,count(fecha) as total,tipo FROM alumnos_faltas GROUP BY fecha,tipo ORDER BY fecha DESC
echo "</form>";
?>



