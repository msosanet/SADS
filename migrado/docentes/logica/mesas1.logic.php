<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();


$mesa=$_GET["mesa"];


$resEmp2 = mysql_query ("SELECT * FROM mesas where codigo = $mesa");
$totEmp2 = mysql_num_rows($resEmp2);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$ixx2 = $ixx2+1;
	$docente=$datatmp2["dni"];
	$rest1 = substr($docente, 0, 2);
	$rest2 = substr($docente, 2, 3);
	$rest3 = substr($docente, 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;
	$prueba = mysql_query ("SELECT * FROM alumnos_mesas where dni = '$rest4'");
	$fran = mysql_fetch_array($prueba);
	$apeynom=$fran[alumno];
	$data2[] = array_merge($datatmp2, array('num'=>$ixx2),  array('nombre'=>$apeynom),array('esc'=>$esc), array('oral'=>$oral), array('prom'=>$prom), array('observaciones'=>$observaciones));
}
	$data2[] = array_merge($datatmp2, array('num'=>$ixx2),  array('nombre'=>$apeynom),array('esc'=>$esc), array('oral'=>$oral), array('prom'=>$prom), array('observaciones'=>$observaciones));
	$data2[] = array_merge($data2, array('num'=>' '),  array('nombre'=>' '),array('esc'=>' '), array('oral'=>' '), array('prom'=>' '), array('observaciones'=>' '));
	$data2[] = array_merge($data2, array('num'=>' '),  array('nombre'=>' '),array('esc'=>' '), array('oral'=>' '), array('prom'=>' '), array('observaciones'=>' '));
	$data2[] = array_merge($data2, array('num'=>' '),  array('nombre'=>' '),array('esc'=>' '), array('oral'=>' '), array('prom'=>' '), array('observaciones'=>' '));
	$data2[] = array_merge($data2, array('num'=>' '),  array('nombre'=>' '),array('esc'=>' '), array('oral'=>' '), array('prom'=>' '), array('observaciones'=>' '));
	$data2[] = array_merge($data2, array('num'=>' '),  array('nombre'=>' '),array('esc'=>' '), array('oral'=>' '), array('prom'=>' '), array('observaciones'=>' '));


$titles2 = array(
				'num'=>'<b>Ord.</b>',
				'numero'=>'<b>Perm.</b>',
				'nombre'=>'<b>Apellido y Nombre</b>',
				'esc'=>'<b>Esc.</b>',
				'oral'=>'<b>Oral</b>',
				'oprom'=>'<b>Prom.</b>',
				'dni'=>'<b>Documento</b>',
				'observaciones'=>'<b>Observaciones</b>',

				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);



$result5 = mysql_query ("SELECT * FROM docentes_mesas where codigo = $mesa");
$fila5 = mysql_fetch_array($result5);

$result1 = mysql_query ("SELECT * FROM docentes where dni='$fila5[dni1]'");
$fila1 = mysql_fetch_array($result1) ;

$result2 = mysql_query ("SELECT * FROM docentes where dni='$fila5[dni2]'");
$fila2 = mysql_fetch_array($result2) ;

$result3 = mysql_query ("SELECT * FROM docentes where dni='$fila5[dni3]'");
$fila3 = mysql_fetch_array($result3) ;

$result4 = mysql_query ("SELECT * FROM docentes where dni='$fila5[dni4]'");
$fila4 = mysql_fetch_array($result4) ;


$d=explode("-", $fila5[fecha]);
$f=$d[2]."/".$d[1]."/".$d[0];

$txttit34 = "<b>ACTA VOLANTE DE EXAMEN</b>";
$txttit34 = mb_convert_encoding($txttit34, "ISO-8859-1", "UTF-8");
$diia=date("d-m-Y");
$txttit35 = "La Rectoría del Colegio Provincial Dr. José María Sobral de Ushuaia, hace constar que el/la Prof. ".$totemp2[apellido].", ".$totemp2[nombre]." D.N.I. Nº: ".$docente." ha asistido a la Jornada Institucional realizada en el establecimiento el día ".$f." en el horario de ".$hora_entrada." a ".$hora_salida." .Se extiende la presente en la ciudad de Ushuaia, el día ".$diia." al solo efecto de ser presentada ante las autoridades que así lo requieran.";
$txttit3x = "<b>".$fila5[curso]." año, ".$fila5[materia]." ".$fila5[plan]."</b>";




$temp = explode("-",$fila5[fecha]);
$fechamia = $temp[2]."/".$temp[1]."/".$temp[0];  
 

$txttithh = "<b>".$fechamia."  ".$fila5[hs]."</b>";


$txttit3y = "Presidente:".$fila1[apellido].", ".$fila1[nombre]."                                        Vocal:".$fila2[apellido].", ".$fila2[nombre];
$txttit3z = "Vocal:".$fila3[apellido].", ".$fila3[nombre]."                      Suplente:".$fila4[apellido].", ".$fila4[nombre];

$txttit3a = "Presidente...................................                                                    Vocal...................................";
$txttit3b = "Vocal...................................                                                         Suplente...................................";

$txttit3c = "Ushuaia, ".$f;


$textofinal="Total de alumnos:";
$textofinal2="Aprobados:";
$textofinal3="Aplazados:";
$textofinal4="Ausentes:";


$pdf->ezImage("logo4.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3x, 14,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttithh, 14,array('justification'=>'right'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3y, 11,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3z, 11,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3a, 11,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3b, 11,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($textofinal, 9,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($textofinal2, 9,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($textofinal3, 9,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($textofinal4, 9,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3c, 11,array('justification'=>'right'));

$pdf->ezStream();
?>

