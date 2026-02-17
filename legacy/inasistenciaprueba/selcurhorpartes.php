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

<form method="GET" action="partepreceptores.php" target="_blank">

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
<br><br><br>
<table border="0" width="50%">
<tr>
<td  bgcolor="#EAEAEA" align="left"><font color="<?echo $color;?>">Curso:</td>
<td  bgcolor="#EAEAEA" align="left">
<?php 		
		
		
			
			$result79 = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC");
							
			
			echo "<select name=curso>";
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
 							<input type="text" name="fecha" id="fecha" value="<?echo $_GET["fecha"];?>" maxlength="10"/ required>
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
	<td></td>
    <td align="left">
	<?
	echo "<input type='submit' value='Mostrar Parte' name='submitcurso' /></td></tr>";
include 'footer.php';
?>
			
			
		
	</table>


	</form>
</div>
</body>
<?


  
  
  

  ?>


</html>
<?
}

  
  
  

  ?>
