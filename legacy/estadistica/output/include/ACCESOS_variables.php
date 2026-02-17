<?php
$strTableName="ACCESOS";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="ACCESOS";

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT A,   B,   C,   D,   E,   F,   G";
$gsqlFrom="FROM ACCESOS";
$gsqlWhereExpr="";
$gsqlTail="";

include_once(getabspath("include/ACCESOS_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_ACCESOS;
$eventObj = &$tableEvents["ACCESOS"];

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>