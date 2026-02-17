<?php
$strTableName="justificados";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="justificados";

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT codigo,  docente,  fecha_desde,  fecha_hasta,  motivo";
$gsqlFrom="FROM justificados";
$gsqlWhereExpr="";
$gsqlTail="";

include_once(getabspath("include/justificados_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_justificados;
$eventObj = &$tableEvents["justificados"];

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>
