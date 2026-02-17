<?php
/* Reclamo de documentación para pegar en el cuaderno de comunicaciones
** Se genera en 2 copias a la par para guardar constancia
*/
session_start();
include 'fpdf.php';
include 'exfpdf.php';
include 'easyTable.php';
include 'conexion.php';

$_mes = ["","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre"];
$_dia = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sabado"];
$f = time();
$fechaDMA = $_dia[date('w',$f)] . date(' j \d\e ',$f) . $_mes[date('n',$f)] . date(' \d\e Y',$f);

$pdf=new exFPDF("L","mm","LEGAL");
$pdf->SetAutoPageBreak(TRUE,8);


// Uncomment cuando sea curso completo
$cur = $_POST['curso'];
$div = $_POST['division'];
// unset($_SESSION['alus']);
// $tipo_docu = $_SESSION['tiposDoc'];
// unset($_SESSION['tiposDoc']);


//$nnnnnn = $_POST;

//$alumnos = [47268216,46580114,95269300];

unset($tipo_docu);
foreach($_POST['tiposDoc'] AS $ids) {
	$tipo_docu[] = $ids;
}

// $tipo_docu = [1,3,4,5,6,11,14,20];

// Para buscar todos los tipos solicitados en la BD
$listID = "(";
foreach($tipo_docu as $id) $listID = $listID . $id . ",";
$listID = substr($listID,0,-1) . ")";
$listID = trim($listID,"'");

$destinatario = "Familiar responsable de ";
// $solicitud  ="\tLa Secretaría del Colegio Sobral solicita que <b>a la mayor brevedad posible</b> se acerque a entregar la documentación que se detalla a continuación para completar su legajo. ";
$solicitud  ="	Por la presente se les comunica que deberán completar la documentación faltante en el legajo del estudiante a fin de evitar posibles inconvenientes al solicitar Constancias o Certificados. Ante cualquier inquietud no duden en consultar a cpdjmsobral@tdf.edu.ar";
$enumera = "DOCUMENTACIÓN QUE ADEUDA:";

$remite = "DEPARTAMENTO ALUMNOS – Colegio Provincial Dr. José María Sobral";

if (isset($_POST['parrAdicional']) && $_POST['parrAdicional']!='') $parrAdicional = $_POST['parrAdicional'];

unset($alumnos);
$conexion = conectar ();
$qCurso = mysql_query("SELECT alumno FROM `cursa` WHERE `curso` = '$cur' AND `divi` = '$div' AND `control` = 1");
while($integrante = mysql_fetch_assoc($qCurso)) 
{
	$alumnos[]=$integrante['alumno'];
}

$qDocumentacion = mysql_query("SELECT * FROM documentacion WHERE id IN $listID");
// $nnnnnn = var_export($listID,true);
unset($documentacion);
while ($id = mysql_fetch_assoc($qDocumentacion)) $documentacion[$id['id']] = $id['nombre'];

$dosPorHoja = TRUE;

