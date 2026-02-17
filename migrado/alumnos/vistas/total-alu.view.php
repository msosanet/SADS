<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador de Alumnos</title>



</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
$resultmotivo = mysql_query ("SELECT * FROM motivo_dec");



?>

<body background="bgris.gif" >


<form method="GET" action="total-alu.php">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>

			<div align="center">
			<table border="0" width="980">

<?if ($_SESSION['valor']==1)
{
include 'menuppal2.php';
}
if ($_SESSION['valor']==0)
{
include 'menuppal.php';
}
if ($_SESSION['valor']==3)
{
include 'menuppal3.php';
}
if ($_SESSION['valor']==4)
{
include 'menuppal4.php';
}
?>

				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Cant. de Alumnos por curso.</p>
						</p>
					<p align="center">&nbsp;

					</p>


<?
$anio=$_SESSION{'cicloLectivo'};


$primero1 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '1' and divi='1' and anio='$anio' and control=1");
$fila11 = mysql_fetch_array($primero1);

$m11 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '1' and cursa.divi='1' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m11 = mysql_fetch_array($m11);

$primero2 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '1' and divi='2' and anio='$anio' and control=1");
$fila12 = mysql_fetch_array($primero2);

$m12 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '1' and cursa.divi='2' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m12 = mysql_fetch_array($m12);

$primero3 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '1' and divi='3' and anio='$anio' and control=1");
$fila13 = mysql_fetch_array($primero3);

$m13 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '1' and cursa.divi='3' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m13 = mysql_fetch_array($m13);

$primero4 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '1' and divi='4' and anio='$anio' and control=1");
$fila14 = mysql_fetch_array($primero4);

$m14 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '1' and cursa.divi='4' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m14 = mysql_fetch_array($m14);

$primero5 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '1' and divi='5' and anio='$anio' and control=1");
$fila15 = mysql_fetch_array($primero5);

$m15 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '1' and cursa.divi='5' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m15 = mysql_fetch_array($m15);

$primero6 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '1' and divi='B' and anio='$anio' and control=1");
$fila16 = mysql_fetch_array($primero6);

$m16 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '1' and cursa.divi='B' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m16 = mysql_fetch_array($m16);

$primero7 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '1' and divi='A' and anio='$anio' and control=1");
$fila17 = mysql_fetch_array($primero7);

$m17 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '1' and cursa.divi='A' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m17 = mysql_fetch_array($m17);

//$primero10 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '1' and divi='10' and anio='$anio' and control=1");
//$fila110 = mysql_fetch_array($primero10);

$primero = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '1' and anio='$anio' and control=1");
$fila1 = mysql_fetch_array($primero);



$segundo1 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='1' and anio='$anio' and control=1");
$fila21 = mysql_fetch_array($segundo1);

$m21 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='1' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m21 = mysql_fetch_array($m21);

$segundo2 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='2' and anio='$anio' and control=1");
$fila22 = mysql_fetch_array($segundo2);

$m22 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='2' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m22 = mysql_fetch_array($m22);

$segundo3 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='3' and anio='$anio' and control=1");
$fila23 = mysql_fetch_array($segundo3);

$m23 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='3' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m23 = mysql_fetch_array($m23);

$segundo4 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='4' and anio='$anio' and control=1");
$fila24 = mysql_fetch_array($segundo4);

$m24 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='4' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m24 = mysql_fetch_array($m24);

$segundo5 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='5' and anio='$anio' and control=1");
$fila25 = mysql_fetch_array($segundo5);

$m25 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='5' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m25 = mysql_fetch_array($m25);

$segundo6 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='B' and anio='$anio' and control=1");
$fila26 = mysql_fetch_array($segundo6);

$m26 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='B' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m26 = mysql_fetch_array($m26);

$segundo7 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='7' and anio='$anio' and control=1");
$fila27 = mysql_fetch_array($segundo7);

$m27 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='7' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m27 = mysql_fetch_array($m27);

$segundo8 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='8' and anio='$anio' and control=1");
$fila28 = mysql_fetch_array($segundo8);

$m28 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='8' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m28 = mysql_fetch_array($m28);

$segundo9 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='9' and anio='$anio' and control=1");
$fila29 = mysql_fetch_array($segundo9);

