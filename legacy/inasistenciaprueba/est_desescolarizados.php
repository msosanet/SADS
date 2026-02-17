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
<link rel="stylesheet" type="text/css" href="style.css" />
<?
if (isset($_POST['curso'])) {
 $cur = substr($_POST['curso'],0,1);
 $div = substr($_POST['curso'],1);
 echo "<title>" . $cur . "° " . $div . " Alumnos en riesgo</title>";
}
else {
?>
<title>Alumnos en riesgo</title>

<?
}

include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
$resultmotivo = mysql_query ("SELECT * FROM motivo_dec"); 

mysql_select_db("alumnos");
$cursos = mysql_query ("SELECT DISTINCT CONCAT(curso,divi) AS cur_div, curso, divi FROM `cursa` WHERE `control` = 1 AND curso != 'L' AND curso != 'E' ORDER BY curso,divi");

// En el futuro si se pide otro rango de fechas para la estadística se puede modificar aquí
$desde = "2022-07-01";
$hasta = "2022-08-31";

?>
</head>
<body background="bgris.gif" >

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980">
			<tr><th>

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
			</th></tr>
				<tr>
					<td>
					<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
					<div class="titles1">Seleccionar curso&nbsp;
<?
			echo "<select name=curso>\n";
				while ($curso = mysql_fetch_array($cursos))
				{ 	
					if (isset($_POST['curso']) && $_POST['curso']==$curso['cur_div'])
					{echo "<option value=".$curso['cur_div']." selected>".$curso['curso']."° ".$curso['divi']."°"."</option>\n";}
					else
					{echo "<option value=".$curso['cur_div'].">".$curso['curso']."° ".$curso['divi']."°"."</option>\n";}
					
				}	
				
			echo "</select>";					
?>
					<input type='submit' value='Mostrar' name='muestraCurso' style="align:center; padding: 0px 5px 0px" />
					</div>
					</form>
					<p align="center">&nbsp;</p>
					<p align="left"><br><br></p>
					<?
					
if (isset($_POST['guardaCambios']))
{
 foreach($_POST['alumno'] AS $blanquear)
 {
  mysql_query("UPDATE `alumnos`.`desescolarizados` SET `desescolarizados`.`completa` = '0',`desescolarizados`.`3omas` = '0',`desescolarizados`.`menos3` = '0' WHERE `desescolarizados`.`alumno` = '$blanquear' AND `desescolarizados`.`desde` = '$desde' AND `desescolarizados`.`hasta` = '$hasta'");
 }
 unset($err5);
 unset($err3);
 unset($errm);
 mysql_select_db("alumnos");
 foreach($_POST['5dias'] AS $ina5d)
 {
  if (mysql_query("INSERT INTO `alumnos`.`desescolarizados` (alumno,`hasta`, `desde`, `completa`) VALUES ($ina5d,'$hasta', '$desde', 1)"))  $err5[] = $k++;
  else $err5[] = mysql_query("UPDATE `alumnos`.`desescolarizados` SET `hasta` = '$hasta', `desescolarizados`.`desde` = '$desde',`desescolarizados`.`completa` = '1' WHERE `desescolarizados`.`alumno` = '$ina5d' AND `desescolarizados`.`desde` = '$desde' AND `desescolarizados`.`hasta` = '$hasta'");
/*  if (mysql_query("UPDATE `alumnos`.`desescolarizados` SET `hasta` = '$hasta', `desescolarizados`.`desde` = '$desde',`desescolarizados`.`completa` = '1' WHERE `desescolarizados`.`alumno` = '$ina5d' AND `desescolarizados`.`desde` = '$desde' AND `desescolarizados`.`hasta` = '$hasta'")) $err5 = 0;
  else $err5 = mysql_query("INSERT INTO `alumnos`.`desescolarizados` (alumno,`hasta`, `desde`, `completa`) VALUES ($ina5d,'$hasta', '$desde', 1)");*/
 }
 foreach($_POST['3dias'] AS $ina3d)
 {
  /*
  if (mysql_query("UPDATE `alumnos`.`desescolarizados` SET `hasta` = '$hasta', `desescolarizados`.`desde` = '$desde',`desescolarizados`.`3omas` = '1' WHERE `desescolarizados`.`alumno` = '$ina3d' AND `desescolarizados`.`desde` = '$desde' AND `desescolarizados`.`hasta` = '$hasta'")) $err3[] = $i++;
  else $err3[] = mysql_query("INSERT INTO `alumnos`.`desescolarizados` (alumno,`hasta`, `desde`, `3omas`) VALUES ($ina3d,'$hasta', '$desde', 1)");*/
  if (mysql_query("INSERT INTO `alumnos`.`desescolarizados` (alumno,`hasta`, `desde`, `3omas`) VALUES ($ina3d,'$hasta', '$desde', 1)")) $err3[] = $i++;
  else $err3[] = mysql_query("UPDATE `alumnos`.`desescolarizados` SET `hasta` = '$hasta', `desescolarizados`.`desde` = '$desde',`desescolarizados`.`3omas` = '1' WHERE `desescolarizados`.`alumno` = '$ina3d' AND `desescolarizados`.`desde` = '$desde' AND `desescolarizados`.`hasta` = '$hasta'");
//  $consultas[] = "INSERT INTO `alumnos`.`desescolarizados` (alumno,`hasta`, `desde`, `3omas`) VALUES ($ina3d,'$hasta', '$desde', 1)";
 }
  foreach($_POST['menos'] AS $inam3)
 {
  if (mysql_query("INSERT INTO `alumnos`.`desescolarizados` (alumno,`hasta`, `desde`, `menos3`) VALUES ($inam3,'$hasta', '$desde', 1)")) $errm[] = $j++;
  else $errm[] = mysql_query("UPDATE `alumnos`.`desescolarizados` SET `hasta` = '$hasta', `desescolarizados`.`desde` = '$desde',`desescolarizados`.`menos3` = '1' WHERE `desescolarizados`.`alumno` = '$inam3' AND `desescolarizados`.`desde` = '$desde' AND `desescolarizados`.`hasta` = '$hasta'");
/*  if (mysql_query("UPDATE `alumnos`.`desescolarizados` SET `hasta` = '$hasta', `desescolarizados`.`desde` = '$desde',`desescolarizados`.`menos3` = '1' WHERE `desescolarizados`.`alumno` = '$inam3' AND `desescolarizados`.`desde` = '$desde' AND `desescolarizados`.`hasta` = '$hasta'")) $errm = 0;
  else  $errm = mysql_query("INSERT INTO `alumnos`.`desescolarizados` (alumno,`hasta`, `desde`, `menos3`) VALUES ($inam3,$hasta, $desde, 1)");*/
 }
/* echo "<p>";
 echo var_export($_POST,true) . "<br>";
 echo "<br>";
// echo var_export($consultas,true) . "<br>";
 echo "error3 " . var_export($err3,true) . "<br>";
 echo var_export($errm,true) . "<br>";
 echo "</p>";*/
}

