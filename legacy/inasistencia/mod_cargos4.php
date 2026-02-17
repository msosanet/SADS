<?PHP
session_start();
if ($_SESSION['estado']==1) { 


//esto pasa las mayusculas acentuadas a minusculas acentuadas
function strtolowerExtended($str)
{
        $low = array(chr(193) => chr(225), //á
                    chr(201) => chr(233), //é
                    chr(205) => chr(237), //í­
                   chr(211) => chr(243), //ó
                   chr(218) => chr(250), //ú
                  chr(220) => chr(252), //ü
                    chr(209) => chr(241)  //ñ
                    );
 
      return strtolower(strtr($str,$low)); 
} 


?>
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
$id=$_GET['idz'];
$cargo=$_GET['cargo'];




//echo $cargo;


$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente);


$resulths = mysql_query ("SELECT * FROM doc_cargo where dni='$dni' AND id='$id'");
$filahs = mysql_fetch_array($resulths);  



$resultcurso = mysql_query ("SELECT DISTINCT * FROM curso where codigo = $filahs[idcargo]"); 
$listacurso = mysql_query ("SELECT DISTINCT c.descripcion,dc.idcargo FROM curso c,doc_cargo dc WHERE dc.idcargo=c.codigo AND dc.idcargo=$cargo AND dc.dni=$dni AND dc.id='$id' ORDER BY c.descripcion ");

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

