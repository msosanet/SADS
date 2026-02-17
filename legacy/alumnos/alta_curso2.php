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

<link rel="stylesheet" type="text/css" href="style2.css" />

<title>Agrega Curso y División</title>

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

$resultdocente = mysql_query ("SELECT * FROM alumno where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 



$anio=date("Y");

$ye2 = mysql_query ("SELECT * FROM cursa where alumno='$dni' and anio='$anio'");
$yaesta2 = mysql_fetch_array($ye2);


$ye22 = mysql_query ("SELECT modalidad FROM cursa where alumno='$dni' and control='1'");
$data=mysql_fetch_array($ye22);

$ye4 = mysql_query ("SELECT curso,anio FROM cursa where alumno='$dni' and control='1'");
$data2=mysql_fetch_array($ye4);

$ye3 = mysql_query ("SELECT divi FROM cursa where alumno='$dni' and control='1'");
$data3=mysql_fetch_array($ye3);
 

//$resultmotivo = mysql_query ("SELECT distinct curso FROM cursa WHERE anio='$anio' order by curso"); 
//$resultmotivo2 = mysql_query ("SELECT distinct divi FROM cursa WHERE anio='$anio' order by divi"); 



$errordoc = 0;
  $hayerrores = 0;



function menu($ssql,$valor,$nombre){ 
  	echo "<select name='$nombre'>\n"; 
  	$resultado=mysql_query($ssql); 
  	while ($fila=mysql_fetch_row($resultado)){ 
    	if ($fila[0]==$valor){ 
      	echo "<option value='$fila[0]' selected>$fila[0]</option>\n";	
    	} 
    	else{ 
      	echo "<option value='$fila[0]'>$fila[0]</option>\n";	
    	} 
  } 
  	echo "</select>";	
}


//menuAnio($valorAnio,$data2['anio'],'anio',$data3['divi']);
function menuAnio($ssql,$valor,$nombre,$div){
	$proxAnio=date("Y",strtotime("+1 year"));
  	if ($div != "") echo "<select name='$nombre' disabled>\n"; 
	else echo "<select name='$nombre'>\n"; 
//  	echo $ssql ."\n";
	$resultado=mysql_query($ssql);
	$bandera=true;
  	while ($fila=mysql_fetch_row($resultado)){ 
//    	echo $fila[0]." ".$valor;
		if ($fila[0]==$valor){ 
      	 echo "<option value='$fila[0]' selected>$fila[0]</option>\n";	
    	} 
    	else{ 
      	 echo "<option value='$fila[0]'>$fila[0]</option>\n";	
    	} 
		if ($fila[0]==$proxAnio) $bandera = false;
	}
	if ($bandera) echo "<option value='" . $proxAnio . "'>" . $proxAnio . "</option>\n";	
  	echo "</select>\n";
	if ($div != "") echo "<input hidden name='$nombre' value='$valor'>\n"; 
}


function menu2($ssql,$valor,$nombre){ 
  	echo "<select name='$nombre'>\n"; 
  	$resultado=mysql_query($ssql); 
  	while ($fila=mysql_fetch_row($resultado)){ 
    	if ($fila[0]==$valor){ 
      	echo "<option selected value='$fila[0]'>$fila[1]</option>\n";	
    	} 
    	else{ 
      	echo "<option value='$fila[0]'>$fila[1]</option>\n";	
    	} 
  } 
  	echo "</select>";	
}





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

<form method="GET" action="alta_curso2.php">
<div align="left">
				
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Alumno: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. Nº " . number_format($filadocente[dni],0,'','.'); ?> -- Curso:<?echo $data2['curso'] ?>º / <?echo $data3['divi'] ?>º</td>
						</tr>
						
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right">Curso:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
                          				<? 	$valor2="SELECT distinct curso FROM cursos ORDER BY curso";
							menu($valor2,$data2['curso'],'curso'); ?>
						</td>

							

							<td width="74" bgcolor="#EAEAEA" align="right">Año:</td>
							<td bgcolor="#EAEAEA" width="425" align="left">

                         		<? 	$valorAnio="SELECT distinct anio FROM cursa ORDER BY anio";
									menuAnio($valorAnio,$data2['anio'],'anio',$data3['divi']); ?>
							</td>
							
						</tr>
						
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right">Division:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
							<? 	$valor3="SELECT distinct division FROM cursos order by division";
							menu($valor3,$data3['divi'],'divi'); ?>
						</td>

							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="red">Atención:</font></td>
							<td bgcolor="#EAEAEA" width="425" align="left">Para registrar el pase de año utilizar <a href="alta_curso_varios.php">esta interfaz</a>

							</td>
							
						</tr>
						<tr>
						
						
						
						  <td width="174" bgcolor="#bbCbbb" align="right">Modalidad:</td>
						  <td bgcolor="#bbCbbb" width="268" align="left">
								<? 	$valor="SELECT * FROM plan order by id";
							menu2($valor,$data['modalidad'],'modalidad'); ?>
                          
     
						</td>

							

						  <td width="174" bgcolor="#bbCbbb" align="right"></td>
						  <td bgcolor="#bbCbbb" width="268" align="left">
                          

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


	$curso=$_GET['curso'];
	$divi=$_GET['divi'];
	$modalidad=$_GET['modalidad'];
	
//	if(isset($_GET['anio'])) 
		$anio=$_GET['anio'];


$control=0;

$graba=$filausuario["nombre"];
$hora=date("H:i:s");

$now=date("Y-m-d");
$ye = mysql_query ("SELECT * FROM cursa where alumno=$dni and anio='$anio' and control=1");
$yaesta = mysql_num_rows($ye);
$fil = mysql_fetch_array($ye);  

$resultdocente = mysql_query ("SELECT * FROM alumno where dni=$dni");
$filla = mysql_fetch_array($resultdocente); 

$alumno=$filla['apellido'].", ".$filla['nombre'];


if (mysql_num_rows($ye) && $fil['curso']==1 && $fil['divi']=='-') $novedades1 = "Ingreso a la escuela"; // Cuando se cambia 1° -  y se asigna división, la novedad grabada es el ingreso
else $novedades1 = "Se cambio de curso";

if ($curso == 1 && $divi == '-') $novedades2="Inscripción"; // Cuando se le asigna división '-' la novedad es la inscripción
else $novedades2 = "Ingreso a la escuela";

$cursi=$curso."/".$divi;


if ($yaesta >= 1) {
			$control = mysql_query ("INSERT INTO cursa VALUES ($dni,'$curso','$divi','$anio',0,1,'$now',$modalidad)");

			$control = $control AND mysql_query ("UPDATE cursa SET control=0 where curso='$fil[curso]' and divi='$fil[divi]' and alumno=$dni and anio='$anio' and control=1"); 
		
			$control = $control AND mysql_query ("INSERT INTO novedades VALUES (0,$dni,'$alumno','$cursi','$novedades1','$now','$hora','$graba',1,0)");
			
/*			echo var_export($_GET,true) . "\n";
			
			echo "INSERT INTO cursa VALUES ($dni,'$curso','$divi','$anio',0,1,'$now',$modalidad)"."<br>UPDATE<br>INSERT INTO novedades VALUES (0,$dni,'$alumno','$cursi','$novedades1','$now','$hora','$graba',1,0)"; */

			$control=1;
		 }
else 		{ 

			$control = mysql_query ("INSERT INTO cursa VALUES ($dni,'$curso','$divi','$anio',0,1,'$now',$modalidad)");
			$control = $control AND mysql_query ("INSERT INTO novedades VALUES (0,$dni,'$alumno','$cursi','$novedades2','$now','$hora','$graba',1,0)");

//			echo var_export($_GET,true) . "<br> INSERT INTO novedades VALUES (0,$dni,'$alumno','$cursi','$novedades2','$now','$hora','$graba',1,0) <br>INSERT";

			//$control=1;
		}



if ($control){

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script> 
				<meta http-equiv='refresh' content='0; URL=alta_curso.php?'>
				<? 

				
	}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=alta_curso.php?'>
				<? 
				}					



}

?>
</html>
<? } ?>