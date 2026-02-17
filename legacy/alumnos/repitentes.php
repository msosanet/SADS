<?PHP
session_start();
if ($_SESSION['estado']==1) { //verifica que hay usuario con sesiÃ³n inciada

$anio = $_SESSION['cicloLectivo'];

include 'conexion.php';
?>
<!DOCTYPE html >
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>Listado de repitentes</title>




</head>
<?
include 'encabezado.php';
conectar();
$errordoc = 0;
$hayerrores = 0;
$flag = 0;
if (isset($_GET["submitx"])) {

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {

?>

<div align="center">
	<table border="0" width="980">
		<tr>
			<td>

<!-- ++++++++++++++++++++++++++++++++ BARRA DE MENUS +++++++++++++++++++++++ -->
<?
include 'snipet_barramenu.php';
?>
<!-- ++++++++++++++++++++++++++++++++ FIN BARRA DE MENUS +++++++++++++++++++++++ -->
<div align="center">
			<table border="0" width="980">
				<tr>
					<td>
					<p class="titles1" align="left">Estudiantes que repitieron de año en <?=$anio?></p>
 
<?
$previo = $anio - 1;
$q_repis = mysql_query("SELECT repis.alumno,alumno.apellido,alumno.nombre,alumno.sexo,cursa.curso,cursa.divi FROM (SELECT DISTINCT c.alumno FROM `cursa` AS c,(SELECT alumno,curso,divi,anio FROM `cursa` WHERE control = 1 AND anio = '$anio') AS a WHERE c.anio = '$previo' AND c.curso = a.curso AND c.alumno = a.alumno) AS repis,alumno,cursa WHERE cursa.control = 1 AND cursa.anio = '$anio' AND cursa.alumno = repis.alumno AND alumno.dni = repis.alumno ORDER BY cursa.curso,cursa.divi,alumno.apellido,alumno.nombre");

$repitentes = obtenerArray($q_repis);
mysql_free_result();

?>
<br><br>

<div align="center">
	<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
		<tr height="36" bgcolor="#AAAAAA" >
			<th width="70"align="center">DNI</th>
			<th width="200"align="center">Apellido</th>
			<th width="200"align="center">Nombre</th>
			<th width="40" align="center">Sexo</th>
			<th width="40" align="center">Curso</th>
			<th width="40" align="center">Div</th>
		</tr>

		<?php 
		foreach ($repitentes as $linea) {
			echo "<tr class='alte'>\n";
//			for ($i=0;$i<count($linea);$i++) echo "<td>".$linea[$i]."</td>\n";	
			echo "<td align='center'>".$linea[0]."</td>\n";
			echo "<td >".$linea[1]."</td>\n";
			echo "<td >".$linea[2]."</td>\n";
			echo "<td align='center'>".$linea[3]."</td>\n";
			echo "<td align='center'>".$linea[4]."</td>\n";
			echo "<td align='center'>".$linea[5]."</td>\n";
			echo "</tr>\n";
		} 
						?>
	</table>
</div>
					</td>
				</tr>
			</table>
			</div>
			</td>
		</tr>
	</table>
</div>

<?
include 'foot.php';
}
} //Si no hay usuario registrado va a la pantalla de ingreso
else echo "<meta http-equiv='refresh' content='0; URL=i_admin.php'>";
function obtenerArray($consulta) {
	$tabla = array();
	while ($fila = mysql_fetch_row($consulta)) $tabla[] = $fila;
	return $tabla;
}
 ?>