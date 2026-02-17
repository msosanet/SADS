<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="../csjs/style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Sistema Fo.Ta.Re.</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';
?>
<body background="bgris.gif" >

<p>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo6 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo7 {font-size: 16px; font-weight: bold; color: #FF0000; }
-->
</style>

<?

function fecha($fecha) 
{ 
    if ($fecha) 
   { 
      $f=explode("-",$fecha); 
      $nummes=(int)$f[1]; 
      $mes1="0-Enero-Febre-Marzo-Abril-Mayo-Junio-Julio-Agosto-Septiembre-Octubre-Noviembre-Diciembre"; 
      $mes1=explode("-",$mes1); 
      $desfecha="$mes1[$nummes]"; 
      return $desfecha; 
   } 
}
$conexion = conectar ();
$fecha="0-".date ("m")."-0";
$mez=fecha($fecha);
$mmes=date ("m");




$ano=date("Y");
$_SESSION['form']=$_GET['form'];
$form=$_SESSION['form'];
$sector=$_SESSION['sector'];
$resultformu = mysql_query ("SELECT * FROM formulario WHERE numero = $form");
$filaformu = mysql_fetch_array($resultformu) ;

if ($_SESSION['valor']==0) $resultafect = mysql_query ("SELECT * FROM ente WHERE sector = $sector order by apellido");
if ($_SESSION['valor']==1) $resultafect = mysql_query ("SELECT * FROM ente order by sector,apellido");

$errordoc = 0;
  $hayerrores = 0;

  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos

	
}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="vinc_f10_2.php?form=<?php echo $form?>">
</p>
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
				<table border="0" width="980" cellspacing="0" cellpadding="0">
					<tr>
						
					</tr>
				</table>
				
				<p></div>
			<div align="center">
			<table border="0" width="980">
