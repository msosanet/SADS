<?php
$strTableName="docentes";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="docentes";

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT dni,  apellido,  nombre,  identificacion";
$gsqlFrom="FROM docentes";
$gsqlWhereExpr="";
$gsqlTail="";

include_once(getabspath("include/docentes_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_docentes;
$eventObj = &$tableEvents["docentes"];

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>