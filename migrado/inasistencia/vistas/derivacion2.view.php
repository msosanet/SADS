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
$dni=$_GET['actor'];

if (!isset($_SESSION['cargo'])) $_SESSION['cargo'] = "Ayud. Dto. Orientacion";


$hora=date("H:i:s");

$alumno = mysql_query ("SELECT * FROM alumno RIGHT JOIN (SELECT cursa.* FROM cursa RIGHT JOIN (SELECT alumno,max(fecha) AS u_f FROM `cursa` WHERE alumno = $dni) AS ultReg ON ultReg.alumno = cursa.alumno AND ultReg.u_f = cursa.fecha) AS ultCurDiv ON ultCurDiv.alumno = alumno.dni");
$alu_deri = mysql_fetch_array($alumno);

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario);
$apNoUsuario = $filausuario['nombre']." ".$filausuario['apellido'];

$errordoc = 0;
  $hayerrores = 0;

  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos


     if (trim($_POST["fecha"]) == '') { $errorfecha = 1; $hayerrores = 1; };
     // if (trim($_POST["tel"]) == '') { $errortel = 1; $hayerrores = 1; };

     if (trim($_POST["cargo"]) == '') { $errorcargo = 1; $hayerrores = 1; };

}
 else
  {
    $flag = 1;
  }

if ($hayerrores OR $flag) {
?>



<div id="menu">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
if ($_SESSION['valor']==4) include 'menuppal4.php';


 list($ano,$mes,$dia) = explode("-",$alu_deri['f_nac']);
 $ano_diferencia  = date("Y") - $ano;
 $mes_diferencia = date("m") - $mes;
 $dia_diferencia   = date("d") - $dia;
 if ($dia_diferencia < 0 || $mes_diferencia < 0)
	$ano_diferencia--;
 $edad=$ano_diferencia;

$hoy = date("Y-m-d");

?>
	<p style="text-align: left;font-weight:bold;font-size:1.4em;padding:2em">Cargar Derivacion de <? echo trim($alu_deri['apellido']) . " " . trim($alu_deri['nombre']) ?></p>

<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
	<table border="0" width="895" id="table1" cellpadding="0" cellspacing="0">
		<tr>
			<td class="text1b"  colspan="4" height="40" align="left">CURSO: <?echo (is_numeric($alu_deri['curso']) ? $alu_deri['curso'] . "o" : $alu_deri['curso']) . " " . (is_numeric($alu_deri['divi']) ? $alu_deri['divi'] . "a" : $alu_deri['divi']);?><br>
			Edad: <?=$edad?><BR>
			FECHA DE NACIMIENTO: <?echo date("d/m/Y",strtotime($alu_deri['f_nac']))?></td>
		</tr>
		<tr>
			<td width="190" bgcolor="#EAEAEA" align="right">&nbsp;</td>
			<td bgcolor="#EAEAEA" width="265" align="left"></td>
			<td width="190" bgcolor="#EAEAEA" align="right">&nbsp;</td>
			<td bgcolor="#EAEAEA" width="265" align="left"></td>
		</tr>

		<tr>
			<td width="190" bgcolor="#EAEAEA" align="right">Deriva en caracter de:</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="cargo" size="30" maxlength="30" value="<?=$_SESSION['cargo']?>" required /></td>


			<td width="190" bgcolor="#EAEAEA" align="right">Observador:
			</td>

			<td bgcolor="#EAEAEA" width="265" align="left"><?=$apNoUsuario?></td>
		</tr>
		<tr> <!--

			<td width="190" bgcolor="#EAEAEA" align="right">Telefono:
			</td>

			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="tel" size="20" maxlength="20" value="" /></td> -->

			<td width="190" bgcolor="#EAEAEA" align="right" colspan=2>
			Fecha:</td>
			<td bgcolor="#EAEAEA" width="265" align="left" colspan=2><input type="date" name="fecha" value="<?echo $hoy;?>" /> <?PHP if ($errorfecha) echo "Debe completarse la fecha" ?></td>

		</tr>



		<tr>

			<td width="174" bgcolor="#EAEAEA" align="right" >Hechos Observados:</td>
			<td bgcolor="#EAEAEA" width="800" align="left" colspan="3"><TEXTAREA COLS=80 ROWS=10 NAME="observaciones"> </TEXTAREA></td>

		</tr>
		<tr>

			<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
			<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
		</tr>
	</table>
	<input name="dni" type="hidden" value ="<?=$dni?>"/>
	<input name="observador" type="hidden" value ="<?=$usuario?>"/>
</form>
</div>





</body>
<?
include 'footer.php';
}
else
{

	$fecha=$_POST['fecha'];
	$cargo=$_POST['cargo'];
	$observaciones=$_POST['observaciones'];
	$observador=$_POST['observador'];
	$alumno=$_POST['dni'];
	$tel= 0; //$_POST['tel'];
	$profesional=$apNoUsuario;
	$profe="";



if (mysql_query ("INSERT INTO derivacion VALUES (0,'$profesional','$cargo','$tel','$observaciones','','','','$alumno','$fecha','$profe')"))
	{
				?>
				<script>
				var answer=alert("Datos Grabados Correctamente")
				</script>
				<meta http-equiv='refresh' content='0; URL=intervenir.php?alumno=<?=$alumno?>'>
				<?


	}
				else {
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script>
				<meta http-equiv='refresh' content='0; URL=intervenir.php?alumno=<?=$alumno?>'>
				<?
				}



}?>
</html>
<? } ?>

