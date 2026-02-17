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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<!-- body background="bgris.gif" >
<p -->

<!-- *************** CONEXIÓN *********************** -->
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
	if (trim($_POST["asunto"]) == '') { 
		$errorasunto = 1; $hayerrores = 1; };
	}
	else {
		$flag = 1;
}
  
if ($hayerrores OR $flag) {
?>


<!-- ********************** EMPIEZA EL FORMULARIO ******************* -->
<form method="POST" action="notificaciones.php">
</p>

<div align="center">
<table border="0" width="960" bgcolor="#F9F9F9" cellpadding="5">



	<tr>
		<td>
    
<!-- ************** INCLUYE MENU SEGÚN TIPO DE SESIÓN ***************** -->
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
    </td>

			<div align="center">
			<table border="0" width="900">

<!-- ************** INCLUYE MENÚ POSICIÓN ORIGINAL **************** -->

	
				<tr>
					<td>
						<p align="left" class="text1b">Notificaciones</p>
						<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?></p>

			<div align="left">
					
					<div align="center">
					
					<table border="0" width="70%" id="table1" cellpadding="2" cellspacing="2">

						
						<tr height="30">
						
						<?
	  					if ($errorasunto==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="20%" bgcolor="#EAEAEA" align="center"><font color="<?echo $color;?>">Descripción de<br>la notificación:</td>
							<td align="center">
								<textarea name="asunto" rows="2" cols="50" maxlength="200" value="<?echo $_POST['asunto']; ?>" /></textarea>
							</td>
							<td width="10%" bgcolor="#EAEAEA" align="center"><?echo "Año: " . date ("Y");  ?></td>	
						</tr>
						<tr height="30">
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="3">
							   <p align="center"><input type="submit" value="     Guardar     " name="submitx"><!-- style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" / --></td>
						</tr>
					</table>
					</div>
					<p align="right">&nbsp;</p>
					</div>
<!-- hr -->
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
?>

<?

	$sqlcuente="SELECT COUNT(*) as ultimo,anio FROM notificaciones WHERE anio=YEAR(NOW()) GROUP BY anio";
	$resultultimo = mysql_query ($sqlcuente);
	$filaultimo = mysql_fetch_array($resultultimo); 
	$ultimo=$filaultimo["ultimo"]+1;

	if (mysql_query ("INSERT INTO notificaciones VALUES ('','$ultimo','$asunto','$agente','$anio','')"))
	{
	?>
		<script>
			var answer=alert("Notificacion N°: <? echo $ultimo;?> / <? echo $anio;?> ")
		</script> 
		<meta http-equiv='refresh' content='0; URL=ver_notificaciones.php?descripcion=<? echo $asunto;?>&muestra2=+++Buscar+++&myTable_length=10'>
				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=notas.php?'>
				<? 
		}

	

} ?>

</html>

<? } ?>
