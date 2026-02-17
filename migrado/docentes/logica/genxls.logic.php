<?PHP
session_start();
$desde=$_SESSION['desde'];
$hasta=$_SESSION['hasta'];
$ext=".xls";
$mirar=explode("-",$desde);
$nombre="Faltas".$mirar[1]."A".$ext;
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

	mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");




echo "<table>";
	echo "<tr>";
		echo"<td align='center' bgcolor='#C0C0C0'>DNI</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Apellido</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Nombre</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Horario</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Fecha</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Tipo</td>";
	echo"</tr>";

    $result = mysql_query ("SELECT docentes.dni, docentes.apellido, docentes.nombre, diario.horario, diario.fecha, diario.tipo FROM docentes, diario WHERE docentes.identificacion =2 AND docentes.dni = diario.dni AND diario.fecha >= '$desde' AND diario.fecha <= '$hasta' order by docentes.apellido, docentes.dni, diario.fecha, diario.horario");

    while ($fila2 = mysql_fetch_array($result))
	
   {

	echo"<tr>";
		echo"<td align='center'>$fila2[dni]</td>";
		echo"<td align='center'>$fila2[apellido]</td>";
		echo"<td align='center'>$fila2[nombre]</td>";
		echo"<td align='center'>$fila2[horario]</td>";
		echo"<td align='center'>$fila2[fecha]</td>";
		echo"<td align='center'>$fila2[tipo]</td>";
	echo"</tr>";
		}
echo"</table>";

		
    unset($_SESSION['desde']);
    unset($_SESSION['hasta']);  

?>


