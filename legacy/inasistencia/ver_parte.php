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
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

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


<form method="GET" action="ver_parte.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Consultar Parte por Docentes o por Fecha.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					<input name="porque" type="radio" value="1" checked="checked"/> Por Apellido
 					<br />

					
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el Apellido o parte de el:</td>
							<td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="28" maxlength="40" value="" autofocus/></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>

					</table>

						<div align="left">
						<input name="porque" type="radio" value="2"/> Por Fecha
						<br />
						<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Fecha del Parte:</td>
							<td align="right">&nbsp;<input type="text" name="fecha" id="fecha" value="<?echo $_GET["fecha"]?>" maxlength="16"/>
    							<img src="calendario.png" width="16" height="16" border="0" title="Fecha" id="fecha"></td>
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"fecha",       // id del campo de texto 
	    					ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
						button:"fechas"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>


					</table>

					
						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /><br></td>
						</tr>
						
		
					<p align="left">
</font>
</form>
					<?
if (isset($_GET['muestra2']))
{ 
$porque=$_GET['porque'];


	if ($porque==1)
	{

		$descripcion=$_GET['descripcion'];
		$_pagi_sql="SELECT * FROM docentes WHERE apellido like'%$descripcion%'";


	$_pagi_cuantos=5;
	$_pagi_conteo_alternativo = true;
	$_pagi_nav_num_enlaces=10;
	include("paginator.inc.php"); 
	?>
	<p align="left"><br><?
	echo"$_pagi_navegacion"; 
	?>
	<br><br>
	</p>
	<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="5" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>
						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">DNI</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Apellido</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Nombre</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Estado</td>
							<td bgcolor="#808080" width="118" align="center"  height="36">Ver Parte</td>							

							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{

		$resultz = mysql_query ("SELECT * FROM estados WHERE codigo = '$fila2[identificacion]'");
		$filaz = mysql_fetch_array($resultz) ;

	
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[dni];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[apellido];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaz[descripcion];?></td>
							<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><a href="ver_parte2.php?actor=<?php echo $fila2[dni]?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Ver Horario"></a></td>
						</tr>
		<?
		}
		?>
	</table><?
	}
	if ($porque==2)
	{
	$fecha=$_GET['fecha'];
	$_pagi_sql="SELECT * FROM partediario WHERE fecha='$fecha'";


$_pagi_cuantos=50;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><br><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

		?> <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="7" height="40" align="left">
							&nbsp;Resultado de la B&uacute;squeda</td>
						</tr>
						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">DNI</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Docente</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Fecha</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Falta</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Observ.</td>
							<td bgcolor="#808080" width="200" align="center" height="36">curso/turno/div</td>
							<td bgcolor="#808080" width="200" align="center" height="10">Obli.</td>
						
							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{

		$resultz = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila2[docente]'");
		$filaz = mysql_fetch_array($resultz) ;
		$resultz2 = mysql_query ("SELECT * FROM motivos WHERE codigo = '$fila2[falta]'");
		$filaz2 = mysql_fetch_array($resultz2) ;

	
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[docente];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaz[apellido];?>, <?echo $filaz[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[fecha];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaz2[descripcion];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[observaciones];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[curso];?>/<?echo $fila2[div];?>/<?echo $fila2[turno];?></td>
							<td width="10" bgcolor="#EAEAEA" align="center"><?echo $fila2[obligaciones];?></td>
							
						</tr>
						<?
						}
						?>
						</table><?

}

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