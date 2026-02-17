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
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<title>SID</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
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
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$dni=$_GET['actor'];
$identificacion=$_GET['ident'];


$hora=date("H:i:s");



$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 


$result = mysql_query ("SELECT * FROM declaracionj WHERE tramite=$dni");
$fila = mysql_fetch_array($result); 

$result3 = mysql_query ("SELECT * FROM docentes where dni=$fila[docente]");
$fila3 = mysql_fetch_array($result3);

$resultmotivo = mysql_query ("SELECT * FROM motivo_dec order by codigo"); 


$errordoc = 0;
  $hayerrores = 0;


  if (!isset($_POST["submitx"])) {

$_POST['anio']=date("Y");
$_POST['d']=date("d");
$_POST['m']=date("m");
$_POST['a']=date("Y");



}




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

<form method="POST" action="mover_ddjj.php?actor=<?php echo $dni?>">
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
					<br>
					<p align="left" class="text1b">Modificar Declaraciones Juradas</p><br>
					<p align="left" class="text1b">Tramite N� <?php echo $dni ?> </p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">&nbsp;&nbsp;</td>
						</tr>
						
						<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Docente:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><? echo $fila3['apellido'];  ?>, <? echo $fila3['nombre'];  ?>

							</td>
							

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Estado:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">	<select size="1" name="estado">
							<?	WHILE ($myrow7 = mysql_fetch_array($resultmotivo))
							{			
								if($fila[estado]==$myrow7[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
								echo "<option value=$myrow7[codigo] $seleccionado> $myrow7[descripcion] </option>";
							}
							?></select>

							</td>
							
						</tr>
						
						<tr>

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha del tramite:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<? echo $fila['fechacarga'] ?>
							</td>
							<td width="190" bgcolor="#EAEAEA" align="right">Modifica:
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><b><? echo $filausuario['apellido']  ?>&nbsp;<? echo $filausuario['nombre']  ?></b>
							</td>

						</tr>

						<tr>
					
							<td width="174" bgcolor="#EAEAEA" align="right">Observaciones:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><TEXTAREA COLS=35 ROWS=5 NAME="observaciones"><? echo $fila['observaciones'] ?></TEXTAREA></td>
						

							

							<td width="174" bgcolor="#EAEAEA" align="right"></td>
							<td bgcolor="#EAEAEA" width="268" align="left"></td>
							
	
						</tr>
			
						
						<input type="hidden" name="identificacion" id="identificacion" value="<? echo $identificacion;?>"/>


							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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
<input name="dni" type="hidden" value ="<?php echo $dni ?>"/>
	</form>
</div>
</body>
<?
}
else
{


	$observaciones=$_POST['observaciones'];
	$now=date("Y-m-d");
	$graba=$filausuario["nombre"];
	$estado=$_POST['estado'];



if (mysql_query ("UPDATE declaracionj SET observaciones='$observaciones', estado=$estado, fechaestado='$now' where tramite='$dni' "))
	{		
 
				
	}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
				}					
	
				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=buscar_dj.php?'>
				<? 

}

?>
</html>
<? } ?>