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



<form method="GET" action="constancia.php" name="mio">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980">


				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left"><font size="5">Pedido de Constancia.</font> - Ingrese su N&uacute;mero de Documento (Sin puntos).</p>
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
	$hoyx=date("Y/m/d");

	

				if (mysql_query ("INSERT INTO constancias VALUES (0,'$dni','$hoyx')"))
				{	
					?><font size="5">GRABADO CORRECTAMENTE</font><?
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

<meta http-equiv="refresh" content="2;url=i_sid.php"> 
<? } ?>


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
