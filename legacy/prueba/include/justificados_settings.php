<?php
$tdatajustificados=array();
	$tdatajustificados[".NumberOfChars"]=80; 
	$tdatajustificados[".ShortName"]="justificados";
	$tdatajustificados[".OwnerID"]="";
	$tdatajustificados[".OriginalTable"]="justificados";


	
//	field labels
$fieldLabelsjustificados = array();
if(mlang_getcurrentlang()=="Spanish")
{
	$fieldLabelsjustificados["Spanish"]=array();
	$fieldToolTipsjustificados["Spanish"]=array();
	$fieldLabelsjustificados["Spanish"]["codigo"] = "Codigo";
	$fieldToolTipsjustificados["Spanish"]["codigo"] = "";
	$fieldLabelsjustificados["Spanish"]["docente"] = "Docente";
	$fieldToolTipsjustificados["Spanish"]["docente"] = "";
	$fieldLabelsjustificados["Spanish"]["fecha_desde"] = "Fecha Desde";
	$fieldToolTipsjustificados["Spanish"]["fecha_desde"] = "";
	$fieldLabelsjustificados["Spanish"]["fecha_hasta"] = "Fecha Hasta";
	$fieldToolTipsjustificados["Spanish"]["fecha_hasta"] = "";
	$fieldLabelsjustificados["Spanish"]["motivo"] = "Motivo";
	$fieldToolTipsjustificados["Spanish"]["motivo"] = "";
	if (count($fieldToolTipsjustificados["Spanish"])){
		$tdatajustificados[".isUseToolTips"]=true;
	}
}


	
	$tdatajustificados[".NCSearch"]=true;

	

$tdatajustificados[".shortTableName"] = "justificados";
$tdatajustificados[".nSecOptions"] = 0;
$tdatajustificados[".recsPerRowList"] = 1;	
$tdatajustificados[".tableGroupBy"] = "0";
$tdatajustificados[".mainTableOwnerID"] = "";
$tdatajustificados[".moveNext"] = 1;




$tdatajustificados[".showAddInPopup"] = false;

$tdatajustificados[".showEditInPopup"] = false;

$tdatajustificados[".showViewInPopup"] = false;


$tdatajustificados[".fieldsForRegister"] = array();

$tdatajustificados[".listAjax"] = false;

	$tdatajustificados[".audit"] = false;

	$tdatajustificados[".locking"] = false;
	
$tdatajustificados[".listIcons"] = true;
$tdatajustificados[".edit"] = true;
$tdatajustificados[".inlineEdit"] = true;
$tdatajustificados[".view"] = true;

$tdatajustificados[".exportTo"] = true;

$tdatajustificados[".printFriendly"] = true;

$tdatajustificados[".delete"] = true;

$tdatajustificados[".showSimpleSearchOptions"] = false;

$tdatajustificados[".showSearchPanel"] = true;


if (isMobile()){
$tdatajustificados[".isUseAjaxSuggest"] = false;
}else {
$tdatajustificados[".isUseAjaxSuggest"] = true;
}

$tdatajustificados[".rowHighlite"] = true;


// button handlers file names

$tdatajustificados[".addPageEvents"] = false;

$tdatajustificados[".arrKeyFields"][] = "codigo";

// use datepicker for search panel
$tdatajustificados[".isUseCalendarForSearch"] = true;

// use timepicker for search panel
$tdatajustificados[".isUseTimeForSearch"] = false;

$tdatajustificados[".isUseiBox"] = false;



	


$tdatajustificados[".isUseInlineAdd"] = true;

$tdatajustificados[".isUseInlineEdit"] = true;
$tdatajustificados[".isUseInlineJs"] = $tdatajustificados[".isUseInlineAdd"] || $tdatajustificados[".isUseInlineEdit"];

$tdatajustificados[".allSearchFields"] = array();

