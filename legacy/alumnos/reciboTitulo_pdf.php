<?php
$_mes = ["","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre"];
$_dia = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sabado"];

require_once('class.ezpdf.php');
$pdf = new Cezpdf('A4');
$pdf->selectFont('../fonts/Courier.afm');
$pdf->ezSetCmMargins(1.5,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();

if (!isset($_POST)) exit("Error");

$gen_pdf = $_POST['agregar'];

//$titulados = "42650179','42782384','42011141";
$titulados = array_pop($gen_pdf);
while ($otro = array_pop($gen_pdf)) {
	$titulados = $titulados . "','" . $otro;
}
$recibo_q = mysql_query("SELECT * FROM titulo LEFT JOIN alumno ON titulo.alumno = alumno.dni WHERE titulo.alumno IN ('$titulados')");


$impresos = mysql_query("UPDATE titulo SET recibo = 1 WHERE titulo.alumno IN ('$titulados')");
$resultado_update = mysql_error($impresos);


$f = strtotime("2022-04-20"); // Asignar el valor de $fecha_ex
$fechaDMA = $_dia[date('w',$f)] . date(' j \d\e ',$f) . $_mes[date('n',$f)] . date(' \d\e Y',$f);

$orden = 0;
//$recibo1 = mysql_fetch_assoc($recibo_q);
while ($recibo = mysql_fetch_assoc($recibo_q)) {
	$orden++; //primero o segundo de la hoja
	if($recibo['anio']==0) $recibo['anio'] = "";
	else $recibo['anio'] = "/" . $recibo['anio'];
	$parrafo1 = "\tEn el día de la fecha el/la Sr./Sra. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . retira bajo su voluntad y responsabilidad: Certificado N° " .
		$recibo['numero'] .
		$recibo['anio'] .
		" y Legajo Completo del alumno/a, ".
		$recibo['apellido'].
		" ".
		$recibo['nombre'].
		", DNI ".
		number_format($recibo['dni'],0,',','.');
		
	$fecha = "Ushuaia, . . . . de . . . . . . . . . . . . . . . de " . date('Y');

	$pdf->ezImage("membrete.png", 0, 520, 'none',''); //Escudo de encabezado

	$pdf->ezText("<b>RECIBO</b>", 16,array('justification'=>'center'));

	$pdf->ezText("\n", 10);

	$pdf->ezText($parrafo1, 12,array('justification'=>'full'));

	$pdf->ezText("\n", 10);

	$pdf->ezText($fecha, 12,array('justification'=>'full'));


	$pdf->ezText("\nFirma: . . . . . . . . . . . . . . .", 12,array('justification'=>'right'));
	$pdf->ezText("\nAclaración: . . . . . . . . . . . . . . .", 12,array('justification'=>'right'));
	$pdf->ezText("\nTipo y N° de documento: . . . . . . . . . . . . . . .", 12,array('justification'=>'right'));
	$pdf->ezText("\n\"Las Islas Malvinas, Georgias, Sandwich del Sur y los Hielos Continentales son y serán Argentinos\"", 8,array('justification'=>'center'));
	
	$pdf->ezText("\n", 12);
	$pdf->ezText("\n", 12);
	
	if ($orden==2) {
		$pdf->ezNewPage();
		$orden=0;
	}
}
$pdf->ezText($resultado_update, 12);
$pdf->ezStream();
?>
