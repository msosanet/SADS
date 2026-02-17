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
$dni=$_GET["actor"];
$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 
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


<form method="GET" action="ver_ina3.php?actor=<?php echo $dni?>">

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
					<p class="titles1">Filtrar por Fecha - Docente: <? echo $filadocente['apellido'] . ", " . $filadocente['nombre'] . " - D.N.I. Nº " . number_format($filadocente['dni'],0, '.', '.'); ?></p>

					<p align="center">&nbsp;</p>
					
					<div align="center">


					<table border="0" cellspacing="4"><!-- +++ FORMULARIO CON UN RENGLON ++++ -->
						<tr>
							
							

							<td width="250" bgcolor="#dddddd" align="center"><font color="<?echo $color;?>">Fecha Desde: </font>
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
						<td width="250" bgcolor="#dddddd" align="center"><font color="<?echo $color;?>">Fecha Hasta: </font>
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

						

							
							<td align="center" width="100">
							<input type="submit" value="   Filtrar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" />
       </td>
						</tr>

<input name="dni" type="hidden" value ="<?php echo $dni ?>"/>
<input name="actor" type="hidden" value ="<?php echo $dni ?>"/>
					</table>
					</div>
					<!-- p align="center">&nbsp;</p -->
</font>
<p>PUNTO DE PRUEBA</p><!-- ************************************************ P U N T O    D E     P R U E B A ********************-->
<?
		if (isset($_GET['muestra2']))
{ 
	//$fecha_desde=$_GET["fecha_desde"];
	//$fecha_hasta=$_GET["fecha_hasta"];
	$dni=$_GET["dni"];
	//$_pagi_sql="SELECT * FROM ausentes WHERE fecha_desde >='$fecha_desde' and fecha_hasta <= '$fecha_hasta' and docente='$dni' order by fecha_desde";
    //$_pagi_cuantos=50;
    //$_pagi_conteo_alternativo = true;
    //$_pagi_nav_num_enlaces=10;

    $aus_docente_todas = "SELECT * FROM ausentes WHERE docente = '$dni'";


    $fechahoy = date('d-m-Y');

//include("paginator.inc.php");
?>
<!-- p align="left"><?
//echo"$_pagi_navegacion";
?>
<!-- br><br>
</p>
<!-- ++++++++++++++++++++++++++++++++ INICIO DIVISION PARA TABLA DE LICENCIAS ++++++++ -->
<div align="center">
<p class="titles2">LICENCIAS VIGENTES A LA FECHA <? echo $fechahoy; ?></p><br>
<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr bgcolor="#cccccc" height="36" align="center">
						 	<td width="60"><b>FECHA</b></td>
							 <td width="250"><b>MOTIVO</b></td>
							 <td width="250"><b>OBSERVACIONES</b></td>
							 <td width="60"><b>NOTIFICÓ</b></td>
							 <td width="40"><b>JUSTIF.</b></td>
      </tr>

		<?php while ($aus_novedad = mysql_fetch_array($aus_docente_todas))
		{
			$datos_docente = mysql_query ("SELECT * FROM docentes WHERE dni = '$aus_novedad[docente]' ");
			$filaobs = mysql_fetch_array($datos_docente);

			if ($fila2[identificacion]==2)
			{
				$resultmot = mysql_query ("SELECT * FROM motivos2 WHERE codigo = '$fila2[motivo]' ");
			}
			else
			{
				$resultmot = mysql_query ("SELECT * FROM motivos WHERE codigo = '$fila2[motivo]' ");
			}

			$filamot = mysql_fetch_array($resultmot);
			if ($fila2[mostrar]==0){ $observa=$fila2[observaciones]; }
			else {  $observa="";}
if ($fila2[justificada]==1){ $justi="si"; }
			else {  $justi="No";}
$result3 = mysql_query ("SELECT * FROM partediario WHERE docente = '$fila2[docente]' and fecha = '$fila2[fecha_desde]' ");
			$fila3 = mysql_fetch_array($result3);
$result4 = mysql_query ("SELECT * FROM motivos WHERE codigo = '$fila3[falta]' ");
			$fila4 = mysql_fetch_array($result4);


		?>

						<tr bgcolor="eeeeee" align="center">
							<td><?echo $fila2[fecha_desde];?></td>
							<td><?echo $filamot[descripcion];?></td>
							<td><?echo $observa;?></td>
							<td><?echo $fila2[notifico];?></td>
							<td><?echo $justi;?></td>
						</tr>
						<?
						}
						?>
						</table>
</div>

<?
} else {
    echo "ALGO ANDA MAL";
}
?>
<!-- ++++++++++++++++++++++++++++++++++++++++ FIN TABLA LICENCIAS +++++++++++++++ -->

