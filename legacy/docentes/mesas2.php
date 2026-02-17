<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();


$mesa=$_GET["mesa"];
$dni=$_GET["dni"];


$resEmp2 = mysql_query ("SELECT * FROM docentes_mesas where dni1 = '$dni' or dni2 = '$dni' or dni3 = '$dni' or dni4 = '$dni'");
$totEmp2 = mysql_num_rows($resEmp2);

$ixx2 = 0;

$prueba = mysql_query ("SELECT * FROM docentes_mesas where dni1 = '$dni' or dni2 = '$dni' or dni3 = '$dni' or dni4 = '$dni'");

while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 

$fran = mysql_fetch_array($prueba);
if ($fran[dni1]==$dni){$estado="Presidente";}
if ($fran[dni2]==$dni){$estado="Vocal 1";}
if ($fran[dni3]==$dni){$estado="Vocal 2";}
if ($fran[dni4]==$dni){$estado="Suplente";}

	$ixx2 = $ixx2+1;
	$data2[] = array_merge($datatmp2, array('num'=>$ixx2), array('caracter'=>$estado));
}

$titles2 = array(
				'num'=>'<b>Ord.</b>',
				'curso'=>'<b>Curso</b>',
				'materia'=>'<b>Materia</b>',
				'plan'=>'<b>Plan</b>',
				'fecha'=>'<b>Fecha</b>',
				'hs'=>'<b>HS</b>',
				'caracter'=>'<b>Carácter</b>',




				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);




$result1 = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$fila1 = mysql_fetch_array($result1) ;






$txttit34 = "<b>NOTIFICACION AL DOCENTE</b>";

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



$txttit3x = "Diciembre ".strftime("%Y");





$txttit3b = "NOMBRE: ".$fila1[apellido].", ".$fila1[nombre]."                                               DNI: ".$dni;

$txttit3c = "Ushuaia, ".$f." de ".$diia. " del ". $diia2;

$txttit3y = "Firma del Secretario/a";

$pdf->ezImage("logo4.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3x, 14,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3b, 11,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3a, 11,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3y, 9,array('justification'=>'left'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3c, 11,array('justification'=>'right'));
$pdf->ezText("\n", 10);
$pdf->ezTable($dataf);

$pdf->ezStream();
?>
