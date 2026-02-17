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

<title>Movimientos</title>

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
$curso=$_GET['curso'];
$dni=$_GET['dni'];
$fecha_hoy = date("Y-m-d");
$fecha_hoy2 = "01/01/0000";
$fecha_hoy3 = "01/01/0000";





$hora=date("H:i:s");




$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 


$resultmotivo = mysql_query ("SELECT * FROM materia_cargo WHERE activo=0 order by plaza, nombre"); 


$resultcaracter = mysql_query ("SELECT * FROM caracter order by codigo desc"); 



$errordoc = 0;
  $hayerrores = 0;


  if (!isset($_POST["submitx"])) {
$_POST['d']=date("d");
$_POST['m']=date("m");
$_POST['a']=date("Y");
$_POST['d2']=date("d");
$_POST['m2']=date("m");
$_POST['a2']=date("Y");
$_POST['hora']=$hora;


}




  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos

     if (trim($_POST["fecha3"]) == '') { $errorfecha = 1; $hayerrores = 1; };




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


<input type="hidden" name="dni" value="<? echo $dni; ?>">
      
            <!-- input type="hidden" value=<? echo $docente[idcurso]; ?> -->
            <?


$cur = mysql_query ("SELECT * FROM curso2 where idcurso=$curso");
$cursi = mysql_fetch_array($cur);


            ?>
            </form>
        </td>
    </tr>
</table>
<!-- ********* FIN FORMULARIO PARA SELECCIONAR DOCENTE EN FORMA DIRECTA **********************-->


<form method="POST" action="altasybajas2.php?dni=<? echo $dni; ?>">
<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p>

<div align="left">
				
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Docente: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. N� " . number_format($filadocente[dni],0,'','.'); ?></b></td>
						</tr>
						
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Cargo/Materia:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
                          <select size="1" autofocus="true" name="motivo"> <!-- ****************************LISTA MOTIVOS -->
						  <?	
                            WHILE ($myrow6 = mysql_fetch_array($resultmotivo)) {
					if ($myrow6[curso]=="")	echo "<option value=" . $myrow6[id] . ">" . $myrow6[plaza] . " - " . $myrow6[nombre] ."</option>";
		
						    	else echo "<option value=" . $myrow6[id] . ">" . $myrow6[plaza] . " - " . $myrow6[nombre] ." - " .$myrow6[curso] . "� " . $myrow6[division] ."� ". "</option>";
						    }
						  ?>
                          </select> <!-- **********************************************************FIN LISTA MOTIVOS -->
                          
						
						</td>
						<?
	  					if ($errorfecha==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha de Inicio:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left"><input type="date" value="<? echo $fecha_hoy ?>" name="fecha3">

							
						</tr>
						<tr>
					
							<td width="174" bgcolor="#EAEAEA" align="right">Observaciones:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><TEXTAREA COLS=65 ROWS=5 NAME="observaciones"></TEXTAREA></td>
						
					
							

								<td width="74" bgcolor="#EAEAEA" align="right">Fecha Alta:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="date" value="" name="fecha1">

							</td>
							
	
						</tr>


						<?
	  					if ($errorsrevi==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
						<tr>


						<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Sit. Revi:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">   <select size="1" autofocus="true" name="caracter"> <!-- ****************************LISTA MOTIVOS -->
						  <?	
                            WHILE ($myrowc = mysql_fetch_array($resultcaracter)) {			
						    	echo "<option value=" . $myrowc[codigo] . ">" . $myrowc[descripcion] . "</option>";
						    }
						  ?>
                          </select> <!-- **********************************************************FIN LISTA MOTIVOS -->
                          

                          
                         									
						</td>							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Fecha Baja:
							</td></font>
							<td bgcolor="#EAEAEA" width="425" align="left">

						<input type="date" value="<?=$fecha_hoy2?>" name="fecha2">
						</td>

						</tr>
			
						<tr>

						
						<td width="174" bgcolor="#EAEAEA" align="right"></td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                        
                          
						
						</td>							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Carg&oacute;:
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><b><? echo $filausuario['apellido']  ?>&nbsp;<? echo $filausuario['nombre']  ?></b>
							</td>
						</tr>
						<tr>

						
						<td width="174" bgcolor="#EAEAEA" align="right">
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
                        
                          
						
						</td>							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left">
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
<!-- input name="identificacion" type="hidden" value ="<?php //echo $identificacion ?>"/ -->
	</form>
</div>
</body>
<?
}
else
{



	$lic=0;
	$fecha_desde=$_POST['fecha1'];
	$fecha_hasta=$_POST['fecha2'];
	$fecha_inicio=$_POST['fecha3'];
	$materia=$_POST['motivo'];

	$observaciones=$_POST['observaciones'];
	$caracter=$_POST['caracter'];
	$dni=$_POST['dni'];
	$graba=$filausuario["nombre"]."-".date("Y-m-d");




if ($fecha_desde == "") $fecha_desde=$fecha_inicio;
else $fecha_desde=$fecha_desde;




	





if (mysql_query ("INSERT INTO alta_baja VALUES (0,$materia,'$dni','$fecha_desde','$fecha_hasta',$caracter,'$observaciones',0,'$fecha_inicio','$graba',0)"))
	{		

?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script> 
				<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<? echo $dni; ?>'>
				<? 
				
	}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
				}					
}

?>
</html>
<? } ?>