<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

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
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<title>SID</title>

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




$errordoc = 0;
$hayerrores = 0;
$anio= date("Y");



$r22 = mysql_query ("SELECT * FROM 1090_18espacios_junta order by descripcion");


 

  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos





}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="ofrecimiento.php">
</p>
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
				<table border="0" width="980" cellspacing="0" cellpadding="0">
					<tr>
						
					</tr>
				</table>
				
				<p></div>
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
				<tr>
				

					<td>
					
					<p align="left" class="text1b">Alta de ofrecimientos</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Usuario 1:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left"><input type="text" name="usuario1" size="30" maxlength="30" value="<?echo $_POST['usuario1'];?>" />
                        
						<td width="150" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="fecha" id="fecha" value="<?echo $_GET["fecha"]?>" maxlength="10"/>
    							<img src="calendario.png" width="16" height="16" border="0" title="Fecha" id="fecha">
							</td>
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"fecha",       // id del campo de texto 
	    					ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
						button:"fecha"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>


							
						</tr>
						<tr>
					
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Usuario 2:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left"><input type="text" name="usuario2" size="30" maxlength="30" value="<?echo $_POST['usuario1'];?>" />

                          
                        
							

							<td width="190" bgcolor="#EAEAEA" align="right">
							Hora:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="hora" size="5" maxlength="5" value="<?echo $_POST['hora'];?>" />(HH:MM)</td>
							</td>
							
	
						</tr>
						<tr>
					
							<td width="174" bgcolor="#EAEAEA" align="right">Detalle del ofrecimiento:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><TEXTAREA COLS=35 ROWS=5 NAME="obs"></TEXTAREA></td>
						

							

								<td width="74" bgcolor="#EAEAEA" align="right"></td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"></td>
							
	
						</tr>

			
				




						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center">		 <select size="1" autofocus="true" name="motivo">						  <?	
                            					WHILE ($myrow8 = mysql_fetch_array($r22)) {			
						    	echo "<option value=" . $myrow8[numero] . ">" . $myrow8[descripcion] ." - ". $myrow8[numero] . "</option>";
						    }
						  ?>
                          </select></td>
						</tr>

						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						</table>
					</div>
					<p align="right">&nbsp;</div>
					<hr>
					</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
			</div>
		</tr>
	</table>

	</form>
</div>
</body>
<?
}
else
{
	

	$fecha=$_POST[fecha];
	$hora=$_POST['hora'];
	$usr1=$_POST['usuario1'];
	$usr2=$_POST['usuario2'];
	$obs1=$_POST[obs];
	$junta=$_POST[motivo];




$rr1 = mysql_query ("select * from ofrecimiento order by numero desc");
$ff1 = mysql_fetch_array($rr1); 

$este=$ff1["numero"]+1;


mysql_query ("INSERT INTO ofrecimiento VALUES ($este,$junta,'$obs1','$fecha','$hora','$usr1','$usr2')");


$resultofre = mysql_query ("select * from ofrecimiento order by numero desc limit 1");
$filaofre = mysql_fetch_array($resultofre); 


				?>
				<script>
				var answer=alert("Ofrecimiento N�:<? echo $filaofre["numero"];?> ")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<?
	
}

?>
</html>
<? } ?>
