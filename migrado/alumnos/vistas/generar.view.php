<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<!-- <script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script> -->
<link rel="stylesheet" type="text/css" href="style2.css" />
<!-- <link rel="shortcut icon" href="../imag/favicon.ico"> -->

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



$anio=date("Y");

$ye2 = mysql_query ("SELECT * FROM cursa where alumno=$dni and anio='$anio'");
$yaesta2 = mysql_fetch_array($ye2);





$errordoc = 0;
  $hayerrores = 0;



$_POST['d']=date("d");
$_POST['m']=date("m");
$_POST['a']=date("Y");


$anio=date("Y");


  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>


<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>	

<br>

<form method="GET" action="generar.php?dni=<? echo $dni ?>">
<div align="left">
				
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Alumno: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. Nº " . number_format($filadocente['dni'],0,'','.'); ?> -- Curso:<?echo $yaesta2['curso'] ?>º / <?echo $yaesta2['divi'] ?>º</td>
						</tr>
						
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?if (isset($color)) echo $color;?>">Numero / Año:</td>
						
                          							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="numero" size="4" maxlength="4" value="<?if (isset($_POST['numero'])) echo $_POST['numero']; ?>" /> / 
						
							<input type="text" name="anio" size="4" maxlength="4" value="<?echo $anio; ?>" />
							
							</td>

						</td>

							


							
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

	</form>
</div>
</body>
<?
}
else
{


	$num=$_GET['numero']."/".$_GET['anio'];

$control=0;

 

$resultdocente = mysql_query ("SELECT * FROM alumno where dni=$dni");
$filla = mysql_fetch_array($resultdocente); 


$pases = mysql_query ("SELECT alumno, MAX(id) AS mid FROM pase where alumno=$dni");
$pase = mysql_fetch_array($pases);


	

if (mysql_query ("UPDATE pase SET numero='$num' where id=$pase[mid]"))
	{

			$control=1;
}



if ($control<>0){

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
