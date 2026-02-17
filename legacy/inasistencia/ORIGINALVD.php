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
$actor=$_GET['actor'];
//echo $cursox;

$rr = mysql_query ("SELECT CONCAT(D.apellido,  ' ', D.nombre) as nombredoc FROM docente D WHERE D.dni=$actor");
$rr = mysql_fetch_array($rr);

$cursotextx=$rr['nombredoc'];
//echo  $cursotextx;
/*
$cursotext = mysql_query ("SELECT CONCAT(D.apellido,  ' ', D.nombre) as nombredoc FROM docente where dni=$actor");
$cursotextz = mysql_fetch_array($cursotext);
$cursotextx= $cursotextz['nombredoc'];

*/



?>

<form method="GET" action="ORIGINAL.php">

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

/*for($j=1;$j<4;$j++)
{

if ($j==1)
{
$turno='M';
}
if ($j==2)
{
$turno='T';
}
if ($j==3)
{
$turno='V';
}*/

?>

<tr>


					<td>
					<br>
					<p align="left" class="text1b">Horario de  <?echo $cursotextx; ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">

					<div align="center">

					<br>

<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">

<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>RESUMEN DE HORARIO</b></font></td>
</tr>


<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Curso</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Turno</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Materia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Cantidad</b></td>


</tr>
<?
	//TABLA CON RESUMEN (MATERIA, CANTIDAD DE HORAS, CURSO)
	$db2 = mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("base_sobral",$db2);


	$result80 = mysql_query ("SELECT C.descripcion,C.turno,M.descripcion,COUNT(*) as Cantidad,MC.idmateria,C.idcurso FROM curso2 C, materias M, matcur MC, horariox H WHERE C.idcurso=MC.idcurso AND M.idmateria=MC.idmateria AND MC.iddocente='$actor' AND H.idcurso=MC.idcurso AND H.idmateria=MC.idmateria AND H.idmateria!='65'  GROUP BY C.descripcion,M.descripcion ORDER BY C.turno");
	//$result80 = mysql_query ("SELECT C.descripcion,C.turno,M.descripcion,COUNT(*) as Cantidad FROM curso2 C, materias M, matcur MC, horariox H WHERE C.idcurso=MC.idcurso AND M.idmateria=MC.idmateria AND MC.iddocente=$actor AND H.idcurso=MC.idcurso AND H.idmateria!=65  GROUP BY C.descripcion,M.descripcion ORDER BY C.turno");
	//$elegido = mysql_num_rows($result80);
	//echo $elegido;




	while ($fila81 = mysql_fetch_array($result80))
	{

		//echo "-----------".$fila81[3];
		//SI ES EDUCACION FISICA VAMOS A CONSULTAR A LA TABLA QUE ALMACENA LOS HORARIOS DE EF
		echo "<tr>";
		echo "<td bgcolor='#FFFFFF' align='center'>".$fila81[0]."</td>";
		echo "<td bgcolor='#FFFFFF' align='center'>".$fila81[1]."</td>";
		echo "<td bgcolor='#FFFFFF' align='center'>".$fila81[2]."</td>";
		echo "<td bgcolor='#FFFFFF' align='center'>".$fila81[3]."</td>";
		echo "</tr>";


	}


	$result81 = mysql_query ("SELECT C.descripcion,C.turno,M.descripcion,COUNT(ED.idcurso) as Cantidad FROM curso2 C, materias M, matcur MC, edfisica ED WHERE ED.idcurso=C.idcurso AND MC.idmateria='71' AND MC.iddocente='$actor' AND MC.idmateria=M.idmateria AND MC.idcurso=ED.idcurso GROUP BY C.descripcion,M.descripcion ORDER BY C.descripcion");
	while ($fila82 = mysql_fetch_array($result81))
		{
			echo "<tr>";
			echo "<td bgcolor='#FFFFFF' align='center'>".$fila82[0]."</td>";
			echo "<td bgcolor='#FFFFFF' align='center'>".$fila82[1]."</td>";
			echo "<td bgcolor='#FFFFFF' align='center'><a href='ORIGINALVEF.php'>".$fila82[2]."</a></td>";
			echo "<td bgcolor='#FFFFFF' align='center'>".$fila82[3]."</td>";
			echo "</tr>";
		}








echo "</table>";

?>