$m29 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='9' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m29 = mysql_fetch_array($m29);

$segundo10 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='10' and anio='$anio' and control=1");
$fila210 = mysql_fetch_array($segundo10);

$m210 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='10' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m210 = mysql_fetch_array($m210);

$segundo11 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='11' and anio='$anio' and control=1");
$fila211 = mysql_fetch_array($segundo11);

$m211 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='11' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m211 = mysql_fetch_array($m211);

$segundoaa = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = 'A' and divi='A' and anio='$anio' and control=1");
$filaaa = mysql_fetch_array($segundoaa);



$maa = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = 'A' and cursa.divi='A' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$maa = mysql_fetch_array($maa);






$segundoA = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '2' and divi='A' and anio='$anio' and control=1");
$filA = mysql_fetch_array($segundoA);

$segundo = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE (curso = '2' or curso='A') and anio='$anio' and control=1");
$fila2 = mysql_fetch_array($segundo);

$m2a = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '2' and cursa.divi='A' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m2a = mysql_fetch_array($m2a);


$tercero1 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '3' and divi='1' and anio='$anio' and control=1");
$fila31 = mysql_fetch_array($tercero1);

$m31 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '3' and cursa.divi='1' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m31 = mysql_fetch_array($m31);

$tercero2 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '3' and divi='2' and anio='$anio' and control=1");
$fila32 = mysql_fetch_array($tercero2);

$m32 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '3' and cursa.divi='2' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m32 = mysql_fetch_array($m32);

$tercero3 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '3' and divi='3' and anio='$anio' and control=1");
$fila33 = mysql_fetch_array($tercero3);

$m33 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '3' and cursa.divi='3' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m33 = mysql_fetch_array($m33);

$tercero4 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '3' and divi='4' and anio='$anio' and control=1");
$fila34 = mysql_fetch_array($tercero4);

$m34 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '3' and cursa.divi='4' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m34 = mysql_fetch_array($m34);

$tercero5 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '3' and divi='5' and anio='$anio' and control=1");
$fila35 = mysql_fetch_array($tercero5);

$m35 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '3' and cursa.divi='5' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m35 = mysql_fetch_array($m35);

$tercero6 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '3' and divi='B' and anio='$anio' and control=1");
$fila36 = mysql_fetch_array($tercero6);

$m36 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '3' and cursa.divi='B' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m36 = mysql_fetch_array($m36);

$tercero7 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '3' and divi='7' and anio='$anio' and control=1");
$fila37 = mysql_fetch_array($tercero7);

$m37 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '3' and cursa.divi='7' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m37 = mysql_fetch_array($m37);

$tercero8 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '3' and divi='8' and anio='$anio' and control=1");
$fila38 = mysql_fetch_array($tercero8);

$m38 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '3' and cursa.divi='8' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m38 = mysql_fetch_array($m38);

$tercero9 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '3' and divi='9' and anio='$anio' and control=1");
$fila39 = mysql_fetch_array($tercero9);

$m39 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '3' and cursa.divi='9' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m39 = mysql_fetch_array($m39);



$terceroA = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '3' and divi='A' and anio='$anio' and control=1");
$fila3A = mysql_fetch_array($terceroA);

$m3A = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '3' and cursa.divi='A' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m3A = mysql_fetch_array($m3A);


$tercero = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '3' and anio='$anio' and control=1");
$fila3 = mysql_fetch_array($tercero);



$cuarto1 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '4' and divi='1' and anio='$anio' and control=1");
$fila41 = mysql_fetch_array($cuarto1);

$m41 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '4' and cursa.divi='1' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m41 = mysql_fetch_array($m41);

$cuarto2 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '4' and divi='2' and anio='$anio' and control=1");
$fila42 = mysql_fetch_array($cuarto2);

$m42 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '4' and cursa.divi='2' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m42 = mysql_fetch_array($m42);

$cuarto3 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '4' and divi='3' and anio='$anio' and control=1");
$fila43 = mysql_fetch_array($cuarto3);

$m43 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '4' and cursa.divi='3' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m43 = mysql_fetch_array($m43);

$cuarto4 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '4' and divi='4' and anio='$anio' and control=1");
$fila44 = mysql_fetch_array($cuarto4);

