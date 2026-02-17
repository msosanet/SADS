<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';

//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un guión.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}

$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$dni=$_GET['actor'];
$identificacion=$_GET['ident'];


$hora=date("H:i:s");

$resultalumno = mysql_query ("SELECT * FROM alumno where dni=$dni");
$filaalumnos = mysql_fetch_array($resultalumno);

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario);
$alumno=$filaalumnos['apellido'].",".$filaalumnos['nombre'];
//echo "ALUUUUMNOOOOO".$alumno;
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
<title>Novedades <?=$filaalumnos['apellido']?> <?=$filaalumnos['nombre']?></title>

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


$anio=date("Y");


$rr1 = mysql_query ("SELECT * FROM cursa where alumno=$dni and anio='$anio' and control=1");
$rr1 = mysql_fetch_array($rr1);



$errordoc = 0;
  $hayerrores = 0;


  if (!isset($_POST["submitx"])) {
$_POST['d']=date("d");
$_POST['m']=date("m");
$_POST['a']=date("Y");
/* $_POST['d2']=date("d");
$_POST['m2']=date("m");
$_POST['a2']=date("Y");*/
$_POST['hora']=$hora;


}




  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos

	 /*
     if (trim($_POST["d2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
     if (trim($_POST["m2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
     if (trim($_POST["a2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };  */
     if (trim($_POST["hora"]) == '') { $errorhora = 1; $hayerrores = 1; };

}
 else
  {
    $flag = 1;
  }

if ($hayerrores OR $flag) {
?>

<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
<div style="align:center;max-width:980px">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>

			<div align="center">
			<table border="0" width="980">
				<tr>


					<td>

					<p align="left" class="text1b">Cargar Novedad de alumnos</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">

					<div align="center">

<b><? echo $filaalumnos['apellido'];?>, <? echo $filaalumnos['nombre'];?> de  <? echo $rr1['curso'];?> / <? echo $rr1['divi'];?></b>




					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left"></td>
						</tr>


						<tr>

							<td width="174" bgcolor="#EAEAEA" align="right">Novedades:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><TEXTAREA COLS=35 ROWS=5 NAME="novedades"> </TEXTAREA></td>

						<?
	  					if ($errorfecha2==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>


								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="date" name="fecha" value="<?=date('Y-m-d',strtotime('yesterday'))?>" ></td>

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

	<!--					<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Movilidad Estudiantil:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="checkbox" name="movi" value="1"></td>
							</td>



							<td width="190" bgcolor="#EAEAEA" align="right">
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left">
							</td>
						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Pidio pase:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="checkbox" name="pase" value="1"></td>
							</td>



							<td width="190" bgcolor="#EAEAEA" align="right">
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left">
							</td>
						</tr>   -->
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Baja definitiva:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="checkbox" name="seva" value="1"></td>



							<td width="190" bgcolor="#EAEAEA" align="right">
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left">
							</td>
						</tr>



						<input type="hidden" name="identificacion" id="identificacion" value="<? echo $identificacion;?>"/>


						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						</table>
					</div>
					<p align="right">&nbsp;</div>
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
<input name="dni" type="hidden" value ="<?php echo $dni ?>"/>
<input name="identificacion" type="hidden" value ="<?php echo $identificacion ?>"/>
<input name="alumno" type="hidden" value ="<?php echo $alumno ?>"/>

	</form>
</div>
</body>
<?
}
else
{



//	$fecha=$_POST['a2']."-".$_POST['m2']."-".$_POST['d2'];
	$fecha=$_POST['fecha'];
	$hora=$_POST['hora'];
	$novedades=$_POST['novedades'];
	$graba=$filausuario["nombre"];
	$movim=$_POST['movi'];
	if ($movim <> 1) $movim=0;
	$dni=$_POST['dni'];
	$pase=$_POST['pase'];
	$seva=$_POST['seva'];   /*
	$resultalumno2 = mysql_query ("SELECT * FROM alumno where dni=$dni");
	$dos = mysql_fetch_array($resultalumno2);    */

	$anio=date("Y");
	if ($pase <> 1) $pase=0;
	if ($seva <> 1) $seva=0;



	$rr1 = mysql_query ("SELECT * FROM cursa WHERE alumno=$dni AND control=1");
	$rr1 = mysql_fetch_array($rr1);

	$cursi=$rr1["curso"]."/".$rr1["divi"];

//	$alumno=$dos['apellido'].", ".$dos['nombre'];

$qNov = "INSERT INTO novedades VALUES (0,$dni,'','$cursi','$novedades','$fecha','$hora','$graba',1,$movim)";
$qPase = "UPDATE cursa SET pase='$fecha' WHERE curso='$rr1[curso]' AND divi='$rr1[divi]' AND alumno=$dni AND control=1";
$qBaja = "UPDATE cursa SET control=0, pase='$fecha' WHERE curso='$rr1[curso]' AND divi='$rr1[divi]' AND alumno=$dni AND control=1";
//printf("<pre>%s</pre>",var_export($GLOBALS,true));


if (mysql_query ($qNov))
	{
		if ($pase==1) mysql_query ($qPase); // no se usa
		if ($seva==1) mysql_query ($qBaja);

		?>
		<script>
		var answer=alert("Datos Grabados Correctamente")
		</script>
		<?

	}
else {

		?>
		<script>
		var answer=alert("ATENCION:\n---No se pudo grabar en la BD---")
		</script>
		<?

}
?>	<meta http-equiv='refresh' content='0; URL=alumno.php?dni=<?=$dni?>'>
<?PHP
}

?>
</html>
<? } ?>
