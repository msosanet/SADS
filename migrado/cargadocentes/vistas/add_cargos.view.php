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
include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];



$usuario=$_SESSION['usuario'];
$dni = $_SESSION['docente']; 

$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

$resultcurso = mysql_query ("SELECT * FROM curso order by descripcion"); 


$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"])) {
        
     if ((trim($_POST["le1"]) != '' or trim($_POST["le2"]) != '') and (strlen($_POST["le1"]) < 2 or strlen($_POST["le2"]) < 2)) { $errorl1 = 1; $hayerrores = 1; };
     if ((trim($_POST["me1"]) != '' or trim($_POST["me2"]) != '') and (strlen($_POST["me1"]) < 2 or strlen($_POST["me2"]) < 2)) { $errorm1 = 1; $hayerrores = 1; };
     if ((trim($_POST["mie1"]) != '' or trim($_POST["mie2"]) != '') and (strlen($_POST["mie1"]) < 2 or strlen($_POST["mie2"]) < 2)) { $errorlmi1 = 1; $hayerrores = 1; };
     if ((trim($_POST["je1"]) != '' or trim($_POST["je2"]) != '') and (strlen($_POST["je1"]) < 2 or strlen($_POST["je2"]) < 2)) { $errorj1 = 1; $hayerrores = 1; };
     if ((trim($_POST["ve1"]) != '' or trim($_POST["ve2"]) != '') and (strlen($_POST["ve1"]) < 2 or strlen($_POST["ve2"]) < 2)) { $errorv1 = 1; $hayerrores = 1; };
     if ((trim($_POST["ls1"]) != '' or trim($_POST["ls2"]) != '') and (strlen($_POST["ls1"]) < 2 or strlen($_POST["ls2"]) < 2)) { $errorl2 = 1; $hayerrores = 1; };
     if ((trim($_POST["ms1"]) != '' or trim($_POST["ms2"]) != '') and (strlen($_POST["ms1"]) < 2 or strlen($_POST["ms2"]) < 2)) { $errorm2 = 1; $hayerrores = 1; };
     if ((trim($_POST["mis1"]) != '' or trim($_POST["mis2"]) != '') and (strlen($_POST["mis1"]) < 2 or strlen($_POST["mis2"]) < 2)) { $errormi2 = 1; $hayerrores = 1; };
     if ((trim($_POST["js1"]) != '' or trim($_POST["js2"]) != '') and (strlen($_POST["js1"]) < 2 or strlen($_POST["js2"]) < 2)) { $errorj2 = 1; $hayerrores = 1; };
     if ((trim($_POST["vs1"]) != '' or trim($_POST["vs2"]) != '') and (strlen($_POST["vs1"]) < 2 or strlen($_POST["vs2"]) < 2)) { $errorv2 = 1; $hayerrores = 1; };

 	if ((trim($_POST["le1"]) == '' ) and (trim($_POST["le2"]) == '' ) and (trim($_POST["me1"]) == '' ) and (trim($_POST["me2"]) == '' ) and (trim($_POST["mie1"]) == '' ) and (trim($_POST["mie2"]) == '' ) and (trim($_POST["je1"]) == '' ) and (trim($_POST["je2"]) == '' ) and (trim($_POST["ve1"]) == '' ) and (trim($_POST["ve2"]) == '' )) { $error = 1; $hayerrores = 1; };
 	if ((trim($_POST["ls1"]) == '' ) and (trim($_POST["ls2"]) == '' ) and (trim($_POST["ms1"]) == '' ) and (trim($_POST["ms2"]) == '' ) and (trim($_POST["mis1"]) == '' ) and (trim($_POST["mis2"]) == '' ) and (trim($_POST["js1"]) == '' ) and (trim($_POST["js2"]) == '' ) and (trim($_POST["vs1"]) == '' ) and (trim($_POST["vs2"]) == '' )) { $error = 1; $hayerrores = 1; };

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="add_cargos.php">
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
include 'menuppal2.php';

?>	
				<tr>
				

					<td>
					<br>
					<p align="left" class="text1b">Alta de Cargos de: <?echo $filadocente[apellido];?>,&nbsp;<?echo $filadocente[nombre];?> </p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left"><br><br><? if($error) { echo "<h4><font color=red>Datos vacios o incompletos</font></h4>";} ?><br><br>
Se deben cargar los siguiente datos la cantidad de veces por cada Cargo que usted tenga. <br>
complete el horario con el formato 07:00 / 13:20 / 2 dígitos para la hs y 2 para los minutos HH:MM
					<br><br>
			Cargo: <select size="1" name="cargo">
			<?	WHILE ($myrow6 = mysql_fetch_array($resultcurso))
				{			
					if($_POST['cargo']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion] </option>";
				}
		?></select>