<?if ($_SESSION['valor']==1)
{		
include 'menuppal2.php';
}
else {		
include 'menuppal.php';
}
?>
				<tr>
				

					<td>
					
					<p align="left" class="text1b">Vincular Personal al F.10</p>
					<br><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
				<div align="center">
	<table border="0" width="779" id="table1" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top">

			<p align="center" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
			<table border="0" width="780" id="table5" cellspacing="0" cellpadding="0">
				<tr>
					<td>
					<p style="margin-top: 0; margin-bottom: 0" align="right"><b>
					Formulario F10 Nº <? echo $form ?>/2010</b></td>
				</tr>
			</table>
			<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
			<div align="center">
				<table border="1" width="780" id="table6" cellspacing="1" bordercolor="#C0C0C0">
					<tr>
						<td width="271" align="center" bgcolor="#E9E9E9">
						<p style="margin-top: 0; margin-bottom: 0"><b>FECHA</b></td>
						<td align="center" bgcolor="#E9E9E9">
						<p style="margin-top: 0; margin-bottom: 0"><b>HORA DE 
						INICIO</b></td>
						<td width="268" align="center" bgcolor="#E9E9E9">
						<p style="margin-top: 0; margin-bottom: 0"><b></b></td>
					</tr>
					<tr>
						<td width="271" align="left">
						<p style="margin-top: 0; margin-bottom: 0" align="center"><?php echo $filaformu[fecha]?></td>
						<td align="left">
						<p align="center" style="margin-top: 0; margin-bottom: 0"><?php echo $filaformu[hs_i]?></td>
						<td width="268" align="left">
						<p align="center" style="margin-top: 0; margin-bottom: 0"></td>
					</tr>
				</table>
				<p align="center" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
				<div align="center">
				<div align="center">
					<table border="1" width="780" id="table7" cellspacing="1" bordercolor="#C0C0C0">
						<tr>
							<td bgcolor="#E9E9E9">
							<p style="margin-top: 0; margin-bottom: 0" align="center">
							<b>OBJETIVOS</b></td>
						</tr>
						<tr>
							<td>
							<p style="margin-top: 0; margin-bottom: 0"><br><?php echo utf8_encode($filaformu[objetivo]);?><p style="margin-top: 0; margin-bottom: 0"><br></td>
						</tr>
					</table>
					<p style="margin-top: 0; margin-bottom: 0">&nbsp;</div>
			</div>
			<div align="center">
				<table border="1" width="780" id="table8" cellspacing="1" bordercolor="#E9E9E9">
					<tr>
						<td colspan="8" bgcolor="#E9E9E9">
						<p align="center" style="margin-top: 0; margin-bottom: 0">
						<b>SELECCIONAR PERSONAL A AFECTAR</b></td>
					</tr>
					<tr>
							<td align="center" width="43" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Ord.</b></td>
						<td align="center" width="136" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Legajo</b></td>
						<td align="center" width="218" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Apellido y 
						Nombre</b></td>
						<td align="center" width="176" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Tarea en el Área</b></td>
				
					
						<td align="center" width="175" bgcolor="#EEEEEE">
						<b>Sector</b></td>
						<td align="center" width="175" bgcolor="#EEEEEE">
						<b>Hs Cons. (<?echo $mez?>)</b></td>
						<td align="center" width="175" bgcolor="#EEEEEE">
						<b>Mód. Cons.(<?echo $mez?>)</b></td>
						<td align="center" width="175" bgcolor="#EEEEEE">
						<b>Afectar</b></td>
				
					
					</tr>
					<?php 
					$ord=0;
						while ($filaafec = mysql_fetch_array($resultafect))
						{
					$resultsect = mysql_query ("SELECT * FROM sector WHERE codigo = $filaafec[sector]");
					$filasect = mysql_fetch_array($resultsect);
					$ord=$ord+1;
					$tot_modulos=0;
					$cantidad=0;
					$result33 = mysql_query ("SELECT * FROM afectado WHERE legajo = $filaafec[legajo] and mes='$mmes'");
	
					while ($fila33 = mysql_fetch_array($result33))
						{
					$cantidad=$cantidad+$fila33[hs];
					$tot_modulos=$tot_modulos+$fila33[modulos];	
					
					}
						?> 
					<tr>
						<td align="center" width="43">
						<p style="margin-top: 0; margin-bottom: 0"><?php echo $ord?></td>
						<td align="center" width="136">
						<p style="margin-top: 0; margin-bottom: 0"><?php echo $filaafec[legajo]?></td>
						<td align="center" width="218">
						<p style="margin-top: 0; margin-bottom: 0"><?php echo utf8_encode($filaafec[apellido]);?>&nbsp;<?php echo utf8_encode($filaafec[nombre]);?></td>
						<td align="center" width="176">
						<p style="margin-top: 0; margin-bottom: 0"><?php echo $filaafec[tarea]?></td>
					
						<td align="center" width="176">
						<p style="margin-top: 0; margin-bottom: 0"><?php echo $filasect[descripcion];?></td>
						<td align="center" width="176">
						<p style="margin-top: 0; margin-bottom: 0"><?php echo $cantidad?></td>
						<td align="center" width="176">
						<p style="margin-top: 0; margin-bottom: 0"><?php echo $tot_modulos?></td>
						<td align="center" width="176">
						<p style="margin-top: 0; margin-bottom: 0">
						<input name="afectado[]" type="checkbox" value="<?php echo $filaafec['legajo']?>"> 
						
						
					
			
					</td>
					
					
					</tr>
					<?php 
						
					}
						?> 
						
						

					<tr>
						<td align="center" width="752" colspan="5">
						<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</td>
					</tr>
				</table>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
				<table border="0" width="100%" id="table10" cellspacing="0" cellpadding="0">
					<tr>
						<td>
						<p align="center">&nbsp;<input type="submit" value="Afectar" name="submitx"></td>
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
	</table>
	</form>
</div>
</body>
<?
}
else
{




	$horas=0;
	$modulos=0;
	$formulario=$form;
	$mes=$filaformu[mes];


foreach ($_POST["afectado"] as $afectado)
	{
		if (mysql_query ("INSERT INTO afectado VALUES ($formulario,'$afectado','$horas','$modulos','$mes')"))
		{	
				
		}
	}
				?>
				<script>
				var answer=alert("Personal Afectado Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
				
}

?></html><? } ?>
