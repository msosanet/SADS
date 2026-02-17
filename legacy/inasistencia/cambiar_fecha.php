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

$id=$_GET['id'];


$hora=date("H:i:s");

$result = mysql_query ("SELECT * FROM mesasalidas where id=$id");
$fila = mysql_fetch_array($result); 




$errordoc = 0;
  $hayerrores = 0;


  if (!isset($_GET["submitx"])) {





}




  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos

     if (trim($_GET["d"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_GET["m"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     if (trim($_GET["a"]) == '') { $errorfecha = 1; $hayerrores = 1; };


}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="GET" action="cambiar_fecha.php?id=<?php echo $id?>">
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
					
					<p align="left" class="text1b">Cargar fecha de recepcion</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">&nbsp;&nbsp;</td>
						</tr>
						

							
						<tr>
						
						
						
							<td width="174" bgcolor="#EAEAEA" align="right">N�:<?PHP echo $fila['numero'] ?> - <?PHP echo $fila['anio'] ?></td>
							<td bgcolor="#EAEAEA" width="268" align="left"><?PHP echo $fila['asunto'] ?></td>
						<?
	  					if ($errorfecha==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha de recepcion:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="d" size="2" maxlength="2" value="<?echo $_GET['d']; ?>" autofocus/>
							-
							<input type="text" name="m" size="2" maxlength="2" value="<?echo $_GET['m']; ?>" />
							-
							<input type="text" name="a" size="4" maxlength="4" value="<?echo $_GET['a']; ?>" /> 
							(DD-MM-AAAA)</td>
							
						</tr>



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
<input name="id" type="hidden" value ="<?php echo $id;?>"/>
	</form>
</div>
</body>
<?
}
else
{


	$fecha_final=$_GET['a']."-".$_GET['m']."-".$_GET['d'];





if (mysql_query ("UPDATE mesasalidas SET volvio='$fecha_final' where id=$id"))
	{		


				
	}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=ver_nota_salida.php?'>
				<? 
					}					
	
		
				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=ver_nota_salida.php?'>
				<? 

}

?>
</html>
<? } ?>