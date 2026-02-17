<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('legal');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();

$alumno=$_GET["alumno"];


$anio=date("Y");


$resEmp2 = mysql_query ("SELECT * FROM alumno WHERE dni = $alumno");
$totEmp2 = mysql_num_rows($resEmp2);




$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
$ixx2++;

	$data2[] = array_merge($datatmp2, array('numero'=>$ixx2));
}

$titles2 = array(


				'dni'=>'<b>DNI</b>',
				'apellido'=>'<b>Apellido</b>',
				'nombre'=>'<b>Nombre</b>',
				'f_nac'=>'<b>F_Nac</b>',
				'ciudad'=>'<b>Ciudad</b>',
				'provincia'=>'<b>Provincia</b>',
				'pais'=>'<b>Pais</b>',
				'domicilio'=>'<b>Domicilio</b>',
				'tel'=>'<b>Tel</b>',

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550,
				'fontSize' => 8
			);



$resEmp3 = mysql_query ("SELECT * FROM alu_fami,familiares WHERE alu_fami.alumno = $alumno and alu_fami.tipo='P' AND alu_fami.familiar=familiares.dni");
$padre = mysql_num_rows($resEmp3);
$totEmp3 = mysql_num_rows($resEmp3);




$ixx2 = 0;
while($datatmp3 = mysql_fetch_assoc($resEmp3)) { 
$ixx2++;

	$data3[] = array_merge($datatmp3, array());
}

$titles3 = array(


				'dni'=>'<b>DNI</b>',
				'apellido'=>'<b>Apellido</b>',
				'nombre'=>'<b>Nombre</b>',
				'domicilio'=>'<b>Domicilio</b>',
				'tel'=>'<b>Tel</b>',
				'trabajo'=>'<b>Trabajo</b>',
				'tel_trabajo'=>'<b>Tel Trabajo</b>',
				'email'=>'<b>Email</b>',

			);
$options3 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550,
				'fontSize' => 8
			);



$resEmp4 = mysql_query ("SELECT * FROM alu_fami,familiares WHERE alu_fami.alumno = $alumno and alu_fami.tipo='M' AND alu_fami.familiar=familiares.dni");
$madre = mysql_num_rows($resEmp4);
$totEmp4 = mysql_num_rows($resEmp4);





while($datatmp4 = mysql_fetch_assoc($resEmp4)) { 


	$data4[] = array_merge($datatmp4, array());
}

$titles4 = array(


				'dni'=>'<b>DNI</b>',
				'apellido'=>'<b>Apellido</b>',
				'nombre'=>'<b>Nombre</b>',
				'domicilio'=>'<b>Domicilio</b>',
				'tel'=>'<b>Tel</b>',
				'trabajo'=>'<b>Trabajo</b>',
				'tel_trabajo'=>'<b>Tel Trabajo</b>',
				'email'=>'<b>Email</b>',

			);
$options4 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550,
				'fontSize' => 8
			);

$resEmp5 = mysql_query ("SELECT * FROM alu_fami,familiares WHERE alu_fami.alumno = $alumno and alu_fami.tipo='T' AND alu_fami.familiar=familiares.dni");
$tutor = mysql_num_rows($resEmp5);
$totEmp5 = mysql_num_rows($resEmp5);





while($datatmp5 = mysql_fetch_assoc($resEmp5)) { 


	$data5[] = array_merge($datatmp5, array());
}

$titles5 = array(


				'dni'=>'<b>DNI</b>',
				'apellido'=>'<b>Apellido</b>',
				'nombre'=>'<b>Nombre</b>',
				'domicilio'=>'<b>Domicilio</b>',
				'tel'=>'<b>Tel</b>',
				'trabajo'=>'<b>Trabajo</b>',
				'tel_trabajo'=>'<b>Tel Trabajo</b>',
				'email'=>'<b>Email</b>',

			);
$options5 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550,
				'fontSize' => 8
			);


$resEmp6 = mysql_query ("SELECT otitis, celiaco,tos_convulsa,bronquitis,asma,diabetes,reumatismo, hernias FROM ficha_salud where alumno=$alumno");
$totEmp6 = mysql_num_rows($resEmp6);





while($datatmp6 = mysql_fetch_assoc($resEmp6)) { 


	$data6[] = array_merge($datatmp6, array());
}

$titles6 = array(


				'otitis' =>'<b>Otitis</b>',
				'tos_convulsa'=>'<b>Tos convulsa</b>',
				'hernias'=>'<b>Hernias</b>',
				'diabetes'=>'<b>Diabetes</b>',
				'celiaco' =>'<b>Celiaco</b>',
				'bronquitis'=>'<b>Bronquitis</b>',
				'asma'=>'<b>Asma</b>',
				'reumatismo'=>'<b>Reumatismo</b>',


			);
$options6 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550,
				'fontSize' => 8
			);


$resEmp7 = mysql_query ("SELECT  epilepsia,tiroides,meningitis,hepatitis,cardio,alteraciones_columna,sinusitis,neurologicos FROM ficha_salud where alumno=$alumno");
$totEmp7 = mysql_num_rows($resEmp7);





while($datatmp7 = mysql_fetch_assoc($resEmp7)) { 


	$data7[] = array_merge($datatmp7, array());
}

$titles7 = array(


				'epilepsia' =>'<b>Epilepsia</b>',
				'meningitis'=>'<b>Meningitis</b>',
				'cardio'=>'<b>Cardiopatía</b>',
				'sinusitis'=>'<b>Sinusitis</b>',
				'tiroides' =>'<b>Problemas de tiroides</b>',
				'hepatitis'=>'<b>Hepatitis</b>',
				'alteraciones_columna'=>'<b>Alteraciones de la columna</b>',
				'neurologicos'=>'<b>Problemas Neurológicos</b>',


			);
