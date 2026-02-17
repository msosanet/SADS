<?php
$conexion = mysql_connect("localhost", "root", "msi2010");
mysql_select_db("sid", $conexion);

$busqueda = $_GET['busqueda'];
$activos = isset($_GET['activos']) ? $_GET['activos'] : '0';  // Por defecto será 0 si no está definido

//echo "valor activo".$activos;

	if ($activos == 0) {
		$sql = "SELECT * FROM materia_cargo mc WHERE activo='1'";
		$sql2="AND ab.activa='1'";
	} else {
			$sql = "SELECT * FROM materia_cargo mc WHERE id!='0'  ";
			$sql2 = "";
	}

	// Filtrar por ID o nombre según lo ingresado
	if (isset($_GET['busqueda']))
		{
				if (is_numeric($busqueda)) {
				$sql .= "AND (mc.plaza LIKE '$busqueda%' OR mc.sige LIKE '$busqueda%')";
			} else {
				$sql .= "AND mc.nombre LIKE '%$busqueda%'";
			}
		}

		$sql .= " ORDER BY (mc.codigo = 852),mc.codigo, mc.curso ASC, mc.division ASC,mc.nombre ASC";
		//$sql.=" ORDER BY mc.curso ASC,mc.division ASC";
		//$sql.=" ORDER BY mc.id ASC,mc.curso ASC,mc.division ASC";


//$sql .= "ORDER BY mc.curso ASC, mc.division ASC, mc.$orden";
//echo "consulta".$sql;
//echo $sql;
$result = mysql_query($sql);

// Renderizar la tabla
echo '<table border="1" width="980" bgcolor="#FFFFFF">';
echo '<tr>
        <td align="center">N&deg;</td>
        <td align="center">Plaza</td>
        <td align="center">Turno</td>
        <td align="center">Curso</td>
        <td align="center">Division</td>
        <td align="center">Codigo</td>
        <td align="center">Q hs</td>
        <td align="center">Cubierto</td>
      </tr>';

//echo $sql2;


while ($row = mysql_fetch_assoc($result)) {
    // CHEQUEAMOS SI LA PLAZA ESTÁ OCUPADA
    $sqlM = "SELECT * FROM alta_baja ab WHERE materia='$row[id]' ".$sql2;
	//echo $sqlM;
   $resultM = mysql_query($sqlM);
    $libre = "";
    $q = mysql_num_rows($resultM);
    $doc = "";
    $enlace = "";
    $color = "style='background-color: red;'";  // Default color for "SIN CUBRIR"

    if ($q > 0) {
        if (!isset($_GET['sincubrir'])) {
            $sqlDOCR = "SELECT * FROM alta_baja ab, docentes d WHERE ab.materia='$row[id]' AND ab.docente=d.dni ".$sql2;
           // echo $sqlDOCR;
			$resultDOC = mysql_query($sqlDOCR);
            $docenteresp = mysql_fetch_assoc($resultDOC);
            $libre = $docenteresp['apellido'] . ", " . $docenteresp['nombre'];
            $enlace = 1;
            $dnidoc = $docenteresp['dni'];

            // Cambiar el color según la situación de revista
            if ($docenteresp['sit_revista'] == 1) $color = "style='background-color: green;'";
            if ($docenteresp['sit_revista'] == 2) $color = "style='background-color: blue;'";
            if ($docenteresp['sit_revista'] == 3) $color = "style='background-color: yellow;'";
            if ($docenteresp['sit_revista'] == 4) $color = "style='background-color: orange;'";
            if ($docenteresp['sit_revista'] == 10) $color = "style='background-color: grey;'";
        }
    } else {
        $libre = "SIN CUBRIR";
    }

    // Mostrar los resultados en la tabla
    echo "<tr>";
    echo "<td align='center'><a href='vermovplaza.php?id={$row['id']}' target='_blank'>{$row['plaza']}</a></td>";
    echo "<td align='center'><a href='vermovplaza.php?id={$row['id']}' target='_blank'>{$row['nombre']}</a></td>";
    echo "<td align='center'>{$row['turno']}</td>";
    echo "<td align='center'>{$row['curso']}</td>";
    echo "<td align='center'>{$row['division']}</td>";
    echo "<td align='center'>{$row['codigo']}</td>";
    echo "<td align='center'>{$row['cant_hs']}</td>";

    // Mostrar el estado de cubierto o no
    if ($enlace == 1) {
        echo "<td align='center' $color><a href='leg_unif.php?actor=$dnidoc' target='_blank'>{$libre}</a></td>";
    } else {
        echo "<td align='center' $color>{$libre}</td>";
    }

    echo "</tr>";
}

echo '</table>';

mysql_close($conexion);
?>
