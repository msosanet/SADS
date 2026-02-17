<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");


include("include/dbcommon.php");

if(!@$_SESSION["UserID"] || @$_SESSION["UserID"]=="<Guest>")
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$message="";
$go=1;

include('include/xtempl.php');
include('classes/runnerpage.php');
$xt = new Xtempl();

$id = postvalue("id") != "" ? postvalue("id") : 1;

$layout = new TLayout("changepwd","PurificOrange","MobileOrange");
$layout->blocks["top"] = array();
$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"changeheader","block"=>"","substyle"=>2);


$layout->containers["fields"][] = array("name"=>"message","block"=>"message_block","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"changefields","block"=>"","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"changebuttons","block"=>"","substyle"=>2);


$layout->skins["fields"] = "fields";
$layout->blocks["top"][] = "fields";$page_layouts["changepwd"] = $layout;


//array of params for classes
$params = array("pageType" => PAGE_CHANGEPASS, "id" =>$id);
$params['xt'] = &$xt;
$params['tName'] = "global";
$params['templatefile'] = "changepwd.htm";
$params['needSearchClauseObj'] = false;
$pageObject = new RunnerPage($params);


$auditObj = GetAuditObject();

//	Before Process event
if($globalEvents->exists("BeforeProcessChangePwd"))
	$globalEvents->BeforeProcessChangePwd($conn);

if (@$_POST["btnSubmit"] == "Submit")
{	
	$go = postvalue("go")+1;
	$xt->assign("backlink_attrs","href=\"javascript:history.go(-".$go.")\"");
	$opass = postvalue("opass");
	$newpass = postvalue("newpass");
	$newpassraw=$newpass;
	
	$value = @$_SESSION["UserID"];
	if(NeedQuotes($cUserNameFieldType))
		$value=db_prepare_string($value);
	else
		$value=(0+$value);
	$passvalue = $newpass;
	if(NeedQuotes($cPasswordFieldType))
		$passvalue=db_prepare_string($passvalue);
	else
		$passvalue=(0+$passvalue);


    	$sWhere = " where ".AddFieldWrappers($cUserNameField)."=".$value;
		$strSQL = "select * from ".AddTableWrappers($cLoginTable).$sWhere;
		$rstemp=db_query($strSQL,$conn);

		if($row=db_fetch_array($rstemp))
		{
			if($opass == $row[$cPasswordField])
			{
				$retval=true;
				if($globalEvents->exists("BeforeChangePassword"))
					$retval=$globalEvents->BeforeChangePassword(postvalue("opass"), postvalue("newpass"));
				if($retval)
				{
					$strSQL= "update ".AddTableWrappers($cLoginTable)." set ".AddFieldWrappers($cPasswordField)."=".$passvalue.$sWhere;
					db_exec($strSQL,$conn);
					if($auditObj)
						$auditObj->LogChPassword();
					if($globalEvents->exists("AfterChangePassword"))
						$globalEvents->AfterChangePassword(postvalue("opass"), postvalue("newpass"));
					
					$layout = new TLayout("changepwd_success","PurificOrange","MobileOrange");
$layout->blocks["top"] = array();
$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"changeheader","block"=>"","substyle"=>2);


$layout->containers["fields"][] = array("name"=>"changepwd_message","block"=>"","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"mesbackto","block"=>"","substyle"=>2);


$layout->skins["fields"] = "fields";
$layout->blocks["top"][] = "fields";$page_layouts["changepwd_success"] = $layout;

					
					$xt->assign("body",true);
					$xt->display("changepwd_success.htm");
					return;
				}
			}
			else
				$message = "Cambiar contraseña";
	}
}
else $xt->assign("backlink_attrs","href=\"javascript:history.go(-1)\"");
	
if($message)
{
	$xt->assign("message","<div class='message'>".$message."</div>");
	$xt->assign("message_block",true);
}
$xt->assign("loginlink_attrs","onclick='if (document.forms.form1.onsubmit()) document.forms.form1.submit();return false;'");

$includes="";
$includes.="<script language=\"JavaScript\" src=\"include/loadfirst.js\"></script>\r\n";
$includes.="<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";

$pageObject->body["begin"] .= $includes."<script language=\"JavaScript\">
function validate(){
	if (document.forms.form1.cpass.value!=document.forms.form1.newpass.value){	
		alert('".jsreplace("La contraseña no concuerda, vuelva a escribir la contraseña").
		"');
		document.forms.form1.newpass.value='';
		document.forms.form1.cpass.value='';
		document.forms.form1.newpass.focus();
		return false;
	}
	return true;
}
</script>
<form method=\"POST\" action=\"changepwd.php\" id=form1 name=form1 onsubmit=\"return validate();\">
<input type=hidden name=btnSubmit value=\"Submit\">
<input type=hidden name=go value=\"".$go."\">";
$pageObject->body["end"] .="</form>";

$pageObject->addCommonJs();
$pageObject->fillSetCntrlMaps();
$pageObject->body['end'] .= '<script>';
$pageObject->body['end'] .= "window.controlsMap = ".my_json_encode($pageObject->controlsHTMLMap).";";
$pageObject->body['end'] .= "window.settings = ".my_json_encode($pageObject->jsSettings).";</script>";
$pageObject->body['end'] .= "<script language=\"JavaScript\" src=\"include/runnerJS/RunnerAll.js\"></script>\r\n";
$pageObject->body["end"] .= '<script>'.$pageObject->PrepareJS()."</script>";
$pageObject->addButtonHandlers();

$xt->assignbyref("body",$pageObject->body);

if($globalEvents->exists("BeforeShowChangePwd"))
	$globalEvents->BeforeShowChangePwd($xt,$pageObject->templatefile);

$xt->display($pageObject->templatefile);
?>