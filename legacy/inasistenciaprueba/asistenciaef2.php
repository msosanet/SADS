<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion3.php';
$conexion = conectar ();

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
mysql_select_db("base_sobral") or die(mysql_error());


$sql = "SELECT * FROM curso2 ORDER BY descripcion ASC";
$result = mysql_query($sql);

echo "<br>";
echo "<br>";
echo "<br>";
$cursox=$_GET['curso'];
//echo $cursox;
echo "<form method='GET' action='asistenciaef2.php'>";
echo "<table border='0' align='center' width='980' bgcolor='#FFFFFF'>";
echo "<tr><td bgcolor='#EAEAEA' align='center'>Curso:</td>";
echo "<td bgcolor='#EAEAEA' align='center'><select name='curso'>";
while ($row = mysql_fetch_assoc($result))
{ if ($row['idcurso']==$cursox)
	{echo "<option selected value=".$row['idcurso'].">".$row['descripcion']."</option>";}
  else
	{echo "<option value=".$row['idcurso'].">".$row['descripcion']."</option>";}
 }
 
echo "</select></td>";
echo "</td></tr>";
echo "<tr>";
$burbu=$_GET['burbuja'];
echo "<td bgcolor='#EAEAEA' align='center'>Burbuja:</td>";
echo "<td bgcolor='#EAEAEA' align='center'><select name='burbuja'>";
if ($burbu=='')
{echo "<option selected value='1'>Burbuja 1</option>";
echo "<option value='2'>Burbuja 2</option>";}

if ($burbu==1)
{echo "<option selected value='1'>Burbuja 1</option>";
echo "<option value='2'>Burbuja 2</option>";}
if ($burbu==2)
{echo "<option value='1'>Burbuja 1</option>";
echo "<option selected value='2'>Burbuja 2</option>";}
echo "</select>";
echo "</td>";
//$diahoy=date("d-m-Y");
//echo $diahoy;
echo "<tr>";
echo "<td bgcolor='#EAEAEA' align='center'>Fecha Parte:</td>";
//echo "<td bgcolor='#EAEAEA' align='center'><input type='date' name='fecha' value='$diahoy' ></td></tr>";
?>
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


echo "</table>";


echo "<input type='submit' name='mostrar' value='Mostrar Alumnos'/>";


echo  "<br>";
echo  "<br>";

if (isset($_GET['mostrar']))
{ 
$i=0;
$cursox=$_GET['curso'];
$burbuja=$_GET['burbuja'];
//echo $burbuja;
//$division=$_GET['division'];
$curso=substr($_GET['curso'], 0,1);
$division=substr($_GET['curso'], 1);


$hoy = date("d/m/y");
echo "<input type='hidden' name='fecha' value='$hoy'/>";
//echo "<input type='checkbox' name='ausentes[]' value=".$row['dni'].">";



$ano=date("Y");


$sql= "SELECT a.dni,CONCAT(a.apellido,  ' ', a.nombre) as alumno FROM alumno a, cursa c,alumno_burbuja ab WHERE ab.dni=a.dni AND ab.burbuja='$burbuja' AND c.control='1' AND c.curso='$curso' AND c.divi='$division' AND c.anio='$ano' AND c.alumno=a.dni ORDER by alumno";
//$sql = "SELECT DISTINCT dni,alumno FROM alumnos WHERE (curso1='$curso' OR curso='$curso') AND (division='$division' OR division1='$division') ORDER  BY alumno";
//echo $sql;
$result = mysql_query($sql);

echo  "<br>";
echo  "<br>";
echo  "<table border='1'>";
echo  "<tr>";
echo  "<th>DNI</th>";
echo  "<th>Nombre y Apellido</th>";
echo  "<th>P</th>";
echo  "<th>A</th>";
echo  "<th>T</th>";
echo  "<th>TT</th>";
echo  "<th>AP</th>";
echo  "<th>Injustificada</th>";
echo  "</tr>";
while ($row = mysql_fetch_assoc($result))
            {
                echo "<td>".$row['dni']."</td>";
                echo "<td>".$row['alumno']."</td>";
			    echo "<td><input type='radio' name='ij[".$row['dni']."]' checked='checked' value='1'></td>";
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='0'></td>";
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='2'></td>";
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='4'></td>";
				echo "<td><input type='radio' name='ij[".$row['dni']."]' value='3'></td>";
				echo "<td align='center'><input  type='checkbox' name='just[".$row['dni']."]' value='1'></td></tr>";
              //  $dnix==$row['dni'];
				//echo $dnix;
				//echo $row['dni'];
            echo "<input type='hidden' name='ausente[]' value='$row[dni]'/>";
			$i++;
			}
echo "</table>";
echo  "<br>";
echo  "<br>";
echo "<input type='submit' name='enviar' value='Guardar Faltas'/>";
echo "</form>";
}



if (isset($_GET['enviar']))
{ 
//echo "hola";
//$hoy = date("Y-m-d");
$hoy = date('Y-m-d', strtotime($_GET['fecha']));
$materia=$_GET['materia'];
	
	foreach ($_GET['ausente'] as $_key => $valor) 
	{
		//echo $_GET['ij'][$valor];
		$falta=$_GET['ij'][$valor];
		$injus=$_GET['just'][$valor];
		if ($injus!='1'){$injus='0';}

	$sql = "INSERT INTO alumnos_faltas2 VALUES ('$valor','$hoy','EF','$falta','$injus')";
	//echo $sql;
	//echo  "<br>";
	mysql_query($sql);
	//echo $injus;
	//echo $checkbox;
	}

}



}



?>



