if (isset($_POST['curso']))
{ 
	$anio=date("Y");


$q_estud = mysql_query("SELECT * FROM cursa,alumno WHERE cursa.curso = '$cur' and cursa.divi = '$div' and cursa.anio='$anio' and cursa.control=1 and cursa.alumno=alumno.dni order by alumno.apellido");

$cont=0;
?>
				<div align="center">
				<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
				<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
						<td colspan = "3" style="font-weight: bold">Mostrando <?=$cur . "° " . $div . ""?></td>
						<td colspan = "3" bgcolor="#808080" align="center">Inasistencias por semana</td
						</tr>
						<tr>
							<td width="5%" bgcolor="#808080" align="center" height="36">N°</td>							
							<td width="10%" bgcolor="#808080" align="center" height="36">DNI</td>
							<td width="40%" bgcolor="#808080" align="center" height="36">Estudiante</td>
							<td width="15%" bgcolor="#808080" align="center" height="36">5 días</td>
							<td width="15%" bgcolor="#808080" align="center" height="36">3 días o más</td>
							<td width="15%" bgcolor="#808080" align="center" height="36">Menos de 3 días</td>
						</tr>

		<?php while ($fila2 = mysql_fetch_array($q_estud))
		{
			$q_estadistica = mysql_query("SELECT * FROM `desescolarizados` WHERE `alumno` = '$fila2[dni]' AND `desde` >= '2022-07-01' AND `hasta` <= '2022-08-31' ");
			$ina = mysql_fetch_assoc($q_estadistica);
			if ($ina{'completa'}!=0) $check5d = "checked";
			if ($ina{'3omas'}!=0) $check3d = "checked";
			if ($ina{'menos3'}!=0) $m3check = "checked";
			
			$cont=$cont+1;
		?> 

						<tr><input type="hidden" id="alumno" name="alumno[]" value="<?=$fila2['dni'];?>">
							<td bgcolor="#EAEAEA" align="center"><?=$cont;?></td>
							<td bgcolor="#EAEAEA" align="center"><?=$fila2['dni'];?></td>
							<td bgcolor="#EAEAEA"><?
								echo strtoupper($fila2['apellido']) . ", " .
								 ucwords(strtolower($fila2['nombre']));?></td>
							<td align="center"> <input type="checkbox" id="5dias" name="5dias[]" value="<?=$fila2['dni'].'" '. $check5d;?>> </td>
							<td align="center"> <input type="checkbox" id="3dias" name="3dias[]" value="<?=$fila2['dni'].'" '. $check3d;?>> </td>
							<td align="center"> <input type="checkbox" id="menos" name="menos[]" value="<?=$fila2['dni'].'" '. $m3check;?>> </td>
						</tr>
<?
		unset($check5d);
		unset($check3d);
		unset($m3check);
		}
?>
						<tr><td colspan = "6" align="center">
						 <input type='submit' value='grabar' name='guardaCambios' style="align:center; padding: 0px 5px 0px" />
						</td></tr>
						<input type="hidden" id="curso" name="curso" value="<?=$_POST['curso'];?>">
						</table>
						</form>
						</div>
<?
}

// $fechaDMA = date('d/m/Y');
// echo "Fecha de informe: " . $fechaDMA;
?>
					<p align="center">&nbsp;</p></td>
				</tr>


			</table>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>

</div>

</body>

</html>
<? } ?>