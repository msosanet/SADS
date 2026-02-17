<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

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




$errordoc = 0;
$hayerrores = 0;
$anio= date("Y");

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario); 

  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos

     if (trim($_POST["asunto"]) == '') { $errorasunto = 1; $hayerrores = 1; };



}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="notas.php">
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
if ($_SESSION['valor']==4) 
{		
include 'menuppal4.php';
}
?>	
				<tr>
				

					<td>
					
					<p align="left" class="text1b">Notas</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="70%" id="table1" cellpadding="2" cellspacing="4">

						
						<tr height="30">
						
						<?
	  					if ($errorasunto==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="20%" bgcolor="#EAEAEA" align="center"><font color="<?echo $color;?>">Descripci�n de la Nota:</td>
							<td bgcolor="#EAEAEA" align="center">
								<textarea name="asunto" rows="5" cols="50" maxlength="500" value="<?echo $_POST['asunto']; ?>" /></textarea>
							   <!-- input type="text" name="asunto" size="100" maxlength="500" value="<?echo $_POST['asunto']; ?>" / --></td>
							<!-- td bgcolor="#EAEAEA" align="center"><font color="<?echo $color;?>">A�o:</td -->
							<td bgcolor="#EAEAEA" width="10%" align="center"><?echo "A�o: " . date ("Y");  ?></td>	
							<td bgcolor="#EAEAEA" align="center"><font color="<?echo $color;?>">GEN:</td>
							<td bgcolor="#EAEAEA" width="10%" align="center"><input type="text" name="gen" size="15" maxlength="15" /></td>												</tr>
						<tr height="30">
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="5">
							   <p align="center"><input type="submit" value="     Guardar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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

	</form>
</div>
</body>
<?
}
else
{
	$asunto=ucfirst($_POST['asunto']);
	$agente=$filausuario["nombre"];
	$gen=$_POST['gen'];
	$now=date("Y-m-d");
	
	$sqlcuente="SELECT COUNT(*) as ultimo,anio FROM notasnuevo WHERE anio=YEAR(NOW()) GROUP BY anio";
	$resultultimo = mysql_query ($sqlcuente);
	$filaultimo = mysql_fetch_array($resultultimo); 
	$ultimo=$filaultimo["ultimo"]+1;

if (mysql_query ("INSERT INTO notasnuevo VALUES (0,'$ultimo','$asunto','$agente','$anio','$now','$gen','')"))

{
/*$resultnotas = mysql_query ("select * from notas order by codigo desc limit 1");
$filanotas = mysql_fetch_array($resultnotas); */



?>
				<script>
				var answer=alert("Nota:<? echo $ultimo;?> ")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD, no se permiten apostrofes")
				</script> 
				<meta http-equiv='refresh' content='0; URL=notas.php?'>
				<? 
		}





}






?>
</html>
<? } ?>
