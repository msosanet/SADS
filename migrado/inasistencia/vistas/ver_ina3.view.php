<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<?PHP if (!isset($_GET['actor'])) { ?>
<script>
	addEventListener("DOMContentLoaded", (event) => {
		document.getElementById('actorSel').value = "";
	});
</script>

<?PHP } ?>

<title>NOVEDADES DOCENTE</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$actor=$_GET["actor"];
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

<div id="marco980">

<?
    if ($_SESSION['valor']==1)
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





    if ($_SESSION['valor']==1)
        {
?>

<!-- ************************** MENU DESLIZABLE ***************************-->
<ul id=menu_slide>
    <li><a href="cargar_ina.php?actor=<? echo $dni; ?>&ident=1">CARGAR INASISTENCIA</a>
    <li><a href="sube2.php?actor=<? echo $dni; ?>&ident=1">CARGAR INASIST JUSTIFICADA</a>
    <li><a href="leg_unif.php?actor=<? echo $dni; ?>&ident=1">VER DATOS DE DOCENTE</a>
</ul>
<!-- ************************** FIN MENU DESLIZABLE ***************************-->

<? } ?>



<!-- ************************ FORMULARIO PARA SELECCIONAR DOCENTE EN FORMA DIRECTA **************-->
<table border="0" width="100%">
    <tr align="right">
        <td class="titulo" align="left">Filtrar por Fecha</td>
        <td>
            <form method="GET" action="<?=$_SERVER["PHP_SELF"]?>" name="form20">
<!-- ************** LISTA DE DOCENTES PARA ELEGIR *********************************** -->

            Otro docente: <select id="actorSel" autofocus="true" style="border: 1px solid #888888; background-color: #ffffff; border-radius: 5px; padding: 4px 0 4px 0; box-shadow: 0 0 2px #555555;" size="1" name="actor" onchange="this.style.backgroundColor='tomato';this.form.submit()">
            <? $listadocentes = mysql_query ("SELECT * FROM docentes WHERE identificacion = 1 ORDER BY apellido,nombre");

            	while ($docente = mysql_fetch_array($listadocentes)) {
				 if($docente['dni']==$actor) $sel = "selected";
				 else $sel = '';
					echo "<option value='" . $docente['dni'] . "'"  . $sel .  ">" . $docente['apellido'] . " " . $docente['nombre'] . " - D.N.I. Nº " . $docente['dni'] . "</option>";
				    }
		    ?>
            </select>
<!-- FIN LISTA DE DOCENTES PARA ELEGIR *********************************************** -->
            <input type="submit" value="Buscar" style="border: 1px solid #C0C0C0;  border-radius: 5px; padding: 4px 10px 4px 10px; background-color: #ffd56b; font-weight:700; font-size: 14px; box-shadow: 0 0 2px #555555;"/>

            <input type="hidden" value=<? echo $docente['dni']; ?>>
            <?
            $dni2 = $docente[dni];
            ?>
            </form>
        </td>
    </tr>
</table>

<form method="GET" action="<?=$_SERVER["PHP_SELF"]?>" name="form10">



<table border="0" width="960">    <!-- ***************** TABLA 1 *****************-->
	<tr>
		<td class="titulo2">Docente: <b><? echo $filadocente['apellido'] . ", " . $filadocente['nombre'] . "</b> - D.N.I. Nº " . number_format($filadocente['dni'],0, '.', '.'); ?>
              <br>

		<div align="center">


		<table border="0" cellspacing="4"><!-- +++ FORMULARIO CON UN RENGLON ++++ -->
			<tr>
				<td width="350" bgcolor="#dddddd" align="center"><font color="<?echo $color;?>">Fecha Desde: </font>
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
			<td width="350" bgcolor="#dddddd" align="center"><font color="<?echo $color;?>">Fecha Hasta: </font>
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

<input name="dni" type="hidden" value ="<? echo $dni; ?>"/>
<input name="actor" type="hidden" value ="<? echo $dni; ?>"/>
					</table>
					</div>
					<!-- p align="center">&nbsp;</p -->
</font>

