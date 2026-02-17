<?PHP
session_start();
if ($_SESSION['estado']==1) { 


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



<!DOCTYPE html> <!-- PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" -->
<html>

<head>

<!-- meta http-equiv="Content-Type" content="text/html; charset=windows-1252" / -->
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<title>SID</title>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">


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
include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];



$dni = $_SESSION['docente']; 


$rest1 = substr($dni, 0, 2);
$rest2 = substr($dni, 2, 3);
$rest3 = substr($dni, 5, 3);

$rest4 =$rest1.".".$rest2.".".$rest3;

$debe=utf8_decode($_SESSION['debe']);

$resultdocente = mysql_query ("SELECT * FROM alumnos where dni='$rest4'");
$filadocente = mysql_fetch_array($resultdocente); 

$resultcodigo = mysql_query ("SELECT * FROM docentes_mesas order by materia,curso"); 


$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"])) {


// controlo que el plan no sea 0 

	if ($_POST["materia"] == 0){ $errorplan = 1; $hayerrores = 1; };





}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="add_materias2.php">
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
<?		
include 'menuppal2.php';

?>	
				<tr>
				

					<td>
					<br>
					<p align="left" class="text1b">Alumno: <?echo $filadocente[alumno];?>--- Usted debe: <?echo utf8_encode($debe);?></p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left"><br><br><? if($error) { echo "<h4><font color=red>Datos vacios o incompletos</font></h4>";} ?><br>
<b>Se deben cargar los siguiente datos la cantidad de veces por cada Materia que usted rinda. </b><br>

					<br><br>
		<?
	  		if ($errorplan==1) {$color="#FF0000";}
			else{$color="#000000";}
		?>
			<font color="<?echo $color;?>">Seleccione un curso y materia: <select size="1" name="materia">
			<?	WHILE ($myrow6 = mysql_fetch_array($resultcodigo))
				{			
					if($_POST['materia']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
					echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[materia] $myrow6[curso] $myrow6[plan] </option>";
				}
		?></select>		

<br><br>

<div align="center">
			
	

					

							<p align="center"><input type="submit" value="     Anotarme     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" />
			


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
<input name="dni" type="hidden" value ="<?php echo $dni ?>"/>
	</form>
</div>
</body>
<?
}
else
{

$ultimo=0;

	$materia=$_POST['materia'];	
	$anio=date ("Y");

$resultllamado = mysql_query ("SELECT * FROM llamado ORDER BY anio DESC LIMIT 1");
$llamado = mysql_fetch_array($resultllamado);

$resultultimo = mysql_query ("SELECT * FROM mesas ORDER BY numero DESC LIMIT 1");
$ultim = mysql_fetch_array($resultultimo);

$ultimo=$ultim[numero]+1;
	




	$resultq2 = mysql_query ("SELECT numero FROM mesas where dni='$dni' ");
	$filaq2 = mysql_fetch_array($resultq2);





		$resultw4 = mysql_query ("SELECT numero FROM mesas where dni='$dni' ");
		if (mysql_num_rows ($resultw4) == 0 )
		{ 
			$codigoins=$ultimo;
		}

else
		{ 
			$codigoins=$filaq2[numero];

		}



		if (mysql_query ("INSERT INTO mesas VALUES ($materia,'$dni','$llamado[anio]',$llamado[numero],$codigoins)"))
		{	
?>
				<script>
				var answer=alert("Se anoto correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
				
		}
	else {
?>

	<script>
				var answer=alert("Ud. ya se encuentra anotado en esta materia")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 

}
	


}
					
?>
</html>
<? } ?>