<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/ausentes_variables.php");

$mode = postvalue("mode");

if(!@$_SESSION["UserID"])
{ 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	return;
}

include('include/xtempl.php');
$xt = new Xtempl();

$layout = new TLayout("detailspreview","PurificOrange","MobileOrange");
$layout->blocks["bare"] = array();
$layout->containers["0"] = array();

$layout->containers["0"][] = array("name"=>"detailspreviewheader","block"=>"","substyle"=>1);


$layout->containers["0"][] = array("name"=>"detailspreviewdetailsfount","block"=>"","substyle"=>1);


$layout->containers["0"][] = array("name"=>"detailspreviewdispfirst","block"=>"display_first","substyle"=>1);


$layout->skins["0"] = "empty";
$layout->blocks["bare"][] = "0";
$layout->containers["detailspreviewgrid"] = array();

$layout->containers["detailspreviewgrid"][] = array("name"=>"detailspreviewfields","block"=>"details_data","substyle"=>1);


$layout->skins["detailspreviewgrid"] = "grid";
$layout->blocks["bare"][] = "detailspreviewgrid";$page_layouts["ausentes_detailspreview"] = $layout;


$recordsCounter = 0;

//	process masterkey value
$mastertable = postvalue("mastertable");
if($mastertable!="")
{
	$_SESSION[$strTableName."_mastertable"]=$mastertable;
//	copy keys to session
	$i = 1;
	while(isset($_REQUEST["masterkey".$i]))
	{
		$_SESSION[$strTableName."_masterkey".$i]=$_REQUEST["masterkey".$i];
		$i++;
	}
	if(isset($_SESSION[$strTableName."_masterkey".$i]))
		unset($_SESSION[$strTableName."_masterkey".$i]);
}
else
	$mastertable = $_SESSION[$strTableName."_mastertable"];

//$strSQL = $gstrSQL;

if($mastertable == "docentes")
{
	$where = "";
		$where.= GetFullFieldName("codigo")."=".make_db_value("codigo",$_SESSION[$strTableName."_masterkey1"]);
}


$str = SecuritySQL("Search");
if(strlen($str))
	$where.=" and ".$str;
$strSQL = gSQLWhere($where);

$strSQL.=" ".$gstrOrderBy;

$rowcount = gSQLRowCount($where);

$xt->assign("row_count",$rowcount);
if($rowcount) {
	$xt->assign("details_data",true);
	$rs = db_query($strSQL,$conn);

	$display_count = 10;
	if($mode == "inline")
		$display_count*=2;
	if($rowcount>$display_count+2)
	{
		$xt->assign("display_first",true);
		$xt->assign("display_count",$display_count);
	}
	else
		$display_count = $rowcount;

	$rowinfo = array();
		
	while(($data = db_fetch_array($rs)) && $recordsCounter<$display_count) {
		$recordsCounter++;
		$row = array();
		$keylink = "";
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["codigo"]));

	
	//	codigo - 
		    $value = "";
				if (IsNumberType(GetFieldType("codigo")))
				$value = "<span class='runner-field-number'>".
						ProcessLargeText(GetData($data,"codigo", ""),"field=codigo".$keylink,"",MODE_PRINT)."</span>";
			else 
				$value = ProcessLargeText(GetData($data,"codigo", ""),"field=codigo".$keylink,"",MODE_PRINT);
			$row["codigo_value"] = $value;
	//	docente - 
		    $value = "";
				if (IsNumberType(GetFieldType("docente")))
				$value = "<span class='runner-field-number'>".
						ProcessLargeText(GetData($data,"docente", ""),"field=docente".$keylink,"",MODE_PRINT)."</span>";
			else 
				$value = ProcessLargeText(GetData($data,"docente", ""),"field=docente".$keylink,"",MODE_PRINT);
			$row["docente_value"] = $value;
	//	fecha_desde - Short Date
		    $value = "";
				if (IsNumberType(GetFieldType("fecha_desde")))
				$value = "<span class='runner-field-number'>".
						ProcessLargeText(GetData($data,"fecha_desde", "Short Date"),"field=fecha%5Fdesde".$keylink,"",MODE_PRINT)."</span>";
			else 
				$value = ProcessLargeText(GetData($data,"fecha_desde", "Short Date"),"field=fecha%5Fdesde".$keylink,"",MODE_PRINT);
			$row["fecha_desde_value"] = $value;
	//	fecha_hasta - Short Date
		    $value = "";
				if (IsNumberType(GetFieldType("fecha_hasta")))
				$value = "<span class='runner-field-number'>".
						ProcessLargeText(GetData($data,"fecha_hasta", "Short Date"),"field=fecha%5Fhasta".$keylink,"",MODE_PRINT)."</span>";
			else 
				$value = ProcessLargeText(GetData($data,"fecha_hasta", "Short Date"),"field=fecha%5Fhasta".$keylink,"",MODE_PRINT);
			$row["fecha_hasta_value"] = $value;
	//	motivo - 
		    $value = "";
				if (IsNumberType(GetFieldType("motivo")))
				$value = "<span class='runner-field-number'>".
						ProcessLargeText(GetData($data,"motivo", ""),"field=motivo".$keylink,"",MODE_PRINT)."</span>";
			else 
				$value = ProcessLargeText(GetData($data,"motivo", ""),"field=motivo".$keylink,"",MODE_PRINT);
			$row["motivo_value"] = $value;
	//	notifico - 
		    $value = "";
				if (IsNumberType(GetFieldType("notifico")))
				$value = "<span class='runner-field-number'>".
						ProcessLargeText(GetData($data,"notifico", ""),"field=notifico".$keylink,"",MODE_PRINT)."</span>";
			else 
				$value = ProcessLargeText(GetData($data,"notifico", ""),"field=notifico".$keylink,"",MODE_PRINT);
			$row["notifico_value"] = $value;
	$rowinfo[] = $row;
	}
	$xt->assign_loopsection("details_row",$rowinfo);
}

$xt->display("ausentes_detailspreview.htm");

if($mode!="inline"){
	echo "counterSeparator".postvalue("counter");
	$layout = GetPageLayout(GoodFieldName($strTableName), 'detailspreview');
	if($layout)
	{
		$rtl = $xt->getReadingOrder() == 'RTL' ? 'RTL' : '';
		echo "counterSeparator"."styles/".$layout->style."/style".$rtl
			."counterSeparator"."pagestyles/".$layout->name.$rtl
			."counterSeparator".$layout->style." page-".$layout->name;
	}	
}	
?>
