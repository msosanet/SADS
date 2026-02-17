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


	}
</script>

</script> 
</head>
<?

include 'header.php';
$conexion = conectar ();


// Obtenemos y traducimos el nombre del día
$diax=date("l");
if ($diax=="Monday") $diax=1;
if ($diax=="Tuesday") $diax=2;
if ($diax=="Wednesday") $diax=3;
if ($diax=="Thursday") $diax=4;
if ($diax=="Friday") $diax=5;
if ($diax=="Saturday") $diax=6;
if ($diax=="Sunday") $diax=7;
	$semana=date('W');
	
	if ($semana%2==0){ $ver=2;	}
	else{	$ver=1; }

		$result3 = mysql_query ("SELECT * FROM menu WHERE dia = $diax and semana=$ver");
		$fila3 = mysql_fetch_array($result3);


?>

<body onload="document.mio.dni.focus()">

<form method="GET" action="ingreso.php">

<div align="center">
	<table border="0" width="980" cellspacing="0" cellpadding="0" height="440" background="todo.jpg">
		<tr>
			<td>&nbsp;<p>&nbsp;</p>
			<p>&nbsp; </p>


			<div align="center">
				<table border="0" width="78%">
					<tr>
						<td width="34%" colspan="2">
						<p align="right"><font face="Arial" size="2"><b>DNI (sin puntos):</b>
						</font></td>
						<td width="65%" colspan="2">
						<p align="center">
						<input name="dni" autofocus type="text" size="20" style="float: left"></td>
					</tr>
					<tr>
						<td width="34%" colspan="2">&nbsp;</td>
						<td width="65%" colspan="2">&nbsp;</td>
					</tr>


					<tr>
						<td align="center">
						<p align="center">
						&nbsp;</td>
						<td align="center" width="25%">
						&nbsp;</td>
						<td align="center" width="19%">
						<input type="submit" value="Enviar" name="muestra2" style="float: right"></td>
						<td align="center" width="45%">
						&nbsp;</td>
					</tr>

					<tr>
						<td width="34%" colspan="2">&nbsp;</td>
						<td width="65%" colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td align="left" width="34%" colspan="2">&nbsp;</td>
						<td align="left" width="100%" colspan="2"><br><? echo $fila3[menu]; ?></td>
					</tr>
				</table>
			</div>
			<p>&nbsp;</p>
			<p>&nbsp;</td>
		</tr>
	</table>					</div>

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
	$semana=date('W');


// Obtenemos y traducimos el nombre del día
$diax=date("l");
if ($diax=="Monday") $diax=1;
if ($diax=="Tuesday") $diax=2;
if ($diax=="Wednesday") $diax=3;
if ($diax=="Thursday") $diax=4;
if ($diax=="Friday") $diax=5;
if ($diax=="Saturday") $diax=6;
if ($diax=="Sunday") $diax=7;
	
	if ($semana%2==0){ $ver=2;	}
	else{	$ver=1; }

	$rest1 = substr($dni, 0, 2);
	$rest2 = substr($dni, 2, 3);
	$rest3 = substr($dni, 5, 3);
	$dni_punto=$rest1.".".$rest2.".".$rest3;

	$result6 = mysql_query ("SELECT * FROM alumnos WHERE dni = '$dni_punto'");
	$fila6 = mysql_fetch_array($result6);

	$result2 = mysql_query ("SELECT * FROM alumno_comedor WHERE alumno = '$dni' and dia=$diax");
	$fila2 = mysql_fetch_array($result2);


	if (mysql_num_rows($result2)!=0)
	{

		$result3 = mysql_query ("SELECT * FROM menu WHERE dia = $diax and semana=$ver");
		$fila3 = mysql_fetch_array($result3);


				if (mysql_query ("INSERT INTO comedor VALUES (0,'$dni','$hoy','$hs',$fila3[id],1)"))
				{	
				?>
					<script>
					var answer=alert("INGRESE: <? echo $fila6["alumno"];?>")
					</script> 
				<? 
					
				}
				else 
				{	
					?>
					<script>
					var answer=alert("NO SE PUDO GRABAR EN LA BD ")
					</script> 
				<? 	
				}					
			
		?>  

<meta http-equiv="refresh" content="2;url=ingreso.php"> 
				
<? 

}

	else {	
				$result3 = mysql_query ("SELECT * FROM menu WHERE dia = $diax and semana=$ver");
				$fila3 = mysql_fetch_array($result3);
				mysql_query ("INSERT INTO comedor VALUES (0,'$dni','$hoy','$hs',$fila3[id],0)");
				?>
				<script>
				var answer=alert("EL ALUMNO: <? echo $fila6["alumno"];?> NO SE ENCUENTRA AUTORIZADO PARA INGRESAR AL COMEDOR")
				</script> 
				
	<? }	


 }

?> 


					</p>
					<p align="center">&nbsp;</td>
				</tr>


			</table>
			</div>
			<?
		
			?>

			</td>
		</tr>
	</table>
</div>



</form>



</body>

</html>


