<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL','landscape');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();

$curso=$_GET["curso"];
$div=$_GET["div"];
$cl=date("Y");
if (isset($_GET['cl']) AND $_GET['cl']!=''){$cl=$_GET["cl"];}
else $cl = $_SESSION['cicloLectivo'];




$cons="SELECT * FROM cursa, previas WHERE cursa.curso = '$curso' AND cursa.divi = '$div' AND cursa.anio='$cl' AND previas.alumno=cursa.alumno AND previas.nota < 6 ORDER BY cursa.alumno";
$resEmp2 = mysql_query ("SELECT * FROM cursa, previas WHERE cursa.curso = '$curso' AND cursa.divi = '$div' AND cursa.anio='$cl' AND previas.alumno=cursa.alumno AND previas.nota < 6 order by cursa.alumno");
$totEmp2 = mysql_num_rows($resEmp2);




$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
$ixx2++;

	$data2[] = array_merge($datatmp2, array('numero'=>$ixx2));
}

$titles2 = array(

				'dni'=>'<b>DNI</b>',
				'alumno'=>'<b>Alumno</b>',
				'adeuda'=>'<b>Adeuda</b>'
			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>800
			);




$txttit34 = "<b>LISTADO DE TODOS LOS ALUMNOS CON PREVIAS DEL CURSO: ".$cons ." DIV: ".$div."</b>";
$txttit34 = mb_convert_encoding($txttit34, "ISO-8859-1", "UTF-8");
$fechaDMA = date('d-m-Y');


$pdf->ezImage("logo4.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 8);

$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText(" ");
$pdf->ezText("Fecha de impresión: " . $fechaDMA, 10,array('justification'=>'left'));


$pdf->ezStream();
?>

