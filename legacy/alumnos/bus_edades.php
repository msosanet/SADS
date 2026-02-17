<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>Listados por edad</title>
</head>

<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
if (isset($_GET['fecha1']) AND isset($_GET['fecha2'])){
	$fecha1=date("Y-m-d",strtotime($_GET['fecha1']));
	$fecha2=date("Y-m-d",strtotime($_GET['fecha2']));
	if (mktime($fecha1)>mktime($fecha2))
	{ $fecha1=$fecha2; $fecha2=date("Y-m-d",strtotime($_GET['fecha1']));}
}
else {
	$fecha1 = date("Y-m-d",strtotime("17 years ago"));
	$fecha2 = date("Y-m-d",strtotime("14 years ago"));
}

$anio=date("Y");
// Para tomar los que hasta hoy no han cumplido la mayor edad se agrega un día a fecha1
$fecha = date("Y-m-d",strtotime("+ 1 day",strtotime($fecha1)));
/* Para el cálculo de la edad */
$edad = date_diff(date_create($fecha),date_create(date("Y-m-d")));
$edad2 = date_diff(date_create($fecha2),date_create(date("Y-m-d")));
//echo $diferencia->format("%y años, %m meses y %d días.%R");

?>

<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->

<form method="GET" action="bus_edades.php">

<?
include 'snipet_barramenu.php'; //COMPRUEBA EL TIPO DE USUARIO Y DESPLIEGA MENÚ DE FUNCIONES ACORDE
?>	
<br>
<p align="left" class="titulo">Buscar según fecha de nacimiento</p>
<br>
	
<div align="left">
		
<table border="0">
	<tr>
        <td class="titulo2">Nacidos entre:</td>
        <td align="right">&nbsp;<input type="date" name="fecha1" id="fecha1" value="<?echo $fecha1;?>" /></td>
		<td>y</td>
		<td align="right" class="titulo2">&nbsp;<input type="date" name="fecha2" id="fecha2" value="<?echo $fecha2;?>" /></td>
        <td><input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
	</tr>
	<tr>
		<td></td>
		<td align="center"><?echo $edad->format("%y");?> años</td>
		<td></td>
		<td align="center"><?echo $edad2->format("%y");?> años</td>
		<td></td>
	</tr>
</table>
</div>
<br>

</font>
<?
	$consulta = "SELECT curso,divi,COUNT(dni) AS total FROM (SELECT alumno.`apellido`,alumno.`nombre`,alumno.`dni`,alumno.`f_nac`,cursa.curso,cursa.divi FROM `alumno`,cursa WHERE alumno.`f_nac` BETWEEN '$fecha' AND '$fecha2' AND cursa.control = 1 AND cursa.anio = '$anio' AND alumno.dni = cursa.alumno) AS listado GROUP BY curso,divi";
	$cursos = mysql_query($consulta);
//	echo "<p>" . mysql_num_rows($cursos) . "</p>";
?>
<table>
<?
$columna = 1;
	while ($fila = mysql_fetch_assoc($cursos)) {
		if (fmod($columna,2)!=0) {
			echo "<tr class='alte'><td><a href='cursopdf_por_edad.php?curso=" . $fila[curso] . "&div=" . $fila[divi] . "&fecha=" . $fecha . "&fecha2=" . $fecha2 ."' target='_blank'>Curso ".$fila[curso]."º ".$fila[divi].": ".$fila[total]." estudiante(s)</a></td><td></td>\n";
			$columna++;
		}
		else {
			echo "<td><a href='cursopdf_por_edad.php?curso=" . $fila[curso] . "&div=" . $fila[divi] . "&fecha=" . $fecha . "&fecha2=" . $fecha2 ."' target='_blank'>Curso ".$fila[curso]."º ".$fila[divi].": ".$fila[total]." estudiante(s)</a></td></tr>\n";
			$columna++;
		}
	}
	if (fmod($columna,2)==0) { echo "</tr>";}
	mysql_free_result();
	?>
</table>
	
	<?

include 'footer.php';
?>

</form>

</div>

</body>

</html>
<? 
    } //************ FIN COMPRUEBA SESIÓN *******************
?>