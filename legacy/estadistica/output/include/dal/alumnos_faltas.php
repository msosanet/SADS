<?php
$dalTablealumnos_faltas = array();
$dalTablealumnos_faltas["dni"] = array("type"=>200,"varname"=>"dni");
$dalTablealumnos_faltas["fecha"] = array("type"=>7,"varname"=>"fecha");
$dalTablealumnos_faltas["tipo"] = array("type"=>200,"varname"=>"tipo");
$dalTablealumnos_faltas["injus"] = array("type"=>3,"varname"=>"injus");
	$dalTablealumnos_faltas["dni"]["key"]=true;
	$dalTablealumnos_faltas["fecha"]["key"]=true;
	$dalTablealumnos_faltas["tipo"]["key"]=true;
$dal_info["alumnos_faltas"]=&$dalTablealumnos_faltas;

?>