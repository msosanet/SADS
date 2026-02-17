<?PHP
session_start();





$desde=$_SESSION['desde'];
$hasta=$_SESSION['hasta'];
$ext=".xls";
$nombre="listado curso".$ext;
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

	mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("alumnos");

$curso=$_GET['curso'];
$divi=$_GET['div'];
$anio=date("Y");
//$anio=date("2021");


echo "<table>";
	echo "<tr>";
		echo"<td align='center' bgcolor='#C0C0C0'>DNI</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>APELLIDO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>NOMBRE</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>TRIBU</td>";

	echo "</tr>";


   


    $result = mysql_query ("SELECT * FROM alumno,cursa where alumno.dni= cursa.alumno and cursa.curso='$curso' and cursa.divi='$divi' and cursa.anio='$anio' and cursa.control=1 order by alumno.apellido");
    while ($fila2 = mysql_fetch_array($result))
	
   {
			
			echo"<tr>";
			echo"<td align='center'>$fila2[dni]</td>";
			echo"<td align='center'>$fila2[apellido]</td>";
			echo"<td align='left'>$fila2[nombre]</td>";
			echo"<td align='left'>$fila2[tribu]</td>";
			echo"</tr>";
		}
		
echo"</table>";


?>

