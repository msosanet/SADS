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
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<title>NOVEDADES PARA DOCENTES</title>

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

<!-- *********** LISTADO DE AVISOS ***************** -->


<!-- ************* TABLA CON DATOS **************** -->


<?
$result177 = mysql_query ("SELECT * FROM nov_docentes ORDER BY codigo DESC");
?>

<table border="1" width="900" id="lista_avisos" cellspacing="0" bordercolor="#aaaaaa">
						<tr height="40">
							  <td class="text1b" colspan="4"><center>AVISOS</center></td>
						</tr>
						<tr bgcolor="#CCCCCC" height="40">
         <td width="30" align="center">CODIGO</td>
         <td width="300" align="center">TEMA</td>
				     <td width="550" align="center">EXTRACTO DEL TEXTO</td>
				     <td width="50" align="center">MODIF.</td>
					 </tr>

<?php
while ($fila177 = mysql_fetch_array($result177))
		{

?>
					 <tr height="30">
						   <td align="center">
							     <? echo $fila177[codigo]; ?>
						   </td>
         <td align="left">
							     <b><? echo $fila177[tema]; ?></b>
						   </td>
						   <td align="left">
            <b><? echo $fila177[tema];?></b><br>
            <? echo substr($fila177[aviso],0,80). "...";?><br>
            <a href="#" class="editar">Editar</a>
						   </td>
						   <td align="center">
							     <? //php echo $fila177[observaciones];?>
            <p>&nbsp;</p>
						   </td>
					 </tr>
<?
  }
?>

</table>

<!-- +++++++++++++++ FIN TABLA CON DATOS ++++++++++++++++++++ -->

<p>&nbsp;</p>
<!-- ********* FIN LISTADO DE AVISOS ********* -->




</div> <!-- ****************** FIN DIV PRINCIPAL ************ -->
</body>
<?
}
else
    {echo 'ALGO ANDA MAL';
}


?>

</html>
