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

<style>
    select {
        width: 150px;
        margin: 10px;
    }
    select:focus {
        min-width: 150px;
        width: 300px;
    }
</style>

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
$materia=$_GET['materia'];
$cursox=$_GET['curso'];
//echo $cursox;

$rr = mysql_query ("SELECT * FROM curso2 where idcurso='$cursox'");
$rr = mysql_fetch_array($rr);

$cursillo=$rr['descripcion'];
$turnoc=$rr['turno'];
$cursoc=$rr['curso'];
$divic=$rr['division'];
$cursotext = mysql_query ("SELECT * FROM materiax where curso='$cursillo'");
$cursotext = mysql_fetch_array($resulturno);





?>

<form method="GET" action="ORIGINALV2.php">

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
					<p align="left" class="text1b">Horario de  <?echo $rr['descripcion']; ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<br>
  
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
		//CANTIDAD DE HORAS DEL TURNO
		$cons="SELECT * FROM curso2 c2,horax2 h WHERE c2.turno=h.turno AND c2.idcurso='$cursox'";
		$qhoras = mysql_query ($cons);
		$q = mysql_num_rows($qhoras);
		
		
		
		for($hora=1;$hora<=$q;$hora++)
		
		{
				
		echo "<tr>";
		
		$cons=("SELECT * FROM horax2 where turno='$turnoc' AND hora='$hora'");
		$hor = mysql_query ($cons);
		$hor = mysql_fetch_array($hor);
		$desde = $hor['desde'];
		$hasta = $hor['hasta'];
		$horax=$desde."-".$hasta;
		echo "<td bgcolor='#EAEAEA' align='center'><b>".$horax."</b></td>";
		
		for($dia=1;$dia<6;$dia++){
		$matsql="SELECT m.nombre,m.id FROM horariox2 h,materia_cargo m WHERE h.idmateria=m.id AND h.idcurso='$cursox' and h.dia='$dia' and h.hora='$hora'"	;
		//echo $matsql;
		$result79 = mysql_query ($matsql);
		{ 	
			$elegidox = mysql_num_rows($result79);
					
			if ($elegidox!=0)
			{
				while ($fila79 = mysql_fetch_array($result79))
				{ 	$horita=$fila79['nombre'];
					//echo $horita;
					$matx=$fila79['id'];
					
				}
				
			$sql="SELECT CONCAT(D.apellido,  ' ', D.nombre) as nombredoc,D.dni FROM docente D, materia_cargo mc,alta_baja ab WHERE mc.curso='$cursoc' AND mc.division='$divic' AND mc.id='$matx' AND ab.docente=D.dni AND AND ab.activa='1' AND D.dni!='0' AND ab.materia=mc.id";
			//echo $sql;
			$result80 = mysql_query ($sql);
		
			$elegido = mysql_num_rows($result80);
			//echo $elegido;
			if ($elegido!=0)
			{$c=1;
				while ($fila80 = mysql_fetch_array($result80))
				{ 	$docx=$fila80['nombredoc'];
					$colorx = dechex(rand(124,255)) . dechex(rand(124,255)) . dechex(rand(124,255));
					$c++;
					
						
					
				echo "<td bgcolor='$colorx' align='center' width='375' height='50'>";
//				echo "<td bgcolor='FFFFFF' align='center' width='375' height='50'>";
						?>
					
						<a onMouseOver="javascript:highlightLink(this, '#FFFF00');" 
					   onMouseOut="javascript:unhighlightLink(this);"
					   HREF="ORIGINAL.php?curso=<?echo $cursox?>&submitcurso=Grabar"><font color='white' face='arial' size='2'><strong><?echo $horita?></strong></font></a>
						<br>
						<a onMouseOver="javascript:highlightLink(this, '#00FF00');" 
					   onMouseOut="javascript:unhighlightLink(this);" 
					   HREF="ORIGINALVD.php?actor=<?echo $colorx?>&submitcurso=Grabar"><font color='white' face='verdana' size='1'><?echo $docx?></font></a>
					
					
					<?
											
						
						echo "<br>";	
						
							
						
				}
						echo "</td>";
			}
			else 
			{
				$docx="SIN PROFESOR";
				$colorx="FC0303";
//				echo "<td bgcolor='FFFFFF' align='center' width='375' height='50'>";
				echo "<td bgcolor='$colorx' align='center' width='375' height='50'>";
				?>
				
				<a onMouseOver="javascript:highlightLink(this, '#FFFF00');" 
				   onMouseOut="javascript:unhighlightLink(this);"
				   HREF="ORIGINAL.php?curso=<?echo $cursox?>&submitcurso=Grabar"><font color='white' face='arial' size='2'><strong><?echo $horita?></strong></font></a> 
				<br>
				<a onMouseOver="javascript:highlightLink(this, '#00FF00');" 
				   onMouseOut="javascript:unhighlightLink(this);" 
				   HREF="ORIGINALVD.php?actor=<?echo $colorx?>&submitcurso=Grabar"><font color='white' face='verdana' size='1'><?echo $docx?></font></a>
				
				
				<?
				echo "</td>";
			}	
			
			
			
			
			
			
			
			
			}
			else
			{echo "<td bgcolor='#FFFFFF' align='center' width='375' height='50'>";}
			
			
			}			
				
			echo "</td>";
			
		} 
		 echo "</tr>";
		}
		
	?>		
	
	</table>
			</div>
		</tr>

		<div align="center">
			<table border="0" width="980">

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
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="3"><font color="000FFF"><b><a href="ORIGINALVEF.php">HORARIO EDUCACION FISICA</A></b></font></td>
	</tr>	
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Dia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Hora</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Docente</b></td>
			
	</tr>
	
