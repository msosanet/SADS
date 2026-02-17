<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
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
<title>Administrador del SID</title>




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

$primero1 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '1' and division='1'");
$fila11 = mysql_fetch_array($primero1);

$primero2 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '1' and division='2'");
$fila12 = mysql_fetch_array($primero2);

$primero3 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '1' and division='3'");
$fila13 = mysql_fetch_array($primero3);

$primero4 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '1' and division='4'");
$fila14 = mysql_fetch_array($primero4);

$primero5 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '1' and division='5'");
$fila15 = mysql_fetch_array($primero5);

$primero6 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '1' and division='6'");
$fila16 = mysql_fetch_array($primero6);

$primero7 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '1' and division='A'");
$fila17 = mysql_fetch_array($primero7);

//$primero10 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '1' and division='10'");
//$fila110 = mysql_fetch_array($primero10);

$primero = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '1'");
$fila1 = mysql_fetch_array($primero);



$segundo1 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '2' and division='1'");
$fila21 = mysql_fetch_array($segundo1);

$segundo2 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '2' and division='2'");
$fila22 = mysql_fetch_array($segundo2);

$segundo3 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '2' and division='3'");
$fila23 = mysql_fetch_array($segundo3);

$segundo4 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '2' and division='4'");
$fila24 = mysql_fetch_array($segundo4);

$segundo5 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '2' and division='5'");
$fila25 = mysql_fetch_array($segundo5);

$segundo7 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '2' and division='7'");
$fila27 = mysql_fetch_array($segundo7);

$segundo8 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '2' and division='8'");
$fila28 = mysql_fetch_array($segundo8);

$segundo9 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '2' and division='9'");
$fila29 = mysql_fetch_array($segundo9);

$segundo10 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '2' and division='10'");
$fila210 = mysql_fetch_array($segundo10);

$segundo11 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '2' and division='11'");
$fila211 = mysql_fetch_array($segundo11);

$segundoaa = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = 'a' and division='a'");
$filaaa = mysql_fetch_array($segundoaa);

$segundo = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '2' or curso='a'");
$fila2 = mysql_fetch_array($segundo);


$tercero1 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '3' and division='1'");
$fila31 = mysql_fetch_array($tercero1);

$tercero2 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '3' and division='2'");
$fila32 = mysql_fetch_array($tercero2);

$tercero3 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '3' and division='3'");
$fila33 = mysql_fetch_array($tercero3);

$tercero4 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '3' and division='4'");
$fila34 = mysql_fetch_array($tercero4);

$tercero5 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '3' and division='5'");
$fila35 = mysql_fetch_array($tercero5);

$tercero6 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '3' and division='6'");
$fila36 = mysql_fetch_array($tercero6);

$tercero7 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '3' and division='7'");
$fila37 = mysql_fetch_array($tercero7);

$tercero8 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '3' and division='8'");
$fila38 = mysql_fetch_array($tercero8);

$tercero9 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '3' and division='9'");
$fila39 = mysql_fetch_array($tercero9);

$tercero = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '3'");
$fila3 = mysql_fetch_array($tercero);



$cuarto1 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '4' and division='1'");
$fila41 = mysql_fetch_array($cuarto1);

$cuarto2 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '4' and division='2'");
$fila42 = mysql_fetch_array($cuarto2);

$cuarto3 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '4' and division='3'");
$fila43 = mysql_fetch_array($cuarto3);

$cuarto4 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '4' and division='4'");
$fila44 = mysql_fetch_array($cuarto4);

$cuarto5 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '4' and division='5'");
$fila45 = mysql_fetch_array($cuarto5);

$cuarto6 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '4' and division='6'");
$fila46 = mysql_fetch_array($cuarto6);

$cuarto7 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '4' and division='7'");
$fila47 = mysql_fetch_array($cuarto7);

$cuarto8 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '4' and division='8'");
$fila48 = mysql_fetch_array($cuarto8);

$cuarto9 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '4' and division='9'");
$fila49 = mysql_fetch_array($cuarto9);

$cuarto = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '4'");
$fila4 = mysql_fetch_array($cuarto);


$quinto1 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '5' and division='1'");
$fila51 = mysql_fetch_array($quinto1);

$quinto2 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '5' and division='2'");
$fila52 = mysql_fetch_array($quinto2);

$quinto3 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '5' and division='3'");
$fila53 = mysql_fetch_array($quinto3);

$quinto4 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '5' and division='4'");
$fila54 = mysql_fetch_array($quinto4);

$quinto5 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '5' and division='5'");
$fila55 = mysql_fetch_array($quinto5);

$quinto6 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '5' and division='6'");
$fila56 = mysql_fetch_array($quinto6);

$quinto7 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '5' and division='7'");
$fila57 = mysql_fetch_array($quinto7);

$quinto8 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '5' and division='8'");
$fila58 = mysql_fetch_array($quinto8);

$quinto = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '5'");
$fila5 = mysql_fetch_array($quinto);





$septimo1 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '7' and division='1'");
$fila71 = mysql_fetch_array($septimo1);

$septimo2 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '7' and division='2'");
$fila72 = mysql_fetch_array($septimo2);

