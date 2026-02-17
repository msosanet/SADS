<?php
function iasis_template_controller_handle($request)
{
    $response = array(
        'status' => 200,
        'data' => array(),
        'errors' => array(),
    );

    $serviceOutput = iasis_template_service_execute($request);
    $response['data'] = $serviceOutput;

    return $response;
}