$m44 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '4' and cursa.divi='4' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m44 = mysql_fetch_array($m44);

$cuarto5 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '4' and divi='5' and anio='$anio' and control=1");
$fila45 = mysql_fetch_array($cuarto5);

$m45 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '4' and cursa.divi='5' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m45 = mysql_fetch_array($m45);

$cuarto6 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '4' and divi='6' and anio='$anio' and control=1");
$fila46 = mysql_fetch_array($cuarto6);

$m46 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '4' and cursa.divi='6' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m46 = mysql_fetch_array($m46);

$cuarto7 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '4' and divi='7' and anio='$anio' and control=1");
$fila47 = mysql_fetch_array($cuarto7);

$m47 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '4' and cursa.divi='7' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m47 = mysql_fetch_array($m47);

$cuarto8 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '4' and divi='8' and anio='$anio' and control=1");
$fila48 = mysql_fetch_array($cuarto8);

$m48 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '4' and cursa.divi='8' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m48 = mysql_fetch_array($m48);

$cuarto9 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '4' and divi='9' and anio='$anio' and control=1");
$fila49 = mysql_fetch_array($cuarto9);

$m49 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '4' and cursa.divi='9' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m49 = mysql_fetch_array($m49);

$cuartoA = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '4' and divi='A' and anio='$anio' and control=1");
$fila4A = mysql_fetch_array($cuartoA);

$m4A = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '4' and cursa.divi='A' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m4A = mysql_fetch_array($m4A);




$cuarto = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '4' and anio='$anio' and control=1");
$fila4 = mysql_fetch_array($cuarto);


$quinto1 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '5' and divi='1' and anio='$anio' and control=1");
$fila51 = mysql_fetch_array($quinto1);

$m51 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '5' and cursa.divi='1' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m51 = mysql_fetch_array($m51);

$quinto2 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '5' and divi='2' and anio='$anio' and control=1");
$fila52 = mysql_fetch_array($quinto2);

$m52 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '5' and cursa.divi='2' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m52 = mysql_fetch_array($m52);

$quinto3 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '5' and divi='3' and anio='$anio' and control=1");
$fila53 = mysql_fetch_array($quinto3);

$m53 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '5' and cursa.divi='3' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m53 = mysql_fetch_array($m53);

$quinto4 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '5' and divi='4' and anio='$anio' and control=1");
$fila54 = mysql_fetch_array($quinto4);

$m54 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '5' and cursa.divi='4' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m54 = mysql_fetch_array($m54);

$quinto5 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '5' and divi='5' and anio='$anio' and control=1");
$fila55 = mysql_fetch_array($quinto5);

$m55 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '5' and cursa.divi='5' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m55 = mysql_fetch_array($m55);

$quinto6 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '5' and divi='6' and anio='$anio' and control=1");
$fila56 = mysql_fetch_array($quinto6);

$m56 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '5' and cursa.divi='6' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m56 = mysql_fetch_array($m56);

$quinto7 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '5' and divi='7' and anio='$anio' and control=1");
$fila57 = mysql_fetch_array($quinto7);

$m57 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '5' and cursa.divi='7' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m57 = mysql_fetch_array($m57);

$quinto8 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '5' and divi='8' and anio='$anio' and control=1");
$fila58 = mysql_fetch_array($quinto8);

$m58 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '5' and cursa.divi='8' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m58 = mysql_fetch_array($m58);

$quinto9 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '5' and divi='9' and anio='$anio' and control=1");
$fila59 = mysql_fetch_array($quinto9);

$m59 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '5' and cursa.divi='9' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m59 = mysql_fetch_array($m59);

$quintoA = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '5' and divi='A' and anio='$anio' and control=1");
$fila5A = mysql_fetch_array($quintoA);

$m5A = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '5' and cursa.divi='A' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m5A = mysql_fetch_array($m5A);

$quinto = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '5' and anio='$anio' and control=1");
$fila5 = mysql_fetch_array($quinto);





$septimo1 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '6' and divi='1' and anio='$anio' and control=1");
$fila61 = mysql_fetch_array($septimo1);

$m61 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '6' and cursa.divi='1' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m61 = mysql_fetch_array($m61);

$septimo2 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '6' and divi='2' and anio='$anio' and control=1");
$fila62 = mysql_fetch_array($septimo2);

