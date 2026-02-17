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


<form method="GET" action="alu_tarde.php">

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
					<p align="center"><div class="titles1">&nbsp;<p align="left">Filtrar por Dia los alumnos tarde</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					
					<table border="0" width="100%">
						<tr>
							
							

							<td width="150" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="fecha" id="fecha" value="<?echo $_GET["fecha"]?>" maxlength="10"/>
    							<img src="calendario.png" width="16" height="16" border="0" title="Fecha Desde" id="fechas1">
							</td>
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"fecha",       // id del campo de texto 
	    					ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
						button:"fechas1"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>

						

							

							

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
	$fecha=$_GET["fecha"];
	$hora=$_GET["hora"];


$dias = array('7','1','2','3','4','5','6');
$fecha_q = $dias[date('N', strtotime($fecha))];



	$fecha_desde = $fecha;
	$invert = explode("-",$fecha_desde); 
	$fecha_invert1 = $invert[2]."-".$invert[1]."-".$invert[0]; 




	$_pagi_sql="SELECT * FROM diario_alu where fecha ='$fecha' order by horario";



$_pagi_cuantos=50;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>

</p><?

		?> <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="5" height="40" align="left">
							&nbsp;Resultado del Filtro  <font color="#D08230"><?echo $fecha_invert1?></td>
						</tr>
						<tr>
							<td width="200" bgcolor="#ffffff" align="center" height="36"><b>Apellido y Nombre</td></b>
							<td width="30" bgcolor="#ffffff" align="center" height="36"><b>DNI</td></b>
							<td bgcolor="#ffffff" width="100" align="center"  height="36"><b>Horario de Entrada</td></b>
							<td bgcolor="#ffffff" width="100" align="center"  height="36"><b>Curso</td></b>
							<td bgcolor="#ffffff" width="80" align="center" height="36"><b>Division</td></b>




								

							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
			$rest1 = substr($fila2[dni], 0, 2);
			$rest2 = substr($fila2[dni], 2, 3);
			$rest3 = substr($fila2[dni], 5, 3);
			$rest4 =$rest1.".".$rest2.".".$rest3;
			$resultobs = mysql_query ("SELECT * FROM alumnos WHERE dni = '$rest4' ");
			$filaxx = mysql_fetch_array($resultobs);




		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaxx[alumno];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center">
													<? 
													if ($filaxx[dni]=="") { 
																echo $rest4; } 
													else { echo $filaxx[dni]; } ?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[horario];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaxx[curso];?>º</td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaxx[division];?>º</td>
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