<br><br>
					<div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Miercoles</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>
	</tr>
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<?
	  		if ($errorl1==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="le1" size="2" maxlength="2" value="<?echo $_POST['le1']; ?>" />:<input type="text" name="le2" size="2" maxlength="2" value="<?echo $_POST['le2']; ?>" /></font></td>
		<?
	  		if ($errorm1==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="me1" size="2" maxlength="2" value="<?echo $_POST['me1']; ?>" />:<input type="text" name="me2" size="2" maxlength="2" value="<?echo $_POST['me2']; ?>" /></font></td>
		<?
	  		if ($errormi1==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="mie1" size="2" maxlength="2" value="<?echo $_POST['mie1']; ?>" />:<input type="text" name="mie2" size="2" maxlength="2" value="<?echo $_POST['mie2']; ?>" /></font></td>
		<?
	  		if ($errorj1==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="je1" size="2" maxlength="2" value="<?echo $_POST['je1']; ?>" />:<input type="text" name="je2" size="2" maxlength="2" value="<?echo $_POST['je2']; ?>" /></font></td>
		<?
	  		if ($errorv1==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="ve1" size="2" maxlength="2" value="<?echo $_POST['ve1']; ?>" />:<input type="text" name="ve2" size="2" maxlength="2" value="<?echo $_POST['ve2']; ?>" /></font></td>
	</tr>
	<tr>
		<?
	  		if ($errorl2==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="text" name="ls1" size="2" maxlength="2" value="<?echo $_POST['ls1']; ?>" />:<input type="text" name="ls2" size="2" maxlength="2" value="<?echo $_POST['ls2']; ?>" /></font></td>
				<?
	  		if ($errorm2==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="text" name="ms1" size="2" maxlength="2" value="<?echo $_POST['ms1']; ?>" />:<input type="text" name="ms2" size="2" maxlength="2" value="<?echo $_POST['ms2']; ?>" /></font></td>
				<?
	  		if ($errormi2==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="text" name="mis1" size="2" maxlength="2" value="<?echo $_POST['mis1']; ?>" />:<input type="text" name="mis2" size="2" maxlength="2" value="<?echo $_POST['mis2']; ?>" /></font></td>
				<?
	  		if ($errorj2==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="text" name="js1" size="2" maxlength="2" value="<?echo $_POST['js1']; ?>" />:<input type="text" name="js2" size="2" maxlength="2" value="<?echo $_POST['js2']; ?>" /></font></td>
				<?
	  		if ($errorv2==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="text" name="vs1" size="2" maxlength="2" value="<?echo $_POST['vs1']; ?>" />:<input type="text" name="vs2" size="2" maxlength="2" value="<?echo $_POST['vs2']; ?>" /></font></td>
	</tr>
	<tr>
		<td width="834" bgcolor="#EAEAEA" align="center" colspan="5">&nbsp;</td>
	</tr>
						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="5">
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
	$cargo=$_POST['cargo'];
	$lunes=$_POST['le1'].":".$_POST['le2'];
	$martes=$_POST['me1'].":".$_POST['me2'];
	$miercoles=$_POST['mie1'].":".$_POST['mie2'];
	$jueves=$_POST['je1'].":".$_POST['je2'];
	$viernes=$_POST['ve1'].":".$_POST['ve2'];
	$lunes2=$_POST['ls1'].":".$_POST['ls2'];
	$martes2=$_POST['ms1'].":".$_POST['ms2'];
	$miercoles2=$_POST['mis1'].":".$_POST['mis2'];
	$jueves2=$_POST['js1'].":".$_POST['js2'];
	$viernes2=$_POST['vs1'].":".$_POST['vs2'];
	$dni=$_POST['dni'];

if (trim($lunes) <> '' OR trim($lunes2) <> '')	{
								mysql_query ("INSERT INTO hs_cargos VALUES (0,'$dni',1,'$lunes','$lunes2',$cargo, NOW())");
							}
if (trim($martes) <> '' OR trim($martes2) <> '')	{
								mysql_query ("INSERT INTO hs_cargos VALUES (0,'$dni',2,'$martes','$martes2',$cargo, NOW())");
							}
if (trim($miercoles) <> '' OR trim($miercoles2) <> '')	{
								mysql_query ("INSERT INTO hs_cargos VALUES (0,'$dni',3,'$miercoles','$miercoles2',$cargo, NOW())");
							}
if (trim($jueves) <> '' OR trim($jueves2) <> '')	{
								mysql_query ("INSERT INTO hs_cargos VALUES (0,'$dni',4,'$jueves','$jueves2',$cargo, NOW())");
							}
if (trim($viernes) <> '' OR trim($viernes2) <> '')	{
								mysql_query ("INSERT INTO hs_cargos VALUES (0,'$dni',5,'$viernes','$viernes2',$cargo, NOW())");
							}

	
?>
				<script>
				var answer=alert("Se grabo en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 

}
					
?>
</html>
<? } ?>
