<?PHP

session_start();
include "funciones.php";
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
if (loginvalido($usuario,$pass,$pagina)=="OK")
{		

include 'conexion3.php';
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
$conexion = conectarsobral ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];

?>

<body background="bgris.gif" >




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


			</table>
			</div>
			

<form method="POST" action="topalumnos.php">
	<?// Consultar los cursos habilitados
	$query = "SELECT idcurso, descripcion FROM curso2 WHERE habilitado = 1 ORDER BY idcurso ASC";
	$resultado = mysql_query($query);
	echo "<div align='center'>";
	// Verificar si hay resultados
	if (!$resultado) {
		die('Consulta fallida: ' . mysql_error());
	}
	?>
		<table border="1" style="border-collapse: collapse;">
            <tr>
                <td><label for="curso">Curso:</label></td>
                <td>
                    <select name="curso" id="curso" onchange="recargarFormulario()">
                        <?php
                        // Cargar los cursos en el select
                        while ($fila = mysql_fetch_assoc($resultado)) {
                            
							if ($_GET["curso"]==$fila['idcurso'])
							echo "<option value='" . $fila['idcurso'] . "' selected>" . $fila['descripcion'] . "</option>";
							else
							echo "<option value='" . $fila['idcurso'] . "'>" . $fila['descripcion'] . "</option>";	
						}
                        ?>
                    </select>
                </td>
            </tr>
        </table>

		<script>
			// Función para recargar el formulario al seleccionar un curso
			function recargarFormulario() {
				var cursoSeleccionado = document.getElementById('curso').value;
				if (cursoSeleccionado) {
					// Redirigir a topalumnos.php con el parámetro curso
					window.location.href = 'topalumnos.php?curso=' + cursoSeleccionado;
				}
			}
		</script>




</form>

 

</body>

</html>
 <?

if (!isset($_GET["curso"])) 
{$cursoSeleccionado='11';}
else
	{$cursoSeleccionado = $_GET['curso'];}
$ano=date("Y");
include "conexion55.php";

 //$cursoSeleccionado = $_GET['curso'];

    // Verificar si es de 2 o 3 dígitos
    if (strlen($cursoSeleccionado) == 2) {
        // Si tiene 2 dígitos: el primero es curso, el segundo es división
        $curso = substr($cursoSeleccionado, 0, 1); // Primer dígito
        $division = substr($cursoSeleccionado, 1, 1); // Segundo dígito
    } elseif (strlen($cursoSeleccionado) == 3) {
        // Si tiene 3 dígitos: el primero es curso, los dos últimos son la división
        $curso = substr($cursoSeleccionado, 0, 1); // Primer dígito
        $division = substr($cursoSeleccionado, 1, 2); // Últimos dos dígitos
    } else {
        // Manejar el caso de error si no tiene 2 o 3 dígitos
        echo "Error: formato de curso no válido";
        exit;
    }



$conexion5 = conectaralumnos ();
$alumnosQ="SELECT CONCAT(a.apellido,  ' ', a.nombre) as alumno,a.dni FROM alumno a, cursa c WHERE c.alumno=a.dni AND c.curso='$curso' AND c.divi='$division' AND c.anio='$ano' AND c.control='1' ORDER BY alumno ASC";
//echo $alumnosQ;
$alumnos = mysql_query($alumnosQ) or die(mysql_error());
$conexion = conectarsobral ();
$injusQ="SELECT * FROM injus ORDER BY id ASC";
$injus = mysql_query($injusQ) or die(mysql_error());
	echo "<br><br>";
	echo "<div align='center'>";
	echo "<table border='1' style='border-collapse: collapse;'>";
	
	echo "<tr>";
		echo "<td align='center'>Alumno</td>";
		$valores = array();
		while($rowI = mysql_fetch_assoc($injus)) 
		{
		echo "<th align='center'>".$rowI['letra']."</th>";
		$valores[] = $rowI['id'];
		//echo "ID actual: " . $rowI['id'] . "<br>";
		}
		
	echo "</tr>";
	
	///print_r($valores);
	
	$j=0;
	while($row = mysql_fetch_assoc($alumnos)) 
	{
	echo "<tr>";
	echo "<td align='left'><a href='alumnostarde.php?dni=".$row[dni]."' target='_self'>".$row[alumno]."</a></td>";
	
	
		
	$i=0;
	foreach ($valores as $i) 
	{///echo $i;
		$consultaA="SELECT COUNT(dni) as total FROM `alumnos_faltas` WHERE YEAR(fecha)=YEAR(CURDATE()) AND dni='$row[dni]' AND injus='$i' ";
		//echo $consultaA."<br>";
		$ausentes = mysql_query($consultaA) or die(mysql_error());
		
			while($row2 = mysql_fetch_assoc($ausentes))
			{echo "<td align='center' title='".detallefaltas($row[dni],$i)."'>".$row2['total']."</td>";}
	}
	
	
	echo "</tr>";
	}

	echo "</table>";

echo "</div>";
echo "<br>";

//if submit


//var_dump($valores);

			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>












 <?
}
?>