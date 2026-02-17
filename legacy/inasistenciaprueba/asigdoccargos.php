<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion3.php';

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




$hora=date("H:i:s");




$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente); 

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 


$resultmotivo = mysql_query ("SELECT * FROM materia order by nombre"); 


$resultcaracter = mysql_query ("SELECT * FROM caracter order by descripcion"); 



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


            
       


<form method="POST" action="asigdoccargos.php?curso=<? echo $curso . "&ident=1"; ?>&dni=<? echo $dni; ?>">
<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p>

<div align="left">
				
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Docente: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. N� " . number_format($filadocente[dni],0,'','.'); ?>&nbsp; - Curso: <b><?echo $cursi['descripcion'] ?></b></td>
						</tr>
						
						<tr>
						
						
						
						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Esp. Curricular:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
                          <select size="1" autofocus="true" name="motivo"> <!-- ****************************LISTA MOTIVOS -->
						  <?	
                            WHILE ($myrow6 = mysql_fetch_array($resultmotivo)) {			
						    	echo "<option value=" . $myrow6[codigo] . ">" . $myrow6[nombre] ." - ". $myrow6[sige] . "</option>";





						    }
						  ?>
                          </select> <!-- **********************************************************FIN LISTA MOTIVOS -->
                          
						
						</td>
						<?
	  					if ($errorfecha==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha Desde:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="d" size="2" maxlength="2" value="00" />
							-
							<input type="text" name="m" size="2" maxlength="2" value="00" />
							-
							<input type="text" name="a" size="4" maxlength="4" value="0000" /> 
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

							<input type="text" name="d2" size="2" maxlength="2" value="00" />
							-
							<input type="text" name="m2" size="2" maxlength="2" value="00" />
							-
							<input type="text" name="a2" size="4" maxlength="4" value="0000" /> 
							(DD-MM-AAAA)</td>
							
	
						</tr>
						<tr>


						<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">N� Plaza:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
                         			<input type="text" name="plaza" size="10" maxlength="10" value="" />
                          
						
						</td>							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Fecha de Inicio:
							</td></font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="di" size="2" maxlength="2" value="00" />
							-
							<input type="text" name="mi" size="2" maxlength="2" value="00" />
							-
							<input type="text" name="ai" size="4" maxlength="4" value="0000" /> 
							(DD-MM-AAAA)</td>

						</tr>
			
						<tr>


											  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Caracter:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">
                          
                          <select size="1" autofocus="true" name="caracter"> <!-- ****************************LISTA MOTIVOS -->
						  <?	
                            WHILE ($myrowc = mysql_fetch_array($resultcaracter)) {			
						    	echo "<option value=" . $myrowc[codigo] . ">" . $myrowc[descripcion] . "</option>";
						    }
						  ?>
                          </select> <!-- **********************************************************FIN LISTA MOTIVOS -->
                          
						
						</td>							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Carg&oacute;:
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><b><? echo $filausuario['apellido']  ?>&nbsp;<? echo $filausuario['nombre']  ?></b>
							</td>
						</tr>
						<!-- input type="hidden" name="identificacion" id="identificacion" value="<? //echo $identificacion;?>"/ -->

						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"></td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Esta el movimiento enviado?</b> <input type="checkbox" name="enviado" value="1"></td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Esp. curricular en Lic.</b> <input type="checkbox" name="lic" value="1"></td>
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
	$enviado=0;
	$lic=0;
	$fecha_desde=$_POST['a']."-".$_POST['m']."-".$_POST['d'];
	$fecha_hasta=$_POST['a2']."-".$_POST['m2']."-".$_POST['d2'];
	$fecha_inicio=$_POST['ai']."-".$_POST['mi']."-".$_POST['di'];
	$materia=$_POST['motivo'];
	$curso=$_GET['curso'];
	$observaciones=$_POST['observaciones'];
	$caracter=$_POST['caracter'];
	$dni=$_POST['dni'];
	$graba=$filausuario["nombre"]."-".date("Y-m-d");
	$enviado=$_POST['enviado'];
	$lic=$_POST['lic'];
	$plaza=$_POST['plaza'];

	
	if ($lic =="") $lic=0;
	
	if ($enviado =="") $enviado=0;
	

	printf($lic."-".$enviado);


if (mysql_query ("INSERT INTO matcurfran VALUES (0,$curso,$materia,$dni,'$fecha_desde','$fecha_hasta',$caracter,'$observaciones',$lic,$enviado,'$plaza','$fecha_inicio','$graba')"))
	{		

?>
				<script>
				var answer=alert("Datos Grabados Correctamente ")
				</script> 
				<meta http-equiv='refresh' content='0; URL=asigdoccargos.php?curso=<?php echo $curso ?>&dni=<? echo $dni; ?>'>
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