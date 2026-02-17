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

<body >


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

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
//$materia=$_GET['materia'];


?>
<table  width="980" bgcolor="#FFFFFF"><thead >
		<tr><th>
		<?include ('snipet_barramenu.php')?>
		</th></tr></thead>
		<tbody style="margin: 0px 0px 0px 0px;">
		<tr><td align="center">
		<form method="GET" action="ORIGINALV.php" target="_blank">
<?php 		
		
		
			
			$result79 = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC");
							
			
			echo "<select name=curso>";
				while ($fila79 = mysql_fetch_array($result79))
				{ 	
					echo "<option value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>\n";
					
				}	
				
			echo "</select>";
			
		echo "<input type='submit' value='Mostrar' name='submitcurso' />";
		
	?>
	</form>
	</td></tr>
		</tbody></table>
    <br><br>
<?
include 'footer.php';
?>

</body>
</html>
<?
}
?>

