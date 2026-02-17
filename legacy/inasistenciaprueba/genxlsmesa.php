<?PHP
session_start();
$desde=$_SESSION['desde'];
$hasta=$_SESSION['hasta'];
$ext=".xls";
$nombre="MESAS".$ext;
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

	mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");




echo "<table>";
	echo "<tr>";
		echo"<td align='center' bgcolor='#C0C0C0'>PERMISO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>DNI</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>ALUMNO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>MATERIA</td>";


	echo"</tr>";


   


    $result = mysql_query ("SELECT * FROM mesas order by codigo");
    while ($fila2 = mysql_fetch_array($result))
	
   {
			
			$rest1 = substr($fila2[dni], 0, 2);
			$rest2 = substr($fila2[dni], 2, 3);
			$rest3 = substr($fila2[dni], 5, 3);
			$rest4 =$rest1.".".$rest2.".".$rest3;
			$result4 = mysql_query ("SELECT * FROM alumnos WHERE dni='$rest4'");
			$fila4 = mysql_fetch_array($result4);
			$result5 = mysql_query ("SELECT * FROM docentes_mesas WHERE codigo=$fila2[codigo]");
			$fila5 = mysql_fetch_array($result5);

			echo"<tr>";
			echo"<td align='center'>$fila2[numero]</td>";
			echo"<td align='center'>$rest4</td>";
			echo"<td align='center'>$fila4[alumno]</td>";
			echo"<td align='center'>$fila5[materia] $fila5[plan] $fila5[curso]</td>";
			echo"</tr>";
		}
		
echo"</table>";

		
    unset($_SESSION['desde']);
    unset($_SESSION['hasta']);  

?>