<form method="POST" action="mod_cargos4.php">
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
			                
			
			<?	WHILE ($cargo = mysql_fetch_array($listacurso))
				{	
$result = mysql_query ("SELECT * FROM doc_cargo where id='$id' AND dni='$dni' and dia=1 AND idcargo=$cargo[idcargo]");
$fila = mysql_fetch_array($result); 

$result2 = mysql_query ("SELECT * FROM doc_cargo where id='$id' AND  dni='$dni' and dia=2 AND idcargo=$cargo[idcargo]");
$fila2 = mysql_fetch_array($result2); 

$result3 = mysql_query ("SELECT * FROM doc_cargo where id='$id' AND dni='$dni' and dia=3 AND idcargo=$cargo[idcargo]");
$fila3 = mysql_fetch_array($result3); 

$result4 = mysql_query ("SELECT * FROM doc_cargo where id='$id' AND dni='$dni' and dia=4 AND idcargo=$cargo[idcargo]");
$fila4 = mysql_fetch_array($result4); 

$result5 = mysql_query ("SELECT * FROM doc_cargo where id='$id' AND dni='$dni' and dia=5 AND idcargo=$cargo[idcargo]");
$fila5 = mysql_fetch_array($result5); 

$result6 = mysql_query ("SELECT * FROM doc_cargo where id='$id' AND dni='$dni' and dia=6 AND idcargo=$cargo[idcargo]");
$fila6 = mysql_fetch_array($result6); 
		
				//	if ($cargo[codigo] == $filahs[cod_curso]) { $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "$cargo[descripcion]";
			//	}
		?>
        

<!-- FIN LISTA DE CARGOS *************************************************************************** -->    
<br><br>
<div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr bgcolor="#CCCCCC" align="center">
		<td><b>LUNES</b></td>
		<td><b>MARTES</b></td>
		<td><b>MI�RCOLES</b></td>
		<td><b>JUEVES</b></td>
		<td><b>VIERNES</b></td>
		<td><b>S�BADO</b></td>
	</tr>

	<tr bgcolor="#E8E8E8">
		<?
	  		if ($errorle==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="le" size="8" maxlength="8" value="<?echo $fila[entrada]; ?>" /></font></td>
		<?
	  		if ($errorme==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="me" size="8" maxlength="8" value="<?echo $fila2[entrada]; ?>" /></font></td>
		<?
	  		if ($errormie==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="mie" size="8" maxlength="8" value="<?echo $fila3[entrada]; ?>" /></font></td>
		<?
	  		if ($errorje==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="je" size="8" maxlength="8" value="<?echo $fila4[entrada]; ?>" /></font></td>
		<?
	  		if ($errorve==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="ve" size="8" maxlength="8" value="<?echo $fila5[entrada]; ?>" /></font></td>
<?
	  		if ($errorve==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
		<td><font color="<?echo $color;?>">Hs Entrada:<input type="text" name="sa" size="8" maxlength="8" value="<?echo $fila6[entrada]; ?>" /></font></td>

	</tr>
	<tr bgcolor="#E8E8E8">
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="ls" size="8" maxlength="8" value="<?echo $fila[salida]; ?>" /></font></td>
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="ms" size="8" maxlength="8" value="<?echo $fila2[salida]; ?>" /></font></td>
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="mis" size="8" maxlength="8" value="<?echo $fila3[salida]; ?>" /></font></td>
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="js" size="8" maxlength="8" value="<?echo $fila4[salida]; ?>" /></font></td>
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="vs" size="8" maxlength="8" value="<?echo $fila5[salida]; ?>" /></font></td>
		<td><font color="<?echo $color;?>">Hs Salida:<input type="text" name="sab" size="8" maxlength="8" value="<?echo $fila6[salida]; ?>" /></font></td>
	</tr>
		

</table>
<br>
<p align="center">

<input type="submit" value="     Modificar Horas    " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" />
</p>
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
<input name="dni" type="hidden" value ="<?php echo $dni; ?>"/>
<input name="cargo" type="hidden" value ="<?php echo $cargo[idcargo]; ?>"/>
<input name="idx" type="hidden" value ="<?php echo $id; ?>"/>
	
<input name="lunese" type="hidden" value ="<?php echo $fila[entrada]; ?>"/>
<input name="martese" type="hidden" value ="<?php echo $fila2[entrada]; ?>"/>
<input name="miercolese" type="hidden" value ="<?php echo $fila3[entrada]; ?>"/>
<input name="juevese" type="hidden" value ="<?php echo $fila4[entrada]; ?>"/>
<input name="viernese" type="hidden" value ="<?php echo $fila5[entrada]; ?>"/>
<input name="sabadoe" type="hidden" value ="<?php echo $fila6[entrada]; ?>"/>

<input name="luness" type="hidden" value ="<?php echo $fila[salida]; ?>"/>
<input name="martess" type="hidden" value ="<?php echo $fila2[salida]; ?>"/>
<input name="miercoless" type="hidden" value ="<?php echo $fila3[salida]; ?>"/>
<input name="juevess" type="hidden" value ="<?php echo $fila4[salida]; ?>"/>
<input name="vierness" type="hidden" value ="<?php echo $fila5[salida]; ?>"/>
<input name="sabados" type="hidden" value ="<?php echo $fila6[salida]; ?>"/>

	
	
	</form>
</div>
</body>
<?
}}
else
{  /* $cargo=$_POST['cargo'];
	$lunes=$_POST['le'];
	$dni=$_POST['dni'];
	echo "CARGO:$cargo";
	echo "lunes:$lunes";
	echo "DNI:$dni";
	*/
	
	//TRAIGO LA HORA PORQUE LA TABLA ESTA HECHA PARA EL ORTO
	
	$lunese=$_POST['lunese'];
	$martese=$_POST['martese'];
	$miercolese=$_POST['miercolese'];
	$juevese=$_POST['juevese'];
	$viernese=$_POST['viernese'];
	$sabadese=$_POST['sabadoe'];
	
	$luness=$_POST['luness'];
	$martess=$_POST['martess'];
	$miercoless=$_POST['miercoless'];
	$juevess=$_POST['juevess'];
	$vierness=$_POST['vierness'];
	$sabadess=$_POST['sabados'];
	
	
	
	//echo $sabadese;
	
	
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
	$idw=$_POST['idx'];
	
	
	echo "$dni"."$idw";
	
	

	
	
       
		//mysql_query ("UPDATE doc_cargo SET cargo = '$cargo' WHERE dni='$dni'");
		//echo "UPDATE doc_cargo SET entrada = '$lunes', salida = '$lunes2' WHERE dni='$dni' and id='$idw'";
		mysql_query ("UPDATE doc_cargo SET entrada = '$lunes', salida = '$lunes2' WHERE dni='$dni' and id='$idw' AND dia=1 ");
		mysql_query ("UPDATE doc_cargo SET entrada = '$martes', salida = '$martes2' WHERE dni='$dni' and id='$idw' AND dia=2");
        mysql_query ("UPDATE doc_cargo SET entrada = '$miercoles', salida = '$miercoles2' WHERE dni='$dni' and id='$idw' AND dia=3");
        mysql_query ("UPDATE doc_cargo SET entrada = '$jueves', salida = '$jueves2' WHERE dni='$dni' and id='$idw' AND dia=4");
        mysql_query ("UPDATE doc_cargo SET entrada = '$viernes', salida = '$viernes2' WHERE dni='$dni' and id='$idw' AND dia=5"); 
		mysql_query ("UPDATE doc_cargo SET entrada = '$sabado', salida = '$sabado2' WHERE dni='$dni' and id='$idw' AND dia=6");
      


	  // mysql_query("DELETE FROM doc_cargo WHERE entrada='' OR salida=''")	
		//mysql_query ("UPDATE doc_cargo SET entrada = '$martes', salida = '$martes2' WHERE dni='$dni' and dia=2 AND idcargo=$cargo AND entrada='$martese' AND salida='$martess'");
		/*mysql_query ("UPDATE doc_cargo SET entrada = '$miercoles', salida = '$miercoles2' WHERE dni='$dni' and dia=3 AND idcargo=$cargo AND entrada='$miercolese' AND salida='$miercoless'");
        mysql_query ("UPDATE doc_cargo SET entrada = '$jueves', salida = '$jueves2' WHERE dni='$dni' and dia=4 AND idcargo=$cargo AND entrada='$juevese' AND salida='$juevess'");
        mysql_query ("UPDATE doc_cargo SET entrada = '$viernes', salida = '$viernes2' WHERE dni='$dni' and dia=5 AND idcargo=$cargo AND entrada='$viernese' AND salida='$vierness'"); 
		mysql_query ("UPDATE doc_cargo SET entrada = '$sabado', salida = '$sabado2' WHERE dni='$dni' and dia=6 AND idcargo=$cargo AND entrada='$sabadoe' AND salida='$sabados'");
        mysql_query("DELETE FROM doc_cargo WHERE entrada='' OR salida=''")			*/

	//<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor= '>
	//<? echo $dni;
?>
				
				<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<? echo $dni;?> '>
				

				
<?} } ?>
</html>

