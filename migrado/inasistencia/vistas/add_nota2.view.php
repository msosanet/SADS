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
$dni=$_GET['actor'];
$identificacion=$_GET['ident'];


$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 


$resultmotivo = mysql_query ("SELECT * FROM tipoentrada order by descripcion"); 


$errordoc = 0;
  $hayerrores = 0;


  if (!isset($_POST["submitx"])) {

  
$_POST['anio']=date("Y");
$_POST['d']=date("d");
$_POST['m']=date("m");
$_POST['a']=date("Y");

$anio=$_POST['anio'];

}
//ESTE SUBMIT ES PARA QUE TOME EL NUMERO DE NOTA Y TRAIGA EL ASUNTO QUE YA FUE CARGADO CUANDO SE PIDIO EL NUMERO DE NOTA


  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos

     //if (trim($_POST["numero"]) == '') { $errornumero = 1; $hayerrores = 1; };
     if (trim($_POST["anio"]) == '') { $erroranio = 1; $hayerrores = 1; };
     if (trim($_POST["a"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["d"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["m"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["asunto"]) == '') { $errorasunto = 1; $hayerrores = 1; };
     if (trim($_POST["destino"]) == '') { $errordestino = 1; $hayerrores = 1; };

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
	
//BUSCA EL NUMERO DE NOTA PARA TRAER EL ASUNTO
	$numero=$_POST['numero'];
  $resultnotas = mysql_query ("select * from notasnuevo WHERE codigo='$numero' and anio='$anio' order by codigo desc limit 1");
  $filanotas = mysql_fetch_array($resultnotas); 
	
	
	
?>

<form method="POST" action="add_nota2.php">
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
					
					<p align="left" class="text1b">Cargar Notas de salida</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">&nbsp;&nbsp;</td>
						</tr>
						
<tr>
						
						
						
						<?
	  					if ($numero==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="190" bgcolor="#EAEAEA" align="right">
							N°(si es informe ponerle i ej. <b>187i</b>):</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><p align="center"><input type="text" name="numero" size="15" maxlength="15" value="<? echo $filanotas['codigo'];?>" /><input type="submit" value="     Ver     " name="submitxn" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
							</td>
						<?
	  					if ($erroranio==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							


							<td width="190" bgcolor="#EAEAEA" align="right">
							Año:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="anio" size="4" maxlength="4" value="<?echo $_POST['anio']; ?>" /></td>
							</td>
							
						</tr>
						
<tr>
						
						<?
	  					if ($errordestino==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
						
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Destino</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><input type="text" name="destino" size="40" maxlength="70" value="" />
				
							</td>
						<?
	  					if ($errorfecha==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha de salida:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="d" size="2" maxlength="2" value="<?echo $_POST['d']; ?>" />
							-
							<input type="text" name="m" size="2" maxlength="2" value="<?echo $_POST['m']; ?>" />
							-
							<input type="text" name="a" size="4" maxlength="4" value="<?echo $_POST['a']; ?>" /> 
							(DD-MM-AAAA)</td>
							
						</tr>

						<tr>
					
							<td width="190" bgcolor="#EAEAEA" align="right">Carga:
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><b><? echo $filausuario['apellido']  ?>&nbsp;<? echo $filausuario['nombre']  ?></b>
							</td>
						
						<?
	  					if ($errorasunto==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							

							<td width="174" bgcolor="#EAEAEA" align="right">Asunto:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><TEXTAREA COLS=35 ROWS=5 NAME="asunto"><? echo $filanotas['descripcion'];?></TEXTAREA></td>
							
	
						</tr>
			
						<input type="hidden" name="identificacion" id="identificacion" value="<? echo $identificacion;?>"/>


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
<input name="dni" type="hidden" value ="<?php echo $dni ?>"/>
	</form>
</div>
</body>
<?
}
else
{


	$fecha_final=$_POST['a']."-".$_POST['m']."-".$_POST['d'];
	$anio=$_POST['anio'];
	$numero=$_POST['numero'];
	$now=date("Y-m-d");
	$graba=$filausuario["nombre"];
	$asunto=$_POST['asunto'];
	$destino=$_POST['destino'];
	$fechacero="0000-00-00";








	





if (mysql_query ("INSERT INTO mesasalidas VALUES (0,'$fecha_final','$numero',$anio,'$fechacero','$asunto','$destino','$graba','$now')"))
	{		
		//	$resultnotas = mysql_query ("select * from notas order by codigo desc limit 1");
		//	$filanotas = mysql_fetch_array($resultnotas); 
		//	$numero=$filanotas["codigo"];
			//mysql_query ("INSERT INTO mesasalidas VALUES (0,'$fecha_final','$numero',$anio,'$fechacero','$asunto','$destino','$graba','$now')");
			
			?>
			<script>
			var answer=alert("Se ha dado salida a la Nota: <?echo $numero;?>")
			</script> 
			<meta http-equiv='refresh' content='0; URL=add_nota2.php?'>
			<?

    	
				
	}
	
				else {	
			?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=add_nota2.php?'>
				
				
				
				<? 
				}
}

?>
</html>
<? } ?>
