<?PHP  //Eliminar una vez resuelto la inquietud. Moran 10/10/24 se muestra el 7
session_start();

include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
if (!mysql_num_rows($resultt)) {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
}




include '_ausentes.php';

?>

<!DOCTYPE html >


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css?t=123456" />
<link rel="stylesheet" type="text/css" href="motivos.css" />
<title>AUSENTES PIZARRA</title>

<style>
div.container {
  overflow: scroll;
}
thead th {
  position: -webkit-sticky; /* for Safari */
  position: sticky;
  top: 0;
}

tbody th {
  position: -webkit-sticky; /* for Safari */
  position: sticky;
  left: 0;
}
</style>


</head>
<body >

<? include 'header.php'; ?>


<?
if ($_SESSION['valor']==1)  include 'menuppal2.php'; // +++++++++++++++++ ADMINISTRACIÓN
if ($_SESSION['valor']==0) include 'menuppal.php'; // ++++++++++++++++++ DIRECTIVO
if ($_SESSION['valor']==3)  include 'menuppal3.php'; // +++++++++++++++ PRECEPTOR
if ($_SESSION['valor']==4)  include 'menuppal4.php'; // ++++++++++++++ E.O.E.
if ($_SESSION['valor']==5) include 'menuppal5.php';
?>

<?


if (isset($_GET["fecha_desde"])) {
	$fecha_desde = $_GET["fecha_desde"];
}
else {
	$fecha_desde = date("Y-m-d");
} // $fecha_desde = "2022-09-01"; //"2024-10-08"; // para desarrollo

$hoy = $fecha_desde;// compatibilidad con _ausentes.php
$consulta_desde = date("Y-m-d",strtotime("-16 day",strtotime($hoy)));


if (date("w",strtotime($fecha_desde))==1) {
	$ini_semana=$fecha_desde;
}
else {
	$ini_semana=date("Y-m-d",strtotime("last Monday",strtotime($fecha_desde)));
}
	$fin_semana=date("Y-m-d",strtotime("next Friday",strtotime($ini_semana)));

	$leyenda="<font color='#cc0000'>Si desea actualizar la información presione la tecla F5.</font> <a href='ver_ina2.php' >Para ver datos específicos por docente puede seguir este enlace</a> <a href='ver_piza_pre2022.php' style='color: lightblue;' >Versión anterior de la pizzara</a>";
	//$doc_ausente = mysql_query("SELECT  `a`.`codigo`,`a`.`docente`,`a`.`fecha_desde`,`a`.`motivo`,`a`.`observaciones`,`a`.`identificacion`,`a`.`mostrar`, `a`.`veo`,`m`.`descripcion`,`m`.`descrip_corta`,`d`.`nombre`,`d`.`apellido` FROM 	`ausentes` AS `a`,`motivos` AS `m`, `docentes` AS `d` WHERE `a`.`fecha_desde` >= \"$consulta_desde\" AND `a`.`fecha_hasta` <= \"$fin_semana\" AND `d`.`dni` = `a`.`docente` AND `m`.`codigo`=`a`.`motivo` AND `a`.`motivo` NOT IN (15,29,32,34,42,47,52) AND `a`.`veo` = 0 AND `a`.`identificacion` = 1 ORDER BY `a`.`docente` ASC,`a`.`motivo` ASC,`a`.`fecha_desde` ASC, `a`.`codigo` DESC");
	$doc_ausente = mysql_query("SELECT 1 AS codigo,licCor.*, docentes.nombre, docentes.apellido FROM docentes RIGHT JOIN (SELECT licenciados.*, motivos.descripcion, motivos.descrip_corta FROM motivos RIGHT JOIN (SELECT ausentes.docente,fecha_desde,ausentes.motivo,observaciones,identificacion,mostrar,veo FROM ausentes LEFT JOIN (SELECT docente,motivo,COUNT(motivo) AS dias FROM ausentes WHERE fecha_desde >= DATE_SUB('$ini_semana', INTERVAL 7 DAY) AND fecha_hasta <= '$fin_semana' AND motivo NOT IN (15,29,32,34,42,47,52) AND veo = 0 AND identificacion GROUP BY docente,motivo) aus14d ON aus14d.motivo = ausentes.motivo AND aus14d.docente = ausentes.docente WHERE fecha_desde >= '$ini_semana' AND dias < 12) AS licenciados ON licenciados.motivo = motivos.codigo) as licCor ON licCor.docente = docentes.dni ORDER BY docente ASC,motivo ASC,fecha_desde ASC");

	$consulta=array();
	while ($doc_aus = mysql_fetch_array($doc_ausente)) $consulta[] = $doc_aus;

	$cabeceras = ["Docente","Lunes " . date('j',strtotime($ini_semana)),
		"Martes " . date('j',strtotime("next Tuesday",strtotime($ini_semana))),
		"Miércoles " . date('j',strtotime("next Wednesday",strtotime($ini_semana))),
		"Jueves " . date('j',strtotime("next Thursday",strtotime($ini_semana))),
		"Viernes "  . date('j',strtotime($fin_semana))];
	$_antes = microtime(true);
	$ausentes = capturarArt($consulta);
	$_capturar = microtime(true);
	$listados = _tabular($ausentes);
	$_tabu = microtime(true);
	array_multisort($listados[0],SORT_REGULAR);
	$_orden = microtime(true);
	$reordenar = acomodarClaves($listados[1]);
	$_acomCla = microtime(true);
	array_multisort($reordenar);
	$_ordeLarDur = microtime(true);

	$qAusente15d = mysql_query("SELECT 1 AS codigo,licCor.*, docentes.nombre, docentes.apellido FROM docentes RIGHT JOIN (SELECT licenciados.*, motivos.descripcion, motivos.descrip_corta FROM motivos RIGHT JOIN (SELECT ausentes.docente,MAX(fecha_hasta) AS hasta,ausentes.motivo,observaciones,identificacion,mostrar,veo FROM ausentes LEFT JOIN (SELECT docente,motivo,COUNT(motivo) AS dias FROM ausentes WHERE fecha_desde >= DATE_SUB('$ini_semana', INTERVAL 7 DAY) AND fecha_hasta <= '$fin_semana' AND motivo NOT IN (15,29,32,34,42,47,52) AND veo = 0 AND identificacion GROUP BY docente,motivo) aus14d ON aus14d.motivo = ausentes.motivo AND aus14d.docente = ausentes.docente WHERE fecha_desde >= '$ini_semana' AND dias > 11 GROUP BY docente,motivo) AS licenciados ON licenciados.motivo = motivos.codigo) as licCor ON licCor.docente = docentes.dni ORDER BY apellido,nombre");
	$ausentes15d = [];
	$muestraSegundaTabla = mysql_num_rows($qAusente15d);
	while($__15d = mysql_fetch_array($qAusente15d)) $ausentes15d[] = $__15d;



