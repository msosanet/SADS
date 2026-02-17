<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style2.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

<script>
	function autoTabla() {
		let table = new DataTable('#myTable', {
			language: {
				url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-AR.json',
		 },});
		 table.order([[1, 'asc'], [2,'asc']]).draw();
	}
</script>

<title>Promovidos</title>
<img src="header.jpg" alt="Banner alumnos" style="vertical-align:bottom; display: block; margin-left: auto; margin-right: auto;">	
</head>
<body  onload="autoTabla()">
<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->

<form method="GET" action="bus_alu.php">

<?
include 'snipet_barramenu.php'; //COMPRUEBA EL TIPO DE USUARIO Y DESPLIEGA MENÚ DE FUNCIONES ACORDE
?>	
<br>
<p align="left" class="titulo">Promovidos de acuerdo a calificadores</p>
<br>

<p align="right">O tipee algún dato en el siguiente cuadro:
<br><br>
</p>

<table id="myTable" >
	<thead>
	<tr bgcolor="#CCCCCC">
		<th id="docu" >DNI</th>
		<th id="ape" >Apellido</th>
		<th id="nom" >Nombre</th>
	</tr>
	</thead>
	<tbody>

<? 
while ($fila2 = mysql_fetch_array($forMyTable)) {	
?> 

	<tr  class="alte" onclick='location.assign("alumno.php?dni=<?=$fila2['dni']?>");' title="click para ir al legajo">
		<td ><?=$fila2['dni']?></td>
		<td ><?=$fila2['apellido']?></td>
		<td ><?=$fila2['nombre']?></td>
    </tr>
<?
    }
?>
</tbody>   
</table>

				
<br>					
<?
include 'footer.php';
?>

</form>

</div>

</body>

</html>
<? 
    } //************ FIN COMPRUEBA SESIÓN *******************
	else {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
}
?>
