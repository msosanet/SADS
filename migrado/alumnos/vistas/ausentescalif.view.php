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
$conexioncalif = conectarcalif ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
$resultmotivo = mysql_query ("SELECT * FROM motivo_dec"); 

$anoz=$_GET[ano];
$cursoz=$_GET[curso];
$pasez=$_GET[pase];
$fechaz=$_GET[fecha];

?>

<body background="bgris.gif" >


<form method="GET" action="filtros.php">

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


$sqlalu = "SELECT a.apellido,a.nombre,cc.descripcion,m.descripcion as materiax,a.dni,cc.curso,cc.division FROM calificador2 c,alumno a,materias m,curso2 cc WHERE c.nota1p='0' AND a.dni=c.dni AND c.materia=m.idmateria AND cc.idcurso=c.curso ORDER BY cc.idcurso,a.apellido ASC,a.nombre ASC,a.dni ASC";
//echo $sqlalu;
$resultmat = mysql_query ($sqlalu);
$cantidad=mysql_num_rows($resultmat);



?>
</table>
</div></div>

<br><br>
<div align="center">
<h1>Alumnos Ausentes en Calificadores</h1>
<h1><?echo $cantidad;?></h1>		
</div>				
<br><br>				
<table border="2" width="895" id="table1" cellpadding="0" cellspacing="4">
	<tr>
		<td width="250" bgcolor="#EAEAEA" align="center">Alumno</td>
		<td width="100" bgcolor="#EAEAEA" align="center">Curso</td>
		<td width="200" bgcolor="#EAEAEA" align="center">Materia</td>
		
	</tr>

<? 

while ($mat = mysql_fetch_array($resultmat))
{

//alumno.php?dni=
//veo_cursos.php?curso=1&div=1&muestra2=+++Buscar+++
?>
	<tr>
		<td width="250" bgcolor="" align="center"><a href="alumno.php?dni=<?echo $mat[dni];?> " target="_blank" ><?echo $mat[apellido].",".$mat[nombre];?></a></td>
		<td width="100" bgcolor="" align="center"><a href="veo_cursos.php?curso=<?echo $mat[curso];?>&div=<?echo $mat[division];?>&muestra2=+++Buscar+++" target="_blank" ><?echo $mat[descripcion];?></td>
		<td width="200" bgcolor="" align="center"><?echo $mat[materiax];?></td>
	</tr>

<?} ?>


</table>




<?} ?>
