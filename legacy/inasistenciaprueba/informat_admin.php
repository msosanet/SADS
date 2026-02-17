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

<!-- ************ ADMINISTRACION DE TICKETS DE INFORM&Aacute;TICA ***************** -->

<?
include 'header.php';
$conexion = conectar();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$chkusr = mysql_query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
$userdat = mysql_fetch_array($chkusr);
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
<!-- ************* TABLA DATOS **************** -->


<?
$informattktstodos = mysql_query ("SELECT * FROM informat WHERE ocultar <> '1'");
?>

<div style="width: 95%;margin:0 5px 10px 0;float:center;">
<p class="titulo" align="center">TICKETS DE INFORM&Aacute;TICA REGISTRADOS</p>
<br>
<table border="1" id="lista_avisos" cellspacing="0" bordercolor="#aaaaaa">
       <tr bgcolor="#CCCCCC" height="40">

         <td width="25" align="center"><b>ID</b></td>
         <td width="70" align="center"><b>FECHA AVISO</b></td>
         <td width="180" align="center"><b>LUGAR</b></td>
		   <td width="300" align="center"><b>DESPERFECTO</b></td>
		   <td width="70" align="center"><b>REGISTR&Oacute;</b></td>
		   <td width="70" align="center"><b>ESTADO TAREA</b></td>
		   <td width="70" align="center"><b>FECHA CUMPLIM.</b></td>
		   <td width="75" align="center"><b>ACCION</b></td>

		 </tr>

<ul id=menu_slide>
    <li><a href="#sliding">Opción 1</a>
    <li><a href="#details">Opción 2</a>
    <li><a href="#a11n">Opción 3</a>
    <li><a href="#misc">Opción 4</a>
</ul>

<?php
while ($informatticket = mysql_fetch_array($informattktstodos))
		{
?>
					 <tr height="30">
						   <td align="center">
							     <? echo $informatticket[id]; ?>
						   </td>
						   <td align="center">
							     <? echo substr($informatticket[fecha],-2) . "-" . substr($informatticket[fecha],-5, 2) . "-" . substr($informatticket[fecha], 0, 4); ?>
						   </td>
                     <td align="left">
							     <b><? echo $informatticket[lugar]; ?></b>
						   </td>
                     <td align="left">
							     <b><? echo $informatticket[desperfecto]; ?></b>
						   </td>
                     <td align="center">
							     <? echo $informatticket[quien_registro]; ?>
						   </td>
                     <td align="center">
							     <b><? if ($informatticket[tarea_finalizada] == 'on') { echo "<font color='green'>Realizada</font>"; } else { echo "<font color='red'>Pend.</font>"; } ?></b>
						   </td>
                     <td align="center">
							     <? echo substr($informatticket[fecha_finalizada],-2) . "-" . substr($informatticket[fecha_finalizada],-5, 2) . "-" . substr($informatticket[fecha_finalizada], 0, 4); ?>
						   </td>
						   <td align="center">
							     <? echo "<a href=\"informat_tkt_ver.php?id=$informatticket[id]\"><img src='images/eye.png'></a>"; ?>
							     <? echo "<a href=\"informat_tkt_modificar.php?id=$informatticket[id]\"><img src='images/b_edit.png'></a>"; ?>
                          <? echo "<a href=\"informat_tkt_ocultar.php?id=$informatticket[id]\"><img src='images/b_drop.png'>"; ?>
						   </td>
					 </tr>
<?
  }
?>

</table>
</div>
<!-- +++++++++++++++ FIN TABLA DATOS ++++++++++++++++++++ -->

</div> <!-- ****************** FIN DIV PRINCIPAL ************ -->
</body>
<?

}


?>

</html>
