<?php if (!$iasisAuth) { return; } ?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
<meta charset="windows-1252" />
<meta http-equiv="Content-Language" content="es-ar" />
<link rel="shortcut icon" href="../../imag/favicon.ico">
<title>SID - Alumnos Ausentes (IASis)</title>
<style type="text/css">
body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
#tabla-ausentes { border-collapse: collapse; width: 90%; }
#tabla-ausentes th, #tabla-ausentes td { border: 1px solid #c0c0c0; padding: 6px; }
#tabla-ausentes th { background: #efefef; }
.wrapper { width: 980px; margin: 0 auto; background: #fff; }
</style>
</head>
<?php
if (is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'header.php')) {
    include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'header.php';
}
?>
<body background="../../inasistencia/bgris.gif">
<div class="wrapper" align="center">
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

    <h3>Alumnos ausentes del dia <?php echo htmlspecialchars($iasisFecha); ?></h3>

    <table id="tabla-ausentes">
        <tr>
            <th>DNI</th>
            <th>Nombre y Apellido</th>
            <th>Curso</th>
            <th>Division</th>
            <th>Materia</th>
        </tr>
        <?php foreach ($iasisAusentes as $row): ?>
            <tr>
                <td align="center"><?php echo htmlspecialchars($row['dni']); ?></td>
                <td><?php echo htmlspecialchars($row['alumno']); ?></td>
                <td align="center"><?php echo htmlspecialchars($row['curso']); ?></td>
                <td align="center"><?php echo htmlspecialchars($row['division']); ?></td>
                <td align="center"><?php echo htmlspecialchars($row['tipo']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>