<?php 			
			$consulta=("SELECT ef.dia,h.desde,h.hasta,CONCAT(D.apellido, ' ', D.nombre) as nombredoc,D.dni FROM horax h, edfisica ef,docente D,matcur mc WHERE mc.idcurso='$cursox' AND mc.idmateria='71' AND mc.iddocente=D.dni AND ef.hora=h.hora AND ef.idcurso='$cursox' AND h.turno='EF'  ORDER BY ef.dia,h.desde");
			//echo $consulta;
			$result80 = mysql_query ($consulta);
			while ($fila80 = mysql_fetch_array($result80))
				{
					
					switch ($fila80['dia']) {
					case 1:  $day="Lunes";
					break;
					case 2:  $day="Martes";
					break;
					case 3:  $day="Miercoles";
					break;
					case 4:  $day="Jueves";
					break;
					case 5:  $day="Viernes";
					break;
					case 6:  $day="Sabado";
					break;
					case 7:  $day="Domingo";
					break;
					}
					
					//$day = date("w",$fila80['dia']);
				?>	
					<tr>
					<td bgcolor="#FFFFFF" align="center"><b><?echo $day;?></b></td>
					<td bgcolor="#FFFFFF" align="center"><b><?echo $fila80['desde'].'-'.$fila80['hasta'];?></b></td>
					<td bgcolor="#eeee" align="center"><b><a onMouseOver="javascript:highlightLink(this, '#EEEE');" 
					   onMouseOut="javascript:unhighlightLink(this);"
					   HREF="ORIGINALVD.php?actor=<?echo $fila80['dni']?>&submitcurso=Grabar"><font color='white' face='arial' size='2'><strong><?echo $fila80['nombredoc'];?></b></td></strong></font></a>
					</tr>
				<?php	
				}
			//$result79 = mysql_query ($consulta);
			//$elegidox = mysql_num_rows($result79);
				
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
						
							<a href="selcurhor.php">Volver</a>
							<p align="center">&nbsp;</td>
						
						</tr>

					</div>
					<p align="right">&nbsp;</div>
					<hr>
					</td>
				</tr></table>
			</div>
		</tr>
	</table>


	</form>
<br><br><br><br><br>
				<?
include 'footer.php';
?>
			





</div>
</body>
<?
}

  
  
  
  
  ?>


</html>

