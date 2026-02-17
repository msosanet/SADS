<html>";
	echo "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">";
	
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData();

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToWord()
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=ausentes.doc");

	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData();

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToXML()
{
	global $nPageSize,$rs,$strTableName,$conn,$eventObj;
	header("Content-Type: text/xml");
	header("Content-Disposition: attachment;Filename=ausentes.xml");
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs);
	else
		$row = db_fetch_array($rs);	
	//if(!$row)
	//	return;
		
	global $cCharset;
	
	echo "<?xml version=\"1.0\" encoding=\"".$cCharset."\" standalone=\"yes\"?>\r\n";
	echo "<table>\r\n";
	$i=0;
	
	
	while((!$nPageSize || $i<$nPageSize) && $row)
	{
		
		$values = array();
			$values["codigo"] = GetData($row,"codigo","");
			$values["docente"] = GetData($row,"docente","");
			$values["fecha_desde"] = GetData($row,"fecha_desde","");
			$values["fecha_hasta"] = GetData($row,"fecha_hasta","");
			$values["motivo"] = GetData($row,"motivo","");
			$values["notifico"] = GetData($row,"notifico","");
		
		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{			
			$eventRes = $eventObj->BeforeOut($row, $values);
		}
		if ($eventRes)
		{
			$i++;
			echo "<row>\r\n";
			foreach ($values as $fName => $val)
			{
				$field = htmlspecialchars(XMLNameEncode($fName));
				echo "<".$field.">";
				echo htmlspecialchars($values[$fName]);
				echo "</".$field.">\r\n";
			}
			echo "</row>\r\n";
		}
		
		
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs);
		else
			$row = db_fetch_array($rs);	
	}
	echo "</table>\r\n";
}

function ExportToCSV()
{
	global $rs,$nPageSize,$strTableName,$conn,$eventObj;
	header("Content-Type: application/csv");
	header("Content-Disposition: attachment;Filename=ausentes.csv");
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs);
	else
		$row = db_fetch_array($rs);	

