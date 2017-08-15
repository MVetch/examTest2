<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
$this->AddIncludeAreaIcon(
    array(
        'URL'   => "/bitrix/admin/iblock_section_admin.php?IBLOCK_ID=".$arParams['CAT_IBLOCK_ID']."&type=products&lang=ru&find_section_section=0",
        'TITLE' => "ИБ в админке",
        "IN_PARAMS_MENU" => true
    )
);

if($this->StartResultCache()):

	$cnt = 0;

	$result = CIBlockSection::GetList(
		array(),
		array("IBLOCK_ID" => $arParams['CAT_IBLOCK_ID']),
		false,
		array("ID", "NAME", "UF_".$arParams['NEWS_PROPERTY_CODE']),
		array()
	);

	while ($list = $result->Fetch()) {
		$sections[$list['ID']] = array(
			"ID" => $list["ID"],
			"NAME" => $list["NAME"],
			"UF_".$arParams['NEWS_PROPERTY_CODE'] => unserialize($list["UF_".$arParams['NEWS_PROPERTY_CODE']])
		);
	}

	$news = array();

	$resultElements = CIBlockElement::GetList(
		array(),
		array("IBLOCK_ID" => $arParams['CAT_IBLOCK_ID']),
		false,
		false,
		array("IBLOCK_SECTION_ID", "NAME", "PROPERTY_ARTNUMBER", "PROPERTY_MATERIAL", "PROPERTY_PRICE")
	);

	while ($list = $resultElements->Fetch()) {
		$elementDetail[$list['IBLOCK_SECTION_ID']][] = array(
			"IBLOCK_SECTION_ID" => $list['IBLOCK_SECTION_ID'],
			"PROD_NAME" => $list['NAME'],
			"ARTNUMBER" => $list['PROPERTY_ARTNUMBER_VALUE'],
			"MATERIAL" => $list['PROPERTY_MATERIAL_VALUE'],
			"PRICE" => $list['PROPERTY_PRICE_VALUE']
		);
		$cnt++;
	}

	$ids = array();
	foreach ($sections as $arSection) {
		foreach ($arSection["UF_".$arParams['NEWS_PROPERTY_CODE']] as $id) {
			if(!in_array($id, $ids)){
				$ids[] = $id;
			}
			$news[] = array("ID" => $id, "SECTION_ID" => $arSection['ID']);
		}
	}

	$resultNews = CIBlockElement::GetList(
		array(),
		array("IBLOCK_ID" => $arParams['NEWS_IBLOCK_ID'], "ID" => $ids),
		false,
		false,
		array("NAME", "DATE_ACTIVE_FROM", "ID")
	);

	while ($list = $resultNews->Fetch()) {
		$arResult['NEWS'][$list['ID']]["RELATED_PROD"] = array();
		foreach ($news as $newsItem) {
			if($newsItem['ID'] == $list['ID']){
				$arResult['NEWS'][$list['ID']]['NAME'] = $list['NAME'];
				$arResult['NEWS'][$list['ID']]['DATE_ACTIVE_FROM'] = $list['DATE_ACTIVE_FROM'];
				$arResult['NEWS'][$list['ID']]["RELATED_PROD"] = array_merge($arResult['NEWS'][$list['ID']]["RELATED_PROD"], $elementDetail[$newsItem['SECTION_ID']]);
			}
		}
	}
	$APPLICATION->SetTitle("В каталоге товаров представлено товаров: ".$cnt);
	$this->includeComponentTemplate();
endif;