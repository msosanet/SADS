<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
if (isset($_GET["actor"])) $dni=$_GET["actor"];
else echo "<script>history.back()</script>";
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;




$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/select/2.0.1/js/dataTables.select.js" crossorigin="anonymous"></script>"
<script src="https://cdn.datatables.net/select/2.0.1/js/dataTables.select.min.js" crossorigin="anonymous"></script>

<title>Ausencias de <?=$filadocente['apellido']?> <?=$filadocente['nombre']?></title>

<script>
	$(document).ready(function(){
		 let table = new DataTable('#table1', {
//			select: true,
		/*	columnDefs: [
        {
            orderable: false,
            render: DataTable.render.select(),
            targets: 0
        }
    ],
    select: {
        style: 'os',
        selector: 'td:first-child'
    },
    order: [[1, 'asc']], */   
			language: {
				url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json',
		 },});
		 table.order([1, 'desc']).draw();		
//			muestraClases(<?=$curso?>,<?=$materia?>);
//		 $("#registros").load("libro/regsLibro.php","materia=<?=$materia?>&curso=<?=$curso?>");
		});
//$( "[type=checkbox]" )
</script>																						 


</head>
<?
include 'header.php';

?>
<body background="bgris.gif" >
<?
	$errordoc = 0;
	$hayerrores = 0;

  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos

	
}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="GET" action="baja_ina2.php?actor=<?php echo $dni?>">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980">
<?if ($_SESSION['valor']==1)
{		
include 'menuppal2.php';
}
if ($_SESSION['valor']==0)
 {		
include 'menuppal.php';
}
if ($_SESSION['valor']==3)
 {		
include 'menuppal3.php';
}
?>
				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Listado a dar de baja de &nbsp;<?echo $filadocente['apellido'];?>&nbsp;<?echo $filadocente['nombre'];?></p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
	
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>

					<p align="left">
</font>
 
<?






	$_pagi_sql="SELECT * FROM ausentes WHERE docente='$dni' order by fecha_desde DESC";

$q_ausencias = mysql_query($_pagi_sql);
/*
$_pagi_cuantos=20;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
*/
?>
<p align="left"><?
//echo"$_pagi_navegacion"; 
?>

</p>

<caption class="text1b"background="../imag/bar07.gif"  colspan="9" height="40" align="left">
							&nbsp; Seleccione para borrar</caption>

 <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
					<!--	<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="9" height="40" align="left">
							&nbsp; Seleccione para borrar</td>
						</tr> -->
		<thead>
						<tr>
							<td></td>
							<td width="200" bgcolor="#808080" align="center" height="36">Docente</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Fecha Desde</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Fecha Hasta</td>
							<td bgcolor="#808080" width="70" align="center"  height="36">Hora</td>
							<td bgcolor="#808080" width="200" align="center"  height="36">Motivo</td>
							<td bgcolor="#808080" width="200" align="center"  height="36">Observaciones</td>
							<td bgcolor="#808080" width="80" align="center"  height="36">Notific&oacute;</td>
							<td bgcolor="#808080" width="100" align="center"  height="36">F_Notif</td>
							<td bgcolor="#808080" width="80" align="center"  height="26">Borrar</td>
						</tr>
		</thead>
		<tbody>

		<?php
		while ($fila2 = mysql_fetch_array($q_ausencias))
//		while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
			$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila2[docente]' ");
			$filaobs = mysql_fetch_array($resultobs);

if ($filaobs[identificacion]==1)
{
$resultmot = mysql_query ("SELECT * FROM motivos WHERE codigo = '$fila2[motivo]' "); 
			$filamot = mysql_fetch_array($resultmot);
}
else
{
$resultmot = mysql_query ("SELECT * FROM motivos2 WHERE codigo = '$fila2[motivo]' "); 
			$filamot = mysql_fetch_array($resultmot);
}


		?> 

						<tr>
							<td></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaobs[apellido];?>,<?echo $filaobs[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[fecha_desde];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[fecha_hasta];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[hora];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filamot[descripcion];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[observaciones];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[notifico];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[f_notif];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><input name="afectado[]" type="checkbox" value="<?php echo $fila2[codigo]?>"></td>
						</tr>
						<?
						}
						?>
					</tbody>
					</tfoot>
					<tr>
						<td align="center" width="752" colspan="9">
						<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</td>
					</tr>
					</tfoot>
						</table>
<script>     /*
		 let table = new DataTable('#table1', {
			language: {
				url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-AR.json',
		 },});
		 table.order([1, 'desc']).draw();       */
</script>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
				<table border="0" width="100%" id="table10" cellspacing="0" cellpadding="0">
					<tr>
						<td>
						<p align="center">&nbsp;<input type="submit" value="Borrar" name="submitx"></td>
						</table>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
			</div>
					<hr>
					</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
			</div>
		</tr>
<input name="actor" type="hidden" value ="<?php echo $dni ?>"/>
	</table>
	</form>
</div>
</body>
<?
}
else
{
foreach ($_GET["afectado"] as $afectado)
	{
		if (mysql_query ("DELETE from ausentes where codigo=$afectado"))
		{	
				
		}
	}
				?>
				<script>
				var answer=alert("horas borradas Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=baja_ina1.php?'>
				<? 
				
}

?>

</html>
<? } ?>
