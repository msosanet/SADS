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
$mKeys = array();
$showKeys = "";

global $page_styles, $page_layouts, $page_layout_names, $container_styles;

$layout = new TLayout("masterlist","PurificOrange","MobileOrange");
$layout->blocks["bare"] = array();
$layout->containers["0"] = array();

$layout->containers["0"][] = array("name"=>"masterlistheader","block"=>"","substyle"=>1);


$layout->skins["0"] = "empty";
$layout->blocks["bare"][] = "0";
$layout->containers["mastergrid"] = array();

$layout->containers["mastergrid"][] = array("name"=>"masterlistfields","block"=>"","substyle"=>1);


$layout->skins["mastergrid"] = "grid";
$layout->blocks["bare"][] = "mastergrid";$page_layouts["docentes_masterlist"] = $layout;


if($detailtable=="ausentes")
{
		$where.= GetFullFieldName("dni")."=".make_db_value("dni",$keys[1-1]);
	$showKeys .= " "."Dni".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
if($detailtable=="justificados")
{
		$where.= GetFullFieldName("dni")."=".make_db_value("dni",$keys[1-1]);
	$showKeys .= " "."Dni".": ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
	
}
	if(!$where)
	{
		$strTableName=$oldTableName;
		return;
	}
	$str = SecuritySQL("Search");
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
				if (IsNumberType(GetFieldType("dni")))
				$value = "<span class='runner-field-number'>".ProcessLargeText(GetData($data,"dni", ""),"field=dni".$keylink).'</span>';
			else 
				$value = ProcessLargeText(GetData($data,"dni", ""),"field=dni".$keylink);
			$xt->assign("dni_mastervalue",$value);

//	apellido - 
			$value="";
				if (IsNumberType(GetFieldType("apellido")))
				$value = "<span class='runner-field-number'>".ProcessLargeText(GetData($data,"apellido", ""),"field=apellido".$keylink).'</span>';
			else 
				$value = ProcessLargeText(GetData($data,"apellido", ""),"field=apellido".$keylink);
			$xt->assign("apellido_mastervalue",$value);

//	nombre - 
			$value="";
				if (IsNumberType(GetFieldType("nombre")))
				$value = "<span class='runner-field-number'>".ProcessLargeText(GetData($data,"nombre", ""),"field=nombre".$keylink).'</span>';
			else 
				$value = ProcessLargeText(GetData($data,"nombre", ""),"field=nombre".$keylink);
			$xt->assign("nombre_mastervalue",$value);

//	identificacion - 
			$value="";
				if (IsNumberType(GetFieldType("identificacion")))
				$value = "<span class='runner-field-number'>".ProcessLargeText(GetData($data,"identificacion", ""),"field=identificacion".$keylink).'</span>';
			else 
				$value = ProcessLargeText(GetData($data,"identificacion", ""),"field=identificacion".$keylink);
			$xt->assign("identificacion_mastervalue",$value);

	$layout = GetPageLayout("docentes", 'masterlist');
	if($layout)
		$xt->assign("pageattrs", 'class="'.$layout->style." page-".$layout->name.'"');
			
	$xt->display("docentes_masterlist.htm");
	
	$strTableName=$oldTableName;
}

?>
