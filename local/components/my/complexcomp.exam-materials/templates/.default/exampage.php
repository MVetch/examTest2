<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

Значения переменных: 
<?foreach($arResult['VARIABLES'] as $key => $value):?>
	<br /><?=$key?> = <?=$value?>
<?endforeach?>