<?PHP
session_start();
$desde=$_SESSION['desde'];
$hasta=$_SESSION['hasta'];
$ext=".xls";
$nombre="listado docente".$ext;
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

	mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");




echo "<table>";
	echo "<tr>";
		echo"<td align='center' bgcolor='#C0C0C0'>DNI</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>APELLIDO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>NOMBRE</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>MAIL</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>FECHA INGRESO</td>";

	echo "</tr>";


   


    $result = mysql_query ("SELECT * FROM docentes where identificacion = 1 AND dni<> '0'");
    while ($fila2 = mysql_fetch_array($result))
	
   {
			
			echo"<tr>";
			echo"<td align='center'>$fila2[dni]</td>";
			echo"<td align='center'>$fila2[apellido]</td>";
			echo"<td align='left'>$fila2[nombre]</td>";
			echo"<td align='left'>$fila2[mail]</td>";
			echo"<td align='left'>$fila2[graba]</td>";

			echo"</tr>";
		}
		
echo"</table>";


?>

