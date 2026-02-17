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
$conexion = conectar ();
 if (isset($_GET["submitx"]))
{
 // verifico los errores en los campos
$conexion = conectar ();
$curso=$_GET['curso'];

$i=0;
/*foreach ($_GET['asigna'] as $d)
	{	$es=$_GET['matmat'];
		$prof=$_GET['profesor'];
		$mate=$es[$i];
		$todos=$_GET['todos'];
		$sql = "UPDATE matcur SET iddocente='$d' WHERE idmateria='$mate' AND idcurso='$curso' AND idprofesor='$prof[$i]'";
		$i++;
		echo $sql."<br>";
		//mysql_query($sql);

	}*/

foreach ($_GET['asigna'] as $materia => $profesores) {
        // Iterar sobre los profesores de cada materia
        foreach ($profesores as $profesor => $dnidocente) {
            // $valor contiene el valor seleccionado del elemento <select>
            $sql = "UPDATE matcur SET iddocente='$dnidocente' WHERE idmateria='$materia' AND idcurso='$curso' AND idprofesor='$profesor'";
			mysql_query($sql);
			//echo $sql."<br>";
			//echo "Materia: $materia, Profesor: $profesor, Valor seleccionado: $valor\n"."<br>";
		}
    }








}
//var_dump($_GET);


//BORRA O AGREGA PAREJA PEDAGOGICA
if (isset($_GET["a"]) && isset($_GET["ppm"]) && isset($_GET["ppc"]) && isset($_GET["idp"]) &&
    !is_null($_GET["a"]) && !is_null($_GET["ppm"]) && !is_null($_GET["ppc"]) && !is_null($_GET["idp"]) && is_numeric($_GET["idp"]) )
{







  if  ($_GET["a"]=='a')
	{   $sqlQidp = "SELECT COUNT(*) as Total FROM matcur WHERE idcurso='$_GET[ppc]' AND idmateria='$_GET[ppm]'";
		$rr1 = mysql_query($sqlQidp) or die("Error en la consulta: " . mysql_error());
		$rr = mysql_fetch_array($rr1);
		$idpn = $rr['Total'] + 1;
		$sqlAdd="INSERT INTO matcur VALUES ('$_GET[ppc]','$_GET[ppm]','0','$idpn')";
		//echo $sqlAdd;
		if (mysql_query($sqlAdd)) echo "<meta http-equiv='refresh' content='0; URL=asigdoc.php?curso=".$_GET[ppc]."'>";
		//echo $sqlAdd;
	}

	if  ($_GET["a"]=='b')
	{
		if ($_GET["idp"]>1)
		{$sqlDel="DELETE FROM matcur WHERE idcurso='$_GET[ppc]' AND idmateria='$_GET[ppm]' AND idprofesor='$_GET[idp]' ";
		//if (mysql_query($sqlAdd)) echo "<meta http-equiv='refresh' content='0; URL=asigdoc.php?curso=".$_GET[ppc]."'>";
		//echo $sqlAdd;
		//echo $sqlDel;
		if (mysql_query($sqlDel)) echo "<meta http-equiv='refresh' content='0; URL=asigdoc.php?curso=".$_GET[ppc]."'>";
		}
	}







}
//FIN BORRA O AGREGA PAREJA PEDAGOGICA


?>
<body >

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

$cursotext = mysql_query ("SELECT * FROM materiax where curso='$cursillo'");
$cursotext = mysql_fetch_array($resulturno);





?>

<div style="max-width:980px">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>

</div>

<form method="GET" action="asigdoc.php">

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

<tr>


					<td>
					<br>
					<p align="left" class="text1b">Asignar Docentes a:  <?echo $rr['descripcion']; ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">

					<div align="center">

					<br><br>

 <div align="center">

					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">

	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Materia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Docente</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>PP?</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>X</b></td>


	</tr>

<?php

			//echo "<td bgcolor='#EAEAEA' align='center'>";

			$consulta="SELECT m.descripcion,mc.idcurso,mc.idmateria,mc.iddocente,mc.idprofesor FROM matcur mc, materias m WHERE mc.idmateria=m.idmateria AND mc.idcurso='$cursox' AND mc.idmateria!=65";
			//echo $consulta;
			$result79 = mysql_query ($consulta);
				$i=1;
				while ($fila79 = mysql_fetch_array($result79))
				{    $pp=0;
					$sqlcuenta="SELECT * FROM matcur WHERE idcurso='$cursox' AND idmateria='$fila79[idmateria]'";
					$consultaQ=mysql_query($sqlcuenta);
					if (mysql_num_rows($consultaQ)>1) $pp=1;


					echo "<tr>";
					$descri=strtoupper($fila79['descripcion']);
					$materia=$fila79['idmateria'];
					$docente=$fila79['iddocente'];
					$profesor=$fila79['idprofesor'];

					//$todo[$materia][$docente][$profesor]=$todo[$materia][$docente][$profesor];

					echo "<td bgcolor='#EAEAEA' align='center'><b>".$descri."</b></td>";
					echo "<td bgcolor='#EAEAEA' align='center'>";
					//que materia
					echo "<input name='matmat[]' type='hidden' value='$materia' />";
					echo "<input name='profesor[]' type='hidden' value='$profesor' />";
					echo "<input name='todos[$i]' type='hidden' value='$todo[$materia][$docente][$profesor]' />";

					echo "<select name='asigna[".$materia."][".$profesor."]' onchange='this.style.backgroundColor=\"tomato\"'>";
							$listdocentex=mysql_query("SELECT DISTINCT (dni), CONCAT(apellido,  ' ', nombre) as nombredoc FROM docente WHERE identificacion='1' ORDER BY nombredoc ASC");

							while ($listdocentes = mysql_fetch_array($listdocentex))
							{	$docdoc=$listdocentes['dni'];
								$consulta=mysql_query("SELECT * FROM matcur where idcurso='$cursox' AND idmateria='$materia' AND iddocente='$docdoc' AND idprofesor='$profesor'");
								$elegido = mysql_num_rows($consulta);

								if ($elegido!='0')
								{
								echo "<option selected value=".$listdocentes['dni'].">".$listdocentes['nombredoc']."</option>";
								}
								else
								{
								echo "<option value=".$listdocentes['dni'].">".$listdocentes['nombredoc']."</option>";
								}
							}
					echo "</select>";
					echo "</td>";
					echo "<td align='center'>";
					if ($profesor==1)echo "<a href=asigdoc.php?a=a&ppm=".$materia."&ppc=".$cursox."&curso=".$cursox."&idp=".$profesor.">+</a>";
					echo "</td>";



					echo "<td align='center'>";
					if ($pp==1 && $profesor>1 )	echo "<a href=asigdoc.php?a=b&ppm=".$materia."&ppc=".$cursox."&idp=".$profesor."&curso=".$cursox.">-</a>";
					echo "</td>";


			//echo "</td>";
			echo "</tr>\n";
		}
		 }
		 //echo "</tr>";


	?>


<input name="curso" type="hidden" value ="<?php echo $_GET['curso'] ?>"/>



						<tr>
							<td width="895" height="100" bgcolor="#EAEAEA" align="center" colspan="7">
							<br>
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:1000; float:center width:500px; height:125px; " /></td>

						</tr>

							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<br><br>
							<a href="ORIGINALV.php?curso=<?php echo $_GET['curso'] ?>&submitcurso=Grabar">Ver Horario del Curso</a>
							<p align="center">&nbsp;</td>

						</tr>



						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
							<br><br>
							<a href="selcursodoc.php">Volver</a>
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
</body>
<?
include 'footer.php';

?>


</html>

