<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
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
<body>

<style type="text/css">
</style>

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$materia=$_GET['materia'];
$cursox=$_GET['curso'];
$rr = mysql_query ("SELECT * FROM curso2 where idcurso='$cursox'");
$rr = mysql_fetch_array($rr);

$cursillo=$rr['descripcion'];
$turnoc=$rr['turno'];

?>
<div align="center" style="max-width: 980px">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
<form method="GET" action="ORIGINAL.php">

	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
			<table border="0" width="980">
				<tr>
					<td>
					<br>
 <div align="center">
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td width="895" style="background-color:#EAEAEA;text-align:center" colspan="7"><a href="https://secdoc.colegiosobral.edu.ar/horariobyn.php?curso=<?=$cursox?>&submitcurso=Mostrar" title="click para abrir versi&oacute;n para imprimir" target="_blank"><span style="color:#F00000;font-weight: bold;">Horario de  <?=$rr['descripcion']; ?></span></a></td>
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
		$cons=("SELECT * FROM horax where turno='$turnoc' AND hora='$hora'");
		$hor = mysql_query ($cons);
		$hor = mysql_fetch_array($hor);
		$desde = $hor['desde'];
		$hasta = $hor['hasta'];
		$horax=$desde."-".$hasta;
		echo "<td bgcolor='#EAEAEA' align='center'><b>".$horax."</b></td>";
		for($dia=1;$dia<6;$dia++)
		{
			$result79 = mysql_query ("SELECT m.descripcion,m.idmateria FROM horariox h,materias m WHERE h.idmateria=m.idmateria AND h.idcurso='$cursox' and h.dia='$dia' and h.hora='$hora' AND h.idmateria!='65'");
			$elegidox = mysql_num_rows($result79);
			if ($elegidox!=0)
			{
				while ($fila79 = mysql_fetch_array($result79))
				{ 	$horita=$fila79['descripcion'];
					$matx=$fila79['idmateria'];
				}
			$docmatcur="SELECT CONCAT(D.apellido,  ' ', D.nombre) as nombredoc,D.dni FROM docente D, matcur mc WHERE mc.idcurso='$cursox' AND mc.idmateria='$matx' AND mc.iddocente=D.dni AND D.dni!='0'";
			//echo $docmatcur;
			$result80 = mysql_query ($docmatcur);
			$elegido = mysql_num_rows($result80);
			if ($elegido!=0)
			{$c=1;
				while ($fila80 = mysql_fetch_array($result80))
				{ 	$docx=$fila80['nombredoc'];
					$nombrex=$fila80['dni'];
					$c++;

				//}
				if ($c==2)
						{
				echo "<td bgcolor='$nombrex' align='center' width='375' height='50'>";
						?>

						<a onMouseOver="javascript:highlightLink(this, '#FFFF00');"
					   onMouseOut="javascript:unhighlightLink(this);"
					   HREF="ORIGINAL.php?curso=<?echo $cursox?>&submitcurso=Grabar"><font color='white' face='arial' size='2'><strong><?echo $horita?></strong></font></a>
						<?}
						?>
						<br>
						<a onMouseOver="javascript:highlightLink(this, '#00FF00');"
					   onMouseOut="javascript:unhighlightLink(this);"
					   HREF="ORIGINALVD.php?actor=<?echo $nombrex?>&submitcurso=Grabar"><font color='white' face='verdana' size='1'><?echo $docx?></font></a>
						<?

						//echo "<br>";

				}
						if ($c==2){echo "</td>";}
			}
			else
			{
				$docx="SIN PROFESOR";
				$nombrex="FC0303";
				echo "<td bgcolor='$nombrex' align='center' width='375' height='50'>";
				?>
				<a onMouseOver="javascript:highlightLink(this, '#FFFF00');"
				   onMouseOut="javascript:unhighlightLink(this);"
				   HREF="ORIGINAL.php?curso=<?echo $cursox?>&submitcurso=Grabar"><font color='white' face='arial' size='2'><strong><?echo $horita?></strong></font></a>
				<br>
				<a onMouseOver="javascript:highlightLink(this, '#00FF00');"
				   onMouseOut="javascript:unhighlightLink(this);"
				   HREF="ORIGINALVD.php?actor=<?echo $nombrex?>&submitcurso=Grabar"><font color='white' face='verdana' size='1'><?echo $docx?></font></a>
				<?
				echo "</td>";
			}
			}
			else
			{echo "<td bgcolor='#FFFFFF' align='center' width='375' height='50'>";}
			}
			echo "</td>";
		 echo "</tr>";
		}

	?>
	</table>
			</div>
			</td>
		</tr>

		<div align="center">
			<table border="0" width="980">

				<tr>
					<td>
<div align="left">

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
						</table>
					</div>
					<p align="right">&nbsp;</p>
					<hr>
					</td>
				</tr>
			</div>
	</table></div>
		</td>
		</tr>

	</table>
</div>
	</table>

	</form>
	</div>
<br><br><br><br><br>
<?
include 'footer.php';
?>

</body>
<?
}
?>


</html>

