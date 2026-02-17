<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Derivaciones de <?=$alumno?></title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");

if (!mysql_num_rows($resultt)) {
	header('Location: i_admin.php');
	exit;
}

?>

<body>

<div id="menu">

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
if ($_SESSION['valor']==4) include 'menuppal4.php';

?>


					<?

if (is_numeric($alumno))
{
	//$q_derivaciones="SELECT derivacion.*,alumno.apellido, alumno.nombre FROM `derivacion` LEFT JOIN alumno ON derivacion.alumno = alumno.dni WHERE `alumno` = $alumno ";
	$q_derivaciones = "SELECT derivs.*,COALESCE(cantidad,0) AS numInts FROM (SELECT derivacion.*,alumno.apellido, alumno.nombre FROM `derivacion` LEFT JOIN alumno ON derivacion.alumno = alumno.dni WHERE `alumno` = $alumno) AS derivs LEFT JOIN (SELECT alumno,COUNT(codigo) AS cantidad,idderiva FROM `intervencion` WHERE mostrar != 0 GROUP BY alumno,idderiva) AS ints ON derivs.id = ints.idderiva  ";
	$derivaciones = mysql_query($q_derivaciones);


$derivs = [];
while ($fila2 = mysql_fetch_assoc($derivaciones)) {
	$fila2['fecha'] = date("d/m/Y",strtotime($fila2['fecha']));
	$fila2['agente'] = $fila2['derivador']."/".$fila2['observador'];

	$derivs[$fila2['id']] = $fila2;
}

// Obtiene las iniciales del nombre para mostrarlas en lugar del nombre completo
$derivado = reset($derivs);
$iniciales = $derivado['nombre'][0];
$palabra = 0;
while ($palabra = strpos($derivado['nombre']," ",$palabra)) $iniciales.= $derivado['nombre'][++$palabra];
$iniciales .=  $derivado['apellido'][0];
$palabra = 0;
while ($palabra = strpos($derivado['apellido']," ",$palabra)) $iniciales.= $derivado['apellido'][++$palabra];

?>
<h2 style="text-align: left">Derivaciones para <?=$iniciales?> (<?=$alumno?>)</h2>

<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

	<thead><tr>
		<th>Fecha</th>
		<th style="width:40%" >Motivo</th>
		<th>Derivado por:</th>
		<th>Intervenciones</th>
		<th>Registrar intervenci&oacute;n</th>
	</tr></thead>
<?php foreach($derivs AS $id => $fila) {
		?>

	<tr>
		<td><?=$fila['fecha']?></td>
		<td><?=$fila['hechos']?></td>
		<td><?=$fila['agente']?></td>
		<td style="text-align: center"><?=$fila['numInts']?></td>
		<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="intervenir2.php?actor=<?=$alumno?>&deriva=<?=$id?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Intervenir"></a></td>
	</tr>
		<?
		}
		?>
</table><?
}
	?>

</div>
			<?
			include 'footer.php';
			?>

</html>
<? }
else header('Location: i_admin.php');	?>