$m62 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '6' and cursa.divi='2' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m62 = mysql_fetch_array($m62);

$septimo3 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '6' and divi='3' and anio='$anio' and control=1");
$fila63 = mysql_fetch_array($septimo3);

$m63 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '6' and cursa.divi='3' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m63 = mysql_fetch_array($m63);

$septimo4 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '6' and divi='4' and anio='$anio' and control=1");
$fila64 = mysql_fetch_array($septimo4);

$m64 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '6' and cursa.divi='4' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m64 = mysql_fetch_array($m64);

$septimo5 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '6' and divi='5' and anio='$anio' and control=1");
$fila65 = mysql_fetch_array($septimo5);

$m65 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '6' and cursa.divi='5' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m65 = mysql_fetch_array($m65);

$septimo6 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '6' and divi='6' and anio='$anio' and control=1");
$fila66 = mysql_fetch_array($septimo6);

$m66 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '6' and cursa.divi='6' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m66 = mysql_fetch_array($m66);

$septimo7 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '6' and divi='7' and anio='$anio' and control=1");
$fila67 = mysql_fetch_array($septimo7);

$m67 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '6' and cursa.divi='7' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m67 = mysql_fetch_array($m67);

$septimo8 = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '6' and divi='8' and anio='$anio' and control=1");
$fila68 = mysql_fetch_array($septimo8);

$m68 = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '6' and cursa.divi='8' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m68 = mysql_fetch_array($m68);

$septimoA = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '6' and divi='A' and anio='$anio' and control=1");
$fila6A = mysql_fetch_array($septimoA);

$m6A = mysql_query ("SELECT COUNT(*) as total FROM cursa,alumno WHERE cursa.curso = '6' and cursa.divi='A' and cursa.anio='$anio' and cursa.alumno=alumno.dni and alumno.sexo='M' and control=1");
$m6A = mysql_fetch_array($m6A);


$septimo = mysql_query ("SELECT COUNT(*) as total FROM cursa WHERE curso = '6' and anio='$anio' and control=1");
$fila6 = mysql_fetch_array($septimo);

$totalmanana1=0;

$man11 = mysql_query ("SELECT * FROM cursos WHERE turno = 1 and curso = 1");


  WHILE ($filam11 = mysql_fetch_array($man11)) {
						$man1 = mysql_query ("SELECT COUNT(*) as totalm FROM cursa WHERE curso = '$filam11[curso]' and divi='$filam11[division]' and anio='$anio' and control=1");
						$filam1 = mysql_fetch_array($man1);
						$totalmanana1=$totalmanana1+$filam1[totalm];

						}


$totalmanana2=0;

$man12 = mysql_query ("SELECT * FROM cursos WHERE turno = 1 and curso = 2");


  WHILE ($filam12 = mysql_fetch_array($man12)) {
						$man112 = mysql_query ("SELECT COUNT(*) as totalm1 FROM cursa WHERE curso = '$filam12[curso]' and divi='$filam12[division]' and anio='$anio' and control=1");
						$filam12 = mysql_fetch_array($man112);
						$totalmanana2=$totalmanana2+$filam12[totalm1];

						}

$totalmanana3=0;

$man13 = mysql_query ("SELECT * FROM cursos WHERE turno = 1 and curso = 3");


  WHILE ($filam13 = mysql_fetch_array($man13)) {
						$man113 = mysql_query ("SELECT COUNT(*) as totalm2 FROM cursa WHERE curso = '$filam13[curso]' and divi='$filam13[division]' and anio='$anio' and control=1");
						$filam13 = mysql_fetch_array($man113);
						$totalmanana3=$totalmanana3+$filam13[totalm2];

						}

$totaltarde1=0;

$tar1 = mysql_query ("SELECT * FROM cursos WHERE turno = 2 and curso = 1");


  WHILE ($filat1 = mysql_fetch_array($tar1)) {
						$tar11 = mysql_query ("SELECT COUNT(*) as totalt1 FROM cursa WHERE curso = '$filat1[curso]' and divi='$filat1[division]' and anio='$anio' and control=1");
						$filat11 = mysql_fetch_array($tar11);
						$totaltarde1=$totaltarde1+$filat11[totalt1];

						}

