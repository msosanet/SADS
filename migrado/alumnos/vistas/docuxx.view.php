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




$resultmotivo = mysql_query ("SELECT * FROM docu_alu,documentacion where alumno=$dni and  documentacion.id=docu_alu.id order by docu_alu.id"); 




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

<form method="GET" action="docuxx.php?dni=<? echo $dni ?>">
<div align="left">
				
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Alumno: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. NÂº " . number_format($filadocente[dni],0,'','.'); ?> ------  Marque el que desea eliminar -----</td> 
						</tr>
						
					<?	WHILE ($ff = mysql_fetch_array($resultmotivo)) { 

						
 						?>
						
						<tr>
										
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"><? echo $ff['nombre'];?>:</td>

						  <td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"><input type="checkbox" name="pizarra[]" value="<?echo $ff[id]; ?>">
                  
						</td>

							

							
					
							
						</tr>
<? } ?>
						
						
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Eliminar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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







$control=0;



foreach ($_GET["pizarra"] as $pizarra)
	{

	
				mysql_query ("DELETE FROM docu_alu WHERE alumno=$dni and id=$pizarra"); 


	     

	
 

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