// write header
	$outstr = "";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"codigo\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"docente\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"fecha_desde\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"fecha_hasta\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"motivo\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"notifico\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows < $nPageSize) && $row)
	{
		$values = array();
			$format = "";
			$values["codigo"] = GetData($row,"codigo",$format);
			$format = "";
			$values["docente"] = GetData($row,"docente",$format);
			$format = "Short Date";
			$values["fecha_desde"] = GetData($row,"fecha_desde",$format);
			$format = "Short Date";
			$values["fecha_hasta"] = GetData($row,"fecha_hasta",$format);
			$format = "";
			$values["motivo"] = GetData($row,"motivo",$format);
			$format = "";
			$values["notifico"] = GetData($row,"notifico",$format);

		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{
			$eventRes = $eventObj->BeforeOut($row,$values);
		}
		if ($eventRes)
		{
			$outstr="";
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["codigo"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["docente"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["fecha_desde"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["fecha_hasta"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["motivo"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["notifico"]).'"';
			echo $outstr;
		}
		
		$iNumberOfRows++;
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs);
		else
			$row = db_fetch_array($rs);	
			
		if(((!$nPageSize || $iNumberOfRows<$nPageSize) && $row) && $eventRes)
			echo "\r\n";
	}
}


function WriteTableData()
{
	global $rs,$nPageSize,$strTableName,$conn,$eventObj;
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs);
	else
		$row = db_fetch_array($rs);	
//	if(!$row)
//		return;
// write header
	echo "<tr>";
	if($_REQUEST["type"]=="excel")
	{
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Codigo").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Docente").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Fecha Desde").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Fecha Hasta").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Motivo").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Notifico").'</td>';	
	}
	else
	{
		echo "<td>"."Codigo"."</td>";
		echo "<td>"."Docente"."</td>";
		echo "<td>"."Fecha Desde"."</td>";
		echo "<td>"."Fecha Hasta"."</td>";
		echo "<td>"."Motivo"."</td>";
		echo "<td>"."Notifico"."</td>";
	}
	echo "</tr>";
			$totals = array();
		$totals["codigo"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"codigo", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["docente"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"docente", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["fecha_desde"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"fecha_desde", 'totalsType'=>'', 'viewFormat'=>"Short Date");
			$totals["fecha_hasta"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"fecha_hasta", 'totalsType'=>'', 'viewFormat'=>"Short Date");
			$totals["motivo"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"motivo", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["notifico"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"notifico", 'totalsType'=>'', 'viewFormat'=>"");
	
// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		countTotals($totals, $totalsFields, $row);
		
		$values = array();
	
					
							$format = "";
			
			$values["codigo"] = GetData($row,"codigo",$format);
					
							$format = "";
			
			$values["docente"] = GetData($row,"docente",$format);
					
							$format = "Short Date";
			
			$values["fecha_desde"] = GetData($row,"fecha_desde",$format);
					
							$format = "Short Date";
			
			$values["fecha_hasta"] = GetData($row,"fecha_hasta",$format);
					
							$format = "";
			
			$values["motivo"] = GetData($row,"motivo",$format);
					
							$format = "";
			
			$values["notifico"] = GetData($row,"notifico",$format);
		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{
			$eventRes = $eventObj->BeforeOut($row, $values);
		}
		if ($eventRes)
		{
			$iNumberOfRows++;
			echo "<tr>";
		
							echo '<td>';
			
			
									$format="";
									echo htmlspecialchars($values["codigo"]);
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
			
									$format="";
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["docente"]);
					else
						echo htmlspecialchars($values["docente"]);
			echo '</td>';
							echo '<td>';
			
			
									$format="Short Date";
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["fecha_desde"]);
					else
						echo htmlspecialchars($values["fecha_desde"]);
			echo '</td>';
							echo '<td>';
			
			
									$format="Short Date";
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["fecha_hasta"]);
					else
						echo htmlspecialchars($values["fecha_hasta"]);
			echo '</td>';
							echo '<td>';
			
			
									$format="";
									echo htmlspecialchars($values["motivo"]);
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
			
									$format="";
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["notifico"]);
					else
						echo htmlspecialchars($values["notifico"]);
			echo '</td>';
			echo "</tr>";
		}
		
		
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs);
		else
			$row = db_fetch_array($rs);	
	}
	
}

function XMLNameEncode($strValue)
{
	$search = array(" ","#","'","/","\\","(",")",",","[");
	$ret = str_replace($search,"",$strValue);
	$search = array("]","+","\"","-","_","|","}","{","=");
	$ret = str_replace($search,"",$ret);
	return $ret;
}

function PrepareForExcel($str)
{
	$ret = htmlspecialchars($str);
	if (substr($ret,0,1)== "=") 
		$ret = "&#61;".substr($ret,1);
	return $ret;

}

function countTotals(&$totals, $totalsFields, $data)
{
	for($i = 0; $i < count($totalsFields); $i ++) 
	{
		if($totalsFields[$i]['totalsType'] == 'COUNT') 
			$totals[$totalsFields[$i]['fName']]["value"] += ($data[$totalsFields[$i]['fName']]!= "");
		else if($totalsFields[$i]['viewFormat'] == "Time") 
		{
			$time = GetTotalsForTime($data[$totalsFields[$i]['fName']]);
			$totals[$totalsFields[$i]['fName']]["value"] += $time[2]+$time[1]*60 + $time[0]*3600;
		} 
		else 
			$totals[$totalsFields[$i]['fName']]["value"] += ($data[$totalsFields[$i]['fName']]+ 0);
		
		if($totalsFields[$i]['totalsType'] == 'AVERAGE')
		{
			if(!is_null($data[$totalsFields[$i]['fName']]) && $data[$totalsFields[$i]['fName']]!=="")
				$totals[$totalsFields[$i]['fName']]['numRows']++;
		}
	}
}
?>

