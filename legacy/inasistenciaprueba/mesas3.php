<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();


$dni=$_GET["dni"];

$resultllamado = mysql_query ("SELECT * FROM llamado");
$llamado = mysql_fetch_array($resultllamado);

$res = mysql_query ("SELECT * FROM mesas where dni = '$dni' and llamado=$llamado[numero] and anio=$llamado[anio]");


	$rest1 = substr($dni, 0, 2);
	$rest2 = substr($dni, 2, 3);
	$rest3 = substr($dni, 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;
	$prueba = mysql_query ("SELECT * FROM alumnos_mesas where dni = '$rest4'");
	$fran = mysql_fetch_array($prueba);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($res)) { 
	$ixx2 = $ixx2+1;

	$prueba2 = mysql_query ("SELECT * FROM docentes_mesas where codigo = $datatmp2[codigo]");
	$fran2 = mysql_fetch_array($prueba2);
	$materia=$fran2[curso]." ".$fran2[materia]." ".$fran2[plan];
	$fecha=$fran2[fecha];
	$hs=$fran2[hs];
	$data2[] = array_merge($datatmp2, array('num'=>$ixx2),  array('asign'=>$materia),array('fecha'=>$fecha), array('hs'=>$hs), array('calif'=>$calif), array('firma'=>$firma));
}

$titles2 = array(
				'num'=>'<b>Ord.</b>',
				'numero'=>'<b>Perm.</b>',
				'asign'=>'<b>Asignatura</b>',
				'fecha'=>'<b>Fecha</b>',
				'hs'=>'<b>HS</b>',
				'calif'=>'<b>Calificación</b>',
				'firma'=>'<b>Firma Pte.</b>',


				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);




$d=explode("-", $fila5[fecha]);
$f=$d[2]."/".$d[1]."/".$d[0];

$txttit34 = "<b>PERMISO DE EXAMEN A</b>";
$txttit34 = mb_convert_encoding($txttit34, "ISO-8859-1", "UTF-8");
$diia=date("d-m-Y");
$txttit35 = "Conste que el alumno ".$fran[alumno]." ,DNI:".$dni." está habilitado para rendir las asignaturas que se indican a continuación";
$txttit3x = "Febrero ".strftime("%Y");

$diia=date("m");
$diia2=date("Y");
$f=date("d");



if ($diia==01){
$diia= "Enero";
} else if ($mes==02){
$diia= "Febrero";
} else if ($mes==03){
$diia= "Marzo";
} else if ($mes==04){
$diia= "Abril";
} else if ($mes==05){
$diia= "Mayo";
} else if ($mes==06){
$diia= "Junio";
} else if ($mes==07){
$diia= "Julio";
} else if ($mes==08){
$diia= "Agosto";
} else if ($mes==09){
$diia= "Septiembre";
} else if ($mes==10){
$diia= "Octubre";
} else if ($mes==11){
$diia= "Noviembre";
} else if ($mes==12){
$diia= "Diciembre";
}





$txttit3c = "Sello";

$txttit33c =  "Ushuaia, ".$f." de Febrero del ". $diia2;

$txttit3b = "Firma del Secretario";

$textofinal="1) Para poder rendir examen el alumno deberá presentar a la mesa examinadora este permiso y su DNI.";
$textofinal2="2) Los exámenes escritos deben ser hechos con tinta";
$textofinal3="NOTA:";


$pdf->ezImage("logo4.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3x, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit35, 14,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText("\n", 10);
$pdf->ezText($txttit33c, 11,array('justification'=>'right'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3b, 9,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($textofinal3, 9,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($textofinal, 9,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($textofinal2, 9,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3c, 10,array('justification'=>'right'));

$pdf->ezStream();
?>
