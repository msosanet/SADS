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
<title>Alumnos</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
// $resultmotivo = mysql_query ("SELECT * FROM motivo_dec"); 

// $anio2=date("Y")+1;
$curso = 6;
// $resultanio = mysql_query ("SELECT * FROM plan order by descripcion");
$resultanio = mysql_query ("SELECT DISTINCT `cursa`.`anio` FROM `cursa`,`alumno`,`previas` WHERE `cursa`.`curso` = $curso
	AND `cursa`.`alumno` = `previas`.`alumno` AND `cursa`.`alumno` = `alumno`.`dni` 
	AND `previas`.`observacion` = 'ADEUDA' ORDER BY `cursa`.`anio`");

?>

<body background="bgris.gif" >


<form method="GET" action="est_egresado_adeuda.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Egresados que adeudan materias</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
<!--					<tr>
							<td align="right" width="36%">Ingrese el Año:</td>
							<td align="left">&nbsp;<input type="text" name="anio" id="anio" size="4" maxlength="4" value="<?echo $anio2?>" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
-->
						<tr>
							<td align="right" width="36%">A&ntilde;o:</td>
							<td align="left"><select size="1" autofocus="true" name="anio_egreso"> <!-- ****************************LISTA AÑOS -->
						  <?	
                            WHILE ($myrow6 = mysql_fetch_array($resultanio)) {			
						    	if (($anio_egreso == $myrow6[anio])){
									echo "<option value='" . $myrow6[anio] . "' selected>" . $myrow6[anio] . "</option>";
								}
								else {
									echo "<option value='" . $myrow6[anio] . "'>" . $myrow6[anio] . "</option>";
								}
						    }
						  ?>
                          </select></td>
<!--							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td> -->
							<td align="right" colspan="2">
							<p align="center">
<!--									<input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td> -->
									<input type="submit" value="   Buscar   " name="listar" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
					</table>
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
</font>
<?
if (isset($_GET['listar']))
{ 

	$anio_egreso=$_GET['anio_egreso']; echo "<p> agno ". $anio_egreso ." </p>";

//	$_pagi_sql="SELECT * FROM cursa,alumno WHERE cursa.curso = '$curso' and cursa.divi = '$div' and cursa.anio='$anio' and cursa.modalidad=$plan and cursa.alumno=alumno.dni order by alumno.apellido";
	$_pagi_sql="SELECT * FROM `cursa`,`alumno`,`previas` WHERE `cursa`.`anio` =$anio_egreso  AND `cursa`.`curso` =$curso AND `cursa`.`alumno` = `previas`.`alumno` AND `cursa`.`alumno` = `alumno`.`dni` AND `previas`.`observacion` = 'ADEUDA' ORDER BY `alumno`.`apellido`";



$_pagi_cuantos=70;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

$cont=0;		?> <table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"  colspan="8" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda de egresados en <?php echo $anio_egreso?><br>
							// Enlace para descargar la lista en formato Planilla de Excel
                            <a href="listado2.php?curso=<?php // echo $curso?>&div=<?php echo $div?>&anio=<?php echo $anio?>&plan=<?php echo $plan?>" target="_blank"><img src="excel.png" alt="exportar" height="24" width="24"> Lista de alumnos</a></td>
						</tr>



<!--
						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">N°</td>							
							<td width="100" bgcolor="#808080" align="center" height="36">DNI</td>
							<td width="200" bgcolor="#808080" align="center" height="36">Alumno</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Padre</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Madre</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Tutor</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Escuela</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Loc. Esc.</td>
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{
		$rtt = mysql_query ("SELECT * FROM alumno WHERE dni = $fila2[alumno]");
		$rtt = mysql_fetch_array($rtt) ;

		$rtt2 = mysql_query ("SELECT * FROM alu_fami WHERE alumno = $fila2[alumno] and tipo='P'");
		$rt2 = mysql_fetch_array($rtt2) ;

		$rt3 = mysql_query ("SELECT * FROM alu_fami WHERE alumno = $fila2[alumno] and tipo='M'");
		$rt3 = mysql_fetch_array($rt3) ;

		$rt4 = mysql_query ("SELECT * FROM alu_fami WHERE alumno = $fila2[alumno] and tipo='T'");
		$rt4 = mysql_fetch_array($rt4) ;

		$rtt3 = mysql_query ("SELECT * FROM familiares WHERE dni = $rt2[familiar]");
		$padre = mysql_fetch_array($rtt3) ;

		$rtt4 = mysql_query ("SELECT * FROM familiares WHERE dni = $rt3[familiar]");
		$madre = mysql_fetch_array($rtt4) ;

		$rtt5 = mysql_query ("SELECT * FROM familiares WHERE dni = $rt4[familiar]");
		$tutor = mysql_fetch_array($rtt5) ;



		$cont=$cont+1;
	
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $cont;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[alumno];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $rtt[apellido];?>, <?echo $rtt[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $padre[apellido];?>, <?echo $padre[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $madre[apellido];?>, <?echo $madre[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $tutor[apellido];?>, <?echo $tutor[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $rtt[escuela];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $rtt[localidad_esc];?></td>
						
                					
					
							
							
						</tr>
						<?
						}
						?>
-->
						</table>
<?
}
$fechaDMA = date('d/m/Y');
echo "Fecha de informe: " . $fechaDMA;
?>
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