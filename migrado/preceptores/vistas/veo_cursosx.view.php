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
$resultmotivo = mysql_query ("SELECT * FROM motivo_dec"); 

if (isset($_GET['cl']) AND $_GET['cl']!='') $anio=$_GET['cl'];
else $anio = $_SESSION['cicloLectivo'];




?>

<body background="bgris.gif" >


<form method="GET" action="veo_cursosx.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Listar Alumnos por cursos.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el Curso:</td>
							<td align="right">&nbsp;<input type="text" name="curso" id="curso" size="2" maxlength="2" value="<?php echo $_GET['curso'];?>" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" width="36%">Ingrese la Div:</td>
							<td align="right">&nbsp;<input type="text" name="div" id="div" size="2" maxlength="2" value="<?php echo $_GET['div'];?>" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						
						<tr>
							<td align="right" width="36%">Ciclo Lectivo:</td>
							<td align="right">&nbsp;<input type="number" name="cl" id="div" size="6" maxlength="4" value="<?php echo $anio;?>" min="2015" max="3999" /></td> 
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						
						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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
				if (isset($_GET['muestra2']))
{ 

	$curso=$_GET['curso'];
	$cl=$_GET['cl'];
	$div=$_GET['div'];
/*	if (isset($_GET['cl']) AND $_GET['cl']!='')
	{$anio=$_GET['cl'];
	 $ctrl=1;} //Hasta revisar el if que falla antes de pasar de año a principio de año
	else
	{$anio=date("Y");
	 $ctrl=1; 	}*/
	 
 if (isset($_GET['cl']) AND $_GET['cl']!=$_SESSION['cicloLectivo']) {
  $anio = $_GET['cl'];
  $ctrl = 0;
 }
 else {
  $anio = $_SESSION['cicloLectivo'];
  $ctrl = 1;
 }




$db2 = mysql_connect("localhost", "fgoicoechea", "sobral2011");
mysql_select_db("alumnos",$db2);
$_pagi_sql="SELECT * FROM cursa,alumno WHERE cursa.curso = '$curso' and cursa.divi = '$div' and cursa.anio='$anio' and cursa.control='$ctrl' and cursa.alumno=alumno.dni order by alumno.apellido";




$_pagi_cuantos=50;
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
							&nbsp;Resultado de la B&uacute;squeda de <?php echo $curso?>° <?php echo $div?>ª<br>
                            <a href="cursopdf.php?curso=<?php echo $curso?>&div=<?php echo $div?>" target="_blank"><img src="pdf.png" alt="exportar" height="24" width="24"> Lista de alumnos</a> - <a href="http://alumnos.colegiosobral.edu.ar/cursopdf_con_datos.php?curso=<?php echo $curso?>&div=<?php echo $div?>" target="_blank"><img src="pdf.png" alt="exportar" height="24" width="24"> Lista de alumnos con todos los datos</a>- <a href="adeudan.php?curso=<?=$curso?>&div=<?=$div?>&cl=<?//=$cl?>" target="_blank"><img src="pdf.png" alt="exportar" height="24" width="24"> Lista de previas</a> - <a href="listadoalu.php?curso=<?php echo $curso?>&div=<?php echo $div?>" target="_blank"><img src="http://alumnos.colegiosobral.edu.ar/excel.png" alt="exportar" height="24" width="24"> Lista de alumnos</a></td>
						</tr>




						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">N°</td>							
							<td width="100" bgcolor="#808080" align="center" height="36">DNI</td>
							<td width="200" bgcolor="#808080" align="center" height="36">Alumno</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Padre</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Madre</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Tutor</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Tel.</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Domicilio</td>
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
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $rtt[tel];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $rtt[domicilio];?></td>
						
                					
					
							
							
						</tr>
						<?
						}
						?>
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
