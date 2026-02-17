<?php
require_once('class.ezpdf.php');
$pdf = new Cezpdf('LEGAL');
$pdf->selectFont('../fonts/php_Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
include 'conexion.php';
$conexion = conectar ();





$resEmp2 = mysql_query ("SELECT * FROM mesas order by codigo");
$totEmp2 = mysql_num_rows($resEmp2);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$docente=$datatmp2["dni"];
	$rest1 = substr($docente, 0, 2);
	$rest2 = substr($docente, 2, 3);
	$rest3 = substr($docente, 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;
	$prueba = mysql_query ("SELECT * FROM alumnos_mesas where dni = '$rest4'");
	$fran = mysql_fetch_array($prueba);
	$prueba2 = mysql_query ("SELECT * FROM docentes_mesas where codigo = $datatmp2[codigo];");
	$fran2 = mysql_fetch_array($prueba2);
	$apeynom=$fran[alumno];
	$materia=$fran2[materia]." ".$fran2[curso]." ".$fran2[plan];
	$data2[] = array_merge($datatmp2, array('alumno'=>$apeynom),  array('materia'=>$materia));
}

$titles2 = array(
				'numero'=>'<b>Permiso</b>',
				'alumno'=>'<b>Alumno</b>',
				'materia'=>'<b>Materia</b>',


				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);

$resEmp2 = mysql_query ("SELECT * FROM mesas where codigo=4 or codigo=5 or codigo=6 order by codigo");
$totEmp2 = mysql_num_rows($resEmp2);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$docente=$datatmp2["dni"];
	$rest1 = substr($docente, 0, 2);
	$rest2 = substr($docente, 2, 3);
	$rest3 = substr($docente, 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;
	$prueba = mysql_query ("SELECT * FROM alumnos_mesas where dni = '$rest4'");
	$fran = mysql_fetch_array($prueba);
	$prueba2 = mysql_query ("SELECT * FROM docentes_mesas where codigo = $datatmp2[codigo];");
	$fran2 = mysql_fetch_array($prueba2);
	$apeynom=$fran[alumno];
	$materia=$fran2[materia]." ".$fran2[curso]." ".$fran2[plan];
	$data2[] = array_merge($datatmp2, array('alumno'=>$apeynom),  array('materia'=>$materia));
}

$titles2 = array(
				'numero'=>'<b>Permiso</b>',
				'alumno'=>'<b>Alumno</b>',
				'materia'=>'<b>Materia</b>',


				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);
$resEmp2 = mysql_query ("SELECT * FROM mesas where codigo=7 or codigo=8 or codigo=9 order by codigo");
$totEmp2 = mysql_num_rows($resEmp2);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$docente=$datatmp2["dni"];
	$rest1 = substr($docente, 0, 2);
	$rest2 = substr($docente, 2, 3);
	$rest3 = substr($docente, 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;
	$prueba = mysql_query ("SELECT * FROM alumnos_mesas where dni = '$rest4'");
	$fran = mysql_fetch_array($prueba);
	$prueba2 = mysql_query ("SELECT * FROM docentes_mesas where codigo = $datatmp2[codigo];");
	$fran2 = mysql_fetch_array($prueba2);
	$apeynom=$fran[alumno];
	$materia=$fran2[materia]." ".$fran2[curso]." ".$fran2[plan];
	$data2[] = array_merge($datatmp2, array('alumno'=>$apeynom),  array('materia'=>$materia));
}

$titles2 = array(
				'numero'=>'<b>Permiso</b>',
				'alumno'=>'<b>Alumno</b>',
				'materia'=>'<b>Materia</b>',


				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);

$resEmp2 = mysql_query ("SELECT * FROM mesas where codigo=10 or codigo=11 or codigo=12 order by codigo");
$totEmp2 = mysql_num_rows($resEmp2);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$docente=$datatmp2["dni"];
	$rest1 = substr($docente, 0, 2);
	$rest2 = substr($docente, 2, 3);
	$rest3 = substr($docente, 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;
	$prueba = mysql_query ("SELECT * FROM alumnos where dni = '$rest4'");
	$fran = mysql_fetch_array($prueba);
	$prueba2 = mysql_query ("SELECT * FROM docentes_mesas where codigo = $datatmp2[codigo];");
	$fran2 = mysql_fetch_array($prueba2);
	$apeynom=$fran[alumno];
	$dni=$fran[dni];
	$materia=$fran2[materia]." ".$fran2[curso]." ".$fran2[plan];
	$data2[] = array_merge($datatmp2, array('alumno'=>$apeynom),  array('materia'=>$materia),  array('dni'=>$dni));
}

$titles2 = array(
				'numero'=>'<b>Permiso</b>',
				'dni'=>'<b>DNI</b>',
				'alumno'=>'<b>Alumno</b>',
				'materia'=>'<b>Materia</b>',
				


				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);
$resEmp2 = mysql_query ("SELECT * FROM mesas where codigo=13 or codigo=14 or codigo=15 order by codigo");
$totEmp2 = mysql_num_rows($resEmp2);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$docente=$datatmp2["dni"];
	$rest1 = substr($docente, 0, 2);
	$rest2 = substr($docente, 2, 3);
	$rest3 = substr($docente, 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;
	$prueba = mysql_query ("SELECT * FROM alumnos_mesas where dni = '$rest4'");
	$fran = mysql_fetch_array($prueba);
	$prueba2 = mysql_query ("SELECT * FROM docentes_mesas where codigo = $datatmp2[codigo];");
	$fran2 = mysql_fetch_array($prueba2);
	$apeynom=$fran[alumno];
	$dni=$fran[dni];
	$materia=$fran2[materia]." ".$fran2[curso]." ".$fran2[plan];
	$data2[] = array_merge($datatmp2, array('alumno'=>$apeynom),  array('materia'=>$materia), array('dni'=>$dni));
}

$titles2 = array(
				'numero'=>'<b>Permiso</b>',
				'dni'=>'<b>DNI</b>',
				'alumno'=>'<b>Alumno</b>',
				'materia'=>'<b>Materia</b>',


				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);

$resEmp2 = mysql_query ("SELECT * FROM mesas where codigo=16 or codigo=17 or codigo=18 order by codigo");
$totEmp2 = mysql_num_rows($resEmp2);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$docente=$datatmp2["dni"];
	$rest1 = substr($docente, 0, 2);
	$rest2 = substr($docente, 2, 3);
	$rest3 = substr($docente, 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;
	$prueba = mysql_query ("SELECT * FROM alumnos_mesas where dni = '$rest4'");
	$fran = mysql_fetch_array($prueba);
	$prueba2 = mysql_query ("SELECT * FROM docentes_mesas where codigo = $datatmp2[codigo];");
	$fran2 = mysql_fetch_array($prueba2);
	$apeynom=$fran[alumno];
	$materia=$fran2[materia]." ".$fran2[curso]." ".$fran2[plan];
	$data2[] = array_merge($datatmp2, array('alumno'=>$apeynom),  array('materia'=>$materia));
}

$titles2 = array(
				'numero'=>'<b>Permiso</b>',
				'alumno'=>'<b>Alumno</b>',
				'materia'=>'<b>Materia</b>',


				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);
$resEmp2 = mysql_query ("SELECT * FROM mesas where codigo=19 or codigo=20 or codigo=21 order by codigo");
$totEmp2 = mysql_num_rows($resEmp2);


$ixx2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$docente=$datatmp2["dni"];
	$rest1 = substr($docente, 0, 2);
	$rest2 = substr($docente, 2, 3);
	$rest3 = substr($docente, 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;
	$prueba = mysql_query ("SELECT * FROM alumnos_mesas where dni = '$rest4'");
	$fran = mysql_fetch_array($prueba);
	$prueba2 = mysql_query ("SELECT * FROM docentes_mesas where codigo = $datatmp2[codigo];");
	$fran2 = mysql_fetch_array($prueba2);
	$apeynom=$fran[alumno];
	$materia=$fran2[materia]." ".$fran2[curso]." ".$fran2[plan];
	$data2[] = array_merge($datatmp2, array('alumno'=>$apeynom),  array('materia'=>$materia));
}

$titles2 = array(
				'numero'=>'<b>Permiso</b>',
				'alumno'=>'<b>Alumno</b>',
				'materia'=>'<b>Materia</b>',


				

			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>550
			);


$result5 = mysql_query ("SELECT * FROM docentes_mesas where codigo = $mesa");
$fila5 = mysql_fetch_array($result5);

$result1 = mysql_query ("SELECT * FROM docentes where dni='$fila5[dni1]'");
$fila1 = mysql_fetch_array($result1) ;

$result2 = mysql_query ("SELECT * FROM docentes where dni='$fila5[dni2]'");
$fila2 = mysql_fetch_array($result2) ;

$result3 = mysql_query ("SELECT * FROM docentes where dni='$fila5[dni3]'");
$fila3 = mysql_fetch_array($result3) ;

$result4 = mysql_query ("SELECT * FROM docentes where dni='$fila5[dni4]'");
$fila4 = mysql_fetch_array($result4) ;


$d=explode("-", $fila5[fecha]);
$f=$d[2]."/".$d[1]."/".$d[0];

$txttit34 = "<b>LISTADO DE TODOS LAS MATERIAS CON ALUMNOS</b>";
$txttit34 = mb_convert_encoding($txttit34, "ISO-8859-1", "UTF-8");
$diia=date("d-m-Y");



$textofinal="Total de alumnos:";
$textofinal2="Aprobados:";
$textofinal3="Aplazados:";
$textofinal4="Ausentes:";


$pdf->ezImage("logo4.jpg", 0, 520, 'none','');
$pdf->ezText($txttit34, 15,array('justification'=>'center'));
$pdf->ezText("\n", 10);

$pdf->ezTable($data2, $titles2, '', $options2);


$pdf->ezStream();
?>

