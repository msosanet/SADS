<?php
$dalTablejustificados = array();
$dalTablejustificados["codigo"] = array("type"=>3,"varname"=>"codigo");
$dalTablejustificados["docente"] = array("type"=>200,"varname"=>"docente");
$dalTablejustificados["fecha_desde"] = array("type"=>7,"varname"=>"fecha_desde");
$dalTablejustificados["fecha_hasta"] = array("type"=>7,"varname"=>"fecha_hasta");
$dalTablejustificados["hora"] = array("type"=>200,"varname"=>"hora");
$dalTablejustificados["motivo"] = array("type"=>3,"varname"=>"motivo");
$dalTablejustificados["notifico"] = array("type"=>200,"varname"=>"notifico");
$dalTablejustificados["observaciones"] = array("type"=>200,"varname"=>"observaciones");
$dalTablejustificados["f_notif"] = array("type"=>7,"varname"=>"f_notif");
$dalTablejustificados["parte"] = array("type"=>200,"varname"=>"parte");
$dalTablejustificados["justificativo"] = array("type"=>200,"varname"=>"justificativo");
$dalTablejustificados["aviso"] = array("type"=>200,"varname"=>"aviso");
	$dalTablejustificados["codigo"]["key"]=true;
$dal_info["justificados"]=&$dalTablejustificados;

?>