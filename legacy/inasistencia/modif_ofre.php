<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un gui�n.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}

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
<link rel="stylesheet" type="text/css" href="style2.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">

<title>CARGAR ESPACIOS</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>

<body>

<div id="marco980">
<?
include 'header.php';
?>


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
$ofre=$_GET['ofre'];




$hora=date("H:i:s");



$r8 = mysql_query ("SELECT * FROM ofrecimiento WHERE numero = $ofre");
$f8 = mysql_fetch_array($r8);


$r9 = mysql_query ("SELECT * FROM 1090_18espacios_junta WHERE numero = $f8[id_junta]");
$f9 = mysql_fetch_array($r9);

$r22 = mysql_query ("SELECT * FROM 1090_18espacios_junta");

$r2zz = mysql_query ("SELECT * FROM espacio where ofrecimiento=$ofre");




$errordoc = 0;
  $hayerrores = 0;


  if (!isset($_POST["submitx"])) {



}




  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos



}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {

if ($_SESSION['valor']==1)
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

<br>

<form method="POST" action="modif_ofre.php?ofre=<? echo $ofre?>">
<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p>

<div align="left">


<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Ofrecimiento: <b><?echo $f8['numero'] . "</b> - Detalle: <b>" . $f9[descripcion]; ?></b></td>
						</tr>						
<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Usuario 1:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left"><input type="text" name="usuario1" size="30" maxlength="30" value="<?echo $f8[usuario1];?>" />
                        
						<td width="150" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="fecha" id="fecha" value="<?echo $f8[fecha]?>" maxlength="10"/>
							</td>
				


							
						</tr>
						<tr>
					
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Usuario 2:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left"><input type="text" name="usuario2" size="30" maxlength="30" value="<?echo $f8[usuario2];?>" />

                          
                        
							

							<td width="190" bgcolor="#EAEAEA" align="right">
							Hora:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="hora" size="5" maxlength="5" value="<?echo $f8[hora];?>" />(HH:MM)</td>
							</td>
							
	
						</tr>
						<tr>
					
							<td width="174" bgcolor="#EAEAEA" align="right">Detalle del ofrecimiento:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><TEXTAREA COLS=35 ROWS=5 NAME="obs" ><?echo $f8[descripcion];?></TEXTAREA></td>
						

							

								<td width="74" bgcolor="#EAEAEA" align="right"></td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"></td>
							
	
						</tr>

			




						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center">		 

							<select size="1" autofocus="true" name="motivo"><?	
                            				WHILE ($myrow8 = mysql_fetch_array($r22)) {
							if($f8[id_junta]==$myrow8[numero]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";			
						    	echo "<option value=$myrow8[numero] $seleccionado> $myrow8[descripcion] $myrow8[numero] </option>";


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
<p align="right">&nbsp;</p>

</div>
<?
include 'footer.php';
?>

            
<input name="ofre" type="hidden" value ="<?php echo $ofre ?>"/>

	</form>
</div>
</body>
<?
}
else
{


	$usr1=$_POST['usuario1'];
	$usr2=$_POST['usuario2'];
	$hora=$_POST['hora'];
	$fecha=$_POST['fecha'];
	$obs=$_POST['obs'];
	$motivo=$_POST['motivo'];
	$ofre=$_POST['ofre'];




	if (mysql_query ("UPDATE ofrecimiento SET id_junta=$motivo, descripcion='$obs', fecha='$fecha', hora='$hora',usuario1='$usr1', usuario2='$usr2' where numero=$ofre "))
	{		

				?>
				<script>
				var answer=alert("Ofrecimiento MODIFICADO")
				</script> 
				<meta http-equiv='refresh' content='0; URL=ver_ofre.php?descripcion=<? echo $r2z[ofrecimiento]?>&muestra2=+++Buscar+++'>

				<? 


				
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=ver_ofre.php?descripcion=<? echo $r2z[ofrecimiento]?>&muestra2=+++Buscar+++'>
				<? 
		}					

}
?>
</html>
<? } ?>