<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
$pdf->ezStartPageNumbers(intval($pdf->ez['pageWidth']/2) + 20 ,28,10,'','{PAGENUM} de {TOTALPAGENUM}',1);

$all = $pdf->openObject();
$pdf->saveState();
$pdf->ezImage("logo5.jpg", 0, 520, 'none','');
$pdf->restoreState();
$pdf->closeObject();
$pdf->addObject($all,'all');
$pdf->ezSetCmMargins(5,3,3,3);
$pdf->addInfo($datacreator);
include 'conexion.php';
$conexion = conectar ();


$actor=$_GET["actor"];
$resEmp2 = mysql_query ("SELECT * FROM alta_baja, materia_cargo WHERE alta_baja.docente='$actor' and materia_cargo.id=alta_baja.materia order by alta_baja.fdesde DESC");
$totEmp2 = mysql_num_rows($resEmp2);



$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$ixx2 = $ixx2+1;
	$dx=explode("-", $datatmp2['fdesde']);
	$fx=$dx[2]."/".$dx[1]."/".$dx[0];
	$dz=explode("-", $datatmp2['fhasta']);
	$fz=$dz[2]."/".$dz[1]."/".$dz[0];
	$prueba = mysql_query ("SELECT * FROM materia_cargo where id = $datatmp2[materia];");
	$fran = mysql_fetch_array($prueba);
	$pruebavv = mysql_query ("SELECT * FROM caracter where codigo = $datatmp2[sit_revista];");
	$franvv = mysql_fetch_array($pruebavv);
	$revista=$franvv['descripcion'];
	$materia=$fran['nombre'];
	$cd="$fran[curso] - $fran[division]";
	
	if ($fran['curso']==0 AND $fran['division']==0)
		{
			$cd='';
		}
		
	if ($fz=="00/00/0000")
		{
		$fz='Continua';
		}
		
	$hs=$fran['cant_hs'];
	
	if ($hs==0) $hs='';
	
	$obs=$datatmp2['obs'];
	
	
	
	$data2[] = array_merge($datatmp2, array('num'=>$ixx2),  array('materia'=>$materia), array('fx'=>$fx), array('fz'=>$fz), array('revista'=>$revista), array('hs'=>$hs), array('cd'=>$cd), array('revista'=>$revista), array('obs'=>$obs));
}
$datos_tabla = array();
foreach($data2 AS $linea => $contenido){
	$datos_tabla[$linea]['hs'] = $contenido['hs'];
	$datos_tabla[$linea]['materia'] = $contenido['materia'];
	$datos_tabla[$linea]['cd'] = $contenido['cd'];
	$datos_tabla[$linea]['fx'] = $contenido['fx'];
	$datos_tabla[$linea]['fz'] = $contenido['fz'];
	$datos_tabla[$linea]['revista'] = $contenido['revista'];
	$datos_tabla[$linea]['obs'] = $contenido['obs'];
}
$titles2 = array(
				'hs'=>'<b>Hs. </b>',
				'materia'=>'<b>Cargo o Asig. año</b>',
				'cd'=>'<b>Curso y Div.</b>',
				'fx'=>'<b>Fecha Alta</b>',
				'fz'=>'<b>Fecha Baja</b>',
				'revista'=>'<b>Sit. Revista</b>',
				'obs'=>'<b>Obs.</b>',



				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);

