<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />

<link rel="stylesheet" type="text/css" href="style.css" />
<title>Administrador S.A.S.</title>


</head>




<?
include 'header.php';



$usuario = $_SESSION['usuario']; 
$contrasenia = $_SESSION['contrasenia'];  

//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un guión.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}


    function invertirFecha( $fechaz ){
      return implode( "-", array_reverse( preg_split( "/\D/", $fechaz ) ) );
    }


    function calcularFecha($dias){
     
    $calculo = strtotime("$dias days");
    return date("Y-m-d", $calculo);
    }




	if ($usuario!="")
{
	$conexion = conectar ();
	$error = 0;

	$result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
	if (mysql_num_rows ($result) == 0 )
	{ 
		$error=1;

	}
	if (mysql_num_rows ($result) != 0)
	{		
			$fila = mysql_fetch_array($result) ;
			if ( $fila[pass] != $contrasenia )	
			{
			 
				$error = 1;


			}
	}

}	
else
{
			 
	$error = 1;
}

if ($error==0)
{


$_SESSION['estado']=1;
$_SESSION['valor']=$fila[valor];
$_SESSION['sector']=$fila[sector];


?>

<!-- /p -->
<?
}
else {
	?>
				<script>
				var answer=alert("Datos incorrectos")
				</script> 
				<meta http-equiv='refresh' content='0; URL=index.php'>

				<? 

}
?> 

<body>
<div align="center">
	<table border="0" width="980" cellspacing="0" cellpadding="0">
		<tr>
			


	<table border="0" width="974" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0">
		<tr>
			<td>
			<!-- div align="center">
				<table border="0" width="980" cellspacing="0" cellpadding="0">
					</table>
				
				</div -->
			<table border="0" width="970">

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
if ($_SESSION['valor']==5) 
{		
include 'menuppal5.php';
}
?>
<!--BR><BR -->
<BR>
				<tr>
				
					<td>
					<?
						$archivo="&nbsp;"; 
						
					?>

					<p align="left">&nbsp;&nbsp;<B><?echo $fila[nombre]?><?echo $archivo?><?echo $fila[apellido]?></B>, Bienvenido al Sistema de Administrador del SID</p>				
<!-- /p -->
				
					
					<div align="center">
<? if ($_SESSION['valor']==3)
{
		$_pagi=mysql_query("SELECT * FROM novedades where borrado=1 order by fecha DESC");


		

?>


<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">
							&nbsp;Novedades de los alumnos</td>
						</tr>
						<tr>
							<td bgcolor="#808080" width="300" align="center" height="36">Novedad</td>
							<td bgcolor="#808080" width="30" align="center" height="36">Fecha</td>
							<td bgcolor="#808080" width="20" align="center"  height="36">Hora</td>
							<td bgcolor="#808080" width="80" align="center"  height="36">Notific&oacute;</td>

			
		
						</tr><?php	



		 while ($fila3 = mysql_fetch_array($_pagi))
		{	
				
?>
						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[novedad];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fila3[fecha]);?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[hora];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[grabo];?></td>
						</tr>
						


<? } ?>

</table> <br><br>


<?		$_pagi2=mysql_query("SELECT * FROM novedades2,docentes where novedades2.borrado=1 and novedades2.docente=docentes.dni order by fecha1 DESC");


		

?>


<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="7" height="40" align="left">
							&nbsp;Novedades de los Docentes</td>
						</tr>
						<tr>
							<td bgcolor="#808080" width="200" align="center" height="36">Docente</td>
							<td bgcolor="#808080" width="200" align="center" height="36">Materia</td>
							<td bgcolor="#808080" width="80" align="center"  height="36">Curso / Div</td>
							<td bgcolor="#808080" width="20" align="center"  height="36">Fecha de carga</td>
							<td bgcolor="#808080" width="20" align="center"  height="36">Fecha de comienzo</td>
							<td bgcolor="#808080" width="20" align="center"  height="36">Hora de carga</td>
							<td bgcolor="#808080" width="40" align="center"  height="36">Notific&oacute;</td>

			
		
						</tr><?php	



		 while ($fila3 = mysql_fetch_array($_pagi2))
		{	
				
?>
						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[apellido];?>, <?echo $fila3[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[materia];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[curso];?>°<?echo $fila3[div];?>ª</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fila3[fecha1]);?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fila3[fecha2]);?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[hora];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[grabo];?></td>
						</tr>
						


<? } ?>

</table> 
<br><br>



