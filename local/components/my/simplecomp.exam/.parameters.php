<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
	return;

$arComponentParameters = array(
	"PARAMETERS" => array(
		"CAT_IBLOCK_ID" => Array(
			"NAME" => "ID инфоблока с каталогом товаров",
			"TYPE" => "STRING",
			"DEFAULT" => 2
		),
		"NEWS_IBLOCK_ID" => Array(
			"NAME" => "ID инфоблока с новостями",
			"TYPE" => "STRING",
			"DEFAULT" => 1
		),
		"NEWS_PROPERTY_ID" => Array(
			"NAME" => "Код пользовательского свойства разделов каталога, в котором хранится привязка к новостям",
			"TYPE" => "STRING",
			"DEFAULT" => 7
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
	),
	"BUTTONS" => array(
		"NAME" => "fdg"
	),
);