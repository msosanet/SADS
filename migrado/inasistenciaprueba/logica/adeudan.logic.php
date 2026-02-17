<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL','landscape');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion5.php';
$conexion = conectar ();

$curso=$_GET["curso"];
$div=$_GET["div"];

if (isset($_GET['cl']) AND $_GET['cl']!='' AND $_GET['cl']!=date("Y"))
	{$anio=$_GET['cl'];
	 $ctrl=0;}
	else
	{$anio=date("Y");
	 $ctrl=1; 	}

//$anio=date("Y");
//$anio=date("2021");




$cons="SELECT DISTINCT previas.alumno FROM cursa,previas WHERE cursa.curso = '$curso' and cursa.divi = '$div' and cursa.anio='$anio' and cursa.control='$ctrl' and previas.alumno=cursa.alumno and previas.nota < 6";
$resEmp2 = mysql_query ("SELECT DISTINCT previas.alumno FROM cursa,previas WHERE cursa.curso = '$curso' and cursa.divi = '$div' and cursa.anio='$anio' and cursa.control='$ctrl' and previas.alumno=cursa.alumno and previas.nota < 6");
$totEmp2 = mysql_num_rows($resEmp2);




$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
$todas="";

$ixx2++;
$previas = mysql_query ("SELECT materia FROM previas WHERE alumno = $datatmp2[alumno] and nota < 6");


while($prev = mysql_fetch_array($previas)) {

						$todas=$todas." - ".$prev[materia];

					    }
$previas2 = mysql_query ("SELECT * FROM alumno WHERE dni = $datatmp2[alumno]");
$prev2 = mysql_fetch_array($previas2);

	$data2[] = array_merge($datatmp2, array('numero'=>$ixx2), array('todas2'=>$todas), array('nombre'=>$prev2[nombre]), array('apellido'=>$prev2[apellido]));
}

$titles2 = array(

				'numero'=>'<b>Nº</b>',

				'alumno'=>'<b>DNI</b>',
				'apellido'=>'<b>Apellido</b>',
				'nombre'=>'<b>Nombre</b>',
				'todas2'=>'<b>Previa</b>'
			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>800
			);


//va curso

$txttit34 = "<b>LISTADO DE TODOS LOS ALUMNOS CON PREVIAS DEL CURSO: ".$curso ." DIV: ".$div." C.Lectivo: ".$anio."</b>";
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

