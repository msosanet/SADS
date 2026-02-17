<?php
$tdataausentes=array();
	$tdataausentes[".NumberOfChars"]=80; 
	$tdataausentes[".ShortName"]="ausentes";
	$tdataausentes[".OwnerID"]="";
	$tdataausentes[".OriginalTable"]="ausentes";


	
//	field labels
$fieldLabelsausentes = array();
if(mlang_getcurrentlang()=="Spanish")
{
	$fieldLabelsausentes["Spanish"]=array();
	$fieldToolTipsausentes["Spanish"]=array();
	$fieldLabelsausentes["Spanish"]["codigo"] = "Codigo";
	$fieldToolTipsausentes["Spanish"]["codigo"] = "";
	$fieldLabelsausentes["Spanish"]["docente"] = "Docente";
	$fieldToolTipsausentes["Spanish"]["docente"] = "";
	$fieldLabelsausentes["Spanish"]["fecha_desde"] = "Fecha Desde";
	$fieldToolTipsausentes["Spanish"]["fecha_desde"] = "";
	$fieldLabelsausentes["Spanish"]["fecha_hasta"] = "Fecha Hasta";
	$fieldToolTipsausentes["Spanish"]["fecha_hasta"] = "";
	$fieldLabelsausentes["Spanish"]["motivo"] = "Motivo";
	$fieldToolTipsausentes["Spanish"]["motivo"] = "";
	$fieldLabelsausentes["Spanish"]["notifico"] = "Notifico";
	$fieldToolTipsausentes["Spanish"]["notifico"] = "";
	if (count($fieldToolTipsausentes["Spanish"])){
		$tdataausentes[".isUseToolTips"]=true;
	}
}


	
	$tdataausentes[".NCSearch"]=true;

	

$tdataausentes[".shortTableName"] = "ausentes";
$tdataausentes[".nSecOptions"] = 0;
$tdataausentes[".recsPerRowList"] = 1;	
$tdataausentes[".tableGroupBy"] = "0";
$tdataausentes[".mainTableOwnerID"] = "";
$tdataausentes[".moveNext"] = 1;




$tdataausentes[".showAddInPopup"] = false;

$tdataausentes[".showEditInPopup"] = false;

$tdataausentes[".showViewInPopup"] = false;


$tdataausentes[".fieldsForRegister"] = array();

$tdataausentes[".listAjax"] = false;

	$tdataausentes[".audit"] = false;

	$tdataausentes[".locking"] = false;
	
$tdataausentes[".listIcons"] = true;
$tdataausentes[".edit"] = true;
$tdataausentes[".inlineEdit"] = true;
$tdataausentes[".view"] = true;

$tdataausentes[".exportTo"] = true;

$tdataausentes[".printFriendly"] = true;

$tdataausentes[".delete"] = true;

$tdataausentes[".showSimpleSearchOptions"] = false;

$tdataausentes[".showSearchPanel"] = true;


if (isMobile()){
$tdataausentes[".isUseAjaxSuggest"] = false;
}else {
$tdataausentes[".isUseAjaxSuggest"] = true;
}

$tdataausentes[".rowHighlite"] = true;


// button handlers file names

$tdataausentes[".addPageEvents"] = false;

$tdataausentes[".arrKeyFields"][] = "codigo";

// use datepicker for search panel
$tdataausentes[".isUseCalendarForSearch"] = true;

// use timepicker for search panel
$tdataausentes[".isUseTimeForSearch"] = false;

$tdataausentes[".isUseiBox"] = false;



	


$tdataausentes[".isUseInlineAdd"] = true;

$tdataausentes[".isUseInlineEdit"] = true;
$tdataausentes[".isUseInlineJs"] = $tdataausentes[".isUseInlineAdd"] || $tdataausentes[".isUseInlineEdit"];

$tdataausentes[".allSearchFields"] = array();

