<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>DOCENTES AUSENTES</title>
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

<body>

<form method="GET" action="ver_piza_modificado.php">

<div align="center">
  <table border="0" width="970" BGCOLOR="#FFFFFF">
    <tr>
      <td><div align="center">
        <table border="0" width="950"> <!-- ++++++++ BARRA DE MENUS +++++++++++ -->
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
<!-- ++++++++++++++++++++++++++++++++++++++++ FIN BARRA DE MENUS +++++++++++++ -->
     		<tr>
			    <td>
					<p align="left" class="titles1">Filtrar por Semana. Seleccione solo una semana completa de Lunes a Viernes </p>

				    <p>&nbsp;</p>
			
				    <div align="left">

            		    <table border="0" CELLSPACING="4"> <!-- +++++++++++++++++ FORMULARIO FECHAS +++++++++++++++++ -->
							<tr height="35">
                    			<td width="250" align="center" bgcolor="#EAEAEA">Fecha Desde: <input type="text" name="fecha_desde" id="fecha_desde" value="<?echo $_GET["fecha_desde"]?>" maxlength="10"/>
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

								<td width="250" align="center" bgcolor="#EAEAEA">Fecha Hasta: <input type="text" name="fecha_hasta" id="fecha_hasta" value="<?echo $_GET["fecha_hasta"]?>" maxlength="10"/>
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
      	             			<td width="100" align="center">
			                		<input type="submit" value="   Filtrar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" />
                    			</td>
                			</tr>
						</table> <!-- ++++++++++++++++++++++++++ FIN FORMULARIO FECHAS +++++++++++++++++++ -->
           			</div>
					<p align="left">