// echo "<!--listados " . var_export($listados,true) . " -->";
//printf("<pre>%s</pre><pre>%s</pre>",var_export($listados[0],true),1);
?>
		<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<table border="0" width="970" >
				<tr>
					<td width="30%" bgcolor="#EAEAEA" align="right"><a href='<?php echo $_SERVER['PHP_SELF']; ?>?fecha_desde=<? echo date("Y-m-d",strtotime("-7 days",strtotime($fecha_desde)));?>' ><< Mostrar semana anterior</a></td>
    				<td bgcolor="#EAEAEA" width="40%" align="center"><p>Mostrando semana del:</a></p>
						<input type="date" name="fecha_desde" width="10" id="fecha_desde" value="<?echo $fecha_desde;?>"/><br>
						<input type="submit" name="Cambiar" id="submit" value="Cambiar fecha" />
					</td>
					<td width="30%" bgcolor="#EAEAEA" align="left"><a href='<?php echo $_SERVER['PHP_SELF']; ?>?fecha_desde=<? echo date("Y-m-d",strtotime("+1 week",strtotime($fecha_desde)));?>' >Mostrar semana siguiente >></a></td>
				</tr>
				<tr><td colspan=3><?=$leyenda?>
				</td></tr>
			</table>
		</form>

		<div style="overflow-y: scroll; max-width:980px; max-height: 500px">
			<table id="tableam">
				<thead><tr><?PHP $_anteTabla = microtime(true); foreach($cabeceras as $col) echo "<th bgcolor='#808080' align='center' height='36'>" . $col . "</th>\n";?></tr></thead>
				<tbody>
				<?PHP foreach ($listados[0] as $linea ) echo "<tr>" . implode($linea) . "</tr>\n";?>
				</tbody>
			</table>
		</div>
		<br><br>
		<div style="overflow-y: scroll; max-width:980px; max-height: 500px"><? $_tablaSem = microtime(true); if($muestraSegundaTabla) $_crono = despliegaLd($ausentes15d);?></div>
		<br><br>

			<?
			include 'footer.php';
			?>


