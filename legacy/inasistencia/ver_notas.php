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


<form method="GET" action="ver_notas.php">

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
if ($_SESSION['valor']==4) 
{		
include 'menuppal4.php';
}

$descripcion=mysql_real_escape_string($_GET['descripcion']);
	
	$palabras = explode(" ", $descripcion);

    // Construye la consulta SQL dinámicamente
    $condiciones = array();
    foreach ($palabras as $palabra) {
      //   if (is_numeric($palabra)) {
	//	$condiciones[] = "codigo LIKE '" . $palabra . "'";
	//	}
	//	else
		//{
		$condiciones[] = "descripcion LIKE '%" . $palabra . "%' or codigo LIKE '%" . $palabra . "%' or gen LIKE '%" . $palabra . "%' ";
	//	}	
		
	}
	
//LIKE '%" . $palabra . "%
?>	
				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Buscar Nota por Asunto.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el Asunto o parte de el:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="28" maxlength="40" value="<?echo $descripcion;?>" autofocus="true"/></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						
						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
					</table>
					</form>
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
</font>
					<?
	

    //$consulta = "SELECT * FROM notas WHERE " . implode(" AND ", $condiciones);
	//echo $consulta;
	
	$_pagi_sql="SELECT * FROM notasnuevo WHERE " . implode(" AND ", $condiciones). "ORDER BY anio DESC,codigo DESC";
	
	

	//$_pagi_sql="SELECT * FROM notas WHERE descripcion like '%$descripcion%' or codigo like '%$descripcion%' or gen like '%$descripcion%'order by codigo desc ";
	//echo $_pagi_sql;


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

		?> <table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="7" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>
						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">Num. Nota</td>
							<td bgcolor="#808080" width="400" align="center" height="36">Asunto</td>
							<td bgcolor="#808080" width="50" align="center" height="36">GEN</td>
							<td bgcolor="#808080" width="50" align="center" height="36">Fecha</td>
							<td bgcolor="#808080" width="50" align="center" height="36">Responsable</td>
							<td bgcolor="#808080" width="50" align="center" height="36">Modificar</td>
							<td bgcolor="#808080" width="50" align="center" height="36">Archivo (PDF)</td>
						

							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
		//$ano = date_format($fila2[fecha], 'Y');
		$ano = substr($fila2[fecha], 0, 4);
		
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?php echo $fila2['codigo'] ."/". $fila2['anio']; ?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[descripcion];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[gen];?></td>

							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[fecha];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[agente];?></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="modif_nota.php?nota=<?php echo $fila2[id]?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Modificar Nota"></a></td>
							
							
							<form method="POST" action="upload.php" enctype="multipart/form-data">
		        			<? if (is_null($fila2[path]) OR empty($fila2[path]))
								{
							?> 		<td bgcolor="#EAEAEA" align="center"><?//echo $fila2[id];?><input type="file" name="elarchivo" style="width: 139px;">
									<input type="hidden" name="idregistro" value="<?php echo $fila2['id']; ?>">
									<input type="hidden" name="tiporegistro" value="N">
									<input type="submit" value="Subir" name="Subir"></td>
							<? }
							 else
								{?>
								<td bgcolor="#EAEAEA" align="center"><a href="verdoc.php?id=<?echo $fila2[id];?>&es=N" target="_blank"><img src="images/archivopdf.png" width="40" height="40" title="adjunto" alt="si"></a></td>
								<?
								
								}		
								?>
							
							</form>
						</tr>
						<?
						}
						?>
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




 </td>

</div>

</body>

</html>
<? } ?>