<? }

 if ($_SESSION['valor']==4)
{
		$_pagi=mysql_query("SELECT * FROM novedades where borrado=1 order by fecha DESC");


		

?>


<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">
							&nbsp;Novedades de los alumnos</td>
						</tr>
						<tr>
							<td bgcolor="#808080" width="300" align="center" height="36">Novedad</td>
							<td bgcolor="#808080" width="30" align="center" height="36">Fecha</td>
							<td bgcolor="#808080" width="20" align="center"  height="36">Hora</td>
							<td bgcolor="#808080" width="80" align="center"  height="36">Notific&oacute;</td>

			
		
						</tr><?php	



		 while ($fila3 = mysql_fetch_array($_pagi))
		{	
				
?>
						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[novedad];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fila3[fecha]);?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[hora];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila3[grabo];?></td>
						</tr>
						


<? } ?>

</table> <br><br>


<!-- ++++++++++++++++ PANTALLA INFO PARA SECRETARÍA +++++++++++++ -->

<? }




if ($_SESSION['valor']==0 or $_SESSION['valor']==1 or $_SESSION['valor']==2)
{



	$fecha_desde=date("Y-m-d");  
	$anio=date("Y");
	$mes=date("m"); 
	$dia=date("d");       
	$fecha_hasta=$anio."-12-31";
	$fecha_hoy=$anio."-".$mes."-".$dia;
	$_pagi_sql="SELECT docentes.dni,apellido,nombre, motivo, descripcion,fecha_desde,observaciones, count( motivo ) AS cantidad FROM ausentes, motivos, docentes WHERE ausentes.fecha_desde >= '$fecha_hoy' AND ausentes.identificacion = 1 AND ausentes.motivo = motivos.codigo AND ausentes.docente = docentes.dni and (ausentes.motivo=29 or ausentes.motivo=20 or ausentes.motivo=1 or ausentes.motivo=2 or ausentes.motivo=4 or ausentes.motivo=8 or ausentes.motivo=9 or ausentes.motivo=24 or ausentes.motivo=6 or ausentes.motivo=7 or ausentes.motivo=42 or ausentes.motivo=44 or ausentes.motivo=15 or ausentes.motivo=3 or ausentes.motivo=56 or ausentes.motivo=67 or ausentes.motivo=5 or ausentes.motivo=70) GROUP BY dni,motivo ORDER BY apellido";
// ACA AGREGUE MOTIVO 5
$_pagi_cuantos=50;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>

</p>

<table border="1" width="960" id="table1" cellpadding="2" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b" background="../imag/bar07.gif" colspan="6" height="40" align="left">
							&nbsp;Personal con m&aacute;s de 2 d&iacute;as de licencia</td>
						</tr>
						<tr>
							<td width="250" bgcolor="#808080" align="center" height="36">Docente</td>
							<td bgcolor="#808080" width="250" align="center" height="36">Motivo</td>
							<td bgcolor="#808080" width="250" align="center" height="36">Obs</td>
							<td bgcolor="#808080" width="20" align="center" height="36">Cantidad de dias</td>
							<td bgcolor="#808080" width="70" align="center" height="36">Fecha Desde</td>
							<td bgcolor="#808080" width="70" align="center" height="36">Fecha Hasta</td>
			
		
			</tr><?php	



		 while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
$contador=0;
			if ($fila2[cantidad] > 2)
			{
				
?>
						<tr>
							<td width="20"  align="left"><?echo $fila2[apellido];?>,<?echo $fila2[nombre];?></td>
							<td width="20" align="left"><?echo $fila2[descripcion];?></td>
							<td width="20" align="left"><?echo $fila2[observaciones];?></td>
							<td width="20" align="center"><?echo $fila2[cantidad];?></td>								

						<?
			$bus1 = mysql_query ("SELECT * FROM ausentes WHERE docente='$fila2[dni]' and fecha_desde >='$fecha_desde' and motivo=$fila2[motivo] order by fecha_desde ");

		 	while ($buscar2 = mysql_fetch_array($bus1))
			{
			if ($contador==0) $fecha1=$buscar2[fecha_desde];
			$fecha2=$buscar2[fecha_hasta];
			$contador=1;


						
						}?> 
						

							<td width="20" bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fecha1); ?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fecha2);?></td>
								

						</tr><?

}}
						?>
						</table> <br><br>
<? } 

?>

<!-- ++++++++++++++++ FIN PANTALLA INFO PARA SECRETARÍA +++++++++++++ -->
					</div>
					
						
					</td>
				</tr>

			</table>

							</td>
							
						</tr>
					</table>
						</div>

						
</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
		
		</tr>
	</table>
	
</div>
			</td>
		</tr>
	</table>
</div>
<p>



</body>

</html>

