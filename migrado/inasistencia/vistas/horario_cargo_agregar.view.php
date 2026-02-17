<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css" />
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
$dni=$_GET['actor'];

$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

$resultcurso = mysql_query ("SELECT * FROM curso order by descripcion"); 


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
					
					<p align="left" class="titulo">Horarios registrados de: <font style="color: #CC6633"><? echo $filadocente[apellido] . ", " . $filadocente[nombre]; ?></font> </p>
                    <br>

					
<!-- ******************* NUEVA PROPUESTA DE HORARIO ************************* -->            
<div align="center" style="width: 800px; background-color: #ddcccc">



<table border="0" width="800" bordercolor="#dddddd" cellspacing="0"><!-- EMPIEZA CUADRO DE HORARIOS -->
   <tr>
       <td colspan="5" align="center" class="text1b" bgcolor="#bb6666">HORARIO DECLARADO POR <? echo $filadocente[apellido] . ", " . $filadocente[nombre]; ?>
       </td>
   
   </td>
   <tr>
        <td valign="top"> 
<? 
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="150" border="1" cellspacing="0"><!-- HORARIOS DEL LUNES -->

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>LUNES</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==1) 
							{ echo "<td align='center' style='background: white'>" . substr($horariodato[hs_entrada], 0, 5) . " a " . substr($horariodato[hs_salida], 0, 5); } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table><!-- FIN HORARIOS DEL LUNES --> 
        </td>
        <td valign="top">
<? 
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="150" border="1" cellspacing="0"><!-- HORARIOS DEL MARTES -->

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>MARTES</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==2) 
							{ echo "<td align='center' style='background: white'>" . substr($horariodato[hs_entrada], 0, 5) . " a " . substr($horariodato[hs_salida], 0, 5); } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table><!-- FIN HORARIOS DEL MARTES --> 
        </td>
        <td valign="top"><!-- HORARIOS DEL MIÃ‰RCOLES -->
<?
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="150" border="1" cellspacing="0">

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>MIÃ‰RCOLES</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==3) 
							{ echo "<td align='center' style='background: white'>" . substr($horariodato[hs_entrada], 0, 5) . " a " . substr($horariodato[hs_salida], 0, 5); } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table> 
        </td><!-- FIN HORARIOS DEL MIÃ‰RCOLES -->
        
        
        <td valign="top"><!-- HORARIOS DEL JUEVES -->
<?
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="150" border="1" cellspacing="0">

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>JUEVES</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==4) 
							{ echo "<td align='center' style='background: white'>" . substr($horariodato[hs_entrada], 0, 5) . " a " . substr($horariodato[hs_salida], 0, 5); } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table> 
        </td><!-- FIN HORARIOS DEL JUEVES -->
        
        
        <td valign="top"><!-- HORARIOS DEL VIERNES -->
<? 
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="150" border="1" cellspacing="0">

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>VIERNES</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==5) 
							{ echo "<td align='center' style='background: white'>" . substr($horariodato[hs_entrada], 0, 5) . " a " . substr($horariodato[hs_salida], 0, 5); } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table> 
        </td><!-- FIN HORARIOS DEL VIERNES -->
        
    </tr> 
</table>  
<p class="text1b"><a href="add_cargos.php?actor=<? echo $actor; ?>">AGREGAR HORARIO DE CARGO</a></p>
<br>
</div> 

<!-- ******************* FIN NUEVA PROPUESTA DE HORARIO ************************* -->     
                          
                    
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
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
	  		if ($errorle==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="le" size="5" maxlength="5" value="<?echo $_POST['le']; ?>" /></font></td>
		<?
	  		if ($errorme==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="me" size="5" maxlength="5" value="<?echo $_POST['me']; ?>" /></font></td>
		<?
	  		if ($errormie==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="mie" size="5" maxlength="5" value="<?echo $_POST['mie']; ?>" /></font></td>
		<?
	  		if ($errorje==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="je" size="5" maxlength="5" value="<?echo $_POST['je']; ?>" /></font></td>
		<?
	  		if ($errorve==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="ve" size="5" maxlength="5" value="<?echo $_POST['ve']; ?>" /></font></td>
	</tr>
	<tr>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="text" name="ls" size="5" maxlength="5" value="<?echo $_POST['ls']; ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="text" name="ms" size="5" maxlength="5" value="<?echo $_POST['ms']; ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="text" name="mis" size="5" maxlength="5" value="<?echo $_POST['mis']; ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="text" name="js" size="5" maxlength="5" value="<?echo $_POST['js']; ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="text" name="vs" size="5" maxlength="5" value="<?echo $_POST['vs']; ?>" /></font></td>
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
	$lunes=$_POST['le'];
	$martes=$_POST['me'];
	$miercoles=$_POST['mie'];
	$jueves=$_POST['je'];
	$viernes=$_POST['ve'];
	$lunes2=$_POST['ls'];
	$martes2=$_POST['ms'];
	$miercoles2=$_POST['mis'];
	$jueves2=$_POST['js'];
	$viernes2=$_POST['vs'];
	$dni=$_POST['dni'];

if (trim($lunes) <> '' OR trim($lunes2) <> '')	{
								mysql_query ("INSERT INTO horarios VALUES (0,'$dni',1,'$lunes','$lunes2',$cargo)");
							}
if (trim($martes) <> '' OR trim($martes2) <> '')	{
								mysql_query ("INSERT INTO horarios VALUES (0,'$dni',2,'$martes','$martes2',$cargo)");
							}
if (trim($miercoles) <> '' OR trim($miercoles2) <> '')	{
								mysql_query ("INSERT INTO horarios VALUES (0,'$dni',3,'$miercoles','$miercoles2',$cargo)");
							}
if (trim($jueves) <> '' OR trim($jueves2) <> '')	{
								mysql_query ("INSERT INTO horarios VALUES (0,'$dni',4,'$jueves','$jueves2',$cargo)");
							}
if (trim($viernes) <> '' OR trim($viernes2) <> '')	{
								mysql_query ("INSERT INTO horarios VALUES (0,'$dni',5,'$viernes','$viernes2',$cargo)");
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