<?
		if (isset($_GET['muestra2']))
{
	$fecha_desde=$_GET["fecha_desde"];
	$fecha_hasta=$_GET["fecha_hasta"];
	$dni=$_GET["dni"];
	$_pagi_sql="SELECT * FROM ausentes WHERE fecha_desde >='$fecha_desde' and fecha_hasta <= '$fecha_hasta' and docente='$dni' order by fecha_desde";
    $_pagi_cuantos=50;
    $_pagi_conteo_alternativo = true;
    $_pagi_nav_num_enlaces=10;
include("paginator.inc.php");
?>
<p align="left"><?
echo"$_pagi_navegacion";
?>
<br><br>
</p>

<!-- ++++++++++++++++++++++++++++++++ INICIO DIVISION PARA TABLA DE INASISTENCIAS ++++++++ -->
<div align="center">
<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="8" height="40" align="left">
							&nbsp;Resultado del Filtro</td>
						</tr>
						<tr bgcolor="#cccccc" height="36" align="center">
						 	<td width="60">Fecha</td>
							 <td width="250">Motivo</td>
							 <td width="250">Observaciones</td>
							 <td width="60">Notific&oacute;</td>
							 <td width="40">Justif.</td>
							 <td width="60">Parte</td>
							 <td width="60">curso/div/tur</td>
							 <td width="60">Oblig.</td>
      </tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
			$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila2[docente]' ");
			$filaobs = mysql_fetch_array($resultobs);

			if ($fila2[identificacion]==2)
			{
				$resultmot = mysql_query ("SELECT * FROM motivos2 WHERE codigo = '$fila2[motivo]' ");
			}
			else
			{
				$resultmot = mysql_query ("SELECT * FROM motivos WHERE codigo = '$fila2[motivo]' ");
			}

			$filamot = mysql_fetch_array($resultmot);
			if ($fila2[mostrar]==0){ $observa=$fila2[observaciones]; }
			else {  $observa="";}
if ($fila2[justificada]==1){ $justi="si"; }
			else {  $justi="No";}
$result3 = mysql_query ("SELECT * FROM partediario WHERE docente = '$fila2[docente]' and fecha = '$fila2[fecha_desde]' ");
			$fila3 = mysql_fetch_array($result3);
$result4 = mysql_query ("SELECT * FROM motivos WHERE codigo = '$fila3[falta]' ");
			$fila4 = mysql_fetch_array($result4);


		?> 

						<tr bgcolor="eeeeee" align="center">
							<td><?echo $fila2[fecha_desde];?></td>
							<td><?echo $filamot[descripcion];?></td>
							<td><?echo $observa;?></td>
							<td><?echo $fila2[notifico];?></td>
							<td><?echo $justi;?></td>
							<td><?echo $fila4[descripcion];?></td>
							<td><?echo $fila3[curso];?>/<?echo $fila3[div];?>/<?echo $fila3[turno];?></td>
       <td><?echo $fila3[obligaciones];?></td>
						</tr>
						<?
						}
						?>
						</table>
</div>

<?
}
?>
<!-- ++++++++++++++++++++++++++++++++++++++++ FIN TABLA INASISTENCIAS +++++++++++++++ -->

					<!-- /p -->
<p align="center">&nbsp;</td>
				</tr>

