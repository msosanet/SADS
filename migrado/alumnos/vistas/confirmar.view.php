<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"> 
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>CARGAR pases</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>

<body>

<div id="marco980">
<?
include 'header.php';
?>


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
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$dni=$_GET['dni'];



$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM alumno where dni=$dni");
$filadocente = mysql_fetch_array($resultdocente); 

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 


$cicloLect = $_SESSION['cicloLectivo'];
$anio = $cicloLect;
//$anio=date("Y");

$ye2 = mysql_query ("SELECT * FROM cursa where alumno=$dni and anio='$anio'");
$yaesta2 = mysql_fetch_array($ye2);





$errordoc = 0;
  $hayerrores = 0;

if (!isset($_GET['fecha'])) $_GET['fecha'] = date("Y-m-d");
/*
$_GET['d']=date("d");
$_GET['m']=date("m");
$_GET['a']=date("Y");*/





  $flag = 0;
  if (isset($_GET["submitx"]) OR isset($_GET["baja_sc"])) {
     // verifico los errores en los campos

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>


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
?>	

<br>

<form method="GET" action="<?=$_SERVER['PHP_SELF']?>">
<div align="left">
				
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Alumno: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. Nº " . number_format($filadocente['dni'],0,'','.'); ?> -- Curso:<?echo $yaesta2['curso'] ?>º / <?echo $yaesta2['divi'] ?>º</td>
						</tr>
						
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha del pase:</td>
						 
                          							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="date" name="fecha" value="<?echo $_GET['fecha']; ?>" />
<!--							<input type="text" name="di" size="2" maxlength="2" value="<?//echo $_GET['d']; ?>" />
							-
							<input type="text" name="me" size="2" maxlength="2" value="<?//echo $_GET['m']; ?>" />
							-
							<input type="text" name="an" size="4" maxlength="4" value="<?//echo $_GET['a']; ?>" /> 
							(DD-MM-AAAA)</td> -->

						

							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Establecimiento</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"><input type="text" name="esta" size="30" maxlength="30" value="" placeholder="Inst. de Destino o Razón de baja" />

							</td>
							
						</tr>
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Domicilio:</td>
						 
                          							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="domicilio" size="30" maxlength="30" value="" placeholder="de la Institución de Destino"/></td>

						

							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Ciudad</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"><input type="text" name="ciudad" size="30" maxlength="30" value=""  placeholder="de la Institución de Destino"/>

							</td>
							
						</tr>
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Provincia:</td>
						 
                          							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="prov" size="30" maxlength="30" value=""  placeholder="de la Institución de Destino"/></td>

						

							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">CP</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"><input type="text" name="cp" size="4" maxlength="4" value="" />

							</td>
							
						</tr>
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Telefono:</td>
						 
                          							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="tel" size="30" maxlength="30" value=""  placeholder="de la Institución de Destino"/></td>

						

							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">E-mai</font>l</td>
							
							<td bgcolor="#EAEAEA" width="425" align="left"><input type="text" name="mail" size="30" maxlength="50" value=""  placeholder="de la Institución de Destino"/>

							</td>
							
						</tr>
						
	

		
						<tr>
							<td bgcolor="#EAEAEA" align="left" colspan="2">
							<p align="center"><input type="submit" value="Baja sin confirmación" name="baja_sc" style="border: 1px solid #C0C0C0; padding: 3px; background-color: #EBEBEB; font-weight:700; float:center" title="Especificar detalles en campo Establecimiento"/></p></td>
							<td bgcolor="#EAEAEA" align="left" colspan="2">
							<p><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></p></td>
						</tr>
						</table>
					</div>
<p align="right">&nbsp;</p>

</div>
<?
include 'footer.php';
?>

            
<input name="dni" type="hidden" value ="<?php echo $dni ?>"/>

	</form>
</div>
</body>
<?
}
else
{
	$hora=date("H:i:s");

//	$fecha=$_GET['an']."-".$_GET['me']."-".$_GET['di'];
	$fecha=$_GET['fecha'];
	$esta=$_GET['esta'];
	$ciudad=$_GET['ciudad'];
	$tel=$_GET['tel'];
	$mail=$_GET['mail'];
	$cp=$_GET['cp'];
	$prov=$_GET['prov'];
	$domicilio=$_GET['domicilio'];


$control=FALSE;
$pases = mysql_query ("SELECT MAX(id) AS mid  FROM pase where alumno=$dni");
$pase = mysql_fetch_array($pases);
 

$resultdocente = mysql_query ("SELECT * FROM alumno where dni=$dni");
$filla = mysql_fetch_array($resultdocente); 

$alumno=$filla['apellido'].", ".$filla['nombre'];

if (isset($_GET["baja_sc"])) $novedades2= "Baja sin confirmar";
else $novedades2= "Confirmo pase";

	$rr1 = mysql_query ("SELECT * FROM cursa where alumno=$dni and anio='$anio' and control=1");
	$rr1 = mysql_fetch_array($rr1); 

	$cursi=$rr1["curso"]."/".$rr1["divi"];


//$q1 = "UPDATE pase SET establecimiento='$esta', domicilio='$domicilio', ciudad='$ciudad', provincia='$prov',cp='$cp',telefono='$tel', email='$mail', fecha_conf='$fecha' where id=$pase[mid]<br>";
if (mysql_query ("UPDATE pase SET establecimiento='$esta', domicilio='$domicilio', ciudad='$ciudad', provincia='$prov',cp='$cp',telefono='$tel', email='$mail', fecha_conf='$fecha' where id=$pase[mid]"))
	{

			$control = mysql_query ("UPDATE cursa SET pase='$fecha', control=0 WHERE alumno=$dni AND anio='$anio' AND control=1");
//$q2 = "UPDATE cursa SET pase='$fecha', control=0 WHERE alumno=$dni AND anio='$anio' AND control=1<br>";

			$control = $control AND mysql_query ("INSERT INTO novedades VALUES (0,$dni,'$alumno','$cursi','$novedades2','$fecha','$hora','$usuario',1,0)");
//$q3 = "INSERT INTO novedades VALUES (0,$dni,'$alumno','$cursi','$novedades2','$fecha','$hora','$usuario',1,0)";

//			echo $q1 . "\n" . $q2 . "\n" . $q3;
}



if ($control){

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script> 
				<meta http-equiv='refresh' content='0; URL=bus_pase.php?'>
				<? 

				
}
else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=bus_pase.php?'>
				<? 
}					



}

?>
</html>
<? } ?>
