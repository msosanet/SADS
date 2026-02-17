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




function calcular_tiempo_trasnc($hora1,$hora2){ 
    $separar[1]=explode(':',$hora1); 
    $separar[2]=explode(':',$hora2); 

$total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1]; 
$total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1]; 
$total_minutos_trasncurridos = $total_minutos_trasncurridos[1]-$total_minutos_trasncurridos[2]; 
if($total_minutos_trasncurridos<=59) return($total_minutos_trasncurridos); 
elseif($total_minutos_trasncurridos>59){ 
$HORA_TRANSCURRIDA = round($total_minutos_trasncurridos/60); 
if($HORA_TRANSCURRIDA<=9) $HORA_TRANSCURRIDA='0'.$HORA_TRANSCURRIDA; 
$MINUITOS_TRANSCURRIDOS = $total_minutos_trasncurridos%60; 
if($MINUITOS_TRANSCURRIDOS<=9) $MINUITOS_TRANSCURRIDOS='0'.$MINUITOS_TRANSCURRIDOS; 
return ($HORA_TRANSCURRIDA.':'.$MINUITOS_TRANSCURRIDOS.' Horas'); 

} } 



?>

<body background="bgris.gif" >


<form method="GET" action="tarde.php">

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

						
							<td width="150" bgcolor="#EAEAEA" align="right">Tolerancia en Minutos:</td>
    
							<td bgcolor="#EAEAEA" width="2" align="left">
 							<input type="text" name="tolerancia" id="tolerancia" maxlength="2" size="2"/></td>
					
							
							
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
	$tolerancia=$_GET["tolerancia"]*-1;

	$fecha_desde=$_GET["fecha_desde"];
	$fecha_hasta=$_GET["fecha_hasta"];

	$fecha = $fecha_desde;
	$invert = explode("-",$fecha); 
	$fecha_invert1 = $invert[2]."-".$invert[1]."-".$invert[0]; 
	
	$fecha2 = $fecha_hasta;
	$invert2 = explode("-",$fecha2); 
	$fecha_invert2 = $invert2[2]."-".$invert2[1]."-".$invert2[0];




	$_pagi_sql="SELECT * FROM diario WHERE fecha >='$fecha_desde'  and fecha <= '$fecha_hasta'  and tipo='Entrada' order by fecha,dni";



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
							<td class="text1b"background="../imag/bar07.gif"  colspan="6" height="40" align="left">
							&nbsp;Resultado del Filtro del <font color="#D08230"><?echo $fecha_invert1?>&nbsp;hasta el&nbsp;<?echo $fecha_invert2?></font></td>
						</tr>
						<tr>
							<td width="100" bgcolor="#808080" align="center" height="36">Apellido y Nombre</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Fecha</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Entrada a cumplir</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Entrada real</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Salida a cumplir</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Salida real</td>




							
						</tr>

		<?php 
			while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
			$resta=0;
			$resultobs = mysql_query ("SELECT * FROM horarios WHERE dni = '$fila2[dni]' and cod_dia= $fila2[dia] ");
			$filaobs = mysql_fetch_array($resultobs); 

			$pasa=calcular_tiempo_trasnc($filaobs[hs_entrada],$fila2[horario]); 

			if ($pasa < 0) {

			if ( $pasa < $tolerancia){
			$resta=$filaobs3[horario]-$fila2[horario];
			$resultobs2 = mysql_query ("SELECT apellido, nombre FROM docentes WHERE dni = '$fila2[dni]' ");
			$filaobs2 = mysql_fetch_array($resultobs2);
			$resultobs3 = mysql_query ("SELECT horario FROM diario WHERE dni = '$fila2[dni]' and fecha='$fila2[fecha]' and tipo='Salida' ");
			$filaobs3 = mysql_fetch_array($resultobs3);

					 
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center">
							<?echo $filaobs2[apellido];?>,<?echo $filaobs2[nombre];?>
							</td>
							<td width="20" bgcolor="#EAEAEA" align="center">
							<?echo $fila2[fecha];?>
							</td>
							<td width="20" bgcolor="#EAEAEA" align="center">
							<b><?echo $filaobs[hs_entrada];?></b>
							</td>
							<td width="20" bgcolor="#EAEAEA" align="center">
							<b><?echo $fila2[horario];?></b>
							</td>
							<td width="20" bgcolor="#EAEAEA" align="center">
							<b><?echo $filaobs[hs_salida];?></b>
							</td>
							<td width="20" bgcolor="#EAEAEA" align="center">
							<b><?echo $filaobs3[horario];?></b>
							</td>


						</tr>
						<?}}
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
