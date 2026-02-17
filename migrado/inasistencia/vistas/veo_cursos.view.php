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


<form method="GET" action="veo_cursos.php">

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
							<td align="right">&nbsp;<input type="text" name="curso" id="curso" size="2" maxlength="2" value="" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" width="36%">Ingrese la Div:</td>
							<td align="right">&nbsp;<input type="text" name="div" id="div" size="2" maxlength="2" value="" /></td>
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
	$div=$_GET['div'];

$_pagi_sql="SELECT * FROM alumnos WHERE curso = '$curso' and division = '$div' order by alumno";




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
                            <a href="cursopdf.php?curso=<?php echo $curso?>&div=<?php echo $div?>" target="_blank"><img src="pdf.png" alt="exportar" height="24" width="24"> Lista de alumnos</a> - <a href="cursopdf_con_datos.php?curso=<?php echo $curso?>&div=<?php echo $div?>" target="_blank"><img src="pdf.png" alt="exportar" height="24" width="24"> Lista de alumnos con todos los datos</a>- <a href="adeudan.php?curso=<?php echo $curso?>&div=<?php echo $div?>" target="_blank"><img src="pdf.png" alt="exportar" height="24" width="24"> Lista de previas</a></td>
						</tr>




						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">N°</td>							
							<td width="100" bgcolor="#808080" align="center" height="36">DNI</td>
							<td width="200" bgcolor="#808080" align="center" height="36">Alumno</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Padre</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Madre</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Tutor</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Tel.</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Donicilio</td>
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{

		$cont=$cont+1;
	
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $cont;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[dni];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[alumno];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[nompadre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[nommadre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[tutor];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[tel];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[domicilio];?></td>
						
                					
					
							
							
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
