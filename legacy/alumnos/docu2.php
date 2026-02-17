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

<link rel="stylesheet" type="text/css" href="style2.css" />

<title>CARGAR documentacion</title>

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




$resultmotivo = mysql_query ("SELECT * FROM documentacion order by id"); 




$errordoc = 0;
  $hayerrores = 0;





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

<form method="POST" action="docu2.php?dni=<? echo $dni ?>">
<div align="left">
				
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Alumno: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. N� " . number_format($filadocente[dni],0,'','.'); ?></td>
						</tr>
						
					<?	WHILE ($ff = mysql_fetch_array($resultmotivo)) { 

						$check="";
						$color="#BB6666";
	
						$docu = mysql_query ("SELECT * FROM docu_alu where alumno=$dni and id=$ff[id]");
						$consulta = mysql_num_rows($docu);
						$docum = mysql_fetch_array($docu);
						if ($consulta >=1) {
									$check="checked";
									$color="#000000";
									$descrip=$docum['descripcion'];

								   }
						else $descrip="";
						if ($ff['id']==3) $input = '<input type="date" name="afectado[]" size="40" maxlength="40" value="' . $descrip . '" title="Correspondiente al ejemplar presentado"/> (fecha de vencimiento)'; // $tipo = "date"; // 
						else $input = '<input type="text" name="afectado[]" size="40" maxlength="40" value="' . $descrip . '" title="Corresponde al ejemplar presentado"/>'; // $tipo = "text"; // 
 						?>
						
						<tr>
										
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"><? echo $ff['nombre'];?>:</td>
<!--						  <td bgcolor="#EAEAEA" width="268" align="left"><input type="<?//=$tipo?>" name="afectado[]" size="40" maxlength="40" value="<?//echo $descrip; ?>" /> -->
						  <td bgcolor="#EAEAEA" width="268" align="left"><?=$input?>
                  
						</td>

							

							<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"><input type="checkbox" name="pizarra[]" value="<?echo $ff['id']; ?>" <? echo $check ?>></td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							</td>
							
						</tr>
<? } ?>
						
						
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





$afectado=$_POST["afectado"];





foreach ($_POST["pizarra"] as $pizarra)
	{

		
	$docume = mysql_query ("SELECT * FROM docu_alu where alumno=$dni and id=$pizarra");
	$consulta2 = mysql_num_rows($docume);

	if ($consulta2 ==0) {
				$i=$pizarra-1;
				mysql_query ("INSERT INTO docu_alu VALUES ($pizarra,$dni,'$afectado[$i]')"); 
			    }

	else {

		$z=$pizarra-1;
		mysql_query ("UPDATE docu_alu SET descripcion='$afectado[$z]' where alumno=$dni and id=$pizarra"); 
	     }

	
 

$control=1;
 }



if ($control<>0){

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script>
				<meta http-equiv='refresh' content='0; URL=docu.php'>
				<? 

				
	}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=docu.php'>
				<? 
				}					



}

?>
</html>
<? } ?>