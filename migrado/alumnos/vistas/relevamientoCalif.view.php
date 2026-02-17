<!DOCTYPE html >
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Language" content="es-ar">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="style2.css" />
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script> -->
<title>Relevamiento de trayectorias</title>

</head>
<?
include 'header.php';

?>
<body>
<?
  
?>

<div align="center" style="max-width: 980px">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
<form method='GET' action='<?=$_SERVER['PHP_SELF']?>' >
	<div><br><br>
		<p>Modalidad y ciclo
		<select name="mod" onchange='this.form.submit()'>
		 <option value="cb" <?PHP if ($selected=="cb") echo "selected"; ?> >Ciclo básico Bachiller Orientado</option>
		 <option value="bt" <?PHP if ($selected=="bt") echo "selected"; ?>>Primer ciclo Educación Técnica</option>
		 <option value="on" <?PHP if ($selected=="on") echo "selected"; ?>>Ciclo orientado Bachiller en Ciencias Naturales</option>
		 <option value="oc" <?PHP if ($selected=="oc") echo "selected"; ?>>Ciclo orientado Bachiller en Comunicación Social</option>
		 <option value="ot" <?PHP if ($selected=="ot") echo "selected"; ?>>Ciclo orientado Bachiller en Turismo</option>
		 <option value="st" <?PHP if ($selected=="st") echo "selected"; ?>>Segundo ciclo Educación Técnica</option>
		</select>
		</p>
	</div>
</form>
<table border="0" width="980">
	<tr>
		<td>

			<div align="center">
 
<?
?>
<br><br>

	<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
		<thead><tr>
			<th>Apellido y Nombre</th>
			<th>DNI</th>
			<th>Género</th>
			<th>Discapacidad</th>
			<th>PPI</th>
<? foreach ($$materias AS $idm) echo "<th style='writing-mode: vertical-rl;'>" . $array_materias[$idm] . "</th>"; ?>
		</tr></thead>
		<tbody>

<?php
foreach ($estud AS $doc => $datos) {
	echo "<tr class='alte'><td>" . $datos['nya'] . "</td>";
	echo "<td>" . $datos['dni'] . "</td>";
	echo "<td>" . $datos['sexo'] . "</td>";
	echo "<td>" . $datos['curso'] . "</td>";
	echo "<td>" . $datos['divi'] . "</td>";
	foreach ($$materias AS $idm) echo "<td>" . $datos[$idm] . "</td>";
}
	echo "</tr>";
?>
		</tbody></table>

			</div>
<!-- <script>
		 let table = new DataTable('#table1', {
			language: {
				url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-AR.json',
		 },});
		 table.order([[3, 'asc'], [4,'asc'], [0,'asc']]).page.len( 40 ).draw();
</script> -->

		</td>
	</tr>
</table>
</div>
<?
include 'footer.php';
?>

</body>
<?

?>


</html>




