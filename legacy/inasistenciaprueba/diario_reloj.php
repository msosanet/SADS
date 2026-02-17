<?PHP
session_start();
$desde=$_SESSION['desde'];
$hasta=$_SESSION['hasta'];
$ext=".xls";
$nombre="Diario_reloj".$ext;
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
		echo"<td align='center' bgcolor='#C0C0C0'>Apellido y Nombre</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>HS</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>FECHA</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>TIPO</td>";
	echo"</tr>";


   
 $result = mysql_query ("SELECT * FROM diario di, docentes do WHERE di.dni=do.dni AND di.fecha >= '$desde' AND di.fecha <= '$hasta' order by do.apellido ASC,do.nombre ASC,di.dni DESC,di.fecha, di.horario");

    while ($fila2 = mysql_fetch_array($result))
	
   {

$dia=invertirFecha($fila2[fecha]);


	echo"<tr>";
		echo"<td align='center'>$fila2[dni]</td>";
		echo"<td align='center'>".$fila2[apellido]." ".$fila2[nombre]."</td>";
		echo"<td align='center'>$fila2[horario]</td>";
		echo"<td align='center'>$dia</td>";
		echo"<td align='center'>$fila2[tipo]</td>";

	echo"</tr>";
		}
echo"</table>";

		
    unset($_SESSION['desde']);
    unset($_SESSION['hasta']);  

?>

