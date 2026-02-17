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


$resulturno = mysql_query ("SELECT * FROM turno order by codigo"); 
$resultplan = mysql_query ("SELECT * FROM plan order by codigo"); 



?>

<body background="bgris.gif" >


<form method="GET" action="curso_consul.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Cargar hs por curso.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el curso:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="2" maxlength="2" value="" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" width="36%">Ingrese la div.:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion2" id="descripcion2" size="2" maxlength="2" value="" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						</tr>
						<tr>
							<td align="right" width="36%">Ingrese el turno:</td>
							<td align="right">&nbsp;<select size="1" name="descripcion3">
							<?	WHILE ($myrow6 = mysql_fetch_array($resulturno))
							{			
								if($_POST['turno']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
								echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion] </option>";
							}
							?></select></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" width="36%">Ingrese el Plan:</td>
							<td align="right">&nbsp;	<select size="1" name="descripcion4">
							<?	WHILE ($myrow6 = mysql_fetch_array($resultplan))
							{			
								if($_POST['plan']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
								echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion] </option>";
							}
							?></select></td>
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
	$descripcion2=$_GET['descripcion2'];
	$descripcion3=$_GET['descripcion3'];
	$descripcion4=$_GET['descripcion4'];

	$_pagi_sql="SELECT * FROM materia WHERE curso='$descripcion' and divi='$descripcion2' and turno=$descripcion3";



$_pagi_cuantos=30;
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
							&nbsp;Resultado de la B&uacute;squeda para el curso: <?php echo $descripcion; ?> <?php echo $descripcion2; ?> turno: <?php echo $descripcion3; ?> plan: <?php echo $descripcion4; ?></td>
						</tr>
						<tr>
							<td width="10" bgcolor="#808080" align="center" height="36">N°</td>
							<td width="200" bgcolor="#808080" align="center" height="36">Materia</td>
							<td bgcolor="#808080" width="20" align="center" height="36">curso</td>
							<td bgcolor="#808080" width="20" align="center" height="36">div</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Plan</td>
							<td bgcolor="#808080" width="300" align="center" height="36">Docente</td>
							<td bgcolor="#808080" width="50" align="center"  height="36">Alta</td>
							<td bgcolor="#808080" width="50" align="center"  height="36">Baja</td>							

							
						</tr>

		<?php 
$inc=0;
while ($fila2 = mysql_fetch_array($_pagi_result))
		{
$inc++;
$resultestado = mysql_query ("SELECT * FROM plan WHERE codigo = $fila2[plan]");
$estado = mysql_fetch_array($resultestado);

$resultestado2 = mysql_query ("SELECT * FROM materia_docente WHERE materia=$fila2[codigo] and fecha_baja='0000-00-00' order by fecha_alta desc ");

$estado2 = mysql_fetch_array($resultestado2);

$existe = mysql_query ("SELECT * FROM materia_horario WHERE materia = '$fila2[codigo]'");
		if (mysql_num_rows($existe) >= 1 ) $color="#E60026";
		else $color="#EAEAEA";

$docente = mysql_query ("SELECT * FROM docente WHERE dni=$estado2[docente]");
$docente = mysql_fetch_array($docente);
$doc=$docente[apellido]." ".$docente[nombre];

	
	
		?> 

						<tr>
							<td width="5" bgcolor="<?echo $color;?>" align="center"><?echo $inc;?></td>
							<td width="200" bgcolor="<?echo $color;?>" align="center"><?echo $fila2[nombre];?></td>
							<td width="7" bgcolor="#EAEAEA" align="center"><?echo $fila2[curso];?></td>
							<td width="7" bgcolor="#EAEAEA" align="center"><?echo $fila2[divi];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $estado[descripcion];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $doc;?></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="alta_hs.php?materia=<?php echo $fila2[codigo]?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Asignar hs"></a></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="baja_hs.php?materia=<?php echo $fila2[codigo]?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Asignar hs"></a></td>

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