foreach($alumnos as $deudor)
{
 $qDatosAlumno = mysql_query("SELECT * FROM alumno WHERE dni = '$deudor'");
 $datosAlumno = mysql_fetch_assoc($qDatosAlumno);

// $datosPersonales = "Apellido y nombre: " . strtoupper($datosAlumno['apellido']) . ", " .
 $datosPersonales = strtoupper($datosAlumno['apellido']) . ", " .
	ucwords(strtolower($datosAlumno['nombre'])) . " de " . $cur . "° Año " . $div . "° División";
 $documento = "D.N.I.: " . number_format($deudor,0,",",".");
 
 $pdf->SetFont('helvetica','',10);
 $pdf->AddFont('helvetica','B','helveticab.php');
 
 if ($dosPorHoja) $pdf->AddPage("L","LEGAL"); 
 $dosPorHoja = !$dosPorHoja;
 
 $encabezado=new easyTable($pdf, '%{50,50}'); //, 'width:150; align:L; font-style:B; font-size:15;font-family:times;');
 
 $encabezado->easyCell($destinatario . $datosPersonales, 'align:L; border:0');
 $encabezado->easyCell($destinatario . $datosPersonales, 'align:L; border:0');
 $encabezado->printRow();
 
 $encabezado->easyCell($documento, 'align:L; border:0');
 $encabezado->easyCell($documento, 'align:L; border:0');
 $encabezado->printRow();

 $encabezado->easyCell($solicitud, 'align:L; border:0');
 $encabezado->easyCell($solicitud, 'align:L; border:0');
 $encabezado->printRow();
 
 /*$encabezado->easyCell($datosPersonales, 'align:L; border:0; paddingX: 3');
 $encabezado->easyCell($datosPersonales, 'align:L; border:0; paddingX: 3');
 $encabezado->printRow(); */

 
 $encabezado->easyCell($enumera, 'align:L; border:0');
 $encabezado->easyCell($enumera, 'align:L; border:0');
 $encabezado->printRow();
 $encabezado->endTable(0);
 
/////////////////////////////////////////////////////////// Documentación adeudada
 $reclamo=new easyTable($pdf, '%{25,25,25,25}'); //, 'width:150; align:L; font-style:B; font-size:15;font-family:times;');
 $contCol = array();

foreach($tipo_docu as $debe)
{ // lista de documentación adeudada 
 $qDebe = mysql_query("SELECT * FROM docu_alu WHERE id = '$debe' AND alumno = '$deudor'");
 if (!mysql_num_rows($qDebe)) 
 {
  $contCol[] = "- ".$documentacion[$debe];
 }
 elseif ($debe==3) // verifica para el DNI la fecha de vencimiento y reclama en función de eso
 {
  $vtoDni = mysql_fetch_assoc($qDebe);
  if (strstr($vtoDni['descripcion'],"/")) 
  {
	  $conBarras = explode("/",$vtoDni['descripcion']);
	  $vtoDni['descripcion'] = $conBarras[2] . "-" . $conBarras[1] . "-" . $conBarras[0];
  }
  $diferencia = strtotime($vtoDni['descripcion']) - strtotime("now");
  if ($diferencia<1)
  {  
   $contCol[] = "- ".$documentacion[$debe];
  }
 }
}

 $columnaPar = TRUE; //2 columnas
 $indiceLinea = 0;
 $contLinea = array();
 foreach($contCol AS $docAde)
 {
  $columnaPar = !$columnaPar;
   if ($columnaPar)
   {
    $contLinea[$indiceLinea][] = $docAde;
    $indiceLinea++;
   }
   else $contLinea[$indiceLinea][] = $docAde;
 }

foreach ($contLinea AS $colAde)
{
 $reclamo->easyCell($colAde[0],'align:L; border:0; paddingX: 5');
 if (isset($colAde[1])) $reclamo->easyCell($colAde[1],'align:L; border:0; paddingX: 5');
 else $reclamo->easyCell("",'align:L; border:0; paddingX: 5');
 $reclamo->easyCell($colAde[0],'align:L; border:0; paddingX: 5');
 if (isset($colAde[1])) $reclamo->easyCell($colAde[1],'align:L; border:0; paddingX: 5');
 else $reclamo->easyCell("",'align:L; border:0; paddingX: 5');
 $reclamo->printRow();
}
//unset($contLinea);
// $parrAdicional = "lineas: $indiceLinea Contenido: " . var_export($contLinea,true);
if (isset($parrAdicional)) 
{
 $reclamo->easyCell($parrAdicional, 'colspan:2; align:L; border:0');
 $reclamo->easyCell($parrAdicional, 'colspan:2; align:L; border:0');
 $reclamo->printRow();
}
$reclamo->easyCell();
$reclamo->printRow();
$reclamo->easyCell();
$reclamo->printRow();

$reclamo->endTable(1);

////////////////////////////////////////// Pie de reclamo

$pie=new easyTable($pdf, '%{7,9,16,5,10,3,7,10,15,5,10,3}'); //, 'width:150; align:L; font-style:B; font-size:15;font-family:times;');

$pie->easyCell($fechaDMA, 'colspan:6; align:R; border:0; paddingX: 3');
$pie->easyCell($fechaDMA, 'colspan:6; align:R; border:0; paddingX: 3');
$pie->printRow();

$pie->easyCell($remite, 'colspan:6; align:R; border:0; paddingX: 3');
$pie->easyCell($remite, 'colspan:6; align:R; border:0; paddingX: 3');
$pie->printRow();



$pie->easyCell("Notificado:", 'align:R; border:0');
$pie->easyCell("", 'colspan:2; align:R; border:B');
$pie->easyCell("Fecha:", 'align:R; border:0');
$pie->easyCell("", 'align:R; border:B');
$pie->easyCell("", 'align:R; border:0');
$pie->easyCell("Notificado:", 'align:R; border:0');
$pie->easyCell("", 'colspan:2; align:R; border:B');
$pie->easyCell("Fecha:", 'align:R; border:0');
$pie->easyCell("", 'align:R; border:B');
$pie->easyCell("", 'align:R; border:0');
$pie->printRow();

$pie->easyCell("Celular/Correo electrónico:", 'colspan:2; align:R; border:0');
$pie->easyCell("", 'colspan:3; align:R; border:B');
$pie->easyCell("", 'align:R; border:0');
$pie->printRow();

$pdf->SetFont('helvetica','',6);

$pie->easyCell("Para el Legajo", 'colspan:6; align:C; border:0');
$pie->easyCell("Para Cuaderno de Comunicaciones", 'colspan:6; align:C; border:0');
$pie->printRow();

$pie->endTable(3);
}
/* $pdf->AddPage("L","A4"); 
 $pdf->Write(8,var_export($_POST,true));
// $pdf->Write(8,"D".var_export($div,true));*/
 $pdf->Output(); 

?>
