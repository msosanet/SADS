<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL','LANDSCAPE');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();

$curso=$_GET["curso"];
$div=$_GET["div"];



$resEmp2 = mysql_query ("SELECT * FROM alumnos WHERE curso = '$curso' and division = '$div' order by alumno");
$totEmp2 = mysql_num_rows($resEmp2);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
$ixx2++;

	$data2[] = array_merge($datatmp2, array('numero'=>$ixx2));
}

$titles2 = array(
				'numero'=>'<b>N°</b>',
				'dni'=>'<b>DNI</b>',
				'alumno'=>'<b>ALUMNO</b>',
				'nompadre'=>'<b>PADRE</b>',
				'nommadre'=>'<b>MADRE</b>',
				'tutor'=>'<b>TUTOR</b>',
				'tel'=>'<b>TELÉFONO</b>',
				'domicilio'=>'<b>DOMICILIO</b>',
				'fechanac'=>'<b>F-NAC</b>',
				'prov'=>'<b>Prov</b>',
			);

$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>950
			);


$txttit34 = "<b>LISTADO DE TODOS LOS ALUMNOS DEL CURSO: " . $curso . "o. DIV: " . $div. "a.</b>";
$txttit34 = mb_convert_encoding($txttit34, "ISO-8859-1", "UTF-8");
$diia=date("d-m-Y");






$pdf->ezImage("membrete_sobral.jpg",0,500,500,'center','');
$pdf->ezText($txttit34, 14,array('justification'=>'center'));
$pdf->ezText("\n", 10);

$pdf->ezTable($data2, $titles2, '', $options2);


$pdf->ezStream();
?>
