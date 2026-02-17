<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<!-- <script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script> -->
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Reclamo documentaci&oacute;n</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'encabezado.php';


function get_browser_name($user_agent){
    $t = strtolower($user_agent);
    $t = " " . $t;
    if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera'            ;   
    elseif (strpos($t, 'edge'      )                           ) return 'Edge'             ;   
    elseif (strpos($t, 'chrome'    )                           ) return 'Chrome'           ;   
    elseif (strpos($t, 'safari'    )                           ) return 'Safari'           ;   
    elseif (strpos($t, 'firefox'   )                           ) return 'Firefox'          ;   
    elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
    return 'Unkown';
}

?>

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$dni=$_GET["dni"];

$documentacion = mysql_query("SELECT id,nombre FROM documentacion");
$presentada = mysql_query("SELECT * FROM docu_alu WHERE alumno = $dni");

$resultt = mysql_query ("SELECT dni,apellido,nombre FROM alumno WHERE dni = $dni");
$filatt = mysql_fetch_assoc($resultt);

$resemp3 = mysql_query ("SELECT curso,divi FROM cursa where alumno=$dni and control=1");
$totemp3 = mysql_fetch_assoc($resemp3);

/*

$resemp5 = mysql_query ("SELECT materia FROM previas where alumno=$dni and observacion='ADEUDA' ");





$concatena="";


while ($totemp5 = mysql_fetch_array($resemp5)) {

$concatena=$concatena." - ".$totemp5[materia];


}

*/

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

<form method="POST" action="adeudaDocumentacion.php">
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
			<?
include "snipet_barramenu.php";
?>
			<table border="0" width="980">
	
				<tr>
				

					<td>
					
					<p align="left" class="text1b">Reclamar documentaci&oacute;n</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
							<td bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Alumno: <?echo $filatt['apellido']; ?>, <?echo $filatt['nombre']; ?></font>
							</td>	

							<td bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I.: <?echo $filatt['dni']; ?></font>
							</td>
							
							<td bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">curso:</font> <?echo $totemp3[curso] . "o. " . $totemp3[divi]; ?></td>												
						</tr>
						</td></tr>
						<td><tr>

							

						<tr>


							<td bgcolor="#EAEAEA" align="right">
							Observaciones:</td>
							<td bgcolor="#EAEAEA" align="left"><!--<input type="text" name="observaciones" size="50" maxlength="100" value="" />--></td>
							
					
					


							<td bgcolor="#EAEAEA" align="right">
							Curso completo:</td>
							<td bgcolor="#EAEAEA" align="left">
 							<input type="checkbox" id="vehicle1" name="cero" value="10">
							<label for="vehicle1"> Ninguno</label><br>
							<input type="checkbox" id="vehicle1" name="uno" value="1">
							<label for="vehicle1"> 1º</label><br>
							<input type="checkbox" id="dos" name="dos" value="2">
							<label for="vehicle2"> 2º</label><br>
							<input type="checkbox" id="tres" name="tres" value="3">
							<label for="vehicle3"> 3º</label><br> 
							<input type="checkbox" id="cuatro" name="cuatro" value="4">
							<label for="vehicle3"> 4º</label><br>
							<input type="checkbox" id="cinco" name="cinco" value="5">
							<label for="vehicle3"> 5º</label><br>
							<input type="checkbox" id="seis" name="seis" value="6">
							<label for="vehicle3"> 6º</label><br>

							</td>
							
						</tr>
		

			
						<tr>
							
						</tr>
						<tr>
							<td bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Generar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></p></td>
						</tr>
						</table>
					</div>
					<p align="right">&nbsp;</div>
					<hr>
					</td>
				</tr>
				<?

?>
			</table>
			</div>
		</td>
		</tr>
	</table>
<input type="hidden" name="actor" value="<?echo $dni;?>">
</div>
	</form>
<?
include 'foot.php';
}
else
{


	$observaciones=ucfirst($_GET['observaciones']);
	$uno=$_GET['uno'];
	$dos=$_GET['dos'];
	$tres=$_GET['tres'];
	$cuatro=$_GET['cuatro'];
	$cinco=$_GET['cinco'];
	$seis=$_GET['seis'];
	$ninguno=$_GET['cero'];



if (get_browser_name($_SERVER['HTTP_USER_AGENT'])=="Chrome")
{
if ($uno==1) $juntar1="1er aÃ±o - ";
if ($dos==2) $juntar2="2do aÃ±o - ";
if ($tres==3) $juntar3="3er aÃ±o - ";
if ($cuatro==4) $juntar4="4to aÃ±o - ";
if ($cinco==5) $juntar5="5to aÃ±o - ";
if ($seis==6) $juntar6="6to aÃ±o - ";
if ($ninguno==10) $juntar7=" NingÃºn Curso";


}

else
{
if ($uno==1) $juntar1="1er año - ";
if ($dos==2) $juntar2="2do año - ";
if ($tres==3) $juntar3="3er año - ";
if ($cuatro==4) $juntar4="4to año - ";
if ($cinco==5) $juntar5="5to año - ";
if ($seis==6) $juntar6="6to año - ";
if ($ninguno==10) $juntar7=" Ningun Curso"; 

}

$juntar=$juntar1.$juntar2.$juntar3.$juntar4.$juntar5.$juntar6.$juntar7;









		

				?>
				<script>
				var answer=alert("Generando pase")
				</script> 
				<meta http-equiv='refresh' content='0; URL=const_pase.php?dni=<?php echo $dni?>&observa=<?php echo$observaciones?>&juntar=<?php echo $juntar?>'>

				<? 			


				
}

?>
<? } ?>
