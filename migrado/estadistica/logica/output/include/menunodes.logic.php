<?php
	// create menu nodes arr
	$menuNodesObject->menuNodes = array();
		
	if(!$menuNodesObject->isAdminTable()){
		$menuNode = array();
		$menuNode["id"] = "1";
		$menuNode["name"] = "";
		$menuNode["href"] = "mypage.htm";
		$menuNode["type"] = "Leaf";
		$menuNode["table"] = "ACCESOS";
		$menuNode["style"] = "";
		$menuNode["params"] = "";
		$menuNode["parent"] = "0";
		$menuNode["nameType"] = "Text";
		$menuNode["linkType"] = "Internal";
		$menuNode["pageType"] = "List";
		$menuNode["openType"] = "None";
			$menuNode["title"] = "ACCESOS";
		$menuNodesObject->menuNodes[] = $menuNode;
			$menuNode = array();
		$menuNode["id"] = "2";
		$menuNode["name"] = "";
		$menuNode["href"] = "mypage.htm";
		$menuNode["type"] = "Leaf";
		$menuNode["table"] = "alumnos_faltas Chart";
		$menuNode["style"] = "";
		$menuNode["params"] = "";
		$menuNode["parent"] = "0";
		$menuNode["nameType"] = "Text";
		$menuNode["linkType"] = "Internal";
		$menuNode["pageType"] = "Chart";
		$menuNode["openType"] = "None";
			$menuNode["title"] = "Alumnos Faltas Chart";
		$menuNodesObject->menuNodes[] = $menuNode;
			$menuNode = array();
		$menuNode["id"] = "3";
		$menuNode["name"] = "";
		$menuNode["href"] = "mypage.htm";
		$menuNode["type"] = "Leaf";
		$menuNode["table"] = "alumnos_faltas Report";
		$menuNode["style"] = "";
		$menuNode["params"] = "";
		$menuNode["parent"] = "0";
		$menuNode["nameType"] = "Text";
		$menuNode["linkType"] = "Internal";
		$menuNode["pageType"] = "Report";
		$menuNode["openType"] = "None";
			$menuNode["title"] = "Alumnos Faltas Report";
		$menuNodesObject->menuNodes[] = $menuNode;
			if($menuNodesObject->pageType == PAGE_MENU && IsAdmin())
		{
				}
	}else{
		//Admin Area menu items
	}	
	
?>

