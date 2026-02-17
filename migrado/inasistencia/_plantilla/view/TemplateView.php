<?php
function iasis_template_view_render($data)
{
    ?>
    <h3>Vista plantilla IASis</h3>
    <p>Fecha: <?php echo htmlspecialchars($data['filtros']['fecha']); ?></p>
    <pre><?php echo htmlspecialchars(print_r($data['rows'], true)); ?></pre>
    <?php
}