$tdataausentes[".globSearchFields"][] = "codigo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("codigo", $tdataausentes[".allSearchFields"]))
{
	$tdataausentes[".allSearchFields"][] = "codigo";	
}
$tdataausentes[".globSearchFields"][] = "docente";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("docente", $tdataausentes[".allSearchFields"]))
{
	$tdataausentes[".allSearchFields"][] = "docente";	
}
$tdataausentes[".globSearchFields"][] = "fecha_desde";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("fecha_desde", $tdataausentes[".allSearchFields"]))
{
	$tdataausentes[".allSearchFields"][] = "fecha_desde";	
}
$tdataausentes[".globSearchFields"][] = "fecha_hasta";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("fecha_hasta", $tdataausentes[".allSearchFields"]))
{
	$tdataausentes[".allSearchFields"][] = "fecha_hasta";	
}
$tdataausentes[".globSearchFields"][] = "motivo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("motivo", $tdataausentes[".allSearchFields"]))
{
	$tdataausentes[".allSearchFields"][] = "motivo";	
}
$tdataausentes[".globSearchFields"][] = "notifico";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("notifico", $tdataausentes[".allSearchFields"]))
{
	$tdataausentes[".allSearchFields"][] = "notifico";	
}


$tdataausentes[".googleLikeFields"][] = "codigo";
$tdataausentes[".googleLikeFields"][] = "docente";
$tdataausentes[".googleLikeFields"][] = "fecha_desde";
$tdataausentes[".googleLikeFields"][] = "fecha_hasta";
$tdataausentes[".googleLikeFields"][] = "motivo";
$tdataausentes[".googleLikeFields"][] = "notifico";



$tdataausentes[".advSearchFields"][] = "codigo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("codigo", $tdataausentes[".allSearchFields"])) 
{
	$tdataausentes[".allSearchFields"][] = "codigo";	
}
$tdataausentes[".advSearchFields"][] = "docente";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("docente", $tdataausentes[".allSearchFields"])) 
{
	$tdataausentes[".allSearchFields"][] = "docente";	
}
$tdataausentes[".advSearchFields"][] = "fecha_desde";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("fecha_desde", $tdataausentes[".allSearchFields"])) 
{
	$tdataausentes[".allSearchFields"][] = "fecha_desde";	
}
$tdataausentes[".advSearchFields"][] = "fecha_hasta";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("fecha_hasta", $tdataausentes[".allSearchFields"])) 
{
	$tdataausentes[".allSearchFields"][] = "fecha_hasta";	
}
$tdataausentes[".advSearchFields"][] = "motivo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("motivo", $tdataausentes[".allSearchFields"])) 
{
	$tdataausentes[".allSearchFields"][] = "motivo";	
}
$tdataausentes[".advSearchFields"][] = "notifico";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("notifico", $tdataausentes[".allSearchFields"])) 
{
	$tdataausentes[".allSearchFields"][] = "notifico";	
}

$tdataausentes[".isTableType"] = "list";


	



// Access doesn't support subqueries from the same table as main
$tdataausentes[".subQueriesSupAccess"] = true;





$tdataausentes[".pageSize"] = 20;

$gstrOrderBy = "";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataausentes[".strOrderBy"] = $gstrOrderBy;
	
$tdataausentes[".orderindexes"] = array();

