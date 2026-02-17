<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();


$docente=$_GET["actor"];
$now=date("Y-m-d");

$resemp2 = mysql_query ("SELECT * FROM alumnos where dni='$docente'");
$totemp2 = mysql_fetch_array($resemp2);

mysql_query ("INSERT INTO autogestion VALUES (0,'$docente','$totemp2[alumno]',1,'$now')");

$resemp3 = mysql_query ("SELECT * FROM autogestion order by id desc");
$totemp3 = mysql_fetch_array($resemp3);

$d=explode("-", $now);
$f=$d[2]."/".$d[1]."/".$d[0];

$txttit34 = "<b>CONSTANCIA DE ALUMNO REGULAR NO APTA PARA EL COBRO DE SALARIO FAMILIAR </b>";
$txttit34 = mb_convert_encoding($txttit34, "ISO-8859-1", "UTF-8");
$diia=date("d-m-Y");
$txttit35 = "Se deja constancia que ".$totemp2[alumno]." D.N.I. Nº: ".$totemp2[dni].", es alumno/a ".$totemp2[condi]." de este establecimiento y se encuentra cursando el ".$totemp2[curso]."° año ".$totemp2[division]."° division, de acuerdo a ".$totemp2[plan]." a solo efecto de ser presentada ante las autoridades que así lo requieran.";
$txttit38 = "Ushuaia, ".$f;
$txttit37 = "CODIGO DE VALIDACION:".$totemp3[id];
$txttit36 = "El siguiente documento es valido y puede verificarlo en: www.colegiosobral.edu.ar/validar o llamando a los telefonos (2901) 444294";



$pdf->ezImage("logo4.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit35, 12,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText("\n", 10);
$pdf->ezText($txttit38, 11,array('justification'=>'right'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit37, 12,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit36, 10,array('justification'=>'center'));

$pdf->ezStream();
?>
