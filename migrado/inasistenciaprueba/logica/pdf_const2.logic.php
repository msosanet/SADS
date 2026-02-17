<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();


$docente=$_GET["dni"];
$fecha=$_GET["fecha"];
$hora_entrada=$_GET["hse"];
$hora_salida=$_GET["hss"];


$resemp2 = mysql_query ("SELECT * FROM docentes where dni='$docente'");
$totemp2 = mysql_fetch_array($resemp2);


$d=explode("-", $fecha);
$f=$d[2]."/".$d[1]."/".$d[0];

$txttit34 = "<b>CONSTANCIA</b>";
$txttit34 = mb_convert_encoding($txttit34, "ISO-8859-1", "UTF-8");
$diia=date("d-m-Y");
$txttit35 = "La Rectoría del Colegio Provincial Dr. José María Sobral de Ushuaia, hace constar que el/la Prof. ".$totemp2[apellido].", ".$totemp2[nombre]." D.N.I. Nº: ".$docente." asistió a la Mesa de exámen realizada en el establecimiento el día ".$f." en el horario de ".$hora_entrada." a ".$hora_salida." .Se extiende la presente en la ciudad de Ushuaia, el día ".$diia." al solo efecto de ser presentada ante las autoridades que así lo requieran.";



$pdf->ezImage("logo4.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit35, 12,array('justification'=>'center'));

$pdf->ezStream();
?>

