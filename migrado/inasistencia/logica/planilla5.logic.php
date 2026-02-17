<?PHP
session_start();
$desde=$_SESSION['desde'];
$hasta=$_SESSION['hasta'];
$ext=".xls";
$nombre="Faltas_gremiales".$ext;
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

	mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");




echo "<table>";
	echo "<tr>";
		echo"<td align='center' bgcolor='#C0C0C0'>DNI</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>DIGITO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>APELLIDO Y NOMBRE</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>SITUACION DE REVISTA</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>CATEGORIA</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>TOT. HS</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>DESDE</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>HASTA</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>ART. LICENCIA</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>FALTA JUSTIFICADA?</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>OBLIGACIONES</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>OBSERVACIONES</td>";
	echo"</tr>";


   
 $result = mysql_query ("SELECT ausentes.motivo,ausentes.docente, docentes.apellido, docentes.nombre, ausentes.fecha_desde, ausentes.fecha_hasta,ausentes.observaciones FROM docentes, ausentes WHERE (ausentes.motivo=24 or ausentes.motivo=30) and docentes.identificacion =1 AND docentes.dni = ausentes.docente AND ausentes.fecha_desde >= '$desde' AND ausentes.fecha_hasta <= '$hasta' order by docentes.dni, docentes.apellido,docentes.nombre, ausentes.fecha_desde");

    while ($fila2 = mysql_fetch_array($result))
	
   {

$rest1 = substr($fila2[docente], 0, 2);
$rest2 = substr($fila2[docente], 2, 3);
$rest3 = substr($fila2[docente], 5, 3);

$rest4 =$rest1.".".$rest2.".".$rest3;

$resultt = mysql_query ("SELECT * FROM motivos WHERE codigo=$fila2[motivo]");
$filatt = mysql_fetch_array($resultt);


	echo"<tr>";
		echo"<td align='center'>$rest4</td>";
		echo"<td align='center'></td>";
		echo"<td align='center'>$fila2[apellido] , $fila2[nombre]</td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'>$fila2[fecha_desde]</td>";
		echo"<td align='center'>$fila2[fecha_hasta]</td>";
		echo"<td align='center'>$filatt[descripcion]</td>";
if ($filatt[justificada]==1) echo"<td align='center'>SI</td>";
else echo"<td align='center'>NO</td>";
		echo"<td align='center'></td>";
		echo"<td align='center'>$fila2[observaciones]</td>";


		echo"<td align='center'></td>";
		echo"<td align='center'></td>";

	echo"</tr>";
		}
echo"</table>";

		
    unset($_SESSION['desde']);
    unset($_SESSION['hasta']);  

?>


