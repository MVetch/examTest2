<?
include "functions.php";

AddEventHandler("main", 'OnBuildGlobalMenu', 'myFunc');
AddEventHandler("main", 'OnBeforeEventSend', 'OnBeforeEventSend');

function myFunc(&$arFields, &$another)
{
	unset($arFields['global_menu_desktop']);
}
function OnBeforeEventSend(&$arFields, &$arTemplate)
{
	global $USER;
	if($USER->IsAuthorized()){
		$author = "Пользователь не авторизован, данные из формы: ".$arFields['AUTHOR'];
	} else {
		$author = "Пользователь авторизован: ".CUser::GetId()." (".CUser::GetLogin().") ".CUser::GetFirstName()." данные из формы: ".$arFields['AUTHOR'];
	}
	CEventLog::Add(array(
			"SEVERITY" => "SECURITY",
	        "AUDIT_TYPE_ID" => "MY_OWN_TYPE",
	        "MODULE_ID" => "main",
	        "DESCRIPTION" => "Замена данных в отсылаемом письме – ".$author,
		)
	);
	$arFields['AUTHOR'] = $author;
        foreach($arFields as $keyField => $arField)
           $arTemplate["MESSAGE"] = str_replace('#'.$keyField.'#', $arField, $arTemplate["MESSAGE"]);
}
?>