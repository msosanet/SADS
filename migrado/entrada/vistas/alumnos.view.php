<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="../csjs/style.css" />
<link rel="stylesheet" href="menu_style.css" type="text/css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<title>SID</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 







</script> 
</head>
<?


// Obtenemos y traducimos el nombre del día
$diax=date("l");
if ($diax=="Monday") $diax=1;
if ($diax=="Tuesday") $diax=2;
if ($diax=="Wednesday") $diax=3;
if ($diax=="Thursday") $diax=4;
if ($diax=="Friday") $diax=5;
if ($diax=="Saturday") $diax=6;
if ($diax=="Sunday") $diax=7;

include 'header.php';
$conexion = conectar ();







?>

<body onload="document.mio.dni.focus()">



<form method="GET" action="alumnos.php" name="mio">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980">


				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Ingresar la Entrada de alumnos - Ingrese el N&uacute;mero de Documento (Sin puntos).</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="59%">
						<tr>
							<td align="right"><font size="5">DNI:</font></td>
							<td align="right">&nbsp;<input type="text" name="dni" id="dni" size="20" maxlength="10" value="" style="font-size: 18pt" /></td>
							<td align="right" rowspan="3" width="389" background="teclado.jpg">
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						
						<tr>
							<td align="right" colspan="2">
							<p align="center">
<input type="submit" value="   Ingresar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; float:center; font-size:14pt" />						</tr>
					</table>
					</div>

</font>
					<?
if (isset($_GET['muestra2']))
{ 


	$dni=$_GET['dni'];

	$hora=getdate();
	$hs=$hora[hours].":".$hora[minutes].":".$hora[seconds];

	$hoyx=date("Y/m/d");
	$hoy = str_replace("/","-",$hoyx);
	$dia=date("d");
	$lic="-";
	
$rest1 = substr($dni, 0, 2);
$rest2 = substr($dni, 2, 3);
$rest3 = substr($dni, 5, 3);

$rest4 =$rest1.".".$rest2.".".$rest3;

	$result2 = mysql_query ("SELECT * FROM alumnos WHERE dni = '$rest4'");
	$fila2 = mysql_fetch_array($result2);


//	if (mysql_num_rows($result2)!=0)
//	{



		

				$tipo="Entrada";
				$hs2=$fila3[hs_entrada];
				$etiqueta="etiqueta.png";

				if (mysql_query ("INSERT INTO diario_alu VALUES ('$dni','$hs','$diax','$lic','$hoy','$tipo')"))
				{	
					
				}
				else 
				{	
					?>
					<script>
					var answer=alert("No se pudo grabar en la BD, contactese con el personal Administrativo ")
					</script> 
				<? 	
				}					
			
		?> 
<span style="font-size: 17pt"><?echo $fila2[alumno];?>,&nbsp;curso:<?echo $fila2[curso];?>º&nbsp;<?echo $fila2[division];?>º



<meta http-equiv="refresh" content="4;url=i_sid.php"> 

				
<? 

//}

//	else {	
//				?>
//				<script>
//				var answer=alert("El Alumno no se encuentra cargado, solicite la carga a los Administrativos del sector")
//				</script> 
				
	<? }	


 //}

?> 


					</p>
					<p align="center">&nbsp;</td>
				</tr>


			</table>
			</div>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>



</form>



</body>

</html>
<? } ?>

