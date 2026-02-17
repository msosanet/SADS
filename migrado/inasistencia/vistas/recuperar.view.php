<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>




<link rel="stylesheet" type="text/css" href="style.css" />




<link rel="stylesheet" type="text/css" href="tablacalif.css" />

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador de SID</title>



</head>
<?
include 'header.php';
require 'funciones.php';
$conexion = conectar ();
$conexioncalif = conectarcalif ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;


$anoz=$_GET[ano];
$cursoz=$_GET[curso];
$pasez=$_GET[pase];
$fechaz=$_GET[fecha];

?>

<body background="bgris.gif" >


<form method="GET" action="recuperar.php">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980">

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
<tr></tr>
<tr><td align="center"><p align="center"><h1>Alumnos con materias a recuperar (Calificacion Anual < 6 ) </h1></p></td></tr>
</table>
</div></div>

	<div align="center">
			<table border="0" width="980">				
<?
echo "<br><br>";

$result79 = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by descripcion ASC,curso ASC,division ASC");
							
			
			echo "<select name=curso>";
				while ($fila79 = mysql_fetch_array($result79))
				{ 	
					
					if (isset($_GET['curso']) && $_GET['curso']==$fila79['idcurso'])
					{echo "<option value=".$fila79['idcurso']." selected>".$fila79['descripcion']."</option>";}
					else
					{echo "<option value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>";}
					
				}	
				
			echo "</select>";

			echo "<input type='submit' value='Ver' name='submitcurso' />";
			
	
	
		echo "</table>";
	echo "</div>";
	echo "<br><br>";
	echo "<br><br>";
	
	
	if (isset($_GET[alumno]))
		{$alumno="$_GET[alumno]";}
	else
		{$alumno="a.dni";}
	
	echo "<div align='center'>";
	echo "<table border=3 id='customers'>";
		echo "<tr>";
			echo "<td align='center' bgcolor='$colorx' style='padding: 10px;' ><p><h3>DNI</h3></p></td>";
			echo "<td align='center' bgcolor='$colorx' style='padding: 10px;' ><p><h3>Alumno</h3></p></td>";
			echo "<td align='center' bgcolor='$colorx' style='padding: 10px;' ><p><h3>Materia</h3></p></td>";
			echo "<td align='center' bgcolor='$colorx' style='padding: 10px;' ><p><h3>Calif. Anual</h3></p></td>";
			
		echo "</tr>";			
			
		mysql_select_db("calificadores");
		$resultdoc = mysql_query ("SELECT * FROM calificador2 c,materias m,alumno a WHERE c.anio=YEAR(CURDATE()) AND c.idnota='9' AND c.nota<'5' AND c.nota!='0' AND c.materia=m.idmateria AND c.dni=$alumno and c.curso='$_GET[curso]' ORDER BY m.descripcion,a.apellido ASC");
			
			if (!$resultdoc) {
			die('Consulta no vÃƒÂ¡lida: ' . mysql_error());
						echo  mysql_error;}
			
			while ($filadoc = mysql_fetch_array($resultdoc))
			{$colorx = dechex(rand(124,255)) . dechex(rand(124,255)) . dechex(rand(124,255));
			
			$colormat=colores($filadoc[nota]);
			echo "<tr>";
			$nya=$filadoc[apellido]." ".$filadoc[nombre];
			echo "<td bgcolor='$colorx' style='padding: 10px;' ><p>$filadoc[dni]</p></td>";
			echo "<td bgcolor='$colorx' style='padding: 10px;' ><p><a href='vercalifalumno.php?dni=$filadoc[dni]&nombre=$nya&curso=$_GET[curso]' target='_blank' >".$nya."</a></p></td>";
			//echo "<td bgcolor='$colorx' style='padding: 10px;' ><p>$nya</p></td>";
			echo "<td bgcolor='$colorx' style='padding: 10px;' ><p>$filadoc[descripcion]</p></td>";
			echo "<td bgcolor='$colormat' style='padding: 10px;' align='center'><p>$filadoc[nota]</p></td>";
			echo "</tr>";
			}


		
?>
</form>






<?} ?>
