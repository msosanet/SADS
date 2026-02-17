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
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

<script>
	function autoTabla() {
		let table = new DataTable('#myTable', {
			language: {
				url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-AR.json',
		 },});
		 table.order([[3, 'asc'], [0,'desc']]).draw();
	}
</script>

<title>Ver Notificaciones</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
?>

<!--<body onload="autoTabla()">-->
<body>
<div align="center">

<table border="0" width="980" bgcolor="#F9F9F9">
	<tr>
		<td><div align="center">

<?if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';

$viejas=0;
$descripcion= (isset($_GET['descripcion']) ? $_GET['descripcion'] : "");

$historial=(isset($_GET['viejas']) ? $_GET['viejas'] : "");

$marcadoHist = (isset($_GET['viejas']) ? checked : "");

?>
	</tr>
	<tr>
	<table border="0" width="905" cellpadding="5">
		<tr>
			<td><br><p class="titles1">Buscar Notificaci&oacute;n</p>
				
				
					<p>&nbsp;</p>
					<p>Ingrese texto de b&uacute;squeda: <input type="text" name="descripcion" id="descripcion" size="50" maxlength="50" value="" /><input type="submit" value="   Buscar   " name="muestra2"> <!-- style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" / --></p>
				
					
					<!-- p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p -->
					<p align="left">&nbsp;</p>

<!-- /font -->
<?



$q_notificaciones="SELECT * FROM notificaciones WHERE descripcion like '%$descripcion%' or codigo like '%$descripcion%' order by anio DESC,codigo desc";
$r_notificaciones = mysql_query($q_notificaciones);


?>

<p class="titles1" align="left">

<!-- br><br -->
</p>
<p>&nbsp;</p>
		<div align="center">
		<table  id="myTable" border="1" width="850" cellpadding="15" cellspacing="0" bordercolor="#C0C0C0">
			<thead>
				<tr>
					<td width="20" bgcolor="#808080" align="center" height="36">N&uacute;mero</td>
					<td bgcolor="#808080" width="400" align="center" height="36">Descripci&oacute;n</td>
					<td bgcolor="#808080" width="50" align="center" height="36">Registr&oacute;</td>
					<td bgcolor="#808080" width="50" align="center" height="36">Año</td>
					<td bgcolor="#808080" width="50" align="center" height="36">Modificar</td>
					<td bgcolor="#808080" width="50" align="center" height="36">Archivo</td>
				</tr>
			</thead>
			<tbody>
			
				
			
<?php while ($fila2 = mysql_fetch_array($r_notificaciones))
{	
?> 
				
				
				
				
				
				
				<tr>
					<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2['codigo']."/".$fila2['anio'];?></td>
					<td width="20" bgcolor="#EAEAEA" align="left"><?echo $fila2['descripcion'];?></td>
					<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2['agente'];?></td>
					<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2['anio'];?></td>
					<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="modif_notificacion.php?nota=<?php echo $fila2['id']?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Modificar Nota"></a></td>
				

				<form method="POST" action="upload.php" enctype="multipart/form-data">
		        			<? if (is_null($fila2[path]) OR empty($fila2[path]))
								{
							?> 		<td bgcolor="#EAEAEA" align="center"><?//echo $fila2[id];?><input type="file" name="elarchivo" style="width: 139px;">
									<input type="hidden" name="idregistro" value="<?php echo $fila2['id']; ?>">
									<input type="hidden" name="tiporegistro" value="NF">
									<input type="submit" value="Subir" name="Subir"></td>
							<? }
							 else
								{?>
								<td bgcolor="#EAEAEA" align="center"><a href="verdoc.php?id=<?echo $fila2[id];?>&es=NF" target="_blank"><img src="images/archivopdf.png" width="40" height="40" title="adjunto" alt="si"></a></td>
								<?
								
								}		
								?>
							
				</tr>
				</form>



<?
}
?>
		</tbody></table>
		</div>				
	</tr>
</table>
</div>
<p>&nbsp;</p>
<?
include 'footer.php';
?>

	</td>
	</tr>
</table>
</div>

</form>

</div>

</body>

</html>
<? } ?>
