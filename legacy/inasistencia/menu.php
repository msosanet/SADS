<?
session_start();
include 'conexion.php';
?>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />

<link rel="stylesheet" type="text/css" href="style2.css" />
<title>Administrador S.A.S.</title>

</head>
<?
include 'header.php';

$usuario = $_SESSION['usuario'];
$contrasenia = $_SESSION['contrasenia'];

    function invertirFecha( $fechaz ){
      return implode( "-", array_reverse( preg_split( "/\D/", $fechaz ) ) );
    }

if ($usuario!="") {
	$conexion = conectar ();
	$error = 0;
	$result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
	if (mysql_num_rows ($result) == 0 ) $error=1;
	if (mysql_num_rows ($result) != 0) {
		$fila = mysql_fetch_array($result) ;
		if ( $fila['pass'] != $contrasenia ) $error = 1;
	}

}
else $error = 1;

if ($error==0) {
 $_SESSION['estado']=1;
 $_SESSION['valor']=$fila['valor'];
 $_SESSION['sector']=$fila['sector'];
}
else {
	?>
	<script>
		var answer=alert("Datos incorrectos")
	</script>
	<meta http-equiv='refresh' content='0; URL=index.php'><?
	exit;
} ?>

<body>
<div align="center" style="max-width: 980px;">
<!-- +++++++++++++ BARRA DE MENÚS +++++++++++++ -->
<?
if ($_SESSION['valor']==1) include 'menuppal2.php'; //  ADMINISTRACIÓN +++++++++++++++
if ($_SESSION['valor']==0) include 'menuppal.php'; //   DIRECTIVO ++++++++++++++++++++
if ($_SESSION['valor']==3) include 'menuppal3.php'; //  PRECEPTOR +++++++++++++++
if ($_SESSION['valor']==4) include 'menuppal4.php'; // ++++++++++++++ E.O.E. +++++++++++++++++++
if ($_SESSION['valor']==5) include 'menuppal5.php';
?>
<!-- +++++++++++++ FIN BARRA DE MENÚS +++++++++++++ -->
	<table border="0" width="980" cellspacing="0" cellpadding="0">
		<tr>
			<td><p align="left">&nbsp;&nbsp;<B><?echo $fila['nombre'] . " " . $fila['apellido']?></B>, Bienvenido al S.A.S.</p>

					<div align="center">


