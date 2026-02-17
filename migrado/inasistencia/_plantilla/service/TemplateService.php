<?php
function iasis_template_service_execute($request)
{
    $filtros = array(
        'fecha' => isset($request['fecha']) ? $request['fecha'] : date('Y-m-d'),
    );

    $rows = iasis_template_repository_fetch($filtros);

    return array(
        'filtros' => $filtros,
        'rows' => $rows,
    );
}
