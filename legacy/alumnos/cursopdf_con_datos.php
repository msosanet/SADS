<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL','LANDSCAPE');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();

$curso=$_GET["curso"];
$div=$_GET["div"];

$anio=date("Y");
//$anio=date("2021");

$resEmp2 = mysql_query ("SELECT * FROM alumno,cursa WHERE cursa.curso = '$curso' and cursa.divi = '$div' and cursa.alumno=alumno.dni and cursa.anio='$anio' and cursa.control=1 order by alumno.apellido");
$totEmp2 = mysql_num_rows($resEmp2);

$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
$ixx2++;


		$rtt2 = mysql_query ("SELECT * FROM alu_fami WHERE alumno = $datatmp2[alumno] and tipo='P'");
		$rt2 = mysql_fetch_array($rtt2) ;

		$rt3 = mysql_query ("SELECT * FROM alu_fami WHERE alumno = $datatmp2[alumno] and tipo='M'");
		$rt3 = mysql_fetch_array($rt3) ;

		$rt4 = mysql_query ("SELECT * FROM alu_fami WHERE alumno = $datatmp2[alumno] and tipo='T'");
		$rt4 = mysql_fetch_array($rt4) ;

		$rtt3 = mysql_query ("SELECT * FROM familiares WHERE dni = $rt2[familiar]");
		$padre = mysql_fetch_array($rtt3) ;

		$rtt4 = mysql_query ("SELECT * FROM familiares WHERE dni = $rt3[familiar]");
		$madre = mysql_fetch_array($rtt4) ;

		$rtt5 = mysql_query ("SELECT * FROM familiares WHERE dni = $rt4[familiar]");
		$tutor = mysql_fetch_array($rtt5) ;

		
		$pa=$padre[apellido].", ".$padre[nombre];
		$ma=$madre[apellido].", ".$madre[nombre];
		$tu=$tutor[apellido].", ".$tutor[nombre];

$apeynom=$datatmp2[apellido].", ".$datatmp2[nombre];

	$data2[] = array_merge($datatmp2, array('alumno'=>$apeynom),  array('materia'=>$materia),array('numero'=>$ixx2),array('nompadre'=>$pa),array('nommadre'=>$ma),array('tutor'=>$tu));

	//$data2[] = array_merge($datatmp2, array('numero'=>$ixx2),array('nompadre'=>$pa),array('nommadre'=>$ma),array('tutor'=>$tu));
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
				'f_nac'=>'<b>F-NAC</b>',
				'provincia'=>'<b>Prov</b>',
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
