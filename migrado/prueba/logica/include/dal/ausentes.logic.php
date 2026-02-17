<?php
$dalTableausentes = array();
$dalTableausentes["codigo"] = array("type"=>3,"varname"=>"codigo");
$dalTableausentes["docente"] = array("type"=>200,"varname"=>"docente");
$dalTableausentes["fecha_desde"] = array("type"=>7,"varname"=>"fecha_desde");
$dalTableausentes["fecha_hasta"] = array("type"=>7,"varname"=>"fecha_hasta");
$dalTableausentes["hora"] = array("type"=>200,"varname"=>"hora");
$dalTableausentes["motivo"] = array("type"=>3,"varname"=>"motivo");
$dalTableausentes["notifico"] = array("type"=>200,"varname"=>"notifico");
$dalTableausentes["observaciones"] = array("type"=>200,"varname"=>"observaciones");
$dalTableausentes["f_notif"] = array("type"=>7,"varname"=>"f_notif");
	$dalTableausentes["codigo"]["key"]=true;
$dal_info["ausentes"]=&$dalTableausentes;

?>
