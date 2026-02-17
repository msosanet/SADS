<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('A4');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();

$curso=$_GET["curso"];
$div=$_GET["div"];
$fecha = $_GET["fecha"];
$fecha2 = $_GET["fecha2"];
$edad = date_diff(date_create($fecha),date_create(date("Y-m-d")));
$edad2 = date_diff(date_create($fecha2),date_create(date("Y-m-d")));


$anio=date("Y");

$resEmp2 = mysql_query ("SELECT alumno.apellido,alumno.nombre,alumno.dni,alumno.f_nac FROM alumno,cursa WHERE alumno.f_nac BETWEEN '$fecha' AND '$fecha2' AND cursa.control = 1 AND cursa.anio = '$anio' AND alumno.dni = cursa.alumno AND cursa.divi='$div' AND cursa.curso='$curso' ORDER BY alumno.apellido,alumno.nombre");
$totEmp2 = mysql_num_rows($resEmp2);


// $ixx2 = 0; // Para numerar filas
while($datatmp2 = mysql_fetch_assoc($resEmp2)) {
//	$ixx2++;
//	$data2[] = array_merge($datatmp2);
	$edad_e = date_diff(date_create($datatmp2[f_nac]),date_create(date("Y-m-d")));
	$datatmp2[edad] = $edad_e->format("%y");
	$datatmp2[eb] = "";
	$datatmp2[f_nac] = date("d/m/Y", strtotime($datatmp2[f_nac]));
	$datatmp2[dni] = number_format($datatmp2[dni],0,",",".");
	$datatmp2[apellido] = strtoupper($datatmp2[nombre]);
	$datatmp2[nombre] = ucwords(strtolower($datatmp2[nombre]));

	$data2[] = $datatmp2;
}

$titles2 = array(
//				'numero'=>'<b>Nº</b>',
				'apellido'=>'<b>Apellido</b>',
				'nombre'=>'<b>Nombre</b>',
				'dni'=>'<b>DNI</b>',
				'f_nac'=>'<b>F. de Nacimiento</b>',
				'edad'=>'<b>Edad</b>',
				'eb'=>'<b>Observación</b>',



				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);


$fecha_edades = date('d/m/Y',strtotime($fecha));

if (is_numeric($div)) {
	$txttit34 = "<b>Estudiantes de ".$curso ."º ".$div."a con entre " .$edad2->format("%y"). " y " .$edad->format("%y"). " años cumplidos a la fecha</b>";
}
else {
	$txttit34 = "<b>Estudiantes de: ".$curso ."º ".$div." con entre " .$edad2->format("%y"). " y " .$edad->format("%y"). " años cumplidos a la fecha</b>";
}
$fechaDMA = date('d-m-Y');






$pdf->ezImage("logo4.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 15,array('justification'=>'center'));


$pdf->ezText("\n", 10);

$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText(" ");
$pdf->ezText("Fecha de impresión: " . $fechaDMA, 10,array('justification'=>'left'));


$pdf->ezStream();
?>
