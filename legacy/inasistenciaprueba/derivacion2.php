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
}

  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos


     if (trim($_POST["fecha"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["tel"]) == '') { $errortel = 1; $hayerrores = 1; };

     if (trim($_POST["cargo"]) == '') { $errorcargo = 1; $hayerrores = 1; };

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="derivacion2.php">
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

$edad=$filadocente['fechanac'];

function calculaedad($edad){
	list($ano,$mes,$dia) = explode("-",$edad);
	$ano_diferencia  = date("Y") - $ano;
	$mes_diferencia = date("m") - $mes;
	$dia_diferencia   = date("d") - $dia;
	if ($dia_diferencia < 0 || $mes_diferencia < 0)
		$ano_diferencia--;
	return $ano_diferencia;
}


$hoy = date("Y-m-d");

?>	
				<tr>
				

					<td>
					<br>
					<p align="left" class="text1b">Cargar Derivacion de <? echo $filadocente['alumno'] ?></p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
					</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">CURSO: <?echo $filadocente['curso'];?>/<?echo $filadocente['division'];?><br>
						Edad: <?echo  calculaedad ($edad);?><BR>
						FECHA DE NACIMIENTO: <?echo  $filadocente['fechanac'];?>

					</td>
						</tr>
							<tr>
							<td width="190" bgcolor="#EAEAEA" align="right">&nbsp;
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"></td>
							</td>
							<td width="190" bgcolor="#EAEAEA" align="right">&nbsp;
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"></td>
							</td>
							
					</tr>

						<tr>
					        <?
	  					if ($errorcargo==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>


					
							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Cargo:
							</td></font>
						<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="cargo" size="30" maxlength="30" value="" /></td>
							</td>

						
							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Observador:
							</td></font>

						<td bgcolor="#EAEAEA" width="265" align="left"><?php echo $filausuario['apellido']." ".$filausuario['nombre'];?></td>
							</td>
							</tr>
							<tr>
					        <?
	  					if ($errortel==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>

							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Telefono:
							</td></font>

						<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="tel" size="20" maxlength="20" value="" /></td>
							</td>
					        <?
	  					if ($errorfecha==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
	
							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							Fecha:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="fecha" size="10" maxlength="10" value="<?echo $hoy;?>" /></td>
							</td>

						</tr>				
							
					
						
						<tr>

							<td width="174" bgcolor="#EAEAEA" align="right" colspan="2">Hechos Observados:</td>
							<td bgcolor="#EAEAEA" width="800" align="left" colspan="2"><TEXTAREA COLS=50 ROWS=20 NAME="observaciones"> </TEXTAREA></td>

						</tr>
			
	
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
<input name="dni" type="hidden" value ="<?php echo $dni; ?>"/>

	</form>
</div>
</body>
<?
}
else
{

	$fecha=$_POST['fecha'];
	$cargo=$_POST['cargo'];
	$observaciones=$_POST['observaciones'];
	$observador=$_POST['observador'];
	$alumno=$_POST['dni'];
	$tel=$_POST['tel'];
	$profesional=$filausuario['apellido']." ".$filausuario['nombre'];
	$profe=$filausuario['dni'];



if (mysql_query ("INSERT INTO derivacion VALUES (0,'$profesional','$cargo','$tel','$observaciones','','','','$alumno','$fecha','$profe')"))
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
		
				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 

}?>
</html>
<? } ?>