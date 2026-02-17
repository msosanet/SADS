<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();


$mesa=$_GET["mesa"];
$dni=$_GET["dni"];


$result1 = mysql_query ("SELECT * FROM ofrecimiento where numero=$mesa");
$fila1 = mysql_fetch_array($result1) ;


$resultr1 = mysql_query ("SELECT * FROM 1090_18espacios_junta where numero=$fila1[id_junta]");
$filar1 = mysql_fetch_array($resultr1) ;



$resEmp2 = mysql_query ("SELECT * FROM espacio where ofrecimiento = $mesa");
$totEmp2 = mysql_num_rows($resEmp2);

$mas2 =0;
$materia=$filar1[descripcion]." ".$dni;
$firma="";


while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 




	$data2[] = array_merge($datatmp2, array('num'=>$materia));
}

$titles2 = array(

				'horas'=>'<b>HS</b>',
				'num'=>'<b>Espacio Curricular y/o Cargo</b>',
				'id_junta'=>'<b>ID SIGE</b>',
				'hs_cubrir'=>'<b>Horarios</b>',
				'caracter'=>'<b>Sit. Rev.</b>',
				'curso'=>'<b>Secc.</b>',
				'divi'=>'<b>Div</b>',
				'turno'=>'<b>Turno</b>',
				'motivo'=>'<b>Motivo</b>',





				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550,
				'fontSize' => 8
			);



$resEmp3 = mysql_query ("SELECT * FROM tomas where codigo = $mesa order by letra,puntaje DESC");
$totEmp3 = mysql_num_rows($resEmp3);

$curso2="";
$fecha="";
$firma2="";

while($datatmp3 = mysql_fetch_assoc($resEmp3)) { 

	$mas2 = $mas2+1;

	$data3[] = array_merge($datatmp3,array('mas'=>$mas2),array('firma'=>$firma),array('curso2'=>$curso),array('firma2'=>$firma2),array('fecha'=>$fecha),array('tel'=>$tel));
}

$titles3 = array(
				'mas'=>'<b>Nº</b>',
				'apellido'=>'<b>Apellido</b>',
				'nombre'=>'<b>Nombre</b>',
				'dni'=>'<b>DNI</b>',
				'letra'=>'<b>Letra</b>',
				'puntaje'=>'<b>Puntaje</b>',
				'curso2'=>'<b>Secc.</b>',
				'curso'=>'<b>Fecha alta</b>',
				'firma'=>'<b>Acepto</b>',
				'firma2'=>'<b>             Firma              </b>',
				'tel'=>'<b>  Telefono  </b>',





				

			);
$options3 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550,
				'fontSize' => 8
			);








$mesw=date("m");
$diia2=date("Y");
$f=date("d");
$txttit34 = "<b>ACTA DE OFRECIMIENTOS DE HORAS CATEDRAS Y CARGOS Nº".$mesa."/".$diia2." C.P.D.J.M.S.</b>";

if ($mesw==01){
$diia= "Enero";
} else if ($mesw=='02'){
$diia= "Febrero";
} else if ($mesw=='03'){
$diia= "Marzo";
} else if ($mesw=='04'){
$diia= "Abril";
} else if ($mesw=='05'){
$diia= "Mayo";
} else if ($mesw=='06'){
$diia= "Junio";
} else if ($mesw=='07'){
$diia= "Julio";
} else if ($mesw=='08'){
$diia= "Agosto";
} else if ($mesw=='09'){
$diia= "Septiembre";
} else if ($mesw=='10'){
$diia= "Octubre";
} else if ($mesw=='11'){
$diia= "Noviembre";
} else if ($mesw=='12'){
$diia= "Diciembre";
}

//$txttit3x ="En la ciudad de Ushuaia, a los 14 dia/s del mes de Mayo de ".$diia2." siendo las _____ hs. El Sr/Sra ".$fila1[usuario1]." y ".$fila1[usuario2]." proceden a realizar el _________ llamado de ofrecimiento de las horas catedras y/o cargos que se detallan a continuacion:";


