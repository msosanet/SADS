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
//$materia=$_GET['materia'];
//$cursox=$_GET['curso'];
$actor=$_GET['actor'];
//echo $cursox;

$rr = mysql_query ("SELECT CONCAT(D.apellido,  ' ', D.nombre) as nombredoc FROM docente D WHERE D.dni=$actor");
$rr = mysql_fetch_array($rr);

$cursotextx=$rr['nombredoc'];
//echo  $cursotextx;
/*
$cursotext = mysql_query ("SELECT CONCAT(D.apellido,  ' ', D.nombre) as nombredoc FROM docente where dni=$actor");
$cursotextz = mysql_fetch_array($cursotext);
$cursotextx= $cursotextz['nombredoc'];

*/



?>

<form method="GET" action="materiasindocente.php">

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
					
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left">
					
					<div align="center">
					
					<br>
					
<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">

<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>Materias sin docentes por curso</b></font></td>
</tr>	


<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Curso</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Turno</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Materia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Cantidad</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Asignar</b></td>
		
		
</tr>
<?
	//TABLA CON RESUMEN (MATERIA, CANTIDAD DE HORAS, CURSO)
	$result79 = mysql_query ("SELECT idcurso,descripcion,turno FROM curso2 WHERE habilitado=1 ORDER by turno,descripcion ASC");
	
	//$result80 = mysql_query ("SELECT C.descripcion,C.turno,M.descripcion,COUNT(*) as Cantidad FROM curso2 C, materias M, matcur MC, horariox H WHERE C.idcurso=MC.idcurso AND M.idmateria=MC.idmateria AND MC.iddocente=$actor AND H.idcurso=MC.idcurso AND H.idmateria!=65  GROUP BY C.descripcion,M.descripcion ORDER BY C.turno");
	//$elegido = mysql_num_rows($result80);
	//echo $elegido;

	while ($fila80 = mysql_fetch_array($result79))
	{	
	
    $curso=$fila80['idcurso'];
	$descripcion=$fila80['descripcion'];
	$turno=$fila80['turno'];
	$result80 = mysql_query ("SELECT c.descripcion,c.turno,m.descripcion,m.idmateria FROM materias m, curso2 c, matcur mc WHERE mc.idmateria=m.idmateria AND mc.idcurso=c.idcurso AND (mc.iddocente='0' OR mc.iddocente='') AND mc.idcurso='$curso' AND mc.idmateria!='65' AND c.idcurso!='999' GROUP BY m.descripcion ORDER BY m.descripcion ASC");
	
	while ($fila81 = mysql_fetch_array($result80))
	{	
			$result = mysql_query ("SELECT COUNT(*) as cantidad FROM horariox WHERE idcurso='$curso' AND idmateria='$fila81[3]'");
			//echo "SELECT COUNT(*) as cantidad FROM horariox WHERE idcurso='$curso' AND idmateria='$fila81[3]'";
			//echo $curso;
			$fila = mysql_fetch_array($result) ;
			$cantidad=$fila['cantidad'];
		
		
		echo "<tr>";
		echo "<td bgcolor='#EAEAEA' align='center'>".$fila81[0]."</td>";
		echo "<td bgcolor='#EAEAEA' align='center'>".$fila81[1]."</td>";
		echo "<td bgcolor='#EAEAEA' align='center'>".$fila81[2]."</td>";
		echo "<td bgcolor='#EAEAEA' align='center'>".$cantidad."</td>";
		echo "<td bgcolor='#EAEAEA' align='center'><a href='asigdoc.php?curso=".$curso."' target=_blank>Asignar</a></td>";
		echo "</tr>";
		
				
	}
		
			
	
		}
	



	
		
	

echo "</table>";
?>

 
 
					
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

  
  
  
  
  ?>


</html>

