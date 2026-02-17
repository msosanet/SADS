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
<title></title>




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


<form method="GET" action="ver_nota_entrada.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Buscar Nota de entrada por Asunto.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el Numero de nota, asunto o parte,  de el:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="28" maxlength="40" value="" autofocus="true"/></td>
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

	$_pagi_sql="SELECT * FROM mesaentradas WHERE asunto like '%$descripcion%' or numero like '%$descripcion%' or observaciones like '%$descripcion%' order by id desc";



$_pagi_cuantos=20;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

		?> <table border="1" width="960" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="9" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>
						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">Num</td>
							<td width="20" bgcolor="#808080" align="center" height="36">Año</td>
							<td bgcolor="#808080" width="20" align="center" height="36">Fecha</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Tipo</td>
							<td bgcolor="#808080" width="400" align="center" height="36">De</td>
							<td bgcolor="#808080" width="500" align="center" height="36">Asunto</td>
							<td bgcolor="#808080" width="50" align="center" height="36">Responsable</td>
							<td bgcolor="#808080" width="40" align="center" height="36">graba</td>
							<td bgcolor="#808080" width="10" align="center" height="36">Acción</td>
						
							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{

			$resultt = mysql_query ("SELECT * FROM tipoentrada WHERE codigo = $fila2[de]");
			$filatt = mysql_fetch_array($resultt) ;
	
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[numero];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[anio];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[fecha];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filatt[descripcion];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[observaciones];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[asunto];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[graba];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[hoy];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><a href="modif_entrada.php?id=<?php echo $fila2[id]?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Modificar"></a></td>


							
                  					
					
							
							
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
