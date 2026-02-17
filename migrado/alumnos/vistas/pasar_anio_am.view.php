<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Pasar de a&ntilde;o <?=$cadenaSeccion ?></title>


</head>
<body>
<?
	$errordoc = 0;
	$hayerrores = 0;

  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos


}
 else
  {
    $flag = 1;
  }

if ($hayerrores OR $flag) {

printf("<div style='max-width: 980px'>");
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
printf("</div>");
?>
<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">

<div align="center">
	<table border="0" width="500" bgcolor="#FFFFFF">
		<tr>
			<td>

			<div align="center">
			<table style="max-width:80%">

				<tr>
					<td>
						<h2>Listado a pasar de curso de <span style="text-decoration: underline overline; color: #bb2222; background-color: #bbbbbb;"><?=$cadenaSeccion ?></span></h2>
					</td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr><td>


<?


$ye22 = mysql_query ("SELECT modalidad FROM cursa ");
$data=mysql_fetch_array($ye22);



	$_pagi_sql="SELECT * FROM cursa,alumno,plan where cursa.curso='$curso' and cursa.divi='$division' and anio='$anio2' and plan.id=cursa.modalidad AND cursa.alumno=alumno.dni and cursa.control=1 order by alumno.apellido";
	//echo $_pagi_sql;
$numero=0;

$_pagi_cuantos=2000;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php");
?>
<p align="left"><?

?>

</p>


 <table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">


						<tr>
							<td class="text1b"  colspan="5" height="40" align="left">
							&nbsp;<b>Recuerde que al pasar los cursos de año debe hacerlo de mayor a menor de 6º a 1º</b>
<br><br>

                         Curso nuevo:<select size="1" autofocus="true" name="secc"> <!-- ****************************LISTA cursos -->
						  <?
							if (($curso == 6 AND is_numeric($division)) OR $curso == 7) echo "<option value='E'>Egresa</option>";
							else while ($myrow6 = mysql_fetch_array($q_seccion)) echo "<option value=" . $myrow6['id'] . ">" . $myrow6['descripcion'] . "</option>";
						    if ($curso == 3) echo "<option value='L'>Patio</option>";
						  ?>

                          </select>
<br><br>

</td>
						</tr>
						<tr>
							<td width="10" bgcolor="#808080" align="center" height="36">Nº</td>
							<td width="80" bgcolor="#808080" align="center" height="36">DNI</td>
							<td bgcolor="#808080" width="200" align="center" height="36">ALUMNO</td>
							<td bgcolor="#808080" width="20" align="center"  height="36">MODALIDAD</td>
							<td bgcolor="#808080" width="20" align="center"  height="36">MARCAR</td>


						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{
			$numero=$numero+1;

		?>

						<tr>
							<td bgcolor="#EAEAEA" align="center"><?echo $numero;?></td>

							<td bgcolor="#EAEAEA" align="center"><?echo $fila2['dni'];?></td>
							<td bgcolor="#EAEAEA" align="left"><?echo $fila2['apellido'];?>, <?echo $fila2[nombre];?></td>
							<td bgcolor="#EAEAEA" align="left"><?echo $fila2['descripcion'];?></td>
							<td bgcolor="#EAEAEA" align="center"><input name="afectado[]" type="checkbox" value="<?php echo $fila2['dni']?>"></td>
						</tr>
						<?
						}
						?>
					<tr>
						<td align="center" width="752" colspan="9">
						<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</td>
					</tr>
						</table>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
				<table border="0" width="100%" id="table10" cellspacing="0" cellpadding="0">
					<tr>
						<td>
						<p align="center">&nbsp;<input type="submit" value="Modificar" name="submitx"></td>
						</table>
				<p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
			</div>
					<hr>
					</td>
				</tr>

<!-- +++++++++++++++ FRANJA GRIS EN PIE DE PÁGINA ++++++++++++++ -->
				<?
include 'footer.php';
?>
			</table>
			</div>
		</tr>
<input name="curso" type="hidden" value ="<?=$curso?>"/>
<input name="division" type="hidden" value ="<?=$division?>"/>
	</table>
	</form>
</div>
</body>
<?
}
else
{
$seccion=$_POST["secc"];

if ($seccion != 'L') {

 $q_curDiv= mysql_query("SELECT * FROM `curso2` WHERE `idcurso` LIKE '$seccion'");
 $_curDiv = mysql_fetch_assoc($q_curDiv);
 $cur = $_curDiv['curso'];
 $divi = $_curDiv['division'];
 $modalidad = $_curDiv['plan'];
}
else {
 $cur = 'L';
 $divi = 'L';
 $modalidad = '0';
}

$urlCurDiv = $_SERVER['PHP_SELF'] . "?curso=" . $curso . "&division=" . $division;
//Reiniciar contadores
$actualizados = 0;
$fallas = 0;

foreach ($_POST["afectado"] as $afectado)
	{

$insertado=0;
//CHEQUEAMOS ESTO PORQUE HABIA VARIOS QUE TENIAN DOS CURSOS CON CONTROL EN 1
$prueba = mysql_query ("SELECT * FROM cursa WHERE alumno='$afectado' AND curso='$cur' AND divi='$divi' AND anio=YEAR(CURRENT_DATE) AND control='1'");
//$yaestasi = mysql_fetch_array($prueba);
$esta = mysql_num_rows($prueba);

//CURSO ANTERIOR
$ye = mysql_query ("SELECT * FROM cursa where alumno=$afectado and control=1");
$yaesta = mysql_fetch_array($ye);



if ($esta==0)
	{
	if (mysql_query ("INSERT INTO cursa VALUES ($afectado,'$cur','$divi',YEAR(CURRENT_DATE),'0',1,CURRENT_DATE(),$modalidad)"))

		{$insertado=1;}
	}






		//echo "INSERT INTO cursa VALUES ($afectado,'$cur','$di','$ani','0',1,CURRENT_DATE(),$modalidad)";
		//echo "UPDATE cursa SET control=0 where curso='$yaesta[curso]' and divi='$yaesta[divi]' and alumno=$afectado and anio='$yaesta[anio]' and control=1";
	//}



		if ($insertado==1 OR $esta>0)
		{
			if(mysql_query ("UPDATE cursa SET control=0 where curso='$yaesta[curso]' and divi='$yaesta[divi]' and alumno=$afectado and anio='$yaesta[anio]' and control=1"))
				{
					$actualizados++;
				}
			else
				{
					$fallas++;
				}

		}



	} //fin foreach

?>
				<script>
				var answer=alert("<?=$actualizados?> modificado Correctamente. <?=$fallas?> errores")
				</script>
				<meta http-equiv='refresh' content='0; URL="<?=$urlCurDiv?>"'>
<?


}

?>

</html>
<? } ?>

