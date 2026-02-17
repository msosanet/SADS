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
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>Agrega familiares</title>

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

$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$dni=$_GET['dni'];

$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM alumno where dni=$dni");
$filadocente = mysql_fetch_array($resultdocente); 

if (!$filadocente) { // Cuando el estudiante no está registrado
 ?>
	<script>
	var answer=alert("Estudiante no encontrado")
	</script> 
	<meta http-equiv='refresh' content="0; URL=bus_alu.php">
<?
 exit;
}

$resultmotivo = mysql_query ("SELECT * FROM familiares order by apellido"); 

$resultE = mysql_query ("SELECT * FROM alu_fami WHERE alumno='$dni'"); 
 while ($fil = mysql_fetch_array($resultE)) 
 {
		if ($fil['tipo']=='P')	$padrex=$fil['familiar'];
		if ($fil['tipo']=='M')	$madrex=$fil['familiar'];
		if ($fil['tipo']=='T')	$tutorx=$fil['familiar'];
 }
if (!isset($padrex)) $padrex=0;
if (!isset($madrex)) $madrex=0;
if (!isset($tutorx)) $tutorx=0;

$errordoc = 0;
$hayerrores = 0;
$flag = 0;
  if (isset($_POST["submitx"]) && isset($_POST["relacion"])) { //Cuando se agrega datos de familiar
     // verifico los errores en los campos
	if (is_numeric($_POST['dni_fam'])) $dni_fam = $_POST['dni_fam'];
	else $hayerrores = $errordni = TRUE;
	if (trim($_POST["apellido"]) == '') $errorapellido = $hayerrores = TRUE;
	if (trim($_POST["nombre"]) == '')  $errornombre = $hayerrores = TRUE;
	
	$nombre=ucwords(strtolower($_POST['nombre']));
	$apellido=strtoupper($_POST['apellido']);
	$domicilio=ucfirst($_POST['domicilio']);
	$telefono=$_POST['telefono'];
	$mail=$_POST['mail'];
	$tel2=$_POST['tel2'];
	$trabajo=$_POST['trabajo'];

}
elseif (!isset($_POST["submitx"])) {/*
	//no hay nada que verificar
}
 else { */
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

<form method="POST" action="<?=$_SERVER['PHP_SELF'].'?dni='.$dni?>">
<div align="left">
	<table><tbody>
	<tr>
	<td>
		<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
			<tr>
				<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Alumno: <b><?echo strtoupper($filadocente['apellido']) .", " . ucwords(strtolower($filadocente['nombre'])) . "</b> - D.N.I. Nº " . number_format($filadocente['dni'],0,'','.'); ?></td>
			</tr>
			
			<tr>
			  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Padre:</td>
			  <td bgcolor="#EAEAEA" width="268" align="left">
			  
			  <select size="1" autofocus="true" name="motivo"> <!-- ****************************LISTA PADRE -->
			  <?	
				WHILE ($myrow6 = mysql_fetch_array($resultmotivo)) {			
					if ($myrow6['dni']==$padrex)
						{echo '<option value="' . $myrow6['dni'] . '" selected>' . $myrow6['apellido'] . ' ' . $myrow6['nombre'] . ' - D.N.I. Nº ' . $myrow6['dni'] . "</option>\n";}
					else
						{echo "<option value='" . $myrow6['dni'] . "' >" . $myrow6['apellido'] . " " . $myrow6['nombre'] . " - D.N.I. Nº " . $myrow6['dni'] . "</option>\n";}
				}
				mysql_data_seek($resultmotivo,0);
			  ?>
			  </select>
			  </td>
			  <td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"></font></td>
			  <td bgcolor="#EAEAEA" width="425" align="left"></td>
			</tr>
			<tr>
			  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Madre:</font></td>
			  <td bgcolor="#EAEAEA" width="268" align="left">
			   <select size="1" autofocus="true" name="motivo2"> <!-- ****************************LISTA MADRE -->
			   <?	
				WHILE ($myrow62 = mysql_fetch_array($resultmotivo)) {
					if ($myrow62['dni']==$madrex)
						{echo "<option value='" . $myrow62['dni'] . "' selected>" . $myrow62['apellido'] . " " . $myrow62['nombre'] . " - D.N.I. Nº " . $myrow62['dni'] . "</option>\n";}	
					else
						{echo "<option value='" . $myrow62['dni'] . "' >" . $myrow62['apellido'] . " " . $myrow62['nombre'] . " - D.N.I. Nº " . $myrow62['dni'] . "</option>\n";}						    
					}
					mysql_data_seek($resultmotivo,0);
			   ?>
			   </select>
			  </td>
			  <td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"></font></td>
			  <td bgcolor="#EAEAEA" width="425" align="left"></td>
			</tr>
			<tr>
			 <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Tutor/a:</font></td>
			 <td bgcolor="#EAEAEA" width="268" align="left">
			  <select size="1" autofocus="true" name="motivo3"> <!-- ****************************LISTA TUTOR -->
			  <?	
				WHILE ($myrow63 = mysql_fetch_array($resultmotivo)) {
					if ($myrow63['dni']==$tutorx)
						{echo "<option value='" . $myrow63['dni'] . "' selected>" . $myrow63['apellido'] . " " . $myrow63['nombre'] . " - D.N.I. Nº " . $myrow63['dni'] . "</option>\n"; }
					else
						{echo "<option value='" . $myrow63['dni'] . "'>" . $myrow63['apellido'] . " " . $myrow63['nombre'] . " - D.N.I. Nº " . $myrow63['dni'] . "</option>\n"; }
				}

			  ?>
			   </select>
			  </td>
			  <td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"></font></td>
			  <td bgcolor="#EAEAEA" width="425" align="left"></td>
			</tr> <!-- Boton grabar Se VAAAAAAA
			<tr>
				<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
				<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
			</tr> -->
		</table>
	</td>
	</tr>
	<tr>
	 <td><!-- Acá el fomurlario para agregar datos de familiar -->					 
	  <table border="0" width="895" id="table1" bgcolor="#EAEAEA"  cellpadding="0" cellspacing="4">
		<tr>
		<?
//		if (isset($errordni) && $errordni==1) {$color="#FF0000";}
		if ($errordni) $color="#FF0000";
		else $color="#000000";
		?>
		 <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
		 <td bgcolor="#EAEAEA" width="268" align="left">
		 <input type="number" name="dni_fam" size="10" min="1000000" max="100000000" value="<?=$dni_fam?>">
		 </td>
		<?
//		if (isset($errorapellido) && $errorapellido==1) $color="#FF0000";
		if ($errorapellido) $color="#FF0000";
		else $color="#000000";
		?>
		 <td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Apellido:</font></td>
		 <td bgcolor="#EAEAEA" width="425" align="left">
		  <input type="text" name="apellido" size="40" maxlength="40" value="<?=$apellido?>" />
		 </td>	
		</tr>
		<?
//		if (isset($errornombre) && $errornombre==1) {$color="#FF0000";}
		if ($errornombre) $color="#FF0000";
		else $color="#000000";
		?>
		<tr>
		 <td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</font></td>
		 <td bgcolor="#EAEAEA" width="425" align="left">
		  <input type="text" name="nombre" size="40" maxlength="40" value="<?=$nombre?>" />
		 </td>
		 <td width="190" bgcolor="#EAEAEA" align="right">Domicilio:</td>
		 <td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="domicilio" size="40" maxlength="40" value="<?=$domicilio?>" /></td>
		</tr>
		<tr>
			<td width="190" bgcolor="#EAEAEA" align="right">
			Telefono personal:</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="telefono" size="20" maxlength="20" value="<?=$telefono?>" /></td>
			<td width="190" bgcolor="#EAEAEA" align="right">
			Lugar de trabajo:</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="trabajo" size="30" maxlength="30" value="<?=$trabajo?>" /></td>
		</tr>
		<tr>
		 <td width="190" bgcolor="#EAEAEA" align="right">Telefono del trabajo:</td>
		 <td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="tel2" size="30" maxlength="30" value="<?=$tel2?>" /></td>
		 <td width="190" bgcolor="#EAEAEA" align="right">E-mail:</td>
		 <td bgcolor="#EAEAEA" width="265" align="left"><input type="email" name="mail" size="30" maxlength="50" value="<?=$mail?>" /></td>
		</tr>
		<tr>
		 <td align="right">Parentesco:</td>
		 <td colspan="2">
		  <table width="100%">
		  <tr>
			<td>Padre <input type="radio" name="relacion" value="P"></td>
			<td>Madre <input type="radio" name="relacion" value="M"></td>
			<td>Tutor/a <input type="radio" name="relacion" value="T"></td>
		  </tr>
		  </table>
		 </td>
		 <td></td>
		</tr>
<?/*		<tr>
			<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
			<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
		</tr> */?>
	  </table>

	 </td>
	</tr>
		</tbody>
		 <tfoot>
		  <tr>
		   <td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
			<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" />
		   </td>
		  </tr>
		 </tfoot>
		</table>
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
// $export =  var_export($_POST,true);


$existeP = mysql_query ("SELECT * FROM alu_fami WHERE alumno='$dni' AND tipo='P'"); 
$filaP = mysql_num_rows($existeP);
$existeM = mysql_query ("SELECT * FROM alu_fami WHERE alumno='$dni' AND tipo='M'"); 
$filaM = mysql_num_rows($existeM);
$existeT = mysql_query ("SELECT * FROM alu_fami WHERE alumno='$dni' AND tipo='T'"); 
$filaT = mysql_num_rows($existeT);

if (isset($_POST['relacion'])) {
 $existeF = mysql_query ("SELECT * FROM familiares WHERE dni = '$dni_fam'"); 
 if (mysql_num_rows($existeF)) {
  // Por si resulta útil en algún momento comparar los datos existentes del familiar
 }
 else {
  //$agreg="INSERT INTO familiares VALUES ($dni_fam,'$nombre','$apellido','$domicilio','$telefono','$trabajo','$tel2','$mail')";
 // echo $agreg;
  $agregado = mysql_query("INSERT INTO familiares VALUES ($dni_fam,'$nombre','$apellido','$domicilio','$telefono','$trabajo','$tel2','$mail')");
// $agregado = "INSERT INTO familiares VALUES ($dni_fam,'$nombre','$apellido','$domicilio','$telefono','$trabajo','$tel2','$mail')";
 }
 switch ($_POST['relacion']) {
   case "P":
    $padre = $dni_fam;
	$madre=$_POST['motivo2'];
	$tutor=$_POST['motivo3'];
    break;
   case "M":
    $padre = $_POST['motivo'];
	$madre= $dni_fam;
	$tutor=$_POST['motivo3'];
    break;
   case "T":
    $padre = $_POST['motivo'];
	$madre= $_POST['motivo2'];
	$tutor= $dni_fam;
    break;

  }
}
else { // Si el formulario no incluye un familiar nuevo

	$padre=$_POST['motivo'];
	$madre=$_POST['motivo2'];
	$tutor=$_POST['motivo3'];
}

$p="P";
$m="M";
$t="T";

//$control="<p>" . $agregado . "<br>";
unset($control);
$control = TRUE;

if ($padre) { // Sólo si se eligió algún padre
 if (!$filaP) { 
			$control = $control && (mysql_query ("INSERT INTO alu_fami VALUES ($dni,$padre,'$p')")); 
//			$control.="<br>ag Padre<br>INSERT INTO alu_fami VALUES ($dni,$padre,'$p')";
 }
 else { 
			$control = $control && (mysql_query ("UPDATE alu_fami SET familiar='$padre' WHERE alumno='$dni' AND tipo LIKE 'P'")); 
//			$control.="<br>mod Padre<br>UPDATE alu_fami SET familiar='$padre' WHERE alumno='$dni' AND tipo='P'";
 }
}
if ($madre) { // Sólo si se eligió alguna madre
 if (!$filaM) { 
			$control = $control && (mysql_query ("INSERT INTO alu_fami VALUES ($dni,$madre,'$m')"));
//			$control.="<br>ag Madre<br>INSERT INTO alu_fami VALUES ($dni,$madre,'$m')";
 }
 else { 
			$control = $control && (mysql_query ("UPDATE alu_fami SET familiar='$madre' WHERE alumno='$dni' AND tipo LIKE 'M'")); 
//			$control.="<br>mod Madre<br>UPDATE alu_fami SET familiar='$madre' WHERE alumno='$dni' AND tipo='M'";
 }
}
	
if ($tutor) { // Sólo si se eligió algún tutor/a
 if (!$filaT) { 
			$control = $control && (mysql_query ("INSERT INTO alu_fami VALUES ($dni,$tutor,'$t')")); 
//			$control.="<br>ag Tutor<br>INSERT INTO alu_fami VALUES ($dni,$tutor,'$t')";
 }
 else {
			$control = $control && (mysql_query ("UPDATE alu_fami SET familiar='$tutor' WHERE alumno='$dni' AND tipo LIKE 'T'")); 
//			$control.="<br>mod Tutor<br>UPDATE alu_fami SET familiar='$tutor' WHERE alumno='$dni' AND tipo='T'";
 }
}

//var_dump($control);

if ($control) {


				?>
				<script>
				var answer=alert('Datos Grabados Correctamente')
				</script> 
				<meta http-equiv='refresh' content="0; URL=alumno.php?dni=<?=$dni?>">
				<? 

				
}
else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=alumno.php?dni=<?=$dni?>'>
				<? 
}					

} // Fin alterar la BD

?>
</html>
<? } ?>