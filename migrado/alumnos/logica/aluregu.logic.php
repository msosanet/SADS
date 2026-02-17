<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();


$docente=$_POST["dni"];
$observ=$_POST["observaciones"];




$resemp2 = mysql_query ("SELECT * FROM alumno where dni='$docente'");
$totemp2 = mysql_fetch_array($resemp2);

$resemp3 = mysql_query ("SELECT * FROM cursa where alumno='$docente' and control=1");
$totemp3 = mysql_fetch_array($resemp3);



$f=date("d/m/Y");

$txttit34 = "<b>CONSTANCIA ESTUDIANTE REGULAR</b>";
$txttit34 = mb_convert_encoding($txttit34, "ISO-8859-1", "UTF-8");
$diia=date("d-m-Y");
if (is_numeric($totemp3['divi'])){
	$txttit35 = "El Colegio Provincial Dr. José María Sobral de Ushuaia, hace constar que ".$totemp2['apellido']." ".$totemp2['nombre'].", D.N.I. Nº: ". number_format($docente,0,",",".") ." es estudiante regular correspondiente al ".$totemp3['curso']."º año, división ".$totemp3['divi']. "ª, en este Establecimiento Educativo.";
}
else {
	$txttit35 = "El Colegio Provincial Dr. José María Sobral de Ushuaia, hace constar que ".$totemp2['apellido']." ".$totemp2['nombre'].", D.N.I. Nº: ". number_format($docente,0,",",".") ." es estudiante regular correspondiente al ".$totemp3['curso']."º año, división ".$totemp3['divi']. ", en este Establecimiento Educativo.";
}
$txttit36 = "A pedido del/a interesado/a y a solo efecto de ser presentada ante las autoridades que lo requieran se extiende la presente, sin enmiendas ni raspaduras en la ciudad de Ushuaia, Provincia de Tierra del Fuego, el ". $f .". ";
$txttit37 = "DOCUMENTO NO VÁLIDO PARA EL COBRO DE SALARIO FAMILIAR";



$pdf->ezImage("titulo.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit35, 12,array('justification'=>'center'));
$pdf->ezText("\n", 10);

if ($observ!="") {
$pdf->ezText("Observaciones: " . $observ, 12,array('justification'=>'center'));
$pdf->ezText("\n", 10);
}

$pdf->ezText($txttit36, 12,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit37, 12,array('justification'=>'center'));

$pdf->ezStream();
?>

