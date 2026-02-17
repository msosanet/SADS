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


$resEmp6 = mysql_query ("SELECT * FROM cursa where alumno=$alumno and anio='$anio' and control=1");
$totEmp6 = mysql_num_rows($resEmp6);





while($datatmp6 = mysql_fetch_assoc($resEmp6)) { 


if ($datatmp6[modalidad]==1)
			{
			$modalidad="Ciclo Básico Bachiller";
			$turno="Mañana";
			}

if ($datatmp6[modalidad]==2)
			{
			$modalidad="Ciclo Básico Modalidad Técnica";
			$turno="Tarde";
			}





	$data6[] = array_merge($datatmp6, array('tur'=>$turno,'mod'=>$modalidad));
}

$titles6 = array(


				'curso' =>'<b>CURSO</b>',
				'tur'=>'<b>TURNO</b>',
				'mod'=>'<b>MODALIDAD</b>',


			);
$options6 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550,
				'fontSize' => 8
			);

$resEmp7 = mysql_query ("SELECT escuela,localidad_esc,grado FROM alumno WHERE dni = $alumno ");
$totEmp7 = mysql_num_rows($resEmp7);

$ixx3=" ";
$ixx4=" ";
$ixx5=" ";
$ixx6=" ";

while($datatmp7 = mysql_fetch_assoc($resEmp7)) { 


	$data7[] = array_merge($datatmp7, array());
}

$titles7 = array(


				'escuela' =>'<b>Escuela Nº</b>',
				'localidad_esc'=>'<b>Localidad</b>',
				'grado'=>'<b>Grado/Año</b>',



			);
$options7 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550,
				'fontSize' => 8
			);


$resEmp8 = mysql_query ("SELECT * FROM documentacion ");
$totEmp8 = mysql_num_rows($resEmp8);

$uno=0;
$dos=0;
$tres=0;
$cuatro=0;

while($datatmp8 = mysql_fetch_assoc($resEmp8)) { 



$resEmp9 = mysql_query ("SELECT * FROM docu_alu WHERE alumno = $alumno and id = $datatmp8[id]");
$tiene = mysql_num_rows($resEmp9);


if ($tiene > 0) $ixx3="Presentada";
else $ixx3="Falta";


if ($datatmp8[id]==6 and $tiene > 0)
			{
			$uno=1;
			}
if ($datatmp8[id]==7 and $tiene > 0)
			{
			$dos=1;
			}
if ($uno==1 and $dos==1 and $datatmp8[id]==8){ $ixx3="------"; $tres=1; }

if ($tres==1 and $datatmp8[id]==9) $ixx3="------";


if ($datatmp8[id]==3 and $tiene > 0)
			{
			$cuatro=1;
			}

if ($cuatro==1 and $datatmp8[id]==4) $ixx3="------";

if ($tiene < 1 and $datatmp8[id]==12) $ixx3="------";
if ($tiene < 1 and $datatmp8[id]==18) $ixx3="------";


	$data8[] = array_merge($datatmp8, array('numero'=>$ixx3));
}




$titles8 = array(


				'nombre' =>'<b>Tipo</b>',
				'numero'=>'<b>Estado</b>',



			);
$options8 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550,
				'fontSize' => 8
			);


$txttit34 = "<b>FICHA DE INSCRIPCIÓN</b>";

$fechaDMA = date('d-m-Y');


$pdf->ezImage("ficha.jpg", 0, 500, 'none','');
//$pdf->ezText($txttit34, 11,array('justification'=>'center'));
//$pdf->ezText("\n", 8);

		$pdf->ezTable($data6, $titles6, '', $options6);
		$pdf->ezText(" ");

$pdf->ezText("DATOS DEL ALUMNO", 8,array('justification'=>'left'));
$pdf->ezText(" ");
$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText(" ");
$pdf->ezText("ANTECEDENTES ESCOLARES", 8,array('justification'=>'left'));
$pdf->ezText(" ");
		$pdf->ezTable($data7, $titles7, '', $options7);
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
$pdf->ezText("Los responsables del/la alumno/a, deberan presentar en un plazo de 30 días hábiles contados a partir del día de la fecha, la documentación faltante especificada", 8,array('justification'=>'center'));
$pdf->ezText(" ");
$pdf->ezText("OBSERVACIONES:_________________________________________________________________________", 10,array('justification'=>'left'));

$pdf->ezText(" ");
$pdf->ezText(" ");
$pdf->ezText("_________________________________________________ ", 6,array('justification'=>'center'));
$pdf->ezText("Firma y aclaración del/la Padre/Madre/Tutor ", 8,array('justification'=>'center'));
$pdf->ezText(" ");
$pdf->ezText("---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", 8,array('justification'=>'center'));

$pdf->ezText(" ");
$pdf->ezText("COLEGIO PROVINCIAL DR. JOSE MARíA SOBRAL - DOCUMENTACIÓN PRESENTADA -", 8,array('justification'=>'center'));
$pdf->ezText(" ");
$pdf->ezText("Los responsables del/la alumno/a, deberan presentar en un plazo de 30 días hábiles contados a partir del día de la fecha, la documentación faltante especificada", 6,array('justification'=>'center'));

$pdf->ezText(" ");
$pdf->ezText("Yámanas 1572 (9410) USHUAIA - T.D.F. - Tel. 443792 - 444294 - 444198 - Mail: cpsobral@tierradelfuego.gov.ar", 8,array('justification'=>'center'));

$pdf->ezText("\n", 8);
		$pdf->ezTable($data8, $titles8, '', $options8);



$pdf->ezText("\n", 4);
$pdf->ezText("Fecha de inscripción: " . $fechaDMA."                        Recibió:_______________________________________", 6,array('justification'=>'left'));


$pdf->ezStream();
?>

