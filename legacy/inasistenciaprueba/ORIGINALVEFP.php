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


?>

<form method="GET" action="ORIGINALVEF.php">

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

<tr>
				

					<td>
					<br>
					<p align="left" class="text1b">Horario de Educacion Fisica</p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<br>
  
 <div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>HORARIO EDUCACION FISICA</b></font></td>
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
		for($hora=1;$hora<=28;$hora++)
		
		{
				
		echo "<tr>";
		/*if ($hora==0)
		{echo "<td bgcolor='#EAEAEA' align='center'><b>Pre-hora</b></td>";}
		else 
		{echo "<td bgcolor='#EAEAEA' align='center'><b>".$hora."</b></td>";}
		*/
		
		$cons=("SELECT * FROM horax where turno='EF' AND hora='$hora'");
		$hor = mysql_query ("$cons");
		$hor = mysql_fetch_array($hor);
		$desde = $hor['desde'];
		$hasta = $hor['hasta'];
		//echo $desde;
		//echo $hasta;
		$horax=$desde."-".$hasta;
		echo "<td bgcolor='#EAEAEA' align='center'><b>".$horax."</b></td>";
		
		
		
		
		//echo "<td bgcolor='#EAEAEA' align='center'><b>".$hora."</b></td>";
		for($dia=1;$dia<6;$dia++)
		{ 	
			//echo "<td bgcolor='#AAAEAEA' align='center' width='350' height='50'>";
			$consulta=("SELECT c.idcurso,c.descripcion, CONCAT(D.apellido,  ' ', D.nombre) as nombredoc,D.dni,c.curso,c.division FROM curso2 c, docente D, matcur mc, edfisica ef WHERE c.idcurso=mc.idcurso AND mc.iddocente=D.dni AND ef.idcurso=c.idcurso AND mc.idmateria='71' AND ef.hora=$hora AND ef.dia=$dia");
			//echo $consulta;
			$result79 = mysql_query ($consulta);
			$elegidox = mysql_num_rows($result79);
			//echo "SELECT * FROM horarios h,materias m WHERE hora$hora=m.idmateria AND curso=".$cursox."";
			//echo $dia."[".$hora."]";
			
			if ($elegidox!=0)
			{
				while ($fila79 = mysql_fetch_array($result79))
				{ 	$curso=$fila79['descripcion'];
					$cursox=$fila79['idcurso'];
					$cur=$fila79['curso'];
					$div=$fila79['division'];
					$nombrex=$fila79['dni'];
					$docente=$fila79['nombredoc'];
					
				}
				
				//echo "<br>";
				if ($nombrex=='0')
				{$color='#000000';
				 $docente="SIN PROFESOR";
				}
				else
				{$color='#'.$cur.$cur.$cur.$div.$div.$div;}
			
			echo "<td bgcolor='$color' align='center' width='375' height='50'>";
		//				
			?>
			
			<a onMouseOver="javascript:highlightLink(this, '#FFFF00');" 
			   onMouseOut="javascript:unhighlightLink(this);"
               HREF="ORIGINALVP.php?curso=<?echo $cursox?>&submitcurso=Ver+Curso"><font color='white' face='arial' size='2'><strong><?echo $curso?></strong></font></a>
			<br>
			<a onMouseOver="javascript:highlightLink(this, '#00FF00');" 
			   onMouseOut="javascript:unhighlightLink(this);" 
			   HREF=""><font color='white' face='verdana' size='1'><?echo $docente?></font></a>
			
			
			<?
			
			//echo "<a href='http://docentes.colegiosobral.edu.ar/asigdoc.php?curso=$cursox&submitcurso=Grabar'><font face='verdana' size='1'>$docx</font></a>";
			
			
			}
			else
			{echo "<td bgcolor='#FFFFFF' align='center' width='375' height='50'><a href='' target=_blank>VACANTE</a>";}
			
			
			}			
				
			echo "</td>";
			
		 
		 echo "</tr>";
		}
		
	?>		




						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<p align="center">&nbsp;</td>
						</tr>

						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							
							</td>
						</tr>
						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<br><br>
							<a href="menu.php">Volver</a>
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
