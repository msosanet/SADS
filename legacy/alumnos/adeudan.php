<?php
/* Devuelve PDF con listado de estudiantes para
** un determinado curso, división y ciclo lectivo,
** especificando materias adeudadas de cada uno.
** Si no se especifica ciclo lectivo toma el ciclo
** actual.
*/
session_start();

include 'conexion.php';
$conexion = conectar();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
if (!mysql_num_rows($resultt)) {
	header('Location: i_admin.php');
	exit;
}


require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL','landscape');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
//include 'conexion.php';

$curso=$_GET["curso"];
$div=$_GET["div"];

if (isset($_GET['cl']) AND $_GET['cl']!='')
	{$anio=$_GET['cl'];
	 $ctrl=0;}
	else {
	 $anio=$_SESSION['cicloLectivo'];
	 $ctrl=1;
	}

$resEmp2 = mysql_query ("SELECT DISTINCT previas.alumno FROM cursa,previas WHERE cursa.curso = '$curso' and cursa.divi = '$div' and cursa.anio='$anio' and cursa.control='$ctrl' and previas.alumno=cursa.alumno and previas.nota < 6");

$totEmp2 = mysql_num_rows($resEmp2);

$ixx2 = 0;

while($datatmp2 = mysql_fetch_assoc($resEmp2)) {
 $todas="";

 $ixx2++;
 //$previas = mysql_query ("SELECT materia FROM previas WHERE alumno = $datatmp2[alumno] and nota < 6");
 $previas = mysql_query ("SELECT CONCAT(materias2023.descripcion, ' ',previas.curso, '°') AS materia,IF(ISNULL(previas.movilidad),'',' (M.E.)') AS movi FROM previas LEFT JOIN materias2023 ON previas.idmateria = materias2023.idmateria WHERE alumno=$datatmp2[alumno] AND (nota < 6 OR observacion='ADEUDA') ");
 $todas = "";
 while($prev = mysql_fetch_array($previas)) $todas .= ucwords(strtolower($prev['materia'])).$prev['movi']." - ";

 $previas2 = mysql_query ("SELECT * FROM alumno WHERE dni = $datatmp2[alumno]");
 $prev2 = mysql_fetch_array($previas2);

 $data2[] = array_merge($datatmp2, array('numero'=>$ixx2), array('todas2'=>substr($todas,0,-3)), array('nombre'=>$prev2['nombre']), array('apellido'=>$prev2['apellido']));
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
//$pdf->ezText(var_export($cons,true));
$pdf->ezText(" ");
$pdf->ezText("Fecha de impresión: " . $fechaDMA, 10,array('justification'=>'left'));


$pdf->ezStream();
?>
