<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';
?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Tira Dependencia</title>


</head>
<?
include 'header.php';
$conexion = conectar ();
$q_cargos =
/*
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
*/

/* $db2 = mysql_connect("localhost", "fgoicoechea", "sobral2011");
mysql_select_db("DBF2MYSQL",$db2);

$result81 = mysql_query ("SELECT * FROM docentes WHERE dni = '28.119.465'",$db2);
$tribu = mysql_num_rows($result81);       */

$busqueda = (isset($_GET['descripcion'])) ? $_GET['descripcion'] : "";

?>


<form method="GET" action="<?=$_SERVER['PHP_SELF']?>">

<div style="max-width: 980px; margin: auto">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
</div>

	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>

			<div align="center">
			<table border="0" width="980">
				<tr>
					<td>


					<div align="left">

					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el Apellido o parte de el:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="28" maxlength="40" value="<?=$busqueda?>" autofocus/></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>

						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
					</table>
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
					<?
				if (isset($_GET['muestra2']))
{
	//$descripcion=$_GET['descripcion'];
	$descripcion=mysql_real_escape_string($_GET['descripcion']);

	$_pagi_sql="SELECT * FROM docentes LEFT JOIN estados ON docentes.identificacion = estados.codigo WHERE apellido like '%$descripcion%' or dni like '%$descripcion%' order by apellido,nombre";



$_pagi_cuantos=20;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php");
?>
<p align="left"><?
echo"$_pagi_navegacion";
?>
<br><br>
</p><?

		?> <table border="1" width="900" id="table1" cellpadding="2" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="6" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>
						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">DNI</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Apellido</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Nombre</td>
							<td bgcolor="#808080" width="50" align="center" height="36">Tribu</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Estado</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Acciones</td>


						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{

		$resultz = mysql_query ("SELECT * FROM estados WHERE codigo = '$fila2[identificacion]'");
		$filaz = mysql_fetch_array($resultz) ;


		?>

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?=$fila2['dni']?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?=$fila2['apellido']?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?=$fila2['nombre']?></td>
							<td width="10" bgcolor="#EAEAEA" align="center"><?=$fila2['tribu']?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?=$fila2['descripcion']?></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="leg_unif.php?actor=<?=$fila2['dni']?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Ver Horario"></a></td>





						</tr>
						<?
						}
						?>
						</table><?
}
	?>
					</p>
					<p align="center">&nbsp;</p>

			</div>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>



</form>
 </td>

</div>

</body>

</html>
<? }
else {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
} ?>
