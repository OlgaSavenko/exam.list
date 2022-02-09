<?
	if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
	
	use Bitrix\Main;
	use Bitrix\Main\Localization\Loc as Loc;	

	try {
		if (!Main\Loader::includeModule('iblock')) {
	        throw new Main\LoaderException(Loc::getMessage('EXAM_LIST_PARAMETERS_IBLOCK_MODULE_NOT_INSTALLED'));
	    }

		$iblockTypes = CIBlockParameters::GetIBlockTypes(["-" => " "]);
		$iblocksList = ["" => " "];
		
		if (isset($arCurrentValues['IBLOCK_TYPE']) && strlen($arCurrentValues['IBLOCK_TYPE'])) {
	        $filter = [
	            'TYPE' => $arCurrentValues['IBLOCK_TYPE'],
	            'ACTIVE' => 'Y'
	        ];
	        $ibList = CIBlock::GetList(['SORT' => 'ASC'], $filter);
	        while ($iblock = $ibList->GetNext()) {
	            $iblocksList[$iblock['ID']] = $iblock['NAME'];
	        }
	    }
		
		$arComponentParameters = array(
		    'GROUPS' => array(),	    
		    'PARAMETERS' => array(
			    'IBLOCK_TYPE' => [
	                'PARENT' => 'BASE',
	                'NAME' => Loc::getMessage('EXAM_LIST_PARAMETERS_IBLOCK_TYPE'),
	                'TYPE' => 'LIST',
	                'VALUES' => $iblockTypes,
	                'DEFAULT' => '',
	                'REFRESH' => 'Y'
	            ],
	            'IBLOCK_ID' => [
	                'PARENT' => 'BASE',
	                'NAME' => Loc::getMessage('EXAM_LIST_PARAMETERS_IBLOCK_CODE'),
	                'TYPE' => 'LIST',
	                'VALUES' => $iblocksList,
	            ],
		        'CACHE_TIME' => ['DEFAULT' => 3600],
		    ),
		);
	    
	} catch (Main\LoaderException $e) {
		ShowError($e->getMessage());
	}
	
	
