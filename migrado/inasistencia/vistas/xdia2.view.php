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
<title></title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;


//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un guión.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}

    function calcularFecha($dias){
     
    $calculo = strtotime("$dias days");
    return date("Y-m-d", $calculo);
    }



?>

<body background="bgris.gif" >


<form method="GET" action="xdia.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Filtrar por Fecha.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="100%">
						<tr>
							
							

								

							
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						
						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Filtrar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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
	$fecha_desde=date("Y-m-d");  
	$anio=date("Y");      
	$fecha_hasta=$anio."-12-31";





	$_pagi_sql="SELECT docentes.dni,apellido,nombre, motivo, descripcion,fecha_desde, count( motivo ) AS cantidad FROM ausentes, motivos, docentes WHERE ausentes.fecha_desde >= '2014-01-01' AND ausentes.motivo = motivos.codigo AND ausentes.docente = docentes.dni GROUP BY dni,motivo ORDER BY apellido";





$_pagi_cuantos=5000;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

		?> <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="8" height="40" align="left">
							&nbsp;Resultado del Filtro</td>
						</tr>
						<tr>
							<td width="200" bgcolor="#808080" align="center" height="36">Docente</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Motivo</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Cantidad + 2</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Fecha Desde</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Fecha Hasta</td>


							

							
		
			</tr><?php	



		 while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
$contador=0;
			if ($fila2[cantidad] > 2)
			{
				
?>
						<tr>
							<td width="20" bgcolor="#FFFF00" align="center"><?echo $fila2[apellido];?>,<?echo $fila2[nombre];?></td>
							<td width="20" bgcolor="#FFFF00" align="center"><?echo $fila2[descripcion];?></td>
							<td width="20" bgcolor="#FFFF00" align="center"><?echo $fila2[cantidad];?></td>								

						<?
			$bus1 = mysql_query ("SELECT * FROM ausentes WHERE docente='$fila2[dni]' and fecha_desde >='$fecha_desde' and motivo=$fila2[motivo] order by fecha_desde ");
?>




							

							
		
			
<?


		 	while ($buscar2 = mysql_fetch_array($bus1))
			{
			if ($contador==0) $fecha1=$buscar2[fecha_desde];
			$fecha2=$buscar2[fecha_hasta];
			$contador=1;
		


						
						}?> 
						

							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fecha1;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fecha2;?></td>
								

						</tr><?

}}
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
