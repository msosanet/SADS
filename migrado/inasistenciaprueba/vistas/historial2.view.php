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



$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM intervencion where alumno='$dni'");

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 

$result = mysql_query ("SELECT * FROM alumnos where dni='$dni'");
$fila = mysql_fetch_array($result); 



$edad=$fila['fechanac'];

function calculaedad($edad){
	list($ano,$mes,$dia) = explode("-",$edad);
	$ano_diferencia  = date("Y") - $ano;
	$mes_diferencia = date("m") - $mes;
	$dia_diferencia   = date("d") - $dia;
	if ($dia_diferencia < 0 || $mes_diferencia < 0)
		$ano_diferencia--;
	return $ano_diferencia;
}

$errordoc = 0;
  $hayerrores = 0;


  if (!isset($_POST["submitx"])) {



}




  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos


     if (trim($_POST["fecha"]) == '') { $errorfecha = 1; $hayerrores = 1; };

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="historial2.php">
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
if ($_SESSION['valor']==4) 
{		
include 'menuppal4.php';
}


?>	
				<tr>
				

					<td>
					<br>
					<p align="left" class="text1b">Alumno: <? echo $fila['alumno']; ?></p><br>
					<p align="left" class="text1b">Curso: <? echo $fila['curso']; ?>/<? echo $fila['division']; ?></p><br>
					<p align="left" class="text1b">Edad: <? echo  calculaedad ($edad); ?></p><br>


					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">
							&nbsp;Historial del intervenciones del alumno</td>
						</tr>

						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">N°</td>
							<td bgcolor="#808080" width="700" align="center" height="36">TAREA</td>
							<td bgcolor="#808080" width="50" align="center" height="36">FECHA</td>
							<td bgcolor="#808080" width="100" align="center" height="36">PROFESIONAL</td>
							

							
						</tr>


											
							
		<? $cont=0;

		while ($filadocente = mysql_fetch_array($resultdocente))
   		{
		$cont=$cont+1;
			?>			
						
						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $cont;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filadocente['tarea'];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filadocente['fecha'];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filadocente['profesional'];?></td>
	
							
						</tr>

					
			<? } ?>
						
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


	</form>
</div>
</body>
<?
}
?>
</html>
<? } ?>
