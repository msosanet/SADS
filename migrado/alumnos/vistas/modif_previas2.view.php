<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 

<?
include 'header.php';
?>
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
if (isset($_GET["dni"])) $dni=$_GET["dni"];
elseif (isset($_POST["dni"])) $dni=$_POST["dni"];
else exit;

$resultt = mysql_query ("SELECT * FROM alumno WHERE dni = $dni");
$filatt = mysql_fetch_array($resultt);
$estudiante = $filatt['apellido'] .", " . $filatt['nombre'] . " " . number_format($filatt[dni],0,'','.');

$resultmotivo = mysql_query ("SELECT * FROM previas LEFT JOIN materias2023 ON previas.idmateria = materias2023.idmateria WHERE alumno = $dni ORDER BY curso DESC,materia"); 


$errordoc = 0;
$hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"]) || isset($_POST["borrar"])) {
     // verifico los errores en los campos




}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
	$color="";
?>
<title><?=$estudiante?> - Modificar Previas</title>
</head>
<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
	<tr><th>
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>	
	</th></tr>
	<tr>
		<td>
		<p align="left" class="text1b">Agregar notas a las previas</p><br>
		<p align="center" class="text1b"><? if($hayerrores) echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>"; ?>
</p><div align="left">
		
		<div align="center">
		
		<table border="0" width="895" id="table1" cellpadding="0" cellspacing="6">
			<tr>
				<td colspan="6" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Alumno: <em><?=$estudiante?></em></td>
			</tr>
			<tr>
			<th width="400" >Materia</th>
			<th width="30">Calificaci&oacute;n</th>
			<th width="30">Folio</th>
			<th width="300" >Observaciones</th>
			<th width="100">Fecha de ex&aacute;men</th>
			<th width="10">Borrar</th>
			</tr>

			<?	WHILE ($ff = mysql_fetch_array($resultmotivo)) {
				if ($ff['movilidad']) $desc_mat = ucwords(strtolower($ff['descripcion'])) . " " . $ff['curso'] . " (M E.)";
				else $desc_mat = ucwords(strtolower($ff['descripcion'])) . " " . $ff['curso'];

				?>
			
			<tr>
				<input hidden name="materia[<?=$ff['id']?>]" value="<?=$ff['idmateria']?>" />
				<td  bgcolor="#EAEAEA" align="left"><font color="<?=$color?>"><?=$desc_mat?>
					<!-- <input type="text" name="materia[]" size="30" maxlength="30" value="<?echo $ff['descripcion']; ?>" />--></font></td>
				
				<td bgcolor="#EAEAEA" align="center">
					<input type="text" name="nota[<?=$ff['id']?>]" size="1" maxlength="4" value="<?echo $ff['nota']; ?>" /></td>
				
				<td  bgcolor="#EAEAEA" align="center"><font color="<?echo $color;?>">
					<input type="text" name="folio[<?=$ff['id']?>]" size="3" maxlength="5" value="<?echo $ff['folio']; ?>" /></font></td>
				
				<td bgcolor="#EAEAEA" align="left">
					<input type="text" name="obs[<?=$ff['id']?>]" size="40" maxlength="40" value="<?echo $ff['observacion']; ?>" />
				</td>	

				<td bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
					<input type="date" name="fecha[<?=$ff['id']?>]" size="10" maxlength="10" value="<?echo $ff['fecha']; ?>" /></font></td>

				<td  bgcolor="#EAEAEA" align="center" title="Marque esta casilla para borrar previa"><font color="<?echo $color;?>">
					<input type="checkbox" name="borrar[<?=$ff['id']?>]"  value="<?=$ff['id']?>"></font></td>
			</tr>
			<input type="hidden" name="curso[<?=$ff['id']?>]" value="<?=$ff['curso']?>">
			<?
			}

			?>

			<tr>
				<td  bgcolor="#EAEAEA" align="left" colspan="6">
				<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
