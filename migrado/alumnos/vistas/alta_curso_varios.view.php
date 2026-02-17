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
<title>Administrador de Alumnos</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
$resultmotivo = mysql_query ("SELECT * FROM motivo_dec");
$anio = $_SESSION['cicloLectivo'];
$cur = $div = '';
if (isset($_GET['curso'])) $cur = $_GET['curso'];
if (isset($_GET['div'])) $div = $_GET['div'];






?>

<body>


<form method="GET" action="alta_curso_varios.php">

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
if ($_SESSION['valor']==4)
{
include 'menuppal4.php';
}
?>

				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Listar curso y división.</p>
						</p>
					<p align="center">&nbsp;

					</p>

					<div align="left">

					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el Curso:</td>
							<td align="right"><input type="text" name="curso" id="curso" size="2" maxlength="2" value="<?=$cur?>" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" width="36%">Ingrese la División:</td>
							<td align="right"><input type="text" name="div" id="div" size="2" maxlength="2" value="<?=$div?>" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" width="36%">Ingrese Ciclo Lectivo:</td>
							<td align="right"><input type="number" name="cl" id="cl" size="6" maxlength="4" min = "2019" max = "2099" value="<?=$anio?>" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>

						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
					</table>
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
</font>
					<?
				if (isset($_GET['muestra2']))
{

	$curso=$_GET['curso'];
	$div=$_GET['div'];
	$anio=$_GET['cl'];







$_pagi_sql="SELECT * FROM cursos WHERE curso LIKE '%$curso%' AND division LIKE '%$div%' ORDER BY curso DESC";




$_pagi_cuantos=50;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=20;
include("paginator.inc.php");
?>
<p align="left"><?
echo"$_pagi_navegacion";
?>
<br><br>
</p><?

		?> <table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"  colspan="3" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda de <?=$curso?>° <?php echo $div?>ª --- <b>Recuerde que pasar los cursos de año debe hacerlo de mayor a menor de 6º a 1º</b>


</td>
						</tr>




						<tr>

							<td width="100" bgcolor="#808080" align="center" height="36">Curso</td>
							<td width="200" bgcolor="#808080" align="center" height="36">Division</td>
							<td width="200" bgcolor="#808080" align="center" height="36">Ver el curso</td>

						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{



		?>

						<tr>

							<td width="20" bgcolor="#EAEAEA" align="center"><?=$fila2['curso']?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?=$fila2['division']?></td>
		<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="pasar_anio.php?curso=<?=$fila2['curso']?>&division=<?=$fila2['division']?>&cl=<?=$anio?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Pasar de año"></a></td>






						</tr>

						<?
						}
						?>
						</table>
<?
}

?>

				</tr>

<br>

			</table>
			</div>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>



</form>
 </td>

</div>

</body>

</html>
<? } ?>

