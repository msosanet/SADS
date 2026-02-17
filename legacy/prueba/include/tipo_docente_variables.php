<?php
$strTableName="tipo_docente";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="tipo_docente";

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT descripcion,  codigo";
$gsqlFrom="FROM tipo_docente";
$gsqlWhereExpr="";
$gsqlTail="";

include_once(getabspath("include/tipo_docente_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_tipo_docente;
$eventObj = &$tableEvents["tipo_docente"];

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>