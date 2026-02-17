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


<form method="GET" action="versindoc.php">

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
	
				
					<?
				/*if (isset($_GET['muestra2']))
{ */

	$alumno=$_GET['actor'];


$_pagi_sql="SELECT c.descripcion as curso,m.descripcion as materia,mc.idcurso FROM curso2 c, materias m,matcur mc WHERE mc.idmateria=m.idmateria AND c.idcurso=mc.idcurso AND mc.iddocente='0' AND mc.idmateria!=65  AND mc.idcurso!=999 AND c.habilitado!=0 ORDER BY c.curso,c.division,c.descripcion ASC";




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

$cont=0;		?> <table border="1" width="450" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="9" height="40" align="left">
							&nbsp;Materias sin Profesor</td>
						</tr>




						<tr>
							<td width="150" bgcolor="#808080" align="center" height="36">Curso</td>							
							<td width="150" bgcolor="#808080" align="center" height="36">Materia</td>
							<td width="25" bgcolor="#808080" align="center" height="36">Acciones</td>
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{
				
	
		?> 

						<tr>
							<td width="150" bgcolor="#EAEAEA" align="left"><?echo $fila2[curso];?></td>
							<td width="150" bgcolor="#EAEAEA" align="left"><?echo $fila2[materia];?></td>
							<td width="25" bgcolor="#EAEAEA" align="center"><a href="asigdoc.php?curso=<?echo $fila2[idcurso];?>&submitcurso=Grabar"><img src=lupa.png width="30" height="30"></img></a></td>
						</tr>
						<?
		}
						?>
						</table><?
//}
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
