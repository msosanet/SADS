<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion3.php';

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

 if (isset($_GET["submitx"])) {
     // verifico los errores en los campos
$conexion = conectar ();

for($dia=1;$dia<6;$dia++)
	{
		for($hora=1;$hora<=30;$hora++)
		{ 
			$cual[$hora]=$_GET[$hora][$dia];
			$sql = "SELECT * FROM edfisica2 WHERE dia='$dia' AND hora='$hora'";
			$consulta=mysql_query($sql);
			$actualiza = mysql_num_rows($consulta);

			if ($actualiza=='0')
			{
			$sql = "INSERT INTO edfisica2 VALUES ('$cual[$hora]','$dia','$hora')";
			mysql_query($sql);
			}

			if ($actualiza=='1')
			{	
			$sql = "UPDATE edfisica2 SET idcurso='$cual[$hora]' WHERE dia='$dia' AND hora='$hora'";
			//echo $sql;
			mysql_query($sql);

			}
		}
	}

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
$materia=$_GET['materia'];
$cursox=$_GET['curso'];


?>

<form method="GET" action="ORIGINALEF2.php">

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
					<p align="left" class="text1b">Horarios de  Educacion Fisica<?echo $rr['descripcion']; ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<br><br>
  
 <div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>HORARIOS DE EDUCACION FISICA</b></font></td>
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
		$hora='1';
		for($hora=1;$hora<=30;$hora++)
		
		{
				
		echo "<tr>";
		
		$cons=("SELECT * FROM horax where turno='EF' AND hora='$hora'");
		$hor = mysql_query ("$cons");
		$hor = mysql_fetch_array($hor);
		$desde = $hor['desde'];
		$hasta = $hor['hasta'];
		$horax=$desde."-".$hasta;
		$colorx = dechex(rand($cursox,255)) . dechex(rand($cursox,255)) . dechex(rand(124,255));
		echo "<td bgcolor='#EAEAEA' align='center'><b>".$horax."</b></td>";
		//echo "hola";
		//echo "<td bgcolor='#EAEAEA' align='center'><b>".$hora."</b></td>";
		for($dia=1;$dia<6;$dia++)
		{ 	
			echo "<td bgcolor='$colorx' align='center'>";
			$mt=utf8_decode("Educación Física");
			$consultaSQL="SELECT * FROM materia_cargo mc, curso2 c WHERE mc.curso=c.curso AND mc.division=c.division  AND mc.nombre LIKE '%$mt%' AND mc.activo='1' AND c.habilitado='1' order by mc.curso,mc.division ASC";
			//echo $consultaSQL;
			$resultcurso = mysql_query ($consultaSQL) or die ("Error in query: $consultaSQL. ".mysql_error());;
			//echo $fila79['descripcion'];
			echo "<select name='".$hora."[".$dia."]'>";
				echo "<option selected value='0'>VACIO</option>";
				while ($fila79 = mysql_fetch_array($resultcurso))
				{ 	$curso=$fila79['idcurso'];
					//echo $curso;
					//echo "Error: ".mysql_error();
					$consulta=mysql_query("SELECT * FROM edfisica2 where idcurso='$curso' AND dia='$dia' AND hora='$hora'");
					$elegido = mysql_num_rows($consulta);
					
					 	
							if ($elegido!='0')
							{
							echo "<option selected value=".$curso.">".$fila79['descripcion']."</option>";
							}
							else 
							{
							echo "<option value=".$curso.">".$fila79['descripcion']."</option>";
							}
							
			//	echo "<option selected value='0'>VACIO</option>";
				
				}
				
			echo "</select>";
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
							<a href="javascript:history.back()">Volver</a>
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
