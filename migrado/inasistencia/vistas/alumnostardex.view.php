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
	
// Make a MySQL Connection
mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("sid") or die(mysql_error());
$fecha = date("Y-m-d");

echo "<form method='GET' action='alumnostarde.php'>";
/*
<tr>
	<td align="right" width="36%">Fecha del Parte:</td>
	<td align="right">&nbsp;<input type="text" name="fecha" id="fecha" value="<?echo $fecha?>" maxlength="16"/>
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

*/

/*if (isset($_GET['ausentes']))
{$fecha=$_GET['fecha'];

}*/


$sql = "SELECT DISTINCT ac.dni,ac.alumno,ac.curso,ac.division,af.tipo,af.injus FROM alumnos ac,alumnos_faltas af WHERE ac.dni=af.dni AND af.fecha='$fecha' ORDER BY ac.alumno,ac.curso,ac.division";
$result = mysql_query($sql);

echo  "<table border='1'>";
echo  "<tr>";
echo  "<th>DNI</th>";
echo  "<th>Nombre y Apellido</th>";
echo  "<th>Curso</th>";
echo  "<th>Division</th>";
echo  "<th>Materia</th>";
echo  "<th>Tipo</th>";
echo  "<th>Borrar</th>";
echo  "<th>Tarde</th>";
echo  "</tr></br>";

echo "<input type='hidden' name='fecha' value='".$fecha."'/>";

while ($row = mysql_fetch_assoc($result))
            {
				if ($row['injus']==1)
				{$injus='I';}
				if ($row['injus']==0)
				{$injus='J';}
				if ($row['injus']==2)
				{$injus='T';}
			
				echo "<td width=100 align=center>".$row['dni']."</td>";
                echo "<td width=300>".$row['alumno']."</td>";
				echo "<td width=50 align=center>".$row['curso']."</td>";
				echo "<td width=50 align=center>".$row['division']."</td>";
				echo "<td width=50 align=center>".$row['tipo']."</td>";
				echo "<td width=50 align=center>".$injus."</td>";
				echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='B'></td>";
			    echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='T'></td></tr>";
				echo "<input type='hidden' name='d[".$row['dni']."]' value='".$row['dni']."'/>";
				echo "<input type='hidden' name='tipo[".$row['dni']."]' value='".$row['tipo']."'/>";
				echo "<input type='hidden' name='i[".$row['dni']."]' value='".$row['injus']."'/>";
                              
            }
echo "</table>";
echo  "</br></br>";
echo  "</br></br>";
echo "<input type='submit' name='actualizar' value='Actualizar Seleccionados'/>";

echo "</form>";

if (isset($_GET['actualizar']))
{

foreach ($_GET['d'] as $d) 
{$rb=$_GET['t'][$d];
 $tpo=$_GET['tipo'][$d];
 $ij=$_GET['i'][$d];
 $fec=$_GET['fecha'];
 echo "$ij";
 /*echo "$rb";
 echo "$tpo";*/

	
		if ($rb=='T')
		{$sql = "UPDATE alumnos_faltas SET injus='2' WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'" ;
         //echo $sql;
		 $result = mysql_query($sql);
		 
		 }
		if ($rb=='B')
		{$sql = "DELETE FROM alumnos_faltas WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'";
         $result = mysql_query($sql);
		 }
	
}
	?>
				<script>
				var answer=alert("Se han modificado los registros seleccionados")
				</script> 
				<meta http-equiv='refresh' content='0; URL=http://inasistencias.colegiosobral.edu.ar/alumnostarde.php'>
	<?
//<meta http-equiv='refresh' content='0; URL=http://inasistencias.colegiosobral.edu.ar/alumnostarde.php'>
	}






}?>





















