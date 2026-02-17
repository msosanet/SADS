<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

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
<link rel="stylesheet" type="text/css" href="style.css" />
<title>SID</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';


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
$dni=$_GET["dni"];

$resultt = mysql_query ("SELECT * FROM alumno WHERE dni = $dni");
$filatt = mysql_fetch_array($resultt);

$resemp3 = mysql_query ("SELECT * FROM cursa where alumno=$dni and control=1");
$totemp3 = mysql_fetch_array($resemp3);


//$resemp5 = mysql_query ("SELECT materia FROM previas where alumno=$dni AND (nota < 6 OR observacion='ADEUDA') "); // actualización a nueva tabla previas

$resemp5 = mysql_query ("SELECT CONCAT(materias2023.descripcion, ' ',previas.curso, '°',IF(ISNULL(previas.movilidad),'',' (M.E.)')) AS materia FROM previas LEFT JOIN materias2023 ON previas.idmateria = materias2023.idmateria WHERE alumno=$dni AND (nota < 6 OR observacion='ADEUDA')");



$concatena="";


while ($totemp5 = mysql_fetch_array($resemp5)) {

$concatena=$concatena." - ".$totemp5['materia'];


}



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

<form method="_GET" action="const_pase2.php?dni=<? echo $dni; ?>">
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
					
					<p align="left" class="text1b">REALIZAR UN PASE</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<?echo $filatt['dni']; ?>
							</td>
					
							

							<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Alumno:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<?echo $filatt['apellido']; ?>, <?echo $filatt['nombre']; ?>

							</td>	
							
						</tr>

						
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">curso:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">
						<?echo $totemp3[curso]; ?>


							</td>												

							

							<td width="190" bgcolor="#EAEAEA" align="right">
							Previas:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><?echo $concatena; ?>
 </td>
							</td>
							

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Observaciones:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><textarea name="observaciones" cols="50" rows="5" value="" /></textarea></td>
							</td>
							
					
					


							<td width="190" bgcolor="#EAEAEA" align="right">
							Curso completo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left">
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
							</td>

							
						</tr>
		

			
						<tr>
							
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Generar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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
<input type="hidden" name="dni" value="<?echo $dni;?>">
	</form>
</div>
</body>
<?
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
</html>
<? } ?>