$totaltarde2=0;

$tar2 = mysql_query ("SELECT * FROM cursos WHERE turno = 2 and curso = 2");


  WHILE ($filat2 = mysql_fetch_array($tar2)) {
						$tar22 = mysql_query ("SELECT COUNT(*) as totalt2 FROM cursa WHERE curso = '$filat2[curso]' and divi='$filat2[division]' and anio='$anio' and control=1");
						$filat22 = mysql_fetch_array($tar22);
						$totaltarde2=$totaltarde2+$filat22[totalt2];

						}


$totaltarde3=0;

$tar3 = mysql_query ("SELECT * FROM cursos WHERE turno = 2 and curso = 3");


  WHILE ($filat3 = mysql_fetch_array($tar3)) {
						$tar33 = mysql_query ("SELECT COUNT(*) as totalt3 FROM cursa WHERE curso = '$filat3[curso]' and divi='$filat3[division]' and anio='$anio' and control=1");
						$filat33 = mysql_fetch_array($tar33);
						$totaltarde3=$totaltarde3+$filat33[totalt3];

						}

$totaltarde4=0;

$tar4 = mysql_query ("SELECT * FROM cursos WHERE turno = 2 and curso = 4");


  WHILE ($filat4 = mysql_fetch_array($tar4)) {
						$tar44 = mysql_query ("SELECT COUNT(*) as totalt4 FROM cursa WHERE curso = '$filat4[curso]' and divi='$filat4[division]' and anio='$anio' and control=1");
						$filat44 = mysql_fetch_array($tar44);
						$totaltarde4=$totaltarde4+$filat44[totalt4];

						}

$totaltarde5=0;

$tar5 = mysql_query ("SELECT * FROM cursos WHERE turno = 2 and curso = 5");


  WHILE ($filat5 = mysql_fetch_array($tar5)) {
						$tar55 = mysql_query ("SELECT COUNT(*) as totalt5 FROM cursa WHERE curso = '$filat5[curso]' and divi='$filat5[division]' and anio='$anio' and control=1");
						$filat55 = mysql_fetch_array($tar55);
						$totaltarde5=$totaltarde5+$filat55[totalt5];

						}
$totaltarde6=0;

$tar6 = mysql_query ("SELECT * FROM cursos WHERE turno = 2 and curso = 6");


  WHILE ($filat6 = mysql_fetch_array($tar6)) {
						$tar66 = mysql_query ("SELECT COUNT(*) as totalt6 FROM cursa WHERE curso = '$filat6[curso]' and divi='$filat6[division]' and anio='$anio' and control=1");
						$filat66 = mysql_fetch_array($tar66);
						$totaltarde6=$totaltarde6+$filat66[totalt6];

						}

$totalnoche1=0;

$noc1 = mysql_query ("SELECT * FROM cursos WHERE turno = 3 and curso = 1");


  WHILE ($filan1 = mysql_fetch_array($noc1)) {
						$noc11 = mysql_query ("SELECT COUNT(*) as totaln1 FROM cursa WHERE curso = '$filan1[curso]' and divi='$filan1[division]' and anio='$anio' and control=1");
						$filan11 = mysql_fetch_array($noc11);
						$totalnoche1=$totalnoche1+$filan11[totaln1];

						}


$totalnoche2=0;

$noc2 = mysql_query ("SELECT * FROM cursos WHERE turno = 3 and curso = 2");


  WHILE ($filan2 = mysql_fetch_array($noc2)) {
						$noc22 = mysql_query ("SELECT COUNT(*) as totaln2 FROM cursa WHERE curso = '$filan2[curso]' and divi='$filan2[division]' and anio='$anio' and control=1");
						$filan22 = mysql_fetch_array($noc22);
						$totalnoche2=$totalnoche2+$filan22[totaln2];

						}


$totalnoche3=0;

$noc3 = mysql_query ("SELECT * FROM cursos WHERE turno = 3 and curso = 3");


  WHILE ($filan3 = mysql_fetch_array($noc3)) {
						$noc33 = mysql_query ("SELECT COUNT(*) as totaln3 FROM cursa WHERE curso = '$filan3[curso]' and divi='$filan3[division]' and anio='$anio' and control=1");
						$filan33 = mysql_fetch_array($noc33);
						$totalnoche3=$totalnoche3+$filan33[totaln3];

						}

