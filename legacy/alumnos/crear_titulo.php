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
$dni=$_GET['dni'];

$sig_anio = date("Y") + 1;
$color = "";




$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM alumno where dni=$dni");
$filadocente = mysql_fetch_array($resultdocente);

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario);



$anio=date("Y");

$ye2 = mysql_query ("SELECT * FROM cursa where alumno=$dni and anio='$anio'");
$yaesta2 = mysql_fetch_array($ye2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>Alta t&iacute;tulo <?=$filadocente['apellido']?> <?=$filadocente['nombre']?></title>

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
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	/* Firefox */
	input[type=number] {
	  -moz-appearance: textfield;
	}
</style>


<?
$errordoc = 0;
  $hayerrores = 0;

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

<form method="GET" action="<?=$_SERVER['PHP_SELF']?>">
<div align="left">

					<div align="center">

					<table border="0" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td height="40" align="left" class="titulo2" bgcolor="#bbCbbb" colspan=4 >&nbsp;Alumno: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. Nº " . number_format($filadocente['dni'],0,'','.'); ?> </td>
						</tr>

						<tr>
							<td width="15%" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nº Titulo: </font></td>
                          	<td bgcolor="#EAEAEA" width="25%" align="left">94 -
							<input type="number" name="numero" size="10" min='0' max="9999999999999999" value="" />
							  / <input type="number" name="anio" size="6" maxlength="4" min="2010" max="<?=$sig_anio ?>" /></td>
							<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha de egreso: </td>

                          	<td bgcolor="#EAEAEA" width="30%" align="left"><input type="date" name="fe" min="2010-01-01" max="<?echo $sig_anio ?>-12-31" /></td>
						 </tr>

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Correo de env&iacute;o:</td>
							<td bgcolor="#EAEAEA" width="265" align="left" title="Direcci&oacute;n de correo electr&oacute;nico donde se envía el enlace"><input type="email" name="email" ></td>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Enlace:</td>
							<td bgcolor="#EAEAEA" width="265" align="left" title="Enlace de acceso al t&iacute;tulo"><input type="text" name="link" size="50" ></td>


						</tr>

						 <tr>
							<td bgcolor="#EAEAEA" width="40%" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></p></td>
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

	$numero=$_GET['numero'];
	$anio=$_GET['anio'];
	$correo=$_GET['email'];
	$enlace=$_GET['link'];
	$f_egre = date("Y-m-d",strtotime($_GET['fe']));
	$descripcion="";



$control=0;



if (mysql_query ("INSERT INTO titulo VALUES (0,$dni,'$numero','$anio','','','$f_egre',CURRENT_DATE,'$correo','$enlace','$descripcion')"))  $control=1;




if ($control<>0){

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script>
				<meta http-equiv='refresh' content='0; URL=bus_titulo.php?'>
				<?


	}
				else {
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script>
				<meta http-equiv='refresh' content='0; URL=bus_titulo.php?'>
				<?
				}



}

?>
</html>
<? } ?>
