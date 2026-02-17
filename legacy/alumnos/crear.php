<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un gui�n.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}

//esto pasa las mayusculas acentuadas a minusculas acentuadas
function strtolowerExtended($str)
{
        $low = array(chr(193) => chr(225), //á
                    chr(201) => chr(233), //é
                    chr(205) => chr(237), //í­
                   chr(211) => chr(243), //ó
                   chr(218) => chr(250), //ú
                  chr(220) => chr(252), //ü
                    chr(209) => chr(241)  //ñ
                    );
 
      return strtolower(strtr($str,$low)); 
} 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">

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

<form method="GET" action="crear.php?dni=<? echo $dni ?>">
<div align="left">
				
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Alumno: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. N� " . number_format($filadocente[dni],0,'','.'); ?> -- Curso:<?echo $yaesta2['curso'] ?>� / <?echo $yaesta2['divi'] ?>�</td>
						</tr>
						
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha de pedido:</td>
					
                          							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="d2" size="2" maxlength="2" value="<?echo $_POST['d']; ?>" />
							-
							<input type="text" name="m2" size="2" maxlength="2" value="<?echo $_POST['m']; ?>" />
							-
							<input type="text" name="a2" size="4" maxlength="4" value="<?echo $_POST['a']; ?>" /> 
							(DD-MM-AAAA)</td>

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
$hora=date("H:i:s");

	$fecha=$_POST['a']."-".$_POST['m']."-".$_POST['d'];

$control=0;

 

$resultdocente = mysql_query ("SELECT * FROM alumno where dni=$dni");
$filla = mysql_fetch_array($resultdocente); 

$alumno=$filla[apellido].", ".$filla[nombre];

$novedades2="Pidio pase";


	$rr1 = mysql_query ("SELECT * FROM cursa where alumno=$dni and anio='$anio' and control=1");
	$rr1 = mysql_fetch_array($rr1); 

	$cursi=$rr1["curso"]."/".$rr1["divi"];


	

if (mysql_query ("INSERT INTO pase VALUES (0,$dni,'$fecha','','','','','','','','','','','')"))
	{

			mysql_query ("INSERT INTO novedades VALUES (0,$dni,'$alumno','$cursi','$novedades2','$fecha','$hora','$usuario',1,0)");

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