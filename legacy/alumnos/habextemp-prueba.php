<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexioncalif.php';
$conexion = conectarcalif ();
$usuario=$_SESSION['usuario'];

$instancia = 4;

$cursox= (isset($_GET['curso']) ? $_GET['curso'] : false);
$cursox= (isset($_POST['curso']) ? $_POST['curso'] : $cursox);


//Nombre de cursos
$cursosHabilitados = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by descripcion ASC,curso ASC,division ASC");
$cursosTodos = "";
while ($cursoH = mysql_fetch_assoc($cursosHabilitados)) {
	$cursosTodos[$cursoH['idcurso']] = $cursoH['descripcion'];
	if ($cursox == $cursoH['idcurso']) {
		$curso =  $cursoH['curso'];
		$division = $cursoH['division'];
	}
}

if (isset($_POST["submitx"])) //habilita la carga para cada materia
{
 $insertadas = [];
 $habilitar=$_POST['habilitar'];
 $finPlazo = date("Y-m-d H:i:s",strtotime("+6 hours"));

 foreach ($habilitar AS $idmat) {
	 $q_habilitar = "INSERT INTO `plazoscarga`(`desde`, `hasta`, `instancia`, `curso`, `division`, `materia`, `quien`) VALUES (CURRENT_TIMESTAMP(),'$finPlazo','$instancia','$curso','$division','$idmat','$usuario')";
	 $insertadas[] = (mysql_query($q_habilitar) ? $idmat : 0);
 }

}



//Instancia a habilitar
$q_instancia = "SELECT * FROM `calificaciones` WHERE `id` = ".$instancia;
$_instancia = mysql_query($q_instancia);
while($_inst = mysql_fetch_assoc($_instancia)) $nomInstancia = [$_inst['abreviado'],$_inst['obs']];

//Ya habilitadas
$inicioPlazo = date("Y-m-d 23:59:59");

$q_habilitadas = "SELECT * FROM `plazoscarga` WHERE desde < '".$inicioPlazo."'  AND `hasta` > CURRENT_TIMESTAMP() AND `instancia` = ".$instancia." AND `curso` = '" . $curso . "' AND `division` = '" . $division . "'";
$habilitadas = mysql_query($q_habilitadas);
$habHasta = [];
while ($h = mysql_fetch_assoc($habilitadas)) $habHasta[$h['materia']] = $h['hasta'];

$espDeSecc = NULL;
$result79 = mysql_query ("SELECT m.descripcion,mc.idcurso,mc.idmateria FROM matcur mc, materias m WHERE mc.idmateria=m.idmateria AND mc.idcurso='$cursox' AND mc.idmateria!=65");
while ($fila79 = mysql_fetch_array($result79)) $espDeSecc[] = $fila79;

?>
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Habilitar materias a cargar para <?=$nomInstancia[0]?> fuera de plazo</title>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>

<img src="header.jpg" alt="SID" style="vertical-align:bottom; display: block; margin-left: auto; margin-right: auto;">
</head>
<body >
<div style="max-width: 980px; margin: auto">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
<div style="margin: auto; padding:5px; width: 80%">
<form method="GET" id="cur" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<p align="left" class="text1b">Habilitar carga de <?=$nomInstancia[1]?> para:
<select form="cur" name="curso" onchange='this.form.submit()'>
<?PHP
foreach($cursosTodos AS $idc => $descc) printf("<option value='%s' %s>%s</option>",$idc,(($idc==$cursox)? "selected": ""),$descc);
?>
</select><input form="cur" type="submit" value="Cambiar" name="submitcurso"></p><p></p><br>
</form>
</div>

 <?PHP if($cursox) { ?> <div align="center">
 <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
 <br><br>

<div align="center">

<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<th bgcolor="#EAEAEA" align="center"><b>Materia</b></th>
		<th bgcolor="#EAEAEA" align="center"><b>Habilitar</b></th>
	</tr>

<?php
foreach($espDeSecc AS $espCurric) {
	$finPlazo = (array_key_exists($espCurric['idmateria'],$habHasta) ? "checked disabled title='Habilitado hasta " . date("d/m H:i",strtotime($habHasta[$espCurric['idmateria']])) . "'" : "");

	?>
<tr>
	<td bgcolor='#EAEAEA' align='center'><?=$espCurric['descripcion']?></td>
	<td bgcolor='#EAEAEA' align='center'><input type="checkbox" name="habilitar[]" value="<?=$espCurric['idmateria']?>" <?=$finPlazo?>><!-- <?=$finPlazo?> -->
	</td>
</tr>
<?PHP
		}

	?>


<input name="curso" type="hidden" value ="<?=$cursox?>"/>



						<tr>
							<td width="895" height="100" bgcolor="#EAEAEA" align="center" colspan="7">
							<br>
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:1000; float:center width:500px; height:125px; " /></td>

						</tr>


	</table></div>
					<p align="right">&nbsp;</div>
					<?PHP }
					else { ?>
	<div><h2>Seleccionar curso para habilitar la modificaci&oacute;n y carga fuera de plazo</h2></div><br>
	<?PHP } ?>
				<?
include 'footer.php';
?>
			</div>
	</form>
</body><!-- <? // echo var_export(mysql_num_rows($habilitadas),true); ?> -->
</html>

<?PHP }
	else {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
} ?>
