<?PHP
session_start();
include 'conexion.php';
?>

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />

<link rel="stylesheet" type="text/css" href="style2.css" />
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
	<table border="0" width="990" cellspacing="0" cellpadding="0">
		<tr>
			


	<table border="0" width="980" cellspacing="0" cellpadding="0">
		<tr>
			<td>
<!-- +++++++++++++ BARRA DE MENÚS +++++++++++++ -->
			<!-- table border="1" width="1100" bgcolor="#FFFFFF">      -->

<?if ($_SESSION['valor']==1)  // +++++++++++++++++ ADMINISTRACIÓN +++++++++++++++
{		
include 'menuppal2.php';
}
if ($_SESSION['valor']==0)  // ++++++++++++++++++ DIRECTIVO ++++++++++++++++++++
{		
include 'menuppal.php';
}
if ($_SESSION['valor']==3)  // +++++++++++++++ PRECEPTOR +++++++++++++++
{		
include 'menuppal3.php';
}
if ($_SESSION['valor']==4)  // ++++++++++++++ E.O.E. +++++++++++++++++++
{		
include 'menuppal4.php';
}
if ($_SESSION['valor']==5) 
{		
include 'menuppal5.php';
}
?>
<!-- +++++++++++++ FIN BARRA DE MENÚS +++++++++++++ -->

<!--BR -->
				<tr>
				
					<td>

					<p align="left">&nbsp;&nbsp;<B><?echo $fila[nombre] . " " . $fila[apellido]?></B>, Bienvenido al S.A.S.</p>
<!-- /p -->
				
					
					<div align="center">
<!-- +++++++++++ PRECEPTOR +++++++++++++++ -->
<? if ($_SESSION['valor']==3)

{
		$_pagi=mysql_query("SELECT * FROM novedades where borrado=1 order by fecha DESC");


		

?>


<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b" colspan="4" height="40" align="left">
							&nbsp;Novedades de los alumnos</td>
						</tr>
						<tr bgcolor="#cccccc" height="40">
							<td width="700" align="center" height="36"><b>NOVEDAD</b></td>
							<td width="70" align="center" height="36"><b>FECHA</b></td>
							<td width="15" align="center"  height="36"><b>HORA</b></td>
							<td width="15" align="center"  height="36"><b>NOTIFICÓ</b></td>

			
		
						</tr><?php	



		 while ($fila3 = mysql_fetch_array($_pagi))
		{	
				
?>
						<tr height="35">
							<td bgcolor="#EAEAEA" align="left"><?echo $fila3[novedad];?></td>
							<td bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fila3[fecha]);?></td>
							<td bgcolor="#EAEAEA" align="center"><?echo $fila3[hora];?></td>
							<td bgcolor="#EAEAEA" align="center"><?echo $fila3[grabo];?></td>
						</tr>
						


<? } ?>

</table> <br><br>


<?		$_pagi2=mysql_query("SELECT * FROM novedades2,docentes where novedades2.borrado=1 and novedades2.docente=docentes.dni order by fecha1 DESC");


		

?>


<table border="1" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="7" height="40" align="left">
							&nbsp;Novedades de los Docentes</td>
						</tr>
						<tr bgcolor="#cccccc" height="36">
							<td width="200" align="center">Docente</td>
							<td width="300" align="center">Materia</td>
							<td width="50" align="center">Curso<br>y Div</td>
							<td width="70" align="center">Fecha de carga</td>
							<td width="70" align="center">Fecha de comienzo</td>
							<td width="70" align="center">Hora de carga</td>
							<td width="50" align="center">Notific&oacute;</td>

			
		
						</tr><?php	



		 while ($fila3 = mysql_fetch_array($_pagi2))
		{	
				
?>
						<tr height="36">
							<td bgcolor="#EAEAEA" align="left"><?echo $fila3[apellido];?>, <?echo $fila3[nombre];?></td>
							<td bgcolor="#EAEAEA" align="left"><?echo $fila3[materia];?></td>
							<td bgcolor="#EAEAEA" align="center"><?echo $fila3[curso];?>°<?echo $fila3[div];?>ª</td>
							<td bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fila3[fecha1]);?></td>
							<td bgcolor="#EAEAEA" align="center"><?echo invertirFecha($fila3[fecha2]);?></td>
							<td bgcolor="#EAEAEA" align="center"><?echo $fila3[hora];?></td>
							<td bgcolor="#EAEAEA" align="center"><?echo $fila3[grabo];?></td>
						</tr>
						


<? } ?>

</table> 
<br><br>


<!-- +++++++++ PANTALLA DE INICIO USUARIO E.O.E. +++++++++++ -->
<? }
 if ($_SESSION['valor']==4)
{
		$_pagi=mysql_query("SELECT * FROM novedades where borrado=1 order by fecha DESC");


		

?>


<table border="1" width="970" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">
							&nbsp;Novedades de los alumnos</td>
						</tr>
						<tr bgcolor="cccccc">
							<td width="300" align="center" height="36">Novedad</td>
							<td width="30" align="center" height="36">Fecha</td>
							<td width="20" align="center"  height="36">Hora</td>
							<td width="80" align="center"  height="36">Notific&oacute;</td>

			
		
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
						


<? }  ?>


</table> <br><br>
<? } ?>
<!-- +++++++++ FIN PANTALLA DE INICIO USUARIO E.O.E. +++++++++++ -->

