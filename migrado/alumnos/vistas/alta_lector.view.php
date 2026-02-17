<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

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

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$nota=$_GET['nota'];
$id=$_GET['id'];

$resulta2 = mysql_query ("SELECT * FROM ofrecimiento WHERE numero = $nota");

$filatt2 = mysql_fetch_array($resulta2) ;

$resulta = mysql_query ("SELECT * FROM espacio WHERE ofrecimiento = $nota");

$postu = mysql_query ("SELECT * FROM tomas WHERE codigo = $nota order by letra,puntaje DESC");



$errordoc = 0;
  $hayerrores = 0;
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

<form method="POST" action="alta_lector.php?nota=<? echo $nota?>&id=<? echo $id?>"></p>
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
$inc=0;
?>	
				<tr>
				

					<td>
					
					<p align="left" class="text1b">Alta de Alumno con lector</p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p>
					<div align="left">
					
<br>

<br>					
<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						
												<?
	  					if ($errordni==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="200" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Escanear DNI ALUMNO:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="alumno" size="90" maxlength="90" value="" autofocus/>
							</td>
					


							<td width="174" bgcolor="#EAEAEA" align="right">
							</td>
							
						</tr>
						<tr>
						
												<?
	  					if ($errordni==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Escanear DNI PADRE:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="padre" size="90" maxlength="90" value="" autofocus/>
							</td>
					


							<td width="174" bgcolor="#EAEAEA" align="right">
							</td>
							
						</tr>
						<tr>
						
												<?
	  					if ($errordni==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Escanear DNI MADRE:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="madre" size="90" maxlength="90" value="" autofocus/>
							</td>
					


							<td width="174" bgcolor="#EAEAEA" align="right">
							</td>
							
						</tr>
						<tr>
						
												<?
	  					if ($errordni==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Escanear DNI TUTOR:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="tutor" size="90" maxlength="90" value="" autofocus/>
							</td>
					


							<td width="174" bgcolor="#EAEAEA" align="right">
							</td>
							
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
<input name="nota" type="hidden" value ="<?php echo $nota ?>"/>
<input name="id" type="hidden" value ="<?php echo $id ?>"/>

	</form>
</div>
</body>
<?
}
else
{


//***************** alumno**************

	$alumno=$_POST['alumno'];
	$tunning = explode("\"", $alumno);
	$nombre=$tunning[2];
	$apellido=$tunning[1];
	$dni=$tunning[4];
	$sexo=$tunning[3];
	$fnac=$tunning[6];
	$fingreso=date('Y-m-d');
	$dni=str_replace("M", "0", $dni);
	$dni=str_replace("F", "0", $dni);
	$cuil = substr($tunning[8].0,2) . $dni . substr($tunning[8],0,-1);

	$originalDate = $fnac;
	$fnac = date("Y/m/d", strtotime($originalDate));

//***************** padre**************


	$padre=$_POST['padre'];
	$tunning2 = explode("\"", $padre);
	$nombre2=$tunning2[2];
	$apellido2=$tunning2[1];
	$dni2=$tunning2[4];
	$dni2=str_replace("M", "0", $dni2);
	$dni2=str_replace("F", "0", $dni2);


//***************** madre**************


	$madre=$_POST['madre'];
	$tunning3 = explode("\"", $madre);
	$nombre3=$tunning3[2];
	$apellido3=$tunning3[1];
	$dni3=$tunning3[4];
	$dni3=str_replace("M", "0", $dni3);
	$dni3=str_replace("F", "0", $dni3);

//***************** tutor**************


	$tutor=$_POST['tutor'];
	$tunning4 = explode("\"", $tutor);
	$nombre4=$tunning4[2];
	$apellido4=$tunning4[1];
	$dni4=$tunning4[4];
	$dni4=str_replace("M", "0", $dni4);
	$dni4=str_replace("F", "0", $dni4);



$apellido=addslashes($apellido);
$nombre=addslashes(ucwords(strtolower($nombre)));
$apellido2=addslashes($apellido2);
$nombre2=addslashes(ucwords(strtolower($nombre2)));
$apellido3=addslashes($apellido3);
$nombre3=addslashes(ucwords(strtolower($nombre3)));
$apellido4=addslashes($apellido4);
$nombre4=addslashes(ucwords(strtolower($nombre4)));

// echo "<p>" . var_export($GLOBALS,true) ."</p>";

$control=0;

//$nuevo_estudiante = "INSERT INTO alumno VALUES ($dni,'$apellido','$nombre','$fnac','','','','','','','$sexo','','$fingreso','','','')";

if (mysql_query ("INSERT INTO alumno VALUES ($dni,'$apellido','$nombre','$fnac','','','','','','','$sexo','','$fingreso','','','','','','',0,false)"))
//if (1)
	{
		$control=10;
	}


$resultdocente2 = mysql_query ("SELECT * FROM familiares where dni=$dni2");
$yaesta2 = mysql_num_rows($resultdocente2); 

if ($yaesta2 == 0)
{

	if (mysql_query ("INSERT INTO familiares VALUES ($dni2,'$nombre2','$apellido2','',0,'',0,'')"))
	{	
	mysql_query ("INSERT INTO alu_fami VALUES ($dni,$dni2,'P')"); 
	$control=1;

	}		
}
else
{	
	mysql_query ("INSERT INTO alu_fami VALUES ($dni,$dni2,'P')"); 
	$control=1;

	}



$resultdocente3 = mysql_query ("SELECT * FROM familiares where dni=$dni3");
$yaesta3 = mysql_num_rows($resultdocente3); 

if ($yaesta3 == 0)
{

	if (mysql_query ("INSERT INTO familiares VALUES ($dni3,'$nombre3','$apellido3','',0,'',0,'')"))
	{	
	mysql_query ("INSERT INTO alu_fami VALUES ($dni,$dni3,'M')"); 
	$control=1;

	}		
}
else
{	
	mysql_query ("INSERT INTO alu_fami VALUES ($dni,$dni3,'M')"); 
	$control=1;

	}

$resultdocente4 = mysql_query ("SELECT * FROM familiares where dni=$dni4");
$yaesta4 = mysql_num_rows($resultdocente4); 

if ($yaesta4 == 0)
{

	if (mysql_query ("INSERT INTO familiares VALUES ($dni4,'$nombre4','$apellido4','',0,'',0,'')"))
	{	
	mysql_query ("INSERT INTO alu_fami VALUES ($dni,$dni4,'T')"); 
	$control=1;

	}		
}
else
{	
	mysql_query ("INSERT INTO alu_fami VALUES ($dni,$dni4,'T')"); 
	$control=1;

}


if ($control==1){

				?>
				<script>
				var answer=alert("Se ingreso correctamente")
				</script>
				<meta http-equiv='refresh' content='0; URL=alta_lector.php?'>
				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD, puede que ya exista en la Base")
				</script> 
				<meta http-equiv='refresh' content='100; URL=alta_lector.php?'>
				<? 
		}
			
}

?>
</html>
<? } ?>