<!-- ++++++++++++++++++++++++++ PRECEPTOR +++++++++++++++++++++++++++++++++++++++++++++ -->
<? if ($_SESSION['valor']==3) {

$date = date('Y-m-d');
$conexion = conectar();

?>

<div id="marco980" align="center"> <!-- ++++++ INICIO MARCO 980 ++++++ -->
<br>
<?
//+++++++++++++++ AVISOS VIGENTES +++++++++++++++++++++++++
$date = date('Y-m-d');
$_pagi_sql="SELECT * FROM nov_docentes where borrado=1 AND categoria = 'doc' AND vencimiento >= '$date' ORDER BY codigo DESC";
$_pagi_cuantos=20000;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
?>

<!-- br -->

<br>

<p class="titulo">Los actos públicos que se van cubriendo se encuentran en el menu principal Act. públicos</p>


<br>


<!-- +++++++++++ FIN PANEL DE AVISOS VIGENTES ++++++++++++++++ -->

<?
$db2 = mysql_connect("localhost", "fgoicoechea", "sobral2011");
mysql_select_db("alumnos",$db2);
$_pagi = mysql_query("
    SELECT novedades.*, CONCAT(apellido, ', ', nombre) AS alu 
    FROM novedades 
    LEFT JOIN alumno ON novedades.dni = alumno.dni 
    WHERE borrado = 1 
      AND fecha >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
    ORDER BY fecha DESC, hora DESC
", $db2);
?>

<br>

<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
	<tr>
		<td class="text1b" colspan="6" height="40" align="left">
		&nbsp;Novedades de los alumnos</td>
	</tr>
	<tr bgcolor="#cccccc" height="40">
		<td width="100" align="center" height="36"><b>ALUMNO</b></td>
		<td width="50" align="center" height="36"><b>CURSO</b></td>
		<td width="700" align="center" height="36"><b>NOVEDAD</b></td>
		<td width="70" align="center" height="36"><b>FECHA</b></td>
		<td width="15" align="center"  height="36"><b>HORA</b></td>
		<td width="15" align="center"  height="36"><b>NOTIFICÓ</b></td>



	</tr><?php

	 while ($fila3 = mysql_fetch_array($_pagi)) {
?>
		<tr height="35">
			<td bgcolor="#EAEAEA" align="center"><?echo $fila3['alu'];?></td>
			<td bgcolor="#EAEAEA" align="center"><?echo $fila3['curso'];?></td>
			<td bgcolor="#EAEAEA" align="left"><?echo $fila3['novedad'];?><!-- <?=$fila3['codigo']?> --></td>
			<td bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fila3['fecha']);?></td>
			<td bgcolor="#EAEAEA" align="center"><?echo $fila3['hora'];?></td>
			<td bgcolor="#EAEAEA" align="center"><?echo $fila3['grabo'];?></td>
		</tr>
<? } ?>
</table> <br><br>
<?
$conexion = conectar();
$_pagi2=mysql_query("SELECT * FROM novedades2,docentes where novedades2.borrado=1 and novedades2.docente=docentes.dni order by fecha1 DESC");
?>
<? } ?>
<!-- +++++++++ PANTALLA DE INICIO USUARIO E.O.E. +++++++++++ -->
<?
 if ($_SESSION['valor']==4) {

$date = date('Y-m-d');
$conexion = conectar();

//		$_pagi=mysql_query("SELECT * FROM novedades where borrado=1 order by fecha DESC");
		$_pagi=mysql_query("SELECT novedades.*,CONCAT(apellido, ', ',nombre) AS alu FROM novedades LEFT JOIN alumno ON novedades.dni = alumno.dni WHERE borrado=1 AND fecha > MAKEDATE(YEAR(CURRENT_DATE)-1,1) ORDER BY fecha DESC,hora DESC");
?>

<!-- ************* NOVEDADES ALUMNOS ********************** -->
<?
$novalu_all = mysql_query ("SELECT * FROM nov_docentes where borrado=1 AND categoria = 'alu' AND vencimiento >= '$date' ORDER BY codigo DESC");
?>

<div id="nov_container_alu_ancho" align="left">

<div align="center">
<p class="titulo">AVISOS PARA ALUMNOS</p>
</div>

<div id="nov_box_corto_ancho">

<?
while ($novalu = mysql_fetch_array($novalu_all))
		{
?>
<div id="novedad">
  <!-- p class="fecha"><? //echo "Publ. " . $fila2['fecha'] . " - Vto." . $fila2['vencimiento']; ?></p -->
  <p class="titulo"><? echo $novalu['tema']; ?>&nbsp;<span class="fecha"><? echo "Publicado " . substr($novalu['fecha'],-2) . "-" . substr($novalu['fecha'],-5, 2) . "-" . substr($novalu['fecha'],0, 4); ?></span></p>
  <p class="novtext"><? echo $novalu['aviso']; ?></p>
</div>
<? }	?>
</div>

</div>
<!-- ************* FIN NOVEDADES ALUMNOS ********************** -->

<?
{
	$db2 = mysql_connect("localhost", "fgoicoechea", "sobral2011");
mysql_select_db("alumnos",$db2);
//$_pagi=mysql_query("SELECT * FROM novedades where borrado=1 ORDER BY codigo DESC",$db2);
$_pagi=mysql_query("SELECT novedades.*,CONCAT(apellido, ', ',nombre) AS alu FROM novedades LEFT JOIN alumno ON novedades.dni = alumno.dni WHERE borrado=1 AND fecha > MAKEDATE(YEAR(CURRENT_DATE)-1,1) ORDER BY fecha DESC,hora DESC ",$db2);
//		$_pagi=mysql_query("SELECT * FROM novedades where borrado=1 order by fecha DESC");

?>

<br>
<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
	<tr>
		<td class="text1b"  colspan="6" height="40" align="left">
		&nbsp;Novedades de los alumnos</td>
	</tr>
	<tr bgcolor="cccccc" height="30">
		<td width="100" align="center" height="36"><b>ALUMNO</b></td>
		<td width="50" align="center" height="36"><b>CURSO</b></td>
		<td width="600" align="center" height="36"><b>Novedad</b></td>
		<td width="50" align="center" height="36"><b>Fecha</b></td>
		<td width="55" align="center"  height="36"><b>Hora</b></td>
		<td width="70" align="center"  height="36"><b>Notific&oacute;</b></td>



	</tr><?php
 while ($fila3 = mysql_fetch_array($_pagi)) {
?>
	<tr bgcolor="#dddddd" height="30">
		<td align="left"><?echo $fila3['alu'];?></td>
		<td align="left"><?echo $fila3['curso'];?></td>
		<td align="left"><?echo $fila3['novedad'];?></td>
		<td align="center"><?echo invertirFecha($fila3['fecha']);?></td>
		<td align="center"><?echo $fila3['hora'];?></td>
		<td align="center"><?echo $fila3['grabo'];?></td>
	</tr>
<? }  ?>
</table>
<? }
}
?>
 <br>
<!-- +++++++++ FIN PANTALLA DE INICIO USUARIO E.O.E. +++++++++++ -->

<!-- +++++++ PANTALLA INICIAL USUARIO ADMINISTRACIÓN +++++++++ -->

<?
//+++++++ PANTALLA INICIAL USUARIO ADMINISTRACION, RECTORIA O E.O.E. +++++++++

if ($_SESSION['valor']==0 or $_SESSION['valor']==1 or $_SESSION['valor']==2)
{

//+++++++++++++++ AVISOS VIGENTES +++++++++++++++++++++++++

?>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<!-- +++++++++++ FIN PANEL DE AVISOS VIGENTES ++++++++++++++++





<!-- ++++++++++++ FIN TABLA DE DOCENTES CON MÁS DE 2 DÍAS DE LICENCIA ++++++++++ -->
<br><br>
<? }

?>


					</div>


					</td>
				</tr>
				</td>
				</tr>
			</table>
			</tr>
			</div>
				<?
include 'footer.php';
?>
</body>

</html>
