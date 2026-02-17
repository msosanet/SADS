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
$curso=substr($_GET['curso'], 0,1);
$division=substr($_GET['curso'], 1);


if (isset($_GET['submitx']))
{ 
$hoy = date("Y-m-d");
$hoy = date('Y-m-d', strtotime($hoy));
$cursoxx=$_GET['curso'];





foreach ($_GET['alumnos'] as $checkbox) 
{
$conexion = conectar ();
$valor=$_GET['ij'][$checkbox];


$sql= "SELECT * FROM alumno_burbuja where dni='$checkbox'";
$result = mysql_query($sql);
$actualiza = mysql_num_rows($result);
echo $actualiza;
	if ($actualiza==0)
	{
	$sql = "INSERT INTO alumno_burbuja VALUES ('$checkbox','$valor')";
	mysql_query($sql);
	}
	else
	{$sql = "UPDATE alumno_burbuja SET burbuja='$valor' WHERE dni='$checkbox'";
	//echo $sql;
	mysql_query($sql);
	}
}
?>
<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=burbuja.php?curso=<?echo $cursoxx; ?>'>				
</script>
<?

}












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


$rr = mysql_query ("SELECT * FROM curso2 where idcurso='$cursox'");
$rr = mysql_fetch_array($rr);

$cursillo=$rr['descripcion'];

?>

<form method="GET" action="burbuja.php">

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

$cursox=$_GET['curso'];
?>	

<tr>
				

					<td>
					<br>
					<p align="left" class="text1b">Asignar Alumnos a Burbujas:  <?echo $rr['descripcion']; ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<br><br>
					
					<select name='curso'>
					<?
					$sql = "SELECT * FROM curso2 ORDER BY descripcion ASC";
					$result = mysql_query($sql);
					while ($row = mysql_fetch_assoc($result))
						{ if ($row['idcurso']==$cursox)
							{echo "<option selected value=".$row['idcurso'].">".$row['descripcion']."</option>";}
						  else
							{echo "<option value=".$row['idcurso'].">".$row['descripcion']."</option>";}
						}				
					?>
                   </select>
					<input type='submit' value='Ver' name='verburbuja' />
 <div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
		
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>DNI</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Alumno</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Burbuja 1</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Burbuja 2</b></td>

		
		
	</tr>
	
<?php 		
		
			//echo "<td bgcolor='#EAEAEA' align='center'>";
			$ano=date("Y");
			//echo $ano;
			
		//	echo $curso;
		//	echo $division;
			$result79 = mysql_query ("SELECT a.dni,CONCAT(a.apellido,  ' ', a.nombre) as alumno FROM alumno a, cursa c WHERE c.control='1' AND c.curso='$curso' AND c.divi='$division' AND c.anio='$ano' AND c.alumno=a.dni ORDER by alumno");
			
				while ($fila79 = mysql_fetch_array($result79))
				{ echo "<tr>";	
					$dni=$fila79['dni'];
					$alumno=$fila79['alumno'];
					
					echo "<td bgcolor='#EAEAEA' align='center'><b>".$dni."</b></td>";
					echo "<td bgcolor='#EAEAEA' align='center'><b>".$alumno."</b></td>";
					$sql= "SELECT burbuja FROM alumno_burbuja where dni='$dni'";
					//echo $sql;
					$result = mysql_query($sql);
					$nos = mysql_num_rows($result);
					//echo $nos;
					if 	($nos==0)
					{echo "<td bgcolor='#EAEAEA' align='center'><input type='radio' name='ij[".$dni."]' value='1' ></td>";
					 echo "<td bgcolor='#EAEAEA' align='center'><input type='radio' name='ij[".$dni."]' value='2' ></td>";
					}
					else 		 
					{	
					while ($fila = mysql_fetch_array($result))
					{ 
					  //echo $nos;
						//echo 	$fila['burbuja']; 	
						
							if 	($fila['burbuja']==1)
							{
							 echo "<td bgcolor='#EAEAEA' align='center'><input type='radio' name='ij[".$dni."]' value='1' checked></td>";
							 echo "<td bgcolor='#EAEAEA' align='center'><input type='radio' name='ij[".$dni."]' value='2'  ></td>";}
							if 	($fila['burbuja']==2)
							{
							 echo "<td bgcolor='#EAEAEA' align='center'><input type='radio' name='ij[".$dni."]' value='1' ></td>";
							 echo "<td bgcolor='#EAEAEA' align='center'><input type='radio' name='ij[".$dni."]' value='2' checked></td>";}
							if 	($fila['burbuja']=='')
							{
							 echo "<td bgcolor='#EAEAEA' align='center'><input type='radio' name='ij[".$dni."]' value='1' ></td>";
							 echo "<td bgcolor='#EAEAEA' align='center'><input type='radio' name='ij[".$dni."]' value='2' ></td>";}
					}	
					}
					
					
					echo "<input type='hidden' name='alumnos[]' value='$dni'/>";
				}				
				
			
			
			echo "</tr>";
		}
		 
		 //echo "</tr>";
		
		
	?>		





						
						<tr>
							<td width="895" height="100" bgcolor="#EAEAEA" align="center" colspan="7">
							<br>
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:1000; float:center width:500px; height:125px; " /></td>
				
						</tr>
							
										
						
						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<br><br>
							
							<p align="center">&nbsp;</td>
						
						</tr>

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


  
  
  
  
  ?>


</html>

