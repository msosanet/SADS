<?php
$tdataalumnos_faltas_Report=array();
	$tdataalumnos_faltas_Report[".NumberOfChars"]=80; 
	$tdataalumnos_faltas_Report[".ShortName"]="alumnos_faltas_Report";
	$tdataalumnos_faltas_Report[".OwnerID"]="";
	$tdataalumnos_faltas_Report[".OriginalTable"]="alumnos_faltas";


	
//	field labels
$fieldLabelsalumnos_faltas_Report = array();
if(mlang_getcurrentlang()=="Spanish")
{
	$fieldLabelsalumnos_faltas_Report["Spanish"]=array();
	$fieldToolTipsalumnos_faltas_Report["Spanish"]=array();
	$fieldLabelsalumnos_faltas_Report["Spanish"]["fecha"] = "Fecha";
	$fieldToolTipsalumnos_faltas_Report["Spanish"]["fecha"] = "";
	$fieldLabelsalumnos_faltas_Report["Spanish"]["total"] = "Total";
	$fieldToolTipsalumnos_faltas_Report["Spanish"]["total"] = "";
	$fieldLabelsalumnos_faltas_Report["Spanish"]["tipo"] = "Tipo";
	$fieldToolTipsalumnos_faltas_Report["Spanish"]["tipo"] = "";
	if (count($fieldToolTipsalumnos_faltas_Report["Spanish"])){
		$tdataalumnos_faltas_Report[".isUseToolTips"]=true;
	}
}


	
	$tdataalumnos_faltas_Report[".NCSearch"]=true;

	

$tdataalumnos_faltas_Report[".shortTableName"] = "alumnos_faltas_Report";
$tdataalumnos_faltas_Report[".nSecOptions"] = 0;
$tdataalumnos_faltas_Report[".recsPerRowList"] = 1;	
$tdataalumnos_faltas_Report[".tableGroupBy"] = "1";
$tdataalumnos_faltas_Report[".mainTableOwnerID"] = "";
$tdataalumnos_faltas_Report[".moveNext"] = 1;




$tdataalumnos_faltas_Report[".showAddInPopup"] = false;

$tdataalumnos_faltas_Report[".showEditInPopup"] = false;

$tdataalumnos_faltas_Report[".showViewInPopup"] = false;


$tdataalumnos_faltas_Report[".fieldsForRegister"] = array();

$tdataalumnos_faltas_Report[".listAjax"] = false;

	$tdataalumnos_faltas_Report[".audit"] = false;

	$tdataalumnos_faltas_Report[".locking"] = false;
	
$tdataalumnos_faltas_Report[".listIcons"] = true;
$tdataalumnos_faltas_Report[".edit"] = true;
$tdataalumnos_faltas_Report[".inlineEdit"] = true;
$tdataalumnos_faltas_Report[".view"] = true;

$tdataalumnos_faltas_Report[".exportTo"] = true;

$tdataalumnos_faltas_Report[".printFriendly"] = true;

$tdataalumnos_faltas_Report[".delete"] = true;

$tdataalumnos_faltas_Report[".showSimpleSearchOptions"] = false;

$tdataalumnos_faltas_Report[".showSearchPanel"] = true;


if (isMobile()){
$tdataalumnos_faltas_Report[".isUseAjaxSuggest"] = false;
}else {
$tdataalumnos_faltas_Report[".isUseAjaxSuggest"] = true;
}



// button handlers file names

$tdataalumnos_faltas_Report[".addPageEvents"] = false;

$tdataalumnos_faltas_Report[".arrKeyFields"][] = "fecha";
$tdataalumnos_faltas_Report[".arrKeyFields"][] = "tipo";

// use datepicker for search panel
$tdataalumnos_faltas_Report[".isUseCalendarForSearch"] = true;

// use timepicker for search panel
$tdataalumnos_faltas_Report[".isUseTimeForSearch"] = false;

$tdataalumnos_faltas_Report[".isUseiBox"] = false;



	


$tdataalumnos_faltas_Report[".isUseInlineJs"] = $tdataalumnos_faltas_Report[".isUseInlineAdd"] || $tdataalumnos_faltas_Report[".isUseInlineEdit"];

