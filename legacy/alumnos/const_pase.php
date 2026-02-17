<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();


$docente=$_GET["dni"];
$observaciones= html_entity_decode($_GET["observa"]);
$juntar=utf8_decode($_GET["juntar"]);



$resemp2 = mysql_query ("SELECT * FROM alumno where dni='$docente'");
$totemp2 = mysql_fetch_array($resemp2);

$resemp3 = mysql_query ("SELECT * FROM cursa where alumno='$docente' and control=1");
$totemp3 = mysql_fetch_array($resemp3);

$resemp4 = mysql_query ("SELECT reso,descripcion FROM plan,cursa where cursa.alumno='$docente' and control=1 and plan.id=cursa.modalidad");
$totemp4 = mysql_fetch_array($resemp4);


//$resemp5 = mysql_query ("SELECT materia FROM previas where alumno='$docente' and observacion='ADEUDA' ");  //adaptada a nueva tabla previas

$resemp5 = mysql_query ("SELECT CONCAT(materias2023.descripcion, ' ',previas.curso, '°') AS materia,IF(ISNULL(previas.movilidad),'',' (M.E.)') AS movi FROM previas LEFT JOIN materias2023 ON previas.idmateria = materias2023.idmateria WHERE alumno=$docente AND (nota < 6 OR observacion='ADEUDA')");



$concatena="";


while ($totemp5 = mysql_fetch_array($resemp5)) {

$nombreMateria = ucwords(strtolower($totemp5['materia'])) . $totemp5['movi'];
$concatena.= (empty($concatena)) ? $nombreMateria : " - ". $nombreMateria;


}

if ($concatena=="") $concatena="Ninguna";


$f=date("d / m / Y");

$txttit34 = "<b>PASE</b>";
$txttit34 = mb_convert_encoding($txttit34, "ISO-8859-1", "UTF-8");
$diia=date("d-m-Y");
$txttit35 = "Establecimiento Educativo: Colegio Provincial Dr. José María Sobral, CUE Nº 9400085-00, Se hace constar que ".$totemp2['apellido'].", ".$totemp2['nombre']." de ".$totemp3['curso']."º año, Plan de estudios de ".$totemp4['descripcion']." de acuerdo a ".$totemp4['reso']." tiene en trámite su certificado de estudios incompletos: Analítico Parcial.";
$txttit33 = "Datos Complementarios.";
$txttit36 = "Tipo y Nº de Documento: DNI ".number_format($docente,0,",",".")." - Curso completo aprobado: $juntar.";
$txttit37 = "Materias que adeuda: $concatena.";
$txttit32 = "Observaciones: $observaciones. ";
$txttit31 = "Hasta tanto no se remita el troquelado sellado confirmando la vacante al correo cpdjmsobral@tdf.edu.ar no se podrá emitir el Pase Analítico Legalizado.
A pedido del/a interesado/a y al solo efecto de ser presentada ante las autoridades educativas que correspondan se extiende la presente, sin enmiendas ni raspaduras en la ciudad de Ushuaia, Provincia de Tierra del Fuego, ".$f.".
";
$txttit27 = "---------------------------------------------------------------------------------------------------------------------------------";
$txttit28 = "(TROQUELADO)";

$txttit30 = "La Institución receptora . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
Nº CUE . . . . . . . . . . . . . .  con domicilio en . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . , Correo electrónico . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . , Jurisdicción de . . . . . . . . . notifica a la Institución de origen que el alumno/a  . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . DNI: . . . . . . . . . . . . ha sido matriculado en el presente establecimiento.";

//$txttit30 = "La Institución receptora………………………………………………………………………...……
//Nº CUE……….………. con domicilio en …………………………………………………………, Correo
//electrónico …………………………………………………………………………………,
//Jurisdicción de…………………..……….. notifica a la Institución de origen que el alumno/a ............................................................................... DNI:………………....... ha sido matriculado en el presente establecimiento.";

$txttit29 = "Sello del
Establecimiento

Firmas de las autoridades del establecimiento educativo";


$txttit25 = "El presente Pase es de uso provisorio. Para formalizar la escolarización del alumno se requiere del Analítico Parcial correctamente legalizado por las autoridades pertinentes.

Cabe aclarar que en los casos de movilidad interjurisdiccional, deberán constar las firmas de las autoridades del área educativa del Ministerio de Educación Provincial.";


$txttit24 = "______________________________                                                       ______________________________";


$txttit55 = "LAS ISLAS MALVINAS, GEORGIAS, SANDWICH DEL SUR, SON Y SERÁN ARGENTINAS";


$pdf->ezImage("titulo.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit35, 12,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit33, 13,array('justification'=>'left'));

$pdf->ezText($txttit36, 12,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit37, 12,array('justification'=>'left'));
$pdf->ezText("\n", 10);
if (($_GET["observa"]!="")) { $pdf->ezText($txttit32, 13,array('justification'=>'left')); }

$pdf->ezText($txttit31, 12,array('justification'=>'left'));
$pdf->ezText($txttit26, 12,array('justification'=>'left'));
$pdf->ezText("\n", 10);


$pdf->ezText($txttit24, 10,array('justification'=>'center'));
$pdf->ezText("\n", 10);

$pdf->ezText($txttit27, 12,array('justification'=>'left'));

$pdf->ezText($txttit28, 12,array('justification'=>'center'));

$pdf->ezText("\n", 10);
$pdf->ezText($txttit30, 13,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit29, 12,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit25, 9,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText("\n", 10);
$pdf->ezText("\n", 10);
$pdf->ezText($txttit55, 8,array('justification'=>'center'));






$pdf->ezStream();
?>
