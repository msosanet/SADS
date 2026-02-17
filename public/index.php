<?php
require_once dirname(__DIR__) . '/app/bootstrap.php';

$module = isset($_GET['m']) ? preg_replace('/[^a-zA-Z0-9_\-]/', '', $_GET['m']) : '';
$file = isset($_GET['f']) ? str_replace('..', '', $_GET['f']) : '';

if ($module === '' || $file === '') {
    echo "<h2>IASis - Pilotos Disponibles</h2>";
    echo "<ul>";
    echo "<li><a href='?m=inasistencia&f=asistencia'>inasistencia/asistencia</a></li>";
    echo "<li><a href='?m=inasistencia&f=alumnosausentes'>inasistencia/alumnosausentes</a></li>";
    echo "<li><a href='?m=inasistencia&f=boletin'>inasistencia/boletin</a></li>";
    echo "<li><a href='?m=inasistencia&f=notificaciones'>inasistencia/notificaciones</a></li>";
    echo "<li><a href='?m=inasistencia&f=ver_notificaciones'>inasistencia/ver_notificaciones</a></li>";
    echo "<li><a href='?m=inasistencia&f=notificacionausente'>inasistencia/notificacionausente</a></li>";
    echo "<li><a href='?m=inasistencia&f=notificacionausente&dnix=123&fechaxxx=2026-02-16&materiax=Matematica&cursox=1A&turnox=M&tipox=A&vistax=N'>inasistencia/notificacionausente (ejemplo)</a></li>";
    echo "<li><a href='?m=inasistencia&f=asistenciaef'>inasistencia/asistenciaef</a></li>";
    echo "<li><a href='?m=inasistencia&f=ver_notas'>inasistencia/ver_notas</a></li>";
    echo "<li><a href='?m=inasistencia&f=ver_notastodas'>inasistencia/ver_notastodas</a></li>";
    echo "</ul>";
    echo "<p>Uso manual: <code>index.php?m=&lt;modulo&gt;&f=&lt;ruta/sin_extension&gt;</code></p>";
    exit;
}

$logicFile = IASIS_MIGRADO_ROOT . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'logica' . DIRECTORY_SEPARATOR . $file . '.logic.php';
$viewFile = IASIS_MIGRADO_ROOT . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'vistas' . DIRECTORY_SEPARATOR . $file . '.view.php';

if (!is_file($logicFile) || !is_file($viewFile)) {
    http_response_code(404);
    echo "No existe el par logica/vista solicitado.";
    exit;
}

require $logicFile;
require $viewFile;
