<?php
$tdataalumnos_faltas_Chart=array();
	$tdataalumnos_faltas_Chart[".ShortName"]="alumnos_faltas_Chart";
	$tdataalumnos_faltas_Chart[".OwnerID"]="";
	$tdataalumnos_faltas_Chart[".OriginalTable"]="alumnos_faltas";


	
//	field labels
$fieldLabelsalumnos_faltas_Chart = array();
if(mlang_getcurrentlang()=="Spanish")
{
	$fieldLabelsalumnos_faltas_Chart["Spanish"]=array();
	$fieldToolTipsalumnos_faltas_Chart["Spanish"]=array();
	$fieldLabelsalumnos_faltas_Chart["Spanish"]["fecha"] = "Fecha";
	$fieldToolTipsalumnos_faltas_Chart["Spanish"]["fecha"] = "";
	$fieldLabelsalumnos_faltas_Chart["Spanish"]["total"] = "Total";
	$fieldToolTipsalumnos_faltas_Chart["Spanish"]["total"] = "";
	$fieldLabelsalumnos_faltas_Chart["Spanish"]["tipo"] = "Tipo";
	$fieldToolTipsalumnos_faltas_Chart["Spanish"]["tipo"] = "";
	if (count($fieldToolTipsalumnos_faltas_Chart["Spanish"])){
		$tdataalumnos_faltas_Chart[".isUseToolTips"]=true;
	}
}


	
	$tdataalumnos_faltas_Chart[".NCSearch"]=true;

	
	$tdataalumnos_faltas_Chart[".ChartRefreshTime"] = 0;

$tdataalumnos_faltas_Chart[".shortTableName"] = "alumnos_faltas_Chart";
$tdataalumnos_faltas_Chart[".nSecOptions"] = 0;
$tdataalumnos_faltas_Chart[".recsPerRowList"] = 1;	
$tdataalumnos_faltas_Chart[".tableGroupBy"] = "1";
$tdataalumnos_faltas_Chart[".mainTableOwnerID"] = "";
$tdataalumnos_faltas_Chart[".moveNext"] = 1;




$tdataalumnos_faltas_Chart[".showAddInPopup"] = false;

$tdataalumnos_faltas_Chart[".showEditInPopup"] = false;

$tdataalumnos_faltas_Chart[".showViewInPopup"] = false;


$tdataalumnos_faltas_Chart[".fieldsForRegister"] = array();

$tdataalumnos_faltas_Chart[".listAjax"] = false;

	$tdataalumnos_faltas_Chart[".audit"] = false;

	$tdataalumnos_faltas_Chart[".locking"] = false;
	
$tdataalumnos_faltas_Chart[".listIcons"] = true;
$tdataalumnos_faltas_Chart[".edit"] = true;
$tdataalumnos_faltas_Chart[".inlineEdit"] = true;
$tdataalumnos_faltas_Chart[".view"] = true;



$tdataalumnos_faltas_Chart[".delete"] = true;

$tdataalumnos_faltas_Chart[".showSimpleSearchOptions"] = false;

$tdataalumnos_faltas_Chart[".showSearchPanel"] = true;


if (isMobile()){
$tdataalumnos_faltas_Chart[".isUseAjaxSuggest"] = false;
}else {
$tdataalumnos_faltas_Chart[".isUseAjaxSuggest"] = true;
}



// button handlers file names

$tdataalumnos_faltas_Chart[".addPageEvents"] = false;

$tdataalumnos_faltas_Chart[".arrKeyFields"][] = "fecha";
$tdataalumnos_faltas_Chart[".arrKeyFields"][] = "tipo";

// use datepicker for search panel
$tdataalumnos_faltas_Chart[".isUseCalendarForSearch"] = true;

// use timepicker for search panel
$tdataalumnos_faltas_Chart[".isUseTimeForSearch"] = false;

$tdataalumnos_faltas_Chart[".isUseiBox"] = false;



	


$tdataalumnos_faltas_Chart[".isUseInlineJs"] = $tdataalumnos_faltas_Chart[".isUseInlineAdd"] || $tdataalumnos_faltas_Chart[".isUseInlineEdit"];

$tdataalumnos_faltas_Chart[".allSearchFields"] = array();

$tdataalumnos_faltas_Chart[".globSearchFields"][] = "fecha";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("fecha", $tdataalumnos_faltas_Chart[".allSearchFields"]))
{
	$tdataalumnos_faltas_Chart[".allSearchFields"][] = "fecha";	
}
$tdataalumnos_faltas_Chart[".globSearchFields"][] = "total";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("total", $tdataalumnos_faltas_Chart[".allSearchFields"]))
{
	$tdataalumnos_faltas_Chart[".allSearchFields"][] = "total";	
}
$tdataalumnos_faltas_Chart[".globSearchFields"][] = "tipo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("tipo", $tdataalumnos_faltas_Chart[".allSearchFields"]))
{
	$tdataalumnos_faltas_Chart[".allSearchFields"][] = "tipo";	
}


