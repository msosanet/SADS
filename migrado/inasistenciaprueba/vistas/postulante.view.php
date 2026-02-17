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

     if (trim($_POST["dni"]) == '') { $errordni = 1; $hayerrores = 1; };
     if (trim($_POST["apellido"]) == '') { $errorapellido = 1; $hayerrores = 1; };
     if (trim($_POST["nombre"]) == '') { $errornombre = 1; $hayerrores = 1; };
     if (trim($_POST["telefono"]) == '') { $errortel = 1; $hayerrores = 1; };


}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="postulante.php?nota=<? echo $nota?>&id=<? echo $id?>"></p>
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
					
					<p align="left" class="text1b">Alta de Postulante</p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p>
					<p align="left" class="text1b">Ofrecimiento Nº: <? echo $filatt2['numero'];?></p>
		<?php while ($filatt = mysql_fetch_array($resulta))
		{ ?>
					<p align="left" >Espacio: <? echo $filatt['descripcion'];?>&nbsp;&nbsp;&nbsp;Horario: <? echo $filatt['hs_cubrir'];?></p> <? } ?>

		<br><br><?php while ($filabb = mysql_fetch_array($postu))
		{ ?>
					<p align="center" class="text1b" >Postulante: <? echo $filabb['apellido'];?>&nbsp;<? echo $filabb['nombre'];?>&nbsp;&nbsp;Puntaje: <? echo $filabb['letra'];?> / <? echo $filabb['puntaje'];?></p> <? } ?>
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
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I. (sin puntos):</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="dni" size="8" maxlength="8" value="<?echo $_POST['dni']; ?>" />
							</td>
					
													<?
	  					if ($errorapellido==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Apellido:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="apellido" size="30" maxlength="30" value="<?echo $_POST['apellido']; ?>" />
							</td>
							
						</tr>
						<?
	  					if ($errornombre==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
						
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="nombre" size="30" maxlength="30" value="<?echo $_POST['nombre']; ?>" />
							</td>												
						<?
	  					if ($errortel==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Telefono:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="telefono" size="30" maxlength="30" value="<?echo $_POST['telefono']; ?>" />
							</td>

						
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
<input name="nota" type="hidden" value ="<?php echo $nota ?>"/>
<input name="id" type="hidden" value ="<?php echo $id ?>"/>

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
	$telefono=$_POST['telefono'];
	$nota=$_POST['nota'];
	$id=$_POST['id'];
	
	
$r1 = mysql_query ("SELECT * FROM docentes_junta WHERE numdoc = '$dni'");
$f1 = mysql_fetch_array($r1);


$r2 = mysql_query ("SELECT * FROM 1090_18inscripcion_junta WHERE doc_codigo = $f1[doc_codigo] and cod_espacio='$id'");
$f2 = mysql_fetch_array($r2);



$letra=$f2[caracter];
$puntaje=$f2[puntaje];


	if (mysql_query ("INSERT INTO tomas VALUES (0,$nota,$dni,'$nombre','$apellido','$puntaje','$letra','$telefono')"))
	{		

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=postulante.php?nota=<?php echo $nota?>&id=<?php echo $id?>'>
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

?>
</html>
<? } ?>
