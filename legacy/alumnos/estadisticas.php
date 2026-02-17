<?PHP
session_start();

if (!isset($_SESSION['valor'])) { ?>
	 <!-- Redirecciona cuando no hay usuario autenticado -->
	<script>location.replace("i_admin.php") </script>
<? }

if ($_SESSION['estado']==1) { 
	include 'conexion.php'; //funciones para conectar db sid
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?
include 'header.php'; // imagen del encabezado

$conexion = conectar();
$desde= date("Y") . "-02-01";
$hasta= date("Y") . "-03-31";
if (isset($_GET["desde"]) && isset($_GET["hasta"])) { 
//falta ordenar desde<<hasta *********************************************
	$desde=date("Y-m-d",strtotime($_GET["desde"]));
	$hasta=date("Y-m-d",strtotime($_GET["hasta"]));
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
	<meta http-equiv="Content-Language" content="es-ar">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<title>Cursando <?echo date(Y);?> - Alumnos</title>
</head>

<body>

<form method="GET" action="estadistica_cursando.php">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980"> 

<?if ($_SESSION['valor']==1)
{		
include 'menuppal2.php'; //menu completo
}
if ($_SESSION['valor']==0)
{		
include 'menuppal.php'; // archivo no existe
}
if ($_SESSION['valor']==3) 
{		
include 'menuppal3.php'; //sólo Listados/Horarios/Asistencia (preceptores)
}
if ($_SESSION['valor']==4) 
{		
include 'menuppal4.php'; // archivo no existe
}
?>
		<tr><td>
		<table style="text-align: left;" align="left">
			<tr>
				<td>Alumnas/os con división asignada, para el año en curso, entre: </td>
				<td>
					<input type="date" id="desde" name="desde" value=<?echo $desde;?>>&nbsp; y &nbsp;<input type="date" id="hasta" name="hasta" value=<?echo $hasta;?> >
				</td>
				<td>
					<input type="submit" value="Buscar" name="fecha_alt" style="border: 1px solid #C0C0C0; 			padding-right: 3px; padding-left: 3px; background-color: #EBEBEB; font-weight:700; float:center" />
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<a href="estadistica_cursando.php<? echo "?desde=" . date("Y") ."-04-01" ."&hasta=" . date("Y-m-d"); ?>" >	Ver desde el 1/4 a la fecha</a>
				</td>
				<td></td>
			</tr>
		</table>
		</td></tr>
<?
$_pagi_sql="SELECT alumno.dni, alumno.apellido, alumno.nombre, alumno.sexo, cursa.curso, cursa.divi, alumno.f_ingreso FROM cursa RIGHT JOIN alumno ON alumno.dni = cursa.alumno WHERE cursa.anio = 2022 AND cursa.control = 1 AND cursa.fecha BETWEEN '$desde' AND '$hasta' ORDER BY cursa.curso,cursa.divi,alumno.apellido,alumno.nombre ";




$_pagi_cuantos=70;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php");
?>		
		<tr>
		<td align="left"><?echo"$_pagi_navegacion"; ?></td>
 		<td align="right">					<a href="csv_cursando.php<? echo "?desde=" . $desde ."&hasta=" . $hasta; ?>" >Descargar en formato planilla de Excel</a></td>
		</tr>
		
		<table width="100%">
		<tr  style="background-color: black; color: white;">
			<th>DNI</th>
			<th>Apellido</th>
			<th>Nombre</th>
			<th>Sexo</th>
			<th>Curso</th>
			<th>División</th>
		</tr>
<?
while ($fila2 = mysql_fetch_assoc($_pagi_result))
{
	echo "<tr class='alte' >\n";
	echo "<td style='text-align : right;'>".$fila2[dni]."</td>\n";
	echo "<td>".$fila2[apellido]."</td>\n";
	echo "<td>".$fila2[nombre]."</td>\n";
	echo "<td style='text-align : center;'>".$fila2[sexo]."</td>\n";
	echo "<td style='text-align : center;'>".$fila2[curso]."</td>\n";
	echo "<td style='text-align : center;'>".$fila2[divi]."</td>\n";
	echo "</tr>\n";
}
mysql_free_result();
?>
		</table>
		<p align="left"><?echo"$_pagi_navegacion"; ?><br><br></p>

</td>
			</table>
			</div>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>



</form>
 </td>

</div>

</body>

</html>
<? } //
else {
	echo "<h1>USUARIO NO AUTENTICADO</h1>";
} ?>
