<?PHP
// Devuelve "listado previas.xls" con tabla de alumnos que adeudan previas de un 
// determinado curso ($curso) y aÃ±o ($aÃ±o)
session_start();
// $desde=$_SESSION['desde'];
// $hasta=$_SESSION['hasta'];
$ext=".xls";
$nombre="listado previas".$ext;

// Establece el formato del documento como planilla de Excel
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

// Conecta a la BD
mysql_connect("localhost", "fgoicoechea", "sobral2011");
mysql_select_db("alumnos");


$curso=$_GET['curso'];
$anio=$_GET['anio'];



echo "<table>";
	echo "<tr>";
		// Encabezado de la tabla
		echo"<td align='center' bgcolor='#C0C0C0'>DNI</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>APELLIDO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>NOMBRE</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>CURSO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>DIVISION</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>MATERIA</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>TELEFONO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>MAIL</td>";
	echo "</tr>";


   

// Consulta a la BD
    $result = mysql_query ("SELECT * FROM `cursa`,`alumno`,`previas` WHERE `cursa`.`anio` =$anio  AND `cursa`.`curso` =$curso AND `cursa`.`alumno` = `previas`.`alumno` AND `cursa`.`alumno` = `alumno`.`dni` AND `previas`.`observacion` = 'ADEUDA' ORDER BY `alumno`.`apellido`");
// Volcado de datos de la consulta en la tabla
	while ($fila2 = mysql_fetch_array($result)) {
		echo"<tr>";
		echo"<td align='center'>$fila2[dni]</td>";
		echo"<td align='center'>$fila2[apellido]</td>";
		echo"<td align='left'>$fila2[nombre]</td>";
		echo"<td align='left'>$fila2[curso]</td>";
		echo"<td align='left'>$fila2[divi]</td>";
		echo"<td align='left'>$fila2[materia]</td>";
		echo"<td align='left'>$fila2[tel]</td>";
		echo"<td align='left'>$fila2[mail]</td>";
		echo"</tr>";
		}
		
echo"</table>";


?>
