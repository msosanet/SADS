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
					
					<p align="left" class="text1b">Cargar Docentes</p>
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
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="mail" size="30" maxlength="100" value="<?echo $_POST['mail'];?>" /></td>
							</td>
							
						</tr>
										
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Tel&eacute;fono:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="telefono" size="20" maxlength="20" value="<?echo $_POST['telefono'];?>" /></td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Tipo:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="tipo"> 
  							 	<OPTION VALUE="1">Docente</OPTION> 
   								<OPTION VALUE="2">NO Docente</OPTION> 
   								<OPTION VALUE="99">CEFLU</OPTION> 

							</SELECT> 
							</td>

							
						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Celular:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="celular" size="20" maxlength="20" value="<?echo $_POST['celular'];?>" /></td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Horas o Cargo:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="cargo"> 
  							 	<OPTION VALUE="1">CARGO</OPTION> 
   								<OPTION VALUE="0">HORAS</OPTION> 
							</SELECT> Si es Pomy es Cargo
							</td>

							
						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha Nac.:</td>
							<td bgcolor="#EAEAEA" width="265" align="left">DD-MM-AAAA<input type="text" name="dia" size="2" maxlength="2" value="<?echo $_POST['dia'];?>" />-<input type="text" name="mes" size="2" maxlength="2" value="<?echo $_POST['mes'];?>" />-<input type="text" name="anio" size="4" maxlength="4" value="<?echo $_POST['anio'];?>" /></td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Tribu:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left"><SELECT NAME="tribu"> 
  							 	<OPTION VALUE="Onas">Onas</OPTION> 
   								<OPTION VALUE="Yamanas">Yamanas</OPTION>
   								<OPTION VALUE="Sin asignar" selected>Sin asignar</OPTION> 
							</SELECT>
						
							</td>

							
						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Titulo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="titulo" size="50" maxlength="100" value="<?echo $_POST['titulo'];?>" /></td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
						
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

	$fnac=$_POST['anio']."-".$_POST['mes']."-".$_POST['dia'];
	$dni=$_POST['dni'];
	$tribu=$_POST['tribu'];
	$nombre=utf8_encode(ucfirst($_POST['nombre']));
	$apellido=utf8_encode(strtoupper($_POST['apellido']));
	$calle=ucfirst($_POST['calle']);
	$barrio=ucfirst($_POST['barrio']);
	$telefono=$_POST['telefono'];
	$tipo=$_POST['tipo'];
	$sexo=$_POST['sexo'];
	$piso=$_POST['piso'];
	$depto=$_POST['depto'];
	$mail=$_POST['mail'];
	$numero=$_POST['numero'];
	$celular=$_POST['celular'];
	$cargo=$_POST['cargo'];
	$titulo=$_POST['titulo'];
	$resultdocente2 = mysql_query ("SELECT idreloj FROM docentes ORDER BY idreloj desc");
	$yaesta2 = mysql_fetch_array($resultdocente2);     
	//echo $yaesta2;
	$reloj=$yaesta2['idreloj']+1;
	//echo $reloj;
	
	
	
	if ($tipo==2) $cargo=1;

$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$yaesta = mysql_num_rows($resultdocente); 

if ($yaesta == 0)
{

	$insertaDOC="INSERT INTO docentes VALUES ('$dni','$apellido','$nombre','$calle','$telefono','$tipo','$numero','$sexo','$piso','$depto','$barrio','$celular','$mail',$cargo,$reloj,'$fnac','$tribu','$titulo')";
	//echo $insertaDOC;
	if (mysql_query ($insertaDOC))
	{		

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<?echo $dni;?>'>
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
				var answer=alert("El docente/pomys ya se encuentra cargado con ese DNI")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 

	}					
}

?>
</html>
<? } ?>