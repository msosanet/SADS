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
<title>MODIFICAR HORARIO CARGO</title>

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


<?
include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];

$dni=$_GET['actor'];

$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente);


$resulths = mysql_query ("SELECT * FROM horarios where dni='$dni'");
$filahs = mysql_fetch_array($resulths);  


$result = mysql_query ("SELECT * FROM horarios where dni='$dni' and cod_dia=1");
$fila = mysql_fetch_array($result); 

$result2 = mysql_query ("SELECT * FROM horarios where dni='$dni' and cod_dia=2");
$fila2 = mysql_fetch_array($result2); 

$result3 = mysql_query ("SELECT * FROM horarios where dni='$dni' and cod_dia=3");
$fila3 = mysql_fetch_array($result3); 

$result4 = mysql_query ("SELECT * FROM horarios where dni='$dni' and cod_dia=4");
$fila4 = mysql_fetch_array($result4); 

$result5 = mysql_query ("SELECT * FROM horarios where dni='$dni' and cod_dia=5");
$fila5 = mysql_fetch_array($result5); 

$result6 = mysql_query ("SELECT * FROM horarios where dni='$dni' and cod_dia=6");
$fila6 = mysql_fetch_array($result6); 

$resultcurso = mysql_query ("SELECT * FROM curso where codigo = $filahs[cod_curso]"); 
$listacurso = mysql_query ("SELECT * FROM curso order by descripcion");

$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"])) {
        
	  

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="mod_cargos2.php">
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
					
					<p align="left" class="text1b">Horarios Registrados en Cargos de: <?echo $filadocente[apellido];?>,&nbsp;<?echo $filadocente[nombre];?> </p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
<br><br>
			<!-- Cargo: <select size="1" name="cargo">
			<!-- ?	WHILE ($myrow6 = mysql_fetch_array($resultcurso))
				{			
					if($_POST['cargo']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion] </option>";
				}
		?></select -->  

<!-- LISTA DE CARGOS *************************************************************************** -->                    
			Cargo: <select size="1" name="cargo">
			<?	WHILE ($cargo = mysql_fetch_array($listacurso))
				{			
					if ($cargo[codigo] == $filahs[cod_curso]) { $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value = $cargo[codigo] $seleccionado> $cargo[descripcion] </option>";
				}
		?></select>
        

<!-- FIN LISTA DE CARGOS *************************************************************************** -->    
<br><br>
<div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr bgcolor="#CCCCCC" align="center">
		<td><b>LUNES</b></td>
		<td><b>MARTES</b></td>
		<td><b>MIÉRCOLES</b></td>
		<td><b>JUEVES</b></td>
		<td><b>VIERNES</b></td>
		<td><b>SÁBADO</b></td>
	</tr>

	<tr bgcolor="#E8E8E8">
		<?
	  		if ($errorle==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="le" size="8" maxlength="8" value="<?echo $fila[hs_entrada]; ?>" /></font></td>
		<?
	  		if ($errorme==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="me" size="8" maxlength="8" value="<?echo $fila2[hs_entrada]; ?>" /></font></td>
		<?
	  		if ($errormie==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="mie" size="8" maxlength="8" value="<?echo $fila3[hs_entrada]; ?>" /></font></td>
		<?
	  		if ($errorje==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="je" size="8" maxlength="8" value="<?echo $fila4[hs_entrada]; ?>" /></font></td>
		<?
	  		if ($errorve==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="ve" size="8" maxlength="8" value="<?echo $fila5[hs_entrada]; ?>" /></font></td>
<?
	  		if ($errorve==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="sa" size="8" maxlength="8" value="<?echo $fila6[hs_entrada]; ?>" /></font></td>

	</tr>
	<tr bgcolor="#E8E8E8">
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="ls" size="8" maxlength="8" value="<?echo $fila[hs_salida]; ?>" /></font></td>
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="ms" size="8" maxlength="8" value="<?echo $fila2[hs_salida]; ?>" /></font></td>
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="mis" size="8" maxlength="8" value="<?echo $fila3[hs_salida]; ?>" /></font></td>
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="js" size="8" maxlength="8" value="<?echo $fila4[hs_salida]; ?>" /></font></td>
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="vs" size="8" maxlength="8" value="<?echo $fila5[hs_salida]; ?>" /></font></td>
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="sab" size="8" maxlength="8" value="<?echo $fila6[hs_salida]; ?>" /></font></td>
	</tr>
		

</table>
<br>
<p align="center"><input type="submit" value="     Modificar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" />

</div>
					<p align="right">&nbsp;</div>
<br>
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
	$lunes=$_POST['le'];
	$martes=$_POST['me'];
	$miercoles=$_POST['mie'];
	$jueves=$_POST['je'];
	$viernes=$_POST['ve'];
	$sabado=$_POST['sa'];
	$lunes2=$_POST['ls'];
	$martes2=$_POST['ms'];
	$miercoles2=$_POST['mis'];
	$jueves2=$_POST['js'];
	$viernes2=$_POST['vs'];
	$sabado2=$_POST['sab'];
	$dni=$_POST['dni'];

         
		mysql_query ("UPDATE horarios SET cargo = '$cargo' WHERE dni='$dni'");
		mysql_query ("UPDATE horarios SET hs_entrada = '$lunes', hs_salida = '$lunes2' WHERE dni='$dni' and cod_dia=1");
		mysql_query ("UPDATE horarios SET hs_entrada = '$martes', hs_salida = '$martes2' WHERE dni='$dni' and cod_dia=2");
        mysql_query ("UPDATE horarios SET hs_entrada = '$miercoles', hs_salida = '$miercoles2' WHERE dni='$dni' and cod_dia=3");
        mysql_query ("UPDATE horarios SET hs_entrada = '$jueves', hs_salida = '$jueves2' WHERE dni='$dni' and cod_dia=4");
        mysql_query ("UPDATE horarios SET hs_entrada = '$viernes', hs_salida = '$viernes2' WHERE dni='$dni' and cod_dia=5"); 
		mysql_query ("UPDATE horarios SET hs_entrada = '$sabado', hs_salida = '$sabado2' WHERE dni='$dni' and cod_dia=6");
        					
//RESTOS DEL SCRIPT ORIGINAL
//if (trim($martes) <> '' OR trim($martes2) <> '')	{
								//							}
//if (trim($miercoles) <> '' OR trim($miercoles2) <> '')	{								
				//			}
//if (trim($jueves) <> '' OR trim($jueves2) <> '')	{
							//	}
//if (trim($viernes) <> '' OR trim($viernes2) <> '')	{							
//							}
//if (trim($sabado) <> '' OR trim($sabado2) <> '')	{
//							}
	
?>
				<script>
				var answer=alert("Se actualizó en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<?echo $dni;?>'>
				<? 

}
					
?>
</html>
<? } ?>
