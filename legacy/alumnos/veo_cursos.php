<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$anio = $_SESSION['cicloLectivo'];
//$anio = 2024;

$curso = '';
$div = '';
if (isset($_GET['cyd'])) {
	$cyd=trim($_GET['cyd']);
	$curso = substr($cyd,0,1);
	$div = substr($cyd,-1);
	$tit_cd = $curso . "° " . $div . (is_numeric($div) ? "a" : "") . ": matr&iacute;cula";
}
else $tit_cd = "Ver cursos";

$Qcursos_y_divisiones = mysql_query("SELECT DISTINCT curso,divi FROM `cursa` WHERE control = 1 AND anio = $anio ORDER BY curso,divi");
$opcion_cd = "";
while($curso_y_division = mysql_fetch_assoc($Qcursos_y_divisiones)) {
	if ($curso_y_division['curso']==$curso AND $curso_y_division['divi']==$div) $selected = "selected";
	else $selected = "";
	$opcion_cd[] = "<option value='" . $curso_y_division['curso'] .  $curso_y_division['divi'] . "' " . $selected . " >" . $curso_y_division['curso'] . "° " .  $curso_y_division['divi'] . "</option>\n";
}


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title><?=$tit_cd?></title>



<img src="Top Alumnos.png" alt="SID" style="vertical-align:bottom; display: block; margin-left: auto; margin-right: auto; max-width: 100%">
</head>
<body>



<div style="max-width: 980px; margin: auto">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
if ($_SESSION['valor']==4) include 'menuppal4.php';
?>
<form method="GET" action="veo_cursos.php">


	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>

			<div align="center">
			<table border="0" width="980">
				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Listar Alumnos por cursos.</p>
						</p>
					<p align="center">&nbsp;

					</p>

					<div align="left">

					<table border="0" width="62%">
						<tr>
						<td>
						</td>
						<td>
						 <label for="cyd">Elija curso y división: </label>
						  <select name="cyd" id="cyd">
<?
foreach($opcion_cd AS $opt) echo $opt;
?>
						  </select>
						</td>

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


$_pagi_sql="SELECT * FROM cursa,alumno WHERE cursa.curso = '$curso' and cursa.divi = '$div' and cursa.anio=$anio and cursa.control=1 and cursa.alumno=alumno.dni order by alumno.apellido";




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
                            <a href="cursopdf.php?curso=<?php echo $curso?>&div=<?php echo $div?>" target="_blank"><img src="pdf.png" alt="exportar" height="24" width="24"> Lista de alumnos</a> - <a href="cursopdf_con_datos.php?curso=<?php echo $curso?>&div=<?php echo $div?>" target="_blank"><img src="pdf.png" alt="exportar" height="24" width="24"> Lista de alumnos con todos los datos</a>- <a href="adeudan.php?curso=<?php echo $curso?>&div=<?php echo $div?>" target="_blank"><img src="pdf.png" alt="exportar" height="24" width="24"> Lista de previas</a> - <a href="listado.php?curso=<?php echo $curso?>&div=<?php echo $div?>" target="_blank"><img src="excel.png" alt="exportar" height="24" width="24"> Lista de alumnos c/ tribu</a></td>
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

		if (mysql_num_rows($rtt2)){
		$rtt3 = mysql_query ("SELECT * FROM familiares WHERE dni = $rt2[familiar]");
		$padre = mysql_fetch_array($rtt3) ;
		}
		else $padre = "";

		if (mysql_num_rows($rt3)){
		$rtt4 = mysql_query ("SELECT * FROM familiares WHERE dni = $rt3[familiar]");
		$madre = mysql_fetch_array($rtt4) ;
		}
		else $madre = "";

		if (mysql_num_rows($rt4)){
		$rtt5 = mysql_query ("SELECT * FROM familiares WHERE dni = $rt4[familiar]");
		$tutor = mysql_fetch_array($rtt5) ;
		}
		else $tutor = "";


		$cont=$cont+1;

		?>

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $cont;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><a href="alumno.php?dni=<?=$fila2['alumno']?>"><?=$fila2['alumno']?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $rtt['apellido'];?>, <?echo $rtt['nombre'];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $padre['apellido'];?>, <?echo $padre['nombre'];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $madre['apellido'];?>, <?echo $madre['nombre'];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $tutor['apellido'];?>, <?echo $tutor['nombre'];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $rtt['tel'];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $rtt['domicilio'];?></td>





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


</div>

</body>

</html>
<? } ?>
