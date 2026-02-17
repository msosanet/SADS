<?php
$strTableName="alumnos_faltas Chart";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="alumnos_faltas";

$gstrOrderBy="ORDER BY fecha DESC";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$g_orderindexes[] = array(1, (0 ? "ASC" : "DESC"), "fecha");
$gsqlHead="SELECT fecha,  COUNT(fecha) AS total,  tipo";
$gsqlFrom="FROM alumnos_faltas";
$gsqlWhereExpr="(MONTH(fecha) =MONTH(CURRENT_DATE()))";
$gsqlTail="GROUP BY fecha, tipo";

include_once(getabspath("include/alumnos_faltas_Chart_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_alumnos_faltas_Chart;
$eventObj = &$tableEvents["alumnos_faltas Chart"];

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>
