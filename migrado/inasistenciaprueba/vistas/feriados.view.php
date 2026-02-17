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
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>
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


<?PHP

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
	
// Make a MySQL Connection
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("sid") or die(mysql_error());


$sql = "SELECT DISTINCT curso FROM alumnos_curso ORDER BY curso";
$result = mysql_query($sql);


echo "<form method='GET' action='feriados.php'>";



?>
<table>
<tr>
<td align="right" width="36%">Fecha del Parte:</td>
	<td align="right">&nbsp;<input type="text" name="fecha" id="fecha" value="<?echo $_GET["fecha"]?>" maxlength="16"/>
    <img src="calendario.png" width="16" height="16" border="0" title="Fecha" id="fecha"></td>
	<!-- script que define y configura el calendario-->
		<script type="text/javascript"> 
			Calendar.setup({ 
			inputField:"fecha",       // id del campo de texto 
			ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
			button:"fechas"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
			}); 
		</script>
</tr>
<tr>
	<td align="right" >Descripcion</td>
	<td align="right" ><input type="text" name="descripcion" id="descripcion" value="" maxlength="100"/></td>
</tr>
</table>
<?
echo "<input type='submit' name='agregar' value='Agregar Feriado'/>";
echo "</form>";




if (isset($_GET['agregar']))
{ 
//$hoy = date("Y-m-d");
//$hoy = date('Y-m-d', strtotime($hoy));
$hoy=$_GET['fecha'];
$descripcion=$_GET['descripcion'];
$sql = "INSERT INTO feriados VALUES ('$hoy','$descripcion')";

if (mysql_query($sql));
{
?>
<script>var answer=alert("Datos Guardados")</script> 
<?
}



}}?>




















