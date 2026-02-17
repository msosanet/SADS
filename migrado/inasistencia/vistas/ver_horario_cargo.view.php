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
//$usuario=$_SESSION['usuario'];
//$materia=$_GET['materia'];
$cursox=$_GET['curso'];
//$actor=$_GET['actor'];
//echo $cursox;

$rr = mysql_query ("SELECT CONCAT(D.apellido,  ' ', D.nombre) as nombredoc FROM docente D WHERE D.dni=$actor");
$rr = mysql_fetch_array($rr);

$cursotextx=$rr['nombredoc'];



?>



</p>
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
</table>
<form method="GET" action="ver_horario_cargo.php">
<tr>
				
					<table border="0" width="980" bgcolor="#FFFFFF" colspan="2">
						<tr>
						<td align="center"><input type="radio" id="diario" name="diasemana" value="dia" <?if($_GET['diasemana']=='dia'){echo "checked";}?>><label class="text1b" for="diario">Por Dia</label>
						<label class="text1b" for="Name">Fecha: <input type="date" name="fecha" value="<?php echo date("Y-m-d");?>"></label>
						<input type="radio" id="diario" name="diasemana" value="semana" <?if($_GET['diasemana']=='semana'){echo "checked";}?>><label class="text1b" for="diario">Semanal</label>
						</td>
						</tr>
					</table>
					<div align="center">
					<table border="0" width="980" bgcolor="#FFFFFF">
					<td>
					<p align="left" class="text1b">Seleccionar cargo: 
				<?	
					$result79 = mysql_query ("SELECT * FROM curso order by descripcion");
							
					echo "<select style='max-width:70%' name=curso>";
						while ($fila79 = mysql_fetch_array($result79))
							{ 	if ($fila79['codigo']==$cursox)
								{echo "<option value=".$fila79['codigo']." selected>".$fila79['descripcion']."</option>";
									$cursotextx=$fila79['descripcion'];
								}
								else
								{echo "<option value=".$fila79['codigo'].">".$fila79['descripcion']."</option>";}
							}	
					echo "</select>";
					
					echo "<input type='submit' style='height:25px; width:150px' value='Ver' name='submitcargo' />";
					
				?>	
					</p></table></div>
					<div align="center">
					
					<br>
					
 


<?php 		
		

if (isset($_GET['curso'])) 
{
$fechax=$_GET['fecha'];
$quedia = date('N', strtotime($fechax));
$ds=$_GET['diasemana'];	
if ($ds=='dia')
	{
?>	
	
	<div align="center">
					
		<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
			<tr>
				<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b><?echo $cursotextx; ?></b></font></td>
			</tr>	
			<tr>
				<td bgcolor="#EAEAEA" align="center"><b>DNI</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Nombre y Apellido</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Entrada</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Salida</b></td>
				
				
			</tr>
	
<?	
	
	
	

$result79 = mysql_query ("SELECT dc.dni,CONCAT(d.apellido, ' ', d.nombre) as docnomap,dc.entrada,dc.salida FROM doc_cargo dc, docentes d WHERE dc.idcargo=$cursox AND dc.dni=d.dni AND dc.dia='$quedia' ORDER BY dc.entrada ASC,docnomap DESC");
	while ($fila79 = mysql_fetch_array($result79))
		{?>	
		<tr>
		<td bgcolor="" align="center"><a href="leg_unif.php?actor=<?echo $fila79['dni']; ?>"><?echo $fila79['dni']; ?></td>
		<td bgcolor="" align="center"><a href="leg_unif.php?actor=<?echo $fila79['dni']; ?>"><?echo $fila79['docnomap']; ?></td>
		<td bgcolor="" align="center"><?echo $fila79['entrada']; ?></td>
		<td bgcolor="" align="center"><?echo $fila79['salida']; ?></td>
		</tr>
		
		
		<?
		}
					

?>		


</table>
<?}

if ($ds=='semana')
{	
?>	
	
	<div align="center">
					
		<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
			<tr>
				<td width="895" bgcolor="#EAEAEA" align="center" colspan="8"><font color="FF0000"><b><?echo $cursotextx; ?></b></font></td>
			</tr>	
			<tr>
				<td bgcolor="#EAEAEA" align="center"><b>DNI</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Nombre y Apellido</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Miercoles</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>
				<td bgcolor="#EAEAEA" align="center"><b>Sabado</b></td>
			</tr>


	<tr>	
<?	
	$result81 = mysql_query ("SELECT DISTINCT dc.dni,dc.dni,CONCAT(d.apellido, ' ', d.nombre) as docnomap FROM doc_cargo dc, docentes d WHERE dc.dni=d.dni AND dc.idcargo=$cursox ORDER BY dc.entrada ASC,dc.dni ASC");
	//echo "SELECT dc.dni,dc.dni,CONCAT(d.apellido, ' ', d.nombre) as docnomap FROM doc_cargo dc, docentes d WHERE dc.dni=d.dni AND dc.idcargo=$cursox ORDER BY dc.dni ASC";
	while ($listdni = mysql_fetch_array($result81))
		{
			
		
		$dni=$listdni['dni'];
		
?>	
			
			<td bgcolor="" align="center"><a href="leg_unif.php?actor=<?echo $listdni['dni']; ?>"><?echo $listdni['dni']; ?></td>
			<td bgcolor="" align="center"><a href="leg_unif.php?actor=<?echo $listdni['dni']; ?>"><?echo $listdni['docnomap']; ?></td>
			
			<?
			for ($i = 1; $i <= 6; $i++) 
			{
			?>
			<td bgcolor="" align="center">
			<?
			$result80 = mysql_query ("SELECT dc.dni,CONCAT(d.apellido, ' ', d.nombre) as docnomap,dc.entrada,dc.salida FROM doc_cargo dc, docentes d WHERE dc.idcargo=$cursox AND dc.dni=$dni AND dc.dni=d.dni AND dc.dia=$i ORDER BY dc.entrada ASC,docnomap DESC");
		//	echo "SELECT dc.dni,CONCAT(d.apellido, ' ', d.nombre) as docnomap,dc.entrada,dc.salida FROM doc_cargo dc, docentes d WHERE dc.idcargo=$cursox AND dc.dni=$dni AND dc.dni=d.dni AND dc.dia='$quedia' AND dc.dia=$i ORDER BY dc.entrada ASC,docnomap DESC";
			$fila80 = mysql_fetch_array($result80);
			echo $fila80['entrada'].'-'.$fila80['salida']; 
			?>
			</td>
			<?
			}
			?>
			
		
		
	</tr>	
<?
}}
?>	













						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="8">
							<br><br>
							<a href="menu.php">Volver</a>
							<p align="center">&nbsp;</td>
						
						</tr>

					
					<p align="right">&nbsp;</div>
					<hr>
					</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
			</div>
		</td>
		</tr>
	</table>


	</form>
</div>
</body>
<?
}

  
  
  
}  
  ?>


</html>

