<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>

<ul>
	<?foreach($arResult['NEWS'] as $arItem):?>
		<li><?=$arItem['NAME']?></li>
		<?if(count($arItem['RELATED_PROD']) > 0):?>
			<ul>
				<?foreach($arItem['RELATED_PROD'] as $arProd):?>
					<li><?=$arProd['PROD_NAME']?> - <?=$arProd['PRICE']?> - <?=$arProd['MATERIAL']?> - <?=$arProd['ARTNUMBER']?></li>
				<?endforeach?>
			</ul>
		<?endif?>
	<?endforeach?>
</ul>