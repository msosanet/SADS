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
/*
 if (isset($_GET["submitx"])) {
     // verifico los errores en los campos
$conexion = conectar ();
$curso=$_GET['curso'];
//echo "Curso: ".$curso;
//for($hora=1;$hora<10;$hora++)
for($dia=1;$dia<6;$dia++)
	{
		for($hora=0;$hora<=10;$hora++)
			//for($dia=1;$dia<7;$dia++)
			{ 
			$cual[$hora]=$_GET[$hora][$dia];
			
			
			}
	
$consulta=mysql_query("SELECT * FROM horarios where curso=$curso AND dia=$dia");
$actualiza = mysql_num_rows($consulta);
//echo $actualiza;

//INSERTA O ACTUALIZA LOS HORARIOS
if ($actualiza<='0')
{
	
$sql = "INSERT INTO horarios VALUES ('$curso','$dia','$cual[0]','$cual[1]','$cual[2]','$cual[3]','$cual[4]','$cual[5]','$cual[6]','$cual[7]','$cual[8]','$cual[9]','$cual[10]')";
mysql_query($sql);
}

else
{	
$sql = "UPDATE horarios SET hora0='$cual[0]',hora1='$cual[1]',hora2='$cual[2]',hora3='$cual[3]',hora4='$cual[4]',hora5='$cual[5]',hora6='$cual[6]',hora7='$cual[7]',hora8=$cual[8],hora9=$cual[9],hora10='$cual[10]' WHERE curso=$curso AND dia=$dia";
mysql_query($sql);

}

for($i=0;$i<=10;$i++)
{
$matx=$cual[$i];
$consultax=mysql_query("SELECT * FROM matcur where idcurso=$curso AND idmateria=$matx");
//echo ("SELECT * FROM matcur where curso=$curso AND idmateria=$matx");
$actualizax = mysql_num_rows($consultax);
//echo $actualizax;

//echo $matx;
//INSERTA O ACTUALIZA LOS CURSO-MATERIA
if ($actualizax=='0')
{
	
$sql = "INSERT INTO matcur VALUES ($curso,$matx,0)";
//echo $sql;
mysql_query($sql);
}

else
{	

}
}
	
	
	
	

	}








}*/




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
$materia=$_GET['materia'];
$cursox=$_GET['curso'];
$actor=$_GET['actor'];
//echo $actor;
//echo $cursox;

$rr = mysql_query ("SELECT * FROM curso2 where idcurso=$cursox");
$rr = mysql_fetch_array($rr);

$cursillo=$rr['descripcion'];

$cursotext = mysql_query ("SELECT * FROM materiax where curso=$cursillo");
$cursotext = mysql_fetch_array($resulturno);





?>

<form method="GET" action="ORIGINAL.php">

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
?>	

<tr>
				

					<td>
					<br>
					<p align="left" class="text1b">Horario de  <?echo $rr['descripcion']; ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<br><br>
  
 <div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>HORARIO PARA EL CURSO</b></font></td>
	</tr>	
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Hora</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Miercoles</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>
		
	</tr>
	
<?php 		
		$hora='0';
		for($hora=0;$hora<=10;$hora++)
		
		{
				
		echo "<tr>";
		if ($hora==0)
		{echo "<td bgcolor='#EAEAEA' align='center'><b>Pre-hora</b></td>";}
		else 
		{echo "<td bgcolor='#EAEAEA' align='center'><b>".$hora."</b></td>";}
		
		//echo "<td bgcolor='#EAEAEA' align='center'><b>".$hora."</b></td>";
		for($dia=1;$dia<6;$dia++)
		{ 	
			echo "<td bgcolor='#EAEAEA' align='center'>";
			
			$result79 = mysql_query ("SELECT * FROM materias ORDER BY descripcion DESC");
			echo $dia."[".$hora."]";
			
				while ($fila79 = mysql_fetch_array($result79))
				{ 	$horita=$fila79['idmateria'];
					//echo $horita;
					//echo $cursillo;
					//echo $cursox;
					$consulta=mysql_query("SELECT * FROM horarios where curso=$cursox AND hora".$hora."=$horita AND dia=$dia");
					$elegido = mysql_num_rows($consulta);
					//echo $consulta;
					//echo $elegido;
									
					 	
							if ($elegido!='0')
							{
							echo "<option selected value=".$fila79['idmateria'].">".$fila79['descripcion']."</option>";
							}
							else 
							{
							echo "<option value=".$fila79['idmateria'].">".$fila79['descripcion']."</option>";
							}
							
				}
			echo "</td>";
			
		 }
		 echo "</tr>";
		}
		
	?>		


<input name="curso" type="hidden" value ="<?php echo $_GET['curso'] ?>"/>
<input name="division" type="hidden" value ="<?php echo $_GET['division'] ?>"/>

						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<p align="center">&nbsp;</td>
						</tr>

						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:700; float:center" /></td>
						</tr>
						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<br><br>
							<a href="http://docentes.colegiosobral.edu.ar/selcurso.php">Volver</a>
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
}

  
  
  
  
  ?>


</html>

