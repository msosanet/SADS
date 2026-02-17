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
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<title>SID</title>

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

<p>


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
$dni=$_GET['actor'];


$hora=date("H:i:s");



$resultdocente = mysql_query ("SELECT * FROM alumnos where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 



$errordoc = 0;
  $hayerrores = 0;


  if (!isset($_POST["submitx"])) {
$_POST['d']=date("d");
$_POST['m']=date("m");
$_POST['a']=date("Y");
$_POST['d2']=date("d");
$_POST['m2']=date("m");
$_POST['a2']=date("Y");
$_POST['hora']=$hora;


}




  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos


}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="come_add.php">
</p>
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
				<table border="0" width="980" cellspacing="0" cellpadding="0">
					<tr>
						
					</tr>
				</table>
				
				<p></div>
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
if ($_SESSION['valor']==4) 
{		
include 'menuppal4.php';
}
?>	
				<tr>
				

					<td>
					
					<p align="left" class="text1b">Agregar al comedor</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">&nbsp;Alumno: <?echo $filadocente['alumno'];?></td>
						</tr>
						

						<input type="hidden" name="identificacion" id="identificacion" value="<? echo $identificacion;?>"/>

						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"></td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Lunes</b> <input type="checkbox" name="dia1" value="1"></td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Martes</b> <input type="checkbox" name="dia2" value="2"></td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Miercoles</b> <input type="checkbox" name="dia3" value="3"></td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Jueves</b> <input type="checkbox" name="dia4" value="4"></td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Viernes</b> <input type="checkbox" name="dia5" value="5"></td>
						</tr>
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

	</form>
</div>
</body>
<?
}
else
{

$dni=$_POST['dni'];

$rest1 = substr($dni, 0, 2);
$rest2 = substr($dni, 3, 3);
$rest3 = substr($dni, 7, 3);
$rest4 =$rest1.$rest2.$rest3;


	$now=date("Y-m-d");
	$graba=$filausuario["nombre"];





if ($_POST['dia1']<>0) 
		{     
			mysql_query ("INSERT INTO alumno_comedor VALUES ('$rest4',1,'$now','$graba')");
		}
if ($_POST['dia2']<>0) 
		{     
			mysql_query ("INSERT INTO alumno_comedor VALUES ('$rest4',2,'$now','$graba')");
		}
if ($_POST['dia3']<>0) 
		{     
			mysql_query ("INSERT INTO alumno_comedor VALUES ('$rest4',3,'$now','$graba')");
		}
if ($_POST['dia4']<>0) 
		{     
			mysql_query ("INSERT INTO alumno_comedor VALUES ('$rest4',4,'$now','$graba')");
		}
if ($_POST['dia5']<>0) 
		{     
			mysql_query ("INSERT INTO alumno_comedor VALUES ('$rest4',5,'$now','$graba')");
		}

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script> 
				<meta http-equiv='refresh' content='0; URL=come.php'>
				<? 


}

?>
</html>
<? } ?>