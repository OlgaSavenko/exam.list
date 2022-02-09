<?
	if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
	
	use Bitrix\Main;
	use Bitrix\Main\Localization\Loc as Loc;
	
	$arComponentDescription = array(
	    'NAME' => Loc::getMessage('EXAM_LIST_DESCRIPTION_COMPONENT_NAME'),
	    'DESCRIPTION' => Loc::getMessage('EXAM_LIST_DESCRIPTION_COMPONENT_DESC'),
	    'PATH' => array(
	        'ID' => 'exam',
	        'NAME' => Loc::getMessage('EXAM_LIST_DESCRIPTION_COMPONENT_PATH_NAME'),
	    ),
	);
