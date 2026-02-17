<?PHP
session_start();
if ($_SESSION['estado']==1) { //verifica que hay usuario con sesión inciada

$anio = $_SESSION['cicloLectivo'];

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>Actualizar tabla previas</title>

</head>
<?
include 'encabezado.php';
conectar();
$errordoc = 0; 
$hayerrores = 0;
$flag = 0;
if (isset($_GET["submitx"])) {

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {

?>

<div align="center">
	<table border="0" width="980">
		<tr>
			<td>

<!-- ++++++++++++++++++++++++++++++++ BARRA DE MENUS +++++++++++++++++++++++ -->
<?
include 'snipet_barramenu.php';
?>
<!-- ++++++++++++++++++++++++++++++++ FIN BARRA DE MENUS +++++++++++++++++++++++ -->
<div align="center">
			<table border="0" width="980">
				<tr>
					<td>
					<p class="titles1" align="left">Estudiantes que repitieron de a&ntilde;o</p>
 
<?
$previo = $anio - 1;
//$q_repis = mysql_query("SELECT repis.alumno,alumno.apellido,alumno.nombre,alumno.sexo,cursa.curso,cursa.divi FROM (SELECT DISTINCT c.alumno FROM `cursa` AS c,(SELECT alumno,curso,divi,anio FROM `cursa` WHERE control = 1 AND anio = '$anio') AS a WHERE c.anio = '$previo' AND c.curso = a.curso AND c.alumno = a.alumno) AS repis,alumno,cursa WHERE cursa.control = 1 AND cursa.anio = '$anio' AND cursa.alumno = repis.alumno AND alumno.dni = repis.alumno ORDER BY cursa.curso,cursa.divi,alumno.apellido,alumno.nombre");

$repitentes_q = "SELECT DISTINCT c.alumno FROM `cursa` AS c,(SELECT alumno,curso,divi,anio FROM `cursa` WHERE control = 1 AND anio = '2023') AS a WHERE c.anio = '2022' AND c.curso = a.curso AND c.alumno = a.alumno ";
$repitentes = mysql_query($repitentes_q);
$repitentesArray = mysql_fetch_assoc($repitentes);
$dniRepitentes = "(" . $repitentesArray['alumno'];
while ($repitentesArray = mysql_fetch_assoc($repitentes)) $dniRepitentes = $dniRepitentes . "," . $repitentesArray['alumno'];
$dniRepitentes = $dniRepitentes . ")";

$cargadas_q = mysql_query("SELECT * FROM `previas` WHERE id > 4498 ");
$cargadas = obtenerArray($cargadas_q);

mysql_select_db("calificadores");

$listado = array();
for ($curso_q = 1; $curso_q < 7; $curso_q++) {
 
 $previas_q = 'SELECT calificador2.dni,CONCAT(materias.descripcion, " '.$curso_q.'º") AS materia,calificador2.materia AS idmat FROM `calificador2` LEFT JOIN materias ON materias.idmateria = calificador2.materia WHERE calificador2.curso IN (SELECT DISTINCT curso FROM calificador2 WHERE curso LIKE "'.$curso_q.'_") AND calificador2.idnota = 10 AND calificador2.nota < 6 AND calificador2.nota > 0 AND calificador2.anio = 2022 AND calificador2.materia NOT IN (58,60,70,76,77,78,79,80,81,82,83,84,85,86) AND calificador2.dni NOT IN '.$dniRepitentes ;
 $previas = mysql_query($previas_q);
 while ($lain = mysql_fetch_assoc($previas)) {
  $lain{'anio'} = $curso_q;
  $listado[] = $lain;
 }
 echo "<!-- $previas_q -->\n";
}

$recorridos = 0;
$iguales = 0;
$extraidos = array();
$normalizado = array();
//$arrays = $listado;
foreach($listado AS $num_linea => $mat_previa) {
 $listado[$num_linea]['materia'] = ucwords(strtolower($mat_previa['materia']));
}
$lisCantidad = count($listado);
for ($indice = 0; $indice < $lisCantidad; $indice++) { //Recorre listado de adeudan
 foreach($cargadas AS $yaCargada) { // Retira los ya existentes en previas
  $prev_alu = $listado[$indice]['dni'];
  $carg_alu = $yaCargada[1];
  $prev_mat = $listado[$indice]['idmat'];
  $carg_mat = $yaCargada[3];
  $prev_cur = $listado[$indice]['anio'];
  $carg_cur = $yaCargada[4];
/*  $normalizado = array($prev_mat,$carg_mat);*/
  if ($prev_alu==$carg_alu AND $prev_mat==$carg_mat AND $prev_cur==$carg_cur) { // Comprueba si ya están entre las previas
   $extraidos[] = array_splice($listado,$indice,1);
   $indice--;
   $lisCantidad--;
  }
 }
}

//$repitentes = obtenerArray($q_repis);
//mysql_free_result();

?>
<br><br>

					</td>
				</tr>
			</table>
			</div>
			</td>
		</tr>
	</table>
</div>

<?

mysql_select_db("alumnos");
$hoy = date("Y-m-d");
foreach ($listado AS $agregar) {
 $agrega_q[] = "INSERT INTO previas_de_calificador VALUES ('',$agregar[dni],'$agregar[materia]',$agregar[idmat],$agregar[anio],0,'0000-00-00','','ADEUDA','$hoy')";
// if (mysql_query($agrega_q)) {}
// else $fallos[] = $agrega_q;
}

echo "<!-- Listado " . var_export($listado,true) . "-->\n";
//echo "<!-- Fallos " . var_export($fallos,true) . "-->\n";
//echo "<!-- Listado completo " . var_export($arrays,true) . "-->\n";
//echo "<!-- Repitentes " . var_export($repitentes,true) . "-->\n";
//echo "<!-- Cargadas " . var_export($cargadas,true) . "-->\n";
//echo "<!-- Consultas " . var_export($agrega_q,true) . "-->\n";
echo "<!-- Listado Extraidos " . var_export($extraidos,true) . "-->\n";
echo "<!-- Restantes: " . count($listado) . " Extraidos " . count($extraidos) . " Cargadoas: ".count($cargadas) . " Iguales: $iguales-->";
include 'foot.php';

// INSERT INTO `previas`(`alumno`, `materia`, `nota`, `fecha`, `folio`, `observacion`, `fecha_carga`) SELECT `alumno`, `materia`, `nota`, `fecha`, `folio`, `observacion`, `fecha_carga` FROM previas_de_calificador Where 1 

}
} //Si no hay usuario registrado va a la pantalla de ingreso
else echo "<meta http-equiv='refresh' content='0; URL=i_admin.php'>";
function obtenerArray($consulta) {
	$tabla = array();
	while ($fila = mysql_fetch_row($consulta)) $tabla[] = $fila;
	return $tabla;
}
 ?>