$tdataalumnos_faltas_Report[".allSearchFields"] = array();



$tdataalumnos_faltas_Report[".googleLikeFields"][] = "fecha";
$tdataalumnos_faltas_Report[".googleLikeFields"][] = "total";
$tdataalumnos_faltas_Report[".googleLikeFields"][] = "tipo";



$tdataalumnos_faltas_Report[".advSearchFields"][] = "fecha";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("fecha", $tdataalumnos_faltas_Report[".allSearchFields"])) 
{
	$tdataalumnos_faltas_Report[".allSearchFields"][] = "fecha";	
}
$tdataalumnos_faltas_Report[".advSearchFields"][] = "total";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("total", $tdataalumnos_faltas_Report[".allSearchFields"])) 
{
	$tdataalumnos_faltas_Report[".allSearchFields"][] = "total";	
}
$tdataalumnos_faltas_Report[".advSearchFields"][] = "tipo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("tipo", $tdataalumnos_faltas_Report[".allSearchFields"])) 
{
	$tdataalumnos_faltas_Report[".allSearchFields"][] = "tipo";	
}

$tdataalumnos_faltas_Report[".isTableType"] = "report";


	



// Access doesn't support subqueries from the same table as main
$tdataalumnos_faltas_Report[".subQueriesSupAccess"] = true;






$gstrOrderBy = "ORDER BY fecha DESC";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataalumnos_faltas_Report[".strOrderBy"] = $gstrOrderBy;
	
$tdataalumnos_faltas_Report[".orderindexes"] = array();
$tdataalumnos_faltas_Report[".orderindexes"][] = array(1, (0 ? "ASC" : "DESC"), "fecha");

