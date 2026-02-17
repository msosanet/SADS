<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Datos de familiar</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'encabezado.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];

$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;

if (isset($_GET['dni'])) {
 $q_familiar = mysql_query("SELECT * FROM `familiares` WHERE dni = $_GET[dni]");
 if (mysql_num_rows($q_familiar)) {
  $datosFamiliar = mysql_fetch_assoc($q_familiar);
  $dni = $datosFamiliar['dni'];
  $apellido = $datosFamiliar['apellido'];
  $nombre = $datosFamiliar['nombre'];
  $domicilio = $datosFamiliar['domicilio'];
  $telefono = $datosFamiliar['tel'];
  $mail = $datosFamiliar['email'];
  $trabajo = $datosFamiliar['trabajo'];
  $tel2 = $datosFamiliar['tel_trabajo'];
  $flag = 1;
 }
}


elseif (isset($_POST["submitx"])) {
     // verifico los errores en los campos

    if (trim($_POST["dni"]) == '') { $errordni = 1; $hayerrores = 1; };
    if (trim($_POST["apellido"]) == '') { $errorapellido = 1; $hayerrores = 1; };
    if (trim($_POST["nombre"]) == '') { $errornombre = 1; $hayerrores = 1; };
	
	$dni=$_POST['dni'];
	$nombre=ucwords(strtolower($_POST['nombre']));
	$apellido=strtoupper($_POST['apellido']);
	$domicilio=ucfirst($_POST['domicilio']);
	$telefono=$_POST['telefono'];
	$mail=$_POST['mail'];
	$tel2=$_POST['tel2'];
	$trabajo=$_POST['trabajo'];
//	$hayerrores = 1;

}
else
{
 $flag = 1;

$dni = "";
$apellido = "";
$nombre = "";
$domicilio = "";
$telefono = "";
$mail = "";
$trabajo = "";
$tel2 = "";
  }
  
if ($hayerrores OR $flag) {

?>

<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
<div align="center">
	<table border="0" bgcolor="#FFFFFF" width="980">
		<tr><th>

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
		</th></tr>
		<tr>
			<td>
			<div align="center">
			<table border="0">

				<tr>
				

					<td>
					
					<p align="left" class="text1b">Cargar Familiares</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						
												<?
	  					if (isset($errordni) && $errordni==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="dni" size="8" maxlength="8" value="<?=$dni?>" <?if(isset($_GET['dni'])) echo "readonly";?>/>
							</td>
					
							
						<?
	  					if (isset($errorapellido) && $errorapellido==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Apellido:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="apellido" size="40" maxlength="40" value="<?=$apellido?>" />
							</td>	
							
						</tr>
						<?
	  					if (isset($errornombre) && $errornombre==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="nombre" size="40" maxlength="40" value="<?=$nombre?>" />
							</td>												

							

							<td width="190" bgcolor="#EAEAEA" align="right">
							Domicilio:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="domicilio" size="40" maxlength="40" value="<?=$domicilio?>" /></td>
							

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Telefono personal:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="telefono" size="20" maxlength="20" value="<?=$telefono?>" /></td>
						
							
					
					


							<td width="190" bgcolor="#EAEAEA" align="right">
							Lugar de trabajo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="trabajo" size="30" maxlength="30" value="<?=$trabajo?>" /></td>

							
						</tr>
									<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Telefono del trabajo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="tel2" size="30" maxlength="30" value="<?=$tel2?>" /></td>

						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							E-mail:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="mail" size="30" maxlength="50" value="<?=$mail?>" /></td>

							
						</tr>
									

			
						<tr>
							
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						</table>
					</div></div>
					</td>
				</tr>
				<?
include 'foot.php';
?>
			</table>
			</div></td>
		</tr>
	</table>

	</form>
</div>
</body>
<?
}
else
{

/*	$dni=$_POST['dni'];
	$nombre=ucwords(strtolower($_POST['nombre']));
	$apellido=strtoupper($_POST['apellido']);
	$domicilio=ucfirst($_POST['domicilio']);
	$telefono=$_POST['telefono'];
	$mail=$_POST['mail'];
	$tel2=$_POST['tel2'];
	$trabajo=$_POST['trabajo']; */

$insertar = "INSERT INTO familiares VALUES ($dni,'$nombre','$apellido','$domicilio','$telefono','$trabajo','$tel2','$mail')";

$actualizar = "UPDATE familiares SET nombre = '$nombre', apellido = '$apellido', domicilio = '$domicilio', tel = '$telefono', trabajo = '$trabajo', tel_trabajo = '$tel2', email = '$mail' WHERE dni='$dni'";

$resultdocente = mysql_query ("SELECT * FROM familiares WHERE dni=$dni");
$yaesta = mysql_num_rows($resultdocente); 

if ($yaesta == 0 && mysql_query ($insertar))
{

?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=<?=$_SERVER["PHP_SELF"]?>'>
				<?
}
elseif (mysql_query ($actualizar) && $dni!='')
	{
?>
				<script>
				var answer=alert("Datos actualizados")
				</script> 
				<meta http-equiv='refresh' content='0; URL=<?=$_SERVER["PHP_SELF"]?>'>
				<? 

	}
else {
				?>
				<script>
				var answer=alert("ATENCION\nNo se pudo grabar la Base de Datos")
				</script> 
				<meta http-equiv='refresh' content='0; URL=<?=$_SERVER["PHP_SELF"]?>'>
				<? 			

}	
}

?>
</html>
<? } ?>