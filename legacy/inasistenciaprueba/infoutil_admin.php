<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>ARTICULOS DATOS</title>

</head>

<!-- ************ MODIFICACION DE AVISO ***************** -->

<?
include 'header.php';
$conexion = conectar();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
?>

<body>
<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->


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
<p>&nbsp;</p>
<!-- **************** FIN BARRA DE MENÚS *************** -->

<h3><a href="infoutil_articulo_nuevo.php">NUEVO ARTICULO DE INFORMACI&Oacute;N UTIL</a><h3>
<br>
<!-- ************* TABLA DATOS **************** -->


<?
$result177 = mysql_query ("SELECT * FROM infoutil WHERE `grupo` = 'datos' AND `ocultar` = '0' ORDER BY orden ASC");
?>
<div style="width: 25%;margin:0 5px 10px 0;float:left;">
<table border="1" width="100%" id="lista_avisos" cellspacing="0" bordercolor="#aaaaaa">
						<tr height="40">
							  <td colspan="5"><center>ITEMS DATOS</center></td>
						</tr>
						<tr bgcolor="#CCCCCC" height="40">
         <td width="30" align="center">ID</td>
         <td width="30" align="center">ORD</td>
         <td width="300" align="center">TITULO</td>
				     <td width="100" align="center">ACC</td>
					 </tr>

<?php
while ($fila177 = mysql_fetch_array($result177))
		{
?>
					 <tr height="30">
						   <td align="center">
							     <? echo $fila177[id]; ?>
						   </td>
						   <td align="center">
							     <? echo $fila177[orden]; ?>
						   </td>
                     <td align="left">
							     <? echo $fila177[titulo]; ?>
						   </td>
						   <td align="center">
							     <? echo "<a href=\"infoutil_articulo_modificar.php?id=$fila177[id]\"><img src='images/b_edit.png'></a>"; ?>
                          <? echo "<a href=\"infoutil_articulo_ocultar.php?id=$fila177[id]\"><img src='images/b_drop.png'>"; ?>
						   </td>
					 </tr>
<?
  }
?>

</table>
</div>
<!-- +++++++++++++++ FIN TABLA DATOS ++++++++++++++++++++ -->

<!-- ************* TABLA MESA ENTRADAS **************** -->


<?
$result177 = mysql_query ("SELECT * FROM infoutil WHERE `grupo` = 'mesaent' AND `ocultar` = '0' ORDER BY orden ASC");
?>
<div style="width: 24%;margin:0 5px 10px 0;float:left;">
<table border="1" width="100%" id="lista_avisos" cellspacing="0" bordercolor="#aaaaaa">
						<tr height="40">
							  <td colspan="5"><center>ITEMS MESA ENTRADAS</center></td>
						</tr>
						<tr bgcolor="#CCCCCC" height="40">
         <td width="30" align="center">ID</td>
         <td width="30" align="center">ORD</td>
         <td width="300" align="center">TITULO</td>
				     <td width="100" align="center">ACC</td>
					 </tr>

<?php
while ($fila177 = mysql_fetch_array($result177))
		{
?>
					 <tr height="30">
						   <td align="center">
							     <? echo $fila177[id]; ?>
						   </td>
						   <td align="center">
							     <? echo $fila177[orden]; ?>
						   </td>
                     <td align="left">
							     <? echo $fila177[titulo]; ?>
						   </td>
						   <td align="center">
							     <? echo "<a href=\"infoutil_articulo_modificar.php?id=$fila177[id]\"><img src='images/b_edit.png'></a>"; ?>
                          <? echo "<a href=\"infoutil_articulo_ocultar.php?id=$fila177[id]\"><img src='images/b_drop.png'>"; ?>
						   </td>
					 </tr>
<?
  }
?>

</table>
</div>
<!-- +++++++++++++++ FIN TABLA MESA ENTRADAS ++++++++++++++++++++ -->


<!-- ************* TABLA ALUMNOS **************** -->


<?
$result177 = mysql_query ("SELECT * FROM infoutil WHERE `grupo` = 'alumnos' AND `ocultar` = '0' ORDER BY orden ASC");
?>
<div style="width: 24%;margin:0 5px 10px 0;float:left;">
<table border="1" width="100%" id="lista_avisos" cellspacing="0" bordercolor="#aaaaaa">
						<tr height="40">
							  <td colspan="5"><center>ITEMS ALUMNOS</center></td>
						</tr>
						<tr bgcolor="#CCCCCC" height="40">
         <td width="30" align="center">ID</td>
         <td width="30" align="center">ORD</td>
         <td width="300" align="center">TITULO</td>
				     <td width="100" align="center">ACC</td>
					 </tr>

<?php
while ($fila177 = mysql_fetch_array($result177))
		{
?>
					 <tr height="30">
						   <td align="center">
							     <? echo $fila177[id]; ?>
						   </td>
						   <td align="center">
							     <? echo $fila177[orden]; ?>
						   </td>
                     <td align="left">
							     <? echo $fila177[titulo]; ?>
						   </td>
						   <td align="center">
							     <? echo "<a href=\"infoutil_articulo_modificar.php?id=$fila177[id]\"><img src='images/b_edit.png'></a>"; ?>
                          <? echo "<a href=\"infoutil_articulo_ocultar.php?id=$fila177[id]\"><img src='images/b_drop.png'>"; ?>
						   </td>
					 </tr>
<?
  }
?>

</table>
</div>
<!-- +++++++++++++++ FIN TABLA ALUMNOS ++++++++++++++++++++ -->

<!-- ************* TABLA DOCENTES **************** -->


<?
$result177 = mysql_query ("SELECT * FROM infoutil WHERE `grupo` = 'docentes' AND `ocultar` = '0' ORDER BY orden ASC");
?>
<div style="width: 24%;margin:0 5px 10px 0;float:left;">
<table border="1" width="100%" id="lista_avisos" cellspacing="0" bordercolor="#aaaaaa">
						<tr height="40">
							  <td colspan="5"><center>ITEMS DOCENTES</center></td>
						</tr>
						<tr bgcolor="#CCCCCC" height="40">
         <td width="30" align="center">ID</td>
         <td width="30" align="center">ORD</td>
         <td width="300" align="center">TITULO</td>
				     <td width="100" align="center">ACC</td>
					 </tr>

<?php
while ($fila177 = mysql_fetch_array($result177))
		{
?>
					 <tr height="30">
						   <td align="center">
							     <? echo $fila177[id]; ?>
						   </td>
						   <td align="center">
							     <? echo $fila177[orden]; ?>
						   </td>
                     <td align="left">
							     <? echo $fila177[titulo]; ?>
						   </td>
						   <td align="center">
							     <? echo "<a href=\"infoutil_articulo_modificar.php?id=$fila177[id]\"><img src='images/b_edit.png'></a>"; ?>
                          <? echo "<a href=\"infoutil_articulo_ocultar.php?id=$fila177[id]\"><img src='images/b_drop.png'>"; ?>
						   </td>
					 </tr>
<?
  }
?>

</table>
</div>
<!-- +++++++++++++++ FIN TABLA DOCENTES ++++++++++++++++++++ -->



</div> <!-- ****************** FIN DIV PRINCIPAL ************ -->
</body>
<?

}


?>

</html>
