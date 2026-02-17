<?PHP
session_start();
$desde=$_SESSION['desde'];
$hasta=$_SESSION['hasta'];
$ext=".xls";
$nombre="Parte_diario".$ext;
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

	mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");

function invertirFecha( $fechaz ){
      return implode( "-", array_reverse( preg_split( "/\D/", $fechaz ) ) );
    }



echo "<table>";
	echo "<tr>";
		echo"<td align='center' bgcolor='#C0C0C0'>DNI</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>APELLIDO Y NOMBRE</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>COD. FALTA</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>FALTA</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>OBSERVACIONES</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>FECHA</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>OBLIGACIONES</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>CURSO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>DIV</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>TURNO</td>";
	echo"</tr>";


   
 $result = mysql_query ("SELECT * FROM docentes, partediario WHERE docentes.dni = partediario.docente AND partediario.fecha >= '$desde' AND partediario.fecha <= '$hasta' order by docentes.dni, partediario.fecha");

    while ($fila2 = mysql_fetch_array($result))
	
   {


$resultt = mysql_query ("SELECT * FROM motivos WHERE codigo=$fila2[falta]");
$filatt = mysql_fetch_array($resultt);
$bien=invertirFecha($fila2[fecha]);


	echo"<tr>";
		echo"<td align='center'>$fila2[docente]</td>";
		echo"<td align='center'>$fila2[apellido] , $fila2[nombre]</td>";
		echo"<td align='center'>$fila2[falta]</td>";
		echo"<td align='center'>$filatt[descripcion]</td>";
		echo"<td align='center'>$fila2[observaciones]</td>";
		echo"<td align='center'>$bien</td>";
		echo"<td align='center'>$fila2[obligaciones]</td>";
		echo"<td align='center'>$fila2[curso]</td>";
		echo"<td align='center'>$fila2[div]</td>";
		echo"<td align='center'>$fila2[turno]</td>";



	echo"</tr>";
		}
echo"</table>";

		
    unset($_SESSION['desde']);
    unset($_SESSION['hasta']);  

?>


