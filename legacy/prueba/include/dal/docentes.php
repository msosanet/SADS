<?php
$dalTabledocentes = array();
$dalTabledocentes["dni"] = array("type"=>200,"varname"=>"dni");
$dalTabledocentes["apellido"] = array("type"=>200,"varname"=>"apellido");
$dalTabledocentes["nombre"] = array("type"=>200,"varname"=>"nombre");
$dalTabledocentes["direccion"] = array("type"=>200,"varname"=>"direccion");
$dalTabledocentes["telefono"] = array("type"=>200,"varname"=>"telefono");
$dalTabledocentes["identificacion"] = array("type"=>3,"varname"=>"identificacion");
$dalTabledocentes["numero"] = array("type"=>3,"varname"=>"numero");
$dalTabledocentes["sexo"] = array("type"=>200,"varname"=>"sexo");
$dalTabledocentes["piso"] = array("type"=>200,"varname"=>"piso");
$dalTabledocentes["depto"] = array("type"=>200,"varname"=>"depto");
$dalTabledocentes["barrio"] = array("type"=>200,"varname"=>"barrio");
$dalTabledocentes["celular"] = array("type"=>200,"varname"=>"celular");
$dalTabledocentes["mail"] = array("type"=>200,"varname"=>"mail");
	$dalTabledocentes["dni"]["key"]=true;
$dal_info["docentes"]=&$dalTabledocentes;

?>