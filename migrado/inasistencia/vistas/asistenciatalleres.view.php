<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="tablacalif.css" />

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


<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>


<div align="center">
			<table border="0" width="980">

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>	


			</table>
			</div>
		</td>
		</tr>
	</table>
</div>
<?

// Make a MySQL Connection
mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("base_sobral") or die(mysql_error());


$sql = "SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC";
$result = mysql_query($sql);


echo "<form method='GET' action='asistenciatalleres.php'>";

echo "<select name='curso'>";
while ($row = mysql_fetch_assoc($result))
{{ if ($row['curso']!='')
	echo "<option value=".$row['idcurso'].">".$row['descripcion']."</option>";
 }}
echo "</select>";





echo "<input type='submit' name='mostrar' value='Mostrar Alumnos'/>";


echo  "<br>";
echo  "<br>";

if (isset($_GET['mostrar']))
{ 

//$curso=$_GET['curso'];
//$division=$_GET['division'];
$curso=substr($_GET['curso'], 0,1);
$division=substr($_GET['curso'], 1);
$hoy = date("d/m/y");
echo "<input type='hidden' name='fecha' value='$hoy'/>";
//echo "<input type='checkbox' name='ausentes[]' value=".$row['dni'].">";
echo "Materia:";
echo "<select name='materia'>";
//echo "<option selected value='General'>General</option>";
echo "<option selected value='TEDI'>Taller EDI</option>";
echo "</select>";



$ano = $_SESSION['cicloLectivo'];
$sql = "SELECT a.dni,CONCAT(a.apellido,  ' ', a.nombre) as alumno FROM alumno a, cursa c WHERE c.control='1' AND c.anio='$ano' AND c.control='1' AND c.curso='$curso' AND c.divi='$division' AND c.anio='$ano' AND c.alumno=a.dni ORDER by alumno";
$result = mysql_query($sql);

echo  "<br>";
echo  "<br>";
echo  "<table border='1' id='customers' style='width: 50%;'>";
echo  "<tr>";
echo  "<th>*</th>";
echo  "<th>DNI</th>";
echo  "<th>Nombre y Apellido</th>";
echo  "<th>I</th>";
echo  "<th>J</th>";
echo  "<th>T</th>";
echo  "<th>TT</th>";
echo  "<th>AP</th>";
echo  "<th>Pend.*</th>";
echo  "</tr>";
while ($row = mysql_fetch_assoc($result))
            {
                echo "<tr><td><input type='checkbox' name='ausentes[]' value=".$row['dni']."></td>";
				echo "<td>".$row['dni']."</td>";
                echo "<td>".$row['alumno']."</td>";
			    echo "<td><input type='radio' name='ij[".$row['dni']."]' checked='checked' value='1'></td>";
			    echo "<td><input type='radio' name='ij[".$row['dni']."]' value='0'></td>";
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='2'></td>";
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='4'></td>";
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='3'></td>";
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='5'></td></tr>";
                              //grade['.$row['id'].']
            }
echo "</table>";
echo  "<br>";
echo  "<br>";
echo "<input type='submit' name='enviar' value='Guardar Faltas'/>";
}



if (isset($_GET['enviar']))
{ 
$hoy = date("Y-m-d");
$hoy = date('Y-m-d', strtotime($hoy));
$materia=$_GET['materia'];
foreach ($_GET['ausentes'] as $checkbox) 
{
//echo $_GET['ij[$checkbox]'];
$injus=$_GET['ij'][$checkbox];
$sql = "INSERT INTO alumnos_faltas VALUES ('$checkbox','$hoy','$materia','$injus')";
//echo $sql;
mysql_query($sql);
//echo $injus;
//echo $checkbox;
}?>
<script>var answer=alert("Datos Guardados")</script> 
<?
}

echo "</form>";
//echo "<!-- " . var_export($GLOBALS,true) . "-->";
}?>





















