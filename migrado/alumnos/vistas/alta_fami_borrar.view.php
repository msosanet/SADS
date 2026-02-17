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
<title>Administrador de Alumnos</title>

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




$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos

     if (trim($_POST["dni"]) == '') { $errordni = 1; $hayerrores = 1; };
     if (trim($_POST["apellido"]) == '') { $errorapellido = 1; $hayerrores = 1; };
     if (trim($_POST["nombre"]) == '') { $errornombre = 1; $hayerrores = 1; };


}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="alta_fami.php">
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
					
					<p align="left" class="text1b">Cargar Familiares</p>
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
					
							

							<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Apellido:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="apellido" size="40" maxlength="40" value="<?echo $_POST['apellido']; ?>" />
							</td>	
							
						</tr>
						<?
	  					if ($errorapellido==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
						
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="nombre" size="40" maxlength="40" value="<?echo $_POST['nombre']; ?>" />
							</td>												

							

							<td width="190" bgcolor="#EAEAEA" align="right">
							Domicilio:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="domicilio" size="40" maxlength="40" value="<?echo $_POST['domicilio'];?>" /></td>
							</td>
							

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Telefono personal:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="telefono" size="20" maxlength="20" value="<?echo $_POST['telefono'];?>" /></td>
							</td>
							
					
					


							<td width="190" bgcolor="#EAEAEA" align="right">
							Lugar de trabajo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="trabajo" size="30" maxlength="30" value="<?echo $_POST['trabajo'];?>" /></td>
							</td>

							
						</tr>
									<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Telefono del trabajo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="tel2" size="30" maxlength="30" value="<?echo $_POST['tel2'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							E-mail:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="mail" size="30" maxlength="50" value="<?echo $_POST['mail'];?>" /></td>
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
	$domicilio=ucfirst($_POST['domicilio']);
	$telefono=$_POST['telefono'];
	$mail=$_POST['mail'];
	$tel2=$_POST['tel2'];
	$trabajo=$_POST['trabajo'];



	

$resultdocente = mysql_query ("SELECT * FROM familiares where dni=$dni");
$yaesta = mysql_num_rows($resultdocente); 

if ($yaesta == 0)
{

	if (mysql_query ("INSERT INTO familiares VALUES ($dni,'$nombre','$apellido','$domicilio','$telefono','$trabajo','$tel2','$mail')"))
	{		

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=alta_fami.php?'>
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
				var answer=alert("El familiar ya se encuentra cargado")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 

	}					
}

?>
</html>
<? } ?>
