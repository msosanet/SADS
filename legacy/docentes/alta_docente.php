<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

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
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>
<title>SIDOS</title>

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

$resultona = mysql_query ("SELECT * FROM docente where tribu='1'");
$filaona = mysql_num_rows($resultona); 

$resultyama = mysql_query ("SELECT * FROM docente where tribu='2'");
$filayama = mysql_num_rows($resultyama); 

$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos

     if (trim($_POST["dni"]) == '') { $errordni = 1; $hayerrores = 1; };
     if (trim($_POST["apellido"]) == '') { $errorapellido = 1; $hayerrores = 1; };
     if (trim($_POST["nombre"]) == '') { $errornombre = 1; $hayerrores = 1; };
     if (trim($_POST["fnac"]) == '') { $errorfnac = 1; $hayerrores = 1; };


}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="alta_docente.php">
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
?>	
				<tr>
				

					<td>
					<br>
					<p align="left" class="text1b">Carga de Personal que trabaja en el establecimiento</p> <br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						
												<?
	  					if ($errordni==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="dni" size="8" maxlength="8" value="<?echo $_POST['dni']; ?>" />
							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Sexo:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="sexo"> 
  							 	<OPTION VALUE="F">F</OPTION> 
   								<OPTION VALUE="M">M</OPTION> 
							</SELECT> 
							</td>
							
						</tr>
						<?
	  					if ($errorapellido==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
						
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Apellido:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="apellido" size="40" maxlength="40" value="<?echo $_POST['apellido']; ?>" />
							</td>												
						<?
	  					if ($errornombre==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="nombre" size="40" maxlength="40" value="<?echo $_POST['nombre']; ?>" />
							</td>

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Calle:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="calle" size="30" maxlength="30" value="<?echo $_POST['calle'];?>" /></td>
							</td>
							
					
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							N&uacute;mero:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="numero" size="10" maxlength="10" value="<?echo $_POST['numero'];?>" /></td>
							</td>
							
						</tr>
									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Piso:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="piso" size="30" maxlength="30" value="<?echo $_POST['piso'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							Depto:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="depto" size="10" maxlength="10" value="<?echo $_POST['depto'];?>" /></td>
							</td>
							
						</tr>
									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Barrio:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="barrio" size="30" maxlength="30" value="<?echo $_POST['barrio'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							E-mail:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="mail" size="50" maxlength="60" value="<?echo $_POST['mail'];?>" /></td>
							</td>
							
						</tr>
										
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Tel&eacute;fono:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="telefono" size="20" maxlength="20" value="<?echo $_POST['telefono'];?>" /></td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Tribu:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="tribu"> 
  							 	<OPTION VALUE="Ona">Ona</OPTION> 
   								<OPTION VALUE="Yamana">Yamana</OPTION> 
							</SELECT> Onas:<?php echo $filaona;?> / Yamana:<?php echo $filayama;?>

							</td>

							
						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Celular:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="celular" size="20" maxlength="20" value="<?echo $_POST['celular'];?>" /></td>
							</td>
							
																	<?
	  					if ($errorfnac==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
					
							<td width="150" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha de Nacimiento:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="fnac" id="fnac" value="<?echo $_POST["fnac"]?>" maxlength="10"/>
    							<img src="calendario.png" width="16" height="16" border="0" title="" id="fechas1">
							</td>
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"fnac",       // id del campo de texto 
	    					ifFormat:"%d-%m-%Y",            // formato de la fecha que se escriba en el campo de texto 
						button:"fechas1"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>

							
						</tr>

			
						<tr>
							
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

	</form>
</div>
</body>
<?
}
else
{
	$dni=$_POST['dni'];
	$nombre=ucfirst($_POST['nombre']);
	$apellido=strtoupper($_POST['apellido']);
	$calle=ucfirst($_POST['calle']);
	$barrio=ucfirst($_POST['barrio']);
	$telefono=$_POST['telefono'];
	$tribu=$_POST['tribu'];
	$sexo=$_POST['sexo'];
	$piso=$_POST['piso'];
	$depto=$_POST['depto'];
	$mail=$_POST['mail'];
	$numero=$_POST['numero'];
	$celular=$_POST['celular'];
	$fnac=$_POST['fnac'];
	$fec = explode("-", $fnac);
	$fnac=$fec[2]."-".$fec[1]."-".$fec[0];





$resultdocente = mysql_query ("SELECT * FROM docente where dni='$dni'");
$yaesta = mysql_num_rows($resultdocente); 

if ($yaesta == 0)
{

	if (mysql_query ("INSERT INTO docente VALUES ('$dni','$apellido','$nombre','$calle','$telefono','$tribu','$numero','$sexo','$piso','$depto','$barrio','$celular','$mail','$fnac')"))
	{		

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD, puede que ya exista en la Base")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
		}
}
else {
?>
				<script>
				var answer=alert("El docente/pomys ya se encuentra cargado")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 

	}					
}

?>
</html>
<? } ?>