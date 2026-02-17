<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un guión.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}

//esto pasa las mayusculas acentuadas a minusculas acentuadas
function strtolowerExtended($str)
{
        $low = array(chr(193) => chr(225), //Ã¡
                    chr(201) => chr(233), //Ã©
                    chr(205) => chr(237), //Ã­Â­
                   chr(211) => chr(243), //Ã³
                   chr(218) => chr(250), //Ãº
                  chr(220) => chr(252), //Ã¼
                    chr(209) => chr(241)  //Ã±
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

<title>CARGAR familiares</title>

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
$dni=$_GET['dni'];



$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM alumno where dni=$dni");
$filadocente = mysql_fetch_array($resultdocente); 




$resultmotivo = mysql_query ("SELECT * FROM familiares order by apellido"); 
$resultmotivo2 = mysql_query ("SELECT * FROM familiares order by apellido"); 
$resultmotivo3 = mysql_query ("SELECT * FROM familiares order by apellido"); 

$resultE = mysql_query ("SELECT * FROM alu_fami WHERE alumno='$dni'"); 
 while ($fil = mysql_fetch_array($resultE)) 
{
	
		if ($fil['tipo']=='P')	
		{$padrex=$fil['familiar'];}
		if ($fil['tipo']=='M')	
		{$madrex=$fil['familiar'];}
		if ($fil['tipo']=='T')	
		{$tutorx=$fil['familiar'];}
	
}
if (!isset($padrex))
{$padrex=0;}
if (!isset($madrex))
{$madrex=0;}
if (!isset($tutorx))
{$tutorx=0;}


	
$errordoc = 0;
 $hayerrores = 0;





  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>


<?
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

<form method="GET" action="unir_fami2.php?dni=<? echo $dni ?>">
<div align="left">
				
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Alumno: <b><?echo strtoupper($filadocente['apellido']) .", " . ucwords(strtolower($filadocente['nombre'])) . "</b> - D.N.I. Nº " . number_format($filadocente[dni],0,'','.'); ?></td>
						</tr>
						
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Padre:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
                          <select size="1" autofocus="true" name="motivo"> <!-- ****************************LISTA MOTIVOS -->
						  <?	
                            WHILE ($myrow6 = mysql_fetch_array($resultmotivo)) {			
						    	if ($myrow6['dni']==$padrex)
									{echo '<option value="' . $myrow6['dni'] . '" selected>' . $myrow6['apellido'] . ' ' . $myrow6['nombre'] . ' - D.N.I. Nº ' . $myrow6['dni'] . "</option>\n";}
								else
									{echo "<option value='" . $myrow6['dni'] . "' >" . $myrow6['apellido'] . " " . $myrow6['nombre'] . " - D.N.I. Nº " . $myrow6['dni'] . "</option>\n";}
							}
						  ?>
                          </select>
						</td>

							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"></td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							</td>
							
						</tr>
						
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Madre:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
                          <select size="1" autofocus="true" name="motivo2"> <!-- ****************************LISTA MOTIVOS -->
						  <?	
                            WHILE ($myrow62 = mysql_fetch_array($resultmotivo2)) {
								if ($myrow62['dni']==$madrex)
									{echo "<option value='" . $myrow62['dni'] . "' selected>" . $myrow62['apellido'] . " " . $myrow62['nombre'] . " - D.N.I. Nº " . $myrow62['dni'] . "</option>\n";}	
								else
									{echo "<option value='" . $myrow62['dni'] . "' >" . $myrow62['apellido'] . " " . $myrow62['nombre'] . " - D.N.I. Nº " . $myrow62['dni'] . "</option>\n";}						    
								}
						  ?>
                          </select>
						</td>

							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"></td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							</td>
							
						</tr>

						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Tutor:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
                          <select size="1" autofocus="true" name="motivo3"> <!-- ****************************LISTA MOTIVOS -->
						  <?	
                            WHILE ($myrow63 = mysql_fetch_array($resultmotivo3)) {
								if ($myrow63['dni']==$tutorx)
									{echo "<option value='" . $myrow63['dni'] . "' selected>" . $myrow63['apellido'] . " " . $myrow63['nombre'] . " - D.N.I. Nº " . $myrow63['dni'] . "</option>\n"; }
								else
									{echo "<option value='" . $myrow63['dni'] . "'>" . $myrow63['apellido'] . " " . $myrow63['nombre'] . " - D.N.I. Nº " . $myrow63['dni'] . "</option>\n"; }
						    }
						  ?>
                          </select>
						</td>

							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"></td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							</td>
							
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

            
<input name="dni" type="hidden" value ="<?php echo $dni ?>"/>

	</form>
</div>
</body>
<?
}
else
{


$existeP = mysql_query ("SELECT * FROM alu_fami WHERE alumno='$dni' AND tipo='P'"); 
$filaP = mysql_num_rows($existeP);
$existeM = mysql_query ("SELECT * FROM alu_fami WHERE alumno='$dni' AND tipo='M'"); 
$filaM = mysql_num_rows($existeM);
$existeT = mysql_query ("SELECT * FROM alu_fami WHERE alumno='$dni' AND tipo='T'"); 
$filaT = mysql_num_rows($existeT);




	$padre=$_GET['motivo'];
	$madre=$_GET['motivo2'];
	$tutor=$_GET['motivo3'];
	$p="P";
	$m="M";
	$t="T";

$control=0;

if ($filaP==0) { 
			mysql_query ("INSERT INTO alu_fami VALUES ($dni,$padre,'$p')"); 
			$control=1;
		 }
else 		 
{ 
			mysql_query ("UPDATE alu_fami SET familiar='$padre' WHERE alumno='$dni' AND tipo='P'"); 
			$control=1;
		 }

if ($filaM==0) { 
			mysql_query ("INSERT INTO alu_fami VALUES ($dni,$madre,'$m')");
			$control=1;
 		}
else 		 
{ 
			mysql_query ("UPDATE alu_fami SET familiar='$madre' WHERE alumno='$dni' AND tipo='M'"); 
			$control=1;
		 }
	

if ($filaT==0) { 
			mysql_query ("INSERT INTO alu_fami VALUES ($dni,$madre,'$t')"); 
			$control=1;
		}
else 		 
{ 
			mysql_query ("UPDATE alu_fami SET familiar='$tutor' WHERE alumno='$dni' AND tipo='T'"); 
			$control=1;
		 }


if ($control<>0){

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script> 
				<meta http-equiv='refresh' content='0; URL=unir_fami.php?'>
				<? 

				
	}
else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=unir_fami.php?'>
				<? 
				}					



}

?>
</html>
<? } ?>