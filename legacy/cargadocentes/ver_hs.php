<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';



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


<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador del SID</title>


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

$ano=date("Y");

$actor=$_GET["actor"];


$resultt = mysql_query ("SELECT * FROM docentes WHERE dni = '$actor'");
$filatt = mysql_fetch_array($resultt);
$result = mysql_query ("SELECT * FROM diario WHERE dni = '$actor' order by fecha" );



  if (isset($_POST["submitx"])) 
				{
		
				}
				?>

<form method="POST" action="ver_hs.php">
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
?>				<tr>
				

					<td>
					
					<p align="left" class="text1b">Consulta de Hs</p>
					<br><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
				<div align="center">
	<table border="0" width="779" id="table1" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top">
			<div align="center">
				<div align="center">Docente: <B><?php echo utf8_encode($filatt[apellido]);?></B>,<B><?php echo utf8_encode($filatt[nombre]);?></B>
					
					<p style="margin-top: 0; margin-bottom: 0">&nbsp;</div>
			</div>
			<div align="center">
				<table border="1" width="780" id="table8" cellspacing="1" bordercolor="#E9E9E9">
					<tr>
						<td colspan="3" bgcolor="#E9E9E9">
						<p align="center" style="margin-top: 0; margin-bottom: 0">
						<b>DETALLE DE LAS HS.</b></td>
					</tr>
					<tr>
						<td align="center" width="82" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Fecha</b></td>
						<td align="center" width="87" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Tipo</b></td>
						<td align="center" width="178" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Horario</b></td>

					</tr>
						<?php 
					$cantidad=0;
					$tot_modulos=0;

						while ($fila = mysql_fetch_array($result))
						{

						?> 
					<tr>
						<td align="center" width="82">
						<p style="margin-top: 0; margin-bottom: 0"><?php echo $fila[fecha]?></td>
						<td align="center" width="87">
						<p style="margin-top: 0; margin-bottom: 0"><?php echo $fila[tipo]?></td>
						<td align="center" width="178">
						<p style="margin-top: 0; margin-bottom: 0"><?php echo $fila[horario]?></td>
	
					</tr>
					<?php 
						}
						?> 
					<tr>
						<td align="center" width="752" colspan="6">
						<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</td>
					</tr>
				</table>
<br><br>

				</table>
			</div></td>
		</tr>
	</table>
</div>
					
					
					</div>
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
</html>
<? } ?>