$options7 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550,
				'fontSize' => 8
			);



$txttit34 = "<b>FICHA DE SALUD</b>";

$fechaDMA = date('d-m-Y');


$pdf->ezImage("ficha-salud.jpg", 0, 500, 'none','');
//$pdf->ezText($txttit34, 11,array('justification'=>'center'));
//$pdf->ezText("\n", 8);



$pdf->ezText("DATOS DEL ALUMNO", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText(" ");

if ($padre > 0) { 
		$pdf->ezText("DATOS DEL PADRE", 8,array('justification'=>'left'));
		$pdf->ezText(" ");
		$pdf->ezTable($data3, $titles3, '', $options3);
		}
if ($madre > 0) { 
		$pdf->ezText(" ");
		$pdf->ezText("DATOS DE LA MADRE", 8,array('justification'=>'left'));
		$pdf->ezText(" ");
		$pdf->ezTable($data4, $titles4, '', $options4);
		}
if ($tutor > 0) {
		$pdf->ezText(" ");
		$pdf->ezText("DATOS DEL TUTOR O APODERADO", 8,array('justification'=>'left'));
		$pdf->ezText(" ");
		$pdf->ezTable($data5, $titles5, '', $options5);
		}
$pdf->ezText(" ");


$resEmpy = mysql_query ("SELECT  * FROM ficha_salud where alumno=$alumno");
$totEmpy = mysql_fetch_array($resEmpy);

$pdf->ezText("ENFERMEDADES QUE PADECE O PADECIÓ (0 = no / 1 = Padece / 2 = Padeció)", 9,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezTable($data6, $titles6, '', $options6);
$pdf->ezText(" ");
$pdf->ezTable($data7, $titles7, '', $options7);
$pdf->ezText(" ");
$pdf->ezText("Otras: " .$totEmpy[otras]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("ANTECEDENTES DE INTERES", 9,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("¿Se encuentra actualmente bajo tratamiento medico?, ¿cual?: " .$totEmpy[tratamiento_medico]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("¿Toma alguna medicacion?, ¿cual?: " .$totEmpy[medicacion]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("¿Operaciones?: " .$totEmpy[operaciones]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("Traumatismos/fracturas: " .$totEmpy[fracturas]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("¿Tiene problemas de coagulacion?: " .$totEmpy[coagulacion]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("¿Usa anteojos?: " .$totEmpy[anteojos]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("¿Alergias?: " .$totEmpy[alergias]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("¿Curso o cursa algun embarazo?: " .$totEmpy[embarazo]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("Ingrese el grupo sanguineo y factor: " .$totEmpy[gsanguineo]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("¿Tiene hijos?, ¿cuantos?, ¿edades?: " .$totEmpy[hijos]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezText("¿Tiene certificado de discapacidad?: " .$totEmpy[discapacidad]."", 8,array('justification'=>'left'));
$pdf->ezText(" ");	
$pdf->ezText("Declaro que los datos consignados en la presente ficha médica tienen carácter de declaración jurada y se ajustan a la realidad. Asimismo me comprometo a mantenerlos actualizados en caso de variar algunos de ellos. 
Sin APTO FÍSICO el alumno/a no podrá cursar las clases de Educación Física, que son obligatorias.
La presente ficha se completará al confirmar la vacante y a la brevedad presentará el Certificado de Salud/Apto Físico, el Certificado de Vacunas Completas y el Certificado Bucodental. Los certificados se renovarán al inicio de cada Ciclo Lectivo.
El/La alumno/a que no cumpla con  este requisito no podrá concurrir a clase, siendo responsabilidad de las familias la suma de las inasistencias. 
Tomo conocimiento y firmo de conformidad:", 6,array('justification'=>'left'));

$pdf->ezText(" ");
$pdf->ezText("__________________________________ ", 6,array('justification'=>'right'));
$pdf->ezText("Firma y aclaración del/la Padre/Madre/Tutor ", 6,array('justification'=>'right'));


$pdf->ezText("\n", 4);
$pdf->ezText("Fecha: " . $fechaDMA."", 6,array('justification'=>'left'));

$pdf->ezText(" ");
$pdf->ezText(" ");
$pdf->ezText(" ");

$pdf->ezText("---------------------------------------------------------------------------------------------------------------------------------------------- ", 10,array('justification'=>'center'));
$pdf->ezText(" ");
$pdf->ezText(" ");
$pdf->ezText(" ");
$pdf->ezText(" ");
$pdf->ezImage("ficha-salud.jpg", 0, 500, 'none','');
	
$pdf->ezText(" ");
$pdf->ezText(" ");
$pdf->ezText("Sin APTO FÍSICO el alumno/a no podrá cursar las clases de Educación Física, que son obligatorias.
La presente ficha se completará al confirmar la vacante y a la brevedad presentará el Certificado de Salud/Apto Físico, el Certificado de Vacunas Completas y el Certificado Bucodental.
Los certificados se renovarán al inicio de cada Ciclo Lectivo.
El/La alumno/a que no cumpla con  este requisito no podrá concurrir a clase, siendo responsabilidad de las familias la suma de las inasistencias. 
Recuerde revisar periódicamente los DNI para corroborar su vencimiento.", 8,array('justification'=>'left'));





$pdf->ezStream();
?>