$tdataalumnos_faltas_Report[".sqlHead"] = "SELECT fecha,count(fecha) as total,tipo";
$tdataalumnos_faltas_Report[".sqlFrom"] = "FROM alumnos_faltas";
$tdataalumnos_faltas_Report[".sqlWhereExpr"] = "MONTH(fecha)=MONTH(CURRENT_DATE()) AND YEAR(fecha)='2018'";
$tdataalumnos_faltas_Report[".sqlTail"] = "GROUP BY fecha,tipo";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdataalumnos_faltas_Report[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdataalumnos_faltas_Report[".arrGroupsPerPage"] = $arrGPP;

	$tableKeys = array();
	$tableKeys[] = "fecha";
	$tableKeys[] = "tipo";
	$tdataalumnos_faltas_Report[".Keys"] = $tableKeys;

$tdataalumnos_faltas_Report[".listFields"] = array();
$tdataalumnos_faltas_Report[".listFields"][] = "fecha";
$tdataalumnos_faltas_Report[".listFields"][] = "total";
$tdataalumnos_faltas_Report[".listFields"][] = "tipo";

$tdataalumnos_faltas_Report[".addFields"] = array();
$tdataalumnos_faltas_Report[".addFields"][] = "fecha";
$tdataalumnos_faltas_Report[".addFields"][] = "tipo";

$tdataalumnos_faltas_Report[".inlineAddFields"] = array();
$tdataalumnos_faltas_Report[".inlineAddFields"][] = "fecha";
$tdataalumnos_faltas_Report[".inlineAddFields"][] = "total";
$tdataalumnos_faltas_Report[".inlineAddFields"][] = "tipo";

$tdataalumnos_faltas_Report[".editFields"] = array();
$tdataalumnos_faltas_Report[".editFields"][] = "fecha";
$tdataalumnos_faltas_Report[".editFields"][] = "tipo";

$tdataalumnos_faltas_Report[".inlineEditFields"] = array();
$tdataalumnos_faltas_Report[".inlineEditFields"][] = "fecha";
$tdataalumnos_faltas_Report[".inlineEditFields"][] = "total";
$tdataalumnos_faltas_Report[".inlineEditFields"][] = "tipo";

	
//	fecha
	$fdata = array();
	$fdata["strName"] = "fecha";
	$fdata["ownerTable"] = "alumnos_faltas";
	$fdata["Label"]="Fecha"; 
	
		
		
	$fdata["FieldType"]= 7;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Short Date";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "fecha";
	
		$fdata["FullName"]= "fecha";
	
		$fdata["IsRequired"]=true; 
	
		
		
		
		
				$fdata["Index"]= 1;
		$fdata["DateEditType"] = 13; 
	$fdata["InitialYearFactor"] = 100; 
	$fdata["LastYearFactor"] = 10; 
			
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		$fdata["bInlineAdd"]=true; 
	
		$fdata["bEditPage"]=true; 
	
		$fdata["bInlineEdit"]=true; 
	
		$fdata["bViewPage"]=true; 
	
		
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
						$fdata["validateAs"]["basicValidate"][] = "IsRequired";
	
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
		
		
		
		
			$tdataalumnos_faltas_Report["fecha"]=$fdata;
//	total
	$fdata = array();
	$fdata["strName"] = "total";
	$fdata["ownerTable"] = "";
	$fdata["Label"]="Total"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "total";
	
		$fdata["FullName"]= "count(fecha)";
	
		
		
		
		
		
				$fdata["Index"]= 2;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		$fdata["bInlineAdd"]=true; 
	
		
		$fdata["bInlineEdit"]=true; 
	
		$fdata["bViewPage"]=true; 
	
		
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
		
		
		
		
			$tdataalumnos_faltas_Report["total"]=$fdata;
//	tipo
	$fdata = array();
	$fdata["strName"] = "tipo";
	$fdata["ownerTable"] = "alumnos_faltas";
	$fdata["Label"]="Tipo"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "tipo";
	
		$fdata["FullName"]= "tipo";
	
		
		
		
		
		
				$fdata["Index"]= 3;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=10";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		$fdata["bInlineAdd"]=true; 
	
		$fdata["bEditPage"]=true; 
	
		$fdata["bInlineEdit"]=true; 
	
		$fdata["bViewPage"]=true; 
	
		
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
		
		
		
		
			$tdataalumnos_faltas_Report["tipo"]=$fdata;


	
$tables_data["alumnos_faltas Report"]=&$tdataalumnos_faltas_Report;
$field_labels["alumnos_faltas_Report"] = &$fieldLabelsalumnos_faltas_Report;
$fieldToolTips["alumnos_faltas Report"] = &$fieldToolTipsalumnos_faltas_Report;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["alumnos_faltas Report"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["alumnos_faltas Report"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_alumnos_faltas_Report()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "fecha,count(fecha) as total,tipo";
$proto0["m_strFrom"] = "FROM alumnos_faltas";
$proto0["m_strWhere"] = "MONTH(fecha)=MONTH(CURRENT_DATE()) AND YEAR(fecha)='2018'";
$proto0["m_strOrderBy"] = "ORDER BY fecha DESC";
$proto0["m_strTail"] = "GROUP BY fecha,tipo";
$proto1=array();
$proto1["m_sql"] = "MONTH(fecha)=MONTH(CURRENT_DATE()) AND YEAR(fecha)='2018'";
$proto1["m_uniontype"] = "SQLL_AND";
	$obj = new SQLNonParsed(array(
	"m_sql" => "MONTH(fecha)=MONTH(CURRENT_DATE()) AND YEAR(fecha)='2018'"
));

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
						$proto3=array();
$proto3["m_sql"] = "MONTH(fecha)=MONTH(CURRENT_DATE())";
$proto3["m_uniontype"] = "SQLL_UNKNOWN";
						$proto4=array();
$proto4["m_functiontype"] = "SQLF_CUSTOM";
$proto4["m_arguments"] = array();
						$obj = new SQLNonParsed(array(
	"m_sql" => "fecha"
));

$proto4["m_arguments"][]=$obj;
$proto4["m_strFunctionName"] = "MONTH";
$obj = new SQLFunctionCall($proto4);

$proto3["m_column"]=$obj;
$proto3["m_contained"] = array();
$proto3["m_strCase"] = "=MONTH(CURRENT_DATE())";
$proto3["m_havingmode"] = "0";
$proto3["m_inBrackets"] = "0";
$proto3["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto3);

			$proto1["m_contained"][]=$obj;
						$proto6=array();
$proto6["m_sql"] = "YEAR(fecha)='2018'";
$proto6["m_uniontype"] = "SQLL_UNKNOWN";
						$proto7=array();
$proto7["m_functiontype"] = "SQLF_CUSTOM";
$proto7["m_arguments"] = array();
						$obj = new SQLNonParsed(array(
	"m_sql" => "fecha"
));

$proto7["m_arguments"][]=$obj;
$proto7["m_strFunctionName"] = "YEAR";
$obj = new SQLFunctionCall($proto7);

$proto6["m_column"]=$obj;
$proto6["m_contained"] = array();
$proto6["m_strCase"] = "='2018'";
$proto6["m_havingmode"] = "0";
$proto6["m_inBrackets"] = "0";
$proto6["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto6);

			$proto1["m_contained"][]=$obj;
$proto1["m_strCase"] = "";
$proto1["m_havingmode"] = "0";
$proto1["m_inBrackets"] = "0";
$proto1["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto1);

$proto0["m_where"] = $obj;
$proto9=array();
$proto9["m_sql"] = "";
$proto9["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto9["m_column"]=$obj;
$proto9["m_contained"] = array();
$proto9["m_strCase"] = "";
$proto9["m_havingmode"] = "0";
$proto9["m_inBrackets"] = "0";
$proto9["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto9);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "fecha",
	"m_strTable" => "alumnos_faltas"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$proto14=array();
$proto14["m_functiontype"] = "SQLF_COUNT";
$proto14["m_arguments"] = array();
						$obj = new SQLField(array(
	"m_strName" => "fecha",
	"m_strTable" => "alumnos_faltas"
));

$proto14["m_arguments"][]=$obj;
$proto14["m_strFunctionName"] = "count";
$obj = new SQLFunctionCall($proto14);

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "total";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto16=array();
			$obj = new SQLField(array(
	"m_strName" => "tipo",
	"m_strTable" => "alumnos_faltas"
));

$proto16["m_expr"]=$obj;
$proto16["m_alias"] = "";
$obj = new SQLFieldListItem($proto16);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto18=array();
$proto18["m_link"] = "SQLL_MAIN";
			$proto19=array();
$proto19["m_strName"] = "alumnos_faltas";
$proto19["m_columns"] = array();
$proto19["m_columns"][] = "dni";
$proto19["m_columns"][] = "fecha";
$proto19["m_columns"][] = "tipo";
$proto19["m_columns"][] = "injus";
$obj = new SQLTable($proto19);

$proto18["m_table"] = $obj;
$proto18["m_alias"] = "";
$proto20=array();
$proto20["m_sql"] = "";
$proto20["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto20["m_column"]=$obj;
$proto20["m_contained"] = array();
$proto20["m_strCase"] = "";
$proto20["m_havingmode"] = "0";
$proto20["m_inBrackets"] = "0";
$proto20["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto20);

$proto18["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto18);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
												$proto22=array();
						$obj = new SQLField(array(
	"m_strName" => "fecha",
	"m_strTable" => "alumnos_faltas"
));

$proto22["m_column"]=$obj;
$obj = new SQLGroupByItem($proto22);

$proto0["m_groupby"][]=$obj;
												$proto24=array();
						$obj = new SQLField(array(
	"m_strName" => "tipo",
	"m_strTable" => "alumnos_faltas"
));

$proto24["m_column"]=$obj;
$obj = new SQLGroupByItem($proto24);

$proto0["m_groupby"][]=$obj;
$proto0["m_orderby"] = array();
												$proto26=array();
						$obj = new SQLField(array(
	"m_strName" => "fecha",
	"m_strTable" => "alumnos_faltas"
));

$proto26["m_column"]=$obj;
$proto26["m_bAsc"] = 0;
$proto26["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto26);

$proto0["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto0);

return $obj;
}
$queryData_alumnos_faltas_Report = createSqlQuery_alumnos_faltas_Report();
$tdataalumnos_faltas_Report[".sqlquery"] = $queryData_alumnos_faltas_Report;



$tableEvents["alumnos_faltas Report"] = new eventsBase;
$tdataalumnos_faltas_Report[".hasEvents"] = false;

?>

