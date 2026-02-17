<?php if (!$iasisAuth) { return; } ?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
<meta charset="windows-1252" />
<title>Notificaciones (IASis)</title>
<style>
body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.wrapper { width: 980px; margin: 0 auto; }
.formbox { width: 70%; border: 1px solid #c0c0c0; padding: 12px; background: #f9f9f9; }
.error { color: #b00020; }
.ok { background: #e8f5e9; border: 1px solid #66bb6a; padding: 8px; }
textarea { width: 100%; }
</style>
</head>
<?php
if (is_file($iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'header.php')) {
    include $iasisLegacyModuleDir . DIRECTORY_SEPARATOR . 'header.php';
}
?>
<body>
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

    <h2>Notificaciones</h2>

    <?php if (!empty($iasisErrores)): ?>
        <div class="error">
            <?php foreach ($iasisErrores as $err): ?>
                <p><?php echo htmlspecialchars($err); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($iasisGuardado): ?>
        <div class="ok">
            Notificacion N&deg; <?php echo htmlspecialchars($iasisNotificacionNumero); ?> / <?php echo htmlspecialchars($iasisNotificacionAnio); ?> guardada.
            <br>
            <a href="index.php?m=inasistencia&f=ver_notificaciones&descripcion=<?php echo urlencode($iasisAsunto); ?>">Ir al listado filtrado</a>
        </div>
        <br>
    <?php endif; ?>

    <form method="post" action="index.php?m=inasistencia&f=notificaciones" class="formbox">
        <label>Descripcion de la notificacion:</label>
        <br><br>
        <textarea name="asunto" rows="3" maxlength="200"><?php echo htmlspecialchars($iasisAsunto); ?></textarea>
        <br><br>
        <div>A&ntilde;o: <?php echo htmlspecialchars($iasisAnio); ?></div>
        <br>
        <input type="submit" name="submitx" value="Guardar" />
    </form>
</div>
</body>
</html>