$septimo3 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '7' and division='3'");
$fila73 = mysql_fetch_array($septimo3);

$septimo4 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '7' and division='4'");
$fila74 = mysql_fetch_array($septimo4);

$septimo5 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '7' and division='5'");
$fila75 = mysql_fetch_array($septimo5);

$septimo6 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '7' and division='6'");
$fila76 = mysql_fetch_array($septimo6);

$septimo7 = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '7' and division='7'");
$fila77 = mysql_fetch_array($septimo7);

$septimo = mysql_query ("SELECT COUNT(*) as total FROM alumnos WHERE curso = '7'");
$fila7 = mysql_fetch_array($septimo);


$man1 = mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Ma¤ana' and curso = '1'");
$filam1 = mysql_fetch_array($man1);

$man2 = mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Ma¤ana' and curso = '2'");
$filam2 = mysql_fetch_array($man2);

$man3 = mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Ma¤ana' and curso = '3'");
$filam3 = mysql_fetch_array($man3);



$ves1 = mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Vespertino' and curso = '1'");
$filav1 = mysql_fetch_array($ves1);

$ves2 = mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Vespertino' and curso = '2'");
$filav2 = mysql_fetch_array($ves2);

$ves3 = mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Vespertino' and curso = '3'");
$filav3 = mysql_fetch_array($ves3);

$ves4= mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Vespertino' and curso = '4'");
$filav4= mysql_fetch_array($ves4);

$ves5= mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Vespertino' and curso = '5'");
$filav5= mysql_fetch_array($ves5);

$ves6= mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Vespertino' and curso = '7'");
$filav6= mysql_fetch_array($ves6);

$vesa= mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Vespertino' and curso = 'A'");
$filava= mysql_fetch_array($vesa);




$tar1 = mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Tarde' and curso = '1'");
$filat1 = mysql_fetch_array($tar1);

$tar2 = mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Tarde' and curso = '2'");
$filat2 = mysql_fetch_array($tar2);

$tar3 = mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Tarde' and curso = '3'");
$filat3 = mysql_fetch_array($tar3);

$tar4= mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Tarde' and curso = '4'");
$filat4= mysql_fetch_array($tar4);

$tar5= mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Tarde' and curso = '5'");
$filat5= mysql_fetch_array($tar5);

$tar6= mysql_query ("SELECT COUNT(*) as totalm FROM alumnos WHERE turno = 'Tarde' and curso = '7'");
$filat6= mysql_fetch_array($tar6);





	?> 

<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36">1º 1º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º 2º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º 3º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º 4º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º 5º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º 6º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">1º Aº</td>
							
							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>

						

						</tr>



						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila11[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila12[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila13[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila14[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila15[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila16[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila17[total];?></td>

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
							<td bgcolor="#808080" width="80" align="center" height="36">2º 7º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">2º 8º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">2º 9º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">2º 10º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">2º 11º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">AA</td>
							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>

						</tr>

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila21[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila22[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila23[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila24[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila25[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila27[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila28[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila29[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila210[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila211[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaaa[total];?></td>
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
							<td bgcolor="#808080" width="80" align="center" height="36">3º 6º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">3º 7º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">3º 8º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">3º 9º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>


						</tr>

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila31[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila32[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila33[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila34[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila35[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila36[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila37[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila38[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila39[total];?></td>
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
							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>


						</tr>

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila41[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila42[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila43[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila44[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila45[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila46[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila47[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila48[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila49[total];?></td>
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
							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>


						</tr>

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila51[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila52[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila53[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila54[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila55[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila56[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila57[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila58[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila5[total];?></td>

						</tr>

						</table><br>


<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36">7º 1º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">7º 2º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">7º 3º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">7º 4º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">7º 5º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">7º 6º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">7º 7º</td>
							<td bgcolor="#808080" width="80" align="center" height="36">TOTAL</td>


						</tr>



						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila71[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila72[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila73[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila74[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila75[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila76[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila77[total];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila7[total];?></td>



						
                					
					
							
							
						</tr>

						</table><br>

<?

$suma=$fila1[total]+$fila2[total]+$fila3[total]+$fila4[total]+$fila5[total]+$fila7[total];
$tm=$filam1[totalm]+$filam2[totalm]+$filam3[totalm];
$tt=$filat1[totalm]+$filat2[totalm]+$filat3[totalm]+$filat4[totalm]+$filat5[totalm]+$filat6[totalm];
$tv=$filav1[totalm]+$filav2[totalm]+$filav3[totalm]+$filav4[totalm]+$filav5[totalm]+$filav6[totalm]+$filava[totalm];


?>

<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">





						<tr>
							<td bgcolor="#808080" width="80" align="center" height="36"><b>Cantidad de alumnos</b></td>


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
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filam1[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filam2[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filam3[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $tm;?></td>
	
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
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filat1[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filat2[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filat3[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filat4[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filat5[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filat6[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $tt;?></td>
	
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
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filav1[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filav2[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filav3[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filav4[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filav5[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filav6[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filava[totalm];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $tv;?></td>
	
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