<!-- ******************************* NOVEDADES EN PARTES DIARIOS **************************** -->
<br><br>
</p><? $resulxx3=mysql_query ("SELECT * FROM partediario WHERE fecha>='$fecha_desde' and docente='$dni' order by fecha");


		?> <table border="1" width="950" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="12" height="40" align="left">
							&nbsp;Resultado del Filtro parte diario</td>
						</tr>
						<tr>
							<td width="200" bgcolor="#808080" align="center" height="36">Docente</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Fecha Desde</td>
							<td bgcolor="#808080" width="200" align="center"  height="36">Motivo</td>
							<td bgcolor="#808080" width="200" align="center"  height="36">Observaciones</td>
							<td bgcolor="#808080" width="80" align="center"  height="36">Notific&oacute;</td>

							

							
						</tr>

		<?php while ($fila22 = mysql_fetch_array($resulxx3))
		{	
			$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila22[docente]' ");
			$filaobs = mysql_fetch_array($resultobs);

		
			$resultmot = mysql_query ("SELECT * FROM motivos WHERE codigo = '$fila22[falta]' ");

			$filamot = mysql_fetch_array($resultmot);




		?> 

						<tr>
							<td bgcolor="#EAEAEA" align="center"><?echo $filaobs[apellido];?>,<?echo $filaobs[nombre];?></td>
							<td bgcolor="#EAEAEA" align="center"><?echo $fila22[fecha];?></td>
							<td bgcolor="#EAEAEA" align="center"><?echo $filamot[descripcion];?></td>
							<td bgcolor="#EAEAEA" align="center"><?echo $fila22[observaciones];?></td>
							<td bgcolor="#EAEAEA" align="center"><?echo $fila22[grabo];?></td>
      </tr>
						<?
						}
						?>
						</table>			

    </table>
</div>
<!-- ******************************* FIN NOVEDADES EN PARTES DIARIOS **************************** -->
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>


<input type="hidden" name="dni" value="<?php echo $dni?>">
</form>
 </td>

</div>

</body>

</html>
<? } ?>

<!-- ++++++++++++++++++++++++++++++++++++++ PAPELERA ++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
     <!-- table border="0" cellspacing="2"><!-- ++++ FORMULARIO CON CONTROLES EN LINEA ++++ >
        <tr>
            <td width="250" bgcolor="#cccccc" align="center"><font color="<!-- ?echo $color;?>">Fecha Desde: </font><input type="text" name="fecha_desde" id="fecha_desde" value="<!-- ?echo $_GET["fecha_desde"]?>" maxlength="10"/><img src="calendario.png" width="16" height="16" border="0" title="Fecha Desde" id="fechas1"></td>
<!-- script que define y configura el calendario-->
    						<!-- script type="text/javascript">
	   					Calendar.setup({
	    					inputField:"fecha_desde",       // id del campo de texto
	    					ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto
						button:"fechas1"             // el id del bot&oacute;n que lanzar&aacute; el calendario
								});
						</script>

            <!-- td width="250" bgcolor="#cccccc" align="center"><font color="<!-- ?echo $color;?>">Fecha Hasta: </font><input type="text" name="fecha_hasta" id="fecha_hasta" value="<!-- ?echo $_GET["fecha_hasta"]?>" maxlength="10"/>
    							<img src="calendario.png" width="16" height="16" border="0" title="Fecha Hasta" id="fechas2">
							</td>
<!-- script que define y configura el calendario-->
    						<!-- script type="text/javascript">
	   					Calendar.setup({
	    					inputField:"fecha_hasta",       // id del campo de texto
	    					ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto
						button:"fechas2"             // el id del bot&oacute;n que lanzar&aacute; el calendario
								});
						</script>

      <td width="120" align="center"><input type="submit" value="   Filtrar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>

       </tr>

<input name="dni" type="hidden" value ="<!-- ?php echo $dni ?>"/>
<input name="actor" type="hidden" value ="<!-- ?php echo $dni ?>"/>

     </table>

<p>&nbsp;</p>
