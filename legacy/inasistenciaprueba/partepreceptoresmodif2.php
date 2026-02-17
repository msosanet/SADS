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

<br><br><br><br><br>

<form method="GET" action="partepreceptoresmodif.php" target="_self">
<tr>
							
		<tr>
		<td  bgcolor="#EAEAEA" align="left"><font color="<?echo $color;?>">Curso:</td>
		<td  bgcolor="#EAEAEA" align="left">
		<?php 		
		
		
			
			$result79 = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC");
							
			
			echo "<select name=curso>";
				//echo "<option value='Todos'>".'Todos'."</option>";
				while ($fila79 = mysql_fetch_array($result79))
				{ 	
					if ($fila79['idcurso']==$_GET['curso'])
					{ echo "<option selected value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>";}
					else
					{ echo "<option value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>";}	
				}	
				
			echo "</select>";
			
		
		
		
		
	?>

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
	echo "<input type='submit' value='Ver Parte' name='submitcurso' />";

?>


<?php 	
	
//	$elegido='0';	
		
			
//			echo $elegido;

if (isset($_GET["submitcurso"])) {
echo "<br><br>";
$curso=$_GET['curso'];
$fecha=$_GET['fecha'];
$fechaz=date("d-m-Y", strtotime($fecha));

$consulta="SELECT PP.hora,M.descripcion as materia,CONCAT(D.apellido, ' ', D.nombre) as nombredoc,PP.estado,C.descripcion,PP.observaciones,D.dni FROM partepreceptores PP, docente D, materias M, curso2 C WHERE PP.fecha='$fecha' AND PP.curso='$curso' AND PP.curso=C.idcurso AND M.idmateria=PP.materia AND PP.docente=D.dni ORDER BY PP.hora ASC";
//echo $consulta;
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
<td  bgcolor="#EAEAEA" align="center"><font size=3 color="<?echo $color;?>">Parte Diario del Curso: <?echo $cursodesc;?> del dia <?echo $fechaz;?></td>
</table>
	

<table style="width: 75%;" border="5" cellpadding="3">

<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Hora</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Materia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Docente</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>P</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>T</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>A</b></td>
		
		<td bgcolor="#EAEAEA" align="center"><b>Observaciones</b></td>
		
</tr>			

<?php
				
			
			
				//$j=1;
				while ($fila79 = mysql_fetch_array($result79))
				{ $hora=$fila79[hora];
				  $dni=$fila79[dni];	
				  echo "<tr>";
				  echo "<td align='center' >$fila79[hora]</td>";
				  echo "<td><a href='ORIGINALVP.php?curso=$curso' target='_blank'>$fila79[materia]</a></td>";
				  echo "<td><a href='ORIGINALVDP.php?actor=$dni' target='_blank'>$fila79[nombredoc]</a></td>";
				  			 
				 // echo $fila79['estado'];
				  //echo $dni;
					
				 ?>
				  
				 <td><input type='radio' name="ij[<? echo $hora;?>]" <?if ($fila79[estado]=='P'){echo " checked='checked' ";}?> value='P'></td>
				 <td><input type='radio' name="ij[<? echo $hora;?>]" <?if ($fila79[estado]=='T'){echo " checked='checked' ";}?> value='T'></td>
				 <td><input type='radio' name="ij[<? echo $hora;?>]" <?if ($fila79[estado]=='A'){echo " checked='checked' ";}?> value='A'></td>
				 
				  <?
				 
				  //echo "<td><input type='text' name='observaciones[$hora]' value='$fila79[observaciones]'/></td>";
				 echo "<td><textarea name='observaciones[$hora]' rows='1' cols='30'>".$fila79[observaciones]."</textarea></td>";
				 echo "<input type='hidden' name='dni[$hora]' value='$dni'/>";
				
				 
				  echo "</tr>";		
				//$j++;
				}	
				
			
			
		
		
		
		
	?>
	<input name="cantidad" type="hidden" value ="<?php echo $j ?>"/>
	<input name="quien" type="hidden" value ="<?php echo $j ?>"/>
	<input name="fecha" type="hidden" value ="<?php echo $fecha ?>"/>
	
	

	

	</table>
	<?
	echo "<br><br>";
echo "<input type='submit' value='Modificar Parte' name='modifparte' />";	
}
else
{echo "No se ha cargado ningun parte para el curso seleccionado para la fecha: $fecha";}
echo "<br><br>";

echo "<br><br>";



?>
</form>			
<?
}

if (isset($_GET['modifparte'])) 
{	
$curso=$_GET['curso'];
$fecha=$_GET['fecha'];
$cantidad=$_GET['cantidad'];
$falta=$_GET['ij'];
$obs=$_GET['observaciones'];
$doc=$_GET['dni'];

for ($z = 1; $z <= count($doc); $z++) 
{
	
$sql="UPDATE partepreceptores SET estado='$falta[$z]',observaciones='$obs[$z]',quien='$_SESSION[usuario]',fechamodif=CURRENT_TIMESTAMP() WHERE curso='$curso' AND docente='$doc[$z]' AND hora='$z' AND fecha='$fecha'";	
//echo $sql;
mysql_query ($sql);
	

if (mysql_query ($sql))
	{

?>
			
			
			<?

    	
				
	}
	
				else {	
			?>
				<script>
					var answer=alert("No se pudo grabar en la BD")
				</script> 
				
				
				
				
				<? 
					}











}




}	
?>

	
<br><br><br><br>		
<?
include 'footer.php';

  
  
  


  ?>
</div>
</body>
</html>
<?

}


  
  
  

  ?>
