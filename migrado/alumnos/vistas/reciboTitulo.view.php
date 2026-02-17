<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="style2.css" />
<title>Generar recibos para retiro de título</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'encabezado.php';

?>

<?

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
?>

<form method="POST" action="reciboTitulo_pdf.php" target="_blank">
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
			<?
include "snipet_barramenu.php";
?>
			<table border="0" width="980">
	
				<tr>
				

					<td>
					
<p align="left" class="text1b">Generar recibos de título para</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color='red'>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="450" id="table1" cellpadding="0" cellspacing="4">

						

						<tr class="alte"><th>Seleccionar</th>
						<th>Apellido y Nombre</th>


<?
$anterior = 0;
$titulo_nro = mysql_query("SELECT * FROM `titulo` LEFT JOIN alumno ON titulo.alumno = alumno.dni WHERE titulo.numero != ''  AND titulo.anio != ''");
while ($titulado = mysql_fetch_assoc($titulo_nro)) {
		if (!$titulado['recibo']) $casilla = "checked";
		else $casilla = "";
		echo "<tr class='alte'>\n";
		echo "<td align='right'><input type='checkbox' id='" . $titulado['alumno'] . "' name='agregar[" . $titulado['alumno'] . "]' value='" . $titulado['alumno'] . "' " . $casilla . "></td>\n";
		echo "<td>" . $titulado['apellido'] . ", " . $titulado['nombre'] . "</td></tr>\n";
//		$datos = $datos . ";" . $rinde[alumno] . "=>" . $rinde[apeNom];
}
?>

						<!--<tr>
						<td colspan="2"><? //var_export($_POST);?></td></tr>
						<tr>
						<td colspan="2"><?// var_export($GLOBALS);?></td>							
						</tr> -->
		

			
						<tr>
							
						</tr>
						<tr>
							<td bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Generar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></p></td>
						</tr>
						</table>
					</div>
					<p align="right">&nbsp;</div>
					</td>
				</tr>
			</table>
			</div>
		</td>
		</tr>
	</table>
<input type="hidden" name="materia" value="<? echo $_GET['materia'];?>">
<input type="hidden" name="curso" value="<? echo $_GET['curso'];?>">
</div>
	</form>
<?
include 'foot.php';
}
}
?>
<?} else {?>
<meta http-equiv="refresh" content="0;url=/i_admin.php">
<?}?>
