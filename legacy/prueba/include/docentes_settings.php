<?php
$tdatadocentes=array();
	$tdatadocentes[".NumberOfChars"]=80; 
	$tdatadocentes[".ShortName"]="docentes";
	$tdatadocentes[".OwnerID"]="";
	$tdatadocentes[".OriginalTable"]="docentes";


	
//	field labels
$fieldLabelsdocentes = array();
if(mlang_getcurrentlang()=="Spanish")
{
	$fieldLabelsdocentes["Spanish"]=array();
	$fieldToolTipsdocentes["Spanish"]=array();
	$fieldLabelsdocentes["Spanish"]["dni"] = "Dni";
	$fieldToolTipsdocentes["Spanish"]["dni"] = "";
	$fieldLabelsdocentes["Spanish"]["apellido"] = "Apellido";
	$fieldToolTipsdocentes["Spanish"]["apellido"] = "";
	$fieldLabelsdocentes["Spanish"]["nombre"] = "Nombre";
	$fieldToolTipsdocentes["Spanish"]["nombre"] = "";
	$fieldLabelsdocentes["Spanish"]["identificacion"] = "Identificacion";
	$fieldToolTipsdocentes["Spanish"]["identificacion"] = "";
	if (count($fieldToolTipsdocentes["Spanish"])){
		$tdatadocentes[".isUseToolTips"]=true;
	}
}


	
	$tdatadocentes[".NCSearch"]=true;

	

$tdatadocentes[".shortTableName"] = "docentes";
$tdatadocentes[".nSecOptions"] = 0;
$tdatadocentes[".recsPerRowList"] = 1;	
$tdatadocentes[".tableGroupBy"] = "0";
$tdatadocentes[".mainTableOwnerID"] = "";
$tdatadocentes[".moveNext"] = 1;




$tdatadocentes[".showAddInPopup"] = false;

$tdatadocentes[".showEditInPopup"] = false;

$tdatadocentes[".showViewInPopup"] = false;


$tdatadocentes[".fieldsForRegister"] = array();

$tdatadocentes[".listAjax"] = false;

	$tdatadocentes[".audit"] = false;

	$tdatadocentes[".locking"] = false;
	
$tdatadocentes[".listIcons"] = true;
$tdatadocentes[".edit"] = true;
$tdatadocentes[".inlineEdit"] = true;
$tdatadocentes[".view"] = true;

$tdatadocentes[".exportTo"] = true;

$tdatadocentes[".printFriendly"] = true;

$tdatadocentes[".delete"] = true;

$tdatadocentes[".showSimpleSearchOptions"] = false;

$tdatadocentes[".showSearchPanel"] = true;


if (isMobile()){
$tdatadocentes[".isUseAjaxSuggest"] = false;
}else {
$tdatadocentes[".isUseAjaxSuggest"] = true;
}

$tdatadocentes[".rowHighlite"] = true;


// button handlers file names

$tdatadocentes[".addPageEvents"] = false;

$tdatadocentes[".arrKeyFields"][] = "dni";

// use datepicker for search panel
$tdatadocentes[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdatadocentes[".isUseTimeForSearch"] = false;

$tdatadocentes[".isUseiBox"] = false;



	

$tdatadocentes[".useDetailsPreview"] = true;	

$tdatadocentes[".isUseInlineAdd"] = true;

$tdatadocentes[".isUseInlineEdit"] = true;
$tdatadocentes[".isUseInlineJs"] = $tdatadocentes[".isUseInlineAdd"] || $tdatadocentes[".isUseInlineEdit"];

$tdatadocentes[".allSearchFields"] = array();

$tdatadocentes[".globSearchFields"][] = "dni";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("dni", $tdatadocentes[".allSearchFields"]))
{
	$tdatadocentes[".allSearchFields"][] = "dni";	
}
$tdatadocentes[".globSearchFields"][] = "apellido";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("apellido", $tdatadocentes[".allSearchFields"]))
{
	$tdatadocentes[".allSearchFields"][] = "apellido";	
}
$tdatadocentes[".globSearchFields"][] = "nombre";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("nombre", $tdatadocentes[".allSearchFields"]))
{
	$tdatadocentes[".allSearchFields"][] = "nombre";	
}
$tdatadocentes[".globSearchFields"][] = "identificacion";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("identificacion", $tdatadocentes[".allSearchFields"]))
{
	$tdatadocentes[".allSearchFields"][] = "identificacion";	
}


