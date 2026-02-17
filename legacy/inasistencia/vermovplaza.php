<?PHP

session_start();

include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
if (!mysql_num_rows($resultt)) {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
}

//include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Administrador del SID</title>


        <style>
        .elegant-table {
            border-collapse: collapse;
            width: 100%;
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


    </style>



</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];

if (isset($_GET['borrar'])&&($usuario='lrosales' OR $usuario='etardioli'))
{

//$copiaplaza="INSERT INTO materia_cargo_borradas SELECT * FROM materia_cargo WHERE id = '$_GET[borrar]'";
$copiaplaza = "INSERT INTO materia_cargo_borradas (id,nombre, curso, division, plaza, turno, legal, codigo, activo, cant_hs, orientacion, respedago) SELECT id,nombre, curso, division, plaza, turno, legal, codigo, activo, cant_hs, orientacion, respedago FROM materia_cargo WHERE id = '$_GET[borrar]'";


	if (mysql_query($copiaplaza))
	{
	$borraplaza="DELETE FROM materia_cargo WHERE id='$_GET[borrar]'";
	//echo $borraplaza;
	mysql_query($borraplaza);
	}
}




?>

<body>


<form method="GET" action="<?=$_SERVER['PHP_SELF']?>">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>

			<div align="center">
			<table border="0" width="980">

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';


$matcar="SELECT * FROM materia_cargo mc WHERE mc.id='$_GET[id]'";
//echo $matcar;
$mc = mysql_query ($matcar);
$filamc = mysql_fetch_array($mc);


//https://inasistencias.colegiosobral.edu.ar/modif_mov.php?id=1132

?>


			</table>
			</div>
<br><br>
<div align="center">
<h2>Movimientos de la Plaza</h2>
<table class="elegant-table">
    <tr>
        <td><strong>Puesto (N&deg; Plaza): </strong> <?=$filamc[plaza]." (".$filamc[sige].")";?></strong></td>
        <td><strong>Descripcion: </strong><?	echo " ".$filamc[nombre];?></td>
		<td><strong>Curso: </strong><?	echo " ".$filamc[curso];?></td>
        <td><strong>Div: </strong><?	echo " ".$filamc[division];?></td>
        <td><strong>Turno: </strong><?	echo " ".$filamc[turno];?></td>
        <td><strong>Codigo: </strong><?	echo " ".$filamc[codigo];?></td>
        <td><strong>Cant. HS: </strong><?	echo " ".$filamc[cant_hs];?></td>
		<td><a href=modif_materias.php?actor=<? echo $filamc[id];?> target="_blank"><img src="images/editar.png"></img></a></td>
		<?if ($usuario=='lrosales' OR $usuario='etardioli')?>
		<td><a href=vermovplaza.php?borrar=<? echo $filamc[id];?> target="_blank" onclick="return confirm('¿Leo, estas seguro que queres borrar la plaza?');"><img src="borrar.png" width="32" height="32"></img></a></td>
		<??>
	 </tr>





<table class="elegant-table">
    <tr>
        <th>Docente</th>
        <th>Sit. Revista</th>
		<th>F. Desde</th>
        <th>F. Hasta</th>
        <th>Obs.</th>
		<th>Enviado</th>
        <th>Activa</th>
        <th>Resp.</th>
		<th>Editar</th>


    </tr>

