<?php
$_letras = [ 1001=>"Sin calificar",1000=>"Ausente",1=>"Uno","Dos","Tres","Cuatro","Cinco","Seis","Siete","Ocho","Nueve","Diez",];
$_turno = ["","Mañana","Tarde","Vespertino"];

 include 'fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include 'conexioncalif.php';

/* // Las secciones listadas est‡n preparadas para ser impresas y ya no pueden ser habilitadas extemporaneamente
$imprimibles = ["1B","11","12","14","21","23","31","32","33","34","35","3B"];
$imprimibles = array_merge($imprimibles,["13","22","24","2B"]);
$imprimibles = array_merge($imprimibles,["46","62","63","68","6A"]);
$imprimibles = array_merge($imprimibles,["1A","2A","3A","4A","5A","41","42","43","51","52","53","54"]);
$imprimibles = array_merge($imprimibles,["44","47","56","66"]);
$imprimibles = array_merge($imprimibles,["59","7A","64","65"]);
$imprimibles = array_merge($imprimibles,["45","61"]); */
$imprimibles = [];

$curso = false;

if (isset($_GET['cd']))	if (preg_match('/[1-7](10|11|[1-9|ab])/i',$_GET['cd'],$coincide)) $curso = $coincide[0];

if (!$curso) {
	echo '<head><meta http-equiv="refresh" content="0;vercalif.php"></head>';
	exit();
}

