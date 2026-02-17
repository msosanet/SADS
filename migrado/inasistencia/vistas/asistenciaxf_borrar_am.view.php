<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
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
<body >

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


<div style="max-width:980px;align:center" >

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
</div>
<?

// Make a MySQL Connection
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("base_sobral") or die(mysql_error());

$sql = "SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC";
$result = mysql_query($sql);


echo "<form method='GET' action='" . $_SERVER['PHP_SELF'] . "'>";

echo "<select name='curso'>";
while ($row = mysql_fetch_assoc($result))
{{ if ($row['curso']!='')
	echo "<option value=".$row['idcurso'].">".$row['descripcion']."</option>";
 }}
echo "</select>";

/*$sql = "SELECT DISTINCT division FROM alumnos_curso WHERE division!='' ORDER BY division ASC";
$result = mysql_query($sql);
echo "<select name='division'>";
while ($row = mysql_fetch_assoc($result))
{ if ($row['division']!='')
     { echo "<option value=".$row['division'].">".$row['division']."</option>";}
}
echo "</select>";*/


?>

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
<?
echo "<input type='submit' name='mostrar' value='Mostrar Alumnos'/>";




if (isset($_GET['mostrar']))
{
$fecha=$_GET['fecha'];
$curso=substr($_GET['curso'], 0,1);
$division=substr($_GET['curso'], 1);
/*$curso=$_GET['curso'];
$division=$_GET['division'];*/
//$hoy = date("d/m/y");
echo "<input type='hidden' name='fecha' value='$fecha'/>";
//echo "<input type='checkbox' name='ausentes[]' value=".$row['dni'].">";

echo "<select name='materia'>";
echo "<option value='General'>General</option>";
echo "<option selected value='EF'>Educacion Fisica</option>";
echo "</select>";
echo $fecha;



$ano=date("Y");


$sql= "SELECT a.dni,CONCAT(a.apellido,  ' ', a.nombre) as alumno FROM alumno a, cursa c WHERE c.control='1' AND c.anio='$ano' AND c.control='1' AND c.curso='$curso' AND c.divi='$division' AND c.anio='$ano' AND c.alumno=a.dni ORDER by alumno";
//$sql = "SELECT DISTINCT dni,alumno FROM alumnos WHERE (curso1='$curso' OR curso='$curso') AND (division='$division' OR division1='$division')";
$result = mysql_query($sql);

echo  "<br>";
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
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='2'></td>";
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='3'></td></tr>";

            }
echo "</table>";
echo "<input type='submit' name='enviar' value='Guardar Faltas'/>";
}



if (isset($_GET['enviar']))
{
//$hoy = date("Y-m-d");
//$hoy = date('Y-m-d', strtotime($hoy));
$hoy=$_GET['fecha'];
$materia=$_GET['materia'];
foreach ($_GET['ausentes'] as $checkbox)
{$injus=$_GET['ij'][$checkbox];
$sql = "INSERT INTO alumnos_faltas VALUES ('$checkbox','$hoy','$materia','$injus')";
//echo $sql;
mysql_query($sql);
}?>
<script>var answer=alert("Datos Guardados")</script>
<?
}

echo "</form>";

}?>

