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
$resultmotivo = mysql_query ("SELECT * FROM motivo_dec order by orden"); 






?>

<body background="bgris.gif" >


<form method="GET" action="buscar_dj.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Consultar DDJJ por Apellido.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el Apellido, parte de el o el Nº de DDJJ:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="28" maxlength="40" value="" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" width="36%">Filtro de estado: <input type="checkbox" name="filtro" value="1"></td> 
							<td align="right"><select size="1" name="estado">
							<?	WHILE ($myrow7 = mysql_fetch_array($resultmotivo))
							{			
								if($_POST['descripcion']==$myrow7[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
								echo "<option value=$myrow7[codigo] $seleccionado> $myrow7[descripcion] </option>";
							}
							?></select>



							</td>
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
	$estado=$_GET['estado'];
	$filtro=$_GET['filtro'];

if($filtro==1) $_pagi_sql="SELECT * FROM docentes,declaracionj WHERE declaracionj.estado=$estado and docentes.dni=declaracionj.docente order by apellido,tramite desc, fechacarga Desc";

else $_pagi_sql="SELECT * FROM docentes,declaracionj WHERE docentes.dni=declaracionj.docente AND docentes.apellido like '%$descripcion%' or declaracionj.tramite like '%$descripcion%' order by apellido,tramite desc, fechacarga Desc";



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

		?> <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="8" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>
						<tr>
							<td width="50" bgcolor="#808080" align="center" height="36">Tramite</td>
							<td width="20" bgcolor="#808080" align="center" height="36">DNI</td>
							<td bgcolor="#808080" width="150" align="center" height="36">Apellido</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Nombre</td>
							<td bgcolor="#808080" width="300" align="center" height="36">Estado</td>
							<td bgcolor="#808080" width="70" align="center" height="36">Fecha carga</td>
							<td bgcolor="#808080" width="70" align="center" height="36">Cargo</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Mover</td>							

						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{

		$resultz = mysql_query ("SELECT * FROM motivo_dec WHERE codigo = '$fila2[estado]' ");
		$filaz = mysql_fetch_array($resultz) ;

	
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[tramite];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[dni];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[apellido];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaz[descripcion];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[fechacarga];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[grabo];?></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="mover_ddjj.php?actor=<?php echo $fila2[tramite]?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Ver DDJJ"></a></td>
							
                  					
					
							
							
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