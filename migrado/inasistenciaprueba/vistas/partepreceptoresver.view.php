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
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

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
<body background="bgris.gif" >

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

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$curso=$_GET['curso'];
$fecha=$_GET['fecha'];


?>

<form method="GET" action="partepreceptoresver.php" target="_blank">

</p>

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
?>	
<br><br><br><br><br><br><br>
<?php 		
//	$elegido='0';	
		
			
//			echo $elegido;
$consulta="SELECT PP.hora,M.descripcion as materia,CONCAT(D.apellido, ' ', D.nombre) as nombredoc,PP.estado,C.descripcion,PP.observaciones,D.dni,PP.curso FROM partepreceptores PP, docente D, materias M, curso2 C WHERE PP.fecha='$fecha' AND PP.curso='$curso' AND PP.curso=C.idcurso AND M.idmateria=PP.materia AND PP.docente=D.dni ORDER BY PP.hora ASC";
$result79 = mysql_query ($consulta);
$elegido = mysql_num_rows($result79);
//echo $elegido;

$consultacurso=("SELECT C.descripcion FROM curso2 C WHERE idcurso='$curso'");
$result80 = mysql_query ($consultacurso);
while ($fila80 = mysql_fetch_array($result80))
{
$cursodesc=$fila80['descripcion'];
}
if ($elegido!=0)
{
?>
<table style="width: 75%;" border="5" cellpadding="3">
<tr>
<td  bgcolor="#EAEAEA" align="center"><font color="<?echo $color;?>">Parte Diario del Curso: <?echo $cursodesc;?> para la fecha <?echo $fecha;?></td>
</table>
	

<table style="width: 75%;" border="5" cellpadding="3">

<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Hora</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Materia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Docente</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Asistencia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Observaciones</b></td>
		
</tr>			

<?php
				
			
			
			
				while ($fila79 = mysql_fetch_array($result79))
				{ echo "<tr>";
				  echo "<td align='center' >$fila79[hora]</td>";
				  echo "<td><a href='ORIGINALV.php?curso=$curso'>$fila79[materia]</a></td>";
				  echo "<td><a href='leg_unif.php?actor=$fila79[dni]'>$fila79[nombredoc]</a></td>";
				  echo "<td align='center'>$fila79[estado]</td>";
				   echo "<td>$fila79[observaciones]</td>";
				  echo "</tr>";		
				}	
				
			
			
		
		
		
		
	?>
	
	

	

	</table>
	<?
	
}
else
{echo "No se ha cargado ningun parte para el curso seleccionado para la fecha: $fecha";}
echo "<table style='width: 15%;' border='1' cellpadding='3'>";
echo "<br><br>";
echo "<tr><td align='center' bgcolor='F00000'><a href='partepreceptoresmodif.php?curso=$curso&fecha=$fecha&submitcurso=Ver+Parte'><font size=4>Modificar</font></a></td></tr>";
echo "<tr><td align='center' bgcolor='0EBD05'><a href='selcurparver.php'><font size=4>Volver</font></a></td></tr>";

echo "</table>";
echo "<br><br>";
echo "<br><br>";
include 'footer.php';
?>
			
			
		
	


	</form>
</div>
</body>
<?


  
  
  

  ?>


</html>
<?
}

  
  
  

  ?>

