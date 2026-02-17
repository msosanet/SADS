<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<link rel="shortcut icon" href="../imag/favicon.ico">
<title></title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$actor=$_GET["actor"];

$resultt = mysql_query ("SELECT * FROM docentes WHERE dni = '$actor' ");
$filatt = mysql_fetch_array($resultt);




//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un guión.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}

    function calcularFecha($dias){
     
    $calculo = strtotime("$dias days");
    return date("Y-m-d", $calculo);
    }



?>
<body background="bgris.gif" >
<form method="GET" action="ver_hs_aux22.php?actor=<?php echo $actor?>">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Filtro por Fecha de:&nbsp;<font color="ff0000"><? echo $filatt[apellido] . ", " . $filatt[nombre]; ?></font>
 </p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="100%">
						<tr>
							
							

							<td width="150" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha Desde:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="fecha_desde" id="fecha_desde" value="<?echo $_GET["fecha_desde"]?>" maxlength="10"/>
    							<img src="calendario.png" width="16" height="16" border="0" title="Fecha Desde" id="fechas1">
							</td>
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"fecha_desde",       // id del campo de texto 
	    					ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
						button:"fechas1"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>
						<td width="150" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha Hasta:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="fecha_hasta" id="fecha_hasta" value="<?echo $_GET["fecha_hasta"]?>" maxlength="10"/>
    							<img src="calendario.png" width="16" height="16" border="0" title="Fecha Hasta" id="fechas2">
							</td>
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"fecha_hasta",       // id del campo de texto 
	    					ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
						button:"fechas2"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>

						

							
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						
						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Filtrar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
<input name="actor" type="hidden" value ="<?php echo $actor ?>"/>
					</table>
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
</font>
					<?
				if (isset($_GET['muestra2']))
{ 
	$fecha_desde=$_GET["fecha_desde"];
	$fecha_hasta=$_GET["fecha_hasta"];

	$fecha_desde=$_GET["fecha_desde"];
	$fecha_hasta=$_GET["fecha_hasta"];

	$fecha = $fecha_desde;
	$invert = explode("-",$fecha); 
	$fecha_invert1 = $invert[2]."-".$invert[1]."-".$invert[0]; 
	
	$fecha2 = $fecha_hasta;
	$invert2 = explode("-",$fecha2); 
	$fecha_invert2 = $invert2[2]."-".$invert2[1]."-".$invert2[0];


$resu = mysql_query ("SELECT * FROM diario WHERE dni = '$actor' and fecha >='$fecha' and fecha <= '$fecha2' order by fecha,horario" );




//$_pagi_cuantos=1000;
//$_pagi_conteo_alternativo = true;
//$_pagi_nav_num_enlaces=10;
//include("paginator.inc.php"); 



$result77 = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' order by cod_dia");





?>

<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="5" height="40" align="left">
							<center>Horario Declarado por &nbsp;<?echo $filatt[apellido] ?>,&nbsp;<?echo $filatt[nombre] ?>
							</td>
						</tr>
						<tr>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Lunes</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Martes</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Miércoles</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Jueves</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Viernes</b></td>

					</tr>

		<?php while ($fila77 = mysql_fetch_array($result77))
		{ ?>
					<tr>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? if ($fila77[cod_dia] ==1) 
							{ echo $fila77[hs_entrada];?>&nbsp;a&nbsp;<?php echo $fila77[hs_salida]; }?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? if ($fila77[cod_dia] ==2) 
							{ echo $fila77[hs_entrada]?>&nbsp;a&nbsp;<?php echo $fila77[hs_salida]; }?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? if ($fila77[cod_dia] ==3) 
							{ echo $fila77[hs_entrada]?>&nbsp;a&nbsp;<?php echo $fila77[hs_salida]; }?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? if ($fila77[cod_dia] ==4) 
							{ echo $fila77[hs_entrada]?>&nbsp;a&nbsp;<?php echo $fila77[hs_salida]; }?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">
						
							<? if ($fila77[cod_dia] ==5) 
							{ echo $fila77[hs_entrada]?>&nbsp;a&nbsp;<?php echo $fila77[hs_salida]; }?>
						</td>

	
	
					</tr>
		<?}?>

</table>

<br>

<p align="left"><?
//echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

		?> 

<div align="center">
            	<table align="center" border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b" colspan="4" height="40" align="left">
							Resultado del Filtro del <font color="#D08230"><? echo $fecha_invert1 . " al " . $fecha_invert2; ?><br>Docente:&nbsp;<? echo $filatt[apellido] . ", " . $filatt[nombre]; ?></font></td>
						</tr>
						<tr bgcolor="#dddddd">
						  <td align="center" width="100">
						      <b>DIA</b></td>
						  <td align="center" width="100">
						      <b>FECHA</b></td>
						  <td align="center" width="100">
						      <b>TIPO</b></td>
						  <td align="center" width="100">
						      <b>HORARIO</b></td>
					    </tr>

		<?php 
			while ($fila = mysql_fetch_array($resu))
						{
						$fechas=explode("-",$fila[fecha]);
						$fechas=$fechas[2]."-".$fechas[1]."-".$fechas[0];
                        if ($fila[dia] == 1) { $diasem = "Lunes"; }
                        if ($fila[dia] == 2) { $diasem = "Martes"; }
                        if ($fila[dia] == 3) { $diasem = "Miércoles"; }
                        if ($fila[dia] == 4) { $diasem = "Jueves"; }
                        if ($fila[dia] == 5) { $diasem = "Viernes"; }
                        if ($fila[dia] == 6) { $diasem = "Sábado"; }
						?>
					<tr>
						<td align="center">
						  <? echo $diasem; ?></td>
						<td align="center">
						  <? echo $fechas; ?></td>
						<td align="center">
						  <? echo $fila[tipo]; ?></td>
						<td align="center">
						  <? echo $fila[horario]; ?></td>
					</tr>
					<?php 
						}
						?> 
						</table><?
}
	?>					
					</p>
</div>
					<p align="center">&nbsp;</td>
				</tr>


			</table>
			</div>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>



</form>
 </td>

</div>

</body>

</html>
<? } ?>