$tdataalumnos_faltas_Chart[".googleLikeFields"][] = "fecha";
$tdataalumnos_faltas_Chart[".googleLikeFields"][] = "total";
$tdataalumnos_faltas_Chart[".googleLikeFields"][] = "tipo";



$tdataalumnos_faltas_Chart[".advSearchFields"][] = "fecha";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("fecha", $tdataalumnos_faltas_Chart[".allSearchFields"])) 
{
	$tdataalumnos_faltas_Chart[".allSearchFields"][] = "fecha";	
}
$tdataalumnos_faltas_Chart[".advSearchFields"][] = "total";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("total", $tdataalumnos_faltas_Chart[".allSearchFields"])) 
{
	$tdataalumnos_faltas_Chart[".allSearchFields"][] = "total";	
}
$tdataalumnos_faltas_Chart[".advSearchFields"][] = "tipo";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("tipo", $tdataalumnos_faltas_Chart[".allSearchFields"])) 
{
	$tdataalumnos_faltas_Chart[".allSearchFields"][] = "tipo";	
}

$tdataalumnos_faltas_Chart[".isTableType"] = "chart";


	

$tdataalumnos_faltas_Chart[".isDisplayLoading"] = true;


// Access doesn't support subqueries from the same table as main
$tdataalumnos_faltas_Chart[".subQueriesSupAccess"] = true;




$gstrOrderBy = "ORDER BY fecha DESC";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataalumnos_faltas_Chart[".strOrderBy"] = $gstrOrderBy;
	
$tdataalumnos_faltas_Chart[".orderindexes"] = array();

