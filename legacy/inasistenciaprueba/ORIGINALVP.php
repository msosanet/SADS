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
$materia=$_GET['materia'];
$cursox=$_GET['curso'];
//echo $cursox;

$rr = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1' AND idcurso='$cursox' order by curso,division ASC");
$rr = mysql_fetch_array($rr);

$cursillo=$rr['descripcion'];
$turnoc=$rr['turno'];
$curso=$rr['curso'];
$division=$rr['division'];

$cursotext = mysql_query ("SELECT * FROM materiax where curso=$cursillo");
$cursotext = mysql_fetch_array($resulturno);





?>

<form method="GET" action="ORIGINALVP.php">

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
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>HORARIO PARA EL CURSO <?=$rr['descripcion']?></b></font></td>
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
		/*if ($hora==0)
		{echo "<td bgcolor='#EAEAEA' align='center'><b>Pre-hora</b></td>";}
		else 
		{echo "<td bgcolor='#EAEAEA' align='center'><b>".$hora."</b></td>";}
		*/
		
		$cons=("SELECT * FROM horax where turno='$turnoc' AND hora='$hora'");
		$hor = mysql_query ("$cons");
		$hor = mysql_fetch_array($hor);
		$desde = $hor['desde'];
		$hasta = $hor['hasta'];
		//echo $desde;
		//echo $hasta;
		$horax=$desde."-".$hasta;
		echo "<td bgcolor='#EAEAEA' align='center'><b>".$horax."</b></td>";
		/*
		$curso=substr($_GET['curso'], 0,1);
		$division=substr($_GET['curso'], 1);
		*/
		
		//echo "<td bgcolor='#EAEAEA' align='center'><b>".$hora."</b></td>";
		for($dia=1;$dia<6;$dia++)
		{ 	
			//echo "<td bgcolor='#AAAEAEA' align='center' width='350' height='50'>";
			
			$result79 = mysql_query ("SELECT m.descripcion,m.idmateria FROM horariox h,materias m,curso2 c WHERE h.idmateria=m.idmateria AND h.idcurso=c.idcurso AND c.curso='$curso' AND c.division='$division' AND h.dia=$dia and h.hora=$hora AND h.idmateria!=65 ");
			//echo "SELECT m.descripcion, m.idmateria FROM materias m, curso2 c, horariox h WHERE m.idmateria=h.idmateria AND c.idcurso=h.idcurso AND c.curso='$curso' AND c.division='$division' AND h.dia='$dia' AND h.hora='$hora' ";
			//echo "SELECT m.descripcion,m.idmateria FROM horariox h,materias m,curso2 c WHERE h.idmateria=m.idmateria AND h.idcurso=c.idcurso AND c.curso='$curso' AND c.division='$division' AND h.dia=$dia and h.hora=$hora AND h.idmateria!=65";
			$elegidox = mysql_num_rows($result79);
			//echo "SELECT * FROM horarios h,materias m WHERE hora$hora=m.idmateria AND curso=".$cursox."";
			//echo $dia."[".$hora."]";
			
			if ($elegidox!=0)
			{
				while ($fila79 = mysql_fetch_array($result79))
				{ 	$horita=$fila79['descripcion'];
					//echo $horita;
					$matx=$fila79['idmateria'];
					
				}
				
				//echo "<br>";
			
				
			//echo "SELECT CONCAT(D.apellido,  ' ', D.nombre) as nombredoc,D.dni FROM docente D, matcur mc WHERE mc.idcurso=$cursox AND mc.idmateria=$matx AND mc.iddocente=D.dni AND D.dni!='0'";
			$result80 = mysql_query ("SELECT CONCAT(D.apellido,  ' ', D.nombre) as nombredoc,D.dni FROM docente D, matcur mc WHERE mc.idcurso='$cursox' AND mc.idmateria='$matx' AND mc.iddocente=D.dni");
			//echo ("SELECT CONCAT(D.apellido,  ' ', D.nombre) as nombredoc FROM docente D, matcur mc WHERE mc.idcurso=$cursox AND mc.idmateria=$matx AND mc.iddocente=D.dni");
			$elegido = mysql_num_rows($result80);
			//echo $elegido;
			if ($elegido!=0)
			{
			while ($fila80 = mysql_fetch_array($result80))
				{ 	$docx=$fila80['nombredoc'];
					$nombrex=$fila80['dni'];
													
				}
			}
			else 
			{
			$docx="SIN PROFESOR";
			}	
			
			
			
			echo "<td bgcolor='$nombrex' align='center' width='375' height='50'>";
		//	echo "<a href='http://docentes.colegiosobral.edu.ar/ORIGINAL.php?curso=$cursox&submitcurso=Grabar'><font face='arial' size='2'><strong>$horita</strong></font></a>";
			//echo "<br>";
			//http://inasistencias.colegiosobral.edu.ar/leg_unif.php?actor=30128612
			//http://inasistencias.colegiosobral.edu.ar/ver_hs_todos.php?actor=30128612
			
			?>
			
			<a onMouseOver="javascript:highlightLink(this, '#FFFF00');" 
			   onMouseOut="javascript:unhighlightLink(this);"
               HREF="ORIGINALVP.php?curso=<?echo $cursox?>&submitcurso=Grabar"><font color='white' face='arial' size='2'><strong><?echo $horita?></strong></font></a>
			           
			<br>
			<a onMouseOver="javascript:highlightLink(this, '#00FF00');" 
			onMouseOut="javascript:unhighlightLink(this);" 
			 HREF="ORIGINALVDP.php?actor=<?echo $nombrex?>&submitcurso=Grabar"><font color='white' face='verdana' size='1'><?echo $docx?></font></a>
			
			
			<?
			
			//echo "<a href='http://docentes.colegiosobral.edu.ar/asigdoc.php?curso=$cursox&submitcurso=Grabar'><font face='verdana' size='1'>$docx</font></a>";
			
			
			}
			else
			{echo "<td bgcolor='#FFFFFF' align='center' width='375' height='50'>";}
			
			
			}			
				
			echo "</td>";
			
		 
		 echo "</tr>";
		}
		
	?>		
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
					   HREF=""><font color='white' face='arial' size='2'><strong><?echo $fila80['nombredoc'];?></b></td></strong></font></a>
					</tr>
				
				<?}?>
			



						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<p align="center">&nbsp;</td>
						</tr>

						
						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<br><br>
							<a href="selcurhor.php">Volver</a>
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