/*
$resEmp3 = mysql_query("SELECT a.fecha_desde, a.fecha_hasta, a.motivo, GROUP_CONCAT(CONCAT(
    CASE WHEN m.cant_hs <> 0 THEN CONCAT(m.cant_hs, ' hs ') ELSE '' END,
    m.nombre,
    CASE WHEN m.curso <> '' THEN CONCAT(' (', m.curso, '°', m.division, ')') ELSE '' END
) SEPARATOR ' - ') AS plazas
FROM ausentes2 a
JOIN materia_cargo m ON a.id = m.id
WHERE a.docente = '$actor'
GROUP BY a.fecha_desde, a.fecha_hasta, a.motivo");


$resEmp3 = mysql_query("SELECT a.fecha_desde, a.fecha_hasta, a.motivo, GROUP_CONCAT(CONCAT( CASE WHEN m.cant_hs <> 0 THEN CONCAT(m.cant_hs, ' hs ',a.revista,' ') ELSE '' END, m.nombre, CASE WHEN m.curso <> '' THEN CONCAT(' (', m.curso, '°', m.division, ')') ELSE '' END ) SEPARATOR ' - ') AS plazas FROM ausentes2 a JOIN materia_cargo m ON (CASE WHEN a.plaza = 0 THEN a.id=m.id ELSE a.plaza=m.plaza END) WHERE a.docente = '$actor' GROUP BY a.fecha_desde, a.fecha_hasta, a.motivo");

*/

$resEmp3 = mysql_query("SELECT a.fecha_desde, a.fecha_hasta, a.motivo, GROUP_CONCAT(CONCAT( CASE WHEN m.cant_hs <> 0 THEN CONCAT(m.cant_hs, ' hs ',c.descripcion,' ') ELSE '' END, m.nombre, CASE WHEN m.curso <> '' THEN CONCAT(' (', m.curso, '°', m.division, ')') ELSE '' END ) SEPARATOR ' - ') AS plazas FROM ausentes2 a JOIN materia_cargo m ON (CASE WHEN a.plaza = 0 THEN a.id=m.id ELSE a.plaza=m.plaza END) 

JOIN
  caracter c ON a.revista = c.codigo

WHERE a.docente = '$actor' GROUP BY a.fecha_desde, a.fecha_hasta, a.motivo");

$totEmp3 = mysql_num_rows($resEmp3);



$ixx2 = 0;
while($datatmp3 = mysql_fetch_assoc($resEmp3)) { 
	$ixx2 = $ixx2+1;
	$dx=explode("-", $datatmp3['fecha_desde']);
	$fx=$dx[2]."/".$dx[1]."/".$dx[0];
	$dz=explode("-", $datatmp3['fecha_hasta']);
	$fz=$dz[2]."/".$dz[1]."/".$dz[0];
	$prueba = mysql_query ("SELECT * FROM materia_cargo where plaza = $datatmp3[plaza];");
	$fran = mysql_fetch_array($prueba);
	$pruebavv = mysql_query ("SELECT * FROM motivos where codigo = $datatmp3[motivo];");
	$franvv = mysql_fetch_array($pruebavv);
	$revista=$franvv['descripcion'];
	$materia=$datatmp3['plazas'];

	$transformer=explode(",", $datatmp3['plazas']);





	$cd="$fran[curso] - $fran[division]";
	
	if ($fran['curso']==0 AND $fran['division']==0)
		{
			$cd='';
		}
		
	if ($fz=="00/00/0000")
		{
		$fz='Continua';
		}
		
	$hs=$fran['cant_hs'];
	
	if ($hs==0) $hs='';
	
	$obs=$datatmp3['obs'];
	
	
	
	$data3[] = array_merge($datatmp3, array('num'=>$ixx2),  array('materia'=>$materia), array('fx'=>$fx), array('fz'=>$fz), array('revista'=>$revista), array('hs'=>$hs), array('cd'=>$cd), array('revista'=>$revista), array('obs'=>$obs));
}

$titles3 = array(
				'revista'=>'<b>Motivo</b>',
				'materia'=>'<b>Materia</b>',
				'fx'=>'<b>Desde</b>',
				'fz'=>'<b>Hasta</b>',




				

			);
$options3 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);





$result1 = mysql_query ("SELECT * FROM docentes where dni='$actor'");
$fila1 = mysql_fetch_array($result1) ;

$result2 = mysql_query ("SELECT * FROM alta_baja where docente='$actor' order by fdesde ASC");
$fila2 = mysql_fetch_array($result2) ;