$tdatajustificados[".globSearchFields"][] = "codigo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("codigo", $tdatajustificados[".allSearchFields"]))
{
	$tdatajustificados[".allSearchFields"][] = "codigo";	
}
$tdatajustificados[".globSearchFields"][] = "docente";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("docente", $tdatajustificados[".allSearchFields"]))
{
	$tdatajustificados[".allSearchFields"][] = "docente";	
}
$tdatajustificados[".globSearchFields"][] = "fecha_desde";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("fecha_desde", $tdatajustificados[".allSearchFields"]))
{
	$tdatajustificados[".allSearchFields"][] = "fecha_desde";	
}
$tdatajustificados[".globSearchFields"][] = "fecha_hasta";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("fecha_hasta", $tdatajustificados[".allSearchFields"]))
{
	$tdatajustificados[".allSearchFields"][] = "fecha_hasta";	
}
$tdatajustificados[".globSearchFields"][] = "motivo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("motivo", $tdatajustificados[".allSearchFields"]))
{
	$tdatajustificados[".allSearchFields"][] = "motivo";	
}


$tdatajustificados[".googleLikeFields"][] = "codigo";
$tdatajustificados[".googleLikeFields"][] = "docente";
$tdatajustificados[".googleLikeFields"][] = "fecha_desde";
$tdatajustificados[".googleLikeFields"][] = "fecha_hasta";
$tdatajustificados[".googleLikeFields"][] = "motivo";



$tdatajustificados[".advSearchFields"][] = "codigo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("codigo", $tdatajustificados[".allSearchFields"])) 
{
	$tdatajustificados[".allSearchFields"][] = "codigo";	
}
$tdatajustificados[".advSearchFields"][] = "docente";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("docente", $tdatajustificados[".allSearchFields"])) 
{
	$tdatajustificados[".allSearchFields"][] = "docente";	
}
$tdatajustificados[".advSearchFields"][] = "fecha_desde";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("fecha_desde", $tdatajustificados[".allSearchFields"])) 
{
	$tdatajustificados[".allSearchFields"][] = "fecha_desde";	
}
$tdatajustificados[".advSearchFields"][] = "fecha_hasta";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("fecha_hasta", $tdatajustificados[".allSearchFields"])) 
{
	$tdatajustificados[".allSearchFields"][] = "fecha_hasta";	
}
$tdatajustificados[".advSearchFields"][] = "motivo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("motivo", $tdatajustificados[".allSearchFields"])) 
{
	$tdatajustificados[".allSearchFields"][] = "motivo";	
}

$tdatajustificados[".isTableType"] = "list";


	



// Access doesn't support subqueries from the same table as main
$tdatajustificados[".subQueriesSupAccess"] = true;





$tdatajustificados[".pageSize"] = 20;

$gstrOrderBy = "";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdatajustificados[".strOrderBy"] = $gstrOrderBy;
	
$tdatajustificados[".orderindexes"] = array();

