<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" >
<title>SID</title>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>
</head>
<?
include 'header.php';
?>
<body>

<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo6 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo7 {font-size: 16px; font-weight: bold; color: #FF0000; }
-->
</style>

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$actor=$_GET["actor"];

$resultt = mysql_query ("SELECT * FROM materia_cargo WHERE id = $actor");
$filatt = mysql_fetch_array($resultt);



if ($filatt['activo'] >=1) $check="checked";



$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos




}
 else
  {
    $flag = 1;
  }

if ($hayerrores OR $flag) {

echo '<div style="align:center;max-width:980px">';
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
echo '</div>';

?>

<form method="_GET" action="modif_materias.php?actor=<? echo $actor; ?>">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
			<table border="0" width="980">
				<tr>


					<td>

					<p align="left" class="text1b">Modificar Materias</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">

					<div align="center">

					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">


						<tr>


							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">ID.:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<?echo $actor; ?>
							</td>



							<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="nombre" size="60" maxlength="200" value="<?echo $filatt['nombre']; ?>" />
							</td>

						</tr>




								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Curso:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="curso" size="4" maxlength="4" value="<?echo $filatt['curso']; ?>" />
							</td>



							<td width="190" bgcolor="#EAEAEA" align="right">
							Division.:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="division" size="4" maxlength="4" value="<?echo $filatt['division'];?>" /></td>
							</td>


						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Puesto:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="plaza" size="8" maxlength="8" value="<?echo $filatt['plaza'];?>" /> SIGE: <input type="text" name="sige" size="8" maxlength="8" value="<?echo $filatt['sige'];?>" /></td>
							</td>





							<td width="190" bgcolor="#EAEAEA" align="right">
							Turno:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="turno" size="3" maxlength="3" value="<?echo $filatt['turno'];?>" /></td>
							</td>


						</tr>
									<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Inst. Legal:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="legal" size="50" maxlength="80" value="<?echo $filatt['legal'];?>" /></td>
							</td>




							<td width="190" bgcolor="#EAEAEA" align="right">
							Codigo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="codigo" size="5" maxlength="5" value="<?echo $filatt['codigo'];?>" /></td>
							</td>

						</tr>

						<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Materia Activa:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="checkbox" name="activo" <? echo $check ?>></td>
							</td>

							<td width="190" bgcolor="#EAEAEA" align="right">HS
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="hs" size="2" maxlength="2" value="<?echo $filatt['cant_hs'];?>"></td>
							</td>





						</tr>
						<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Orientacion:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="ori" size="15" maxlength="15" value="<?echo $filatt['orientacion'];?> "></td>
							</td>

							<td width="190" bgcolor="#EAEAEA" align="right">Res. Pedago.
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="pedago" size="50" maxlength="50" value="<?echo $filatt['respedago'];?>"></td>
							</td>





						</tr>


						<tr>

						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						</table>
					</div>
					<p align="right">&nbsp;</div>
					<hr>
					</td>
				</tr>
			</table>
			</div>
		</tr>
	</table>
<input type="hidden" name="actor" value="<?echo $actor;?>">
	</form>
</div>
</body>
<?
}
else
{


	$activo=$_GET['activo'];
	$turno=$_GET['turno'];
	$nombre=ucfirst($_GET['nombre']);
	$legal=$_GET['legal'];
	$plaza=$_GET['plaza'];
	$sige=$_GET['sige'];
	$codigo=$_GET['codigo'];
	$division=$_GET['division'];
	$curso=$_GET['curso'];
	$hs=$_GET['hs'];
	$orienta=$_GET['ori'];

	$pedago=$_GET['pedago'];

echo $activo;
if (isset($activo)) $activo=1;
else $activo=0;
//echo $activo;



$actualizamat="UPDATE materia_cargo SET nombre='$nombre', curso='$curso', division='$division', plaza=$plaza, sige=$sige, turno='$turno', legal='$legal', codigo='$codigo', activo='$activo', cant_hs='$hs' , orientacion='$orienta', respedago='$pedago' where id='$actor'";
//echo $actualizamat;
if (mysql_query ($actualizamat))
	{

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script>
				<meta http-equiv='refresh' content='0; URL=modif_mat.php'>

				<?
	}
	else {
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script>
				<meta http-equiv='refresh' content='0; URL=modif_mat.php'>

				<?
		}


}

include 'footer.php';
?>
</html>
<? } ?>

