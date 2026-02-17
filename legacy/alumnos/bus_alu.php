<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<link rel="stylesheet" type="text/css" href="style2.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> 
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

<script>
	$(document).ready(function() {
		let table = new DataTable('#myTable', {
			language: {
				url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-AR.json',
		 },});
		 table.order([[1, 'asc'], [2,'asc']]).draw();
	})
</script>

<title>Legajo del Alumno</title>
<img src="header.jpg" alt="SID" style="vertical-align:bottom; display: block; margin-left: auto; margin-right: auto;">	
</head>
<body  onload="autoTabla()">
<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
//$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
//$filatt = mysql_fetch_array($resultt) ;

	$descripcion = isset($_GET['descripcion']) ? $_GET['descripcion'] : "";
    $_pagi_sql = "SELECT * FROM alumno WHERE apellido like'%$descripcion%' or dni like'%$descripcion%'";
	
	$forMyTable = mysql_query($_pagi_sql);

?>

<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->

<form method="GET" action="bus_alu.php">

<?
include 'snipet_barramenu.php'; //COMPRUEBA EL TIPO DE USUARIO Y DESPLIEGA MENÚ DE FUNCIONES ACORDE
?>	
<br>
<p align="left" class="titulo">Acceder al Legajo del estudiante</p>
<br>
	
<div align="left">
		
<table border="0">
	<tr>
        <td class="titulo2">Ingrese el Apellido, D.N.I. o parte de él:</td>
        <td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="35" maxlength="40" value="<?=$descripcion?>" autofocus/></td>
        <td><input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
	</tr>
</table>
</div>
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