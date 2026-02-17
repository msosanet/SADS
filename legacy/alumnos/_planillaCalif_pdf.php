<?php
$_letras = [ "s/c"=>"Sin calificar",0=>"Sin calificar","Uno","Dos","Tres","Cuatro","Cinco","Seis","Siete","Ocho","Nueve","Diez"];
$_turno = ["","Mañana","Tarde","Vespertino"];

 include 'fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include 'conexioncalif.php';
 

 if (isset($_GET['cd']) && preg_match('/[1-7](10|11|[1-9|a])/i',$_GET['cd'],$coincide)) $curso = $coincide[0];
 else echo '<head><meta http-equiv="refresh" content="0;vercalif.php"></head>';
 
 if (isset($_GET['inst']) && preg_match('/[0-8]/i',$_GET['inst'],$instanciaValida)) $instancia['idnota'] = $instanciaValida[0];
 else $instancia['idnota'] = 2; // Imprime la planilla del primer cuatrimestre
 
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
 $instancia_q = mysql_query("SELECT MAX(idnota) AS idnota FROM `calificador2` WHERE curso = '$curso' AND anio = '$anio' ");
 // $instancia = mysql_fetch_assoc($instancia_q);
 // $instancia['idnota'] = 2; // Imprime la planilla del primer cuatrimestre
 $nomInst_q = mysql_query("SELECT * FROM `calificaciones`");
 unset($instancias);
 while ($nomInst = mysql_fetch_assoc($nomInst_q))
 {
  $instancias[$nomInst['id']] = $nomInst;
 }

 $cantAlu = mysql_num_rows($alumnos_q);

 $titulo = "Colegio Provincial Dr. José María Sobral\n" . $instancias[$instancia['idnota']]['descripcion'] . " Ciclo Lectivo " . $anio;

  $pdf=new exFPDF('P','mm','A4');
  $pdf->AddPage(); 
  $pdf->SetFont('helvetica','',8);

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

//  $table_enc->easyCell("<b>VERSIÓN DE PRUEBA</b>. (Aquí va el nombre y apellido del estudiante)", 'align:L; colspan:3; border:0');
  $table_enc->easyCell("Estudiante: <b>" . strtoupper(trim($alumno['apellido'])) . ", " . ucwords(strtolower(trim($alumno['nombre']))) . "</b>", 'align:L; colspan:3; border:0');
  $table_enc->printRow();
  $table_enc->easyCell("Curso: " . $cur . "°", 'align:L; border:0');
  $table_enc->easyCell("División: " . strtoupper($divi), 'align:L; border:0');
  $table_enc->easyCell("Turno: " . $_turno[$tur['turno']] , 'align:L; border:0');
  $table_enc->printRow();
  $table_enc->endTable(0); //fin tabla encabezado
  
//  $table=new easyTable($pdf, '{45, 17, 28}', $estiloTabla); // Para 1er informe
  $table=new easyTable($pdf, '{40, 11, 11, 28}', $estiloTabla); // Para 1er cuatrimestre

  $table->easyCell("Espacio", 'align:C; border:1');
  
  for ($idn = 1; $idn <= $instancia['idnota']; $idn++)
  {
   $table->easyCell($instancias[$idn]['abreviado'], 'align:C; border:1');
  }
  $table->easyCell("Calificación \nen letras", 'align:C; border:1');
  $table->printRow();
  
  mysql_data_seek($materias_q,0);
  mysql_select_db('calificadores');
  while ($materia = mysql_fetch_assoc($materias_q)) { // Filas por espacios académicos
//   $calif_q = mysql_query("SELECT * FROM calificador WHERE dni = '$alumno[dni]' AND materia = '$materia[idmateria]' AND anio = '$anio'");
   $calif_q = mysql_query("SELECT * FROM calificador2 WHERE dni = '$alumno[dni]' AND materia = '$materia[idmateria]' AND anio = '$anio' AND curso = '$curso'");
   while ($calificacion = mysql_fetch_assoc($calif_q))
   {
    $calif[$calificacion['idnota']] = $calificacion['nota'];
   }
   
   $table->easyCell(ucwords(strtolower($materia['descripcion'])), 'align:L; border:1');

   for ($id = 1; $id<=2; $id++)
//   foreach($calif AS $id => $nota)
   {
    // Transforma la calificación 0/FALSE/NULL en "Sin calificar"
    if ($calif[$id]==0 OR !isset($calif[$id])) $calif[$id]  = "s/c";
   }
   
   $table->easyCell($calif[1], 'align:C; border:1; valign:M');
   $table->easyCell($calif[2], 'font-style:B; align:C; border:1; valign:M');
   $table->easyCell($_letras[$calif[2]], 'align:C; border:1; valign:M');
//   $table->easyCell(var_export($calif,true), 'align:C; border:1; valign:M');
   $table->printRow();
   
   unset($calif);
 
  }
  
//  $prueba = "-|PRUEBA|PRUEBA|PRUEBA|PRUEBA|PRUEBA|--";
  
  $table->rowStyle('align:{C} border:TB; valign:B');
  $table->easyCell("Total de Inasistencias:    ", 'colspan:1; border:L; align:L; valign:B');
  $table->easyCell("Justificadas: ", 'colspan:2; align:L;; valign:B');
  $table->easyCell("Injustificadas:", 'colspan:1; align:L; border:R; valign:B');
  $table->printRow();
  $table->endTable(0); // Fin tabla calificaciones
  

  $pdf->SetFont('helvetica','',6); // Fuente de firma  

  $table_pie=new easyTable($pdf, 2, $estiloTabla); //Tabla de pie


  $table_pie->rowStyle('min-height:12; align:{C} border:1; valign:B');
  $table_pie->easyCell("Vicerrector/a" , 'border:1');
  $table_pie->easyCell("Firma de Madre/Padre/Tutor(a)/Encargado(a)", 'align:C; border:1');
  $table_pie->printRow();


  $table_pie->endTable(5); //fin tabla pie
  $pdf->SetFont('helvetica','',8);
 }
 if(!$cantAlu) {
  $pdf->SetDisplayMode('fullpage','default');
  $pdf-> SetFontSize(24);
  $pdf->Write(16, $cur . "° " . $divi . ': División sin alumnos');
 }


 $pdf->Output('I','Curso ' . $cur . ' - ' . $divi); 

?>