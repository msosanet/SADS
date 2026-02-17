<?php
include_once(getabspath("include/docentes_settings.php"));

function DisplayMasterTableInfo_docentes($params)
{
	$detailtable=$params["detailtable"];
	$keys=$params["keys"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	
	$oldTableName=$strTableName;
	$strTableName="docentes";

//$strSQL = "SELECT  dni,  apellido,  nombre,  identificacion  FROM docentes  ";

$sqlHead="SELECT dni,  apellido,  nombre,  identificacion";
$sqlFrom="FROM docentes";
$sqlWhere="";
$sqlTail="";

$where="";

global $pageObject, $page_styles, $page_layouts, $page_layout_names, $container_styles;
$layout = new TLayout("masterprint","PurificOrange","MobileOrange");
$layout->blocks["bare"] = array();
$layout->containers["0"] = array();

$layout->containers["0"][] = array("name"=>"masterprintheader","block"=>"","substyle"=>1);


$layout->skins["0"] = "empty";
$layout->blocks["bare"][] = "0";
$layout->containers["mastergrid"] = array();

$layout->containers["mastergrid"][] = array("name"=>"masterprintfields","block"=>"","substyle"=>1);


$layout->skins["mastergrid"] = "grid";
$layout->blocks["bare"][] = "mastergrid";$page_layouts["docentes_masterprint"] = $layout;


if($detailtable=="ausentes")
{
		$where.= GetFullFieldName("dni")."=".make_db_value("dni",$keys[1-1]);
	
}
if($detailtable=="justificados")
{
		$where.= GetFullFieldName("dni")."=".make_db_value("dni",$keys[1-1]);
	
}
if(!$where)
{
	$strTableName=$oldTableName;
	return;
}
	$str = SecuritySQL("Export");
	if(strlen($str))
		$where.=" and ".$str;
	
	$strWhere=whereAdd($sqlWhere,$where);
	if(strlen($strWhere))
		$strWhere=" where ".$strWhere." ";
	$strSQL= $sqlHead.' '.$sqlFrom.$strWhere.$sqlTail;

//	$strSQL=AddWhere($strSQL,$where);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$data=db_fetch_array($rs);
	if(!$data)
	{
		$strTableName=$oldTableName;
		return;
	}
	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["dni"]));
	


//	dni - 
			$value="";
				$value = ProcessLargeText(GetData($data,"dni", ""),"field=dni".$keylink,"",MODE_PRINT);
			$xt->assign("dni_mastervalue",$value);

//	apellido - 
			$value="";
				$value = ProcessLargeText(GetData($data,"apellido", ""),"field=apellido".$keylink,"",MODE_PRINT);
			$xt->assign("apellido_mastervalue",$value);

//	nombre - 
			$value="";
				$value = ProcessLargeText(GetData($data,"nombre", ""),"field=nombre".$keylink,"",MODE_PRINT);
			$xt->assign("nombre_mastervalue",$value);

//	identificacion - 
			$value="";
				$value = ProcessLargeText(GetData($data,"identificacion", ""),"field=identificacion".$keylink,"",MODE_PRINT);
			$xt->assign("identificacion_mastervalue",$value);
	$xt->display("docentes_masterprint.htm");
	$strTableName=$oldTableName;

}

?>