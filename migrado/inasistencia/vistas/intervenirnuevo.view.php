<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Administrador del SID</title>



</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;






?>

<body>

<div id="menu">

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
if ($_SESSION['valor']==4) include 'menuppal4.php';

?>
	<br><br>
	<h2>Estudiantes que fueron derivados para su intervenci&oacute;n</h2>
	<br><br>

<?PHP

	//$_pagi_sql="SELECT a.dni,a.alumno,COUNT(d.id) as Cantidad FROM derivacion d, alumnos a WHERE a.dni=d.alumno GROUP BY a.dni ORDER BY Cantidad desc";
	$q_derivados = "SELECT CONCAT(apellido,' ',nombre) AS estudiante,derint.* FROM alumno RIGHT JOIN (SELECT numder.*,COALESCE(numint.intervenciones,0) AS ints FROM (SELECT alumno,COUNT(id) AS derivaciones FROM `derivacion` GROUP BY alumno) AS numder LEFT JOIN (SELECT alumno,COUNT(codigo) AS intervenciones FROM `intervencion` WHERE mostrar != 0 GROUP BY alumno) AS numint ON numder.alumno = numint.alumno) AS derint ON derint.alumno = alumno.dni ";
	$derivados = mysql_query($q_derivados);
?>

<table id="table1" style="border: 1px solid gray">
	<tr>
		<th>DNI</th>
		<th>Alumno</th>
		<th>Nro. de Derivaciones</th>
		<th>Nro. de Intervenciones</th>
		<th>Ver Derivaciones</th>
	</tr>

<?php while ($fila2 = mysql_fetch_array($derivados))
	{
	?>

		<tr>
			<td style="border: 1px solid gray"><?echo $fila2['alumno'];?></td>
			<td style="border: 1px solid gray"><?echo $fila2['estudiante'];?></td>
			<td style="text-align:center;border:1px solid gray"><?echo $fila2['derivaciones'];?></td>
			<td style="text-align:center;border:1px solid gray"><?echo $fila2['ints'];?></td>
			<td style="text-align:center;border:1px solid gray" ><a href="intervenir.php?alumno=<?=$fila2['alumno']?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Derivar"></a></td>




		</tr>
		<?
		}
		?>
</table>
</div>
			<?
			include 'footer.php';
			?>

<? } ?>

