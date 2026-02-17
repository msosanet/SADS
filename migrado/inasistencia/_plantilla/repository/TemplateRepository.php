<?php
function iasis_template_repository_fetch($filtros)
{
    // Ejemplo: mantener driver/consulta legacy y mover SQL aqui.
    // Reemplazar por tabla/consulta del flujo real.
    $rows = array();

    $fecha = $filtros['fecha'];
    $sql = "SELECT '$fecha' as fecha";
    $result = mysql_query($sql);

    if ($result) {
        while ($row = mysql_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }

    return $rows;
}