<?
	if (isset($_GET['muestra2'])) {
    	$fecha_desde=$_GET["fecha_desde"];
    	$fecha_hasta=$_GET["fecha_hasta"];
    	$dni=$_GET["dni"];
    	$_pagi_sql="SELECT * FROM ausentes WHERE fecha_desde >='$fecha_desde' and fecha_hasta <= '

        $fecha_hasta' and docente='$dni' order by fecha_desde DESC";
        $_pagi_cuantos=50;
        $_pagi_conteo_alternativo = true;
        $_pagi_nav_num_enlaces=10;
        include("paginator.inc.php");
?>
<p align="left"><?
echo"$_pagi_navegacion";
?>
<br>
</p>
<!-- ++++++++++++++++++++++++++++++++ INICIO DIVISION PARA TABLA DE INASISTENCIAS ++++++++ -->
<div align="center">
<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="8" height="40" align="left">
							&nbsp;Resultado del Filtro</td>
						</tr>
						<tr bgcolor="#cccccc" height="36" align="center">
						 	<td width="80">Fecha</td>
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

	$invert2 = explode("-",$fila2[fecha_desde]);
	$fecha_invert2 = $invert2[2]."-".$invert2[1]."-".$invert2[0];



		?>

						<tr bgcolor="eeeeee" align="center">
							<td><?echo $fecha_invert2;?></td>
							<td><?echo $filamot['descripcion'];?></td>
							<td><?echo $observa;?></td>
							<td><?echo $fila2['notifico'];?></td>
							<td><?echo $justi;?></td>
							<td><?echo $fila4['descripcion'];?></td>
							<td><?echo $fila3['curso'];?>/<?echo $fila3['div'];?>/<?echo $fila3['turno'];?></td>
       <td><?echo $fila3['obligaciones'];?></td>
						</tr>
						<?
						}
						?>
						</table>
</div>



<!-- ++++++++++++++++++++++++++++++++++++++++ FIN TABLA INASISTENCIAS +++++++++++++++ -->
<?
}
?>


                    </td>
				</tr>





<!-- ****************** MUESTRA AUSENCIAS REGISTRADAS HASTA EL MOMENTO ********************-->

<?
    $fechahoy = date('Y-m-d');
    $fechaDMA = date('d-m-Y');
    $fechaCHK = date('Y-m-d', strtotime('-20 day'));

    $resulxx4=mysql_query ("SELECT * FROM ausentes WHERE fecha_desde >= '$fechaCHK' AND fecha_desde <= '$fechahoy' and docente = '$dni' ORDER BY fecha_desde ASC");?>
    <table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
        <tr>
            <td colspan="5"><p class='titles1'>Ausencias registradas en los últimos 20 días</p></td>
        </tr>
        <tr bgcolor="#cccccc">
			<td width="180" align="center" height="36">Fecha</td>
			<td width="300" align="center"  height="36">Motivo</td>
			<td width="300" align="center"  height="36">Observaciones</td>
			<td width="80" align="center"  height="36">F. notif</td>
			<td width="80" align="center"  height="36">Notific&oacute;</td>
		</tr>

		<? while ($fila23 = mysql_fetch_array($resulxx4))
		{
			$resultobs1 = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila23[docente]' ");
			$filaobs1 = mysql_fetch_array($resultobs);
            $resultmot1 = mysql_query ("SELECT * FROM motivos WHERE codigo = '$fila23[motivo]' ");
            $filamot1 = mysql_fetch_array($resultmot1);
            $desdeDMA = substr($fila23['fecha_desde'], -2, 2) . "-" . substr($fila23['fecha_desde'], 5, 2) . "-" . substr($fila23['fecha_desde'], 0, 4);


        ?>
        <tr>
   			<td align="center"><?echo $desdeDMA;?></td>
			<td align="left"><?echo $filamot1['descripcion'];?></td>
			<td align="left"><?echo $fila23['observaciones'];?></td>
			<td align="center"><?echo $fila23['f_notif'];?></td>
			<td align="center"><?echo $fila23['notifico'];?></td>
      </tr>
<?
		}
?>
	</table>
<!-- ****************** FIN AUSENCIAS REGISTRADAS HASTA EL MOMENTO ********************-->

<br>
<!-- a href="http://inasistencias.colegiosobral.edu.ar/cargar_ina.php?actor=<? //echo $dni; ?>&ident=1">CARGAR INASISTENCIA A <b><? //echo $filadocente['apellido'] . ", " . $filadocente['nombre']; ?></b></a -->

<br><br>
<!-- center -->
<B>HORAS-CÁTEDRA Y CARGOS DEL DOCENTE</B><br><!-- *********** MUESTRA HORAS O CARGOS **************** -->
<?
$db2 = mysql_connect("localhost", "fgoicoechea", "sobral2011");
mysql_select_db("DBF2MYSQL",$db2);

if (strlen($actor) < 8)
{

$rest1 = substr($actor, 0, 1);
$rest2 = substr($actor, 1, 3);
$rest3 = substr($actor, 4, 3);

$dnipuntos=$rest1.".".$rest2.".".$rest3;

$dnipuntos="0".$dnipuntos;

}

else
{

$rest1 = substr($actor, 0, 2);
$rest2 = substr($actor, 2, 3);
$rest3 = substr($actor, 5, 3);

$dnipuntos=$rest1.".".$rest2.".".$rest3;

}

