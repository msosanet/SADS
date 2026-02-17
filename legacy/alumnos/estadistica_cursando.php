<?PHP
session_start();

if (!isset($_SESSION['valor'])) { ?>
	 <!-- Redirecciona cuando no hay usuario autenticado -->
	<script>location.replace("i_admin.php") </script>
<? }

if ($_SESSION['estado']==1) {
	include 'conexion.php'; //funciones para conectar db sid
?>
<!DOCTYPE html>
<?


$conexion = conectar();
$desde= $_SESSION['cicloLectivo'] . "-02-01";
$hasta= date("Y-m-d");
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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

	<title>Cursando <?echo date("Y");?> - Alumnos</title>
</head>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script>

</script>
<?
include 'encabezado.php'; // imagen del encabezado
?>

<form method="GET" action="estadistica_cursando.php">

	<table  width="980px"><thead>
		<tr><th style="background-color:#C7C8CA;">
<?

include 'snipet_barramenu.php';
if (count($_GET)==0 || (isset($_GET["fecha_alt"]) && (isset($_GET["desde"]) || isset($_GET["hasta"])))) {
?>
		</th></tr></thead>
		<tbody>
		<tr><td>
			<table width="100%"	>
		<tr><td colspan=2">
		<table width="100%">
		<!--
		<table style="text-align: left;" align="left"> -->
			<tr>
				<td align="right">Alumnas/os con división asignada, para el año en curso, entre: </td>
				<td>
					<input type="date" id="desde" name="desde" value=<?echo $desde;?>>&nbsp; y &nbsp;<input type="date" id="hasta" name="hasta" value=<?echo $hasta;?> >
					<input type="submit" value="Buscar" name="fecha_alt" style="border: 1px solid #C0C0C0; 			padding-right: 3px; padding-left: 3px; background-color: #EBEBEB; font-weight:700; float:center" />
				</td>
				<td align="left">
				</td>
				<td align="right">
				<input type="submit" value="Egresados con mat. adeudadas" name="egreMatAde" style="border: 1px solid #C0C0C0; padding-right: 3px; padding-left: 3px; background-color: #EBEBEB; font-weight:700; float:center" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<a href="estadistica_cursando.php<? echo "?desde=" . date("Y") ."-04-01" ."&hasta=" . date("Y-m-d"); ?>&fecha_alt=Buscar" >	Ver desde el 1/4 a la fecha</a>
				</td><td></td>
				<td align="right">
				<input type="submit" value="Egresados sin titular" name="egreSinTit" style="border: 1px solid #C0C0C0; 			padding-right: 3px; padding-left: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
			</tr>
		</table>
		</td></tr>
<?
// $_pagi_sql="SELECT alumno.dni, alumno.apellido, alumno.nombre, alumno.sexo, cursa.curso, cursa.divi, alumno.f_ingreso FROM cursa RIGHT JOIN alumno ON alumno.dni = cursa.alumno WHERE cursa.anio = '$_SESSION[cicloLectivo]' AND cursa.control = 1 AND cursa.fecha BETWEEN '$desde' AND '$hasta' ORDER BY cursa.curso,cursa.divi,alumno.apellido,alumno.nombre ";

$_pagi_sql = "SELECT alumno.*,cursaParcial.* FROM alumno CROSS JOIN (SELECT cursa.* FROM cursa CROSS JOIN (SELECT alumno,MAX(fecha) AS ulMov FROM `cursa` WHERE `fecha` BETWEEN '$desde' AND '$hasta' AND curso NOT LIKE 'E' GROUP BY alumno) AS actual ON actual.alumno = cursa.alumno AND actual.ulMov = cursa.fecha WHERE (pase > '$hasta' OR pase LIKE '0000-00-00')) cursaParcial ON cursaParcial.alumno = alumno.dni  ORDER BY cursaParcial.curso,cursaParcial.divi,alumno.apellido,alumno.nombre";

$paraMyTable = mysql_query($_pagi_sql);


$_pagi_cuantos=70;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
//include("paginator.inc.php");
?>
		<tr>
		<td align="left"><?echo"$_pagi_navegacion"; ?></td>
 		<td align="right">					<a href="csv_cursando.php<? echo "?desde=" . $desde ."&hasta=" . $hasta; ?>" >Descargar en formato planilla de Excel</a></td>
		</tr>
		<tr><td colspan="2">
		<table id="myTable" >
		<thead>
		<tr  style="background-color: black; color: white;">
			<th id="dni">DNI</th>
			<th id="ape">Apellido</th>
			<th id="nom">Nombre</th>
			<th id="sx">Sexo</th>
			<th id="cur">Curso</th>
			<th id="divi">División</th>
		</tr>
		</thead>
		<tbody>
<?
//while ($fila2 = mysql_fetch_assoc($_pagi_result))
while ($fila2 = mysql_fetch_assoc($paraMyTable))
{
	echo "<tr class='alte' >\n";
	echo "<td style='text-align : center;'><a href='alumno.php?dni=".$fila2['dni']."' target='_blank' >".$fila2['dni']."</a></td>\n";
	echo "<td>".$fila2['apellido']."</td>\n";
	echo "<td>".$fila2['nombre']."</td>\n";
	echo "<td style='text-align : center;'>".$fila2['sexo']."</td>\n";
	echo "<td style='text-align : center;'>".$fila2['curso']."</td>\n";
	echo "<td style='text-align : center;'>".$fila2['divi']."</td>\n";
	echo "</tr>\n";
}
?>
		</tbody></table></td></tr>
		<tr><td colspan = "2">
		<p align="left"><?echo"$_pagi_navegacion"; ?><br><br></p>
		</td></tr>
			</table>
		<script>
		 let table = new DataTable('#myTable', {
			language: {
				url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-AR.json',
			},
			pageLength: 50
			});
		 table
		.columns( 'cur,divi,ape,nom' )
		.order( 'desc' )
		.draw();
		</script>
<? }
elseif (isset($_GET['egreMatAde'])) {
/* Esta lógica no funciona como esperamos, puede que sea errónea o que se buscaban obtener otros datos
 *
if (date('Y') == $_SESSION['cicloLectivo']) {
	$anio = $_SESSION['cicloLectivo'];
	$curso = 6;
}
else { */
	$anio = $_SESSION['cicloLectivo']-1;
	$curso = "E";
//}
?>
 <table border="0" width="980">
		<tr><td colspan=2"><strong>Egresados <? echo $anio;?> con cantidad de materias adeudadas</strong>

		</td></tr>
<?


$_pagi_sql="SELECT egresados.*,folio.libro,folio.folio FROM (SELECT `alumno`.`apellido`,`alumno`.`nombre`,`cursa`.`alumno`,`cursa`.`divi`,`alumno`.`dispo`,`alumno`.`ninforme` FROM `cursa`LEFT JOIN alumno ON alumno.dni = cursa.alumno WHERE `cursa`.`curso` LIKE '$curso' AND `cursa`.`anio` = '$anio' AND `cursa`.`control` = 1) AS egresados LEFT JOIN folio ON egresados.alumno = folio.dni ";

$_pagi_cuantos=70;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php");
?>
		<tr>
		<td align="left"><?echo"$_pagi_navegacion"; ?></td>
 		<td align="right">					<a href="listado_6_con_previas_csv.php" >Descargar en formato planilla de Excel con detalle de materias</a></td>
		</tr>
		<tr><td colspan="2">
		<table width="100%">
		<tr  style="background-color: black; color: white;">
			<th>Apellido</th>
			<th>Nombre</th>
			<th width="20px">DNI</th>
			<th>Curso</th>
			<th>División</th>
			<th>Libro</th>
			<th>Folio</th>
			<th>Disposición</th>
			<th>Nota informe</th>
			<th width="20px">Cant. Adeudadas</th>
		</tr>
<?
while ($fila2 = mysql_fetch_assoc($_pagi_result))
{
	echo "<tr class='alte' >\n";
	echo "<td>".$fila2['apellido']."</td>\n";
	echo "<td>".$fila2['nombre']."</td>\n";
	echo "<td style='text-align : right;'>".$fila2['alumno']."</td>\n";
	echo "<td style='text-align : center;'>6</td>\n";
	echo "<td style='text-align : center;'>".$fila2['divi']."</td>\n";
	echo "<td>".$fila2['libro']."</td>\n";
	echo "<td>".$fila2['folio']."</td>\n";
	echo "<td>".$fila2['dispo']."</td>\n";
	echo "<td>".$fila2['ninforme']."</td>\n";
	$canti_mate = mysql_query("SELECT COUNT(materia) FROM previas WHERE alumno = '$fila2[alumno]' AND nota < 6 ");
	$total = mysql_fetch_row($canti_mate);
	echo "<td align='center'>". $total[0] ."</td>\n";
/*	$total = 0;
	mysql_query("SELECT COUNT(materia) INTO $total FROM previas WHERE alumno = '$fila2[alumno]' AND nota < 6");
	echo "<td align='center'>". $total ."</td>\n"; */
	echo "</tr>\n";
}
?>
		</table></td></tr>
		<tr><td colspan = "2">
		<p align="left"><?echo"$_pagi_navegacion"; ?><br><br></p>
		</td></tr>
			</table>
<? }
elseif (isset($_GET['egreSinTit'])) {

 ?>
 <table border="0" width="980">
		<tr><td colspan=2"><strong>Egresados sin titular porque adeudan materias</strong>

		</td></tr>
<?
/* Esta lógica no funciona como esperamos, puede que sea errónea o que se buscaban obtener otros datos
 *
if (date('Y') == $_SESSION['cicloLectivo']) {
	$anio = $_SESSION['cicloLectivo'];
	$curso = 6;
}
else { */
	$anio = $_SESSION['cicloLectivo']-1;
	$curso = "E";
//}

$_pagi_sql="SELECT sTit.alumno,sTit.divi,alumno.apellido,alumno.nombre,alumno.domicilio,alumno.tel FROM (SELECT previas.alumno,egre.divi FROM `previas`,(SELECT alumno,divi FROM cursa WHERE curso = '$curso' AND anio = $anio AND control = 1) as egre WHERE previas.alumno = egre.alumno AND previas.nota < 6 GROUP BY previas.alumno) AS sTit LEFT JOIN alumno ON sTit.alumno = alumno.dni ORDER BY sTit.divi,alumno.apellido,alumno.nombre";

$_pagi_cuantos=70;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php");
?>
		<tr>
		<td align="left"><?echo"$_pagi_navegacion"; ?></td>
 		<td align="right">					<a href="egreSinTitular_csv.php" >Descargar en formato planilla de Excel</a></td>
		</tr>
		<tr><td colspan="2">
		<table width="100%">
		<tr  style="background-color: black; color: white;">
			<th>DNI</th>
			<th>Apellido</th>
			<th>Nombre</th>
			<th>Curso</th>
			<th>División</th>
			<th>Domicilio</th>
			<th>Teléfono</th>
		</tr>
<?
while ($fila2 = mysql_fetch_assoc($_pagi_result))
{
	echo "<tr class='alte' >\n";
	echo "<td style='text-align : right;'>".$fila2['alumno']."</td>\n";
	echo "<td>".$fila2['apellido']."</td>\n";
	echo "<td>".$fila2['nombre']."</td>\n";
	echo "<td style='text-align : center;'>6</td>\n";
	echo "<td style='text-align : center;'>".$fila2['divi']."</td>\n";
	echo "<td>".$fila2['domicilio']."</td>\n";
	echo "<td>".$fila2['tel']."</td>\n";
	echo "</tr>\n";
}
?>
		</table></td></tr>
		<tr><td colspan = "2">
		<p align="left"><?echo"$_pagi_navegacion"; ?><br><br></p>
		</td></tr>
			</table>
 <? }
 ?>
			</td></tr></tbody>
	</table>
</form>

<? /*
echo "<p>";
var_dump($GLOBALS);
echo "</p>\n"; */
include 'foot.php';
} //
else {
	echo "<h1>USUARIO NO AUTENTICADO</h1>";
} ?>
