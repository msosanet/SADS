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
<title>SIDOS</title>




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


<form method="GET" action="buscar_mat2.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Agregar HS a Materias.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese la materia o parte de ella:</td>
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

	$_pagi_sql="SELECT * FROM materia WHERE nombre like'%$descripcion%' or curso like'%$descripcion%'";



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
							<td class="text1b"background="../imag/bar07.gif"  colspan="6" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>
						<tr>
							<td width="200" bgcolor="#808080" align="center" height="36">Materia</td>
							<td bgcolor="#808080" width="20" align="center" height="36">Curso</td>
							<td bgcolor="#808080" width="20" align="center" height="36">Div</td>
							<td bgcolor="#808080" width="50" align="center" height="36">Turno</td>
							<td bgcolor="#808080" width="150" align="center" height="36">A Cargo</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Acciones</td>							

							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{

		$resultz = mysql_query ("SELECT * FROM turno WHERE codigo = '$fila2[turno]'");
		$filaz = mysql_fetch_array($resultz) ;
		$result23 = mysql_query ("SELECT * FROM materia_docente, docente WHERE materia_docente.materia = '$fila2[codigo]' and materia_docente.docente=docente.dni and materia_docente.fecha_baja='0000-00-00' order by materia_docente.caracter DESC ");
		$fila23 = mysql_fetch_array($result23) ;
		$existe = mysql_query ("SELECT * FROM materia_horario WHERE materia = '$fila2[codigo]'");
		if (mysql_num_rows($existe) >= 1 ) $color="#E60026";
		else $color="#EAEAEA";

	
		?> 

						<tr>
							<td width="200" bgcolor="<?echo $color;?>" align="center"><?echo $fila2[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[curso];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[divi];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaz[descripcion];?></td>
							<td width="150" bgcolor="#EAEAEA" align="center"><?echo $fila23[apellido];?> <?echo $fila23[nombre];?></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="alta_hs.php?materia=<?php echo $fila2[codigo]?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Asignar hs"></a></td>
							
                  					
					
							
							
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