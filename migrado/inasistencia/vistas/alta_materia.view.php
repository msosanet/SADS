<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
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


$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
 if (isset($_POST["submitx"])) {
     // verifico los errores en los campos

     if (trim($_POST["nombre"]) == '') { $errornombre = 1; $hayerrores = 1; };

}
 else $flag = 1;

if ($hayerrores OR $flag) {
?>

<form method="POST" action="alta_materia.php">

<div style="align:center;max-width:980px" >

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
</div>
<br>
<div style="align:center;max-width:980px">

					<p align="left" class="text1b">Alta Materia</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p>

					<div align="center">

					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">


						<tr>

												<?
	  					if ($errornombre==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<input type="text" name="nombre" size="50" maxlength="50" value="<?echo $_POST['nombre']; ?>" />
							</td>



							<td width="190" bgcolor="#EAEAEA" align="right">Turno:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<SELECT NAME="turno">
  							 	<OPTION VALUE="TM">TM</OPTION>
   								<OPTION VALUE="TT">TT</OPTION>
   								<OPTION VALUE="TV">TV</OPTION>
							</SELECT>
							</td>

						</tr>




								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Curso:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="curso" size="5" maxlength="5" value="" />
							</td>



								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Div:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="divis" size="5" maxlength="5" value="" />
							</td>

						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Puesto:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="plaza" size="6" maxlength="6" value="<?=$_POST['plaza'];?>" /> SIGE: <input type="text" name="sige" size="6" maxlength="6" value="<?=$_POST['sige'];?>" /></td>
							</td>




							<td width="190" bgcolor="#EAEAEA" align="right">
							Inst. Legal:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="legal" size="50" maxlength="50" value="<?echo $_POST['legal'];?>" /></td>

						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Codigo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="codigo" size="6" maxlength="6" value="<?echo $_POST['codigo'];?>" /></td>





							<td width="190" bgcolor="#EAEAEA" align="right">Materia Activa:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="checkbox" name="activo" value="1"></td>

						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Cant. hs:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="hs" size="2" maxlength="2" value="<?echo $_POST['cant_hs'];?>" /></td>




							<td width="190" bgcolor="#EAEAEA" align="right">Orientacion
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="orienta" size="15" maxlength="15" value="<?echo $_POST['orientacion'];?>" /></td>


						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Res. pedago.:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="pedago" size="50" maxlength="50" value="<?echo $_POST['respedago'];?>" /></td>





							<td width="190" bgcolor="#EAEAEA" align="right">
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"></td>

						</tr>







						<tr>

						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						</table>
					</div>
					<p align="right">&nbsp;</p>

			</div>
	</form>
</body>
<?
}
else
{

	$activo=$_POST['activo'];
	$turno=$_POST['turno'];
	$nombre=ucfirst($_POST['nombre']);
	$legal=$_POST['legal'];
	$plaza=$_POST['plaza'];
	$sige=$_POST['sige'];
	$codigo=$_POST['codigo'];
	$divis=$_POST['divis'];
	$curso=$_POST['curso'];
	$hs=$_POST['hs'];
	$orientacion=$_POST['orienta'];
	$pedago=$_POST['pedago'];



if ($activo <> 1) $activo=0;



	if (mysql_query ("INSERT INTO materia_cargo VALUES (0,'$nombre','$curso','$divis',$plaza,$sige,'$turno','$legal','$codigo',$activo,$hs,'$orientacion','$pedago')"))
	{

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script>
				<meta http-equiv='refresh' content='0; URL=alta_materia.php?'>
				<?
	}
	else {
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script>
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<?
		}


}

include 'footer.php';
?>
</html>
<? } ?>

