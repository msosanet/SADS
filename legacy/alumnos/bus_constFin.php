<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
//$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
//$filatt = mysql_fetch_array($resultt) ;
$anio=$_SESSION['cicloLectivo'];

$descripcion = isset($_GET['descripcion']) ? $_GET['descripcion'] : "";
if (isset($_GET['muestra2'])) { // Resultado de la búsqueda o listado 6to año
	if (is_numeric(trim($descripcion))) {
		$_pagi_sql = "SELECT * FROM `alumno`,`cursa` WHERE `alumno`.`dni` LIKE '%$descripcion%' AND `cursa`.`curso`=6  AND `cursa`.`alumno`=`alumno`.`dni` ORDER BY `alumno`.`apellido`,`alumno`.`nombre`";
	}
	else {
		$_pagi_sql = "SELECT * FROM `alumno`,`cursa` WHERE `alumno`.`apellido` LIKE '%$descripcion%' AND  `cursa`.`curso`=6 AND `cursa`.`alumno`=`alumno`.`dni` ORDER BY `alumno`.`apellido`,`alumno`.`nombre`";
	}
} 
else {
	    $_pagi_sql = "SELECT * FROM `alumno`,`cursa` WHERE `cursa`.`anio`=$anio AND `cursa`.`control`=1 AND `cursa`.`curso`=6 AND `cursa`.`divi` <> '' AND `cursa`.`alumno`=`alumno`.`dni` ORDER BY `alumno`.`apellido`,`alumno`.`nombre`";
}

$_pagi_result = mysql_query($_pagi_sql);

$contenido_tabla = "";
while ($fila2 = mysql_fetch_array($_pagi_result)) $contenido_tabla[] = "<tr class='alte' onclick='ventanaSecundaria(\"const_final.php?dni=" . $fila2['dni'] . "\")'><td width='20' align='center'>" .  $fila2['dni'] . "</td><td width='20' align='center'>" . $fila2['apellido'] . ", " . $fila2['nombre'] . "</td></tr>";

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>



<title>Estudiantes de 6to año</title>

<script language=javascript> 
	function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=1080,height=500,scrollbars=NO,titlebar=NO,menubar=NO,location=NO") 
	}
	function autoTabla() {
		let table = new DataTable('#myTable', {
			language: {
				url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-AR.json',
			},
			"pageLength": 25});
		table.order([1, 'asc']).draw();
	}

</script>

<img src="header.jpg" alt="SID" style="vertical-align:bottom; display: block; margin-left: auto; margin-right: auto;">	
</head>

<body  onload="autoTabla()">
<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->

<form method="GET" action="bus_constFin.php">

<?
include 'snipet_barramenu.php'; // comprueba el tipo de usuario y despliega menú de funciones acorde
?>	
<br>
<p align="left" class="titulo">Buscar alumno de 6to año por Apellido o DNI para <i>Certificaci&oacute;n de Fin de Cursada Regular del &uacute;ltimo a&ntilde;o</i></p>
<br>
	
<div >
		
<table border="0">
	<tr>
        <td >Ingrese el Apellido, D.N.I. o parte de él:</td>
        <td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="35" maxlength="40" value="<?=$descripcion?>" autofocus></td>
        <td><input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
	</tr>
</table>
</div>
<br>
<div style="max-width: 600px">
<p >&nbsp;Resultado de la B&uacute;squeda (click en apellido y nombre para obtener el texto a copiar)</p>
<table id="myTable" >
	<thead>
	<tr bgcolor="#CCCCCC">
		<th style="width: 20%" >DNI</th>
		<th >Alumno</th>
	</tr>
	</thead>
	</tbody>

<? 
foreach($contenido_tabla AS $tr) echo $tr;
?>    
	</tbody>
</table>
				
</div>					
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