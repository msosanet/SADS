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

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador del SID</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;






?>

<body background="bgris.gif" >


<form method="GET" action="examen.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Consultar Docentes por Apellido.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el Apellido o parte de el:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="28" maxlength="40" value="" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						
						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
					</table>
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
</font>
					<?
				if (isset($_GET['muestra2']))
{ 
	$descripcion=$_GET['descripcion'];

	$_pagi_sql="SELECT * FROM docentes WHERE apellido like'%$descripcion%' and identificacion=1";



$_pagi_cuantos=5;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

		?> <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="7" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>
						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">DNI</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Apellido</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Nombre</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Art c/des</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Art s/des</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Art estudio</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Per. Salida</td>								

							
						</tr>

		<?php 
		$anio=date ("Y");
		$uno=$anio."-01-01";
		$dos=$anio."-12-31";

		while ($fila2 = mysql_fetch_array($_pagi_result))
		{

		$resultz = mysql_query ("SELECT COUNT(*) as total FROM ausentes WHERE docente = '$fila2[dni]' and motivo=5 and (fecha_desde >= '$uno' and fecha_desde <= '$dos')");
		$filaz = mysql_fetch_array($resultz) ;
		$resultz2 = mysql_query ("SELECT COUNT(*) as total FROM ausentes WHERE docente = '$fila2[dni]' and motivo=10 and (fecha_desde >= '$uno' and fecha_desde <= '$dos')");

		$filaz2 = mysql_fetch_array($resultz2) ;
		$resultz3 = mysql_query ("SELECT COUNT(*) as total FROM ausentes WHERE docente = '$fila2[dni]' and motivo=12 and (fecha_desde >= '$uno' and fecha_desde <= '$dos')");
 
		$filaz3 = mysql_fetch_array($resultz3) ;

		$resultz5 = mysql_query ("SELECT COUNT(*) as total FROM ausentes WHERE docente = '$fila2[dni]' and motivo=69 and (fecha_desde >= '$uno' and fecha_desde <= '$dos')");
 
		$filaz5 = mysql_fetch_array($resultz5) ;


	
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[dni];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[apellido];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaz3[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaz2[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaz[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaz5[total];?></td>
							
                  					
					
							
							
						</tr>
						<?
						}
						?>
						</table><?
}
	?>					
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



</form>
 </td>

</div>

</body>

</html>
<? } ?>