<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
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
$fechax=$_GET['fecha'];

$rr = mysql_query ("SELECT * FROM curso2 where idcurso='$cursox'");
$rr = mysql_fetch_array($rr);

$cursillo=$rr['descripcion'];
$turnoc=$rr['turno'];
$cursotext = mysql_query ("SELECT * FROM materiax where curso=$cursillo");
$cursotext = mysql_fetch_array($resulturno);





?>

<form method="GET" action="partepreceptores.php">

</p>
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>

			<div align="center">
			<table border="0" width="980">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>

<tr>


					<td>
					<br>
					<p align="left" class="text1b">Parte Diario de  <?echo $rr['descripcion']; ?> para la fecha <?echo $fechax; ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">

					<div align="center">

					<br>

 <div align="center">

					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>PARTE PARA EL CURSO</b></font></td>
	</tr>
	<tr>

		<td bgcolor="#EAEAEA" align="center"><b>Hora</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Materia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Docente</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>P</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>T</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>A</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Observaciones</b></td>
	</tr>

	</tr>

<?php
		//$dia=date('N');

		$dia= date('w', strtotime($fechax));
		//echo $dia;
echo '<input type="hidden" name="curso" value="'. $cursox. '">';
echo '<input type="hidden" name="fechaxx" value="'. $fechax. '">';
echo '<input type="hidden" name="cursodesc" value="'. $rr['descripcion']. '">';
$j=0;
$parte="SELECT m.descripcion,m.idmateria,D.dni,h.hora,mc.idprofesor FROM horariox h, materias m, docente D, matcur mc WHERE h.idmateria!='65' AND h.idmateria=m.idmateria AND h.idcurso='$cursox' AND h.dia='$dia' AND mc.idcurso='$cursox' AND mc.idmateria!='65' AND h.idmateria=mc.idmateria AND mc.iddocente=D.dni ORDER BY h.hora ASC";
//echo $parte;
$result = mysql_query ($parte);

			while ($fila = mysql_fetch_array($result))
			{
			$idprofesor=$fila['idprofesor'];
			$materia=$fila['idmateria'];
			$materiadesc=$fila['descripcion'];
			$dni=$fila['dni'];
			$hora=$fila['hora'];

			echo "<tr>";

			?>
			<td bgcolor="#EAEAEA" align="center"><b><?echo $fila['hora']; ?></b></td>
			<td bgcolor="#EAEAEA" align="center"><b><?echo $fila['descripcion']; ?></b></td>

			<?
				$result2=mysql_query("SELECT CONCAT(D.apellido,  ' ', D.nombre) as nombredoc,D.dni FROM docente D ORDER BY nombredoc ASC");


				echo "<td>";

				echo "<select name=docente[]>";


					while ($fila2 = mysql_fetch_array($result2))
					{
						if ($dni===$fila2['dni'])
						{echo "<option value=".$fila2['dni']." selected>".$fila2['nombredoc']."</option>";}
						else
						{echo "<option value=".$fila2['dni'].">".$fila2['nombredoc']."</option>";}



					}
				echo "</select>";

			 echo '<input type="hidden" name="materia[]" value="'. $materiadesc. '">';
			 echo '<input type="hidden" name="materiaid[]" value="'. $materia. '">';
			 echo '<input type="hidden" name="horax[]" value="'. $hora. '">';
			 echo '<input type="hidden" name="profesor[]" value="'. $idprofesor. '">';
			 echo "</td>";

			echo "<td><input type='radio' name='ij[".$j."]' checked='checked' value='P'></td>";
			echo "<td><input type='radio' name='ij[".$j."]' value='T'></td>";
			echo "<td><input type='radio' name='ij[".$j."]' value='A'></td>";
			echo "<td><input type='text' name='observaciones[] value=''/></td>";
			$j++;


			echo "</tr>";


			}
echo "<td>";
echo "</td>";
echo "<td colspan='7' align='center'>";
?>
<input type="submit" value="     Generar Parte     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:1000; float:center width:700px; height:125px; " />
<?
echo "</td>";











	?>





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
/*
 if(isset($_GET['submitx']))
 {
 foreach ($_GET['materia'] as $materia)
{
echo "$materia";
}
foreach ($_GET['docente'] as $docente)
{
	echo $docente;
}

foreach ($_GET['ij'] as $ausente)
{
	echo $ausente;

}

  */


//}



 if(isset($_GET['submitx']))
 {
$materia=$_GET['materia'];
$profesor=$_GET['profesor'];
$docente=$_GET['docente'];
$ausente=$_GET['ij'];
$curso=$_GET['curso'];
$cursodescx=$_GET['cursodesc'];
$fechaxxx=$_GET['fechaxx'];
$materiaidx=$_GET['materiaid'];
$hora=$_GET['horax'];
$observaciones=$_GET['observaciones'];
//$fecha=date("d-m-Y");


for ($i = 0; $i < count($profesor); $i++)
{
$sql = "INSERT INTO partepreceptores VALUES ('','$fechaxxx','$curso','$hora[$i]','$docente[$i]','$materiaidx[$i]','$ausente[$i]','$observaciones[$i]','','','') ";
$result = mysql_query($sql) or die(mysql_error());

$verdocente="SELECT * FROM matcur WHERE iddocente='$docente[$i]' AND idcurso='$curso' AND idmateria='$materiaidx[$i]' AND idprofesor='$profesor[$i]'";
$resultdoc = mysql_query ($verdocente);
$cantidadx=mysql_num_rows($resultdoc);

if ($cantidadx==0)
{$sql2="UPDATE matcur SET iddocente='$docente[$i]' WHERE idcurso='$curso' AND idmateria='$materiaidx[$i]' AND idprofesor='$profesor[$i]'";
$result2 = mysql_query($sql2) or die(mysql_error());}

/*echo $sql."<br>";*/
//echo $sql2."<br>";


}
?>
			<script>
			var answer=alert("Se ha cargado el parte del dia <?echo $fechaxxx;?> para el curso <?echo $cursodescx;?>")
			</script>
			<meta http-equiv='refresh' content='0; URL=selcurhorpartes.php'>
<?

}


















  ?>































</html>

