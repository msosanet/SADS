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
$actor=$_GET["dni"];

function adeMateria($alumno){
	$q_datosPers = "SELECT * FROM `alumno` WHERE `dni`= $alumno";
	$q_materias = "SELECT `materia` FROM `previas` WHERE `alumno` = $alumno";
	//para obtener modalidad
	$q_modalidad = "SELECT `modalidad` FROM `cursa` WHERE `alumno` = $alumno AND `curso` = 6 ORDER BY `fecha` DESC";
	$modalidad_ = mysql_query($q_modalidad);
	$orientacion_ = mysql_fetch_array($modalidad_);
	
	$datosPers= mysql_query($q_datosPers);
	$persona = mysql_fetch_array($datosPers);

	$q_orientacion = mysql_query("SELECT * FROM `plan` WHERE `id` = $orientacion_[modalidad]");
	$ori_alu = mysql_fetch_array($q_orientacion);
	$q_adeudadas = mysql_query("SELECT `materia` FROM `previas` WHERE `alumno` = $alumno AND `nota`<6");
	
	if(mysql_num_rows($q_adeudadas)>1) {
		$mat_ = mysql_fetch_array($q_adeudadas);
		$materias_pendientes = "adeudando los siguientes espacios: ". $mat_['materia'];
		for($i = 2; $i < mysql_num_rows($q_adeudadas); $i++){
			$mat_ = mysql_fetch_array($q_adeudadas);
			$materias_pendientes = $materias_pendientes .  ", " . $mat_['materia'];
		}
		$ult_mat = mysql_fetch_array($q_adeudadas);
		$materias_pendientes = $materias_pendientes . " y " . $ult_mat['materia'] . " a&ntilde;o.";
	}
	if (mysql_num_rows($q_adeudadas)==1) {
		$mat_ = mysql_fetch_array($q_adeudadas);
		$materias_pendientes = "adeudando el espacio: " . $mat_['materia'] . " a&ntilde;o.";
	}
	if (mysql_num_rows($q_adeudadas)==0) {
		$materias_pendientes = "sin adeudar espacios curriculares.";
	}
		
	
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
	return $parrafo;
}

  
if (true) {
?>

<body>
<!-- <form method="GET" action="const_final.php?actor=<?// echo $actor; ?>"> -->

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
			<table border="0" width="980">
			<tr>Texto para copiar y añadir a la constancia:
			<!--	<button type="button" id="copyBtn" onclick="">Copiar texto</button> 
			 <p>el alumno <b> CANO, Lourdes Sabrina Natalia </b> con D.N.I. Nº 43.509.137, nacido en Mar del Plata, Buenos A, finaliz&oacute; en este Establecimiento la cursada Regular del &uacute;ltimo a&ntilde;o de la Educaci&oacute;n Secundaria correspondiente a los estudios conducentes al Certificado / T&iacute;tulo de C.O. E.S.O. Bachiller en Ciencias Naturales, adeudando las siguientes materias: Pr&aacute;c. Del Leng. 5º, Matem&aacute;tica 6º, Leng. Art&iacute;sticos 6º, Astronom. y Astrof. 6º a&ntilde;o.</p> -->
			</tr>
			<tr><td>Finalizaci&oacute;n:&nbsp;<br></td></tr>
			<tr>
				<td width="80%">
					<p id="constFin" style="constancia"><?
						$texto_constancia = adeMateria($actor); 
						echo $texto_constancia['constF']; 
					?></p>
				</td>
				<td width="20%">
					<? echo $texto_constancia['resol'];?>
				</td>
			</tr>
			<tr><td>Cursando:&nbsp;<br></td></tr>
			<tr>
				<td width="80%">
					<p id="constCur" onclick="alPortapapeles" style="constancia"><?=$texto_constancia['constC']?></p>
				</td>
			</tr>
			<tr><td>Certificado / t&iacute;tulo en tr&aacute;mite:&nbsp;<br></td></tr>
			<tr>
				<td width="80%">
					<p id="constCur" onclick="alPortapapeles" style="constancia"><?
//					$texto_constancia = adeMateria($actor); 
					echo $texto_constancia['titTram']; 
					?></p>
				</td>
			</tr>
			<script>
      document.getElementById("copyBtn")
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
}
    </script>

			
			</table>
			</div>
			</td>
		</tr>
</table></div>
<!-- </form>  -->
</body>
<?
}

?>
</html>
<? } 
?>
