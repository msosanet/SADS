<?PHP
include 'conecta2.php';

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
<html>

<head>

<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<!-- script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico" -->

<title>NORMATIVA</title>

<!-- script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script --> 

</head>

<!-- ?
include 'header.php';
? -->
<body>

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

<form method="POST" action="agrega_tipo_norma.php" name="form1">
<table border="1" width="500" bgcolor="#FFDD88" cellspacing="0">
	<tr align="center">
		<td height="40" colspan="2">
			<p>AGREGAR TIPO DE NORMA</p>
		</td>
	<tr align="center" bgcolor="#EAEAEA" height="40">
		<td width="50%">Nuevo tipo de norma:</td>
		<td width="50%"><input type="text" name="tipo" size="50" maxlength="50" value="<? echo $_POST['tipo']; ?>" /></td>
	</tr>
	<tr align="center" bgcolor="#EAEAEA" height="40">
		<td colspan="2">
			<p><input type="submit" value="     Grabar     " name="submitx" /></td>
	</tr>
</table>

<!-- ?
	include 'footer.php';
? -->

<?
$tipo = $_POST['tipo'];
mysql_query ("SELECT * FROM `tiponorma`");
mysql_query ("INSERT INTO `tiponorma` (`id`,`tipo`) VALUES (NULL,'$tipo')");
?>
<script>
	var answer=alert("Datos Grabados Correctamente")
</script> 
<!-- meta http-equiv='refresh' content='0; URL=agrega_tipo_norma.php?' -->

</form>
</body>
</html>
