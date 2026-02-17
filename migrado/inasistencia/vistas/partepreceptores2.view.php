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
<title>SIDOS</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';

 
?>
<body background="bgris.gif" >

<p>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo6 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo7 {font-size: 16px; font-weight: bold; color: #FF0000; }
-->
</style>

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$materia=$_GET['materia'];
$cursox=$_GET['curso'];
$fechax=$_GET['fecha'];
if (isset($_GET['fechaxx']))$fechax=$_GET['fechaxx'];

$rr = mysql_query ("SELECT * FROM curso3 where idcurso='$cursox'");
$rr = mysql_fetch_array($rr);

$cursillo=$rr['descripcion'];
$turnoc=$rr['turno'];
$cur=$rr['curso'];
$div=$rr['division'];
$cursotext = mysql_query ("SELECT * FROM materiax where curso='$cursillo'");
$cursotext = mysql_fetch_array($resulturno);





?>

<form method="GET" action="partepreceptores2.php">

</p>
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
?>	

<tr>
				

					<td>
					<br>
					<p align="left" class="text1b">Parte Diario de  <?echo $rr['descripcion']; ?> para la fecha <?echo $fechax; ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<br>
  
 <div align="center">
					
					<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>PARTE PARA EL CURSO</b></font></td>
	</tr>	
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Hora</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Materia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Docente</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>P</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>T</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>A</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Observaciones</b></td>
	</tr>	
		
	</tr>
	
<?php 		
		
		
$dia= date('w', strtotime($fechax));
echo '<input type="hidden" name="curso" value="'. $cursox. '">';
echo '<input type="hidden" name="fechaxx" value="'. $fechax. '">';
echo '<input type="hidden" name="cursodesc" value="'. $rr['descripcion']. '">';
$j=0;

$c=$cur.$div;
$sql3="SELECT * FROM horariox2 h2, curso3 c WHERE h2.idcurso=c.idcurso AND h2.idcurso='$c' AND h2.dia='$dia' AND h2.idmateria!=0 ORDER BY h2.hora ASC";
echo $sql3;
$result = mysql_query ($sql3);
						
			while ($fila = mysql_fetch_array($result))
			{
			$deshabilitado="enabled";
			$hora=$fila['hora'];
			$dni=0;
			$materia=0;
			echo "Hora".$hora;
			
			//echo $fila[idmateria]; 
			if ($fila[idmateria]!='0')
			{
			 $matdoc="SELECT *,mc.nombre as materiadesc FROM materia_cargo mc,alta_baja ab,docentes d WHERE mc.id=ab.materia AND ab.activa=1 AND ab.docente=d.dni AND mc.id='$fila[idmateria]' AND mc.id!='0' ";
			 echo $matdoc;
			 $result2 = mysql_query ($matdoc);
			 $fmatdoc = mysql_fetch_array($result2);
			 $materia=$fila[idmateria];
				if (mysql_num_rows($result2)==0)
					{ 
					 $mat="SELECT * FROM materia_cargo mc WHERE mc.id='$fila[idmateria]'";
					 $result3 = mysql_query ($mat);
					 $mate = mysql_fetch_array($result3);
					 $materiadesc=$mate['nombre'];
					 $nomap="SIN PROFESOR ASIGNADO";
					 $deshabilitado="disabled";
					 $dni=0;
					}
				 else
                    {
					 $materiadesc=$fmatdoc['materiadesc'];
					 $apellido=$fmatdoc['apellido'];
					 $nombre=$fmatdoc['nombre'];
					 $nomap=$apellido." ".$nombre;
 					 $deshabilitado="";
					 $dni=$fmatdoc['dni'];
					}
			}
			else
			{
			$materiadesc="VACIO";
			$nomap="SIN PROFESOR ASIGNADO";
			$deshabilitado="disabled";
			}
			echo "<tr>";	
			
				echo "<td bgcolor='' align='center'><b>$hora</b></td>";		
				echo "<td bgcolor='' align='center'><b>$materiadesc</b></td>";
				echo "<td bgcolor='' align='center'><b>$nomap</b></td>";
			
				echo "<td align='center'><input type='radio' name='ij[".$hora."]' checked='checked' value='P' ". $deshabilitado."></td>";
				echo "<td align='center'><input type='radio' name='ij[".$hora."]' value='T' ". $deshabilitado."></td>";
				echo "<td align='center'><input type='radio' name='ij[".$hora."]' value='A' ". $deshabilitado."></td>";
				echo "<td align='center'><input type='text' name='observaciones[".$hora."] value=''/ ". $deshabilitado."></td>";
				$j++;		
					
				
				echo "</tr>";	
				
				
				if ($dni!=0){
				echo '<input type="hidden" name="docente['.$hora.']" value="'. $dni. '">';
				 echo '<input type="hidden" name="materia['.$hora.']" value="'. $materiadesc. '">';
				 echo '<input type="hidden" name="materiaid['.$hora.']" value="'. $materia. '">';
				 echo '<input type="hidden" name="horax['.$hora.']" value="'. $hora. '">';
					}
			
			}
echo "<tr>";	
echo "<td colspan='10' align='center'>";	
?>
<input type="submit" value="     Generar Parte     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:1000; float:center width:700px; height:125px; " />
<?
echo "</td>";	
echo "</tr>";		

	
		
	?>		
					
				</div>
					<p align="right">&nbsp;</div>
					<hr>
					</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
			</div>
		</tr>
	</table>


	</form>
</div>
</body>
<?
}

  
  
 if(isset($_GET['submitx']))
 {

$error = true; // Asumimos error hasta que se confirme la inserciÃ³n exitosa

    $materia = $_GET['materia'];
    $docente = $_GET['docente'];
    $ausente = $_GET['ij'];
    $curso = $_GET['curso'];
    $cursodescx = $_GET['cursodesc'];
    $fechaxxx = $_GET['fechaxx'];
    $materiaidx = $_GET['materiaid'];
    $horax = $_GET['horax'];
    $observaciones = $_GET['observaciones'];
	
	
/*	echo "<h3>Materia:</h3>";
    echo "<pre>";
    print_r($_GET['materia']);
    echo "</pre>";

    echo "<h3>Docente:</h3>";
    echo "<pre>";
    print_r($_GET['docente']);
    echo "</pre>";

    echo "<h3>Asistencia (ij):</h3>";
    echo "<pre>";
    print_r($_GET['ij']);
    echo "</pre>";

    echo "<h3>Curso:</h3>";
    echo "<pre>";
    print_r($_GET['curso']);
    echo "</pre>";

    echo "<h3>Materia ID:</h3>";
    echo "<pre>";
    print_r($_GET['materiaid']);
    echo "</pre>";

    echo "<h3>Hora:</h3>";
    echo "<pre>";
    print_r($_GET['horax']);
    echo "</pre>";

    echo "<h3>Observaciones:</h3>";
    echo "<pre>";
    print_r($_GET['observaciones']);
    echo "</pre>";*/
	

    $error = true;

    foreach ($horax as $hora => $value) {
        // Validar datos antes de usarlos
        $docenteHora = isset($docente[$hora]) ? mysql_real_escape_string($docente[$hora]) : 0;
        $materiaidHora = isset($materiaidx[$hora]) ? mysql_real_escape_string($materiaidx[$hora]) : 0;
        $asistencia = isset($ausente[$hora]) ? mysql_real_escape_string($ausente[$hora]) : '';
        $observacion = isset($observaciones[$hora]) ? mysql_real_escape_string($observaciones[$hora]) : '';

        // Si el docente no es 0, insertamos los datos
        if ($docenteHora != 0) {
            $sql = "INSERT INTO partepreceptores2 
                    VALUES ('','$fechaxxx','$curso','$hora','$docenteHora','$materiaidHora','$asistencia','$observacion','','$usuario','')";

            // Para depuraciÃ³n
            echo $sql . "<br>";

            // Ejecutar la consulta
            if (mysql_query($sql)) {
                $error = false;
            } else {
                echo "Error en la consulta: " . mysql_error() . "<br>";
            }
        }
    }


if (!$error) {
    echo "<script>alert('Se ha cargado el parte del dÃ­a $fechaxxx para el curso $cursodescx');</script>";
    echo "<meta http-equiv='refresh' content='0; URL=selcurhorpartes2.php'>";
} else {
    echo "<script>alert('OcurriÃ³ un error al cargar el parte.');</script>";
}



  
  }
  
  
  
  
  ?>































</html>

