<?php if (!$iasisAuth) { return; } ?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
<meta charset="windows-1252" />
<title>Ver Notas (IASis)</title>
<style>
body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.wrapper { width: 980px; margin: 0 auto; }
table { border-collapse: collapse; width: 98%; }
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
if (isset($_SESSION['valor']) && (int) $_SESSION['valor'] === 4 && is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal4.php')) include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'menuppal4.php';
?>

<h2>Buscar Nota por Asunto</h2>
<form method="get" action="index.php">
    <input type="hidden" name="m" value="inasistencia" />
    <input type="hidden" name="f" value="ver_notas" />
    <input type="text" name="descripcion" size="35" maxlength="80" value="<?php echo htmlspecialchars($iasisDescripcion); ?>" autofocus="true" />
    <input type="submit" value="Buscar" name="muestra2" />
</form>

<br>

<table>
<tr>
    <th>Num. Nota</th><th>Asunto</th><th>GEN</th><th>Fecha</th><th>Responsable</th><th>Modificar</th><th>Archivo (PDF)</th>
</tr>
<?php foreach ($iasisNotas as $fila): ?>
<tr>
    <td align="center"><?php echo htmlspecialchars($fila['codigo'] . '/' . $fila['anio']); ?></td>
    <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
    <td align="center"><?php echo htmlspecialchars($fila['gen']); ?></td>
    <td align="center"><?php echo htmlspecialchars($fila['fecha']); ?></td>
    <td align="center"><?php echo htmlspecialchars($fila['agente']); ?></td>
    <td align="center"><a href="../../inasistencia/modif_nota.php?nota=<?php echo urlencode($fila['id']); ?>" target="_self">Modificar</a></td>
    <td align="center">
        <?php if (empty($fila['path'])): ?>
            <form method="post" action="../../inasistencia/upload.php" enctype="multipart/form-data">
                <input type="file" name="elarchivo" style="width: 139px;">
                <input type="hidden" name="idregistro" value="<?php echo htmlspecialchars($fila['id']); ?>">
                <input type="hidden" name="tiporegistro" value="N">
                <input type="submit" value="Subir" name="Subir">
            </form>
        <?php else: ?>
            <a href="../../inasistencia/verdoc.php?id=<?php echo urlencode($fila['id']); ?>&es=N" target="_blank">Ver adjunto</a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>
</div>
</body>
</html>


