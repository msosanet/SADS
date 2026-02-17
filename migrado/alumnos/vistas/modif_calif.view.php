<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Modificar calificaci&oacute;n</title>

</head>
<?
include 'encabezado.php';
?>
<body>

<?
$conexion = conectar();

//-------
$usuario=$_SESSION['usuario'];
$dni=$_GET["dni"];

$color = '';

$resultt = mysql_query ("SELECT * FROM titulo, alumno WHERE titulo.id = $dni and titulo.alumno=alumno.dni");
$filatt = mysql_fetch_array($resultt);

$dia=date("Y-m-d");
//------ 
$seccion = $_GET['sec'];// "2A"; //
$materia = $_GET['mat']; // 34;//
$estudiante = $_GET['alu']; // 48948821; //

// Consulta alumno
$seleccion = mysql_select_db("calificadores");
$q_alumno = mysql_query("SELECT apellido,nombre FROM alumno WHERE dni = $estudiante");
$alumno = mysql_fetch_array($q_alumno);

// Consulta nombre materia
$q_nomMateria = mysql_query("SELECT descripcion FROM `materias` WHERE idmateria = $materia");
$nomMateria = mysql_fetch_assoc($q_nomMateria);

// Consulta calificacion
$q_nota = mysql_query("SELECT nota1p AS calificacion,docente FROM `calificador` WHERE dni = '$estudiante' AND materia = '$materia' AND curso = '$seccion'");

$nota = mysql_fetch_assoc($q_nota);

// Consulta docente
$q_doc = mysql_query("SELECT apellido,nombre FROM `docente` WHERE `dni` = '$nota[docente]'");
$docente = mysql_fetch_assoc($q_doc);

$errordoc = 0;
  $hayerrores = 0;

  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos




}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<div style="max-width:980px;margin: auto;">
	<table style="width:100%;">
	<tr><th>

<?
		
include 'snipet_barramenu.php';

?>	
	</th></tr>
		<tr>
			<td>
			<div align="center">
			<table border="0" >
			<tr>
				

					<td>
					
					<p align="left" class="text1b">Modificar calificacion para <?=$estudiante?></p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?></p>
<div align="left">
					
					<div align="center">
					
					<table width="895" id="table1" >
					<form method="post" action="modif_calif.php?dni=xxx">
						
						<tr>
						

							<td colspan="2" bgcolor="#EAEAEA" style="text-align:center">
							<?=$alumno['apellido'] . ", " . $alumno['nombre']; ?>
							</td>
					
							

							<td width="74" bgcolor="#EAEAEA" align="left"><font color="<?echo $color;?>">Docente: 
							<?=$docente['apellido'] . ", " . $docente['nombre'];?>							</td>	
							
						</tr>

						<tr>
							
							<td width="190" bgcolor="#EAEAEA" align="right"><?=$nomMateria['descripcion']?>:</td>
							<td width="190" bgcolor="#EAEAEA" align="right">
							Calificaci&oacute;n:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="number" name="calificacion" size="1"  max="10" min="0" value="<?=$nota['calificacion']?>" /></td>
						</tr>	

			
						<tr>
							
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="3">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						<input hidden name="alumno" value="<?=$estudiante?>">
						<input hidden name="materia" value="<?=$materia?>">
						<input hidden name="seccion" value="<?=$seccion?>">
					</form>
					</table>
					</div>
<p align="right">&nbsp;</div>
					</td>
			</tr>
			</table>
			</div>
		</tr>
	</table>
<?
 include 'foot.php';
?>

	
</div>

<?
}
else
{

//---
	$numero=$_GET['numero'];
	$caja=$_GET['caja'];
	$descripcion=$_GET['descripcion'];
	$dia=$_GET['dia'];
//----

$nota1p = $_POST['calificacion'];
$curso = $_POST['seccion'];
$alumno = $_POST['alumno'];
$idmateria = $_POST['materia'];


 








if (mysql_query ("UPDATE calificador SET nota1p='$nota1p' WHERE dni = '$alumno' AND curso = '$curso' AND materia = '$idmateria'"))
	{		

				?>
				<script>
				var answer=alert("Datos Grabados Correctamente Nota: <?=$nota1p?>")
				</script> 
				<meta http-equiv='refresh' content='0; URL=vercalif_am.php?mat=<?=$idmateria . "&sec=" . $curso . "&alu=" . $alumno;?>'>

				<? 			
	}
	else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
<!--				<meta http-equiv='refresh' content='0; URL=bus_titulo2.php'> -->

				<? 
		}

				
}

?>
</html>
<? } ?>