$tdatajustificados[".sqlHead"] = "SELECT codigo,  docente,  fecha_desde,  fecha_hasta,  motivo";
$tdatajustificados[".sqlFrom"] = "FROM justificados";
$tdatajustificados[".sqlWhereExpr"] = "";
$tdatajustificados[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatajustificados[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatajustificados[".arrGroupsPerPage"] = $arrGPP;

	$tableKeys = array();
	$tableKeys[] = "codigo";
	$tdatajustificados[".Keys"] = $tableKeys;

$tdatajustificados[".listFields"] = array();
$tdatajustificados[".listFields"][] = "codigo";
$tdatajustificados[".listFields"][] = "docente";
$tdatajustificados[".listFields"][] = "fecha_desde";
$tdatajustificados[".listFields"][] = "fecha_hasta";
$tdatajustificados[".listFields"][] = "motivo";

$tdatajustificados[".addFields"] = array();
$tdatajustificados[".addFields"][] = "docente";
$tdatajustificados[".addFields"][] = "fecha_desde";
$tdatajustificados[".addFields"][] = "fecha_hasta";
$tdatajustificados[".addFields"][] = "motivo";

$tdatajustificados[".inlineAddFields"] = array();
$tdatajustificados[".inlineAddFields"][] = "docente";
$tdatajustificados[".inlineAddFields"][] = "fecha_desde";
$tdatajustificados[".inlineAddFields"][] = "fecha_hasta";
$tdatajustificados[".inlineAddFields"][] = "motivo";

$tdatajustificados[".editFields"] = array();
$tdatajustificados[".editFields"][] = "docente";
$tdatajustificados[".editFields"][] = "fecha_desde";
$tdatajustificados[".editFields"][] = "fecha_hasta";
$tdatajustificados[".editFields"][] = "motivo";

$tdatajustificados[".inlineEditFields"] = array();
$tdatajustificados[".inlineEditFields"][] = "docente";
$tdatajustificados[".inlineEditFields"][] = "fecha_desde";
$tdatajustificados[".inlineEditFields"][] = "fecha_hasta";
$tdatajustificados[".inlineEditFields"][] = "motivo";

	
//	codigo
	$fdata = array();
	$fdata["strName"] = "codigo";
	$fdata["ownerTable"] = "justificados";
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
	
		
				
		
		
		
			$tdatajustificados["codigo"]=$fdata;
//	docente
	$fdata = array();
	$fdata["strName"] = "docente";
	$fdata["ownerTable"] = "justificados";
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
	
		
				
		
		
		
			$tdatajustificados["docente"]=$fdata;
//	fecha_desde
	$fdata = array();
	$fdata["strName"] = "fecha_desde";
	$fdata["ownerTable"] = "justificados";
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
	
		
				
		
		
		
			$tdatajustificados["fecha_desde"]=$fdata;
//	fecha_hasta
	$fdata = array();
	$fdata["strName"] = "fecha_hasta";
	$fdata["ownerTable"] = "justificados";
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
	
		
				
		
		
		
			$tdatajustificados["fecha_hasta"]=$fdata;
//	motivo
	$fdata = array();
	$fdata["strName"] = "motivo";
	$fdata["ownerTable"] = "justificados";
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
	
		
				
		
		
		
			$tdatajustificados["motivo"]=$fdata;


	
$tables_data["justificados"]=&$tdatajustificados;
$field_labels["justificados"] = &$fieldLabelsjustificados;
$fieldToolTips["justificados"] = &$fieldToolTipsjustificados;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["justificados"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["justificados"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="docentes";
	$masterTablesData["justificados"][$mIndex] = array(
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
		$masterTablesData["justificados"][$mIndex]["masterKeys"][]="dni";
		$masterTablesData["justificados"][$mIndex]["detailKeys"][]="codigo";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_justificados()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "codigo,  docente,  fecha_desde,  fecha_hasta,  motivo";
$proto0["m_strFrom"] = "FROM justificados";
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
	"m_strTable" => "justificados"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "docente",
	"m_strTable" => "justificados"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "fecha_desde",
	"m_strTable" => "justificados"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "fecha_hasta",
	"m_strTable" => "justificados"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "motivo",
	"m_strTable" => "justificados"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto15=array();
$proto15["m_link"] = "SQLL_MAIN";
			$proto16=array();
$proto16["m_strName"] = "justificados";
$proto16["m_columns"] = array();
$proto16["m_columns"][] = "codigo";
$proto16["m_columns"][] = "docente";
$proto16["m_columns"][] = "fecha_desde";
$proto16["m_columns"][] = "fecha_hasta";
$proto16["m_columns"][] = "hora";
$proto16["m_columns"][] = "motivo";
$proto16["m_columns"][] = "notifico";
$proto16["m_columns"][] = "observaciones";
$proto16["m_columns"][] = "f_notif";
$proto16["m_columns"][] = "parte";
$proto16["m_columns"][] = "justificativo";
$proto16["m_columns"][] = "aviso";
$obj = new SQLTable($proto16);

$proto15["m_table"] = $obj;
$proto15["m_alias"] = "";
$proto17=array();
$proto17["m_sql"] = "";
$proto17["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto17["m_column"]=$obj;
$proto17["m_contained"] = array();
$proto17["m_strCase"] = "";
$proto17["m_havingmode"] = "0";
$proto17["m_inBrackets"] = "0";
$proto17["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto17);

$proto15["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto15);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

return $obj;
}
$queryData_justificados = createSqlQuery_justificados();
$tdatajustificados[".sqlquery"] = $queryData_justificados;



$tableEvents["justificados"] = new eventsBase;
$tdatajustificados[".hasEvents"] = false;

?>
