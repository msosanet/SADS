<?php if (!$iasisAuth) { return; } ?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
<meta charset="windows-1252" />
<title>Ver Todas las Notas (IASis)</title>
<style>
body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.wrapper { width: 980px; margin: 0 auto; }
table { border-collapse: collapse; width: 95%; }
th, td { border: 1px solid #c0c0c0; padding: 6px; }
th { background: #808080; color: #fff; }
</style>
</head>
<?php if (is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'header.php')) include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'header.php'; ?>
<body background="../../inasistencia/bgris.gif">
<div class="wrapper" align="center">
<?php
if (isset($_SESSION['valor']) && (int) $_SESSION['valor'] === 1 && is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal2.php')) include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal2.php';
if (isset($_SESSION['valor']) && (int) $_SESSION['valor'] === 0 && is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal.php')) include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal.php';
if (isset($_SESSION['valor']) && (int) $_SESSION['valor'] === 3 && is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal3.php')) include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal3.php';
?>

<h2>Buscar Nota por Asunto</h2>
<form method="get" action="index.php">
    <input type="hidden" name="m" value="inasistencia" />
    <input type="hidden" name="f" value="ver_notastodas" />
    <input type="text" name="descripcion" size="35" maxlength="80" value="<?php echo htmlspecialchars($iasisDescripcion); ?>" />
    <input type="submit" value="Buscar" name="muestra2" />
</form>

<?php if ($iasisBuscar): ?>
<br>
<table>
<tr>
    <th>Num. Nota</th><th>A&ntilde;o</th><th>Asunto</th><th>Responsable</th>
</tr>
<?php foreach ($iasisNotas as $fila): ?>
<tr>
    <td align="center"><?php echo htmlspecialchars($fila['codigo']); ?></td>
    <td align="center"><?php echo htmlspecialchars($fila['anio']); ?></td>
    <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
    <td align="center"><?php echo htmlspecialchars($fila['agente']); ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
</div>
</body>
</html>