$tdatadocentes[".googleLikeFields"][] = "dni";
$tdatadocentes[".googleLikeFields"][] = "apellido";
$tdatadocentes[".googleLikeFields"][] = "nombre";
$tdatadocentes[".googleLikeFields"][] = "identificacion";



$tdatadocentes[".advSearchFields"][] = "dni";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("dni", $tdatadocentes[".allSearchFields"])) 
{
	$tdatadocentes[".allSearchFields"][] = "dni";	
}
$tdatadocentes[".advSearchFields"][] = "apellido";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("apellido", $tdatadocentes[".allSearchFields"])) 
{
	$tdatadocentes[".allSearchFields"][] = "apellido";	
}
$tdatadocentes[".advSearchFields"][] = "nombre";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("nombre", $tdatadocentes[".allSearchFields"])) 
{
	$tdatadocentes[".allSearchFields"][] = "nombre";	
}
$tdatadocentes[".advSearchFields"][] = "identificacion";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("identificacion", $tdatadocentes[".allSearchFields"])) 
{
	$tdatadocentes[".allSearchFields"][] = "identificacion";	
}

$tdatadocentes[".isTableType"] = "list";


	



// Access doesn't support subqueries from the same table as main
$tdatadocentes[".subQueriesSupAccess"] = true;

		



$tdatadocentes[".pageSize"] = 20;

$gstrOrderBy = "";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdatadocentes[".strOrderBy"] = $gstrOrderBy;
	
$tdatadocentes[".orderindexes"] = array();

