<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
include 'conexioncalif.php';
?>
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

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador de Alumnos</title>



</head>
<?
include 'header.php';
$conexion = conectar ();
$conexioncalif = conectarcalif ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
$resultmotivo = mysql_query ("SELECT * FROM motivo_dec"); 



?>

<body background="bgris.gif" >


<form method="GET" action="docfal.php">

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
if ($_SESSION['valor']==4) 
{		
include 'menuppal4.php';
}

mysqli_select_db($conexioncalif,"calificadores");
$resulfaltan = mysql_query ("SELECT DISTINCT iddocente FROM matcur WHERE iddocente NOT IN (SELECT docente FROM calificador2) AND iddocente!='0'");


?>
<br><br>
<tr><td><h2><p align="left">Docentes que no han completado los calificadores</p></h2></td></tr>
</table>
</div></div>
				
<?

while ($faltan = mysql_fetch_array($resulfaltan))
{
//echo "SELECT * FROM docente WHERE dni='$faltan[iddocente]'"; 
$resuldoc = mysql_query ("SELECT * FROM docente WHERE dni='$faltan[iddocente]'");

echo "<tr>";
//echo "<td>";
while ($apno = mysql_fetch_array($resuldoc))
{
	echo "<td><h3>Docente: ".$faltan[iddocente]." - ".$apno[apellido].",".$apno[nombre]."</h3>"; 
	$consulta="SELECT m.descripcion as materia,c.descripcion as curso FROM matcur mc, materias m,curso2 c WHERE mc.iddocente='$faltan[iddocente]' AND mc.idmateria=m.idmateria AND c.idcurso=mc.idcurso";
	//echo $consulta;
	$resulmat = mysql_query ($consulta);
	while ($matt = mysql_fetch_array($resulmat))
	{echo "<br>"; 
	echo "<h3>Curso: </h3>".$matt['curso']."<h3> Materia: </h3>".$matt['materia'];
	
	}
	echo "</td>";
}
//echo "</td>";
echo "</tr>";
}

 ?>				










<?} ?>