<?
	if(isset($arParams['MY_PARAM'])){
		$r = CIBlockElement::GetList(
		 Array("SORT"=>"ASC"),
		 Array("IBLOCK_ID" => $arParams['MY_PARAM']),
		 false,
		 false,
		 Array("PROPERTY_MY_NEWS", "NAME")
		);
		//dump($arResult);
		while($l=$r->Fetch()){
			if($l['PROPERTY_MY_NEWS_VALUE'] == $arResult['ID'])
				$APPLICATION->SetPageProperty("canonical", $l['NAME']);
		}
	}
?>