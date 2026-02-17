<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<title><?=$filatt['apellido']?>: Asistencia según parte preceptores</title>

</head>
<?
include 'header.php';

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

<body>
<div align="center" style="max-width: 980px">
<table border="0" width="980">
	<tr>
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
 </tr>
	<tr>
		<td><br>
			<p align="left" class="text1b">Ver Parte de <?=$filatt['apellido']?>, <?=$filatt['nombre']?></p>
			<p align="center" class="text1b"><br></p>	
					
					
<?
$result77 = mysql_query ("SELECT * FROM partepreceptores WHERE docente = '$actor' order by fecha DESC");
?>
<div align="center" style="width:100%; overflow: auto;max-height: 480px">
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<caption>EN BASE A PARTE DIARIO DE PRECEPTORES</caption>
						<thead><tr>
						<th>FECHA</th>
						<th>ASISTENCIA</th>
						<th>OBS.</th>
						<th>CURSO</th>
						<th>ANOTACIÓN</th>

					</tr></thead>

		<?php while ($fila77 = mysql_fetch_array($result77))
		{
			$asist = $_estados[$fila77['estado']];
			$fecha_as = date("d-m-Y",strtotime($fila77['fecha']));
			$curdiv = substr($fila77['curso'],0,1) . "° " . substr($fila77['curso'],1);
			if ($fila77['estado']=='A') $tr_color = "#F08080";
			else $tr_color = "#FFFFFF";

?>
					<tr style="background-color: <?=$tr_color?>">
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0"><?=$fecha_as?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0"><?=$asist?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0"><?=$fila77['observaciones']?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<?=$curdiv?>


						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<?php echo $fila77['anotaciones'];?>
		
						</td>

	
	
					</tr>
		<?}?>

</table></div>


						
					</p>
					<p align="center">&nbsp;</td>
				</tr>


			</table>
			</div>
			<?
			include 'footer.php';
			?>
 </body>
<?
}
else {
?>
<meta http-equiv='refresh' content='0; URL=ver_parte.php'>
<?PHP
}
?>
</html>
<? } ?>