$result77 = mysql_query ("SELECT * FROM movimientos WHERE dni = '$dnipuntos' AND baja = '0000-00-00' order by turno,curso,division",$db2);
?>

<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
						<td align="center" width="300" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>ESPACIO CURRICULAR</b></td>
						<!-- td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Caracter</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Alta</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Baja</b></td -->
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>CURSO / DIV</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>TURNO</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>HORAS</b></td>

					</tr>

		<?php while ($fila77 = mysql_fetch_array($result77))
		{ ?>
					<tr>
						<td align="left">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $fila77['espcur'];?>
						</td>
						<!-- td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? //echo $fila77[caracter];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? //echo $fila77[alta];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? //echo $fila77[baja];
							//if ($fila77[baja]=="0000-00-00") $sumahs=$sumahs+$fila77[hs];
							?>
						<!-- /td -->
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<?

                            if ($fila77[curso] == '') {
                               echo "- - - ";
                               }
                            if ($fila77[curso] == 'A') {
                               echo "A. ";
                               }
                            if ($fila77[curso] == '7') {
                               echo "1º ";
                               }
                            if ($fila77[curso] == '8') {
                               echo "2º ";
                               }
                            if ($fila77[curso] == '9') {
                               echo "3º ";
                               }
                            if ($fila77[curso] == '1') {
                               echo "4º ";
                               }
                            if ($fila77[curso] == '2') {
                               echo "5º ";
                               }
                            if ($fila77[curso] == '3') {
                               echo "6º ";
                               }
                            if ($fila77[curso] == '4') {
                               echo "EdFís 4º ";
                               }
                            if ($fila77[curso] == '5') {
                               echo "EdFís 5º ";
                               }
                            if ($fila77[curso] == '6') {
                               echo "EdFís 6º ";
                               }
                            if ($fila77[division] == 'A') {
                               echo "A.";
                               }
                            if ($fila77[division] == '') {
                               echo '';
                               }
                            if ($fila77[division] !== 'A' AND $fila77[division] !== '') {
                               echo $fila77[division] . "ª";
                               }

                            ?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $fila77[turno]; ?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<?=$fila77['hs'];?>
						</td>

					</tr>
		<?}?>

</table>


<br><br><!-- ***************** FIN TABLA HORAS O CARGOS ************-->

<!-- ****************** MUESTRA NOVEDADES DE PARTE DIARIO REGISTRADAS HASTA EL MOMENTO ********************-->
<?
$resulxx3 = mysql_query ("SELECT * FROM partediario WHERE fecha>='$fecha_desde' and docente='$dni' ORDER BY fecha DESC");
?>
<!-- br>
<table border="1" width="950" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
	<tr>
		<td class="text1b" colspan="12" height="40" align="left">
		&nbsp;Resultado del Filtro parte diario</td>
	</tr>
	<tr>
		<td width="200" bgcolor="#808080" align="center" height="36">Docente</td>
		<td bgcolor="#808080" width="80" align="center" height="36">Fecha Desde</td>
		<td bgcolor="#808080" width="200" align="center"  height="36">Motivo</td>
		<td bgcolor="#808080" width="200" align="center"  height="36">Observaciones</td>
		<td bgcolor="#808080" width="80" align="center"  height="36">Notific&oacute;</td>
	</tr>

<?
while ($fila22 = mysql_fetch_array($resulxx3)) {
	$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila22[docente]' ");
	$filaobs = mysql_fetch_array($resultobs);
	$resultmot = mysql_query ("SELECT * FROM motivos WHERE codigo = '$fila22[falta]' ");
	$filamot = mysql_fetch_array($resultmot);/*
?>

	<!-- tr>
		<td bgcolor="#EAEAEA" align="center"><?echo $filaobs[apellido] . ", " . $filaobs[nombre];?></td>
		<td bgcolor="#EAEAEA" align="center"><?echo $fila22[fecha];?></td>
		<td bgcolor="#EAEAEA" align="center"><?echo $filamot[descripcion];?></td>
		<td bgcolor="#EAEAEA" align="center"><?echo $fila22[observaciones];?></td>
		<td bgcolor="#EAEAEA" align="center"><?echo $fila22[grabo];?></td>
    </tr -->
<?*/
}
?>
<!-- /table -->
<!-- ****************** FIN MUESTRA NOVEDADES DE PARTE DIARIO REGISTRADAS HASTA EL MOMENTO ********************-->

</table>  <!-- ******************************** FIN TABLA 1 ********************************* -->



<br>

</div>


<input type="hidden" name="dni" value="<?php echo $dni?>">
</form>
 </td>

</body>
<?
include 'footer.php';
?>



</html>
<? }

else {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
	} ?>

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