<?
 for($j=1;$j<5;$j++)
{

if ($j==1)
{
$turnoc='M';
}
if ($j==2)
{
$turnoc='T';
}
if ($j==3)
{
$turnoc='V';
}
if ($j==4)
{
$turnoc='E';
}
 ?>


 <div align="center">

					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>HORARIO DE <?echo $cursotextx; ?></b></font></td>
	</tr>
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>TURNO <?echo $turnoc; ?></b></font></td>
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
		//echo $turnoc;
		echo "<tr>";

		$cons=("SELECT * FROM horax where turno='$turnoc' AND hora='$hora'");
		$hor = mysql_query ("$cons");
		$hor = mysql_fetch_array($hor);
		$desde = $hor['desde'];
		$hasta = $hor['hasta'];
		//echo $desde;
		//echo $hasta;
		$horax=$desde."-".$hasta;
		echo "<td bgcolor='#EAEAEA' align='center'><b>".$horax."</b></td>";




		/*if ($hora==0)
		{echo "<td bgcolor='#EAEAEA' align='center'><b>Pre-hora</b></td>";}
		else
		{echo "<td bgcolor='#EAEAEA' align='center'><b>".$hora."</b></td>";}*/

		for($dia=1;$dia<6;$dia++)
		{


				//$sqlxxx="SELECT m.descripcion,CONCAT(D.apellido,  ' ', D.nombre) as nombredoc FROM docente D, materias m, matcur mc, horariox h, curso2 c WHERE h.hora=$hora AND h.idcurso=mc.idcurso AND h.dia=$dia AND mc.idcurso=h.idcurso AND h.idcurso=c.idcurso AND m.idmateria=h.idmateria AND mc.iddocente=D.dni AND mc.iddocente=$actor AND h.idmateria=$mat";
				//echo $sqlxxx;
				$result80 = mysql_query ("SELECT m.descripcion,CONCAT(D.apellido,  ' ', D.nombre) as nombredoc,h.idcurso,c.descripcion as cursito FROM docente D, materias m, matcur mc, horariox h, curso2 c WHERE h.hora='$hora' AND h.idcurso=mc.idcurso AND h.dia='$dia' AND mc.idcurso=h.idcurso AND h.idcurso=c.idcurso AND mc.idmateria=h.idmateria AND m.idmateria=h.idmateria AND mc.iddocente=D.dni AND mc.iddocente='$actor' AND c.turno='$turnoc'");
				$elegido = mysql_num_rows($result80);
				//echo $elegido;
		//		echo "SELECT m.descripcion,CONCAT(D.apellido,  ' ', D.nombre) as nombredoc,h.idcurso,c.descripcion as cursito FROM docente D, materias m, matcur mc, horariox h, curso2 c WHERE h.hora='$hora' AND h.idcurso=mc.idcurso AND h.dia='$dia' AND mc.idcurso=h.idcurso AND h.idcurso=c.idcurso AND mc.idmateria=h.idmateria AND m.idmateria=h.idmateria AND mc.iddocente=D.dni AND mc.iddocente='$actor' AND c.turno='$turnoc'";
				if ($elegido!=0)
				{
				$fila80 = mysql_fetch_array($result80);
				$docx=$fila80['nombredoc'];
				$horita=$fila80['descripcion'];
				$cursox=$fila80['idcurso'];
				$cursito=$fila80['cursito'];




			//echo $elegido;
			if ($elegido>1)
			{
			echo "<td bgcolor='#ff0000' align='center' width='375' height='50'>";
			echo "<font face='verdana' size='1'>SUPERPOSICION!!</font></a>";
			echo "<br>";
			$result81 = mysql_query ("SELECT m.descripcion,CONCAT(D.apellido,  ' ', D.nombre) as nombredoc,h.idcurso,c.descripcion as cursito FROM docente D, materias m, matcur mc, horariox h, curso2 c WHERE h.hora='$hora' AND h.idcurso=mc.idcurso AND h.dia='$dia' AND mc.idcurso=h.idcurso AND h.idcurso=c.idcurso AND mc.idmateria=h.idmateria AND m.idmateria=h.idmateria AND mc.iddocente=D.dni AND mc.iddocente='$actor' AND c.turno='$turnoc'");
			while ($fila81 = mysql_fetch_array($result81))
				{//echo $elegido;
			$cursoxx=$fila81['idcurso'];
			?>
				<a onMouseOver="javascript:highlightLink(this, '#FFFF00');"
			   onMouseOut="javascript:unhighlightLink(this);"
               HREF="ORIGINAL.php?curso=<?echo $cursoxx?>&submitcurso=Grabar"><font face='arial' size='2'><strong><?echo $fila81['descripcion']?></strong></font></a>
			<?
				//echo $fila81['descripcion'];
				echo "<br>";
				}
			}
			else
			{
			echo "<td bgcolor='#AAAA$matx' align='center' width='375' height='50'>";

			?>


			<a onMouseOver="javascript:highlightLink(this, '#FFFF00');"
			   onMouseOut="javascript:unhighlightLink(this);"
               HREF="ORIGINAL.php?curso=<?echo $cursox?>&submitcurso=Grabar"><font face='arial' size='2'><strong><?echo $horita?></strong></font></a>
			<br>
			<a onMouseOver="javascript:highlightLink(this, '#00FF00');"
			   onMouseOut="javascript:unhighlightLink(this);"
			   HREF="asigdoc.php?curso=<?echo $cursox?>&submitcurso=Grabar"><font face='verdana' size='1'><?echo $docx?></font></a>
			<br>
			<a onMouseOver="javascript:highlightLink(this, '#00FF00');"
			   onMouseOut="javascript:unhighlightLink(this);"
			   HREF="ORIGINAL.php?curso=<?echo $cursox?>&submitcurso=Grabar"><font face='verdana' size='0.5'><?echo $cursito?></font></a>

			<?

			//echo "<a href='http://docentes.colegiosobral.edu.ar/asigdoc.php?curso=$cursox&submitcurso=Grabar'><font face='verdana' size='1'>$docx</font></a>";

			}
			}
			else
			{echo "<td bgcolor='#FFFFFF' align='center' width='375' height='50'>";}

			}



			echo "</td>";


		 echo "</tr>";

		}
	echo "<br>";
	echo "<br>";
	echo "<br>";
	}
/*


*/





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
							<a href="selcurhor.php">Volver</a>
							<p align="center">&nbsp;</td>

						</tr>

					</div>
					<p align="right">&nbsp;</div>
					<hr>
					</td>
				</tr>

			</table>
			</div>
		</tr>
	</table>


	</form>
</div>
<?
include 'footer.php';
?>
</body>
<?
}





  ?>


</html>
