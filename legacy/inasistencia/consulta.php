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



function operacion_fecha ($fecha,$dias) 
	{  
		list ($dia,$mes,$ano)=explode("-",$fecha);  
		if (!checkdate($mes,$dia,$ano)){return false;}  
		$dia=$dia+$dias;  
		$fecha=date( "d-m-Y", mktime(0,0,0,$mes,$dia,$ano) );  
		return $fecha;  
	}  







function nameDate($fecha='')
//formato: 00/00/0000
{ 	
	$fecha= empty($fecha)?date('d/m/Y'):$fecha;	
	$dias = array('7','1','2','3','4','5','6');	
	$dd   = explode('/',$fecha);	$ts   = mktime(0,0,0,$dd[1],$dd[0],$dd[2]);	
	return $dias[date('w',$ts)];
}


?>

<body background="bgris.gif" >


<form method="GET" action="consulta.php">

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
?>

</p> <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="5" height="40" align="left">
							&nbsp;Resultado del Filtro del <font color="#D08230"><?echo $fecha_invert1?>&nbsp;hasta el&nbsp;<?echo $fecha_invert2?></font></td>
						</tr>
 
						<tr>
							<td width="100" bgcolor="#808080" align="center" height="36">DNI</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Apellido y Nombre</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Fecha</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Observaciones</td>




							
						</tr></font>

		<?php 
			
		$fecha_d=$fecha_desde;
		$semana=1;
		while ($semana < 6)
		{	
				$result7 = mysql_query ("SELECT * FROM feriados WHERE fecha='$fecha_d'");

				if (mysql_num_rows($result7)==0)
		{

			$result = mysql_query ("SELECT distinct dni FROM horarios WHERE  cod_dia=$semana order by dni");


			while ($fila2 = mysql_fetch_array($result))
			{	
				$result8 = mysql_query ("SELECT * FROM ausentes WHERE  docente='$fila2[dni]' and fecha_desde='$fecha_d' ");
				$result3 = mysql_query ("SELECT distinct dni FROM diario WHERE  dia=$semana and dni='$fila2[dni]' and fecha='$fecha_d' order by codigo");
				
				{
				if ((mysql_num_rows($result3)<1) and (mysql_num_rows($result8)<1))
				{
				$result5 = mysql_query ("SELECT distinct dni FROM diario WHERE  dia=$semana and dni='$fila2[dni]' and fecha='$fecha_d' order by codigo");
				$fila5 = mysql_fetch_array($result5);
				$result4 = mysql_query ("SELECT * FROM docentes WHERE  dni='$fila2[dni]'");
				$fila4 = mysql_fetch_array($result4);
				$result6 = mysql_query ("SELECT * FROM ausentes, motivos WHERE  ausentes.docente='$fila2[dni]' and ausentes.fecha_desde='$fecha_d' and motivos.codigo=ausentes.motivo");
				$fila6 = mysql_fetch_array($result6);
				$result33 = mysql_query ("SELECT * FROM docentes WHERE  dni='$fila2[dni]' and  identificacion=1");
				
				if ((mysql_num_rows($result33)>0))	{ 
				?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center">
							<?echo $fila2[dni];?>
							</td>
							<td width="20" bgcolor="#EAEAEA" align="center">
							<?echo $fila4[apellido];?>,<?echo $fila4[nombre];?>
							</td>
							<td width="20" bgcolor="#EAEAEA" align="center">
							<b><?echo $fecha_d;?></b>
							</td>
							<td width="20" bgcolor="#EAEAEA" align="center">
							<b><?echo $fila6[descripcion];?></b>
							</td>


						</tr>
				<?} 		  
				}}
			} }

				$semana=$semana+1;


				$invert = explode("-",$fecha_d); 
				$fecha_d = $invert[2]."-".$invert[1]."-".$invert[0]; 
				$fecha_d=operacion_fecha($fecha_d,1);
				$invert2 = explode("-",$fecha_d); 
				$fecha_d = $invert2[2]."-".$invert2[1]."-".$invert2[0]; 

 
	}?>			


			</table>
			
<?}


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