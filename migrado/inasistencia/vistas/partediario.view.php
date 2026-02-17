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

$resultdocente = mysql_query ("SELECT * FROM docentes where identificacion=1 order by apellido");



$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 

$resultados = mysql_query ("SELECT * FROM motivos order by descripcion"); 


$errordoc = 0;
  $hayerrores = 0;


  if (!isset($_POST["submitx"])) {
$_POST['d']=date("d");
$_POST['m']=date("m");
$_POST['a']=date("Y");
$_POST['d2']=date("d");
$_POST['m2']=date("m");
$_POST['a2']=date("Y");
$_POST['hora']=$hora;


}




  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos

     if (trim($_POST["d"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["m"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["a"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["turno"]) == '') { $errorturno = 1; $hayerrores = 1; };
     if (trim($_POST["div"]) == '') { $errordiv = 1; $hayerrores = 1; };
     if (trim($_POST["curso"]) == '') { $errorcurso = 1; $hayerrores = 1; };
     if (trim($_POST["obligaciones"]) == '') { $errorobli = 1; $hayerrores = 1; };

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="partediario.php?dni=<? echo $dni?>">
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
					
					<p align="left" class="text1b">Cargar Parte Diario</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="2" cellspacing="4">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">&nbsp;Docente: <?echo $filadocente['apellido'];?>&nbsp;<?echo $filadocente['nombre'];?></td>
						</tr>
						
						<tr>
						
						
						
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Docente:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<select size="1" name="docente" autofocus> 
			<?	WHILE ($myrow6 = mysql_fetch_array($resultdocente))
				{			
					if($_POST['descripcion']==$myrow6[dni]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[dni] $seleccionado> $myrow6[apellido] $myrow6[nombre] </option>";
				}
		?></select>
							</td>

							
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Tipo de Falta:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<select size="1" name="falta">
			<?	WHILE ($myrow6 = mysql_fetch_array($resultados))
				{			
					if($_POST['descripcion']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion] $myrow6[nombre] </option>";
				}
		?></select>
							</td>
							
						</tr>
						<tr>
					
							<td width="174" bgcolor="#EAEAEA" align="right">Observaciones:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><TEXTAREA COLS=35 ROWS=5 NAME="observaciones"> </TEXTAREA></td>
						
						<?
	  					if ($errorfecha==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha:</td>
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
					<?
	  					if ($errorobli==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>

							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							Obligaciones:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="obligaciones" size="3" maxlength="3" value="" /></td>
							</td>
							
										<?
	  					if ($errorcurso==1 or $errordic==1 or $errorturno==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
					
				<td width="74" bgcolor="#EAEAEA" align="left"><font color="<?echo $color;?>">curso/div/turno:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="curso" size="2" maxlength="2" value="" />
							-
							<input type="text" name="div" size="2" maxlength="2" value="" />
							-
							<input type="text" name="turno" size="1" maxlength="1" value="" /> 
							</td>
						</tr>

					<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"></td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Notific&oacute;:
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><b><? echo $filausuario['apellido']  ?>&nbsp;<? echo $filausuario['nombre']  ?></b>
							</td>						
							<input type="hidden" name="identificacion" id="identificacion" value="<? echo $identificacion;?>"/>
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
<input name="dni" type="hidden" value ="<?php echo $dni ?>"/>
	</form>
</div>
</body>
<?
}
else
{


	$fecha=$_POST['a']."-".$_POST['m']."-".$_POST['d'];
	$curso=$_POST['curso'];
	$turno=$_POST['turno'];
	$div=$_POST['div'];
	$observaciones=$_POST['observaciones'];
	$dni=$_POST['docente'];
	$obligaciones=$_POST['obligaciones'];
	$graba=$filausuario["nombre"];
	$falta=$_POST['falta'];

	

if (mysql_query ("INSERT INTO partediario VALUES (0,'$dni',$falta,'$observaciones','$fecha',$obligaciones,'$curso','$div','$turno','$graba')"))
	{		


				?>

				<meta http-equiv='refresh' content='0; URL=partediario.php'>
				<? 
				
	}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=partediario.php?'>
				<? 
				}					


}

?>
</html>
<? } ?>

