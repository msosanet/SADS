<?php
$tdataACCESOS=array();
	$tdataACCESOS[".NumberOfChars"]=80; 
	$tdataACCESOS[".ShortName"]="ACCESOS";
	$tdataACCESOS[".OwnerID"]="";
	$tdataACCESOS[".OriginalTable"]="ACCESOS";


	
//	field labels
$fieldLabelsACCESOS = array();
if(mlang_getcurrentlang()=="Spanish")
{
	$fieldLabelsACCESOS["Spanish"]=array();
	$fieldToolTipsACCESOS["Spanish"]=array();
	$fieldLabelsACCESOS["Spanish"]["A"] = "A";
	$fieldToolTipsACCESOS["Spanish"]["A"] = "";
	$fieldLabelsACCESOS["Spanish"]["B"] = "B";
	$fieldToolTipsACCESOS["Spanish"]["B"] = "";
	$fieldLabelsACCESOS["Spanish"]["C"] = "C";
	$fieldToolTipsACCESOS["Spanish"]["C"] = "";
	$fieldLabelsACCESOS["Spanish"]["D"] = "D";
	$fieldToolTipsACCESOS["Spanish"]["D"] = "";
	$fieldLabelsACCESOS["Spanish"]["E"] = "E";
	$fieldToolTipsACCESOS["Spanish"]["E"] = "";
	$fieldLabelsACCESOS["Spanish"]["F"] = "F";
	$fieldToolTipsACCESOS["Spanish"]["F"] = "";
	$fieldLabelsACCESOS["Spanish"]["G"] = "G";
	$fieldToolTipsACCESOS["Spanish"]["G"] = "";
	if (count($fieldToolTipsACCESOS["Spanish"])){
		$tdataACCESOS[".isUseToolTips"]=true;
	}
}


	
	$tdataACCESOS[".NCSearch"]=true;

	

$tdataACCESOS[".shortTableName"] = "ACCESOS";
$tdataACCESOS[".nSecOptions"] = 0;
$tdataACCESOS[".recsPerRowList"] = 1;	
$tdataACCESOS[".tableGroupBy"] = "0";
$tdataACCESOS[".mainTableOwnerID"] = "";
$tdataACCESOS[".moveNext"] = 1;




$tdataACCESOS[".showAddInPopup"] = false;

$tdataACCESOS[".showEditInPopup"] = false;

$tdataACCESOS[".showViewInPopup"] = false;


$tdataACCESOS[".fieldsForRegister"] = array();

$tdataACCESOS[".listAjax"] = false;

	$tdataACCESOS[".audit"] = false;

	$tdataACCESOS[".locking"] = false;
	
$tdataACCESOS[".listIcons"] = true;

$tdataACCESOS[".exportTo"] = true;

$tdataACCESOS[".printFriendly"] = true;


$tdataACCESOS[".showSimpleSearchOptions"] = false;

$tdataACCESOS[".showSearchPanel"] = true;


if (isMobile()){
$tdataACCESOS[".isUseAjaxSuggest"] = false;
}else {
$tdataACCESOS[".isUseAjaxSuggest"] = true;
}

$tdataACCESOS[".rowHighlite"] = true;


// button handlers file names

$tdataACCESOS[".addPageEvents"] = false;


// use datepicker for search panel
$tdataACCESOS[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdataACCESOS[".isUseTimeForSearch"] = false;

$tdataACCESOS[".isUseiBox"] = false;



	



$tdataACCESOS[".isUseInlineJs"] = $tdataACCESOS[".isUseInlineAdd"] || $tdataACCESOS[".isUseInlineEdit"];

$tdataACCESOS[".allSearchFields"] = array();

$tdataACCESOS[".globSearchFields"][] = "A";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("A", $tdataACCESOS[".allSearchFields"]))
{
	$tdataACCESOS[".allSearchFields"][] = "A";	
}
$tdataACCESOS[".globSearchFields"][] = "B";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("B", $tdataACCESOS[".allSearchFields"]))
{
	$tdataACCESOS[".allSearchFields"][] = "B";	
}
$tdataACCESOS[".globSearchFields"][] = "C";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("C", $tdataACCESOS[".allSearchFields"]))
{
	$tdataACCESOS[".allSearchFields"][] = "C";	
}
$tdataACCESOS[".globSearchFields"][] = "D";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("D", $tdataACCESOS[".allSearchFields"]))
{
	$tdataACCESOS[".allSearchFields"][] = "D";	
}
$tdataACCESOS[".globSearchFields"][] = "E";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("E", $tdataACCESOS[".allSearchFields"]))
{
	$tdataACCESOS[".allSearchFields"][] = "E";	
}
$tdataACCESOS[".globSearchFields"][] = "F";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("F", $tdataACCESOS[".allSearchFields"]))
{
	$tdataACCESOS[".allSearchFields"][] = "F";	
}
$tdataACCESOS[".globSearchFields"][] = "G";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("G", $tdataACCESOS[".allSearchFields"]))
{
	$tdataACCESOS[".allSearchFields"][] = "G";	
}


