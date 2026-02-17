<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>NOVEDADES PARA DOCENTES</title>

</head>

<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
?>

<body>

<?
	$errordoc = 0;
	$hayerrores = 0;
 $flag = 0;
 $date = date('Y-m-d');

  if (isset($_GET["submitx"])) {
}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {

?>


<form method="get" action="nov_docentes_ver2.php">

<div id="marco980" align="center">

<!-- **************** BARRA DE MENÚS *************** -->
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
if ($_SESSION['valor']==5)
{
include 'menuppal5.php';
}
?>
<!-- **************** FIN BARRA DE MENÚS *************** -->


<?
$_pagi_sql="SELECT * FROM nov_docentes where borrado=1 AND categoria = 'doc' ORDER BY codigo DESC";
$_pagi_cuantos=20000;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
?>

<br>

<!-- ************* NOVEDADES DOCENTES ********************** -->
<div id="nov_container" align="left">

<?
include("paginator.inc.php");
?>

<div align="center">
<p class="titulo">NOVEDADES PARA DOCENTES</p>
</div>

<div id="nov_box">

<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{
?>
<div id="novedad">
  <p class="fecha"><? echo "Publ. " . $fila2[fecha] . " - Vto." . $fila2[vencimiento]; ?></p>
  <p class="titulo"><? echo $fila2[tema]; ?></p>
  <p class="novtext"><? echo $fila2[aviso]; ?></p>
  <? echo "<p class='editar' align='right'><a href=\"nov_aviso_modificar.php?codigo=$fila2[codigo]\">>>Editar</a></p>"; ?>
</div>
<? }	?>

</div>
</div>
<!-- ************* FIN NOVEDADES DOCENTES ********************** -->

<!-- ************* NOVEDADES ALUMNOS ********************** -->
<?
$_pagi_sql="SELECT * FROM nov_docentes where borrado=1 AND categoria = 'alu' ORDER BY codigo DESC";
?>

<div id="nov_container_alu" align="left">

<?
include("paginator.inc.php");
?>

<div align="center">
<p class="titulo">NOVEDADES PARA ALUMNOS<? //echo "$_pagi_navegacion"; ?></p>
</div>

<div id="nov_box">

<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{
?>
<div id="novedad">
  <p class="fecha"><? echo "Publ. " . $fila2[fecha] . " - Vto." . $fila2[vencimiento]; ?></p>
  <p class="titulo"><? echo $fila2[tema]; ?></p>
  <p class="novtext"><? echo $fila2[aviso]; ?></p>
  <? echo "<p class='editar' align='right'><a href=\"nov_aviso_modificar.php?codigo=$fila2[codigo]\">>>Editar</a></p>"; ?>
</div>
<? }	?>
</div>

</div>
<!-- ************* FIN NOVEDADES ALUMNOS ********************** -->


<!-- ************* NOVEDADES ADMINISTRACION ********************** -->
<?
$_pagi_sql="SELECT * FROM nov_docentes where borrado=1 AND categoria = 'adm' ORDER BY codigo DESC";
?>
<div id="nov_container_adm" align="left">

<?
include("paginator.inc.php");
?>

<div align="center">
<p class="titulo">NOVEDADES ADMINISTRACION<? //echo "$_pagi_navegacion"; ?></p>
</div>

<div id="nov_box">

<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{
?>
<div id="novedad">
  <p class="fecha"><? echo "Publ. " . $fila2[fecha] . " - Vto." . $fila2[vencimiento]; ?></p>
  <p class="titulo"><? echo $fila2[tema]; ?></p>
  <p class="novtext"><? echo $fila2[aviso]; ?></p>
  <? echo "<p class='editar' align='right'><a href=\"nov_aviso_modificar.php?codigo=$fila2[codigo]\">>>Editar</a></p>"; ?>
</div>
<? }	?>
</div>

</div>
<!-- ************* FIN NOVEDADES ADMINISTRACION ********************** -->

<p>&nbsp;</p>

<input name="actor" type="hidden" value ="<?php echo $dni; ?>"/>

	</form>
</div>
<p>&nbsp;</p>
<? include 'footer.php'; ?>

<?
}
else
{

foreach ($_GET["afectado"] as $afectado)
	{
		if (mysql_query ("update novedades set borrado=0 where codigo=$afectado"))
		{
    		
		}
	}
				?>
				<script>
				var answer=alert("Modificado Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<?
}

?>

</body>
</html>
<? } ?>
