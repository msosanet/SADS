<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
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
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<link rel="shortcut icon" href="../imag/favicon.ico">
<title></title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$actor=$_GET["id"];

$resultt = mysql_query ("SELECT * FROM mesaentradas WHERE id = $actor");
$filatt = mysql_fetch_array($resultt);

$usuario=$_SESSION['usuario'];

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario);
$agente=$filausuario["nombre"];
$resulttipo = mysql_query ("SELECT * FROM tipoentrada order by descripcion asc ");



$hayerrores = 0;

  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos


 	if (trim($_GET["numero"]) == '' ) { $errornumero = 1; $hayerrores = 1; }

 	if (trim($_GET["fecha"]) == '' ) { $errorfecha = 1; $hayerrores = 1; }

 	if (trim($_GET["asunto"]) == '' ) { $errorasunto = 1; $hayerrores = 1; }

 	if (trim($_GET["observaciones"]) == '' ) { $errorobser = 1; $hayerrores = 1; }





}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<body background="bgris.gif" >
<form method="GET" action="modif_entrada.php?id=<?php echo $actor?>">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
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
					
					<p align="left" class="text1b">Modificar Nota de entradas</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">				<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
												<?
	  					if ($errornumero==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nota Nº:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="numero" size="60" maxlength="60" value="<?echo $filatt['numero']; ?>" />
							</td>
					
							
						<?
	  					if ($errorfecha==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="190" bgcolor="#EAEAEA" align="right">Fecha:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<input type="text" name="fecha" size="60" maxlength="60" value="<?echo $filatt['fecha']; ?>" />
							</td>
							
						</tr>
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right">Origen:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
						<select size="1" name="origen">
							<?	WHILE ($myrow6 = mysql_fetch_array($resulttipo))
							{			
								if($filatt['de']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
								echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion] </option>";
							}
							?></select> 
							</td>
					
							
						<?
	  					if ($errorobser==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="190" bgcolor="#EAEAEA" align="right">
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							
							</td>
							
						</tr>
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Origen Extendido:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="observaciones" size="60" maxlength="60" value="<?echo $filatt['observaciones']; ?>" />
							</td>
					
							
						<?
	  					if ($errorasunto==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="190" bgcolor="#EAEAEA" align="right">Asunto:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<TEXTAREA COLS=35 ROWS=5 NAME="asunto"><?echo $filatt['asunto']; ?></TEXTAREA></td>
							
						</tr>

					
							<td width="190" bgcolor="#EAEAEA" align="right">
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
						</td>
						
						</tr>
			
						<tr>
							
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						</table>
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


<input type="hidden" name="id" value="<?echo $actor;?>">
</form>
 </td>

</div>

</body>
<?
}
else
{

	$asunto=$_GET['asunto'];
	$observaciones=$_GET['observaciones'];
	$numero=$_GET['numero'];
	$origen=$_GET['origen'];
	$fecha=$_GET['fecha'];
	$id=$_GET['id'];






if (mysql_query ("UPDATE mesaentradas SET numero='$numero', de=$origen , observaciones='$observaciones', fecha='$fecha' , asunto='$asunto' where id=$id"))
{	
				?>
				<script>
				var answer=alert("Datos Actualizados Correctamente")
				</script> 
						<meta http-equiv='refresh' content='0; URL=menu.php?'>
						<? 
}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
					}					


}

?>
</html>
<? } ?>