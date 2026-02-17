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

if (isset($_GET['mostrar']))
{ $cursoe=$_GET['curso'];}

if (isset($_GET['mostrarcurso']))
{ $cursoe=$_GET['curso'];}

	
// Make a MySQL Connection
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("sid") or die(mysql_error());


$sql = "SELECT DISTINCT curso FROM alumnos_curso ORDER BY curso ASC";
$result = mysql_query($sql);


echo "<form method='GET' action='asis.php'>";
echo "Cursos:    ";
echo "<select name='curso'>";

while ($row = mysql_fetch_assoc($result))
{	
	if ($row['curso']==$cursoe)
	{echo "<option selected value=".$row['curso'].">".$row['curso']."</option>";}
	else
	{echo "<option value=".$row['curso'].">".$row['curso']."</option>";}	
}
echo "</select>";


echo "<input type='submit' name='mostrarcurso' value='Ver Divisiones'/>";


//echo  "<br>";
//echo  "<br>";
echo "</form>";

if (isset($_GET['mostrarcurso']))
{ echo  "<br>";
echo "<form method='GET' action='asis.php'>";
echo "Divisiones:    ";
$curso=$_GET['curso'];
//$division=$_GET['division'];
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("sid") or die(mysql_error());
$sqli = "SELECT DISTINCT division FROM alumnos_curso WHERE curso='".$curso."' AND division!='' ORDER BY division ASC";
//echo $sqli;
$resulti = mysql_query($sqli);
echo "<select name='division'>";
while ($roww = mysql_fetch_assoc($resulti))
{echo "<option value=".$roww['division'].">".$roww['division']."</option>";}
echo "</select>";
echo "<input type='hidden' name='curso' value='$curso'/>";
echo "<input type='hidden' name='materia' value='General'/>";

/*
echo  "<br>";
//echo "<input type='checkbox' name='ausentes[]' value=".$row['dni'].">";
echo "Materia:";
echo "<select name='materia'>";
echo "<option selected value='General'>General</option>";
echo "</select>";*/
echo "<input type='submit' name='mostrar' value='Ver Alumnos'/>";
echo "</form>";
}

if (isset($_GET['mostrar']))
{ 
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("sid") or die(mysql_error());
$division=$_GET['division'];
$curso=$_GET['curso'];
$materia=$_GET['materia'];
echo "<input type='hidden' name='fecha' value='$hoy'/>";
$hoy = date("d/m/y");

$sql = "SELECT DISTINCT dni,alumno FROM alumnos WHERE curso='$curso' AND division='$division' ORDER  BY alumno";
$result = mysql_query($sql);

echo  "<br>";
echo  "<br>";
echo  "<table border='1'>";
echo  "<tr>";
echo  "<th>*</th>";
echo  "<th>DNI</th>";
echo  "<th>Nombre y Apellido</th>";
echo  "<th>I</th>";
echo  "<th>J</th>";
echo  "<th>T</th>";
echo  "<th>AP</th>";
echo  "</tr>";
while ($row = mysql_fetch_assoc($result))
            {
                echo "<tr><td><input type='checkbox' name='ausentes[]' value=".$row['dni']."></td>";
				echo "<td>".$row['dni']."</td>";
                echo "<td>".$row['alumno']."</td>";
			    echo "<td><input type='radio' name='ij[".$row['dni']."]' checked='checked' value='1'></td>";
			    echo "<td><input type='radio' name='ij[".$row['dni']."]' value='0'></td>";
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='2'></td><";
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='3'></td></tr>";
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

}?>




















