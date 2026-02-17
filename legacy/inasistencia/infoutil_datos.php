<?php
session_start();
if ($_SESSION['estado']==1) {
include 'conexion.php';
$conexion = conectar();
$mysqli = mysqli_connect("localhost", "fgoicoechea", "sobral2011", "sid");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />
<title>INFO UTIL - DATOS</title>

</head>

<body>

<div id="marco980">

<!-- **************** BARRA DE MENÚS *************** -->
<?
include 'header.php';

if ($_SESSION['valor']==1)
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
<p>&nbsp;</p>

<div id="tramites_menu">

<p class= "titulo">DATOS ÚTILES</p>
<?
$result177 = mysql_query ("SELECT * FROM infoutil WHERE `grupo` = 'datos' AND ocultar = 0 ORDER BY orden");
?>
<ul>
<?
    while ($fila177 = mysql_fetch_array($result177))
		{
       echo "<li><a href='infoutil_datos.php?id=" . $fila177[id] . "'>" . $fila177[titulo] . "</a></li>";
}
?>
</ul>
</div>

  <div id="tramites_main">

  <?   $id = $_GET['id'];
       $result = mysqli_query($mysqli,"SELECT * FROM infoutil WHERE `grupo` = 'datos' AND id = $id");
       $res = mysqli_fetch_array($result);
       $fechaconformato = new DateTime($res['fecha']); //Necesario para reformatear la fecha

       echo "<p class='fecha'>Publicado " . $fechaconformato->format('d-m-Y') . "</p> <p>" . $res[detalle] . "</p>";
  ?>

  </div>
  <p>&nbsp;</p>


</div>
</body>
</html>
<?
}
?>