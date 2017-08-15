<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?$arResult['SPEC_DATE'] = $arResult["ITEMS"][0]["DISPLAY_ACTIVE_FROM"]?>
<?$this->getComponent()->SetResultCacheKeys(array(
   "SPEC_DATE",
));?>