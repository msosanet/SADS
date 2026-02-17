<p>&nbsp;</p>
<?
	$fecha_desde=date("Y-m-d");  /*
	$anio=date("Y");
	$mes=date("m"); 
	$dia=date("d");       
	$fecha_hasta=$anio."-12-31";
	$fecha_hoy=$anio."-".$mes."-".$dia; */
	$fecha_hoy=$fecha_desde;
	$_pagi_sql="SELECT docentes.dni,apellido,nombre, motivo,hora, descripcion,fecha_desde,observaciones, count( motivo ) AS cantidad,f_notif FROM ausentes, motivos, docentes WHERE ausentes.fecha_desde >= '$fecha_hoy' AND ausentes.identificacion = 1 AND ausentes.motivo = motivos.codigo AND ausentes.docente = docentes.dni and (ausentes.motivo=89 or ausentes.motivo=83 or ausentes.motivo=84 or ausentes.motivo=29 or ausentes.motivo=20 or ausentes.motivo=1 or ausentes.motivo=2 or ausentes.motivo=3 or ausentes.motivo=4 or ausentes.motivo=8 or ausentes.motivo=9 or ausentes.motivo=24 or ausentes.motivo=6 or ausentes.motivo=7 or ausentes.motivo=42 or ausentes.motivo=44 or ausentes.motivo=15 or ausentes.motivo=3 or ausentes.motivo=56 or ausentes.motivo=67 or ausentes.motivo=5 or ausentes.motivo=70 or ausentes.motivo=48 or ausentes.motivo=17 or ausentes.motivo=18 or ausentes.motivo=22 or ausentes.motivo=40 or ausentes.motivo=43 or ausentes.motivo=53 or ausentes.motivo=78 or ausentes.motivo=72 or ausentes.motivo=46 or ausentes.motivo=25 or ausentes.motivo=92) GROUP BY dni,hora ORDER BY apellido, fecha_desde";
// ACA AGREGUE MOTIVO 5
$_pagi_cuantos=125;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>


<?
echo "P&aacute;g. " . $_pagi_navegacion;
?>


<table border="1" id="table1" cellpadding="2" cellspacing="0" bordercolor="#C0C0C0">
	<tr>
		<td class="text1b" colspan="7" height="40" align="left">
		&nbsp;Personal con m&aacute;s de 2 d&iacute;as de licencia</td>
	</tr>
	<tr bgcolor="#cccccc">
		<td width="250" align="center" height="36">Docente</td>
		<td width="200" align="center" height="36">Motivo</td>
		<td width="240" align="center" height="36">Obs</td>
		<td width="18" align="center" height="36">Cantidad de dias</td>
		<td width="70" align="center" height="36">Fecha Inicio</td>
		<td width="70" align="center" height="36">Fecha Hasta</td>
		<td width="70" align="center" height="36">Hoy</td>
					
					
	</tr>
<?php
while ($fila2 = mysql_fetch_array($_pagi_result)) {	
	$contador=0;
	if ($fila2['cantidad'] > 2) {
		if ($fila2['motivo']==25) echo ' <tr bgcolor="#DDCCCC"> ';
		else echo ' <tr bgcolor="#ffffff"> ';?>
			<td align="left"><a href=leg_unif.php?actor=<?echo $fila2['dni'];?> target=_blank><?echo "<b>" . $fila2['apellido'] . "</b>, " . $fila2['nombre'];?></a></td>
			<td align="left"><?echo $fila2['descripcion'];?></td>
			<td align="left"><?echo $fila2['observaciones'];?></td>
			<td align="center"><?echo $fila2['cantidad'];?></td>
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
	<td width="20" bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fechainicio);?></td>
	<td width="20" bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fecha2);?></td>
	<td width="20" bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fecha1); ?></td>
	</tr><?

	}
}
?>
</table>