$_hab = in_array($curso,$imprimibles);


 $cur = substr($curso,0,1);
 $divi = substr($curso,1);
 $anio = date("Y");

 $ignorado = conectarcalif();
 mysql_select_db('alumnos');
 $turno_q = mysql_query("SELECT turno FROM cursos WHERE curso = '$cur' AND division like '$divi' ");
 $tur = mysql_fetch_assoc($turno_q); // Turno pera el curso

 mysql_select_db('calificadores');
 $materias_q = mysql_query("SELECT * FROM matcur LEFT JOIN materias ON materias.idmateria = matcur.idmateria WHERE matcur.idcurso LIKE '$curso' AND matcur.idmateria != 65"); // consulta materias del curso
 $alumnos_q = mysql_query("SELECT * FROM cursa LEFT JOIN alumno ON alumno.dni = cursa.alumno WHERE cursa.curso LIKE '$cur' AND cursa.divi LIKE '$divi' AND cursa.anio LIKE '$anio' AND cursa.control = 1 ORDER BY alumno.apellido, alumno.nombre"); // trae datos de alumnos del curso

 $tipoCalif_q = mysql_query("SELECT * FROM `notas`");
 while ($codNotas = mysql_fetch_assoc($tipoCalif_q))
 {
  $tipoCalif[$codNotas['id']] = $codNotas['valor'];
  $letrasCalif[$codNotas['id']] = $codNotas['descripcion'];
 }
 $instancia_q = mysql_query("SELECT DISTINCT idnota FROM `calificador2` WHERE curso = '$curso' AND anio = '$anio' AND idnota='$_GET[qn]'");
 //$instancia = mysql_fetch_assoc($instancia_q);
 while ($quenota = mysql_fetch_assoc($instancia_q))
 {
  $quenotax[$quenota['idnota']] = $quenota;
 }
 $nomInst_q = mysql_query("SELECT * FROM `calificaciones`");
 unset($instancias);
 while ($nomInst = mysql_fetch_assoc($nomInst_q))
 {
  $instancias[$nomInst['id']] = $nomInst;
 }





 $cantAlu = mysql_num_rows($alumnos_q);

 if ($_hab) $titulo = "Colegio Provincial Dr. José María Sobral\n" . $instancias[$_GET['qn']]['descripcion'] . " Ciclo Lectivo " . $anio;
 else $titulo = "VERSIÓN DE PRUEBA - VERSIÓN DE PRUEBA - VERSIÓN DE PRUEBA";

  $pdf=new exFPDF('P','mm','A4');
  $pdf->AddPage();
  $pdf->SetFont('helvetica','',8);
  $pdf->SetMargins(15, 10, 10);
  $pdf->SetAutoPageBreak(TRUE,10);

 $columna = TRUE; // para columna izquierda
 $contador = 0; // para cantidad por página

 while($alumno=mysql_fetch_assoc($alumnos_q)){

  if ($contador<4) $contador++; // 4 por página
  else {
   $pdf->AddPage();
   $contador = 1;
  }

  if ($columna) { // columna derecha o izquierda
   $x=$pdf->GetX();
   $y=$pdf->GetY();
   $estiloTabla = "width:90; align:L{LC}; font-color:#000000;bgcolor:#FFFFFF;border-color:#000000;";
   $columna = !$columna;
  }
  else {
   $pdf->SetY($y);
   $estiloTabla = "width:90; l-margin:100; bgcolor:#FFFFFF;border-color:#000000;";
   $columna = !$columna;
  }


  $table_enc=new easyTable($pdf, 3, $estiloTabla); // tabla de encabezado

  $table_enc->easyCell($titulo, 'align:C; colspan:3; border:0');
//  $table_enc->easyCell($titulo, 'align:C; colspan:3; border:0');
  $table_enc->printRow();

  if ($_hab) $table_enc->easyCell("Estudiante: <b>" . strtoupper(trim($alumno['apellido'])) . ", " . ucwords(strtolower(trim($alumno['nombre']))) . "</b>", 'align:L; colspan:3; border:0');
  else $table_enc->easyCell("<b>VERSIÓN DE PRUEBA</b>. (Aquí va el nombre y apellido del estudiante): " . $alumno['apellido'], 'align:L; colspan:3; border:0');

  $table_enc->printRow();
  $table_enc->easyCell("Curso: " . $cur . "°", 'align:L; border:0');
  $table_enc->easyCell("División: " . strtoupper($divi), 'align:L; border:0');
  $table_enc->easyCell("Turno: " . $_turno[$tur['turno']] , 'align:L; border:0');
  $table_enc->printRow();
  $table_enc->endTable(0); //fin tabla encabezado

  $table=new easyTable($pdf, '{45, 17, 28}', $estiloTabla); // Para 1er informe
//  $table=new easyTable($pdf, '{35, 10, 10,10,10,15}', $estiloTabla); // Para ????

  $table->easyCell("Espacio", 'align:C; border:1');

  foreach ($quenotax as $qnid => $qn)
  {
   $table->easyCell($instancias[$qn['idnota']]['abreviado'], 'align:C; border:1');
  }
 //  $table->easyCell("PRUEBA", 'align:C; border:1');
  $table->easyCell("Calificación \nen letras", 'align:C; border:1');
  $table->printRow();

  mysql_data_seek($materias_q,0);
  mysql_select_db('calificadores');
  while ($materia = mysql_fetch_assoc($materias_q)) { // Filas por espacios académicos
//   $calif_q = mysql_query("SELECT * FROM calificador WHERE dni = '$alumno[dni]' AND materia = '$materia[idmateria]' AND anio = '$anio'");
   $calif_q = mysql_query("SELECT * FROM calificador2 WHERE dni = '$alumno[dni]' AND materia = '$materia[idmateria]' AND anio = '$anio' AND curso = '$curso' AND idnota='$_GET[qn]'");

   while ($calificacion = mysql_fetch_assoc($calif_q))
   {
    $calif[$calificacion['idnota']] = $calificacion['nota'];
   }

   $table->easyCell(ucwords(strtolower($materia['descripcion'])), 'align:L; border:1');
   
   // Resuelve el cuadro cuando no hay carga o se cargó 0
   if (!mysql_num_rows($calif_q)) $_incompleta = TRUE;
   else {
		$_incompleta = FALSE;
		if ($calif[$_GET['qn']]==0 ) $calif[$_GET['qn']]  = "s/c";
	}

/*
   for ($id = 1; $id<=$quenotax[$id]; $id++)
//   foreach($calif AS $id => $nota)
   {
    // Transforma la calificación 0/FALSE/NULL en "Sin calificar"
    if (!isset($calif[$id])) $_incompleta = TRUE;
    else {
		$_incompleta = FALSE;
		if ($calif[$id]==0 ) $calif[$id]  = "s/c";
	}
   } */

   $ultimo = end($quenotax);
   foreach ($quenotax as $qn)
  {
   if ($qn['idnota']!=$_GET['qn'])
	{
		$se_muestra = ($_incompleta) ? "---" : $tipoCalif[$calif[$qn['idnota']]];
		$table->easyCell($se_muestra, 'align:C; border:1; valign:M');
		}
   else
	{
		$se_muestra = ($_incompleta) ? "---" : $tipoCalif[$calif[$qn['idnota']]];
		$table->easyCell($se_muestra, 'font-style:B; align:C; border:1; valign:M');
		}

	if ($qn['idnota']!=$ultimo)
//   {$table->easyCell($_letras[$calif[$qn['idnota']]], 'align:C; border:1; valign:M');}
   {
   	$se_muestra = ($_incompleta) ? "No Informada" : $letrasCalif[$calif[$qn['idnota']]];
   	$table->easyCell($se_muestra, 'align:C; border:1; valign:M');
   	}

   /*$table->easyCell($calif[2], 'align:C; border:1; valign:M');
   $table->easyCell($calif[3], 'align:C; border:1; valign:M');
   $table->easyCell($calif[9], 'font-style:B; align:C; border:1; valign:M');
   $table->easyCell($_letras[$calif[9]], 'align:C; border:1; valign:M');*/
//   $table->easyCell(var_export($calif,true), 'align:C; border:1; valign:M');
   $table->printRow();
  }



   unset($calif);

  }

//  $prueba = "-|PRUEBA|PRUEBA|PRUEBA|PRUEBA|PRUEBA|--";

  $table->rowStyle('align:{C} border:TB; valign:B');
  $table->easyCell("Total de Inasistencias:    ", 'colspan:2; border:L; align:L; valign:B');
  $table->easyCell("Justif. ", 'colspan:2; align:L;; valign:B');
  $table->easyCell("Injustificadas:", 'colspan:2; align:L; border:R; valign:B');
  $table->printRow();
  $table->endTable(0); // Fin tabla calificaciones


  $pdf->SetFont('helvetica','',6); // Fuente de firma

  $table_pie=new easyTable($pdf,2, $estiloTabla); //Tabla de pie


  $table_pie->rowStyle('min-height:12; align:{C} border:1; valign:B');
  $table_pie->easyCell("Vicerrector/a" , 'border:1');
  $table_pie->easyCell("Firma de Madre/Padre/Tutor(a)/Encargado(a)", 'align:C; border:1');
  $table_pie->printRow();

  $table_pie->rowStyle('border:U; valign:B; colspan:4');
  $table_pie->easyCell("Impreso el " . date("d/M"), 'align:L; border:0');
  $table_pie->printRow();



  $table_pie->endTable(4); //fin tabla pie
  $pdf->SetFont('helvetica','',8);
//  $pdf->Write(6, "Impreso el " . date("d/M"));
 }
 if(!$cantAlu) {
  $pdf->SetDisplayMode('fullpage','default');
  $pdf-> SetFontSize(24);
  $pdf->Write(16, $cur . "° " . $divi . ': División sin alumnos');
 }


 $pdf->Output('I','Curso ' . $cur . ' - ' . $divi);

?>