$tdataalumnos_faltas_Chart[".sqlHead"] = "SELECT fecha,  COUNT(fecha) AS total,  tipo";
$tdataalumnos_faltas_Chart[".sqlFrom"] = "FROM alumnos_faltas";
$tdataalumnos_faltas_Chart[".sqlWhereExpr"] = "(MONTH(fecha) =MONTH(CURRENT_DATE()))";
$tdataalumnos_faltas_Chart[".sqlTail"] = "GROUP BY fecha, tipo";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdataalumnos_faltas_Chart[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdataalumnos_faltas_Chart[".arrGroupsPerPage"] = $arrGPP;

	$tableKeys = array();
	$tableKeys[] = "fecha";
	$tableKeys[] = "tipo";
	$tdataalumnos_faltas_Chart[".Keys"] = $tableKeys;

$tdataalumnos_faltas_Chart[".listFields"] = array();
$tdataalumnos_faltas_Chart[".listFields"][] = "fecha";
$tdataalumnos_faltas_Chart[".listFields"][] = "total";
$tdataalumnos_faltas_Chart[".listFields"][] = "tipo";

$tdataalumnos_faltas_Chart[".addFields"] = array();
$tdataalumnos_faltas_Chart[".addFields"][] = "fecha";
$tdataalumnos_faltas_Chart[".addFields"][] = "tipo";

$tdataalumnos_faltas_Chart[".inlineAddFields"] = array();
$tdataalumnos_faltas_Chart[".inlineAddFields"][] = "fecha";
$tdataalumnos_faltas_Chart[".inlineAddFields"][] = "total";
$tdataalumnos_faltas_Chart[".inlineAddFields"][] = "tipo";

$tdataalumnos_faltas_Chart[".editFields"] = array();
$tdataalumnos_faltas_Chart[".editFields"][] = "fecha";
$tdataalumnos_faltas_Chart[".editFields"][] = "tipo";

$tdataalumnos_faltas_Chart[".inlineEditFields"] = array();
$tdataalumnos_faltas_Chart[".inlineEditFields"][] = "fecha";
$tdataalumnos_faltas_Chart[".inlineEditFields"][] = "total";
$tdataalumnos_faltas_Chart[".inlineEditFields"][] = "tipo";

	
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
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
						$fdata["validateAs"]["basicValidate"][] = "IsRequired";
	
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
		
		
		
		
			$tdataalumnos_faltas_Chart["fecha"]=$fdata;
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
	
		$fdata["FullName"]= "COUNT(fecha)";
	
		
		
		
		
		
				$fdata["Index"]= 2;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		$fdata["bInlineAdd"]=true; 
	
		
		$fdata["bInlineEdit"]=true; 
	
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
		
		
		
		
			$tdataalumnos_faltas_Chart["total"]=$fdata;
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
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
		
		
		
		
			$tdataalumnos_faltas_Chart["tipo"]=$fdata;


$tdataalumnos_faltas_Chart[".chartXml"] = '<chart>
<attr value="tables">
	<attr value="0">alumnos_faltas Chart</attr>
</attr>
<attr value="chart_type">
	<attr value="type">2d_column</attr>
</attr>

<attr value="parameters">';
$tdataalumnos_faltas_Chart[".chartXml"] .= '<attr value="0">
<attr value="name">total</attr>
<attr value="currencyFormat">0</attr>
<attr value="decimalFormat">2</attr>
<attr value="customFormat">0</attr>
<attr value="customFormatStr"></attr>';
$tdataalumnos_faltas_Chart[".chartXml"] .= '</attr>';
$tdataalumnos_faltas_Chart[".chartXml"] .= '<attr value="1">
<attr value="name">tipo</attr>
</attr>';
$tdataalumnos_faltas_Chart[".chartXml"] .= '</attr>


<attr value="appearance">';
	$tdataalumnos_faltas_Chart[".chartXml"] .= '<attr value="scolor11">009300</attr>
	<attr value="scolor12">009300</attr>';

$tdataalumnos_faltas_Chart[".chartXml"] .= '<attr value="head">'.xmlencode("Ausentes").'</attr>
<attr value="foot">'.xmlencode("Mes en curso").'</attr>
<attr value="y_axis_label">'.xmlencode("injus").'</attr>

<attr value="color51">49563A</attr>
<attr value="color52">49563A</attr>
<attr value="color61">49563A</attr>
<attr value="color62">49563A</attr>
<attr value="color71">FFFFFF</attr>
<attr value="color72">FFFFFF</attr>
<attr value="color81">FEF7DB</attr>
<attr value="color82">FEF7DB</attr>
<attr value="color91">000000</attr>
<attr value="color92">000000</attr>
<attr value="color101">000000</attr>
<attr value="color102">000000</attr>
<attr value="color111">000000</attr>
<attr value="color112">000000</attr>
<attr value="color121"></attr>
<attr value="color122"></attr>
<attr value="color131">000000</attr>
<attr value="color132">000000</attr>
<attr value="color141">000000</attr>
<attr value="color142">000000</attr>

<attr value="slegend">true</attr>
<attr value="sgrid">true</attr>
<attr value="sname">true</attr>
<attr value="sval">true</attr>
<attr value="sanim">true</attr>
<attr value="sstacked">false</attr>
<attr value="saxes">false</attr>
<attr value="slog">false</attr>
<attr value="aqua">0</attr>
<attr value="cview">0</attr>
<attr value="is3d">1</attr>
<attr value="isstacked">1</attr>
<attr value="linestyle">0</attr>
<attr value="autoupdate">0</attr>
<attr value="autoupmin">5</attr>
<attr value="cscroll">true</attr>
<attr value="maxbarscroll">10</attr>';
$tdataalumnos_faltas_Chart[".chartXml"] .= '</attr>

<attr value="fields">';
	$tdataalumnos_faltas_Chart[".chartXml"] .= '<attr value="0">
		<attr value="name">fecha</attr>
		<attr value="label">'.xmlencode("Fecha").'</attr>
		<attr value="search"></attr>
	</attr>';
	$tdataalumnos_faltas_Chart[".chartXml"] .= '<attr value="1">
		<attr value="name">total</attr>
		<attr value="label">'.xmlencode("Total").'</attr>
		<attr value="search"></attr>
	</attr>';
	$tdataalumnos_faltas_Chart[".chartXml"] .= '<attr value="2">
		<attr value="name">tipo</attr>
		<attr value="label">'.xmlencode("Tipo").'</attr>
		<attr value="search"></attr>
	</attr>';
$tdataalumnos_faltas_Chart[".chartXml"] .= '</attr>


<attr value="settings">
<attr value="name">alumnos_faltas Chart</attr>
<attr value="short_table_name">alumnos_faltas_Chart</attr>
</attr>

</chart>';
	
$tables_data["alumnos_faltas Chart"]=&$tdataalumnos_faltas_Chart;
$field_labels["alumnos_faltas_Chart"] = &$fieldLabelsalumnos_faltas_Chart;
$fieldToolTips["alumnos_faltas Chart"] = &$fieldToolTipsalumnos_faltas_Chart;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["alumnos_faltas Chart"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["alumnos_faltas Chart"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_alumnos_faltas_Chart()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "fecha,  COUNT(fecha) AS total,  tipo";
$proto0["m_strFrom"] = "FROM alumnos_faltas";
$proto0["m_strWhere"] = "(MONTH(fecha) =MONTH(CURRENT_DATE()))";
$proto0["m_strOrderBy"] = "ORDER BY fecha DESC";
$proto0["m_strTail"] = "GROUP BY fecha, tipo";
$proto1=array();
$proto1["m_sql"] = "MONTH(fecha) =MONTH(CURRENT_DATE())";
$proto1["m_uniontype"] = "SQLL_UNKNOWN";
						$proto2=array();
$proto2["m_functiontype"] = "SQLF_CUSTOM";
$proto2["m_arguments"] = array();
						$obj = new SQLNonParsed(array(
	"m_sql" => "fecha"
));

$proto2["m_arguments"][]=$obj;
$proto2["m_strFunctionName"] = "MONTH";
$obj = new SQLFunctionCall($proto2);

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
$proto1["m_strCase"] = "=MONTH(CURRENT_DATE())";
$proto1["m_havingmode"] = "0";
$proto1["m_inBrackets"] = "0";
$proto1["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto1);

$proto0["m_where"] = $obj;
$proto4=array();
$proto4["m_sql"] = "";
$proto4["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto4["m_column"]=$obj;
$proto4["m_contained"] = array();
$proto4["m_strCase"] = "";
$proto4["m_havingmode"] = "0";
$proto4["m_inBrackets"] = "0";
$proto4["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto4);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto6=array();
			$obj = new SQLField(array(
	"m_strName" => "fecha",
	"m_strTable" => "alumnos_faltas"
));

$proto6["m_expr"]=$obj;
$proto6["m_alias"] = "";
$obj = new SQLFieldListItem($proto6);

$proto0["m_fieldlist"][]=$obj;
						$proto8=array();
			$proto9=array();
$proto9["m_functiontype"] = "SQLF_COUNT";
$proto9["m_arguments"] = array();
						$obj = new SQLField(array(
	"m_strName" => "fecha",
	"m_strTable" => "alumnos_faltas"
));

$proto9["m_arguments"][]=$obj;
$proto9["m_strFunctionName"] = "COUNT";
$obj = new SQLFunctionCall($proto9);

$proto8["m_expr"]=$obj;
$proto8["m_alias"] = "total";
$obj = new SQLFieldListItem($proto8);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "tipo",
	"m_strTable" => "alumnos_faltas"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto13=array();
$proto13["m_link"] = "SQLL_MAIN";
			$proto14=array();
$proto14["m_strName"] = "alumnos_faltas";
$proto14["m_columns"] = array();
$proto14["m_columns"][] = "dni";
$proto14["m_columns"][] = "fecha";
$proto14["m_columns"][] = "tipo";
$proto14["m_columns"][] = "injus";
$obj = new SQLTable($proto14);

$proto13["m_table"] = $obj;
$proto13["m_alias"] = "";
$proto15=array();
$proto15["m_sql"] = "";
$proto15["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto15["m_column"]=$obj;
$proto15["m_contained"] = array();
$proto15["m_strCase"] = "";
$proto15["m_havingmode"] = "0";
$proto15["m_inBrackets"] = "0";
$proto15["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto15);

$proto13["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto13);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
												$proto17=array();
						$obj = new SQLField(array(
	"m_strName" => "fecha",
	"m_strTable" => "alumnos_faltas"
));

$proto17["m_column"]=$obj;
$obj = new SQLGroupByItem($proto17);

$proto0["m_groupby"][]=$obj;
												$proto19=array();
						$obj = new SQLField(array(
	"m_strName" => "tipo",
	"m_strTable" => "alumnos_faltas"
));

$proto19["m_column"]=$obj;
$obj = new SQLGroupByItem($proto19);

$proto0["m_groupby"][]=$obj;
$proto0["m_orderby"] = array();
												$proto21=array();
						$obj = new SQLField(array(
	"m_strName" => "fecha",
	"m_strTable" => "alumnos_faltas"
));

$proto21["m_column"]=$obj;
$proto21["m_bAsc"] = 0;
$proto21["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto21);

$proto0["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto0);

return $obj;
}
$queryData_alumnos_faltas_Chart = createSqlQuery_alumnos_faltas_Chart();
$tdataalumnos_faltas_Chart[".sqlquery"] = $queryData_alumnos_faltas_Chart;



$tableEvents["alumnos_faltas Chart"] = new eventsBase;
$tdataalumnos_faltas_Chart[".hasEvents"] = false;

?>

