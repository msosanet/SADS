<?PHP
session_start();

if (!isset($_SESSION['valor'])) { 
    header("location: i_admin.php");
    exit;
}

if ($_SESSION['estado']==1) { 
	include 'conexion.php'; //funciones para conectar db sid


$conexion = conectar();
$desde= $_SESSION['cicloLectivo'] . "-02-01";
$hasta= date("Y-m-d");
if (isset($_GET["desde"]) && isset($_GET["hasta"])) { 
//falta ordenar desde<<hasta *********************************************
	$desde=date("Y-m-d",strtotime($_GET["desde"]));
	$hasta=date("Y-m-d",strtotime($_GET["hasta"]));
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
	<meta http-equiv="Content-Language" content="es-ar">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<title>Adeudan espacios 2020-2021</title>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script>
 </head>
 
</script>
<?
include 'encabezado.php'; // imagen del encabezado
?>



	<table  width="980px"><thead>
		<tr><th style="background-color:#C7C8CA;">
<?
include 'snipet_barramenu.php';
?>
		</th></tr></thead>
		<tbody>
		<tr><td>


		<table width="100%"	> 
		<tr><td colspan=2">
		</td></tr>
<?
$q_alus = "SELECT dni,CONCAT(apellido, ' ', nombre) AS nombre,curso,tel,mail FROM `alumno` RIGHT JOIN cursa ON cursa.alumno = alumno.dni WHERE cursa.control = 1  ";
$alus = mysql_query($q_alus);
$alus_nya = [];
while($d = mysql_fetch_assoc($alus)) $alus_nya[$d['dni']] = $d;

$q_materias = "SELECT * FROM `materias2023` ";
$materias = mysql_query($q_materias);
$mat = [];
while($m = mysql_fetch_assoc($materias)) $mat[$m['idmateria']]= $m['descripcion'];


// $q_adeUniPed201 = "SELECT previas.* FROM previas,(SELECT alumno,curso FROM `cursa` WHERE `anio` LIKE '2021' AND pase = 0 /* que cursaban en 2021 */) AS cur21 WHERE previas.alumno = cur21.alumno AND previas.curso = cur21.curso AND previas.nota < 6 AND previas.idmateria != 1010 UNION ALL SELECT previas.* FROM previas,(SELECT alumno,curso FROM `cursa` WHERE `anio` LIKE '2020' AND pase = 0 /* que cursaban en 2020 */) AS cur20 WHERE previas.alumno = cur20.alumno AND previas.curso = cur20.curso AND previas.nota < 6 AND previas.idmateria != 1010 ORDER BY alumno";

$q_adeUniPed201 = "SELECT previas.* FROM previas,(SELECT alumno,curso FROM `cursa` WHERE `anio` LIKE '2021' AND pase = 0 AND alumno IN (SELECT alumno FROM `cursa` WHERE control = 1 )/* que cursaban en 2021 y siguen siendo nuestros*/) AS cur21 WHERE previas.alumno = cur21.alumno AND previas.curso = cur21.curso AND previas.nota < 6 AND previas.idmateria != 1010 UNION ALL SELECT previas.* FROM previas,(SELECT alumno,curso FROM `cursa` WHERE `anio` LIKE '2020' AND pase = 0 AND alumno IN (SELECT alumno FROM `cursa` WHERE control = 1 )/* que cursaban en 2020 */) AS cur20 WHERE previas.alumno = cur20.alumno AND previas.curso = cur20.curso AND previas.nota < 6 AND previas.idmateria != 1010 ORDER BY alumno";

$adeUniPed201 = mysql_query($q_adeUniPed201);
$adeudadas = [];
while($a = mysql_fetch_assoc($adeUniPed201)) $adeudadas[] = $a;

$aluAdeuda = $adeudadas[0]['alumno'];
$muestraAlu[$aluAdeuda] = ['apeNom' => $alus_nya[$aluAdeuda]['nombre'], 'curso' => $alus_nya[$aluAdeuda]['curso'], 'cont' => $alus_nya[$aluAdeuda]['tel'] . " " . $alus_nya[$aluAdeuda]['mail'], 'cant' => 0, 'materias' => ''];
foreach($adeudadas AS $prev) {
	if($prev['alumno'] == $aluAdeuda) {
		$muestraAlu[$aluAdeuda]['cant']++;
		$muestraAlu[$aluAdeuda]['materias'] .= (($prev['alumno']==$adeudadas[0]['alumno']) ? "" : " / ") . $mat[$prev['idmateria']] . " " . $prev['curso'] . "\n ";
		
	}
	else {
		$aluAdeuda = $prev['alumno'];
		$muestraAlu[$aluAdeuda]['apeNom'] = $alus_nya[$aluAdeuda]['nombre'];
		$muestraAlu[$aluAdeuda]['curso'] = $alus_nya[$aluAdeuda]['curso'];
		$muestraAlu[$aluAdeuda]['cont'] = $alus_nya[$aluAdeuda]['tel'] . " " . $alus_nya[$aluAdeuda]['mail'];
		$muestraAlu[$aluAdeuda]['cant'] = 1;
		$muestraAlu[$aluAdeuda]['materias'] = $mat[$prev['idmateria']] . " " . $prev['curso'] . "\n ";
	}
}



//$_pagi_sql="SELECT alumno.*,cursa.* FROM alumno,cursa,(SELECT alumno AS a,MAX(fecha) AS f FROM `cursa` WHERE `fecha` BETWEEN '$desde' AND '$hasta' AND curso NOT LIKE 'E' GROUP BY alumno ORDER BY alumno) AS ultMov WHERE cursa.alumno = ultMov.a AND cursa.fecha = ultMov.f AND alumno.dni = cursa.alumno ORDER BY cursa.curso,cursa.divi,alumno.apellido,alumno.nombre";

//$paraMyTable = mysql_query($_pagi_sql);


$_pagi_cuantos=70;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
//include("paginator.inc.php");
?>		
		<tr>
 		<td align="right">				<!--	<a href="csv_cursando.php<? echo "?desde=" . $desde ."&hasta=" . $hasta; ?>" >Descargar en formato planilla de Excel</a> --></td>
		</tr>
		<tr><td colspan="2">
		<table id="myTable" >
		<thead>
		<tr  style="background-color: black; color: white;">
			<th id="dni">DNI</th>
			<th id="ape">Estudiante</th>
			<th id="anio">Año</th>
			<th id="cont">Contacto</th>
			<th id="cant">Cantidad</th>
			<th id="adeudadas">Espacios Adeudados</th>
		</tr>
		</thead>
		<tbody><!-- <?echo var_export($muestraAlu,TRUE)?> -->
<?
foreach($muestraAlu AS $doc => $td) printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",$doc,$td['apeNom'],$td['curso'],$td['cont'],$td['cant'],$td['materias']);
?>
		</tbody></table></td></tr>
		<tr><td colspan = "2">
		<p align="left"><br><br></p>
		</td></tr>
			</table>
<!--		<script>
		 let table = new DataTable('#myTable', {
			language: {
				url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-AR.json',
		 },});
		 table
		.columns( 'cur,divi,ape,nom' )
		.order( 'desc' )
		.draw();
		</script> -->

			</td></tr></tbody>
	</table>


<? /*
echo "<p>";
var_dump($GLOBALS);
echo "</p>\n"; */
include 'foot.php';
} //
else {
	echo "<h1>USUARIO NO AUTENTICADO</h1>";
} ?>
