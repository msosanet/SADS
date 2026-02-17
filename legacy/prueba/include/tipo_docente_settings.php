<?php
$tdatatipo_docente=array();
	$tdatatipo_docente[".NumberOfChars"]=80; 
	$tdatatipo_docente[".ShortName"]="tipo_docente";
	$tdatatipo_docente[".OwnerID"]="";
	$tdatatipo_docente[".OriginalTable"]="tipo_docente";


	
//	field labels
$fieldLabelstipo_docente = array();
if(mlang_getcurrentlang()=="Spanish")
{
	$fieldLabelstipo_docente["Spanish"]=array();
	$fieldToolTipstipo_docente["Spanish"]=array();
	$fieldLabelstipo_docente["Spanish"]["descripcion"] = "Descripcion";
	$fieldToolTipstipo_docente["Spanish"]["descripcion"] = "";
	$fieldLabelstipo_docente["Spanish"]["codigo"] = "Codigo";
	$fieldToolTipstipo_docente["Spanish"]["codigo"] = "";
	if (count($fieldToolTipstipo_docente["Spanish"])){
		$tdatatipo_docente[".isUseToolTips"]=true;
	}
}


	
	$tdatatipo_docente[".NCSearch"]=true;

	

$tdatatipo_docente[".shortTableName"] = "tipo_docente";
$tdatatipo_docente[".nSecOptions"] = 0;
$tdatatipo_docente[".recsPerRowList"] = 1;	
$tdatatipo_docente[".tableGroupBy"] = "0";
$tdatatipo_docente[".mainTableOwnerID"] = "";
$tdatatipo_docente[".moveNext"] = 1;




$tdatatipo_docente[".showAddInPopup"] = false;

$tdatatipo_docente[".showEditInPopup"] = false;

$tdatatipo_docente[".showViewInPopup"] = false;


$tdatatipo_docente[".fieldsForRegister"] = array();

$tdatatipo_docente[".listAjax"] = false;

	$tdatatipo_docente[".audit"] = false;

	$tdatatipo_docente[".locking"] = false;
	
$tdatatipo_docente[".listIcons"] = true;

$tdatatipo_docente[".exportTo"] = true;

$tdatatipo_docente[".printFriendly"] = true;


$tdatatipo_docente[".showSimpleSearchOptions"] = false;

$tdatatipo_docente[".showSearchPanel"] = true;


if (isMobile()){
$tdatatipo_docente[".isUseAjaxSuggest"] = false;
}else {
$tdatatipo_docente[".isUseAjaxSuggest"] = true;
}

$tdatatipo_docente[".rowHighlite"] = true;


// button handlers file names

$tdatatipo_docente[".addPageEvents"] = false;

$tdatatipo_docente[".arrKeyFields"][] = "codigo";

// use datepicker for search panel
$tdatatipo_docente[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdatatipo_docente[".isUseTimeForSearch"] = false;

$tdatatipo_docente[".isUseiBox"] = false;



	


$tdatatipo_docente[".isUseInlineAdd"] = true;

$tdatatipo_docente[".isUseInlineJs"] = $tdatatipo_docente[".isUseInlineAdd"] || $tdatatipo_docente[".isUseInlineEdit"];

$tdatatipo_docente[".allSearchFields"] = array();

$tdatatipo_docente[".globSearchFields"][] = "descripcion";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("descripcion", $tdatatipo_docente[".allSearchFields"]))
{
	$tdatatipo_docente[".allSearchFields"][] = "descripcion";	
}


$tdatatipo_docente[".googleLikeFields"][] = "codigo";
$tdatatipo_docente[".googleLikeFields"][] = "descripcion";



$tdatatipo_docente[".advSearchFields"][] = "codigo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("codigo", $tdatatipo_docente[".allSearchFields"])) 
{
	$tdatatipo_docente[".allSearchFields"][] = "codigo";	
}
$tdatatipo_docente[".advSearchFields"][] = "descripcion";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("descripcion", $tdatatipo_docente[".allSearchFields"])) 
{
	$tdatatipo_docente[".allSearchFields"][] = "descripcion";	
}