$tdataACCESOS[".googleLikeFields"][] = "A";
$tdataACCESOS[".googleLikeFields"][] = "B";
$tdataACCESOS[".googleLikeFields"][] = "C";
$tdataACCESOS[".googleLikeFields"][] = "D";
$tdataACCESOS[".googleLikeFields"][] = "E";
$tdataACCESOS[".googleLikeFields"][] = "F";
$tdataACCESOS[".googleLikeFields"][] = "G";



$tdataACCESOS[".advSearchFields"][] = "A";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("A", $tdataACCESOS[".allSearchFields"])) 
{
	$tdataACCESOS[".allSearchFields"][] = "A";	
}
$tdataACCESOS[".advSearchFields"][] = "B";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("B", $tdataACCESOS[".allSearchFields"])) 
{
	$tdataACCESOS[".allSearchFields"][] = "B";	
}
$tdataACCESOS[".advSearchFields"][] = "C";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("C", $tdataACCESOS[".allSearchFields"])) 
{
	$tdataACCESOS[".allSearchFields"][] = "C";	
}
$tdataACCESOS[".advSearchFields"][] = "D";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("D", $tdataACCESOS[".allSearchFields"])) 
{
	$tdataACCESOS[".allSearchFields"][] = "D";	
}
$tdataACCESOS[".advSearchFields"][] = "E";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("E", $tdataACCESOS[".allSearchFields"])) 
{
	$tdataACCESOS[".allSearchFields"][] = "E";	
}
$tdataACCESOS[".advSearchFields"][] = "F";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("F", $tdataACCESOS[".allSearchFields"])) 
{
	$tdataACCESOS[".allSearchFields"][] = "F";	
}
$tdataACCESOS[".advSearchFields"][] = "G";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("G", $tdataACCESOS[".allSearchFields"])) 
{
	$tdataACCESOS[".allSearchFields"][] = "G";	
}

$tdataACCESOS[".isTableType"] = "list";


	



// Access doesn't support subqueries from the same table as main
$tdataACCESOS[".subQueriesSupAccess"] = true;





$tdataACCESOS[".pageSize"] = 20;

$gstrOrderBy = "";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataACCESOS[".strOrderBy"] = $gstrOrderBy;
	
$tdataACCESOS[".orderindexes"] = array();