$d=explode("-", $fila2['fdesde']);
$f=$d[2]."/".$d[1]."/".$d[0];

$txttit34 = "<b>CONSTANCIA DE PRESTACIÓN DE SERVICIOS</b>";
//$txttit34 = mb_convert_encoding($txttit34,"UTF-8");


     


$dd= date('d');
$mes= date ('m');
$aa= date ('Y');




    switch($mes){
       case 1: $mes="Enero"; break;
       case 2: $mes="Febrero"; break;
       case 3: $mes="Marzo"; break;
       case 4: $mes="Abril"; break;
       case 5: $mes="Mayo"; break;
       case 6: $mes="Junio"; break;
       case 7: $mes="Julio"; break;
       case 8: $mes="Agosto"; break;
       case 9: $mes="Septiembre"; break;
       case 10: $mes="Octubre"; break;
       case 11: $mes="Noviembre"; break;
       case 12: $mes="Diciembre"; break;
    }
     
    $mes= $mes;


$diia=$dd." de ".$mes." de ".$aa;


$txttit35 = "La rectoría del Colegio Provincial Dr. José María Sobral, hace constar que el/la Docente $fila1[apellido], $fila1[nombre] DNI N° $fila1[dni] se desempeñó en este establecimiento en los siguientes cargos y/o asignaturas ";

$txttitfgg = "La rectoría del Colegio Provincial Dr. José María Sobral, hace constar que el/la Docente $fila1[apellido], $fila1[nombre] DNI N° $fila1[dni] registra en este establecimiento las siguientes licencias y comisiones de servicio";

//$txttit35 = mb_convert_encoding($txttit35,"UTF-8");

$txttit36 = "LICENCIA O COMISIÓN DE SERVICIO ANTERIORES AL 2016";
//$txttit36 = mb_convert_encoding($txttit36,"UTF-8");

$txttit37 = "LICENCIA O COMISIÓN DE SERVICIO POSTERIORES AL 2016";
//$txttit37 = mb_convert_encoding($txttit37,"UTF-8");



$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttit35, 10,array('justification'=>'full'));
$pdf->ezText("\n", 10);
$pdf->ezTable($datos_tabla, $titles2, '', $options2);
$pdf->ezText("\n", 10);

if ($mostrar1){ 

$pdf->ezText($txttit36, 14,array('justification'=>'center'));
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


$txttit35y = "Dada en la ciudad de Ushuaia, al $diia ";
$txttit35x = "-------------------------                                                            ----------------------";
$txttit35z = "Firma Secretario                                                                Firma Rector";



$pdf->ezText($txttit35y, 10,array('justification'=>'full'));
$pdf->ezText("\n", 10);
$pdf->ezText("\n", 10);
$pdf->ezText("\n", 10);
$pdf->ezText("\n", 10);


$pdf->ezText($txttit35x, 10,array('justification'=>'center'));

$pdf->ezText($txttit35z, 10,array('justification'=>'center'));
$pdf->ezText("\n", 8);


$txttit34 = "<b>ANEXO I : LICENCIAS Y COMISIONES DE SERVICIO</b>";

$pdf->ezNewPage();

$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);
$pdf->ezText($txttitfgg, 10,array('justification'=>'full'));
$pdf->ezText("\n", 10);
$pdf->ezTable($data3, $titles3, '', $options3);
$pdf->ezText("\n", 10);
$pdf->ezText($txttit35y, 10,array('justification'=>'full'));
$pdf->ezText("\n", 10);
$pdf->ezText("\n", 10);
$pdf->ezText("\n", 10);
$pdf->ezText("\n", 10);


$pdf->ezText($txttit35x, 10,array('justification'=>'center'));

$pdf->ezText($txttit35z, 10,array('justification'=>'center'));
$pdf->ezText("\n", 8);

$pdf->ezStream();

?>

