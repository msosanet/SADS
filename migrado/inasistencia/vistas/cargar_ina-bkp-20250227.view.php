<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>CARGAR INASIST a <?=$filadocente['apellido']?> <?=$filadocente['nombre']?></title>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>
</head>
<?PHP
include 'header.php';
?>


<body>

<div id="marco980">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>

<br>

<!-- ************************ FORMULARIO PARA SELECCIONAR DOCENTE EN FORMA DIRECTA **************-->
<table border="0" width="100%">
    <tr align="right">
        <td class="titulo" align="left">Cargar inasistencia</td>
        <td>
            <form method="GET" action="cargar_ina.php?actor=<? echo $dni; ?>" name="form20">
<!-- ************** LISTA DE DOCENTES PARA ELEGIR *********************************** -->

            Otro docente: <select style="border: 1px solid #888888; background-color: #ffffff; border-radius: 5px; padding: 4px 0 4px 0; box-shadow: 0 0 2px #555555;" size="1" name="actor" onchange="this.style.backgroundColor = 'red'">
            <option>- - - - - -</option>
            <? $listadocentes = mysql_query ("SELECT * FROM docentes WHERE identificacion = 1 ORDER BY apellido,nombre");

            	while ($docente = mysql_fetch_array($listadocentes)) {
					if (isset($dni)) $_sel = ($dni==$docente['dni']) ? "selected" : "";
					else $_sel = "";
					echo "<option value='" . $docente['dni'] . "' $_sel>" . $docente['apellido'] . " " . $docente['nombre'] . " - D.N.I. Nº " . $docente['dni'] . "</option>";
				    }
		    ?>
            </select>
<!-- FIN LISTA DE DOCENTES PARA ELEGIR *********************************************** -->
          <input type="submit" value="Buscar" style="border: 1px solid #C0C0C0;  border-radius: 5px; padding: 4px 10px 4px 10px; background-color: #ffd56b; font-weight:700; font-size: 14px; box-shadow: 0 0 2px #555555;"/>
           </form>
        </td>
    </tr>
</table>
<!-- ********* FIN FORMULARIO PARA SELECCIONAR DOCENTE EN FORMA DIRECTA **********************-->

<form method="POST" action="cargar_ina.php?actor=<? echo $dni . "&ident=1"; ?>">
<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p>