$tdataACCESOS[".sqlHead"] = "SELECT A,   B,   C,   D,   E,   F,   G";
$tdataACCESOS[".sqlFrom"] = "FROM ACCESOS";
$tdataACCESOS[".sqlWhereExpr"] = "";
$tdataACCESOS[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdataACCESOS[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdataACCESOS[".arrGroupsPerPage"] = $arrGPP;

	$tableKeys = array();
	$tdataACCESOS[".Keys"] = $tableKeys;

$tdataACCESOS[".listFields"] = array();
$tdataACCESOS[".listFields"][] = "A";
$tdataACCESOS[".listFields"][] = "B";
$tdataACCESOS[".listFields"][] = "C";
$tdataACCESOS[".listFields"][] = "D";
$tdataACCESOS[".listFields"][] = "E";
$tdataACCESOS[".listFields"][] = "F";
$tdataACCESOS[".listFields"][] = "G";

$tdataACCESOS[".addFields"] = array();
$tdataACCESOS[".addFields"][] = "A";
$tdataACCESOS[".addFields"][] = "B";
$tdataACCESOS[".addFields"][] = "C";
$tdataACCESOS[".addFields"][] = "D";
$tdataACCESOS[".addFields"][] = "E";
$tdataACCESOS[".addFields"][] = "F";
$tdataACCESOS[".addFields"][] = "G";

$tdataACCESOS[".inlineAddFields"] = array();
$tdataACCESOS[".inlineAddFields"][] = "A";
$tdataACCESOS[".inlineAddFields"][] = "B";
$tdataACCESOS[".inlineAddFields"][] = "C";
$tdataACCESOS[".inlineAddFields"][] = "D";
$tdataACCESOS[".inlineAddFields"][] = "E";
$tdataACCESOS[".inlineAddFields"][] = "F";
$tdataACCESOS[".inlineAddFields"][] = "G";

$tdataACCESOS[".editFields"] = array();
$tdataACCESOS[".editFields"][] = "A";
$tdataACCESOS[".editFields"][] = "B";
$tdataACCESOS[".editFields"][] = "C";
$tdataACCESOS[".editFields"][] = "D";
$tdataACCESOS[".editFields"][] = "E";
$tdataACCESOS[".editFields"][] = "F";
$tdataACCESOS[".editFields"][] = "G";

$tdataACCESOS[".inlineEditFields"] = array();
$tdataACCESOS[".inlineEditFields"][] = "A";
$tdataACCESOS[".inlineEditFields"][] = "B";
$tdataACCESOS[".inlineEditFields"][] = "C";
$tdataACCESOS[".inlineEditFields"][] = "D";
$tdataACCESOS[".inlineEditFields"][] = "E";
$tdataACCESOS[".inlineEditFields"][] = "F";
$tdataACCESOS[".inlineEditFields"][] = "G";

	
//	A
	$fdata = array();
	$fdata["strName"] = "A";
	$fdata["ownerTable"] = "ACCESOS";
	$fdata["Label"]="A"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "A";
	
		$fdata["FullName"]= "A";
	
		
		
		
		
		
				$fdata["Index"]= 1;
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
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdataACCESOS["A"]=$fdata;
//	B
	$fdata = array();
	$fdata["strName"] = "B";
	$fdata["ownerTable"] = "ACCESOS";
	$fdata["Label"]="B"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "B";
	
		$fdata["FullName"]= "B";
	
		
		
		
		
		
				$fdata["Index"]= 2;
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
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdataACCESOS["B"]=$fdata;
//	C
	$fdata = array();
	$fdata["strName"] = "C";
	$fdata["ownerTable"] = "ACCESOS";
	$fdata["Label"]="C"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "C";
	
		$fdata["FullName"]= "C";
	
		
		
		
		
		
				$fdata["Index"]= 3;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=8";
		
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
	
		
				
		
		
		
			$tdataACCESOS["C"]=$fdata;
//	D
	$fdata = array();
	$fdata["strName"] = "D";
	$fdata["ownerTable"] = "ACCESOS";
	$fdata["Label"]="D"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "D";
	
		$fdata["FullName"]= "D";
	
		
		
		
		
		
				$fdata["Index"]= 4;
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
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdataACCESOS["D"]=$fdata;
//	E
	$fdata = array();
	$fdata["strName"] = "E";
	$fdata["ownerTable"] = "ACCESOS";
	$fdata["Label"]="E"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "E";
	
		$fdata["FullName"]= "E";
	
		
		
		
		
		
				$fdata["Index"]= 5;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=1";
		
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
	
		
				
		
		
		
			$tdataACCESOS["E"]=$fdata;
//	F
	$fdata = array();
	$fdata["strName"] = "F";
	$fdata["ownerTable"] = "ACCESOS";
	$fdata["Label"]="F"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "F";
	
		$fdata["FullName"]= "F";
	
		
		
		
		
		
				$fdata["Index"]= 6;
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
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdataACCESOS["F"]=$fdata;
//	G
	$fdata = array();
	$fdata["strName"] = "G";
	$fdata["ownerTable"] = "ACCESOS";
	$fdata["Label"]="G"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "G";
	
		$fdata["FullName"]= "G";
	
		
		
		
		
		
				$fdata["Index"]= 7;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=7";
		
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
	
		
				
		
		
		
			$tdataACCESOS["G"]=$fdata;


	
$tables_data["ACCESOS"]=&$tdataACCESOS;
$field_labels["ACCESOS"] = &$fieldLabelsACCESOS;
$fieldToolTips["ACCESOS"] = &$fieldToolTipsACCESOS;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["ACCESOS"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["ACCESOS"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_ACCESOS()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "A,   B,   C,   D,   E,   F,   G";
$proto0["m_strFrom"] = "FROM ACCESOS";
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
	"m_strName" => "A",
	"m_strTable" => "ACCESOS"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "B",
	"m_strTable" => "ACCESOS"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "C",
	"m_strTable" => "ACCESOS"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "D",
	"m_strTable" => "ACCESOS"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "E",
	"m_strTable" => "ACCESOS"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "F",
	"m_strTable" => "ACCESOS"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "G",
	"m_strTable" => "ACCESOS"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto19=array();
$proto19["m_link"] = "SQLL_MAIN";
			$proto20=array();
$proto20["m_strName"] = "ACCESOS";
$proto20["m_columns"] = array();
$proto20["m_columns"][] = "A";
$proto20["m_columns"][] = "B";
$proto20["m_columns"][] = "C";
$proto20["m_columns"][] = "D";
$proto20["m_columns"][] = "E";
$proto20["m_columns"][] = "F";
$proto20["m_columns"][] = "G";
$obj = new SQLTable($proto20);

$proto19["m_table"] = $obj;
$proto19["m_alias"] = "";
$proto21=array();
$proto21["m_sql"] = "";
$proto21["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto21["m_column"]=$obj;
$proto21["m_contained"] = array();
$proto21["m_strCase"] = "";
$proto21["m_havingmode"] = "0";
$proto21["m_inBrackets"] = "0";
$proto21["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto21);

$proto19["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto19);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

return $obj;
}
$queryData_ACCESOS = createSqlQuery_ACCESOS();
$tdataACCESOS[".sqlquery"] = $queryData_ACCESOS;



$tableEvents["ACCESOS"] = new eventsBase;
$tdataACCESOS[".hasEvents"] = false;

?>