$tdatadocentes[".sqlHead"] = "SELECT dni,  apellido,  nombre,  identificacion";
$tdatadocentes[".sqlFrom"] = "FROM docentes";
$tdatadocentes[".sqlWhereExpr"] = "";
$tdatadocentes[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatadocentes[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatadocentes[".arrGroupsPerPage"] = $arrGPP;

	$tableKeys = array();
	$tableKeys[] = "dni";
	$tdatadocentes[".Keys"] = $tableKeys;

$tdatadocentes[".listFields"] = array();
$tdatadocentes[".listFields"][] = "dni";
$tdatadocentes[".listFields"][] = "apellido";
$tdatadocentes[".listFields"][] = "nombre";
$tdatadocentes[".listFields"][] = "identificacion";

$tdatadocentes[".addFields"] = array();
$tdatadocentes[".addFields"][] = "dni";
$tdatadocentes[".addFields"][] = "apellido";
$tdatadocentes[".addFields"][] = "nombre";
$tdatadocentes[".addFields"][] = "identificacion";

$tdatadocentes[".inlineAddFields"] = array();
$tdatadocentes[".inlineAddFields"][] = "dni";
$tdatadocentes[".inlineAddFields"][] = "apellido";
$tdatadocentes[".inlineAddFields"][] = "nombre";
$tdatadocentes[".inlineAddFields"][] = "identificacion";

$tdatadocentes[".editFields"] = array();
$tdatadocentes[".editFields"][] = "dni";
$tdatadocentes[".editFields"][] = "apellido";
$tdatadocentes[".editFields"][] = "nombre";
$tdatadocentes[".editFields"][] = "identificacion";

$tdatadocentes[".inlineEditFields"] = array();
$tdatadocentes[".inlineEditFields"][] = "dni";
$tdatadocentes[".inlineEditFields"][] = "apellido";
$tdatadocentes[".inlineEditFields"][] = "nombre";
$tdatadocentes[".inlineEditFields"][] = "identificacion";

	
//	dni
	$fdata = array();
	$fdata["strName"] = "dni";
	$fdata["ownerTable"] = "docentes";
	$fdata["Label"]="Dni"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "dni";
	
		$fdata["FullName"]= "dni";
	
		
		
		
		
		
				$fdata["Index"]= 1;
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
	
		
				
		
		
		
			$tdatadocentes["dni"]=$fdata;
//	apellido
	$fdata = array();
	$fdata["strName"] = "apellido";
	$fdata["ownerTable"] = "docentes";
	$fdata["Label"]="Apellido"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "apellido";
	
		$fdata["FullName"]= "apellido";
	
		
		
		
		
		
				$fdata["Index"]= 2;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=70";
		
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
	
		
				
		
		
		
			$tdatadocentes["apellido"]=$fdata;
//	nombre
	$fdata = array();
	$fdata["strName"] = "nombre";
	$fdata["ownerTable"] = "docentes";
	$fdata["Label"]="Nombre"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "nombre";
	
		$fdata["FullName"]= "nombre";
	
		
		
		
		
		
				$fdata["Index"]= 3;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=70";
		
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
	
		
				
		
		
		
			$tdatadocentes["nombre"]=$fdata;
//	identificacion
	$fdata = array();
	$fdata["strName"] = "identificacion";
	$fdata["ownerTable"] = "docentes";
	$fdata["Label"]="Identificacion"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "identificacion";
	
		$fdata["FullName"]= "identificacion";
	
		$fdata["IsRequired"]=true; 
	
		
		
		
		
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
						$fdata["validateAs"]["basicValidate"][] = "IsRequired";
	
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatadocentes["identificacion"]=$fdata;


	
$tables_data["docentes"]=&$tdatadocentes;
$field_labels["docentes"] = &$fieldLabelsdocentes;
$fieldToolTips["docentes"] = &$fieldToolTipsdocentes;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["docentes"] = array();
$dIndex = 1-1;
			$strOriginalDetailsTable="ausentes";
	$detailsTablesData["docentes"][$dIndex] = array(
		  "dDataSourceTable"=>"ausentes"
		, "dOriginalTable"=>$strOriginalDetailsTable
		, "dShortTable"=>"ausentes"
		, "masterKeys"=>array()
		, "detailKeys"=>array()
		, "dispChildCount"=> "1"
		, "hideChild"=>"0"
		, "sqlHead"=>"SELECT codigo,  docente,  fecha_desde,  fecha_hasta,  motivo,  notifico"	
		, "sqlFrom"=>"FROM ausentes"	
		, "sqlWhere"=>""
		, "sqlTail"=>""
		, "groupBy"=>"0"
		, "previewOnList" => 1
		, "previewOnAdd" => 0
		, "previewOnEdit" => 0
		, "previewOnView" => 0
	);
	
		
		$detailsTablesData["docentes"][$dIndex]["masterKeys"][]="dni";
		$detailsTablesData["docentes"][$dIndex]["detailKeys"][]="codigo";

$dIndex = 2-1;
			$strOriginalDetailsTable="justificados";
	$detailsTablesData["docentes"][$dIndex] = array(
		  "dDataSourceTable"=>"justificados"
		, "dOriginalTable"=>$strOriginalDetailsTable
		, "dShortTable"=>"justificados"
		, "masterKeys"=>array()
		, "detailKeys"=>array()
		, "dispChildCount"=> "1"
		, "hideChild"=>"0"
		, "sqlHead"=>"SELECT codigo,  docente,  fecha_desde,  fecha_hasta,  motivo"	
		, "sqlFrom"=>"FROM justificados"	
		, "sqlWhere"=>""
		, "sqlTail"=>""
		, "groupBy"=>"0"
		, "previewOnList" => 1
		, "previewOnAdd" => 0
		, "previewOnEdit" => 0
		, "previewOnView" => 0
	);
	
		
		$detailsTablesData["docentes"][$dIndex]["masterKeys"][]="dni";
		$detailsTablesData["docentes"][$dIndex]["detailKeys"][]="codigo";


	
// tables which are master tables for current table (detail)
$masterTablesData["docentes"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_docentes()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "dni,  apellido,  nombre,  identificacion";
$proto0["m_strFrom"] = "FROM docentes";
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
	"m_strName" => "dni",
	"m_strTable" => "docentes"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "apellido",
	"m_strTable" => "docentes"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "nombre",
	"m_strTable" => "docentes"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "identificacion",
	"m_strTable" => "docentes"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto13=array();
$proto13["m_link"] = "SQLL_MAIN";
			$proto14=array();
$proto14["m_strName"] = "docentes";
$proto14["m_columns"] = array();
$proto14["m_columns"][] = "dni";
$proto14["m_columns"][] = "apellido";
$proto14["m_columns"][] = "nombre";
$proto14["m_columns"][] = "direccion";
$proto14["m_columns"][] = "telefono";
$proto14["m_columns"][] = "identificacion";
$proto14["m_columns"][] = "numero";
$proto14["m_columns"][] = "sexo";
$proto14["m_columns"][] = "piso";
$proto14["m_columns"][] = "depto";
$proto14["m_columns"][] = "barrio";
$proto14["m_columns"][] = "celular";
$proto14["m_columns"][] = "mail";
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
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

return $obj;
}
$queryData_docentes = createSqlQuery_docentes();
$tdatadocentes[".sqlquery"] = $queryData_docentes;



$tableEvents["docentes"] = new eventsBase;
$tdatadocentes[".hasEvents"] = false;

?>
