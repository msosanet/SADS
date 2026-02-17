<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
$pdf->ezStartPageNumbers(intval($pdf->ez['pageWidth']/2) + 20 ,28,10,'','{PAGENUM} de {TOTALPAGENUM}',1);

$all = $pdf->openObject();
$pdf->saveState();
$pdf->ezImage("logo4.jpg", 0, 520, 'none','');
$pdf->restoreState();
$pdf->closeObject();
$pdf->addObject($all,'all');
$pdf->ezSetCmMargins(5,3,3,3);
$pdf->addInfo($datacreator);
include 'conexion.php';
$conexion = conectar ();


$actor=$_GET["actor"];
$resEmp2 = mysql_query ("SELECT * FROM materia_docente, materia,caracter WHERE materia_docente.caracter=caracter.codigo and materia_docente.docente='$actor' and materia_docente.materia=materia.codigo order by materia_docente.fecha_alta desc");
$totEmp2 = mysql_num_rows($resEmp2);



$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$ixx2 = $ixx2+1;
	$dx=explode("-", $datatmp2['fecha_alta']);
	$fx=$dx[2]."/".$dx[1]."/".$dx[0];
	$dz=explode("-", $datatmp2['fecha_baja']);
	$fz=$dz[2]."/".$dz[1]."/".$dz[0];
	$prueba = mysql_query ("SELECT * FROM materia where codigo = $datatmp2[materia];");
	$fran = mysql_fetch_array($prueba);
	$materia=$fran[nombre]." ".$fran[curso]." ".$fran[div];
	$data2[] = array_merge($datatmp2, array('num'=>$ixx2),  array('materia'=>$materia), array('fx'=>$fx), array('fz'=>$fz));
}

$titles2 = array(
				'materia'=>'<b>Cargo o Asig.</b>',
				'hs_consume'=>'<b>HS</b>',
				'fx'=>'<b>Fecha Alta</b>',
				'fz'=>'<b>Fecha Baja</b>',
				'descripcion'=>'<b>Sit. Revista</b>',



				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);


$resEmp3 = mysql_query ("SELECT * FROM lic_fox WHERE docente='$actor'  order by desde desc");
$totEmp3 = mysql_num_rows($resEmp3);

$mostrar2=0;

if ($totEmp3){ $mostrar2=1;}


while($datatmp3 = mysql_fetch_assoc($resEmp3)) { 

	$dxx=explode("-", $datatmp3['desde']);
	$fxx=$dxx[2]."/".$dxx[1]."/".$dxx[0];
	$dzz=explode("-", $datatmp3['hasta']);
	$fzz=$dzz[2]."/".$dzz[1]."/".$dzz[0];
	$data3[] = array_merge($datatmp3, array('num'=>$ixx2),  array('materia'=>$materia), array('fxx'=>$fxx), array('fzz'=>$fzz));
}

$titles3 = array(
				'descripcion'=>'<b>Cargo o Asig.</b>',
				'estado'=>'<b>HS</b>',
				'fxx'=>'<b>Fecha Alta</b>',
				'fzz'=>'<b>Fecha Baja</b>',




				

			);
$options3 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);




$resEmp4 = mysql_query ("SELECT * FROM licencia_docente WHERE docente='$actor'  order by fecha_desde desc");
$totEmp4 = mysql_num_rows($resEmp4);

$mostrar1=0;

if ($totEmp4){ $mostrar1=1;}


while($datatmp4 = mysql_fetch_assoc($resEmp4)) { 

	$dxx=explode("-", $datatmp4['fecha_desde']);
	$fxx=$dxx[2]."/".$dxx[1]."/".$dxx[0];
	$dzz=explode("-", $datatmp4['fecha_hasta']);
	$fzz=$dzz[2]."/".$dzz[1]."/".$dzz[0];
	$motivo = mysql_query ("SELECT * FROM licencia where codigo = $datatmp4[motivo];");
	$motivo = mysql_fetch_array($motivo);
	$motivo=$motivo[descripcion];
	$prueba = mysql_query ("SELECT * FROM materia where codigo = $datatmp4[materia];");
	$fran = mysql_fetch_array($prueba);
	$hs=$fran[hs_consume];
	$materia=$fran[nombre]." ".$fran[curso]." ".$fran[div];
	$data4[] = array_merge($datatmp4, array('hs'=>$hs),  array('materia'=>$materia), array('fxx'=>$fxx), array('fzz'=>$fzz), array('motivo'=>$motivo));
}

$titles4 = array(
				'materia'=>'<b>Cargo o Asig.</b>',
				'hs'=>'<b>HS</b>',
				'fxx'=>'<b>Fecha Alta</b>',
				'fzz'=>'<b>Fecha Baja</b>',
				'motivo'=>'<b>Motivo</b>',




				

			);
$options4 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);




$result1 = mysql_query ("SELECT * FROM docente where dni='$actor'");
$fila1 = mysql_fetch_array($result1) ;

$result2 = mysql_query ("SELECT * FROM materia_docente where docente='$actor'");
$fila2 = mysql_fetch_array($result2) ;






$d=explode("-", $fila2[fecha_alta]);
$f=$d[2]."/".$d[1]."/".$d[0];

$txttit34 = "<b>CONSTANCIA DE PRESTACIÓN DE SERVICIOS</b>";
//$txttit34 = mb_convert_encoding($txttit34,"UTF-8");


$diia=date("d-m-Y");

$txttit35 = "La rectoría del Colegio Provincial Dr. José María Sobral, hace constar que el agente $fila1[apellido], $fila1[nombre] DNI N° $fila1[dni] se desempeñó en este establecimiento desde el $f en los siguientes cargos y/o asignaturas ";
//$txttit35 = mb_convert_encoding($txttit35,"UTF-8");

$txttit36 = "LICENCIA O COMISIÓN DE SERVICIO ANTERIORES AL 2016";
//$txttit36 = mb_convert_encoding($txttit36,"UTF-8");

$txttit37 = "LICENCIA O COMISIÓN DE SERVICIO POSTERIORES AL 2016";
//$txttit37 = mb_convert_encoding($txttit37,"UTF-8");

$textofinal="Total de alumnos:";
$textofinal2="Aprobados:";
$textofinal3="Aplazados:";
$textofinal4="Ausentes:";



$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit35, 10,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText("\n", 10);

if ($mostrar1){ 

$pdf->ezText($txttit36, 10,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezTable($data3, $titles3, '', $options3);
$pdf->ezText("\n", 10);

}
if ($mostrar2){ 
$pdf->ezText($txttit37, 10,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezTable($data4, $titles4, '', $options4);
$pdf->ezText("\n", 10);
}

$pdf->ezStream();
?>
