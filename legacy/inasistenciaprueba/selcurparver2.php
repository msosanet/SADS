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
//$materia=$_GET['materia'];


?>


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
			<?
			//include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>
<form method="GET" action="partepreceptoresver2.php" target="_blank">

<br><br><br><br>
<h2>Parte por curso por fecha</h2>
<br><br>
	<div align="center">
<table style="width: 50%;" border="2" cellpadding="1">

<tr>
<td  bgcolor="#EAEAEA" align="left"><font color="<?echo $color;?>">Curso:</td>
<td  bgcolor="#EAEAEA" align="left">
<?php 		
		
		
			
			$result79 = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC");
							
			
			echo "<select name=curso>";
				//echo "<option value='Todos'>".'Todos'."</option>";
				while ($fila79 = mysql_fetch_array($result79))
				{ 	
					echo "<option value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>";
					
				}	
				
			echo "</select>";
			
		
		
		
		
	?>
	
</td>	
</tr>	
<tr>
							
							

							<td width="150" bgcolor="#EAEAEA" align="left"><font color="<?echo $color;?>">Fecha Parte:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
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


	</tr>
	<tr>
	</tr>
    
	<?
	
	
	echo "</table>";
	echo "<br><br>";
	echo "<input type='submit' value='Mostrar Parte' name='submitcurso' />";
?>
</form>
<?

$fechaz=$_GET['fechax'];

if (isset($fechaz))
{$fecha=$fechaz;}
else 
{$fecha=date('Y-m-d');}	
$muestra = date("d-m-Y", strtotime($fecha));
?>

</div>
<br><br><br><br>
<h1>Ausentes/Tardes <?;echo $muestra;?></h1>
<br><br>
<tr>
							
							
<form method="GET" action="selcurparver.php" target="_self">
							<td width="150" bgcolor="#EAEAEA" align="left"><font color="<?echo $color;?>">Fecha Parte:</td>
							</font>
							
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="fechax" id="fechax" value="<?echo $_GET["fechax"];?>" maxlength="10"/>
							<img src="calendario.png" width="16" height="16" border="0" title="Fecha Desde" id="fechas2">
							<input type='submit' value='Ver' name='partedia' />
							</td>
							
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"fechax",       // id del campo de texto 
	    					ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
						button:"fechas2"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>
</form>

	</tr>
	<br><br><br><br>

<table style="width: 60%;" border="5" cellpadding="1">






<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Curso</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Hora</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Materia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Docente</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Asistencia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Observaciones del Parte</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Licencias Registradas</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Observaciones Admin</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Previsualizar</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Notificar</b></td>
		
</tr>			
<?

$fechaz=$_GET['fechax'];
if (isset($fechaz))
{$fecha=$fechaz;}
else 
{$fecha=date('Y-m-d');}	



$consulta="SELECT PP.registro,PP.hora,M.descripcion as materia,M.idmateria,CONCAT(D.apellido, ' ', D.nombre) as nombredoc,D.dni,PP.estado,C.idcurso,C.descripcion as cursox,C.turno,PP.observaciones,PP.anotaciones FROM partepreceptores PP, docente D, materias M, curso2 C WHERE PP.fecha='$fecha' AND PP.curso=C.idcurso AND M.idmateria=PP.materia AND PP.docente=D.dni AND PP.estado!='P' ORDER BY C.descripcion,PP.hora ASC";
$result79 = mysql_query ($consulta);

/*$conn = mysql_connect('localhost', 'root', 'msi2010');*/
mysql_select_db('sid');


//$res = mysql_query($sql) ;

echo "<form method='GET' action='selcurparver.php' target='_self'>";
while ($fila79 = mysql_fetch_array($result79))
				{ 
					
					$consultalic="SELECT docentes.dni,apellido,nombre, motivo,hora, descripcion,fecha_desde,observaciones, count( motivo ) AS cantidad,f_notif FROM ausentes, motivos, docentes WHERE ausentes.fecha_desde >= '$fecha' AND ausentes.identificacion = 1 AND ausentes.motivo = motivos.codigo AND ausentes.docente = docentes.dni and (ausentes.motivo=89 or ausentes.motivo=83 or ausentes.motivo=84 or ausentes.motivo=29 or ausentes.motivo=20 or ausentes.motivo=1 or ausentes.motivo=2 or ausentes.motivo=3 or ausentes.motivo=4 or ausentes.motivo=8 or ausentes.motivo=9 or ausentes.motivo=24 or ausentes.motivo=6 or ausentes.motivo=7 or ausentes.motivo=42 or ausentes.motivo=44 or ausentes.motivo=15 or ausentes.motivo=3 or ausentes.motivo=56 or ausentes.motivo=67 or ausentes.motivo=5 or ausentes.motivo=70 or ausentes.motivo=48 or ausentes.motivo=17 or ausentes.motivo=18 or ausentes.motivo=22 or ausentes.motivo=40 or ausentes.motivo=43 or ausentes.motivo=53 or ausentes.motivo=78 or ausentes.motivo=72 or ausentes.motivo=46 or ausentes.motivo=25 or ausentes.motivo=92) AND docentes.dni='$fila79[dni]' GROUP BY dni,hora ORDER BY apellido, fecha_desde";
					//echo $consultalic;
					$result69 = mysql_query ($consultalic) or die(mysql_error());
					$licencia='';
					while ($fila69 = mysql_fetch_array($result69))
					{
						$licencia=$fila69['descripcion'];
					}
				/*if ($fila79[anotaciones]!='')
				{$licencia=$fila79[anotaciones];}*/
			
			
			
				echo "<tr>";
				echo "<td align='center'><a href='ORIGINALV.php?curso=$fila79[idcurso]' target=_blank>$fila79[cursox]</a></td>";
				echo "<td align='center' >$fila79[hora]</td>";
				echo "<td>$fila79[materia]</td>";
				echo "<td><a href='leg_unif.php?actor=$fila79[dni]' target=_blank>$fila79[nombredoc]</a></td>";
				echo "<td align='center'>$fila79[estado]</td>";
				echo "<td align='center'>$fila79[observaciones]</td>";
				echo "<td align='center'>".$licencia."</td>";
				echo  "<td align='center'><font size='3' color'FF0000'>".$fila79[anotaciones]."</font><br><br><a href='ppanotaciones.php?id=$fila79[registro]' target=_blank><font size='1' color'FF0000'>Modificar</a></font></td>";
				echo "<td align='center'><a href='notificacionausente.php?fechaxxx=$fecha&dnix=$fila79[dni]&materiax=$fila79[materia]&cursox=$fila79[cursox]&turnox=$fila79[turno]&observacionex=$fila79[observaciones]&tipox=$fila79[estado]&vistax=S' target=_blank>Ver</a></td>";
				echo "<td align='center'><a href='notificacionausente.php?fechaxxx=$fecha&dnix=$fila79[dni]&materiax=$fila79[materia]&cursox=$fila79[cursox]&turnox=$fila79[turno]&observacionex=$fila79[observaciones]&tipox=$fila79[estado]&vistax=N' target=_blank>Notificar</a></td>";
?>
				



<?
				 echo "</tr>";		
				  		
				}	

?>

</table>
 </div>		
</form>

<br><br>
</body>
<?


  
  
  

  ?>



<?


  
  
 include 'footer.php'; 
}
  ?>
</html>