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
$anio=$_GET['anio'];
$plan=$_GET['plan'];

function busca_edad($fecha_nacimiento){
$dia=date("d");
$mes=date("m");
$ano=date("Y");


$dianaz=date("d",strtotime($fecha_nacimiento));
$mesnaz=date("m",strtotime($fecha_nacimiento));
$anonaz=date("Y",strtotime($fecha_nacimiento));


//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

if (($mesnaz == $mes) && ($dianaz > $dia)) {
$ano=($ano-1); }

//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

if ($mesnaz > $mes) {
$ano=($ano-1);}

 //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

$edad=($ano-$anonaz);


return $edad;


}


echo "<table>";
	echo "<tr>";
		echo"<td align='center' bgcolor='#C0C0C0'>DNI</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>APELLIDO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>NOMBRE</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>EDAD</td>";

	echo "</tr>";


   


    $result = mysql_query ("SELECT * FROM cursa,alumno WHERE cursa.curso = '$curso' and cursa.divi = '$divi' and cursa.anio='$anio' and cursa.modalidad=$plan and cursa.alumno=alumno.dni order by alumno.apellido");
    while ($fila2 = mysql_fetch_array($result))
	
   {
			$mio=busca_edad($fila2[f_nac]);
	
			echo"<tr>";
			echo"<td align='center'>$fila2[alumno]</td>";
			echo"<td align='center'>$fila2[apellido]</td>";
			echo"<td align='left'>$fila2[nombre]</td>";
			echo"<td align='left'> $mio </td>";
			echo"</tr>";
		}
		
echo"</table>";


?>