</div>

</body>

</html>
<?

 foreach ($_crono AS $_doc => &$_art) {
	foreach ($_art AS &$_marca) $_marca[2] = $_marca[1]-$_marca[0];
}

$_largaDur = microtime(true);
printf("<!-- capturar: %s \n     tabular: %s \n     ordenar: %s \n     Larga: %s \n     Orden: %s \n     tabla semana: %s \n     tabla largas: %s \n despliegue: \n %s-->",($_capturar-$_antes),($_tabu-$_capturar),($_orden-$_tabu),($_acomCla-$_orden),($_ordeLarDur-$_acomCla),($_tablaSem-$_anteTabla),($_largaDur-$_tablaSem),var_export($_crono,true));


function tabla_titulos($columnas){ //crea encabezados de la tabla
	foreach($columnas as $col){
		echo "<th bgcolor='#808080' align='center' height='36'>" . $col . "</th>\n";
	}
}

function licenciadosSemana($fechaLunes){ //sin usar
	$conLicencia = mysql_query("SELECT `docente` FROM `ausentes` WHERE `fecha_desde`=$fechaLunes");
}

function calculaDespliegaLd ($array) {
	if (is_array($array) && count($array,1)>1) {
		echo "<table id='tableam' ><tr><th>Personal justificado por más de 10 días consecutivos</th></tr>\n";

		require_once "conexion_stmt.php";
		if ($stmt_ok) {

			$registros_temporales = [];


			$sentencia = mysqli_stmt_init($enlace);
			if (mysqli_stmt_prepare($sentencia, 'SELECT MAX(fecha_hasta) FROM ausentes WHERE docente = ? AND motivo = ?')) {
				foreach ($array as $linea ) {

					$registros_temporales[$linea[1]][$linea[3]][] = microtime(true);

					if ($linea[6]==0) {
						switch ($linea[3]) {
							case 20:
							case 21:
							case 89:
							case 10:
							case 12:
							case 16:
							case 22:
							case 25:
							case 24:
							case 75:
							case 84:
								$info = " por "  . $linea[8] . " <dfn>" . $linea[4] . "</dfn>";
								break;
							default:
								$info = " por "  . $linea[8];
						}
					} else {
						if(isset($linea[12])){
							$info = $linea[12];
						} else { $info = "";}
					} //Revisar para art 16 y 27
					mysqli_stmt_bind_param($sentencia, "ii", $linea[1],$linea[3]);

					$registros_temporales[$linea[1]][$linea[3]][] = microtime(true);

					mysqli_stmt_execute($sentencia);

					$registros_temporales[$linea[1]][$linea[3]][] = microtime(true);

					mysqli_stmt_bind_result($sentencia, $fecha);
					mysqli_stmt_fetch($sentencia);
					echo "<tr><td>" . $linea[11] . ", " . $linea[10] . " hasta el " . date("d/m/Y",strtotime($fecha)) . $info .  "</td></tr>\n";

					$registros_temporales[$linea[1]][$linea[3]][] = microtime(true);

				}
			}
		}
		echo "</table>\n";
	}
	return $registros_temporales;
}

function despliegaLd ($array) {
	echo "<table id='tableam' ><thead><tr><th>Personal justificado por más de 10 días consecutivos</th></tr><thead>\n";

	$registros_temporales = [];

	foreach ($array as $linea ) {

		$registros_temporales[$linea[1]][$linea[3]][] = microtime(true);

		if ($linea[6]==0) {
			switch ($linea[3]) {
				case 20:
				case 21:
				case 89:
				case 10:
				case 12:
				case 16:
				case 22:
				case 25:
				case 24:
				case 75:
				case 84:
					$info = " por "  . $linea[8] . " <dfn>" . $linea[4] . "</dfn>";
					break;
				default:
					$info = " por "  . $linea[8];
			}
		} else {
			if(isset($linea[12])){
				$info = $linea[12];
			} else { $info = "";}
		} //Revisar para art 16 y 27
		echo "<tr><td>" . $linea[11] . ", " . $linea[10] . " hasta el " . date("d/m/Y",strtotime($linea['hasta'])) . $info .  "</td></tr>\n";

		$registros_temporales[$linea[1]][$linea[3]][] = microtime(true);

	}
	echo "</table>\n";
	return $registros_temporales;
}

?>
