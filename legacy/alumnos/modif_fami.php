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
$dni=$_GET["dni"];

$resultt = mysql_query ("SELECT * FROM familiares WHERE dni = $dni");
$filatt = mysql_fetch_array($resultt);


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

<form method="_GET" action="modif_fami.php?dni=<? echo $dni; ?>">
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
					
					<p align="left" class="text1b">Modificar Familiares</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<?echo $filatt['dni']; ?>
							</td>
					
							

							<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Apellido:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="apellido" size="40" maxlength="40" value="<?echo $filatt['apellido']; ?>" />
							</td>	
							
						</tr>

						
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="nombre" size="40" maxlength="40" value="<?echo $filatt['nombre']; ?>" />
							</td>												

							

							<td width="190" bgcolor="#EAEAEA" align="right">
							Domicilio:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="domicilio" size="40" maxlength="40" value="<?echo $filatt['domicilio'];?>" /></td>
							</td>
							

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Telefono personal:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="telefono" size="20" maxlength="20" value="<?echo $filatt['tel'];?>" /></td>
							</td>
							
					
					


							<td width="190" bgcolor="#EAEAEA" align="right">
							Lugar de trabajo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="trabajo" size="30" maxlength="30" value="<?echo $filatt['trabajo'];?>" /></td>
							</td>

							
						</tr>
									<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Telefono del trabajo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="tel2" size="30" maxlength="30" value="<?echo $filatt['tel_trabajo'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							E-mail:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="mail" size="30" maxlength="30" value="<?echo $filatt['email'];?>" /></td>
							</td>
							
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
<input type="hidden" name="dni" value="<?echo $dni;?>">
	</form>
</div>
</body>
<?
}
else
{


	$nombre=ucfirst($_GET['nombre']);
	$apellido=strtoupper($_GET['apellido']);
	$domicilio=ucfirst($_GET['domicilio']);
	$telefono=$_GET['telefono'];
	$mail=$_GET['mail'];
	$tel2=$_GET['tel2'];
	$trabajo=$_GET['trabajo'];

if($tel2=="") $tel2="";
if($telefono=="") $telefono=""; 
 








if (mysql_query ("UPDATE familiares SET nombre='$nombre', apellido='$apellido', domicilio='$domicilio', tel='$telefono', trabajo='$trabajo', tel_trabajo='$tel2', email='$mail' where dni=$dni"))
	{		

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=modif_fami.php?dni=<?php echo $dni?>'>

				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=modif_fami.php?dni=<?php echo $dni?>'>

				<? 
		}

				
}

?>
</html>
<? } ?>