<?
		//$mat="SELECT * FROM alta_baja ab, docentes d, caracter c WHERE ab.materia='$_GET[id]' AND d.dni=ab.docente AND ab.sit_revista=c.codigo ORDER BY ab.fhasta, ab.fdesde DESC";
		//$mat="SELECT * FROM alta_baja ab JOIN docentes d ON d.dni = ab.docente JOIN caracter c ON ab.sit_revista = c.codigo WHERE ab.materia = '$_GET[id]' ORDER BY  CASE WHEN ab.fhasta IS NULL THEN 0 ELSE 1 END, ab.fdesde DESC";
		//$mat="SELECT * FROM alta_baja ab, docentes d, caracter c WHERE ab.materia='$_GET[id]'   AND d.dni=ab.docente   AND ab.sit_revista=c.codigo ORDER BY   CASE WHEN ab.fhasta IS NULL THEN 1 ELSE 0 END DESC,   ab.fdesde DESC";
			$mat="SELECT * FROM alta_baja ab, docentes d, caracter c WHERE ab.materia='$_GET[id]' AND d.dni=ab.docente AND ab.sit_revista=c.codigo ORDER BY CASE WHEN ab.fhasta = '0000-00-00' OR ab.fhasta IS NULL THEN 1 ELSE 0 END DESC, ab.fdesde DESC";

		//echo $mat;
		$result79 = mysql_query ($mat);

			while ($fila79 = mysql_fetch_array($result79))
			{
			$enviado="NO";
			$activa="NO";
			$colorplaza="FFFFFF";
			$hasta=date("d-m-Y", strtotime($fila79[fhasta]));
			if ($fila79[enviado]==1) $enviado="SI";
			if ($fila79[activa]==1)
			{$activa="SI";}
			//echo "Hasta:".$fila79[fhasta];
			if ($fila79[fhasta]!='0000-00-00') $colorplaza="#fdbcaf";


			if ($fila79[fhasta]=="0000-00-00") $hasta="";
			echo "<tr bgcolor=".$colorplaza.">";
			echo "<td align='center' ><a href=leg_unif.php?actor=$fila79[dni] target='_blank'>".$fila79[apellido].",".$fila79[nombre]."</a></td>";
			echo "<td align='center'>".$fila79[descripcion]."</td>";
			echo "<td align='center'>".date("d-m-Y", strtotime($fila79[fdesde]))."</td>";
			echo "<td align='center'>".$hasta."</td>";
			echo "<td align='center'>".$fila79[obs]."</td>";
			echo "<td align='center'>".$enviado."</td>";
			echo "<td align='center'>".$activa."</td>";
			echo "<td align='center'>".$fila79[graba]."</td>";
			echo "<td bgcolor='#FFFFFF' align='center'><a href=modif_mov.php?id=$fila79[id] title='Hacer click para modificar movimiento'><img src='images/editar.png'></img></a> </td>";
			echo "</tr>";
			}

?>







    <!-- Puedes agregar más filas de datos aquí -->
</table>
<?




$sql = "SELECT CASE WHEN h.dia = 1 THEN 'Lunes' WHEN h.dia = 2 THEN 'Martes' WHEN h.dia = 3 THEN 'Miércoles' WHEN h.dia = 4 THEN 'Jueves' WHEN h.dia = 5 THEN 'Viernes' ELSE 'Desconocido' END AS dia_nombre, h2.desde, h2.hasta FROM horariox2 h JOIN horax2 h2 ON h.hora = h2.hora JOIN curso3 c ON h.idcurso = c.idcurso AND c.turno=h2.turno WHERE h.idmateria = '$_GET[id]'";

// Ejecutar la consulta
$resultt = mysql_query($sql);

$elegidox = mysql_num_rows($resultt);
		if ($elegidox>0)
		{
			echo "<br>";
			echo "<h2>Horario Cargado para esta plaza</h2>";
			echo "<br>";

// Comenzamos a construir la tabla HTML
echo "<table class='elegant-table' style='width: 50%;'>
        <tr>
            <th>Dia</th>
            <th>Desde</th>
            <th>Hasta</th>
        </tr>";

// Mostrar los resultados en la tabla
while ($row = mysql_fetch_assoc($resultt)) {
    echo "<tr>";
    echo "<td>" . $row['dia_nombre'] . "</td>";
    echo "<td>" . $row['desde'] . "</td>";
    echo "<td>" . $row['hasta'] . "</td>";
    echo "</tr>";
}

// Cerrar la tabla
echo "</table>";


}






?>



</div>
	<br><br>


























			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>



</form>


</body>

</html>
