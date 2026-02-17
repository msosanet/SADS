<?PHP

session_start();

/*include 'conexion.php';
$conexion = conectar ();*/
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Reemplaza "login.php" con la URL de tu página de inicio de sesión
    exit();
}
//$conexion = desconectar ();
if ($_POST['seleccion']=='materias')
{include 'conexion3.php';
$conexion = conectar ();

}
if ($_POST['seleccion']=='cargos')
{include 'conexion.php';
$conexion = conectar ();
}



if (isset($_POST['fecha'])) $diadesc = $_POST['fecha'];
else $diadesc = date("Y-m-d");
$fVisible = date("d/m/Y",strtotime($diadesc));;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Asistencia docente: Control biom&eacute;trico de acceso el <?=$fVisible?></title>
  <style>
        .elegant-table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }

        .elegant-table th, .elegant-table td {
            border: 1px solid #db6212;
            text-align: center;
            padding: 8px;
        }

        .elegant-table th {
            background-color: #db6212;
            font-weight: bold;
        }

        .elegant-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>



</head>
<?
include 'header.php';


?>

<body background="bgris.gif" >



<div align="center" style="max-width: 980px">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>	
</div>



<div align="center">
<form method="POST" action="paros.php">
		<div align="center" style="max-width: 75%">
			<table class="elegant-table">
				<tr><td colspan="2"><h2>PAROS</h2></td></tr>
				<tr><td colspan="2"><h2>Docentes que deben concurrir el dia <?=$fVisible?></h2></td></tr>
				<tr><td colspan="2"><label for="fecha">Selecciona una fecha:</label><input type="date" id="fecha" name="fecha" value="<?=$diadesc?>"></td></tr>
				<tr><td ><label for="seleccion">Selecciona:</label>
					<select name="seleccion" id="seleccion">
						<option value="materias" <? if ($_POST[seleccion]=='materias'){echo "selected";}?> > Materias</option>
						<option value="cargos" <? if ($_POST[seleccion]=='cargos'){echo "selected";}?>>Cargos</option>
					</select></td>
					<tr><td colspan="2"><input type="submit" value="Modificar"></td></tr>
				
		
<input type="hidden" name="actor" value="<?echo $actor;?>">
</form>
			</table>
		<table class="elegant-table" style="width: 100%">
		<tr>
			<th>Horario</th>
			<th>Docente</th>
			<th>DNI</th>
			<th>Materia</th>
			<th>Curso</th>
			<th>Turno</th>
			<th>Ficho?</th>
			<th>Lic?</th>
			
        </tr>
	
	<?
		
	//	if (isset($_POST['fecha']))
	//	{
			
			$fecha = $diadesc;
			//echo $fecha;
			$dian = date('N', strtotime($fecha));
			if ($_POST['seleccion']=='materias')
			{
				$sqldia="SELECT *,m.descripcion as materiadesc FROM horariox h, docente d,matcur mc,materias m,curso2 c,horax hx WHERE h.idcurso=mc.idcurso AND mc.idmateria=h.idmateria AND mc.iddocente=d.dni AND h.dia='$dian' AND mc.idmateria=m.idmateria AND c.idcurso=mc.idcurso AND c.turno=hx.turno AND hx.hora=h.hora AND d.dni!='0' ORDER BY hx.desde,d.apellido,d.nombre";
			}
			if ($_POST['seleccion']=='cargos')
			{
				$sqldia="SELECT ch.entrada as desde,ch.salida as hasta,mc.nombre as materiadesc,mc.curso as descripcion,d.apellido,d.nombre,mc.turno,d.dni FROM docentes d,cargo_horas ch,alta_baja ab,materia_cargo mc WHERE ch.iddia='$dian' AND ab.activa='1' AND ab.materia=mc.id AND ch.idcargo=mc.id AND mc.activo='1' AND d.dni=ab.docente ORDER BY desde ASC,hasta ASC,apellido ASC,nombre ASC";
			}
			
			//echo $sqldia;
			
			//echo $sqldia;
			$result = mysql_query ($sqldia);
							
				while ($fila = mysql_fetch_array($result))
				{echo "<tr>";
					echo "<td>".$fila['desde']."-".$fila['hasta']."</td>";
					echo "<td><a href=leg_unif.php?actor=$fila[dni] target=_blank>".$fila['apellido']." ".$fila['nombre']."</a></td>";
					echo "<td>".$fila['dni']."</td>";
					echo "<td>".$fila['materiadesc']."</td>";
					echo "<td>".$fila['descripcion']."</td>";
					echo "<td>".$fila['turno']."</td>";
				
					//CONSULTAMOS LAS FICHADAS.
						$sqlficha="SELECT * FROM diario WHERE dni='$fila[dni]' AND fecha='$fecha' AND horario BETWEEN SUBTIME('$fila[desde]', '00:15:00') AND ADDTIME('$fila[hasta]', '00:15:00')   ";
						//echo $sqlficha;
						$consid=mysql_connect("192.168.0.249", "fgoicoechea", "sobral2011");
						$dbsid=mysql_select_db("sid");
						$resultficha = mysql_query ($sqlficha);
						echo "<td>";
						while ($filaficha = mysql_fetch_array($resultficha))
							{
							echo $filaficha['tipo']."-".$filaficha['horario'];
							echo "<br>";
							}
						echo "</td>";
						mysql_close($consid);
				 
				 //CONSULTAMOS LAS licencias.
						$sqllic="SELECT * FROM ausentes a, motivos m WHERE a.docente='$fila[dni]' AND a.fecha_desde='$fecha' AND a.motivo=m.codigo";
						//echo $sqllic;
						$consid=mysql_connect("192.168.0.249", "fgoicoechea", "sobral2011");
						$dbsid=mysql_select_db("sid");
						$resultlic = mysql_query ($sqllic);
						echo "<td>";
						while ($filalic = mysql_fetch_array($resultlic))
							{
							echo $filalic['descrip_corta'];
							if (isset($filalic['descripcion'])) echo "<br>";
							echo $filalic['descripcion'];
							}
						echo "</td>";
						mysql_close($consid);
				 
				 
				 
				 echo "</tr>";
				}
		//}
	?>
	
	
	
	
	</TABLE>

</form>
</div> 

</body>
</br></br></br>
<?
			include 'footer.php';
			?>
</div>
</html>