$totalnoche4=0;

$noc4 = mysql_query ("SELECT * FROM cursos WHERE turno = 3 and curso = 4");


  WHILE ($filan4 = mysql_fetch_array($noc4)) {
						$noc44 = mysql_query ("SELECT COUNT(*) as totaln4 FROM cursa WHERE curso = '$filan4[curso]' and divi='$filan4[division]' and anio='$anio' and control=1");
						$filan44 = mysql_fetch_array($noc44);
						$totalnoche4=$totalnoche4+$filan44[totaln4];

						}

$totalnoche5=0;

$noc5 = mysql_query ("SELECT * FROM cursos WHERE turno = 3 and curso = 5");


  WHILE ($filan5 = mysql_fetch_array($noc5)) {
						$noc55 = mysql_query ("SELECT COUNT(*) as totaln5 FROM cursa WHERE curso = '$filan5[curso]' and divi='$filan5[division]' and anio='$anio' and control=1");
						$filan55 = mysql_fetch_array($noc55);
						$totalnoche5=$totalnoche5+$filan55[totaln5];

						}

$totalnoche6=0;

$noc6 = mysql_query ("SELECT * FROM cursos WHERE turno = 3 and curso = 6");


  WHILE ($filan6 = mysql_fetch_array($noc6)) {
						$noc66 = mysql_query ("SELECT COUNT(*) as totaln6 FROM cursa WHERE curso = '$filan6[curso]' and divi='$filan6[division]' and anio='$anio' and control=1");
						$filan66 = mysql_fetch_array($noc66);
						$totalnoche6=$totalnoche6+$filan66[totaln6];

						}

$totalnocheaa=0;

$noca = mysql_query ("SELECT * FROM cursos WHERE turno = 3 and curso = 'A'");


  WHILE ($filana = mysql_fetch_array($noca)) {
						$nocaa = mysql_query ("SELECT COUNT(*) as totalna FROM cursa WHERE curso = '$filana[curso]' and divi='$filana[division]' and anio='$anio' and control=1");
						$filanaa = mysql_fetch_array($nocaa);
						$totalnocheaa=$totalnocheaa+$filanaa[totalna];

						}

	?>

