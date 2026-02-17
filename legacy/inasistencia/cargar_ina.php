<?PHP

session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';

//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un guión.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$dni=$_GET['actor'];
//$identificacion=$_GET['ident'];


$hora=date("H:i:s");

$resultdocente = mysql_query ("SELECT * FROM docentes where dni='$dni'");
$filadocente = mysql_fetch_array($resultdocente);

$resultusuario = mysql_query ("SELECT * FROM usuarios where usuario='$usuario'");
$filausuario = mysql_fetch_array($resultusuario);


$resultplaza = mysql_query ("SELECT * FROM materia_cargo WHERE activo=1 order by plaza
");

$resultmotivo = mysql_query ("SELECT * FROM motivos where codigo <> 47 order by descripcion");

$errordoc = 0;
$hayerrores = 0;


if (!isset($_POST["submitx"])) {
	$_POST['d']=date("d");
	$_POST['m']=date("m");
	$_POST['a']=date("Y");
	$_POST['d2']=date("d");
	$_POST['m2']=date("m");
	$_POST['a2']=date("Y");
	$_POST['hora']=$hora;
}


$flag = 0;
if (isset($_POST["submitx"])) {
	// verifico los errores en los campos
	if (trim($_POST["d"]) == '') { $errorfecha = 1; $hayerrores = 1; };
	if (trim($_POST["m"]) == '') { $errorfecha = 1; $hayerrores = 1; };
	if (trim($_POST["a"]) == '') { $errorfecha = 1; $hayerrores = 1; };
	if (trim($_POST["d2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
	if (trim($_POST["m2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
	if (trim($_POST["a2"]) == '') { $errorfecha2 = 1; $hayerrores = 1; };
	if (trim($_POST["hora"]) == '') { $errorhora = 1; $hayerrores = 1; };
} else {
	$flag = 1;
}

if ($hayerrores OR $flag) { // Comienzo CONDICION IF
// Si no hay errores o no existe un submit

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>CARGAR INASIST PRUEBA <?=$filadocente['apellido']?> <?=$filadocente['nombre']?></title>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>
<style>
	#alertaLimiteDias {
	display: none;
	position: fixed;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	background-color: #fff9c4;
	border-radius: 10px;
	border: 1px solid #707070;
	padding: 20px;
	}
	#motivoAlerta {
		font-size: 16px; 
		color: #333;
		margin-bottom: 10px;
	}
	#mensajeAlerta {
		font-size: 16px; 
		color: #333;
		margin-bottom: 30px;
	}
	#botonCerrarAlerta {
		font-size: 18px; 
		color: #fff;
		width: 200px; 
		padding: 5px;
		border-radius:10px;
		background-color: #4caf50;
	}
	#botonGrabar {
		border: 1px solid #C0C0C0; 
		border-radius: 5px;
		font-size: 16px;
		padding-right: 3px; 
		font-weight:700; 
		background-color: #fff9c4;
		float:center
	}
</style>
</head>
<?PHP
include 'header.php';
?>


<body>


<div id="marco980">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>

<br>

<!-- ************************ FORMULARIO PARA SELECCIONAR DOCENTE EN FORMA DIRECTA **************-->
<table border="0" width="100%">
    <tr align="right">
        <td class="titulo" align="left">Cargar inasistencia</td>
        <td>
            <form method="GET" action="cargar_ina.php?actor=<? echo $dni; ?>" name="form20">
<!-- ************** LISTA DE DOCENTES PARA ELEGIR *********************************** -->

            Otro docente: <select style="border: 1px solid #888888; background-color: #ffffff; border-radius: 5px; padding: 4px 0 4px 0; box-shadow: 0 0 2px #555555;" size="1" name="actor" onchange="this.style.backgroundColor = 'red'">
            <option>- - - - - -</option>
            <? $listadocentes = mysql_query ("SELECT * FROM docentes WHERE identificacion = 1 ORDER BY apellido,nombre");

            	while ($docente = mysql_fetch_array($listadocentes)) {
					if (isset($dni)) $_sel = ($dni==$docente['dni']) ? "selected" : "";
					else $_sel = "";
					echo "<option value='" . $docente['dni'] . "' $_sel>" . $docente['apellido'] . " " . $docente['nombre'] . " - D.N.I. Nº " . $docente['dni'] . "</option>";
				    }
		    ?>
            </select>
<!-- FIN LISTA DE DOCENTES PARA ELEGIR *********************************************** -->
          <input type="submit" value="Buscar" style="border: 1px solid #C0C0C0;  border-radius: 5px; padding: 4px 10px 4px 10px; background-color: #ffd56b; font-weight:700; font-size: 14px; box-shadow: 0 0 2px #555555;"/>
           </form>
        </td>
    </tr>
</table>
<!-- ********* FIN FORMULARIO PARA SELECCIONAR DOCENTE EN FORMA DIRECTA **********************-->

<form method="POST" action="cargar_ina.php?actor=<? echo $dni . "&ident=1"; ?>">
<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p>

<div align="left">

					<div align="center">

					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
						<tr>
							<td colspan="4" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Docente: <b><?echo $filadocente['apellido'] .", " . $filadocente['nombre'] . "</b> - D.N.I. Nº " . number_format($filadocente[dni],0,'','.'); ?></td>
						</tr>

						<tr>



						  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Motivo:</td>
						  <td bgcolor="#EAEAEA" width="268" align="left">

                          <select size="1" autofocus="true" id="motivo" name="motivo"> <!-- ****************************LISTA MOTIVOS -->
						  <?
                            WHILE ($myrow6 = mysql_fetch_array($resultmotivo)) {
						    	echo "<option value=" . $myrow6[codigo] . ">" . $myrow6[descripcion] . "</option>";
						    }
						  ?>
                          </select> <!-- **********************************************************FIN LISTA MOTIVOS -->

						<!-- select size="1" autofocus name="motivo">
						<?	//WHILE ($myrow6 = mysql_fetch_array($resultmotivo))
						//{
							//if($_POST['motivo']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
							//echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion] </option>";
						//}
						?>
                          </select -->
						</td>
						<?
	  					if ($errorfecha==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>


								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha Desde:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" id="d" name="d" size="2" maxlength="2" value="<?echo $_POST['d']; ?>" />
							-
							<input type="text" id="m" name="m" size="2" maxlength="2" value="<?echo $_POST['m']; ?>" />
							-
							<input type="text" id="a" name="a" size="4" maxlength="4" value="<?echo $_POST['a']; ?>" />
							(DD-MM-AAAA)</td>

						</tr>
						<tr>

							<td width="174" bgcolor="#EAEAEA" align="right">Observaciones:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><TEXTAREA COLS=35 ROWS=5 NAME="observaciones"></TEXTAREA></td>

						<?
	  					if ($errorfecha2==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>


								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Fecha Hasta:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" id="d2" name="d2" size="2" maxlength="2" value="<?echo $_POST['d2']; ?>" />
							-
							<input type="text" id="m2" name="m2" size="2" maxlength="2" value="<?echo $_POST['m2']; ?>" />
							-
							<input type="text" id="a2" name="a2" size="4" maxlength="4" value="<?echo $_POST['a2']; ?>" />
							(DD-MM-AAAA)</td>


						</tr>

						<tr>
					<?
	  					if ($errorhora==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Hora:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="hora" size="10" maxlength="10" value="<?echo $_POST['hora'];?>" />(HH:MM:SS)</td>
							</td>



							<td width="190" bgcolor="#EAEAEA" align="right">Notific&oacute;:
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><b><? echo $filausuario['apellido']  ?>&nbsp;<? echo $filausuario['nombre']  ?></b>
							</td>
						</tr>
						<!-- input type="hidden" name="identificacion" id="identificacion" value="<? //echo $identificacion;?>"/ -->

						<tr>
							<td width="876" bgcolor="#EAEAEA" align="right" colspan="4"><font color="red"></font>
						  <?
                         //   WHILE ($myrow6 = mysql_fetch_array($resultplaza)) {
					//if ($myrow6[curso]=="")	echo "<option value=" . $myrow6[id] . ">" . $myrow6[plaza] . " - " . $myrow6[nombre] ."</option>";

						    	//else echo "<option value=" . $myrow6[id] . ">" . $myrow6[plaza] . " - " . $myrow6[nombre] ." - " .$myrow6[curso] . "ï¿½ " . $myrow6[division] ."ï¿½ ". "</option>";
						//    }
						  ?>
                          </td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Marque esta casilla si quiere no mostrar las observaciones</b> <input type="checkbox" name="mostrar" value="1"></td>
						</tr>
						<tr>
							<td width="876" bgcolor="#EAEAEA" align="left" colspan="4"><b>Marque esta casilla si quiere que no salga en pizarra</b> <input type="checkbox" name="pizarra" value="1"></td>
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input id="botonGrabar" type="submit" value="     Grabar     " name="submitx" /></td>
						</tr>
						</table>
					</div>
<p align="right">&nbsp;</p>

</div>
<?
include 'footer.php';
?>

<input name="dni" type="hidden" value ="<?php echo $dni ?>"/>
<!-- input name="identificacion" type="hidden" value ="<?php //echo $identificacion ?>"/ -->
	
	</form>
	<div id="alertaLimiteDias" >
		<p id="motivoAlerta" ></p>
		<p id="mensajeAlerta" ></p>
		<button id="botonCerrarAlerta" onclick="cerrarAlerta()">ENTENDIDO</button>
	</div>
</div>
</body>
<?
} // FIN CONDICION IF
else
{

	$fecha_desde=$_POST['a']."-".$_POST['m']."-".$_POST['d'];
	$fecha_hasta=$_POST['a2']."-".$_POST['m2']."-".$_POST['d2'];
	$motivo=$_POST['motivo'];
	$hora=$_POST['hora'];
	$observaciones=$_POST['observaciones'];
	$dni=$_POST['dni'];
	$now=date("Y-m-d");
	$graba=$filausuario["nombre"];
	//$identificacion=$_POST['identificacion'];
	$nomostrar=$_POST['mostrar'];
	if ($nomostrar <> 1) $nomostrar=0;
	$nopizarra=$_POST['pizarra'];
	if ($nopizarra <> 1) $nopizarra=0;
	$plaza=$_POST['plaza'];





	$cantdias=diasEntreFechas($fecha_desde, $fecha_hasta);
	$cuentalic=0;
	//CHEQUEO QUE NO TENGA LICENCIA
	$chequeolic="SELECT * FROM ausentes WHERE docente='$dni' AND fecha_desde BETWEEN '$fecha_desde' AND '$fecha_hasta' AND motivo='$motivo'";
	//echo $chequeolic;
	$resultcheck = mysql_query ($chequeolic);
	$filacheck = mysql_fetch_array($resultusuario);
	$cuentalic = mysql_num_rows($resultcheck);
		if ($cuentalic>0)
		{
		?>
			<script>
			var answer=alert("Ya se encuentra cargada una licencia para este docente, fecha y motivo")
			</script>
			<script language="JavaScript" type="text/javascript">
				setTimeout("window.history.go(-1)",50);
			</script>
		<?
		}
		else
		{
			while ($cantdias > 0){ // Carga de la inasistencia/licencia

				if (mysql_query ("INSERT INTO ausentes VALUES (0,'$dni','$fecha_desde','$fecha_desde','$hora','$motivo','$graba','$observaciones','$now',1,0,$nomostrar,$nopizarra,0)"))
				{
				}
				else {
					?>
					<script>
					var answer=alert("No se pudo grabar en la BD")
					</script>
					<meta http-equiv='refresh' content='0; URL=menu.php?'>
					<?
				}
				$cantdias=$cantdias-1;

				$fechaComparacion = strtotime("$fecha_desde");
				$calculo= strtotime("1 days", $fechaComparacion);
				$fecha_desde= date("Y-m-d", $calculo);
			}//FIN WHILE

			?>
			<script>
			var answer=alert("Datos Grabados Correctamente ")
			</script>
			<meta http-equiv='refresh' content='0; URL=cargar_ina.php?actor=<?php echo $dni ?>&ident=1<? //echo $identificacion; ?>'>
			<?
		}
}
?>
<script language=javascript> 
/* Codigo JS para la funcionalidad del cartel de alerta
por sobrepasar la cantidad de dï¿½as consecutivos
Hace uso del archivo consultaUltimosDiasCargados.php
*/	
	const motivo = document.getElementById('motivo');
	// Referencia del boton grabar
	const botonGrabar = document.getElementById('botonGrabar');

	
	function habilitarBoton() {
		botonGrabar.disabled = false;
		botonGrabar.style['background-color'] = '#fff9c4'
	}

	function deshabilitarBoton() {
		botonGrabar.disabled = true;
		botonGrabar.style['background-color'] = 'grey'
	}

	function mostrarAlerta(motivo,mensaje) {
		document.getElementById("motivoAlerta").textContent = motivo;
		document.getElementById("mensajeAlerta").textContent = mensaje;
		document.getElementById("alertaLimiteDias").style.display = "block";
	}
	function cerrarAlerta(e) {
		document.getElementById("alertaLimiteDias").style.display = "none";
	}
	function parsearAfechaSimple(input){
		// console.log("parsearAfechaSimple input",input)
		const fecha = new Date(input);

		const anio = fecha.getFullYear();
		const mes = String(fecha.getMonth()+1).padStart(2, '0'); // Los meses van de 0 a 11
		const dia = String(fecha.getDate()).padStart(2, '0');

		const fechaFormateada = `${anio}-${mes}-${dia}`;
		
		console.log("parsearAfechaSimple output",fechaFormateada)
		return fechaFormateada; 
	}	
	async function fetchUltimosDiasCargados(diasQueFaltan,fechaDesdeReferencia,nuevaFechaDesde) {
		var urlParams = new URLSearchParams(window.location.search);

		try {
			const response = await fetch('consultaUltimosDiasCargados.php',{
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded' // Importante para enviar datos en el cuerpo de la peticiï¿½nn
				},
				body: `docente=${urlParams.get('actor')}&diasQueFaltan=${diasQueFaltan}&fechaDesdeReferencia=${fechaDesdeReferencia}&nuevaFechaDesde=${nuevaFechaDesde}` // EnvÃ­a los datos en el cuerpo de la peticiÃ³n
			}) 
			
			if (!response.ok) { // Manejo de errores de respuesta HTTP
				throw new Error(`error HTTP - estado: ${response.status}`);
			}

			const data = await response.json();
			console.log("consultaUltimosDiasCargados >", data);
			return data.cantidad; // Retorna la cantidad
		} catch (error) {
			console.error('Error al obtener los datos:', error);
			return undefined; // Retorna undefined en caso de error
		}	
	}
	// campos fecha desde
	async function calcularLimiteFecha(anioDesde,mesDesde,diaDesde,anioHasta,mesHasta,diaHasta) {
		// console.log(anioDesde,mesDesde,diaDesde,anioHasta,mesHasta,diaHasta)
		const fechaDesde = new Date(anioDesde,mesDesde-1,diaDesde)
		const fechaHasta = new Date(anioHasta,mesHasta-1,diaHasta)
		if (fechaHasta >= fechaDesde) {
			const diffTime = Math.abs(fechaHasta - fechaDesde);
			const dias = (Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1); // El +1 es porque se toma la carga de 1 día cuando fecha_desde y fecha_hasta son el mismo día.
			

			// console.log("Diferencia de dias nuevos " +  dias);
			
			const diasQueFaltan = 45 - dias
			// console.log("Dias que faltan " +  diasQueFaltan);

			if((diasQueFaltan >= 0) && !!motivo?.value && motivo?.value == 1) {
				// console.log("fechaDesde ",fechaDesde)
				// console.log("Cantidad de dias faltan para el limite " + diasQueFaltan);
				// console.log("Dias a restar a la fechaDesde para calcular la fechaReferencia ",fechaDesde.getDate() - diasQueFaltan)
				
				let fechaDesdeReferencia = new Date() 
				
				fechaDesdeReferencia.setDate((fechaDesde.getDate() - diasQueFaltan));
			
				const dato = await fetchUltimosDiasCargados(diasQueFaltan, parsearAfechaSimple(fechaDesdeReferencia),parsearAfechaSimple(fechaDesde))
				
				//Si con la suma de lo que hay en la BDD no supera el limtie
				
				/* Si la cantidad de registros entre esas fechas es igual a la cantidad
				de dias que faltan, significa que hay $diasQueFaltan dÃ­as consecutivos antes de la fechaDesde.
				por lo tanto $diasQueFaltan + $dias = 30
				*/
				if ((!!dato) && ((parseInt(diasQueFaltan) == parseInt(dato)))) {
					mostrarAlerta('Se quieren cargar '+dias+' días. Pero se ha superado el límite de 30 días consecutivos para el motivo 6 III A. Enfer. personal de corto plazo','Posee al menos '+ dato + ' días antes del ' + parsearAfechaSimple(fechaDesde) + 'Informar al sector carga de inasistencias.' ) 	
				} else {
					habilitarBoton()	
				}
			} else if((diasQueFaltan < 0) && !!motivo?.value && motivo?.value == 1) {
				mostrarAlerta('Se ha superado el límite de 30 días consecutivos para el motivo 6 III A. Enfer. personal de corto plazo', 'Del ' + parsearAfechaSimple(fechaDesde) + ' al ' + parsearAfechaSimple(fechaHasta)+ '. Informar al sector carga de inasistencias.')
			} else {
				habilitarBoton()
			}
		} else {
			mostrarAlerta('Cuidado', 'La fecha de inicio ('+parsearAfechaSimple(fechaDesde)+') no puede ser posterior a la fecha de fin ('+ parsearAfechaSimple(fechaHasta) + ').')
			deshabilitarBoton()
		}
	}
	
	const inputDiaDesde = document.getElementById('d');
	const inputMesDesde = document.getElementById('m');
	const inputAnioDesde = document.getElementById('a');
	// campos fecha hasta
	const inputDiaHasta = document.getElementById('d2');
	const inputMesHasta = document.getElementById('m2');
	const inputAnioHasta = document.getElementById('a2');
	
	function parsearFechas() {
		
		return [parseInt(inputAnioDesde.value),parseInt(inputMesDesde.value),parseInt(inputDiaDesde.value),parseInt(inputAnioHasta.value),parseInt(inputMesHasta.value),parseInt(inputDiaHasta.value)]
	}
	motivo && motivo.addEventListener('input', function() {
		// console.log('El valor de inputDiaDesde ha cambiado');
		calcularLimiteFecha(...parsearFechas())
	});
	// Escuchar el evento 'change'
	inputDiaDesde && inputDiaDesde.addEventListener('input', function() {
		// console.log('El valor de inputDiaDesde ha cambiado');
		calcularLimiteFecha(...parsearFechas())
	});
	inputMesDesde && inputMesDesde.addEventListener('input', function() {
		// console.log('El valor de inputMesDesde ha cambiado');
		calcularLimiteFecha(...parsearFechas())
		
	});	
	inputAnioDesde && inputAnioDesde.addEventListener('input', function() {
		// console.log('El valor de inputAnioDesde ha cambiado');
		calcularLimiteFecha(...parsearFechas())
		
	});
	
	inputDiaHasta && inputDiaHasta.addEventListener('input', function() {
		// console.log('El valor de inputDiaHasta ha cambiado');
		calcularLimiteFecha(...parsearFechas())
		
	});
	inputMesHasta && inputMesHasta.addEventListener('input', function() {
		// console.log('El valor det inputMesHasta ha cambiado');
		calcularLimiteFecha(...parsearFechas())
		
	});	
	inputAnioHasta && inputAnioHasta.addEventListener('input', function() {
		// console.log('El valor de inputAnioHasta ha cambiado');
		calcularLimiteFecha(...parsearFechas())
		
	});

</script>
</html>
<? } ?>