<?
if (isset($_GET['muestra2']))
{
	$fecha_desde=$_GET["fecha_desde"];
	$fecha_hasta=$_GET["fecha_hasta"];

	$fecha = $fecha_desde;
	$invert = explode("-",$fecha); 
	$fecha_invert1 = $invert[2]."-".$invert[1]."-".$invert[0]; 
	
	$fecha2 = $fecha_hasta;
	$invert2 = explode("-",$fecha2); 
	$fecha_invert2 = $invert2[2]."-".$invert2[1]."-".$invert2[0];

	$_pagi_sql="SELECT * FROM ausentes WHERE fecha_desde >='$fecha_desde' and fecha_hasta <= '$fecha_hasta' and identificacion=1 and motivo!=32 and motivo!=34 and veo=0 ORDER BY codigo";

	$_pagi_cuantos=500;
	$_pagi_conteo_alternativo = true;
	$_pagi_nav_num_enlaces=10;
	include("paginator.inc.php");
?>
					</p>
					<p align="left" class="titles1"><font color="#cc0000"><br>Para consultas m&aacute;s exactas, presionar la tecla F5 para refrescar la pantalla.<br>Cualquier duda, ver informaci&oacute;n espec&iacute;fica en -> Consultas / Especifico por fecha y docente
					</font></p>

					<br><br>
<!-- ++++++++++++++++++++++++++ DIVISIONES PARA CADA DIA DE LA SEMANA ++++++++++++++++++++++++ -->
<div id="marco980" align="center">
<div id="ausentes_lunes"> <!-- ++++++++++++++++++ MARCO AUSENTES LUNES ++++++++++++++++ -->

<p class="titulo">LUNES</p>
<div id="ausentes_box">

<?php while ($fila2 = mysql_fetch_array($_pagi_result))
	{
		$anula=0;
		$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila2[docente]' ");
		$filaobs = mysql_fetch_array($resultobs);
		$result44 = mysql_query ("SELECT * FROM ausentes WHERE docente = '$fila2[docente]' and fecha_desde='$fila2[fecha_desde]' and motivo=27 ");
	if (mysql_num_rows($result44)>0){ $anula=1; }
		if ($fila2[mostrar]==0){ $observa= substr($fila2[observaciones], 0, 20); }
		else {  $observa="";}
?>

			<? if (date("w", strtotime($fila2[fecha_desde]))==1)
			{
			?>
			<b>
			<?
			if ($filaobs[dni]=="00000000"){ echo $observa; }
			else { echo $filaobs[apellido] . ", " . substr($filaobs[nombre], 0, 10); ?></b><br>
			<? echo $observa . "<hr>"; } ?>
			<b>
			<? if ($fila2[motivo]==16){ ?><font color="#0099FF"> (Llega tarde)</font> <?} ?>
			</b>
			<b>
			<?  if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
			<? }
}
?>

</div>
</div> <!-- ++++++++++++++++++++++++++++++++ FIN MARCO AUSENTES LUNES ++++++++++++++++ -->

<div id="ausentes_mart_vie"> <!-- ++++++++++++++++++ MARCO AUSENTES MARTES ++++++++++++++++ -->

<p class="titulo">MARTES</p>
<div id="ausentes_box">

<?php while ($fila2 = mysql_fetch_array($_pagi_result))
	{
		$anula=0;
		$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila2[docente]' ");
		$filaobs = mysql_fetch_array($resultobs);
		$result44 = mysql_query ("SELECT * FROM ausentes WHERE docente = '$fila2[docente]' and fecha_desde='$fila2[fecha_desde]' and motivo=27 ");
	if (mysql_num_rows($result44)>0){ $anula=1; }
		if ($fila2[mostrar]==0){ $observa=$fila2[observaciones]; }
		else {  $observa="";}
?>

			<? if (date("w", strtotime($fila2[fecha_desde]))==2)
			{
			?>
			<b>
			<?
			if ($filaobs[dni]=="00000000"){ echo $observa; }
			else { echo $filaobs[apellido] . ", " . $filaobs[nombre]; ?></b><br>
			<? echo $observa . "<hr>"; } ?>
			<b>
			<? if ($fila2[motivo]==16){ ?><font color="#0099FF"> (Llega tarde)</font> <?} ?>
			</b>
			<b>
			<?  if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
			<? }
}
?>
</div>

</div> <!-- ++++++++++++++++++++++++++++++++++ FIN MARCO AUSENTES MARTES ++++++++++++++++ -->

<div id="ausentes_mart_vie"> <!-- ++++++++++++++++++ MARCO AUSENTES MIERCOLES ++++++++++++++++ -->

<p class="titulo">MIERCOLES</p>
<div id="ausentes_box">

<?php while ($fila2 = mysql_fetch_array($_pagi_result))
	{
		$anula=0;
		$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila2[docente]' ");
		$filaobs = mysql_fetch_array($resultobs);
		$result44 = mysql_query ("SELECT * FROM ausentes WHERE docente = '$fila2[docente]' and fecha_desde='$fila2[fecha_desde]' and motivo=27 ");
	if (mysql_num_rows($result44)>0){ $anula=1; }
		if ($fila2[mostrar]==0){ $observa=$fila2[observaciones]; }
		else {  $observa="";}
?>

			<? if (date("w", strtotime($fila2[fecha_desde]))==3)
			{
			?>
			<b>
			<?
			if ($filaobs[dni]=="00000000"){ echo $observa; }
			else { echo $filaobs[apellido] . ", " . $filaobs[nombre]; ?></b><br>
			<? echo $observa . "<hr>"; } ?>
			<b>
			<? if ($fila2[motivo]==16){ ?><font color="#0099FF"> (Llega tarde)</font> <?} ?>
			</b>
			<b>
			<?  if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
			<? }
}
?>
</div>

</div> <!-- ++++++++++++++++++++++++++++++++++ FIN MARCO AUSENTES MIERCOLES ++++++++++++++++ -->

</div>
<!-- +++++++++++++++++++++++++++++ FIN DIVISIONES PARA CADA DIA DE LA SEMANA +++++++++++++++++ -->

					<div align="center">
						<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
							<tr>
								<td class="text1b" colspan="5" height="30" align="left">&nbsp;Resultado del Filtro del <font color="#D08230"><?echo $fecha_invert1?>&nbsp;hasta el&nbsp;<?echo $fecha_invert2?></font></td> <!-- +++++ PRESENTA FECHAS EN FORMATO DD-MM-AAAA ++++ -->
							</tr>
							<tr height ="36" bgcolor="#CCCCCC" class="titles2"> <!-- +++++++++++++++++ ENCABEZADOS DE TABLA +++++ -->
								<td width="110" align="center">LUNES</td>
								<td width="110" align="center">MARTES</td>
								<td width="110" align="center">MIERCOLES</td>
								<td width="110" align="center">JUEVES</td>
								<td width="110" align="center">VIERNES</td>
							</tr> <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ FIN ENCABEZADOS DE TABLA +++++ -->

<?php while ($fila2 = mysql_fetch_array($_pagi_result))
	{	
		$anula=0;
		$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila2[docente]' ");
		$filaobs = mysql_fetch_array($resultobs);
		$result44 = mysql_query ("SELECT * FROM ausentes WHERE docente = '$fila2[docente]' and fecha_desde='$fila2[fecha_desde]' and motivo=27 ");
	if (mysql_num_rows($result44)>0){ $anula=1; }
		if ($fila2[mostrar]==0){ $observa=$fila2[observaciones]; }
		else {  $observa="";}		
?> 

	<tr bgcolor="#EEEEEE">
		<td align="center"><!--   +++++++++++++++++++++++++++++++++++++++++++++ LUNES ++++++++++++ -->
			<? if (date("w", strtotime($fila2[fecha_desde]))==1)
			{
			?>
			<b>	
			<?
			if ($filaobs[dni]=="00000000"){ echo $observa; }
			else { echo $filaobs[apellido] . ", " . $filaobs[nombre]; ?></b><br>
			<? echo $observa; } ?>
			<b> 
			<? if ($fila2[motivo]==16){ ?><font color="#0099FF"> (Tarde)</font> <?} ?>
			</b>
			<b> 
			<?  if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
			<? } ?>
		</td>
		<td> <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ MARTES ++++++++++++ -->
			<? if (date("w", strtotime($fila2[fecha_desde]))==2)
				{
			?>
			<b>	
			<? if ($filaobs[dni]=="00000000"){ echo $observa; }
				else { echo $filaobs[apellido] . ", " . $filaobs[nombre]; ?></b><br><?echo substr($observa, 0, 25); }?>
			<b> 
			<? if ($fila2[motivo]==16){ ?><font color="#0099FF"> (Tarde)</font> <?}?></b>
			<b>
			<? if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
			<? } ?>
		</td>							
		<td bgcolor="#EAEAEA" align="center"> <!-- ++++++++++++++++++++++++++ MIERCOLES ++++++ -->
			<? if (date("w", strtotime($fila2[fecha_desde]))==3)
				{
			?>
			<b>	
			<? if ($filaobs[dni]=="00000000"){ echo $observa; }
			 else { echo $filaobs[apellido];?>,<?echo $filaobs[nombre]; ?></b><br><?echo $observa; }?>
			<b> 
			<? if ($fila2[motivo]==16){ ?><font color="#0099FF"> (Tarde)</font> <?}?></b>
			<b> 
			<? if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
			<? } ?>
		</td>							
		<td width="20" bgcolor="#EAEAEA" align="center"> <!-- ++++++++++++++++ JUEVES ++++++++ -->
			<? if (date("w", strtotime($fila2[fecha_desde]))==4)
				{
			?>
			<b>	
			<? if ($filaobs[dni]=="00000000"){ echo $observa; }
			 else { echo $filaobs[apellido];?>,<?echo $filaobs[nombre]; ?></b><br><?echo $observa; }?>
			<b> 
			<? if ($fila2[motivo]==16){ ?><font color="#0099FF"> (Tarde)</font> <?}?></b>
			<b> 
			<? 
			if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
			<? } ?>
		</td>							
		<td bgcolor="#EAEAEA" align="center"><!-- ++++++++++++++++++++++++++ VIERNES +++++++++++++ -->
			<? if (date("w", strtotime($fila2[fecha_desde]))==5)
				{
			?>
			<b>
			<? if ($filaobs[dni]=="00000000"){ echo $observa; }
			  else { echo $filaobs[apellido];?>,<?echo $filaobs[nombre]; ?></b><br><?echo $observa; }?>
			<b>
			<? if ($fila2[motivo]==16){ ?><font color="#0099FF"> (Tarde)</font> <?}?></b>
			<b>
			<? if ($anula==1){ ?><font color="#ff0000"> (Anula)</font> <?}?></b>
			<? } ?>
		</td>
	</tr>
	<? } ?>
</table>
</div>
<? } ?>					
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
</body>
</html>
<? } ?>
