<?php
session_start();
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion3.php';
$conexion = conectar ();

$curso=$_GET["curso"];
$div=$_GET["div"];

if (isset($_GET['cl']) AND $_GET['cl']!='') {$anio=$_GET['cl']; $control = 0;}
else {$anio = $_SESSION['cicloLectivo']; $control = 1;}



$resEmp2 = mysql_query ("SELECT alumno.dni,CONCAT(alumno.apellido, ', ',alumno.nombre) AS alumno FROM `cursa` LEFT JOIN alumno ON cursa.alumno = alumno.dni WHERE cursa.curso = '$curso' AND cursa.divi = '$div' and cursa.anio = '$anio' AND cursa.control= '$control' ORDER BY alumno");
$totEmp2 = mysql_num_rows($resEmp2);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
$ixx2++;

	$data2[] = array_merge($datatmp2, array('numero'=>$ixx2));
}

$titles2 = array(
				'numero'=>'<b>N°</b>',
				'dni'=>'<b>DNI</b>',
				'alumno'=>'<b>Alumno</b>',



				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);




$txttit34 = "<b>LISTADO DE TODOS LOS ALUMNOS DEL CURSO: ".$curso ." DIV: ".$div."</b>";
$txttit34 = mb_convert_encoding($txttit34, "ISO-8859-1", "UTF-8");
$fechaDMA = date('d-m-Y');






$pdf->ezImage("logo4.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);

$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText("",10,array('justification'=>'left'));
$pdf->ezText("Fecha de impresión: " . $fechaDMA, 10,array('justification'=>'left'));


$pdf->ezStream();
?>
