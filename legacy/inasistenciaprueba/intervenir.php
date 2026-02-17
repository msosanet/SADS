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
<title>Administrador del SID</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;






?>

<body background="bgris.gif" >


<form method="GET" action="intervenir.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Consultar alumnos por nombre y apellido para intervenir.<br> 
					Solo se veran los alumnos que fueron derivados por los preceptores</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el Nombre, Apellido o parte de ellos:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="28" maxlength="40" value="" /></td>
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
					
					<p align="center"><div class="titles1">&nbsp;<p align="left">Alumnos con intervenciones</p>
										
					
					<?
				
				//ESTO ES NUEVO PARA QUE SE VEAN LOS ALUMNOS DERIVADOS Y LOS CULIADOS DEL DEPARTAMENTO DE ORIENTACION NO TENGAN QUE TOMARSE EL TRABAJO DE USAR EL BUSCADOR
				
				
				
				
				
				
				
				
				
				
				
				if (isset($_GET['muestra2']))
{ 
	$descripcion=$_GET['descripcion'];
	$_pagi_sql="SELECT DISTINCT id,dni,alumnos.alumno,alumnos.curso,alumnos.division,alumnos.tel,fecha,observador,cargo,hechos FROM derivacion, alumnos WHERE alumnos.alumno LIKE '%$descripcion%' AND alumnos.dni = derivacion.alumno";






$_pagi_cuantos=5;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

		?> <table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="5" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>
						<tr>
							<td bgcolor="#808080" width="200" align="center" height="36">Alumno</td>
							<td bgcolor="#808080" width="40" align="center" height="36">Curso</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Telefono</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Derivador</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Motivo</td>
							<td bgcolor="#808080" width="40" align="center" height="36">Fecha</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Intervenir</td>							

							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[alumno];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[curso];?> - <?echo $fila2[division];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[tel];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[cargo];?> : <?echo $fila2[observador];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[hechos];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[fecha];?></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="intervenir2.php?actor=<?php echo $fila2[dni]?>&id=<?php echo $fila2[id]?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Derivar"></a></td>
							
                  					
					
							
							
						</tr>
						<?
						}
						?>
						</table><?
}
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