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

//SI NO TIENE LA FECHA PONE LA DE HOY
if (isset ($fecha))
{$fecha=$_GET['fecha'];}
else
{$fecha=date('Y-m-d');}
?>



</p>

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
?>	


			</table>
			</div>
		</td>
		</tr>
	</table>
</div>
<br><br>
<table style="width: 50%;" border="5" cellpadding="3">
<form method="GET" action="partepreceptoresverprec.php" target="_self">
<tr>
							
		<tr>
		<td  bgcolor="#EAEAEA" align="left"><font color="<?echo $color;?>">Curso:</td>
		<td  bgcolor="" align="center">
		<?php 		
		
		
			
			$result79 = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1' order by descripcion");
							
			
			echo "<select name=curso>";
				while ($fila79 = mysql_fetch_array($result79))
				{ 	
					if ($fila79['idcurso']==$_GET['curso'])
					{ echo "<option selected value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>";}
					else
					{ echo "<option value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>";}	
				}	
			echo "</select>";
			echo "</td>";
		
		
		
		
	?>

							<td width="150" bgcolor="#EAEAEA" align="center"><font color="<?echo $color;?>">Fecha Parte:</td>
							</font>
    
							<td bgcolor="" width="225" align="left">
 							<input type="text" name="fecha" id="fecha" value="<?echo $_GET["fecha"];?>" maxlength="10"/>
    						
							<img src="calendario.png" width="16" height="16" border="0" title="Fecha Desde" id="fechas1">
							</td>
							
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"fecha",       // id del campo de texto 
	    					ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
						button:"fechas1"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>
		<td width="150" bgcolor="#EAEAEA" align="center"><font color="<?echo $color;?>">Acciones</td>

	</tr>

    <tr>
	<?
	
	echo "<td align=center colspan=4><input type='submit' value='Mostrar Parte' name='submitcurso' /></td>";
	echo "<td align=center colspan=4><a href='partepreceptoresmodif.php?curso=$curso&fecha=$_GET[fecha]&submitcurso=Ver+Parte' type='button'>Modificar Parte</button></a></td>";
	echo "</tr></table>";
	echo "<br><br>";
	

?>

</form>
<?php 	
	
//	$elegido='0';	
		
			
//			echo $elegido;

if (isset($_GET["submitcurso"])) {
echo "<br><br>";
$curso=$_GET['curso'];
$fecha=$_GET['fecha'];


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
				  echo "<td><a href='ORIGINALVP.php?curso=$fila79[curso]' target='_blank'>$fila79[materia]</a></td>";
				  echo "<td><a href='ORIGINALVDP.php?actor=$fila79[dni]' target='_blank'>$fila79[nombredoc]</a></td>";
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
echo "<br><br>";

echo "<br><br>";
echo "<br><br>";
include 'footer.php';
?>
			
			
		
	


	
</div>
</body>
<?


  
  
  
}

  ?>

</html>
<?
}

  
  
  

  ?>

