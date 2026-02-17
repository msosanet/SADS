<?php
ini_set($display_errors, 1);
ini_set($html_errors, 1);

$_mes = ["","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre"];
$_dia = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sabado"];

require_once('class.ezpdf.php');
$pdf = new Cezpdf('A4');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();

$materia = $_POST['materia'];
$curso=$_POST['curso'];
$fecha_ex = $_POST['fechaExamen'];
$usar_fecha = 0; // Deja espacio libre para agregar fecha
$agregar1=$_POST['agregar'];
$up = 0; // Determina si la materia tiene una continuidad pedagógica previa
if (isset($_POST['usaFecha'])) $usar_fecha = 1; 

$mat_cur = "<b>" . $materia . " " . $curso . "</b>";
$f = strtotime($fecha_ex); 
$fechaDMA = ". . . . . . . .  de . . . . . . . . . . . . . . . de " . date("Y");
if ($usar_fecha) $fechaDMA = $_dia[date('w',$f)] . date(' j \d\e ',$f) . $_mes[date('n',$f)] . date(' \d\e Y',$f);

$titles_t1 = [
	'izq' => '',
	'der' => ''];
	
$options_t1 = [
	'showLines' => 0,
	'showHeadings' => 0,
	'fontSize' => 10,
	'shaded'=> 0,
	'width'=>550
//	'options' => array('izq' => ['justification' => 'left'],'der' => ['justification' => 'right']) //La clase no respeta esta configuración
	]; 
$datos_t1 = [
	['izq' => 'Presidente . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .',
		'der' => 'Vocal . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .'],
	['izq' => '',
		'der' => ''],
	['izq' => 'Vocal . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .',
		'der' => 'Suplente . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .'],
	['izq' => '',
		'der' => '']
	];
	
$datos_t3 = [
	['izq' => '',
		'der' => ''],
	['izq' => '',
		'der' => ''],
	['izq' => 'Presidente . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .',
		'der' => 'Vocal . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .'],
	['izq' => '',
		'der' => ''],
	['izq' => 'Vocal . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .',
		'der' => 'Suplente . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .']/*,
	['izq' => '',
		'der' => ''],
	['izq' => 'Total de estudiantes: . . . . . . . . . . ',
		'der' => ''],
	['izq' => '',
		'der' => ''],
	['izq' => 'Aprobados: ',
		'der' => ''],
	['izq' => 'Aplazados',
		'der' => ''],
	['izq' => 'Ausentes',
		'der' => '']*/
	
	];
	


while ($agregar1) {
	$maxPerPage = 25; // Cantidad de examinados por acta
	foreach ($agregar1 AS $docu => $anio) {
		$maxPerPage--;
		$agre_25[] = [$docu, $anio];
		unset($agregar1[$docu]);
		if (!$maxPerPage) break;
	}
	for ( $maxPerPage ; $maxPerPage > 0 ; $maxPerPage--) $agre_25[] = ['',''];
	$agregar[] = $agre_25;
	unset($agre_25);
}	


$nombres = explode(";",$_COOKIE['datosEstud']);
array_shift($nombres);
foreach($nombres AS $temp) {
	$arre = explode("=>",$temp);
	$apeNom[$arre[0]] = $arre[1];
}
unset($nombres);
unset($temp);
unset($arre);

if ($up == 1) {
	$titles2 = array( // Titulos de la tabla
				'apeNom'=>'<b>Apellido y Nombre</b>',
				'dni'=>'<b>Documento</b>',
				'uniPedag'=>'<b>UP*</b>',
				'notaE'=>'<b>Escrito</b>',
				'notaO'=>'<b>Oral</b>',
				'notaF'=>'<b>N. Final</b>',
				'obs'=>'<b>Observaciones</b>',
			);
}
else {
	$titles2 = array( // Titulos de la tabla
				'dni'=>'<b>Documento</b>',
				'apeNom'=>'<b>Apellido y Nombre</b>',
				'notaE'=>'<b>Escrito</b>',
				'notaO'=>'<b>Oral</b>',
				'notaF'=>'<b>N. Final</b>',
				'obs'=>'<b>Observaciones</b>',
			);
}
$optCols_t2 = [
	'dni'=>['justification'=>'centre','width' => 75],
	'apeNom'=>['justification'=>'right','width' => 150],
	'notaE'=>['justification'=>'right','width' => 15],
	'notaO'=>['justification'=>'right','width' => 15],
	'notaF'=>['justification'=>'right','width' => 15],
	'obs'=>['justification'=>'right','width' => 280]];

$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=> 550,
				'fontSize' => 9
//				'options' => $optCols_t2 //La clase ezPdf ignora esta opción
			);

$cant_paginas = 1;
foreach ($agregar AS $tabla) {
	unset($data2);
	foreach ($tabla AS $temp) {
	$uniPedag = "";
	if ($up == 1 && $temp[1] == 2021) $uniPedag = "SI";
	$data2[] = [
		'apeNom' => $apeNom[$temp[0]],
		'dni' => $temp[0],
		'uniPedag' => $uniPedag,
		'notaE' => '',
		'notaO' => '',
		'notaF' => '',
		'obs' => ''
		];
	}

if ($cant_paginas > 1) $pdf->ezNewPage();
$cant_paginas++;

$pdf->ezImage("membrete.png", 0, 520, 'none',''); //Escudo de encabezado

$pdf->ezText("<b>ACTA VOLANTE DE EXAMEN</b>", 12,array('justification'=>'center'));

$pdf->ezText($mat_cur, 13,array('justification'=>'center'));

$pdf->ezText($fechaDMA, 10,array('justification'=>'right'));

$pdf->ezText("\n", 10);

$pdf->ezTable($datos_t1, $titles_t1, '', $options_t1);

$pdf->ezTable($data2, $titles2, '', $options2);

$pdf->ezTable($datos_t3, $titles_t1, '', $options_t1);

$pdf->ezText("\n\nTotal de estudiantes:", 10,array('justification'=>'aleft'));
$pdf->ezText("\nAprobados:", 10,array('justification'=>'aleft'));
$pdf->ezText("\nAplazados:", 10,array('justification'=>'aleft'));
$pdf->ezText("\nAusentes:", 10,array('justification'=>'aleft'));

// $pdf->ezText(" \n");
// $pdf->ezText(var_export($_POST,true), 10,array('justification'=>'left'));

} // por página

$pdf->ezStream();
?>

