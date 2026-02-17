<?php
$dalTableusuarios = array();
$dalTableusuarios["usuario"] = array("type"=>200,"varname"=>"usuario");
$dalTableusuarios["pass"] = array("type"=>200,"varname"=>"pass");
$dalTableusuarios["valor"] = array("type"=>3,"varname"=>"valor");
$dalTableusuarios["apellido"] = array("type"=>200,"varname"=>"apellido");
$dalTableusuarios["nombre"] = array("type"=>200,"varname"=>"nombre");
$dalTableusuarios["sector"] = array("type"=>3,"varname"=>"sector");
	$dalTableusuarios["usuario"]["key"]=true;
$dal_info["usuarios"]=&$dalTableusuarios;

?>
