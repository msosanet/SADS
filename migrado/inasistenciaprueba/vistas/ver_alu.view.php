<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="tablacalif.css" />

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


<form method="GET" action="ver_alu.php">

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


$_pagi_sql="SELECT * FROM alumnos_faltas WHERE dni='$alumno' order by fecha";




$_pagi_cuantos=50;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<br>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

$cont=0;		?> <table border='1' id='customers' style='width: 50%;'>
						<tr>
							<td colspan="9" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>




						<tr>
							<td>N°</td>							
							<td >DNI</td>
							<td >Fecha</td>
							<td >Materia</td>
							<td >Tipo</td>
							
						

						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{
				if ($fila2['injus']==1)
				{$injus='Injustificada';}
				if ($fila2['injus']==0)
				{$injus='Justificada';}
				if ($fila2['injus']==2)
				{$injus='Tarde';}
				if ($fila2['injus']==3)
				{$injus='Ausente con Permanencia';}
		$cont=$cont+1;
	
		?> 

						<tr>
							<td ><?echo $cont;?></td>
							<td ><?echo $fila2[dni];?></td>
							<td ><?echo $fila2[fecha];?></td>
							<td ><?echo $fila2[tipo];?></td>
							<td><?echo $injus;?></td>					
					
							
							
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
