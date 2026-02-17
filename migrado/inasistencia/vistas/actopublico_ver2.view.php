<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado Acto Público</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            padding: 30px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        table {
            font-size: 14px;
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .grupo-0 { background-color: #ffffff; }
        .grupo-1 { background-color: #f0f8ff; }
        .grupo-2 { background-color: #e6f7ff; }
        .grupo-3 { background-color: #fef9e7; }
        .grupo-4 { background-color: #e8f5e9; }
        .separador {
            background-color: #dfe6e9;
            font-weight: bold;
            text-align: left;
            color: #2d3436;
        }
        tr:hover {
            background-color: #d6eaf8 !important;
        }
        .paginador {
            text-align: center;
            margin-top: 20px;
        }
        .paginador a {
            margin: 0 5px;
            padding: 6px 12px;
            text-decoration: none;
            border: 1px solid #ccc;
            color: #3498db;
            background-color: #fff;
        }
        .paginador a.activa {
            font-weight: bold;
            background-color: #3498db;
            color: white;
            border-color: #2980b9;
        }
    </style>
</head>
<body>
<?php
include 'header.php';
include 'menuppal3.php';
  ?>

<h2>Resultado Acto Público</h2>

<table>
    <thead>
        <tr>
            <th>Número</th>
            <th>Materia</th>
            <th>Turno</th>
            <th>Curso y División</th>
            <th>Estado</th>
            <th>Alta</th>
            <th>DNI</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Teléfono</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM actopublico ORDER BY CAST(numero AS UNSIGNED) DESC, id LIMIT $inicio, $por_pagina";
        $res = mysql_query($sql);

        if (!$res) {
            echo "<tr><td colspan='10' style='color:red; font-weight:bold;'>? Error en la consulta: " . mysql_error() . "</td></tr>";
        } elseif (mysql_num_rows($res) == 0) {
            echo "<tr><td colspan='10'>No hay datos disponibles.</td></tr>";
        } else {
            $grupo_actual = "";
            $contador_grupo = 0;
            while ($row = mysql_fetch_assoc($res)) {
                if ($row['numero'] != $grupo_actual) {
                    $grupo_actual = $row['numero'];
                    $contador_grupo++;
                    echo "<tr class='separador'><td colspan='10'>Grupo: {$grupo_actual}</td></tr>";
                }

                $clase = "grupo-" . ($contador_grupo % 5);
                $fecha = ($row['alta'] == '0000-00-00') ? '' : date('d/m/Y', strtotime($row['alta']));

                echo "<tr class='$clase'>";
                echo "<td>{$row['numero']}</td>";
                echo "<td>{$row['materia']}</td>";
                echo "<td>{$row['turno']}</td>";
                echo "<td>{$row['curydiv']}</td>";
                echo "<td>{$row['estado']}</td>";
                echo "<td>$fecha</td>";
                echo "<td>{$row['dni']}</td>";
                echo "<td>{$row['apellido']}</td>";
                echo "<td>{$row['nombre']}</td>";
                echo "<td>{$row['tel']}</td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>

<div class="paginador">
    <?php
    for ($i = 1; $i <= $total_paginas; $i++) {
        $clase = ($i == $pagina) ? "activa" : "";
        echo "<a href='?pagina=$i' class='$clase'>$i</a>";
    }
    ?>
</div>

</body>
</html>