<div align="left">

					<div align="center">

					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Docente: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. Nº " . number_format($filadocente[dni],0,'','.'); ?></td>
						</tr>

						<tr>



						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Motivo:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">

                          <select size="1" autofocus="true" name="motivo"> <!-- ****************************LISTA MOTIVOS -->
						  <?
                            WHILE ($myrow6 = mysql_fetch_array($resultmotivo)) {
						    	echo "<option value=" . $myrow6[codigo] . ">" . $myrow6[descripcion] . "</option>";
						    }
						  ?>
                          </select> <!-- **********************************************************FIN LISTA MOTIVOS -->

						<!-- select size="1" autofocus name="motivo">
						<?	//WHILE ($myrow6 = mysql_fetch_array($resultmotivo))
						//{
							//if($_POST['motivo']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
							//echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion] </option>";
						//}
						?>
                          </select -->
						</td>
						<?
	  					if ($errorfecha==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>


								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha Desde:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="d" size="2" maxlength="2" value="<?echo $_POST['d']; ?>" />
							-
							<input type="text" name="m" size="2" maxlength="2" value="<?echo $_POST['m']; ?>" />
							-
							<input type="text" name="a" size="4" maxlength="4" value="<?echo $_POST['a']; ?>" />
							(DD-MM-AAAA)</td>

						</tr>
						<tr>

							<td width="174" bgcolor="#EAEAEA" align="right">Observaciones:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><TEXTAREA COLS=35 ROWS=5 NAME="observaciones"></TEXTAREA></td>

						<?
	  					if ($errorfecha2==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>


								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha Hasta:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="d2" size="2" maxlength="2" value="<?echo $_POST['d2']; ?>" />
							-
							<input type="text" name="m2" size="2" maxlength="2" value="<?echo $_POST['m2']; ?>" />
							-
							<input type="text" name="a2" size="4" maxlength="4" value="<?echo $_POST['a2']; ?>" />
							(DD-MM-AAAA)</td>


						</tr>

						<tr>
					<?
	  					if ($errorhora==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Hora:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="hora" size="10" maxlength="10" value="<?echo $_POST['hora'];?>" />(HH:MM:SS)</td>
							</td>



							<td width="190" bgcolor="#EAEAEA" align="right">Notific&oacute;:
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><b><? echo $filausuario['apellido']  ?>&nbsp;<? echo $filausuario['nombre']  ?></b>
							</td>
						</tr>
						<!-- input type="hidden" name="identificacion" id="identificacion" value="<? //echo $identificacion;?>"/ -->

						<tr>
							<td width="876" bgcolor="#EAEAEA" align="right" colspan="4"><font color="red"></font>
						  <?
                         //   WHILE ($myrow6 = mysql_fetch_array($resultplaza)) {
					//if ($myrow6[curso]=="")	echo "<option value=" . $myrow6[id] . ">" . $myrow6[plaza] . " - " . $myrow6[nombre] ."</option>";

						    	//else echo "<option value=" . $myrow6[id] . ">" . $myrow6[plaza] . " - " . $myrow6[nombre] ." - " .$myrow6[curso] . "º " . $myrow6[division] ."º ". "</option>";
						//    }
						  ?>
                          </td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Marque esta casilla si quiere no mostrar las observaciones</b> <input type="checkbox" name="mostrar" value="1"></td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Marque esta casilla si quiere que no salga en pizarra</b> <input type="checkbox" name="pizarra" value="1"></td>
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						</table>
					</div>
<p align="right">&nbsp;</p>

</div>
<?
include 'footer.php';
?>


<input name="dni" type="hidden" value ="<?php echo $dni ?>"/>
<!-- input name="identificacion" type="hidden" value ="<?php //echo $identificacion ?>"/ -->
	</form>
</div>
</body>
<?
}
else
{

	$fecha_desde=$_POST['a']."-".$_POST['m']."-".$_POST['d'];
	$fecha_hasta=$_POST['a2']."-".$_POST['m2']."-".$_POST['d2'];
	$motivo=$_POST['motivo'];
	$hora=$_POST['hora'];
	$observaciones=$_POST['observaciones'];
	$dni=$_POST['dni'];
	$now=date("Y-m-d");
	$graba=$filausuario["nombre"];
	//$identificacion=$_POST['identificacion'];
	$nomostrar=$_POST['mostrar'];
	if ($nomostrar <> 1) $nomostrar=0;
	$nopizarra=$_POST['pizarra'];
	if ($nopizarra <> 1) $nopizarra=0;
	$plaza=$_POST['plaza'];





$cantdias=diasEntreFechas($fecha_desde, $fecha_hasta);
$cuentalic=0;
//CHEQUEO QUE NO TENGA LICENCIA
$chequeolic="SELECT * FROM ausentes WHERE docente='$dni' AND fecha_desde BETWEEN '$fecha_desde' AND '$fecha_hasta' AND motivo='$motivo'";
//echo $chequeolic;
$resultcheck = mysql_query ($chequeolic);
$filacheck = mysql_fetch_array($resultusuario);
$cuentalic = mysql_num_rows($resultcheck);
	if ($cuentalic>0)
	{
	?>
						<script>
						var answer=alert("Ya se encuentra cargada una licencia para este docente, fecha y motivo")
						</script>
						<script language="JavaScript" type="text/javascript">
							setTimeout("window.history.go(-1)",50);
						</script>


	<?
	}
	else
	{
		while ($cantdias > 0){







		if (mysql_query ("INSERT INTO ausentes VALUES (0,'$dni','$fecha_desde','$fecha_desde','$hora','$motivo','$graba','$observaciones','$now',1,0,$nomostrar,$nopizarra,0)"))
			{



			}
						else {
						?>
						<script>
						var answer=alert("No se pudo grabar en la BD")
						</script>
						<meta http-equiv='refresh' content='0; URL=menu.php?'>
						<?
						}
				$cantdias=$cantdias-1;

			  $fechaComparacion = strtotime("$fecha_desde");
			  $calculo= strtotime("1 days", $fechaComparacion);
			  $fecha_desde= date("Y-m-d", $calculo);
						}//FIN WHILE
						?>
						<script>
						var answer=alert("Datos Grabados Correctamente ")
						</script>
						<meta http-equiv='refresh' content='0; URL=cargar_ina.php?actor=<?php echo $dni ?>&ident=1<? //echo $identificacion; ?>'>
						<?

		}
}
		?>
</html>
<? } ?>