$tdataausentes[".sqlHead"] = "SELECT codigo,  docente,  fecha_desde,  fecha_hasta,  motivo,  notifico";
$tdataausentes[".sqlFrom"] = "FROM ausentes";
$tdataausentes[".sqlWhereExpr"] = "";
$tdataausentes[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdataausentes[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdataausentes[".arrGroupsPerPage"] = $arrGPP;

	$tableKeys = array();
	$tableKeys[] = "codigo";
	$tdataausentes[".Keys"] = $tableKeys;

$tdataausentes[".listFields"] = array();
$tdataausentes[".listFields"][] = "codigo";
$tdataausentes[".listFields"][] = "docente";
$tdataausentes[".listFields"][] = "fecha_desde";
$tdataausentes[".listFields"][] = "fecha_hasta";
$tdataausentes[".listFields"][] = "motivo";
$tdataausentes[".listFields"][] = "notifico";

$tdataausentes[".addFields"] = array();
$tdataausentes[".addFields"][] = "docente";
$tdataausentes[".addFields"][] = "fecha_desde";
$tdataausentes[".addFields"][] = "fecha_hasta";
$tdataausentes[".addFields"][] = "motivo";
$tdataausentes[".addFields"][] = "notifico";

$tdataausentes[".inlineAddFields"] = array();
$tdataausentes[".inlineAddFields"][] = "docente";
$tdataausentes[".inlineAddFields"][] = "fecha_desde";
$tdataausentes[".inlineAddFields"][] = "fecha_hasta";
$tdataausentes[".inlineAddFields"][] = "motivo";
$tdataausentes[".inlineAddFields"][] = "notifico";

$tdataausentes[".editFields"] = array();
$tdataausentes[".editFields"][] = "docente";
$tdataausentes[".editFields"][] = "fecha_desde";
$tdataausentes[".editFields"][] = "fecha_hasta";
$tdataausentes[".editFields"][] = "motivo";
$tdataausentes[".editFields"][] = "notifico";

$tdataausentes[".inlineEditFields"] = array();
$tdataausentes[".inlineEditFields"][] = "docente";
$tdataausentes[".inlineEditFields"][] = "fecha_desde";
$tdataausentes[".inlineEditFields"][] = "fecha_hasta";
$tdataausentes[".inlineEditFields"][] = "motivo";
$tdataausentes[".inlineEditFields"][] = "notifico";

	
//	codigo
	$fdata = array();
	$fdata["strName"] = "codigo";
	$fdata["ownerTable"] = "ausentes";
	$fdata["Label"]="Codigo"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		$fdata["AutoInc"]=true;
	
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "codigo";
	
		$fdata["FullName"]= "codigo";
	
		$fdata["IsRequired"]=true; 
	
		
		
		
		
				$fdata["Index"]= 1;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$fdata["validateAs"]["basicValidate"][] = "IsRequired";
	
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdataausentes["codigo"]=$fdata;
//	docente
	$fdata = array();
	$fdata["strName"] = "docente";
	$fdata["ownerTable"] = "ausentes";
	$fdata["Label"]="Docente"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "docente";
	
		$fdata["FullName"]= "docente";
	
		
		
		
		
		
				$fdata["Index"]= 2;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=10";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		$fdata["bInlineAdd"]=true; 
	
		$fdata["bEditPage"]=true; 
	
		$fdata["bInlineEdit"]=true; 
	
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdataausentes["docente"]=$fdata;
//	fecha_desde
	$fdata = array();
	$fdata["strName"] = "fecha_desde";
	$fdata["ownerTable"] = "ausentes";
	$fdata["Label"]="Fecha Desde"; 
	
		
		
	$fdata["FieldType"]= 7;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Short Date";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "fecha_desde";
	
		$fdata["FullName"]= "fecha_desde";
	
		$fdata["IsRequired"]=true; 
	
		
		
		
		
				$fdata["Index"]= 3;
		$fdata["DateEditType"] = 13; 
	$fdata["InitialYearFactor"] = 100; 
	$fdata["LastYearFactor"] = 10; 
			
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		$fdata["bInlineAdd"]=true; 
	
		$fdata["bEditPage"]=true; 
	
		$fdata["bInlineEdit"]=true; 
	
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
						$fdata["validateAs"]["basicValidate"][] = "IsRequired";
	
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdataausentes["fecha_desde"]=$fdata;
//	fecha_hasta
	$fdata = array();
	$fdata["strName"] = "fecha_hasta";
	$fdata["ownerTable"] = "ausentes";
	$fdata["Label"]="Fecha Hasta"; 
	
		
		
	$fdata["FieldType"]= 7;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Short Date";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "fecha_hasta";
	
		$fdata["FullName"]= "fecha_hasta";
	
		$fdata["IsRequired"]=true; 
	
		
		
		
		
				$fdata["Index"]= 4;
		$fdata["DateEditType"] = 13; 
	$fdata["InitialYearFactor"] = 100; 
	$fdata["LastYearFactor"] = 10; 
			
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		$fdata["bInlineAdd"]=true; 
	
		$fdata["bEditPage"]=true; 
	
		$fdata["bInlineEdit"]=true; 
	
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
						$fdata["validateAs"]["basicValidate"][] = "IsRequired";
	
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdataausentes["fecha_hasta"]=$fdata;
//	motivo
	$fdata = array();
	$fdata["strName"] = "motivo";
	$fdata["ownerTable"] = "ausentes";
	$fdata["Label"]="Motivo"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "motivo";
	
		$fdata["FullName"]= "motivo";
	
		$fdata["IsRequired"]=true; 
	
		
		
		
		
				$fdata["Index"]= 5;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		$fdata["bInlineAdd"]=true; 
	
		$fdata["bEditPage"]=true; 
	
		$fdata["bInlineEdit"]=true; 
	
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$fdata["validateAs"]["basicValidate"][] = "IsRequired";
	
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdataausentes["motivo"]=$fdata;
//	notifico
	$fdata = array();
	$fdata["strName"] = "notifico";
	$fdata["ownerTable"] = "ausentes";
	$fdata["Label"]="Notifico"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "notifico";
	
		$fdata["FullName"]= "notifico";
	
		
		
		
		
		
				$fdata["Index"]= 6;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=10";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		$fdata["bInlineAdd"]=true; 
	
		$fdata["bEditPage"]=true; 
	
		$fdata["bInlineEdit"]=true; 
	
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdataausentes["notifico"]=$fdata;


	
$tables_data["ausentes"]=&$tdataausentes;
$field_labels["ausentes"] = &$fieldLabelsausentes;
$fieldToolTips["ausentes"] = &$fieldToolTipsausentes;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["ausentes"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["ausentes"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="docentes";
	$masterTablesData["ausentes"][$mIndex] = array(
		  "mDataSourceTable"=>"docentes"
		, "mOriginalTable" => $strOriginalDetailsTable
		, "mShortTable" => "docentes"
		, "masterKeys" => array()
		, "detailKeys" => array()
		, "dispChildCount" => "1"
		, "hideChild" => "0"	
		, "dispInfo" => "1"								
		, "previewOnList" => 1
		, "previewOnAdd" => 0
		, "previewOnEdit" => 0
		, "previewOnView" => 0
	);	
		$masterTablesData["ausentes"][$mIndex]["masterKeys"][]="dni";
		$masterTablesData["ausentes"][$mIndex]["detailKeys"][]="codigo";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_ausentes()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "codigo,  docente,  fecha_desde,  fecha_hasta,  motivo,  notifico";
$proto0["m_strFrom"] = "FROM ausentes";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto1=array();
$proto1["m_sql"] = "";
$proto1["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
$proto1["m_strCase"] = "";
$proto1["m_havingmode"] = "0";
$proto1["m_inBrackets"] = "0";
$proto1["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto1);

$proto0["m_where"] = $obj;
$proto3=array();
$proto3["m_sql"] = "";
$proto3["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto3["m_column"]=$obj;
$proto3["m_contained"] = array();
$proto3["m_strCase"] = "";
$proto3["m_havingmode"] = "0";
$proto3["m_inBrackets"] = "0";
$proto3["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto3);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto5=array();
			$obj = new SQLField(array(
	"m_strName" => "codigo",
	"m_strTable" => "ausentes"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "docente",
	"m_strTable" => "ausentes"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "fecha_desde",
	"m_strTable" => "ausentes"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "fecha_hasta",
	"m_strTable" => "ausentes"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "motivo",
	"m_strTable" => "ausentes"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "notifico",
	"m_strTable" => "ausentes"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto17=array();
$proto17["m_link"] = "SQLL_MAIN";
			$proto18=array();
$proto18["m_strName"] = "ausentes";
$proto18["m_columns"] = array();
$proto18["m_columns"][] = "codigo";
$proto18["m_columns"][] = "docente";
$proto18["m_columns"][] = "fecha_desde";
$proto18["m_columns"][] = "fecha_hasta";
$proto18["m_columns"][] = "hora";
$proto18["m_columns"][] = "motivo";
$proto18["m_columns"][] = "notifico";
$proto18["m_columns"][] = "observaciones";
$proto18["m_columns"][] = "f_notif";
$obj = new SQLTable($proto18);

$proto17["m_table"] = $obj;
$proto17["m_alias"] = "";
$proto19=array();
$proto19["m_sql"] = "";
$proto19["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto19["m_column"]=$obj;
$proto19["m_contained"] = array();
$proto19["m_strCase"] = "";
$proto19["m_havingmode"] = "0";
$proto19["m_inBrackets"] = "0";
$proto19["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto19);

$proto17["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto17);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

return $obj;
}
$queryData_ausentes = createSqlQuery_ausentes();
$tdataausentes[".sqlquery"] = $queryData_ausentes;



$tableEvents["ausentes"] = new eventsBase;
$tdataausentes[".hasEvents"] = false;

?>