$txttit3x ="En la ciudad de Ushuaia, a los ".$f." dia/s del mes de ".$diia." de ".$diia2." siendo las _____ hs. y habiendo emitido el Comunicado Nº _____/___ Letra: C.P.D.J.M.S. la autoridad que preside y suscribe el acto: ".$fila1[usuario1]." y ".$fila1[usuario2]." proceden a realizar el ofrecimiento de las horas cátedras y/o cargos que se detallan a continuación, siendo ello resultado del ____ llamado.";


$tx1 = "Se presentan al ofrecimiento los siguientes postulantes: ";

$txt55 = "ACTO DESIERTO";


$leyenda="<b> En un todo de acuerdo a lo prescripto en el artículo 113  de la Ley Nacional 14.473. Previo a lo cual se deja expresa constancia de los siguientes puntos:</b>
1.- Conforme a lo establecido en la Ley Nacional 14.473 se contempla el orden de mérito establecido por la Junta de Clasificación y Disciplina entre los postulantes inscriptos para interinatos y suplencias, ofreciendo el cincuenta por ciento entre el personal que reviste en carácter de TITULAR, en el establecimiento.
2.- Es absoluta responsabilidad de los docentes presentes en el ofrecimiento, indistintamente de su situación de revista, que al momento de ser designados en las horas y/o cargos que aceptaren deben encontrarse enmarcados en lo establecido por la Ley Provincial 761 y demás normativa en vigencia, tanto en lo atinente a acumulación de cargos y horas cátedras, como a la presentación de declaración jurada de cargos y actividades.
3.- De comprobarse la falsedad en alguno de los datos en la declaración jurada, será de aplicación la cesantía sin más trámite. (Art. 50 de la Ley Nacional Nº 14.473.)
4.-  La falta de presentación de formulario de Declaración Jurada de Cargos y Actividades en tiempo y forma, sin razón debidamente justificada, faculta a la Dirección para proceder a la baja, mediante el acto administrativo pertinente, sin perjuicio de aplicar las medidas disciplinarias que pudieran corresponder
5.-. Ante el desistimiento por parte de quienes aceptaren las horas y/o cargos en el presente acto público de ofrecimiento, se procederá a convocar al inmediato subsiguiente en el orden de mérito, que hubiere aceptado las horas y/o cargos en este acto.

- Si posee legajo docente en RRHH de Gobierno y está inactivo por un período de 2 años deberá realizar el ingreso nuevamente para acceder al cobro del salario.

PREVIO A ACEPTAR LAS HORAS Y/O CARGOS OFRECIDOS EN EL PRESENTE ACTO, DECLARO HABER TOMADO CONOCIMIENTO DE CADA UNO DE LOS ASPECTOS ENUNCIADOS EN LA PRESENTE,Y MANIFIESTO ENCONTRARME ENCUADRADO/A EN LAS GENERALES DE LA LEY. CONSTE.- Se presentan al ofrecimiento los siguientes postulantes:";


$txttit3c = "Ushuaia, ".$f." de ".$diia. " del ". $diia2;

//$txttit3c = "Ushuaia 14 de Mayo del 2019";



$pdf->ezImage("logo44.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 13,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit3x, 9,array('justification'=>'center'));
$pdf->ezText("\n", 10);

$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText("\n", 10);
$pdf->ezText($leyenda, 9,array('justification'=>'justify'));
$pdf->ezText("\n", 10);
$pdf->ezText($tx1, 9,array('justification'=>'left'));
$pdf->ezText("\n", 10);

$veo = mysql_query ("SELECT * FROM tomas where codigo = $mesa");
$veo2 = mysql_num_rows($veo);

if ($veo2==0) { $pdf->ezText($txt55, 25,array('justification'=>'center')); }


$pdf->ezTable($data3, $titles3, '', $options3);
$pdf->ezText("\n", 10);

$pdf->ezText($txttit3c, 11,array('justification'=>'right'));
$pdf->ezText("\n", 10);



$pdf->ezTable($dataf,'','',$opcion3);



 

$pdf->ezStream();
?>

