<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />

<style>
#constancia {
  font-family: Arial, sans-serif;
  font-size: 12px;
  border: 2px solid black;
}
</style>

<title>Constancia de &uacute;ltimo a&ntilde;o</title>

</head>

<?
include 'header.php';
$conexion = conectar ();
$alumno=$_GET["dni"];

	$q_datosPers = "SELECT * FROM `alumno` WHERE `dni`= $alumno";
//	$q_materias = "SELECT `materia` FROM `previas` WHERE `alumno` = $alumno";
	//para obtener modalidad
	$q_modalidad = "SELECT `modalidad` FROM `cursa` WHERE `alumno` = $alumno AND `curso` = 6 ORDER BY `fecha` DESC";
	$modalidad_ = mysql_query($q_modalidad);
	$orientacion_ = mysql_fetch_assoc($modalidad_);
	
	$q_nomMat = "SELECT * FROM `materias2023`";
	$__nomMat = mysql_query($q_nomMat);
	$nomMat = [];
	while ($_mat = mysql_fetch_assoc($__nomMat)) $nomMat[$_mat['idmateria']] = $_mat['descripcion'];
	
	$datosPers= mysql_query($q_datosPers);
	$persona = mysql_fetch_assoc($datosPers);

	$q_orientacion = mysql_query("SELECT * FROM `plan` WHERE `id` = $orientacion_[modalidad]");
	$ori_alu = mysql_fetch_assoc($q_orientacion);
	$q_adeudadas = mysql_query("SELECT * FROM `previas` WHERE `alumno` = $alumno AND `nota`<6");
	
	if(mysql_num_rows($q_adeudadas)>1) {
		$mat_ = mysql_fetch_assoc($q_adeudadas);
		$materias_pendientes = "adeudando los siguientes espacios: ". ucwords(strtolower($nomMat[$mat_['idmateria']])) . " " . $mat_['curso'] . "°";
		for($i = 2; $i < mysql_num_rows($q_adeudadas); $i++){
			$mat_ = mysql_fetch_assoc($q_adeudadas);
			$materias_pendientes = $materias_pendientes .  ", " . ucwords(strtolower($nomMat[$mat_['idmateria']])) . " " . $mat_['curso'] . "°";
		}
		$ult_mat = mysql_fetch_assoc($q_adeudadas);
		$materias_pendientes = $materias_pendientes . " y " . ucwords(strtolower($nomMat[$ult_mat['idmateria']])) . " " . $ult_mat['curso'] . "°" . " a&ntilde;o.";
	}
	if (mysql_num_rows($q_adeudadas)==1) {
		$mat_ = mysql_fetch_assoc($q_adeudadas);
		$materias_pendientes = "adeudando el espacio: " . ucwords(strtolower($nomMat[$mat_['idmateria']])) . " " . $mat_['curso'] . "°" . " a&ntilde;o.";
	}
	if (mysql_num_rows($q_adeudadas)==0) $materias_pendientes = "sin adeudar espacios curriculares.";
		
	
	if($persona['sexo']== "F" || $persona['sexo']== "f") {
		$comienzoOracion = "la alumna ";
		$nac_con_genero = "nacida en ";
	}
	else {
		$comienzoOracion = "el alumno ";
		$nac_con_genero = "nacido en ";
	}
	
	$personales = $comienzoOracion . "<b>" . $persona['apellido'] . ", " . $persona['nombre'] . "</b>" . " con D. N. I. Nº " . number_format($persona['dni'],0,",",".") .  ", " . $nac_con_genero . $persona['ciudad'] . ", " . $persona['provincia'];
	
	$cursadaF = ", finaliz&oacute; en este Establecimiento la cursada Regular del &uacute;ltimo a&ntilde;o de la Educaci&oacute;n Secundaria correspondiente a los estudios conducentes al Certificado / T&iacute;tulo de ";
	
	$cursando = ", cursa regularmente en este Establecimiento el &uacute;ltimo a&ntilde;o de la Educaci&oacute;n Secundaria, correspondiente a los estudios conducentes al Certificado / T&iacute;tulo de ";
	
	$certificado1 = ", obtuvo el certificado / t&iacute;tulo de ";
	
	$certificado2 = ", cuyo T&iacute;tulo Final se encuentra en tr&aacute;mite. <b>NO ADEUDANDO Espacio Curricular. (Resolución CFE Nº 59/08 Cap&iacute;tulo I – c) Legalizaciones).</b><br>Plan de Estudios Provincial aprobado por: ";
	
	$parrafo['constF'] = $personales . $cursadaF . "\n" . $ori_alu['descripcion'] . ", " . $materias_pendientes;
	
	$parrafo['constC'] = $personales . $cursando . "\n" . $ori_alu['descripcion'] . "."; 
	
	$parrafo['titTram'] = $personales . $certificado1 . $ori_alu['descripcion'] . $certificado2 . $ori_alu['reso'] . "."; 
	
	$parrafo['resol'] = $ori_alu['reso'] ;



$texto_constancia = $parrafo;

// printf("<!-- %s -->",var_export($nomMat,true));
?>

<body>

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
			<table border="0" width="980">
			<caption>Texto para copiar y añadir a la constancia:</caption>
			<tr><td colspan="2">Finalizaci&oacute;n:&nbsp;<br></td></tr>
			<tr>
				<td width="80%">
					<p id="constFin" style="constancia" onclick='alPortapapeles("constFin")'><?=$texto_constancia['constF']; ?></p>
				</td>
				<td width="20%">
					<? echo $texto_constancia['resol'];?>
					<br><button type="button" id="copyBtn" onclick='alPortapapeles("constFin")'>Copiar texto</button>
				</td>
			</tr>
			<tr><td colspan="2">Cursando:&nbsp;<br></td></tr>
			<tr>
				<td width="80%">
					<p id="constCur" onclick='alPortapapeles("constCur")' style="constancia"><?=$texto_constancia['constC']?></p>
				</td>
				<td width="20%">
					<br><button type="button" id="copyBtn" onclick='alPortapapeles("constCur")'>Copiar texto</button>
			</tr>
			<tr><td colspan="2">Certificado / t&iacute;tulo en tr&aacute;mite:&nbsp;</td></tr>
			<tr>
				<td width="80%">
					<p id="constCert" onclick='alPortapapeles("constCert")' style="constancia"><?
//					$texto_constancia = adeMateria($actor); 
					echo $texto_constancia['titTram']; 
					?></p>
				</td>
				<td width="20%">
					<br><button type="button" id="copyBtn" onclick='alPortapapeles("constCert")'>Copiar texto</button>
			</tr>
<script>
function alPortapapeles(textoConstancia) {
	const constancia = document.getElementById(textoConstancia);
	const type = "text/html";
	const blob = new Blob([constancia.innerHTML], { type });
	const data = [new ClipboardItem({ [type]: blob })];
	navigator.clipboard.write(data);
}
 /*     document.getElementById("copyBtn")
        .onclick = function() {
          let textoAcopiar = document.getElementById("constFin").innerHTML;
          navigator.clipboard.writeText(textoAcopiar)
            .then(() => {
              alert('Text copied to clipboard');
          })
            .catch(err => {
              alert('Error in copying text: ', err);
            });
        }
function alPortapapeles() {
          let text = document.getElementById("constFin").innerText;
          navigator.clipboard.writeText(text);
}*/
    </script>

			
			</table>
			</div>
			</td>
		</tr>
</table></div>
</body>
</html>
<? } 
?>

