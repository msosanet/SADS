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
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;


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


<form method="GET" action="ver_piza.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Filtrar por Semana. Seleccione solo una semana completa de Lunes a Viernes </p>
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




	$_pagi_sql="SELECT * FROM ausentes WHERE fecha_desde >='$fecha_desde' and fecha_hasta <= '$fecha_hasta' and motivo != 24 order by codigo";



$_pagi_cuantos=500;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

		?> <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="5" height="40" align="left">
							&nbsp;Resultado del Filtro del <font color="#D08230"><?echo $fecha_invert1?>&nbsp;hasta el&nbsp;<?echo $fecha_invert2?></font></td>
						</tr>
						<tr>
							<td width="100" bgcolor="#808080" align="center" height="36">LUNES</td>
							<td bgcolor="#808080" width="100" align="center" height="36">MARTES</td>
							<td bgcolor="#808080" width="100" align="center" height="36">MIERCOLES</td>
							<td bgcolor="#808080" width="100" align="center"  height="36">JUEVES</td>
							<td bgcolor="#808080" width="100" align="center"  height="36">VIERNES</td>


							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
			$anula=0;
			$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila2[docente]' ");
			$filaobs = mysql_fetch_array($resultobs);
			$result44 = mysql_query ("SELECT * FROM ausentes WHERE docente = '$fila2[docente]' and fecha_desde='$fila2[fecha_desde]' and motivo=24 ");
			if (mysql_num_rows($result44)>0){ $anula=1; }


			
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center">
								<? if (date("w", strtotime($fila2[fecha_desde]))==1) 
									{
									?><b>	<?if ($filaobs[dni]=="00000000"){ echo $fila2[observaciones]; }
										 else { echo $filaobs[apellido];?>,<?echo $filaobs[nombre]; ?></b><br><?echo $fila2[observaciones]; }?>
										<b> <?if ($fila2[motivo]==23){ ?><font color="#0099FF"> (Tarde)</font> <?}?></b>
										<b> <?if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
									<?}?>
							</td>
							<td width="20" bgcolor="#EAEAEA" align="center">
								<? if (date("w", strtotime($fila2[fecha_desde]))==2) 
									{
									?><b>	<?if ($filaobs[dni]=="00000000"){ echo $fila2[observaciones]; }
										 else { echo $filaobs[apellido];?>,<?echo $filaobs[nombre]; ?></b><br><?echo $fila2[observaciones]; }?>
										<b> <?if ($fila2[motivo]==23){ ?><font color="#0099FF"> (Tarde)</font> <?}?></b>
										<b> <?if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
									<?}?>
							</td>							
							<td width="20" bgcolor="#EAEAEA" align="center">
								<? if (date("w", strtotime($fila2[fecha_desde]))==3) 
									{
									?><b>	<?if ($filaobs[dni]=="00000000"){ echo $fila2[observaciones]; }
										 else { echo $filaobs[apellido];?>,<?echo $filaobs[nombre]; ?></b><br><?echo $fila2[observaciones]; }?>
										<b> <?if ($fila2[motivo]==23){ ?><font color="#0099FF"> (Tarde)</font> <?}?></b>
										<b> <?if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
									<?}?>
							</td>							
							<td width="20" bgcolor="#EAEAEA" align="center">
								<? if (date("w", strtotime($fila2[fecha_desde]))==4) 
									{
									?><b>	<?if ($filaobs[dni]=="00000000"){ echo $fila2[observaciones]; }
										 else { echo $filaobs[apellido];?>,<?echo $filaobs[nombre]; ?></b><br><?echo $fila2[observaciones]; }?>
										<b> <?if ($fila2[motivo]==23){ ?><font color="#0099FF"> (Tarde)</font> <?}?></b>
										<b> <?if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
									<?}?>
							</td>							
							<td width="20" bgcolor="#EAEAEA" align="center">
								<? if (date("w", strtotime($fila2[fecha_desde]))==5) 
									{
									?><b>	<?if ($filaobs[dni]=="00000000"){ echo $fila2[observaciones]; }
										 else { echo $filaobs[apellido];?>,<?echo $filaobs[nombre]; ?></b><br><?echo $fila2[observaciones]; }?>
										<b> <?if ($fila2[motivo]==23){ ?><font color="#0099FF"> (Tarde)</font> <?}?></b>
										<b> <?if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
									<?}?>
							</td>
						</tr>
						<?
						}
						?>
						</table><?
}
	?>					
					</p>
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