<?PHP
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

//include 'conexion3.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js" crossorigin="anonymous"></script>

<title>Novedades: personal con más de 2 días de licencia</title>

<script>
	$(document).ready(function(){
		 let table = new DataTable('#table1', {
			language: {
				url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json',
		 },});
		 table.order([0, 'asc']).draw();
		});
</script>


</head>
<?
include 'header.php';

?>

<body onload="""" >


<div style="align:center;max-width: 980px" >

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>


</div>

<p>&nbsp;</p>
<?


	$fecha_desde=date("Y-m-d");  /*
	$anio=date("Y");
	$mes=date("m");
	$dia=date("d");
	$fecha_hasta=$anio."-12-31";
	$fecha_hoy=$anio."-".$mes."-".$dia; */
	$fecha_hoy=$fecha_desde;
//	$_pagi_sql="SELECT docentes.dni,apellido,nombre, motivo,hora, descripcion,fecha_desde,observaciones, count( motivo ) AS cantidad,f_notif FROM ausentes, motivos, docentes WHERE ausentes.fecha_desde >= '$fecha_hoy' AND ausentes.identificacion = 1 AND ausentes.motivo = motivos.codigo AND ausentes.docente = docentes.dni and (ausentes.motivo=89 or ausentes.motivo=83 or ausentes.motivo=84 or ausentes.motivo=29 or ausentes.motivo=20 or ausentes.motivo=1 or ausentes.motivo=2 or ausentes.motivo=3 or ausentes.motivo=4 or ausentes.motivo=8 or ausentes.motivo=9 or ausentes.motivo=24 or ausentes.motivo=6 or ausentes.motivo=7 or ausentes.motivo=42 or ausentes.motivo=44 or ausentes.motivo=15 or ausentes.motivo=3 or ausentes.motivo=56 or ausentes.motivo=67 or ausentes.motivo=5 or ausentes.motivo=70 or ausentes.motivo=48 or ausentes.motivo=17 or ausentes.motivo=18 or ausentes.motivo=22 or ausentes.motivo=40 or ausentes.motivo=43 or ausentes.motivo=53 or ausentes.motivo=78 or ausentes.motivo=72 or ausentes.motivo=46 or ausentes.motivo=25 or ausentes.motivo=92 or ausentes.motivo=95) GROUP BY dni,hora ORDER BY apellido, fecha_desde";
	$_pagi_sql = "SELECT docentes.dni,apellido,nombre, motivo,hora, descripcion,fecha_desde,observaciones, COUNT( motivo ) AS cantidad,f_notif FROM ausentes, motivos, docentes WHERE ausentes.fecha_desde >= CURRENT_DATE AND ausentes.identificacion = 1 AND ausentes.motivo = motivos.codigo AND ausentes.docente = docentes.dni AND ausentes.motivo IN (89,83,84,29,20,1,2,3,4,8,9,24,6,7,42,44,15,3,56,67,5,70,48,17,18,22,40,43,53,78,72,46,25,92,95) GROUP BY dni,hora ORDER BY apellido, fecha_desde";

// ACA AGREGUE MOTIVO 5
$_pagi_cuantos=125;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php");
?>

<h2 style="align:left">Personal con m&aacute;s de 2 d&iacute;as de licencia</h2>


<table border="1" id="table1" cellpadding="2" cellspacing="0" bordercolor="#C0C0C0">
	<thead>
	<tr>
		<th width="250" align="center" height="36">Docente</th>
		<th width="200" align="center" height="36">Motivo</th>
		<th width="240" align="center" height="36">Obs</th>
		<th width="18" align="center" height="36">Cantidad de dias</th>
		<th width="18" align="center" height="36">Renuncia</th>
		<th width="70" align="center" height="36">Fecha Inicio</th>
		<th width="70" align="center" height="36">Fecha Hasta</th>
	</tr>
	</thead>
<?php
while ($fila2 = mysql_fetch_array($_pagi_result)) {
	$contador=0;
	if ($fila2['cantidad'] > 2) {
		$_renuncia = ($fila2['motivo']==25) ? "S&Iacute;" : "";
/*		if ($fila2['motivo']==25) echo ' <tr bgcolor="#DDCCCC"> ';
		else echo ' <tr bgcolor="#ffffff"> '; */?>
			<tr>
			<td align="left"><a href=leg_unif.php?actor=<?echo $fila2['dni'];?> target=_blank><?echo "<b>" . $fila2['apellido'] . "</b>, " . $fila2['nombre'];?></a></td>
			<td align="left"><?echo $fila2['descripcion'];?></td>
			<td align="left"><?echo $fila2['observaciones'];?></td>
			<td align="center"><?echo $fila2['cantidad'];?></td>
			<td align="center"><?=$_renuncia?></td>

<?
		$bus1 = mysql_query ("SELECT * FROM ausentes WHERE docente='$fila2[dni]' and fecha_desde >='$fecha_desde' and motivo=$fila2[motivo] order by fecha_desde ");

		while ($buscar2 = mysql_fetch_array($bus1))	{
			if ($contador==0) $fecha1=$buscar2['fecha_desde'];
			$fecha2=$buscar2['fecha_hasta'];
			$contador=1;
		}
		$bus2=mysql_query("SELECT * FROM ausentes WHERE docente='$fila2[dni]' AND motivo='$fila2[motivo]' AND fecha_desde BETWEEN (CURDATE() AND $fecha2) AND observaciones='$fila2[observaciones]' AND f_notif='$fila2[f_notif]' ORDER BY fecha_desde ASC LIMIT 0,1");
		$fechainicio = "0000-00-00";
		while ($buscar3 = mysql_fetch_array($bus2)) {
			if (isset($buscar3['fecha_desde'])) $fechainicio=$buscar3['fecha_desde'];
		}
?>
	<td width="20" bgcolor="#EAEAEA" align="center"><?=date("d-m-Y",strtotime($fechainicio))?></td>
	<td width="20" bgcolor="#EAEAEA" align="center"><?=date("d-m-Y",strtotime($fecha2))?></td>
	</tr><?

	}
}
?>
</table>


</body>
<?
			include 'footer.php';
			?>
</html>
