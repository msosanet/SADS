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


<form method="GET" action="constancias.php">

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
							
							

							<td width="150" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha de la constancia:</td>
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">
 							<input type="text" name="fecha_desde" id="fecha_desde" value="<?echo $_GET["fecha_desde"]?>" maxlength="10"/>
    							<img src="calendario.png" width="16" height="16" border="0" title="Fecha Desde" id="fechas1">
							</td>
						<!-- script que define y configura el calendario-->
    						<script type="text/javascript"> 
	   					Calendar.setup({ 
	    					inputField:"fecha_desde",       // id del campo de texto 
	    					ifFormat:"%Y-%m-%d",            // formato de la fecha que se escriba en el campo de texto 
						button:"fechas1"             // el id del bot&oacute;n que lanzar&aacute; el calendario 
								}); 
						</script>
												
							</font>
    
							<td bgcolor="#EAEAEA" width="225" align="left">hs Entrada:
 							<input type="text" name="hse1" id="hse1" value="<?echo $_GET["hse1"]?>" maxlength="2" size="2"/>:<input type="text" name="hse2" id="hse2" value="<?echo $_GET["hse2"]?>" maxlength="2" size="2"/>	
							
							<td bgcolor="#EAEAEA" width="225" align="left">hs Salida:
 							<input type="text" name="hss1" id="hss1" value="<?echo $_GET["hss1"]?>" maxlength="2" size="2"/>:<input type="text" name="hss2" id="hss2" value="<?echo $_GET["hss2"]?>" maxlength="2" size="2"/>	
						</tr>
						
						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Seleccionar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
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
	$fecha_desde=$_GET["fecha_desde"];






	$_pagi_sql="SELECT distinct dni FROM constancias WHERE fecha ='$fecha_desde' order by dni";



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

		?> <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="4" height="40" align="left">
							&nbsp;Resultado del Filtro</td>
						</tr>
						<tr>
							<td width="200" bgcolor="#808080" align="center" height="36">Docente</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Entrada</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Salida</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Acciones</td>


							
						</tr>

		<?php 
$hora_entrada=$_GET["hse1"].":".$_GET["hse2"];
$hora_salida=$_GET["hss1"].":".$_GET["hss2"];


while ($fila2 = mysql_fetch_array($_pagi_result))
		{	
			$resultobs = mysql_query ("SELECT * FROM docentes WHERE dni = '$fila2[dni]' ");
			$filaobs = mysql_fetch_array($resultobs);
			$resultz1 = mysql_query ("SELECT * FROM diario WHERE dni = '$fila2[dni]' and fecha ='$fecha_desde' and tipo = 'Entrada' ");
			$filaz1 = mysql_fetch_array($resultz1);
			$resultz2 = mysql_query ("SELECT * FROM diario WHERE dni = '$fila2[dni]' and fecha ='$fecha_desde' and tipo = 'Salida' ");
			$filaz2 = mysql_fetch_array($resultz2);
;
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaobs[apellido];?>,<?echo $filaobs[nombre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaz1[horario];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $filaz2[horario];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><a href="pdf_const.php?dni=<?php echo $fila2[dni]?>&fecha=<?php echo $fecha_desde ?>&hse=<?php echo $hora_entrada ?>&hss=<?php echo $hora_salida ?>" target="_blank">Constancia</a></td>

								
                  					
					
							
							
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