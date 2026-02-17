<?PHP
session_start();
$desde=$_SESSION['desde'];
$hasta=$_SESSION['hasta'];
$ext=".xls";
$nombre="Faltas".$ext;
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

	mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");

function calculaFecha($modo,$valor,$fecha_inicio=false){
 
   if($fecha_inicio!=false) {
          $fecha_base = strtotime($fecha_inicio);
   }else {
          $time=time();
          $fecha_actual=date("Y-m-d",$time);
          $fecha_base=strtotime($fecha_actual);
   }
 
   $calculo = strtotime("$valor $modo","$fecha_base");
 
   return date("Y-m-d", $calculo);
 
}


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
		echo"<td align='center' bgcolor='#C0C0C0'>FALTA INJUSTIFICADA</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>OBLIGACIONES</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>OBSERVACIONES</td>";
	echo"</tr>";


   
 $result = mysql_query ("SELECT ausentes.motivo,ausentes.docente, docentes.apellido, docentes.nombre, ausentes.fecha_desde, ausentes.fecha_hasta FROM docentes, ausentes WHERE docentes.identificacion =1 AND docentes.dni = ausentes.docente AND ausentes.fecha_desde >= '$desde' AND ausentes.fecha_hasta <= '$hasta' order by docentes.dni, docentes.apellido,docentes.nombre, ausentes.fecha_desde");

$dni_actual="11111111";
$fecha_desde_mia="0000-00-00";
$articulo=999;




    while ($fila2 = mysql_fetch_array($result))	
   {


	if ($dni_actual==$fila2[docente] and $fila2[fecha_desde] )
	{

	$fechainicio=;
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
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
	echo"</tr>";


	
	}
	else
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
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";

	echo"</tr>";

	}

	$dni_actual=$fila2[docente];
	$fecha_desde_mia=calculaFecha("days",1,$fila2[fecha_desde]);
	$articulo=$fila2[motivo];

		}
echo"</table>";

		
    unset($_SESSION['desde']);
    unset($_SESSION['hasta']);  

?>

