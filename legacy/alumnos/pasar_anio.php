<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>SID</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$curso=$_GET["curso"];
$division=$_GET["division"];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;

if (isset($_GET['cl']) AND $_GET['cl']>2019){
	$anio = $_GET['cl'];
}
else $anio=date("Y");

$anio2=$anio;


$cursos = mysql_query ("SELECT distinct curso FROM cursa order by curso");

$divis = mysql_query ("SELECT distinct divi FROM cursa order by divi");

function menu2($ssql,$valor,$nombre){
  	echo "<select name='$nombre'>";
  	$resultado=mysql_query($ssql);
  	while ($fila=mysql_fetch_row($resultado)){
    	if ($fila[0]==$valor){
      	echo "<option value='$fila[0]' selected >$fila[1]";
    	}
    	else{
      	echo "<option value='$fila[0]'>$fila[1]";
    	}
  }
  	echo "</select>";
}

?>
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
?>

<?PHP //<form method="_GET" action="pasar_anio.php?curso=<?php echo $curso?><!--&division=--><?php //echo $division?><!--"> -->
<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">

<div align="center">
	<table border="0" width="500" bgcolor="#FFFFFF">
		<tr>
			<td>

			<div align="center">
			<table border="0" width="500">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Listado a pasar de curso de &nbsp;<?echo $curso;?>º&nbsp;<?echo $division;?>º</p>
						</p>
					<p align="center">&nbsp;

					</p>

					<div align="left">


					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>

					<p align="left">
</font>

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
echo"$_pagi_navegacion";
?>

</p>


 <table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">


						<tr>
							<td class="text1b"  colspan="5" height="40" align="left">
							&nbsp;<b>Recuerde que al pasar los cursos de año debe hacerlo de mayor a menor de 6º a 1º</b>
<br><br>

                         Curso nuevo:<select size="1" autofocus="true" name="cur"> <!-- ****************************LISTA cursos -->
						  <?
                            WHILE ($myrow6 = mysql_fetch_array($cursos)) {
						    	echo "<option value=" . $myrow6['curso'] . ">" . $myrow6['curso'] . "</option>";
						    }
						  ?>
                          </select>
<br><br>

                         Div nueva:<select size="1" autofocus="true" name="di"> <!-- ****************************LISTA cursos -->
						  <?
                            WHILE ($myrow6 = mysql_fetch_array($divis)) {
						    	echo "<option value=" . $myrow6['divi'] . ">" . $myrow6['divi'] . "</option>";
						    }
						  ?>
                          </select><br><br>

								Modalidad:<? 	$valor="SELECT * FROM plan order by id";
							menu2($valor,$data['modalidad'],'modalidad'); ?>

<br><br>
Año:<input type="text" name="ani" size="4" maxlength="4" />


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
							<td bgcolor="#EAEAEA" align="left"><?echo $fila2[descripcion];?></td>
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
<input name="actor" type="hidden" value ="<?php echo $dni ?>"/>
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
$now=date("Y-m-d");
$cur=$_POST["cur"];
$di=$_POST["di"];
$ani=$_POST["ani"];
$modalidad=$_POST['modalidad'];

$curso=$_POST["curso"];
$division=$_POST["division"];
$urlCurDiv = $_SERVER['PHP_SELF'] . "?curso=" . $curso . "&division=" . $division;
//Reiniciar contadores
$actualizados = 0;
$fallas = 0;

foreach ($_POST["afectado"] as $afectado)
	{

$insertado=0;
//CHEQUEAMOS ESTO PORQUE HABIA VARIOS QUE TENIAN DOS CURSOS CON CONTROL EN 1
$prueba = mysql_query ("SELECT * FROM cursa WHERE alumno='$afectado' AND curso='$cur' AND divi='$di' AND anio='$ani' AND control='1'");
//$yaestasi = mysql_fetch_array($prueba);
$esta = mysql_num_rows($prueba);

//CURSO ANTERIOR
$ye = mysql_query ("SELECT * FROM cursa where alumno=$afectado and control=1");
$yaesta = mysql_fetch_array($ye);



if ($esta==0)
	{
	if (mysql_query ("INSERT INTO cursa VALUES ($afectado,'$cur','$di','$ani','0',1,'$now',$modalidad)"))

		{$insertado=1;}
	}






		//echo "INSERT INTO cursa VALUES ($afectado,'$cur','$di','$ani','0',1,'$now',$modalidad)";
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