<!-- +++++++ PANTALLA INICIAL USUARIO ADMINISTRACIÓN +++++++++ -->

<?
//+++++++ PANTALLA INICIAL USUARIO RECTORIA O E.O.E. +++++++++

if ($_SESSION['valor']==0 or $_SESSION['valor']==1 or $_SESSION['valor']==2)
{

//+++++++++++++++ AVISOS VIGENTES +++++++++++++++++++++++++

?>

<div id="marco980" align="center"> <!-- ++++++ INICIO MARCO 980 ++++++ -->

<form method="get" action="nov_docentes_ver2.php">

<?
$date = date('Y-m-d');
$_pagi_sql="SELECT * FROM nov_docentes where borrado=1 AND categoria = 'doc' AND vencimiento >= '$date' ORDER BY codigo DESC";
$_pagi_cuantos=20000;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
?>

<br>

<!-- ************* NOVEDADES DOCENTES ********************** -->
<div id="nov_container_corto" align="left">

<?
include("paginator.inc.php");
?>

<div align="center">
<p class="titulo">NOVEDADES PARA DOCENTES</p>
</div>

<div id="nov_box_corto">

<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{
?>
<div id="novedad">
  <!-- p class="fecha"><? //echo "Publ. " . $fila2[fecha] . " - Vto." . $fila2[vencimiento]; ?></p -->
  <p class="titulo"><? echo $fila2[tema]; ?></p>
  <p class="novtext"><? echo $fila2[aviso]; ?></p>
</div>
<? }	?>

</div>
</div>
<!-- ************* FIN NOVEDADES DOCENTES ********************** -->

<!-- ************* NOVEDADES ALUMNOS ********************** -->
<?
$_pagi_sql="SELECT * FROM nov_docentes where borrado=1 AND categoria = 'alu' AND vencimiento >= '$date' ORDER BY codigo DESC";
?>

<div id="nov_container_alu_corto" align="left">

<?
include("paginator.inc.php");
?>

<div align="center">
<p class="titulo">NOVEDADES PARA ALUMNOS<? //echo "$_pagi_navegacion"; ?></p>
</div>

<div id="nov_box_corto">

<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{
?>
<div id="novedad">
  <!-- p class="fecha"><? //echo "Publ. " . $fila2[fecha] . " - Vto." . $fila2[vencimiento]; ?></p -->
  <p class="titulo"><? echo $fila2[tema]; ?></p>
  <p class="novtext"><? echo $fila2[aviso]; ?></p>
</div>
<? }	?>
</div>

</div>
<!-- ************* FIN NOVEDADES ALUMNOS ********************** -->


<!-- ************* NOVEDADES ADMINISTRACION ********************** -->
<?
$_pagi_sql="SELECT * FROM nov_docentes where borrado=1 AND categoria = 'adm'  AND vencimiento >= '$date' ORDER BY codigo DESC";
?>
<div id="nov_container_adm_corto" align="left">

<?
include("paginator.inc.php");
?>

<div align="center">
<p class="titulo">NOVEDADES ADMINISTRACION<? //echo "$_pagi_navegacion"; ?></p>
</div>

<div id="nov_box_corto">

<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{
?>
<div id="novedad">
  <!-- p class="fecha"><? //echo "Publ. " . $fila2[fecha] . " - Vto." . $fila2[vencimiento]; ?></p -->
  <p class="titulo"><? echo $fila2[tema]; ?></p>
  <p class="novtext"><? echo $fila2[aviso]; ?></p>
</div>
<? }	?>
</div>

</div>

</div> <!-- +++++ FIN MARCO 980 +++++++ -->
<!-- ************* FIN NOVEDADES ADMINISTRACION ********************** -->

<!-- +++++++++++ FIN PANEL DE AVISOS VIGENTES ++++++++++++++++ -->
<p>&nbsp;</p>
<?
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


<?
echo "P&aacute;g. " . $_pagi_navegacion;
?>


<table border="1" id="table1" cellpadding="2" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b" background="../imag/bar07.gif" colspan="6" height="40" align="left">
							&nbsp;Personal con m&aacute;s de 2 d&iacute;as de licencia</td>
						</tr>
						<tr bgcolor="#cccccc">
							<td width="250" align="center" height="36">Docente</td>
							<td width="200" align="center" height="36">Motivo</td>
							<td width="240" align="center" height="36">Obs</td>
							<td width="18" align="center" height="36">Cantidad de dias</td>
							<td width="70" align="center" height="36">Fecha Desde</td>
							<td width="70" align="center" height="36">Fecha Hasta</td>
			</tr>

<?php



		 while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
$contador=0;
			if ($fila2[cantidad] > 2)
			{
				
?>
						<tr>
							<td align="left"><?echo $fila2[apellido];?>,<?echo $fila2[nombre];?></td>
							<td align="left"><?echo $fila2[descripcion];?></td>
							<td align="left"><?echo $fila2[observaciones];?></td>
							<td align="center"><?echo $fila2[cantidad];?></td>

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
</table>

<!-- ++++++++++++ FIN TABLA DE DOCENTES CON MÁS DE 2 DÍAS DE LICENCIA ++++++++++ -->
<br><br>
<? } 

?>


					</div>
					
						
					</td>
				</tr>

			<!-- /table -->

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
<!-- >
		</tr>
	</table>
	
</div>
			</td>
		</tr>
	</table>
</div>
<p>

-->

</body>

</html>

<!-- ++++++++++++ PAPELERA ++++++++++++ -->