<!--				<td  bgcolor="#EAEAEA" align="left" colspan="1">
				<p align="center"><input type="submit" value="Borrar" name="borrar" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td> -->
			</tr> 
		</table>
		</div>
		<p align="right">&nbsp;</div>
		<hr>
		</td>
	</tr>
	<?
include 'footer.php';
?>
	</table>
<input type="hidden" name="dni" value="<?echo $dni;?>">
	</form>
</div>
</body>
<?
}
else
{
 if (isset($_POST["submitx"])) {
  $nota=$_POST["nota"];
  $folio=$_POST["folio"];
  $fecha=$_POST["fecha"];
  $obs=$_POST["obs"];
  $mate=$_POST["materia"];
  $anio=$_POST['curso'];
  $borrados=0;
  $modifica=0;
  $url_recarga = $_SERVER['PHP_SELF'] . "?dni=" . $dni;
echo "<!-- " . var_export($_POST,true) . " -->";
  
  
  foreach ($mate as $id => $idmateria)
  {
   if (isset($_POST['borrar'][$id])) {
     $sql_borra = "DELETE FROM previas WHERE idmateria = $idmateria AND curso = $anio[$id] AND alumno = $dni";
	 if (mysql_query($sql_borra)) $borrados++;
	 //echo "<!-- " . $sql_borra . " -->\n";
	}
	else {
	 $sql = "UPDATE previas SET nota=$nota[$id],fecha='$fecha[$id]',folio='$folio[$id]',observacion='$obs[$id]',fecha_carga=CURDATE()  WHERE idmateria = $idmateria AND curso = $anio[$id] AND alumno = $dni";
	 if (mysql_query($sql)) if (mysql_affected_rows()) $modifica++;
	 //echo "<!-- " . $sql . " -->\n";
	}
  }
  if ($borrados OR $modifica) {
   $mensaje = "Se modificaron los registros: $borrados borrados, $modifica alterados";
   ?>
	<script>
	var answer=alert("<?=$mensaje?>")
	</script>
	<meta http-equiv='refresh' content='0; URL=modif_previas.php'>
	<? 
  }
  else {
	?>
	<script>
	var answer=alert("No se alteraron registros")
	</script>
	<meta http-equiv='refresh' content='0; URL=modif_previas2.php?dni=<?=$dni?>'>
	<?
  }
  /*
  $cantErrores = count($_POST["adeuda"])-$control;
  if ($cantErrores==0)
  {	?>
	<script>
	var answer=alert("Datos Grabados Correctamente ")
	</script>
	<meta http-equiv='refresh' content='0; URL=modif_previas.php'>
	<? 
  }
  else 
  { ?>
	<script>
	var answer=alert("Hubo <?=$cantErrores?> error(es) al grabar los cambios")
	</script> 
	<meta http-equiv='refresh' content='0; URL=<?=$url_recarga?>'>
	<? 
  }
 }
 if (isset($_POST["borrar"])) 
 {
  $control = 0;
  foreach ($_POST["adeuda"] as $adeuda) 
  {
   $resu = mysql_query ("SELECT * FROM previas WHERE alumno=$dni order by id");
   WHILE ($rr = mysql_fetch_array($resu)) 
   {
	if ($rr['id']==$adeuda){
 	 if (mysql_query ("DELETE FROM previas WHERE id=$adeuda")) $control++;
	}
   }
  }
  $cantErrores = count($_POST["adeuda"])-$control;
  if ($cantErrores==0)
  {?>
	<script>
	var answer=alert("Datos Grabados Correctamente")
	</script>
	<meta http-equiv='refresh' content='0; URL=<?=$url_recarga?>' >
	<? 
  }
  else 
  {?>
	<script>
	var answer=alert("Hubo errores al grabar los cambios")
	</script> 
	<meta http-equiv='refresh' content='0; URL=<?=$url_recarga?>'>
	<? 
  }*/
  
  
 }
		
}


?>
</html>
<? 
} ?>