<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36">1º 1º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º 2º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º 3º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º 4º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º 5º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º Bº</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º Aº</td>

							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>



						</tr>



						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila11[total];?> / <?echo $m11[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila12[total];?> / <?echo $m12[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila13[total];?> / <?echo $m13[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila14[total];?> / <?echo $m14[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila15[total];?> / <?echo $m15[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila16[total];?> / <?echo $m16[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila17[total];?> / <?echo $m17[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila1[total];?></td>








						</tr>

						</table><br>

<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36">2º 1º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">2º 2º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">2º 3º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">2º 4º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">2º 5º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">2º Bº</td>
							<td bgcolor="#808080" width="80" align="center" height="36">2º Aº</td>

							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>

						</tr>

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila21[total];?> / <?echo $m21[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila22[total];?> / <?echo $m22[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila23[total];?> / <?echo $m23[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila24[total];?> / <?echo $m24[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila25[total];?> / <?echo $m25[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila26[total];?> / <?echo $m26[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filA[total];?> / <?echo $m2a[total];?>V</td>

							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[total];?></td>

						</tr>

						</table><br>

<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36">3º 1º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">3º 2º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">3º 3º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">3º 4º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">3º 5º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">3º Bº</td>

							<td bgcolor="#808080" width="80" align="center" height="36">3º Aº</td>
							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>


						</tr>

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila31[total];?> / <?echo $m31[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila32[total];?> / <?echo $m32[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila33[total];?> / <?echo $m33[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila34[total];?> / <?echo $m34[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila35[total];?> / <?echo $m35[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila36[total];?> / <?echo $m36[total];?>V</td>

							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3A[total];?> / <?echo $m3A[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[total];?></td>

						</tr>

						</table><br>

<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36">4º 1º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">4º 2º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">4º 3º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">4º 4º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">4º 5º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">4º 6º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">4º 7º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">4º 8º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">4º 9º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">4º Aº</td>
							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>


						</tr>

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila41[total];?> / <?echo $m41[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila42[total];?> / <?echo $m42[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila43[total];?> / <?echo $m43[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila44[total];?> / <?echo $m44[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila45[total];?> / <?echo $m45[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila46[total];?> / <?echo $m46[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila47[total];?> / <?echo $m47[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila48[total];?> / <?echo $m48[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila49[total];?> / <?echo $m49[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila4A[total];?> / <?echo $m4A[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila4[total];?></td>

						</tr>

						</table><br>



<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36">5º 1º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">5º 2º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">5º 3º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">5º 4º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">5º 5º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">5º 6º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">5º 7º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">5º 8º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">5º 9º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">5º A</td>
							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>


						</tr>

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila51[total];?> / <?echo $m51[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila52[total];?> / <?echo $m52[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila53[total];?> / <?echo $m53[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila54[total];?> / <?echo $m54[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila55[total];?> / <?echo $m55[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila56[total];?> / <?echo $m56[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila57[total];?> / <?echo $m57[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila58[total];?> / <?echo $m58[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila59[total];?> / <?echo $m59[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila5A[total];?> / <?echo $m5A[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila5[total];?></td>

						</tr>

						</table><br>


<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36">6º 1º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">6º 2º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">6º 3º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">6º 4º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">6º 5º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">6º 6º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">6º 7º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">6º 8º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">6º Aº</td>
							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>


						</tr>



						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila61[total];?> / <?echo $m61[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila62[total];?> / <?echo $m62[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila63[total];?> / <?echo $m63[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila64[total];?> / <?echo $m64[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila65[total];?> / <?echo $m65[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila66[total];?> / <?echo $m66[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila67[total];?> / <?echo $m67[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila68[total];?> / <?echo $m68[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila6A[total];?> / <?echo $m6A[total];?>V</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila6[total];?></td>








						</tr>

						</table><br>

<?


$totmanana= $totalmanana1+$totalmanana2+$totalmanana3;
$tottarde=$totaltarde1+$totaltarde2+$totaltarde3+$totaltarde4+$totaltarde5+$totaltarde6;
$totnoche= $totalnoche1+$totalnoche2+$totalnoche3+$totalnoche4+$totalnoche5+$totalnoche6+$totalnocheaa;

$suma=$totmanana+$tottarde+$totnoche;

?>

<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36"><a href=' estadistica_cursando.php<? echo "?desde=" . date("Y") ."-02-01" ."&hasta=" . date("Y") ."-03-31&fecha_alt=Buscar"; ?>'><b>Cantidad de alumnos</b> (Seguir este enlace para ir al listado completo)</a></td>


						</tr>



						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $suma;?></td>









						</tr>

						</table><br>

<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>1º T MAÑANA</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>2º T MAÑANA</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>3º T MAÑANA</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>Cantidad de alumnos T MAÑANA</b></td>


						</tr>



						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totalmanana1;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totalmanana2;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totalmanana3;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totmanana;?></td>

						</tr>

						</table><br>

<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>1º T TARDE</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>2º T TARDE</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>3º T TARDE</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>4º T TARDE</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>5º T TARDE</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>6º T TARDE</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>Cantidad de alumnos T TARDE</b></td>


						</tr>



						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totaltarde1;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totaltarde2;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totaltarde3;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totaltarde4;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totaltarde5;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totaltarde6;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $tottarde; ?></td>

						</tr>

						</table><br>
<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>1º T VESPERTINO</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>2º T VESPERTINO</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>3º T VESPERTINO</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>4º T VESPERTINO</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>5º T VESPERTINO</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>6º T VESPERTINO</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>AAº T VESPERTINO</b></td>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>Cantidad de alumnos T VESPERTINO</b></td>


						</tr>



						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totalnoche1;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totalnoche2;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totalnoche3;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totalnoche4;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totalnoche5;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totalnoche6;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totalnocheaa;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $totnoche;?></td>

						</tr>

						</table><br>





					</p>
					<p align="center">&nbsp;</td>
				</tr>


			</table>
			</div>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>



</form>
 </td>

</div>

</body>

</html>
<? } ?>

