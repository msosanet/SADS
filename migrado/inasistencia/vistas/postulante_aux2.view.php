<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

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

$resulta2 = mysql_query ("SELECT * FROM ofrecimiento-2020 WHERE numero = $nota");

$filatt2 = mysql_fetch_array($resulta2);


$ress = mysql_query ("SELECT * FROM 1090_18espacios_junta WHERE numero = $filatt2[id_junta]");

$resu = mysql_fetch_array($ress);





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

<form method="POST" action="postulante_aux2.php?nota=<? echo $nota?>&id=<? echo $id?>"></p>
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
					
					<p align="left" class="text1b">Alta de Postulante</p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p>
					<p align="left" class="text1b">Ofrecimiento Nº: <? echo $filatt2['numero'];?></p>
		<?php while ($filatt = mysql_fetch_array($resulta))
		{ ?>
					<p align="left" >Espacio: <? echo $resu['descripcion'];?>&nbsp;&nbsp;&nbsp;Horario: <? echo $filatt['hs_cubrir'];?>   Curso:<? echo $filatt['curso'];?>/<? echo $filatt['divi'];?></p> <? } ?>

		<br><br><?php while ($filabb = mysql_fetch_array($postu))
		{ $inc=$inc+1; ?>
					<p align="left" ><b><? echo $inc;?>) Postulante: <? echo $filabb['apellido'];?>&nbsp;<? echo $filabb['nombre'];?>&nbsp;&nbsp;Puntaje: <? echo $filabb['letra'];?> / <? echo $filabb['puntaje'];?> <a href="mod_puntaje.php?actor=<?php echo $filabb[id]?>&codigo=<?php echo $filabb[codigo]?>&id=<?php echo $filatt2[id_junta]?>" target="_self"></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;editar</a><a href="alta_docente_info.php?nota=<?php echo $filabb[id]?>" target="_self"></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ingreso</a></p> <? } ?>
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
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Escanear DNI:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="dni" size="100" maxlength="100" value="" autofocus/>
							</td>
					


							<td width="174" bgcolor="#EAEAEA" align="right">
							</td>
							
						</tr>

						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>


						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><a href="llamado.php?mesa=<?php echo $nota?>&dni=<?php echo $filatt2[descripcion]?>" target="_blank">IMPRIMIR ACTA</a></td>
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
	$tunning = explode("\"", $dni);




	$nombre=$tunning[2];
	$apellido=$tunning[1];
	$dni2=$tunning[4];
	$telefono="5555";
	$nota=$_POST['nota'];


$r1 = mysql_query ("SELECT * FROM docentes_junta WHERE numdoc = '$dni2'");

$f1 = mysql_fetch_array($r1);



$r2 = mysql_query ("SELECT * FROM 1090_18inscripcion_junta WHERE doc_codigo = $f1[doc_codigo] and cod_espacio='$id'");

$consulta2 = mysql_num_rows($r2);

$f2 = mysql_fetch_array($r2);


$x2 = mysql_query ("SELECT * FROM 142_19inscripcion WHERE doc_codigo = $f1[doc_codigo] and cod_espacio='$id'");

$consulta1 = mysql_num_rows($x2);

$x2 = mysql_fetch_array($x2);



if($consulta1 > 0 and $consulta2 > 0 )
	{
		$letra2=$x2[caracter];
		$puntaje2=$x2[puntaje];
		$letra1=$f2[caracter];
		$puntaje1=$f2[puntaje];
		if($letra2 < $letra1 )
		{
			$letra=$letra2;
			$puntaje=$puntaje2;
		}
		if($letra2 == $letra1 )
		{
			if($puntaje2 >= $puntaje1 )
			{
				$letra=$letra2;
				$puntaje=$puntaje2;
			}
			else
			{
				$letra=$letra2;
				$puntaje=$puntaje1;
			}

		}
		if($letra1 < $letra2 )
		{
			$letra=$letra1;
			$puntaje=$puntaje1;
		}
	
	}

if($consulta1 <= 0 )
	{
		$letra=$f2[caracter];
		$puntaje=$f2[puntaje];

	}

if($consulta2 <= 0 )
	{
		$letra=$x2[caracter];
		$puntaje=$x2[puntaje];

	}





$apellido=addslashes($apellido);
$nombre=addslashes($nombre);

	
	




	if (mysql_query ("INSERT INTO tomas VALUES (0,$nota,$dni2,'$nombre','$apellido','$puntaje','$letra','$telefono')"))
	{		

				?>

				<meta http-equiv='refresh' content='0; URL=postulante_aux2.php?nota=<?php echo $nota?>&id=<?php echo $id?>'>
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
