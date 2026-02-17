<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>


<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js" crossorigin="anonymous"></script>

<title>Novedades: personal con m&aacute;s de 2 d&iacute;as de licencia restantes</title>

<script>
	 $(document).ready(function(){
		let table = new DataTable('#table1', {
			language: {
				url: '//cdn.datatables.net/plug-ins/2.1.6/i18n/es-AR.json',
			},
			order : [[0, 'asc']],
			});
		});
</script>


</head>
<?
include 'header.php';

?>

<body>


<div style="align:center;max-width: 980px" >

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>


</div>

<p>&nbsp;</p>
<?

	$q_licenciados = "SELECT CONCAT(docentes.apellido, ', ',docentes.nombre) AS agente,am2d.* FROM (SELECT rif.docente,rif.motivo,rif.observaciones,rif.res,rif.f,rif.i,motivos.descripcion FROM (SELECT ausentes.*,COUNT(motivo) AS res,MAX(fecha_hasta) AS f,tfi.i FROM (SELECT d,m,h,MIN(fecha_desde) AS i FROM (SELECT DISTINCT docente AS d,motivo AS m,hora AS h FROM `ausentes` WHERE motivo IN (89,83,84,29,20,1,2,3,4,8,9,24,6,7,42,44,15,3,56,67,5,70,48,17,18,22,40,43,53,78,72,46,25,92,95) AND fecha_desde >= CURRENT_DATE AND identificacion = 1 /*ausentes*/) AS todos LEFT JOIN ausentes ON ausentes.docente = todos.d AND ausentes.motivo = todos.m AND ausentes.hora = todos.h GROUP BY docente,motivo,hora /*ausentes con inicio licencia*/) AS tfi LEFT JOIN ausentes ON ausentes.docente = tfi.d AND ausentes.motivo = tfi.m AND ausentes.hora = tfi.h WHERE fecha_desde >= CURRENT_DATE GROUP BY docente,motivo,hora /*con dias restantes y fecha de fin*/) AS rif LEFT JOIN motivos ON rif.motivo = motivos.codigo WHERE rif.res > 2 /*con +2 dias y motivo*/) AS am2d LEFT JOIN docentes ON docentes.dni = am2d.docente";

	$_licenciados = mysql_query($q_licenciados);

?>

<h2 style="align:left">Personal con m&aacute;s de 2 d&iacute;as de licencia restantes</h2>

<div style="max-width:80%">
<table class="table table-bordered" id="table1" >
	<thead>
	<tr>
		<th width="250" align="center" height="36">Docente</th>
		<th width="200" align="center" height="36">Motivo</th>
		<th width="240" align="center" height="36">Detalles</th>
		<th width="18" align="center" height="36">D&iacute;as restantes</th>
		<th width="70" align="center" height="36">Fecha Inicio</th>
		<th width="70" align="center" height="36">Fecha Hasta</th>
	</tr>
	</thead>
<?php
while ($fila2 = mysql_fetch_array($_licenciados)) {
//	$_renuncia = ($fila2['motivo']==25) ? "S&Iacute;" : "";
	$_realce = ($fila2['motivo']==25) ? "danger" : "";
/*		if ($fila2['motivo']==25) echo ' <tr bgcolor="#DDCCCC"> ';
		else echo ' <tr bgcolor="#ffffff"> '; */?>
	<tr class="<?=$_realce?> ">
	<td align="left"><a href=leg_unif.php?actor=<?=$fila2['docente'];?> target=_blank><?=$fila2['agente']?></a></td>
	<td align="left"><?=$fila2['descripcion']?></td>
	<td align="left"><?=$fila2['observaciones']?></td>
	<td align="center"><?=$fila2['res']?></td>
	<td width="20" bgcolor="#EAEAEA" align="center"><?=date("d-m-Y",strtotime($fila2['i']))?></td>
	<td width="20" bgcolor="#EAEAEA" align="center"><?=date("d-m-Y",strtotime($fila2['f']))?></td>
	</tr>
<?
}
?>
</table></div>


</body>
<?
	include 'footer.php';
?>
</html>

