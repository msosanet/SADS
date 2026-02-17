<?PHP
session_start();
$desde=$_SESSION['desde'];
$hasta=$_SESSION['hasta'];
$ext=".xls";
$nombre="HS".$ext;
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

	mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");




echo "<table>";
	echo "<tr>";
		echo"<td align='center' bgcolor='#C0C0C0'>DNI</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>FECHA</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>APELLIDO Y NOMBRE</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>HS</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>TIPO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>JUSTIFICADA</td>";


	echo"</tr>";


   
 //$result = mysql_query ("SELECT diario.dni,diario.fecha, docentes.apellido, docentes.nombre, diario.tipo, diario.horario FROM docentes, diario WHERE docentes.cargo =1 AND docentes.identificacion =1 AND docentes.dni = diario.dni AND diario.fecha >= '$desde' AND diario.fecha <= '$hasta' order by diario.fecha, docentes.apellido,docentes.nombre, diario.dni, diario.tipo");


    $result = mysql_query ("SELECT * FROM docentes WHERE cargo =1 AND identificacion =1 order by apellido");
    while ($fila2 = mysql_fetch_array($result))
	
   {
 	$ahora=$desde;


	$diferencia_dias=((strtotime($hasta)-strtotime($desde))/86400);

 	for ($i = 1; $i <=$diferencia_dias+1; $i++) 
	{
   

 		$result3 = mysql_query ("SELECT * FROM diario WHERE dni='$fila2[dni]' and fecha = '$ahora' order by tipo");
		if (mysql_num_rows($result3)==0)
		{
			
			$result4 = mysql_query ("SELECT * FROM ausentes,motivos WHERE ausentes.docente='$fila2[dni]' and ausentes.fecha_desde = '$ahora' and ausentes.motivo=motivos.codigo");
			$fila4 = mysql_fetch_array($result4);
			
			$rest1 = substr($fila2[dni], 0, 2);
			$rest2 = substr($fila2[dni], 2, 3);
			$rest3 = substr($fila2[dni], 5, 3);
			$rest4 =$rest1.".".$rest2.".".$rest3;
			echo"<tr>";
			echo"<td align='center'>$rest4</td>";
			echo"<td align='center'>$ahora</td>";
			echo"<td align='center'>$fila2[apellido] , $fila2[nombre]</td>";
			echo"<td align='center'></td>";
			echo"<td align='center'>$fila4[descripcion]</td>";
if ($fila4[justificada]==1) echo"<td align='center'>SI</td>";
else 			echo"<td align='center'>NO</td>";

			echo"</tr>";
		}
		else
		{
 		
 		while ($fila3 = mysql_fetch_array($result3))
   		{
			$rest1 = substr($fila2[dni], 0, 2);
			$rest2 = substr($fila2[dni], 2, 3);
			$rest3 = substr($fila2[dni], 5, 3);
			$rest4 =$rest1.".".$rest2.".".$rest3;
			echo"<tr>";
			echo"<td align='center'>$rest4</td>";
			echo"<td align='center'>$fila3[fecha]</td>";
			echo"<td align='center'>$fila2[apellido] , $fila2[nombre]</td>";
			echo"<td align='center'>$fila3[horario]</td>";
			echo"<td align='center'>$fila3[tipo]</td>";
			echo"<td align='center'></td>";
			echo"</tr>";
		}
		}

		$ahora=strtotime ( '+1 day'  , strtotime ( $ahora ) ) ;
		$ahora = date ( 'Y-m-j' , $ahora );
	}
    }
echo"</table>";

		
    unset($_SESSION['desde']);
    unset($_SESSION['hasta']);  

?>


