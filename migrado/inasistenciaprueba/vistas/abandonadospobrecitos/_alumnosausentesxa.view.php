<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>
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

echo "<form method='GET' action='alumnosausentesxf.php'>";?>


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
	<td align="right" rowspan="3" width="389" >
	<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
</tr>




<?
echo "<input type='submit' name='enviar' value='Mostrar Ausentes'/>";






if (isset($_GET['enviar']))
	

$fecha=$_GET['fecha'];
{ 	
// Make a MySQL Connection
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("sid") or die(mysql_error());


$sql = "SELECT ac.dni,ac.alumno,ac.curso,ac.division,af.tipo FROM alumnos ac,alumnos_faltas af WHERE ac.dni=af.dni AND af.fecha='$fecha' ORDER BY ac.curso,ac.division,ac.alumno";
$result = mysql_query($sql);


//$hoy = date("Y-m-d");
//echo $hoy;
echo  "<table>";
echo  "<tr>";
echo  "<th>DNI</th>";
echo  "<th>Nombre y Apellido</th>";
echo  "<th>Curso</th>";
echo  "<th>Division</th>";
echo  "<th>Materia</th>";
echo  "</tr></br>";
while ($row = mysql_fetch_assoc($result))
            {
				echo "<td width=100 align=center>".$row['dni']."</td>";
                echo "<td width=300>".$row['alumno']."</td>";
				echo "<td width=50 align=center>".$row['curso']."</td>";
				echo "<td width=50 align=center>".$row['division']."</td>";
				echo "<td width=50 align=center>".$row['tipo']."</td></tr>";


                              
            }
echo "</table>";

echo "</form>";

}}?>




















