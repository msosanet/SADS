<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion3.php';

//esto pasa las mayusculas acentuadas a minusculas acentuadas
function strtolowerExtended($str)
{
        $low = array(chr(193) => chr(225), //á
                    chr(201) => chr(233), //é
                    chr(205) => chr(237), //í­
                   chr(211) => chr(243), //ó
                   chr(218) => chr(250), //ú
                  chr(220) => chr(252), //ü
                    chr(209) => chr(241)  //ñ
                    );

      return strtolower(strtr($str,$low));
}


?>
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

?>
<body>

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
<div style="max-width: 980px;align:center">
<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
//$materia=$_GET['materia'];

if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';

?>
</div>

<form method="GET" action="ORIGINALVP.php" target="_blank">
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>

			<div align="center">
			<table border="0" width="980">

</table>
<table>
<?php

			echo "<br><br>";


			$result79 = mysql_query ("SELECT * FROM curso2 where habilitado = 1 order by descripcion");


			echo "<select name=curso>";
				while ($fila79 = mysql_fetch_array($result79))
				{
					echo "<option value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>";

				}

			echo "</select>";

		echo "<input type='submit' value='Ver Curso' name='submitcurso' />";

	?>
    <?

?>

			</div>
		</tr>
	</table>


	</form>
</div>
</body>
<?

			echo "<br><br>";
			echo "<br><br>";

 include 'footer.php';



  ?>


</html>
<?
}





  ?>
