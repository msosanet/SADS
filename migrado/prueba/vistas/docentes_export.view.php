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
	header("Content-Disposition: attachment;Filename=docentes.doc");

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
	header("Content-Disposition: attachment;Filename=docentes.xml");
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
			$values["dni"] = GetData($row,"dni","");
			$values["apellido"] = GetData($row,"apellido","");
			$values["nombre"] = GetData($row,"nombre","");
			$values["identificacion"] = GetData($row,"identificacion","");
		
		
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
	header("Content-Disposition: attachment;Filename=docentes.csv");
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs);
	else
		$row = db_fetch_array($rs);	

// write header
	$outstr = "";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"dni\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"apellido\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"nombre\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"identificacion\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows < $nPageSize) && $row)
	{
		$values = array();
			$format = "";
			$values["dni"] = GetData($row,"dni",$format);
			$format = "";
			$values["apellido"] = GetData($row,"apellido",$format);
			$format = "";
			$values["nombre"] = GetData($row,"nombre",$format);
			$format = "";
			$values["identificacion"] = GetData($row,"identificacion",$format);

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
			$outstr.='"'.str_replace('"', '""', $values["dni"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["apellido"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["nombre"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["identificacion"]).'"';
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
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Dni").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Apellido").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Nombre").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Identificacion").'</td>';	
	}
	else
	{
		echo "<td>"."Dni"."</td>";
		echo "<td>"."Apellido"."</td>";
		echo "<td>"."Nombre"."</td>";
		echo "<td>"."Identificacion"."</td>";
	}
	echo "</tr>";
			$totals = array();
		$totals["dni"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"dni", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["apellido"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"apellido", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["nombre"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"nombre", 'totalsType'=>'', 'viewFormat'=>"");
			$totals["identificacion"] = array("value" => 0, "numRows" => 0);
		$totalsFields[] = array('fName'=>"identificacion", 'totalsType'=>'', 'viewFormat'=>"");
	
// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		countTotals($totals, $totalsFields, $row);
		
		$values = array();
	
					
							$format = "";
			
			$values["dni"] = GetData($row,"dni",$format);
					
							$format = "";
			
			$values["apellido"] = GetData($row,"apellido",$format);
					
							$format = "";
			
			$values["nombre"] = GetData($row,"nombre",$format);
					
							$format = "";
			
			$values["identificacion"] = GetData($row,"identificacion",$format);
		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{
			$eventRes = $eventObj->BeforeOut($row, $values);
		}
		if ($eventRes)
		{
			$iNumberOfRows++;
			echo "<tr>";
		
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
			
									$format="";
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["dni"]);
					else
						echo htmlspecialchars($values["dni"]);
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
			
									$format="";
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["apellido"]);
					else
						echo htmlspecialchars($values["apellido"]);
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
			
									$format="";
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["nombre"]);
					else
						echo htmlspecialchars($values["nombre"]);
			echo '</td>';
							echo '<td>';
			
			
									$format="";
									echo htmlspecialchars($values["identificacion"]);
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

