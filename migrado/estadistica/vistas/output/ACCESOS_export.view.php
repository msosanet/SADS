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
	header("Content-Disposition: attachment;Filename=ACCESOS.doc");

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
	header("Content-Disposition: attachment;Filename=ACCESOS.xml");
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
			$values["A"] = GetData($row,"A","");
			$values["B"] = GetData($row,"B","");
			$values["C"] = GetData($row,"C","");
			$values["D"] = GetData($row,"D","");
			$values["E"] = GetData($row,"E","");
			$values["F"] = GetData($row,"F","");
			$values["G"] = GetData($row,"G","");
		
		
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
	header("Content-Disposition: attachment;Filename=ACCESOS.csv");
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs);
	else
		$row = db_fetch_array($rs);	

// write header
	$outstr = "";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"A\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"B\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"C\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"D\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"E\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"F\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"G\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows < $nPageSize) && $row)
	{
		$values = array();
			$format = "";
			$values["A"] = GetData($row,"A",$format);
			$format = "";
			$values["B"] = GetData($row,"B",$format);
			$format = "";
			$values["C"] = GetData($row,"C",$format);
			$format = "";
			$values["D"] = GetData($row,"D",$format);
			$format = "";
			$values["E"] = GetData($row,"E",$format);
			$format = "";
			$values["F"] = GetData($row,"F",$format);
			$format = "";
			$values["G"] = GetData($row,"G",$format);

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
			$outstr.='"'.str_replace('"', '""', $values["A"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["B"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["C"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["D"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["E"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["F"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["G"]).'"';
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
		echo '<td style="width: 100" x:str>'.PrepareForExcel("A").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("B").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("C").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("D").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("E").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("F").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("G").'</td>';	
	}
	else
	{
		echo "<td>"."A"."</td>";
		echo "<td>"."B"."</td>";
		echo "<td>"."C"."</td>";
		echo "<td>"."D"."</td>";
		echo "<td>"."E"."</td>";
		echo "<td>"."F"."</td>";
		echo "<td>"."G"."</td>";
	}
	echo "</tr>";
			$totals = array();
		$totals["A"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"A", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["B"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"B", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["C"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"C", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["D"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"D", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["E"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"E", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["F"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"F", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["G"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"G", 'totalsType'=>'', 'viewFormat'=>"");
	
// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		countTotals($totals, $totalsFields, $row);
		
		$values = array();
	
					
							$format = "";
			
			$values["A"] = GetData($row,"A",$format);
					
							$format = "";
			
			$values["B"] = GetData($row,"B",$format);
					
							$format = "";
			
			$values["C"] = GetData($row,"C",$format);
					
							$format = "";
			
			$values["D"] = GetData($row,"D",$format);
					
							$format = "";
			
			$values["E"] = GetData($row,"E",$format);
					
							$format = "";
			
			$values["F"] = GetData($row,"F",$format);
					
							$format = "";
			
			$values["G"] = GetData($row,"G",$format);
		
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
									echo htmlspecialchars($values["A"]);
			echo '</td>';
							echo '<td>';
			
			
									$format="";
									echo htmlspecialchars($values["B"]);
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
			
									$format="";
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["C"]);
					else
						echo htmlspecialchars($values["C"]);
			echo '</td>';
							echo '<td>';
			
			
									$format="";
									echo htmlspecialchars($values["D"]);
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
			
									$format="";
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["E"]);
					else
						echo htmlspecialchars($values["E"]);
			echo '</td>';
							echo '<td>';
			
			
									$format="";
									echo htmlspecialchars($values["F"]);
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
			
									$format="";
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["G"]);
					else
						echo htmlspecialchars($values["G"]);
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

