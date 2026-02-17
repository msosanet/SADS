<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Administrador de Alumnos</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 

function dniEnCuil() {
	nrodni = document.getElementsByName("dni");
	dniencuil = document.getElementsByName("cuildni");
	dniencuil[0].value = nrodni[0].value;
} 
</script> 

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
</head>
<?
include 'header.php';
?>
<body>

<p>




<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];



$errordni = 0;
$errorapellido = 0;
$errornombre = 0;
$hayerrores = 0;



$flag = 0;
if (isset($_POST["submitx"])) {
     // verifico los errores en los campos

     if (trim($_POST["dni"]) == '' OR !(is_numeric(trim($_POST["dni"])))) { $errordni = 1; $hayerrores = 1; };
     if (trim($_POST["apellido"]) == '') { $errorapellido = 1; $hayerrores = 1; };
     if (trim($_POST["nombre"]) == '') { $errornombre = 1; $hayerrores = 1; };


}
else $flag = 1;
  
if ($hayerrores OR $flag) {
	$nacimientoAproximado = (date("Y")-12)."-".date("m-d");
	$f_nac = date("Y-m-d",strtotime($nacimientoAproximado));
	$f_ingr = date("Y-m-d");
?>

<form method="POST" action="alta_alu.php">
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
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>	
				<tr>
					<td>
					<p align="left" class="text1b">Cargar Alumnos</p>
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
							<input type="number" name="dni" value="<?echo $_POST['dni']; ?>" onfocusout="dniEnCuil()" max=120000000 style="width: 6em;"> - C.U.I.L. 
							<input type="number" name="cuilpre" style="width: 1.5em;" max=50 value=""  >-<input type="number" name="cuildni" style="width: 6em;" max="120000000" value="" >-<input type="number" name="cuilsuf" style="width: 1em;" max=9 value="" >
							</td>
							<td width="190" bgcolor="#EAEAEA" align="right"><label for="sexo">Sexo:</label>
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="sexo"> 
  							 	<OPTION VALUE="F">F</OPTION> 
   								<OPTION VALUE="M">M</OPTION> 
  								<OPTION VALUE="M">X</OPTION> 
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
							Domicilio:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="domicilio" size="40" maxlength="40" value="<?echo $_POST['domicilio'];?>" /></td>
							</td>
							
					
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha de Nac.:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="f_nac" value = "<?=$f_nac?>"></td>
							</td>
							
						</tr>
									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Pais de Nac.:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="pais" size="30" maxlength="30" value="<?echo $_POST['pais'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							Provincia de Nac.:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="provincia" size="30" maxlength="30" value="<?echo $_POST['provincia'];?>" /></td>
							</td>
							
						</tr>
									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Ciudad de Nac.:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="ciudad" size="30" maxlength="30" value="<?echo $_POST['ciudad'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							E-mail:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="mail" size="40" maxlength="100" value="<?echo $_POST['mail'];?>" /></td>
							</td>
							
						</tr>
										
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Tel&eacute;fono:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="telefono" size="20" maxlength="20" value="<?echo $_POST['telefono'];?>" /></td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha de ingreso:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="f_ingr" value = "<?=$f_ingr?>"></td>
							</td>

							
						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">Tribu:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="tribu">
  							 	<OPTION VALUE="-">-</OPTION>  
  							 	<OPTION VALUE="Ona">Ona</OPTION> 
   								<OPTION VALUE="Yamana">Yamana</OPTION> 
							</SELECT> 
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Escuela:
							</td></font><td width="190" bgcolor="#EAEAEA" align="left"><input type="text" name="escuela" size="30" maxlength="100" value="<?echo $_POST['escuela'];?>" />


							</td>

							
						</tr>

									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">Localidad Escuela:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
						<input type="text" name="loca_esc" size="30" maxlength="100" value="<?echo $_POST['localidad_esc'];?>" />
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Grado/Año:
							</td></font><td width="190" bgcolor="#EAEAEA" align="left"><input type="text" name="grado" size="30" maxlength="100" value="<?echo $_POST['grado'];?>" />


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
	$cuit = trim($_POST['cuilpre']) . trim($_POST['cuildni']) . trim($_POST['cuilsuf']);
	$nombre=ucwords(strtolower($_POST['nombre']));
	$apellido=strtoupper($_POST['apellido']);
	$domicilio=ucwords(strtolower($_POST['domicilio']));
	$pais=ucwords(strtolower($_POST['pais']));
	$provincia=ucwords(strtolower($_POST['provincia']));
	$ciudad=ucwords(strtolower($_POST['ciudad']));
	$tel=$_POST['telefono'];
	$sexo=$_POST['sexo'];
//	$fingreso=$_POST['anio2']."-".$_POST['mes2']."-".$_POST['dia2'];
	$fingreso=$_POST['f_ingr'];
	$mail=$_POST['mail'];
//	$fnac=$_POST['anio']."-".$_POST['mes']."-".$_POST['dia'];
	$fnac=$_POST['f_nac'];
	$tribu=$_POST['tribu'];
	$escuela=ucwords(strtolower($_POST['escuela']));
	$loca_esc=ucwords(strtolower($_POST['loca_esc']));
	$grado=$_POST['grado'];


	

$resultdocente = mysql_query ("SELECT * FROM alumno where dni=$dni");
$yaesta = mysql_num_rows($resultdocente); 

if ($yaesta == 0)
{

	if (mysql_query ("INSERT INTO alumno VALUES ($dni,'$apellido','$nombre','$fnac','$ciudad','$provincia','$pais','$tel','$mail','$domicilio','$sexo','$tribu','$fingreso','$escuela','$loca_esc','$grado','','','','$cuit','')"))
//	if (true)
	{
//		echo "<!-- ";
//		echo "INSERT INTO alumno VALUES ($dni,'$apellido','$nombre','$fnac','$ciudad','$provincia','$pais','$tel','$mail','$domicilio','$sexo','$tribu','$fingreso','$escuela','$loca_esc','$grado','','','')";

				?>
				
				<script>
				var answer=alert("Datos Grabados Correctamente");
				location.assign("menu.php");
				</script>
<!--				<meta http-equiv='refresh' content='0; URL=menu.php?'> -->
				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD, puede que ya exista en la Base");
				location.assign("menu.php");
				</script> 
<!--				<meta http-equiv='refresh' content='0; URL=menu.php?'> -->
				<? 
		}
}
else {
?>
				<script>
				var answer=alert("El estudiante ya se encuentra cargado");
				location.assign("menu.php");
				</script> 
<!--				<meta http-equiv='refresh' content='0; URL=menu.php?'> -->
				<? 

	}					
}

?>
</html>
<? } ?>
