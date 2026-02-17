<?php if (!$iasisAuth) { return; } ?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
<meta charset="windows-1252" />
<meta http-equiv="Content-Language" content="es-ar" />
<title>Inasistencias del mes (IASis)</title>
<style type="text/css">
body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
#customers { border-collapse: collapse; width: 98%; }
#customers th, #customers td { border: 1px solid #c0c0c0; padding: 4px; }
#customers th { background: #efefef; font-size: 11px; }
.wrapper { width: 980px; margin: 0 auto; }
</style>
</head>
<?php
if (is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'header.php')) {
    include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'header.php';
}
?>
<body>
<div class="wrapper">
    <?php
    if (isset($_SESSION['valor']) && (int) $_SESSION['valor'] === 1 && is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal2.php')) {
        include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal2.php';
    }
    if (isset($_SESSION['valor']) && (int) $_SESSION['valor'] === 0 && is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal.php')) {
        include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal.php';
    }
    if (isset($_SESSION['valor']) && (int) $_SESSION['valor'] === 3 && is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal3.php')) {
        include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal3.php';
    }
    ?>

    <br><br>

    <form method="get" action="index.php">
        <input type="hidden" name="m" value="inasistencia" />
        <input type="hidden" name="f" value="boletin" />

        Curso:
        <select name="curso">
            <?php foreach ($iasisCursos as $curso): ?>
                <?php $selected = ((string) $curso['idcurso'] === (string) $iasisCursoSeleccionado) ? 'selected' : ''; ?>
                <option value="<?php echo $curso['idcurso']; ?>" <?php echo $selected; ?>>
                    <?php echo htmlspecialchars($curso['descripcion']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        &nbsp;&nbsp;Seleccione Mes:
        <select name="mes">
            <?php foreach ($iasisMeses as $mesNum => $mesNombre): ?>
                <?php $selectedMes = ((int) $iasisMesSeleccionado === (int) $mesNum) ? 'selected' : ''; ?>
                <option value="<?php echo $mesNum; ?>" <?php echo $selectedMes; ?>>
                    <?php echo htmlspecialchars($mesNombre); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="mostrar" value="Ver Planilla Asistencia" />
    </form>

    <?php if ($iasisMostrar): ?>
        <br><br>
        <h2><?php echo htmlspecialchars($iasisTitulo); ?></h2>
        <h3><?php echo htmlspecialchars($iasisSubtitulo); ?></h3>

        <table id="customers">
            <tr>
                <th width="25%">Alumno</th>
                <?php foreach ($iasisDiasHeaders as $header): ?>
                    <th><?php echo htmlspecialchars($header); ?></th>
                <?php endforeach; ?>
                <th>Total A. Justificadas</th>
                <th>Total A. Injustificadas</th>
                <th>Total Ausencias (I+J+T)</th>
                <th>Total Presentes</th>
                <th>%</th>
            </tr>

            <?php foreach ($iasisPlanilla as $fila): ?>
                <tr>
                    <td>
                        <a href="../../inasistencia/ver_alu.php?actor=<?php echo urlencode($fila['dni']); ?>" target="_blank">
                            <?php echo htmlspecialchars($fila['alumno']); ?>
                        </a>
                    </td>

                    <?php foreach ($fila['celdas'] as $celda): ?>
                        <td align="center" bgcolor="<?php echo htmlspecialchars($celda['bg']); ?>">
                            <?php if ($celda['link'] !== ''): ?>
                                <a href="../../inasistencia/<?php echo htmlspecialchars($celda['link']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($celda['codigo']); ?>
                                </a>
                            <?php else: ?>
                                <?php echo htmlspecialchars($celda['codigo']); ?>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>

                    <td align="center"><?php echo htmlspecialchars((string) $fila['justificadas']); ?></td>
                    <td align="center"><?php echo htmlspecialchars((string) $fila['injustificadas']); ?></td>
                    <td align="center"><?php echo htmlspecialchars((string) $fila['totalausentes']); ?></td>
                    <td align="center"><?php echo htmlspecialchars((string) $fila['presentes']); ?></td>
                    <td align="center" bgcolor="<?php echo htmlspecialchars($fila['color_porcentaje']); ?>">
                        <?php echo htmlspecialchars((string) $fila['porcentaje']); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>

