<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arParams['SPEC_DATE'] == "Y")
	$APPLICATION->SetPageProperty("specialdate", $arResult["SPEC_DATE"]);