$tdatatipo_docente[".isTableType"] = "list";


	

$tdatatipo_docente[".isDisplayLoading"] = true;


// Access doesn't support subqueries from the same table as main
$tdatatipo_docente[".subQueriesSupAccess"] = true;





$tdatatipo_docente[".pageSize"] = 20;

$gstrOrderBy = "";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdatatipo_docente[".strOrderBy"] = $gstrOrderBy;
	
$tdatatipo_docente[".orderindexes"] = array();

$tdatatipo_docente[".sqlHead"] = "SELECT descripcion,  codigo";
$tdatatipo_docente[".sqlFrom"] = "FROM tipo_docente";
$tdatatipo_docente[".sqlWhereExpr"] = "";
$tdatatipo_docente[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatatipo_docente[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatatipo_docente[".arrGroupsPerPage"] = $arrGPP;

	$tableKeys = array();
	$tableKeys[] = "codigo";
	$tdatatipo_docente[".Keys"] = $tableKeys;

$tdatatipo_docente[".listFields"] = array();
$tdatatipo_docente[".listFields"][] = "descripcion";

$tdatatipo_docente[".addFields"] = array();
$tdatatipo_docente[".addFields"][] = "descripcion";
$tdatatipo_docente[".addFields"][] = "codigo";

$tdatatipo_docente[".inlineAddFields"] = array();
$tdatatipo_docente[".inlineAddFields"][] = "descripcion";

$tdatatipo_docente[".editFields"] = array();

$tdatatipo_docente[".inlineEditFields"] = array();

	
//	descripcion
	$fdata = array();
	$fdata["strName"] = "descripcion";
	$fdata["ownerTable"] = "tipo_docente";
	$fdata["Label"]="Descripcion"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "descripcion";
	
		$fdata["FullName"]= "descripcion";
	
		
		
		
		
		
				$fdata["Index"]= 1;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=30";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		$fdata["bInlineAdd"]=true; 
	
		
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatipo_docente["descripcion"]=$fdata;
//	codigo
	$fdata = array();
	$fdata["strName"] = "codigo";
	$fdata["ownerTable"] = "tipo_docente";
	$fdata["Label"]="Codigo"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		$fdata["AutoInc"]=true;
	
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "codigo";
	
		$fdata["FullName"]= "codigo";
	
		
		
		
		
		
				$fdata["Index"]= 2;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		
		
		
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				
		
				
		
		
		
			$tdatatipo_docente["codigo"]=$fdata;


	
$tables_data["tipo_docente"]=&$tdatatipo_docente;
$field_labels["tipo_docente"] = &$fieldLabelstipo_docente;
$fieldToolTips["tipo_docente"] = &$fieldToolTipstipo_docente;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["tipo_docente"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["tipo_docente"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_tipo_docente()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "descripcion,  codigo";
$proto0["m_strFrom"] = "FROM tipo_docente";
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
	"m_strName" => "descripcion",
	"m_strTable" => "tipo_docente"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "codigo",
	"m_strTable" => "tipo_docente"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto9=array();
$proto9["m_link"] = "SQLL_MAIN";
			$proto10=array();
$proto10["m_strName"] = "tipo_docente";
$proto10["m_columns"] = array();
$proto10["m_columns"][] = "codigo";
$proto10["m_columns"][] = "descripcion";
$obj = new SQLTable($proto10);

$proto9["m_table"] = $obj;
$proto9["m_alias"] = "";
$proto11=array();
$proto11["m_sql"] = "";
$proto11["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto11["m_column"]=$obj;
$proto11["m_contained"] = array();
$proto11["m_strCase"] = "";
$proto11["m_havingmode"] = "0";
$proto11["m_inBrackets"] = "0";
$proto11["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto11);

$proto9["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto9);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

return $obj;
}
$queryData_tipo_docente = createSqlQuery_tipo_docente();
$tdatatipo_docente[".sqlquery"] = $queryData_tipo_docente;



$tableEvents["tipo_docente"] = new eventsBase;
$tdatatipo_docente[".hasEvents"] = false;

?>
