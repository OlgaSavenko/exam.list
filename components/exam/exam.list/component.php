<?
	if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
	
	use Bitrix\Main;
	use Bitrix\Main\Localization\Loc as Loc;
		
	try {
		if (!Main\Loader::includeModule('iblock')) {
	        throw new Main\LoaderException(Loc::getMessage('EXAM_LIST_COMPONENT_IBLOCK_MODULE_NOT_INSTALLED'));
	    }
	    
	    //if ($this->StartResultCache()) {
		    $dbResult = CIBlockElement::GetList(
		    	Array('DATE_ACTIVE_FROM'=>'ASC'), 
				Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"]),
			);
			
			while($ob = $dbResult->GetNextElement()) {
				$fields = $ob->GetFields();
				$arResult['ITEMS'][$fields['ID']] = $fields;
				$arResult['ITEMS'][$fields['ID']]['PROPERTIES'] = $ob->GetProperties();
			}
		//}
		
		// подключаем шаблон компонента
		$this->IncludeComponentTemplate();
	    
	} catch (Main\LoaderException $e) {
		ShowError($e->getMessage());
	}
		
	
	
	