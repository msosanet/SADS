<?PHP
session_start();
//if ($_SESSION['estado']==1) { 

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

$con = conectar ();





$curso = $_GET['curso'];

echo "<form method='GET' action='horarios.php'>";

$sql = "SELECT DISTINCT curso,id FROM cur ORDER BY curso DESC";
$result = mysql_query($sql);

//CARGO EL COMBO CON LOS CURSOS
echo "Curso: ";
echo "<select name='curso'>";
while ($row = mysql_fetch_assoc($result))
{
echo "<option value=".$row['id'].">".$row['curso']."</option>";

}
echo "</select>";
//---------------------------------------------------------

echo "<input type='submit' name='mostrar' value='Ver Horario Curso'/>";

if (isset($_GET['mostrar']))
{ 
$curso = $_GET['curso'];
$idcur = $_GET['id'];
echo $curso;
echo $idcur;

$semana = array(
      "Lunes",
      "Martes",
      "Miercoles",
      "Jueves",
	  "Viernes",
	  "Sabado"
);
 
$sql = "SELECT m.descripcion FROM materia m, cur c WHERE m.curso=c.curso AND c.id=".$idcur." ORDER BY descripcion";
$result = mysql_query($sql);

echo "<table><tr>";
foreach ($semana as $dia)
{
echo "<td>$dia</td>";

echo "<select name='materia'>";
while ($row = mysql_fetch_assoc($result))
{	echo "<tr>";
	echo "<td><option value=".$row['descripcion'].">".$row['descripcion']."</option><td>";
	echo "</tr>";	
}
echo "</select>";

}
echo "</tr></table>";




}




echo "</form>";














//
?>
