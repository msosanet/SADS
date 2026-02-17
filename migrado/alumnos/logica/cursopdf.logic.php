<?php
session_start();
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();

$curso=$_GET["curso"];
$div=$_GET["div"];

if (isset($_GET['cl']) AND $_GET['cl']!='') {$anio=$_GET['cl']; $control = 0;}
else {$anio = $_SESSION['cicloLectivo']; $control = 1;}


//$anio=date("Y");
//$anio=date("2021");
//$resEmp2 = mysql_query ("SELECT * FROM alumno,cursa WHERE cursa.curso = '$curso' and cursa.divi = '$div' and cursa.alumno=alumno.dni and cursa.anio='$anio'and cursa.control=1 order by alumno.apellido");
$resEmp2 = mysql_query ("SELECT * FROM cursa,alumno WHERE cursa.curso = '$curso' and cursa.divi = '$div' and cursa.anio='$anio' and cursa.control=$control and cursa.alumno=alumno.dni order by alumno.apellido");
$totEmp2 = mysql_num_rows($resEmp2);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
$ixx2++;

	$data2[] = array_merge($datatmp2, array('numero'=>$ixx2));
}

$titles2 = array(
				'numero'=>'<b>N°</b>',
				'dni'=>'<b>DNI</b>',
				'apellido'=>'<b>Apellido</b>',
				'nombre'=>'<b>Nombre</b>',



				

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
$pdf->ezText(" ");
$pdf->ezText("Fecha de impresión: " . $fechaDMA, 10,array('justification'=>'left'));


$pdf->ezStream();
?>

