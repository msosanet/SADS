<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Administrador del SID</title>

<style>
th,td {
	text-align: center;
}
th,td #nombre {
	width: 30%;
}
th,td #nDoc {
	width: 10px;
}

</style>


</head>
<?
include 'header.php';
$conexion = conectar();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;

$descripcion = (isset($_GET['descripcion'])) ? $_GET['descripcion'] : "";




?>

<body>



<div id="menu">


<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
if ($_SESSION['valor']==4) include 'menuppal4.php';

?>

	<form method="GET" action="<?=$_SERVER['PHP_SELF']?>">
		<table>
			<tr>
			<td colspan=4 style="text-align:left;font-weight: bold">Consultar alumnos por nombre y apellido para derivar:
			</td>
			</tr>
			<tr>
				<td style="text-align:right" >Ingrese el Nombre, Apellido o parte de ellos:</td>
				<td ><input type="text" name="descripcion" id="descripcion" size="28" maxlength="40" value="<?=$descripcion?>" /></td>
				<td align="right" ><input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
				<td style="width:40%"></td>
			</tr>
		</table>
	</form>
</div>


<?
if (isset($_GET['muestra2']))
{
	$descripcion=trim($_GET['descripcion']);

	$qEstudiantes="SELECT * FROM alumno LEFT JOIN (SELECT cursa.* FROM cursa RIGHT JOIN (SELECT alumno,max(fecha) AS u_f FROM `cursa` GROUP BY alumno) AS ultReg ON ultReg.alumno = cursa.alumno AND ultReg.u_f = cursa.fecha) AS ultCurDiv ON ultCurDiv.alumno = alumno.dni WHERE apellido LIKE '%$descripcion%' OR  nombre LIKE '%$descripcion%' ORDER BY curso, divi";
	$estudiantes = mysql_query($qEstudiantes);



?>
<h3>Resultado de la B&uacute;squeda</h3>
 <table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<thead><tr>
							<th id="nDoc" >DNI</th>
							<th id="nombre">estudiantes</th>
							<th>Curso</th>
							<th>Telefono</th>
							<th>Direccion</th>
							<th	>Derivar</th>


						</tr></thead>

		<?php while ($fila2 = mysql_fetch_assoc($estudiantes))
		{	$apeNom = trim($fila2['apellido']) . " " . trim($fila2['nombre']);
			$seccion = (is_numeric($fila2['curso']) ? $fila2['curso'] . "o" : $fila2['curso']) . " " . (is_numeric($fila2['divi']) ? $fila2['divi'] . "a" : $fila2['divi']);
		?>

						<tr>
							<td id="nDoc" ><?=$fila2['dni'];?></td>
							<td  id="nombre"><?=$apeNom?></td>
							<td><?=$seccion?></td>
							<td><?=$fila2['tel']?></td>
							<td><?=$fila2['domicilio']?></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="derivacion2.php?actor=<?=$fila2[dni]?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Derivar"></a></td>





						</tr>
						<?
						}
						?>
						</table><?
}
include 'footer.php';
			?>





</body>

</html>
<? } ?>

