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
<title>AGREGAR HORARIO CARGO</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';
include 'funciones.php';
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
//$id=$_GET['actor'];
//$materia=$_GET['mat'];
$sql="SELECT * FROM materia_cargo mc,alta_baja ab  where mc.id=ab.materia AND mc.id='$materia'";
//echo $sql;
$resultdocente = mysql_query ($sql);
//$filadocente = mysql_fetch_array($resultdocente); 



$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
if (isset($_POST["submitx"])) {
	
	$cargo=$_POST['id'];
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


/*echo consultahorario('1',$cargo,'E');
echo consultahorario('2',$cargo,'E');
echo consultahorario('3',$cargo,'E');
echo consultahorario('4',$cargo,'E');
echo consultahorario('5',$cargo,'E');*/

//echo $miercoles." ".$miercoles2;






if (trim($lunes) <> '' OR trim($lunes2) <> '')	{
								
								if (consultahorario('1',$cargo,'E')==0)
								{mysql_query ("INSERT INTO cargo_horas VALUES ($cargo,1,'$lunes','$lunes2')");}
								else
								{mysql_query ("UPDATE cargo_horas SET entrada='$lunes',salida='$lunes2' WHERE idcargo='$cargo' AND iddia='1'");}
								
							
							}
if (trim($martes) <> '' OR trim($martes2) <> '')	{
								
								if (consultahorario('2',$cargo,'E')==0)
								{mysql_query ("INSERT INTO cargo_horas VALUES ($cargo,2,'$martes','$martes2')");}
								else
								{mysql_query ("UPDATE cargo_horas SET entrada='$martes',salida='$martes2' WHERE idcargo='$cargo' AND iddia='2'");}
							
							}
if (trim($miercoles) <> '' OR trim($miercoles2) <> '')	{
								
								//echo "consultahorario:".consultahorario('3',$cargo,'E');
								if (consultahorario('3',$cargo,'E')==0)
								{$insertahorario="INSERT INTO cargo_horas VALUES ($cargo,3,'$miercoles','$miercoles2')";}
								else
								{$insertahorario="UPDATE cargo_horas SET entrada='$miercoles',salida='$miercoles2' WHERE idcargo='$cargo' AND iddia='3'";}
								//echo $insertahorario;
								mysql_query ($insertahorario);
							}
if (trim($jueves) <> '' OR trim($jueves2) <> '')	{
								if (consultahorario('4',$cargo,'E')==0)
								{mysql_query ("INSERT INTO cargo_horas VALUES ($cargo,4,'$jueves','$jueves2')");}
								else
								{mysql_query ("UPDATE cargo_horas SET entrada='$jueves',salida='$jueves2' WHERE idcargo='$cargo' AND iddia='4'");}
							}
if (trim($viernes) <> '' OR trim($viernes2) <> '')	{
								if (consultahorario('5',$cargo,'E')==0)
								{mysql_query ("INSERT INTO cargo_horas VALUES ($cargo,5,'$viernes','$viernes2')");}
								else
								{mysql_query ("UPDATE cargo_horas SET entrada='$viernes',salida='$viernes2' WHERE idcargo='$cargo' AND iddia='5'");}
							}
if (trim($sabado) <> '' OR trim($sabado2) <> '')	{
								mysql_query ("INSERT INTO cargo_horas VALUES ($cargo,6,'$sabado','$sabado2')");
							}

//<meta http-equiv='refresh' content='0; URL=menu.php?'>
  
?>
	
				<script>
				var answer=alert("Se grabo en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=add_cargos.php?mat=<?echo $cargo;?>'>
				  
	  
<?
}//<meta http-equiv='refresh' content='0; URL=buscar_doc.php?actor=<?echo $id;'>   

    
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

$filadocente = mysql_fetch_array($resultdocente);


?>	
</table>
</br></br>
	<table border="0" width="980" bgcolor="#FFFFFF">
				<tr>
				

					<td>
					<p align="left" class="text1b">Alta de horario del cargo: <?echo $filadocente[nombre]." ".$filadocente[curso]." ".$filadocente[division]." Plaza: ".$filadocente[plaza]; ?></p>
					
					<?	//echo $filadocente[nombre];	
					
					
					
					?>
					
					
					
					
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					<br>
<br><br>
					<div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Miercoles</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Sabado</b></td>
	</tr>
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="6">&nbsp;</td>
	</tr>
	<tr>
		
		
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="time" name="le" size="5" maxlength="5" value="<?echo consultahorario('1',$materia,'E'); ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="time" name="me" size="5" maxlength="5" value="<?echo consultahorario('2',$materia,'E'); ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="time" name="mie" size="5" maxlength="5" value="<?echo consultahorario('3',$materia,'E'); ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="time" name="je" size="5" maxlength="5" value="<?echo consultahorario('4',$materia,'E'); ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="time" name="ve" size="5" maxlength="5" value="<?echo consultahorario('5',$materia,'E'); ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Entrada:<input type="time" name="sa" size="5" maxlength="5" value="<?echo consultahorario('6',$materia,'E'); ?>" /></font></td>

	</tr>
	<tr>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="time" name="ls" size="5" maxlength="5" value="<?echo consultahorario('1',$materia,'S'); ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="time" name="ms" size="5" maxlength="5" value="<?echo consultahorario('2',$materia,'S'); ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="time" name="mis" size="5" maxlength="5" value="<?echo consultahorario('3',$materia,'S'); ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="time" name="js" size="5" maxlength="5" value="<?echo consultahorario('4',$materia,'S'); ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="time" name="vs" size="5" maxlength="5" value="<?echo consultahorario('5',$materia,'S'); ?>" /></font></td>
		<td bgcolor="#EAEAEA"><font color="<?echo $color;?>">Hs Salida:<input type="time" name="sab" size="5" maxlength="5" value="<?echo consultahorario('6',$materia,'S'); ?>" /></font></td>
	</tr>
	<tr>
		<td width="834" bgcolor="#EAEAEA" align="center" colspan="6">&nbsp;</td>
	</tr>
						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="6">
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
<input name="id" type="hidden" value ="<?php echo $materia ?>"/>
	</form>
</div>
</body>
<?


					
?>
</html>
<? } 
	} 
?>
