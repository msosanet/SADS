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

<title>CARGAR LICENCIAS</title>

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
$dni=$_GET['actor'];
//$identificacion=$_GET['ident'];


$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 

$resultrr = mysql_query ("SELECT * FROM alta_baja where docente='$dni'");



$resultplaza = mysql_query ("SELECT * FROM materia_cargo WHERE activo=1 order by plaza
"); 



//if ($identificacion==1) // DOCENTE ACTIVO
//{
$resultmotivo = mysql_query ("SELECT * FROM motivos where codigo = 83 or codigo = 84 or codigo = 89 or codigo = 29 or codigo = 20 or codigo = 94 order by descripcion"); 
//}
//if ($identificacion==2) //DOCENTE NO ACTIVO
//{
//$resultmotivo = mysql_query ("SELECT * FROM motivos2 order by descripcion"); 
//}

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

     if (trim($_POST["d"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["m"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["a"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_POST["d2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
     if (trim($_POST["m2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
     if (trim($_POST["a2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
     if (trim($_POST["hora"]) == '') { $errorhora = 1; $hayerrores = 1; };

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

<!-- ************************ FORMULARIO PARA SELECCIONAR DOCENTE EN FORMA DIRECTA **************-->
<table border="0" width="100%">
    <tr align="right">
        <td class="titulo" align="left">Cargar Licencias</td>
        <td>                                                                     
            <form method="GET" action="licencias.php?actor=<? echo $dni; ?>" name="form20">
<!-- ************** LISTA DE DOCENTES PARA ELEGIR *********************************** -->                    
			
            Otro docente: <select style="border: 1px solid #888888; background-color: #ffffff; border-radius: 5px; padding: 4px 0 4px 0; box-shadow: 0 0 2px #555555;" size="1" name="actor">
            <option>- - - - - -</option>
            <? $listadocentes = mysql_query ("SELECT * FROM docentes WHERE identificacion = 1 ORDER BY apellido,nombre");
            
            	while ($docente = mysql_fetch_array($listadocentes)) {			
					echo "<option value='" . $docente[dni] . "'>" . $docente[apellido] . " " . $docente[nombre] . " - D.N.I. Nº " . $docente[dni] . "</option>";
				    }
		    ?>
            </select>
<!-- FIN LISTA DE DOCENTES PARA ELEGIR *********************************************** -->
            <input type="submit" value="Buscar" style="border: 1px solid #C0C0C0;  border-radius: 5px; padding: 4px 10px 4px 10px; background-color: #ffd56b; font-weight:700; font-size: 14px; box-shadow: 0 0 2px #555555;"/>
            
            <!-- input type="hidden" value=<? echo $docente[dni]; ?> -->
            <?
           // $dni2 = $docente[dni];
            ?>
            </form>
        </td>
    </tr>
</table>
<!-- ********* FIN FORMULARIO PARA SELECCIONAR DOCENTE EN FORMA DIRECTA **********************-->

<form method="POST" action="licencias.php?actor=<? echo $dni . "&ident=1"; ?>">
<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p>

<div align="left">
				
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#218ec7">&nbsp;Docente: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. Nº " . number_format($filadocente[dni],0,'','.'); ?></td>
						</tr>
						
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Motivo:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
                          <select size="1" autofocus="true" name="motivo"> <!-- ****************************LISTA MOTIVOS -->
						  <?	
                            WHILE ($myrow6 = mysql_fetch_array($resultmotivo)) {			
						    	echo "<option value=" . $myrow6[codigo] . ">" . $myrow6[descripcion] . "</option>";
						    }
						  ?>
                          </select> <!-- **********************************************************FIN LISTA MOTIVOS -->
                          
						<!-- select size="1" autofocus name="motivo">
						<?	//WHILE ($myrow6 = mysql_fetch_array($resultmotivo))
						//{			
							//if($_POST['motivo']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
							//echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion] </option>";
						//}
						?>
                          </select -->
						</td>
						<?
	  					if ($errorfecha==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha Desde:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="d" size="2" maxlength="2" value="<?echo $_POST['d']; ?>" />
							-
							<input type="text" name="m" size="2" maxlength="2" value="<?echo $_POST['m']; ?>" />
							-
							<input type="text" name="a" size="4" maxlength="4" value="<?echo $_POST['a']; ?>" /> 
							(DD-MM-AAAA)</td>
							
						</tr>
						<tr>
					
							<td width="174" bgcolor="#EAEAEA" align="right">Observaciones:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><TEXTAREA COLS=35 ROWS=5 NAME="observaciones"></TEXTAREA></td>
						
						<?
	  					if ($errorfecha2==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha Hasta:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="d2" size="2" maxlength="2" value="<?echo $_POST['d2']; ?>" />
							-
							<input type="text" name="m2" size="2" maxlength="2" value="<?echo $_POST['m2']; ?>" />
							-
							<input type="text" name="a2" size="4" maxlength="4" value="<?echo $_POST['a2']; ?>" /> 
							(DD-MM-AAAA)</td>
							
	
						</tr>
			
						<tr>
					<?
	  					if ($errorhora==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Hora:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="hora" size="10" maxlength="10" value="<?echo $_POST['hora'];?>" />(HH:MM:SS)</td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Notific&oacute;:
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><b><? echo $filausuario['apellido']  ?>&nbsp;<? echo $filausuario['nombre']  ?></b>
							</td>
						</tr>
						<!-- input type="hidden" name="identificacion" id="identificacion" value="<? //echo $identificacion;?>"/ -->

						<tr>
							<td width="876" bgcolor="#EAEAEA" align="right" colspan="4">

						<?php 
						
						while ($filarr = mysql_fetch_array($resultrr))			
						{ 

						$reso = mysql_query ("SELECT * FROM materia_cargo WHERE id=$filarr[materia]");
						$filar2 = mysql_fetch_array($reso);
						$leo = mysql_query ("SELECT * FROM caracter WHERE codigo=$filarr[sit_revista]");
						$leo2 = mysql_fetch_array($leo);

						?>

						
						<?php echo $filar2['id']?> - <?php echo $filar2['plaza']?> - <?php echo $filar2['nombre']?> - <?php echo $filar2['curso']?>°/<?php echo $filar2['division']?>° <?php echo $leo2['descripcion']?> <input name="afectado[]" type="checkbox" value="<?php echo implode('|', array($filar2['plaza'], $filarr['materia'], $filarr['sit_revista']));?>"><br>
						<? 
						
						}
						?>

                          				</td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Marque esta casilla si quiere no mostrar las observaciones</b> <input type="checkbox" name="mostrar" value="1"></td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Marque esta casilla si quiere que no salga en pizarra</b> <input type="checkbox" name="pizarra" value="1"></td>
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

	$fecha_desde=$_POST['a']."-".$_POST['m']."-".$_POST['d'];
	$fecha_hasta=$_POST['a2']."-".$_POST['m2']."-".$_POST['d2'];
	$motivo=$_POST['motivo'];
	$hora=$_POST['hora'];
	$observaciones=$_POST['observaciones'];
	$dni=$_POST['dni'];
	$now=date("Y-m-d");
	$graba=$filausuario["nombre"];
	//$identificacion=$_POST['identificacion'];
	$nomostrar=$_POST['mostrar'];
	if ($nomostrar <> 1) $nomostrar=0;
	$nopizarra=$_POST['pizarra'];
	if ($nopizarra <> 1) $nopizarra=0;
	$plaza=$_POST['plaza'];






$si=0;


 $valoresSeleccionados = $_POST['afectado'];
    foreach ($valoresSeleccionados as $valor) 
{

        $valoresIndividuales = explode('|', $valor);
        $valor1 = $valoresIndividuales[0];
        $valor2 = $valoresIndividuales[1];
		$valor3 = $valoresIndividuales[2];
	


		if (mysql_query ("INSERT INTO ausentes2 VALUES (0,'$dni','$fecha_desde','$fecha_hasta','$hora','$motivo','$graba','$observaciones','$now',1,0,$nomostrar,$nopizarra,$valor1,$valor2,$valor3)"))
			{
		mysql_query ("UPDATE alta_baja SET  activa=0, graba='$graba' where materia=$valor2 and activa=1");

			 $si=1;
			 
						
			}
										
		
	 
}

	if ($si==1)
	{
 		$si=1;
						
	
 
	?>
	<script>
	var answer=alert("Datos Grabados Correctamente ")
	</script> 
	<meta http-equiv='refresh' content='0; URL=licencias.php?actor=<? echo $dni; ?>'>

	<? }
	else {	
		?>
		<script>
		var answer=alert("No se pudo grabar en la BD")
		</script> 
		<? 
		}	
		
}
		?>
</html>
<? } ?>