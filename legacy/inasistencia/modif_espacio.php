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





$r2zz = mysql_query ("SELECT * FROM espacio where id=$ofre");
$r2z = mysql_fetch_array($r2zz);

$r8 = mysql_query ("SELECT * FROM ofrecimiento WHERE numero = $r2z[ofrecimiento]");
$f8 = mysql_fetch_array($r8);


$r9 = mysql_query ("SELECT * FROM 1090_18espacios_junta WHERE numero = $f8[id_junta]");
$f9 = mysql_fetch_array($r9);

$r22 = mysql_query ("SELECT * FROM 1090_18espacios_junta");


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

<form method="POST" action="modif_espacio.php?ofre=<? echo $ofre?>">
<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p>

<div align="left">


<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Ofrecimiento: <b><?echo $f8['numero'] . "</b> - Detalle: <b>" . $f9[descripcion]; ?></b></td>
						</tr>						


						</table>



<br><br>



				
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">Espacios</td>
						</tr>	

						
						<tr>

							<td width="174" bgcolor="#EAEAEA" align="right"></td>
							<td bgcolor="#EAEAEA" width="268" align="left"></td>

						</td>

							

							<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Caracter:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"><input type="text" name="caracter" size="20" maxlength="40" value="<?echo $r2z[caracter];?>" />

						</td>
							
						</tr>
						<tr>
					
							<td width="174" bgcolor="#EAEAEA" align="right">Horarios:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><TEXTAREA COLS=35 ROWS=5 NAME="horarios" ><?echo $r2z[hs_cubrir]; ?></TEXTAREA></td>
						

							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Motivo:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"><input type="text" name="motivo" size="40" maxlength="40" value="<?echo $r2z[motivo];?>" />
							</td></td>
							
	
						</tr>
						<tr>
								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Turno:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"><input type="text" name="turno" size="10" maxlength="10" value="<?echo $r2z[turno];?>" />


				</td></td>

							<td width="174" bgcolor="#EAEAEA" align="right">Curso:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><input type="text" name="curso" size="2" maxlength="2" value="<?echo $r2z[curso];?>" /></td>
		


							
	
						</tr>

			
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Duracion:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="duracion" size="30" maxlength="50" value="<?echo $r2z[duracion];?>" /></td>
							</td>
							
					
					
								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Div:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"><input type="text" name="div" size="2" maxlength="2" value="<?echo $r2z[divi];?>" />


							</td>
						</tr>

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Cant. Hs:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="hs" size="2" maxlength="2" value="<?echo $r2z[horas];?>"/></td>
							</td>
							
					
					
								<td width="74" bgcolor="#EAEAEA" align="right">ID plaza SIGE</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"><input type="text" name="junta" size="10" maxlength="10" value="<?echo $r2z[id_junta];?>"/>


							</td>
						</tr>
						

						

						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"></td>
						</tr>


						</table>


							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						



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


	$horarios=$_POST['horarios'];
	$duracion=$_POST['duracion'];
	$turno=$_POST['turno'];
	$caracter=$_POST['caracter'];
	$curso=$_POST['curso'];
	$div=$_POST['div'];
	$motivo=$_POST['motivo'];
	$hs=$_POST['hs'];
	$ofre=$_POST['ofre'];
	$plaza=$_POST['junta'];





	if (mysql_query ("UPDATE espacio SET hs_cubrir='$horarios', caracter='$caracter', turno='$turno', duracion='$duracion', curso='$curso', divi='$div', motivo='$motivo', horas='$hs', id_junta='$plaza' WHERE id=$ofre"))
	{		

				?>
				<script>
				var answer=alert("Espacio MODIFICADO")
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