<?php if (!$iasisAuth) { return; } ?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
<meta charset="windows-1252" />
<meta http-equiv="Content-Language" content="es-ar" />
<link rel="shortcut icon" href="../../imag/favicon.ico">
<title>SID - Asistencia (IASis)</title>
<style type="text/css">
body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
#customers { border-collapse: collapse; width: 70%; }
#customers th, #customers td { border: 1px solid #c0c0c0; padding: 6px; }
#customers th { background: #efefef; }
.wrapper { width: 980px; margin: 0 auto; background: #fff; }
.notice { background: #e8f5e9; border: 1px solid #81c784; padding: 8px; width: 70%; }
</style>
</head>
<?php
if (is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'header.php')) {
    include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'header.php';
}
?>
<body background="../../inasistencia/bgris.gif">
<div class="wrapper" align="center">
    <table border="0" width="980" bgcolor="#FFFFFF">
        <tr>
            <td>
                <table border="0" width="980">
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
                </table>
            </td>
        </tr>
    </table>

    <br><br><br>

    <form method="get" action="index.php">
        <input type="hidden" name="m" value="inasistencia" />
        <input type="hidden" name="f" value="asistencia" />

        <select name="curso">
            <?php foreach ($iasisCursos as $curso): ?>
                <?php $selected = ((string) $curso['idcurso'] === (string) $iasisCursoSeleccionado) ? 'selected' : ''; ?>
                <option value="<?php echo $curso['idcurso']; ?>" <?php echo $selected; ?>>
                    <?php echo htmlspecialchars($curso['descripcion']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="mostrar" value="Mostrar Alumnos" />

        <br><br>

        <?php if ($iasisMostrar): ?>
            <input type="hidden" name="fecha" value="<?php echo $iasisFechaForm; ?>" />
            Materia:
            <select name="materia">
                <option value="General" <?php echo ($iasisMateria === 'General') ? 'selected' : ''; ?>>General</option>
            </select>

            <br><br>

            <table id="customers">
                <tr>
                    <th>*</th>
                    <th>DNI</th>
                    <th>Nombre y Apellido</th>
                    <th>I</th>
                    <th>J</th>
                    <th>T</th>
                    <th>TT</th>
                    <th>AP</th>
                </tr>
                <?php foreach ($iasisAlumnos as $alumno): ?>
                    <tr>
                        <td><input type="checkbox" name="ausentes[]" value="<?php echo $alumno['dni']; ?>"></td>
                        <td><?php echo $alumno['dni']; ?></td>
                        <td><?php echo htmlspecialchars($alumno['alumno']); ?></td>
                        <td><input type="radio" name="ij[<?php echo $alumno['dni']; ?>]" checked="checked" value="1"></td>
                        <td><input type="radio" name="ij[<?php echo $alumno['dni']; ?>]" value="0"></td>
                        <td><input type="radio" name="ij[<?php echo $alumno['dni']; ?>]" value="2"></td>
                        <td><input type="radio" name="ij[<?php echo $alumno['dni']; ?>]" value="4"></td>
                        <td><input type="radio" name="ij[<?php echo $alumno['dni']; ?>]" value="3"></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <br><br>
            <input type="submit" name="enviar" value="Guardar Faltas" />
        <?php endif; ?>
    </form>

    <?php if ($iasisMensaje !== ''): ?>
        <br>
        <div class="notice"><?php echo htmlspecialchars($iasisMensaje); ?></div>
        <script>alert("<?php echo addslashes($iasisMensaje); ?>");</script>
    <?php endif; ?>
</div>
</body>
</html>

