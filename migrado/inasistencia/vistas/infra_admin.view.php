<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>ARTICULOS DATOS</title>

</head>

<!-- ************ ADMINISTRACION DE TICKETS DE INFRAESTRUCTURA ***************** -->

<?
include 'header.php';
$conexion = conectar();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
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

<!--h3><a href="infra_tkt_nuevo.php">NUEVO TICKET DE INFRAESTRUCTURA</a><h3>
<br -->
<!-- ************* TABLA DATOS **************** -->


<?
$infratktstodos = mysql_query ("SELECT * FROM infra WHERE ocultar <> '1' ORDER BY fecha_aviso DESC");
?>
<div style="width: 95%;margin:0 5px 10px 0;float:center;">
<p class="titulo" align="center">TICKETS DE INFRAESTRUCTURA REGISTRADOS</p>
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

<?php
while ($infraticket = mysql_fetch_array($infratktstodos))
		{
?>
					 <tr height="30">
						   <td align="center">
							     <? echo $infraticket[id]; ?>
						   </td>
						   <td align="center">
							     <? echo substr($infraticket[fecha_aviso],-2) . "-" . substr($infraticket[fecha_aviso],-5, 2) . "-" . substr($infraticket[fecha_aviso], 0, 4); ?>
						   </td>
                     <td align="left">
							     <b><? echo $infraticket[lugar]; ?></b>
						   </td>
                     <td align="left">
							     <b><? echo $infraticket[desperfecto]; ?></b>
						   </td>
                     <td align="center">
							     <? echo $infraticket[quien_registro]; ?>
						   </td>
                     <td align="center">
							     <b><? if ($infraticket[tarea_cumplida] == 'on') { echo "<font color='green'>Realizada</font>"; } else { echo "<font color='red'>Pend.</font>"; } ?></b>
						   </td>
                     <td align="center">
							     <? echo substr($infraticket[fecha_cumplimiento],-2) . "-" . substr($infraticket[fecha_cumplimiento],-5, 2) . "-" . substr($infraticket[fecha_cumplimiento], 0, 4); ?>
						   </td>
						   <td align="center">
							     <? echo "<a href=\"infra_tkt_ver.php?id=$infraticket[id]\"><img src='images/eye.png'></a>"; ?>
							     <? echo "<a href=\"infra_tkt_modificar.php?id=$infraticket[id]\"><img src='images/b_edit.png'></a>"; ?>
                          <? echo "<a href=\"infra_tkt_ocultar.php?id=$infraticket[id]\"><img src='images/b_drop.png'>"; ?>
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

