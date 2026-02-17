<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<title>Agrega previas</title>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>
</head>
<?
include 'header.php';
?>
<body >

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];

$lista = mysql_query ("SELECT * FROM alumno order by apellido");

$materias_q = mysql_query("SELECT * FROM `materias2023` WHERE idmateria NOT IN (1010,1020,65,58,60,70,76,77,78,79,80,81,82,83,84,85,86) ORDER BY descripcion");

$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos




}
 else
  {
    $flag = 1;
  }

if ($hayerrores OR $flag) {
	$color = "";
	$combo_materias=" <optgroup label='Espacios curriculares'>";
	while ($materia = mysql_fetch_assoc($materias_q)) {
		$nuevaOpt = "<option value='" . $materia['idmateria'] . "'>" . ucwords(strtolower($materia['descripcion'])) . "</option>\n";
		$combo_materias.= $nuevaOpt;
		//Completar el combo
	}
	$combo_materias.= "</optgroup> <optgroup label='Documentación'>";
	$combo_materias.= "<option value='1010'>Certificado Analítico Parcial Legalizado</option>";
	$combo_materias.= "<option value='1020'>Adeuda Calificaciones De 7º Año</option></optgroup>";
?>

<form method="POST" action="previas.php">
<div align="center">
	<table border="0" width="980">
	<thead><tr><th>
<?
include 'snipet_barramenu.php';
?>
	</th></tr></thead>
	<tbody>
				<tr>


					<td>

					<p align="left" class="text1b">Cargar Previas a Alumnos</p>
					<p align="center" class="text1b"><? if($hayerrores) echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcados con color ROJO</font></h4>"; ?></p>
					</td></tr><td><tr>
					<div align="center" >
					<table border="0" id="table1" cellpadding="0" cellspacing="4" bgcolor="#EAEAEA" >
					<thead>
						<tr>
							<th align="left" colspan=3>Estudiante: <select style="border: 1px solid #888888; background-color: #ffffff; border-radius: 5px; padding: 4px 0 4px 0; box-shadow: 0 0 2px #555555;" size="1" name="actor" autofocus>
				<option value="Sin seleccionar" style="color: blue;text-align:center" selected>(seleccionar)</option>
            <?
            	while ($alumno = mysql_fetch_array($lista)) {
					echo "<option value='" . $alumno['dni'] . "'>" . $alumno['apellido'] . " " . $alumno['nombre'] . " - D.N.I. Nº " . $alumno['dni'] . "</option>";
				    }
		    ?>
            </select>
							</th>
						</tr>
						<tr>
						<th>Materia</th>
						<th>A&ntilde;o</th>
						<th>M. E.</th>
						</tr>
						</thead>

<? for ($i=1; $i<=18; $i++) { ?>
						<tr>
							<td align="left"  style="text-align: center">
							<select name="materia[<?=$i?>]">
            <option></option>
							<? echo $combo_materias ?>
							</select>
							</td>
							<td style="text-align: center"><select name="anio[<?=$i?>]">
								<option value=0 selected></option>
								<option value=1>1</option>
								<option value=2>2</option>
								<option value=3>3</option>
								<option value=4>4</option>
								<option value=5>5</option>
								<option value=6>6</option>
								<option value=7>7</option>
								</select>
							</td>
							<td style="text-align: center"><input type="checkbox" name='me[<?=$i?>]' value='<?=$i?>' title="Marque si es un espacio adeudado por Movilidad Estudiantil"></td>

						</tr>
<? } ?>
						<tfoot><tr>
							<td colspan=3>
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr></tfoot>
					</table>
					</div>
					<p align="right">&nbsp;</p>
					</td>
				</tr> </tbody>
	</table>
		</form>
				<?
include 'footer.php';
?>



</div>
</body>
<?
}
else
{
// echo "<!-- " . var_export($_POST,true) . "-->";
 if (is_numeric($_POST['actor'])) { // Estudainte al que se asignan previas
    $alumno = $_POST['actor'];
	$materias = $_POST['materia'];
    $curso = $_POST['anio'];
    $movilidad = $_POST['me'];

	$nomMat = array();
	$agregadas = 0;
	$fallos = 0;

	//Prescindible: ya no se utiliza el nombre de la materia en la tabla previas
	while ($materia = mysql_fetch_assoc($materias_q)) $nomMat[$materia['idmateria']] = ucwords(strtolower($materia['descripcion']));
	$nomMat[1010] = "Certificado Analítico Parcial Legalizado";
	$nomMat[1020] = "Adeuda Calificaciones De 7º Año";

	foreach ($materias AS $indice => $idmateria ){
	 if (is_numeric($idmateria)) { // Debe haber código de materia para alterar la bd
	  if (isset($movilidad[$indice])) $me = 1;
	  else $me = NULL;
	  if ($curso[$indice]>0) { //Si se asignó el año
	   if ($idmateria == 1010 OR $idmateria == 1020) { // ignora añu y movilidad para documentación
	    $curso[$indice] = '';
	    $me = "NULL";
	   }

	   $descripcion = $nomMat[$idmateria] . " " . $curso[$indice];


	   if ($me) $sql = "INSERT INTO previas(`alumno`, `materia`, `idmateria`, `curso`, `movilidad`, `nota`, `observacion`, `fecha_carga`) VALUES ('$alumno','$descripcion',$idmateria,'$curso[$indice]','$me',0,'ADEUDA',CURRENT_DATE())";
	   else $sql = "INSERT INTO previas(`alumno`, `materia`, `idmateria`, `curso`, `movilidad`, `nota`, `observacion`, `fecha_carga`) VALUES ('$alumno','$descripcion',$idmateria,'$curso[$indice]',NULL,0,'ADEUDA',CURRENT_DATE())";
//	   echo "<!-- " . $sql . " -->\n";
	   mysql_query($sql);
	   if (mysql_affected_rows()) $agregadas++;
	   else $fallos++;
	  }
	  elseif ($idmateria == 1010 OR $idmateria == 1020) { // captura para documentación sin año

	   $descripcion = $nomMat[$idmateria];

	   $sql = "INSERT INTO previas(`alumno`, `materia`, `idmateria`, `curso`, `movilidad`, `nota`, `observacion`, `fecha_carga`) VALUES ('$alumno','$descripcion',$idmateria,'',NULL,0,'ADEUDA',CURRENT_DATE())";
//	   echo "<!-- " . $sql . " -->\n";
	   mysql_query($sql);
	   if (mysql_affected_rows()) $agregadas++;
	   else $fallos++;
	  }
	  else $fallos++; //aumenta fallos cuando no se asignó año a materia adeudada
	 }
	}
//	echo "<!-- agregadas: " . $agregadas . " -->\n";
//	echo "<!-- fallos: " . $fallos . " -->\n";
 }
 else echo "<br>Debe seleccionar estudiante";
 if ($agregadas == 0 AND $fallos > 0) $mensaje = "Falló la carga de " . $fallos . " previas";
 if ($agregadas > 0 AND $fallos == 0) $mensaje = "Se agregaron " . $agregadas . " previas";
 if ($agregadas > 0 AND $fallos > 0) $mensaje = "Se agregaron " . $agregadas . " previas y fallaron " . $fallos;
?>
				<script>
				var answer=alert("<?=$mensaje?>")
				</script>
				<meta http-equiv='refresh' content='0; URL=previas.php?'>
<?
}
?>

</html>
<? } ?>

