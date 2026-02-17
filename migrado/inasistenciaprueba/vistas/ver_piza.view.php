<!DOCTYPE html >


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css?t=123456" />
<link rel="stylesheet" type="text/css" href="motivos.css" />
<title>AUSENTES PIZARRA</title>


</head>
<body >

<? include 'header.php'; ?>

	<table	 width="970" bgcolor="#FFFFFF">
		<thead><tr>
			<th style="background-color:#C7C8CA">
			
<? 
if ($_SESSION['valor']==1)  include 'menuppal2.php'; // +++++++++++++++++ ADMINISTRACIÓN 
if ($_SESSION['valor']==0) include 'menuppal.php'; // ++++++++++++++++++ DIRECTIVO 
if ($_SESSION['valor']==3)  include 'menuppal3.php'; // +++++++++++++++ PRECEPTOR 
if ($_SESSION['valor']==4)  include 'menuppal4.php'; // ++++++++++++++ E.O.E. 
if ($_SESSION['valor']==5) include 'menuppal5.php';
?>
		</th></tr></thead>
<?


if (isset($_GET["fecha_desde"])) {
	$fecha_desde = $_GET["fecha_desde"];
}
else {
	$fecha_desde = date("Y-m-d");
}

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
	$doc_ausente = mysql_query("SELECT  `a`.`codigo`,`a`.`docente`,`a`.`fecha_desde`,`a`.`motivo`,`a`.`observaciones`,`a`.`identificacion`,`a`.`mostrar`, `a`.`veo`,`m`.`descripcion`,`m`.`descrip_corta`,`d`.`nombre`,`d`.`apellido` FROM 	`ausentes` AS `a`,`motivos` AS `m`, `docentes` AS `d` WHERE `a`.`fecha_desde` >= \"$consulta_desde\" AND `a`.`fecha_hasta` <= \"$fin_semana\" AND `d`.`dni` = `a`.`docente` AND `m`.`codigo`=`a`.`motivo` AND `a`.`motivo` NOT IN (15,29,32,34,42,47,52) AND `a`.`veo` = 0 AND `a`.`identificacion` = 1 ORDER BY `a`.`docente` ASC,`a`.`motivo` ASC,`a`.`fecha_desde` ASC, `a`.`codigo` DESC");
	$clave = 0;
	while ($doc_aus = mysql_fetch_array($doc_ausente)) {
		$consulta[$clave] = $doc_aus;
		$clave++;
		
	}
	
	
	
	$cabeceras = ["Docente","Lunes " . date('j',strtotime($ini_semana)),
		"Martes " . date('j',strtotime("next Tuesday",strtotime($ini_semana))),
		"Miércoles " . date('j',strtotime("next Wednesday",strtotime($ini_semana))),
		"Jueves " . date('j',strtotime("next Thursday",strtotime($ini_semana))),
		"Viernes "  . date('j',strtotime($fin_semana))];
	
	$ausentes = capturarArt($consulta);
	$listados = tabular($ausentes);
	array_multisort($listados[0],SORT_REGULAR);
	$reordenar = acomodarClaves($listados[1]);
	array_multisort($reordenar);



?>
		<tbody><form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<tr><td>
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
		</td></tr></form>
		</tbody>
	</table>

		<div style="overflow-y: scroll; max-width:980px; max-height: 500px">
			<table id="tableam">
				<tr><? tabla_titulos($cabeceras); ?></tr>
				<?filasDocente($listados[0]);?>
				<tfoot><tr><td colspan = 6></td></tr></tfoot>
			</table>
		</div>
		<br><br>
		<div style="overflow-y: scroll; max-width:980px; max-height: 500px"><?mostrarld($reordenar);?></div>
		<br><br>

			<?
			include 'footer.php';
			?>


</div>

</body>

</html>
<?

function tabla_titulos($columnas){ //crea encabezados de la tabla
	foreach($columnas as $col){
		echo "<th bgcolor='#808080' align='center' height='36'>" . $col . "</th>\n";
	}
}

function filasDocente($doc_ausente){
	foreach ($doc_ausente as $linea ) {
		echo "<tr>" . implode($linea) . "</tr>\n";
	}
}

function licenciadosSemana($fechaLunes){ //sin usar
	$conLicencia = mysql_query("SELECT `docente` FROM `ausentes` WHERE `fecha_desde`=$fechaLunes");
}

?>
