<?	require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

	if (!CModule::IncludeModule('iblock')) echo 'Не подключен модуль iblock';

	create_iblock_type();
	
	
	/**
	 * Создание типа инфоблока
	 *
	 */
	function create_iblock_type(){
		echo '<h3>Добавление типа инфоблока</h3>';
		$IBlockType = 'examlist';	
		$obIBlockType =  new CIBlockType;
		
		$arIBlockTypeFields = Array(
	    	'ID' => $IBlockType,
			'SECTIONS' => 'Y',
			'IN_RSS' => 'N',
			'SORT' => 100,
			'LANG' => Array (
	        	'ru' => Array (
					'NAME' => 'Расписание экзаменов',               
				)   
			)
		);
	   
		$result = $obIBlockType->Add($arIBlockTypeFields);
		
		if (!empty($obIBlockType->LAST_ERROR)) {
		    echo 'При создании типа инфоблока возникла ошибка: '. $obIBlockType->LAST_ERROR;
		    die();
		}
	
		echo 'Тип инфоблока успешно создан <br/>';
		create_iblock($IBlockType);
	}
	
	
	
	/**
	 * Создание инфоблока
	 *
	 * @param {string} $IBlockType — тип инфоблока
	 *
	 */
	function create_iblock($IBlockType){
		echo '<h3>Добавление инфоблока</h3>';
		$IBlock = new CIBlock;
		$arIBlockFields = Array(
			'ACTIVE' => 'Y',
			'NAME' => 'Расписание экзаменов',
			'CODE' => 'exams',
			'LIST_PAGE_URL' => '#SITE_DIR#/exams/',
			'DETAIL_PAGE_URL' => '#SITE_DIR#/exams/#ELEMENT_CODE#',
			'IBLOCK_TYPE_ID' => $IBlockType,
			'SITE_ID' => 's1',
		);
	
		$IBlockId = $IBlock->Add($arIBlockFields);
		
		if (!empty($IBlockId->LAST_ERROR)) {
		    echo 'При создании инфоблока возникла ошибка: '. $IBlockId->LAST_ERROR;
		    die();
		}
		
		echo 'Инфоблок успешно создан <br/>';
		create_iblock_properties($IBlockId);
	}
	

	
	
	/**
	 * Создание свойств инфоблока
	 *
	 * @param {int} $IBlockId — id инфоблока
	 *
	 */
	function create_iblock_properties($IBlockId){
		echo '<h3>Создание свойств инфоблока</h3>';
		$IBlockProps = new CIBlockProperty;
		
		$arProps = array(
			array(
				'NAME' => 'Аудитория',
				'CODE' => 'ROOM',
				'PROPERTY_TYPE' => 'N',
			),
			
			array(
				'NAME' => 'Преподаватель',
				'CODE' => 'TEACHER',
				'PROPERTY_TYPE' => 'S',
			),
		);
		
		
		foreach($arProps as $i => $prop){
			$arIBlockPropsFields = Array(
				'NAME' => $prop['NAME'],
				'ACTIVE' => 'Y',
				'SORT' => '100',
				'CODE' => $prop['CODE'],
				'PROPERTY_TYPE' => $prop['PROPERTY_TYPE'],
				'IBLOCK_ID' => $IBlockId,
			);
			
			$IBlockPropId = $IBlockProps->Add($arIBlockPropsFields);
			
			if (!empty($IBlockPropId->LAST_ERROR)) {
			    echo 'При создании свойства ' .$prop['NAME']. ' возникла ошибка: '. $IBlockPropId->LAST_ERROR;
			    die();
			} else echo 'Свойство ' .$prop['NAME']. ' успешно добавлено <br/>';
		}
		
		create_iblock_elements($IBlockId);
	}
	
	
	
	/**
	 * Создание элементов инфоблока
	 *
	 * @param {int} $IBlockId — id инфоблока
	 *
	 */
	function create_iblock_elements($IBlockId){
		echo '<h3>Создание элементов инфоблока</h3>';
		$IBlockElement = new CIBlockElement;
		
		$arNewElements = array(
			array(
				'NAME' => 'Математика',
				'CODE' => 'math',
				'ROOM' => 23,
				'TEACHER' => 'Петров Иван Васильевич',
				'DATE' => '25.02.2022',
			),
			array(
				'NAME' => 'Английский язык',
				'CODE' => 'english',
				'ROOM' => 29,
				'TEACHER' => 'Кузнецова Татьяна Павловна',
				'DATE' => '21.02.2022',
			),
			array(
				'NAME' => 'Информатика',
				'CODE' => 'info',
				'ROOM' => 4,
				'TEACHER' => 'Иванов Сергей Петрович',
				'DATE' => '15.01.2022',
			),
			array(
				'NAME' => 'История',
				'CODE' => 'history',
				'ROOM' => 7,
				'TEACHER' => 'Федорова Мария Викторовна',
				'DATE' => '25.12.2021',
			),
			array(
				'NAME' => 'Физика',
				'CODE' => 'physics',
				'ROOM' => 14,
				'TEACHER' => 'Сидоров Дмитрий Евгеньевич',
				'DATE' => '25.01.2022',
			),
		);
		
		foreach ($arNewElements as $i => $elem){
			$arElementFields = Array(
				'IBLOCK_ID' => $IBlockId,
				'CODE' => $elem['CODE'],
				'PROPERTY_VALUES' => array(
					'ROOM' => $elem['ROOM'],
					'TEACHER' => $elem['TEACHER']
				),
				'NAME' => $elem['NAME'],
				'ACTIVE' => 'Y',
				'DATE_ACTIVE_FROM' => $GLOBALS['DB']->FormatDate($elem['DATE']),
			);
			
			$elementId = $IBlockElement->Add($arElementFields);
			
			if (!empty($IBlockElement->LAST_ERROR)) {
			    echo 'При создании элемента ' .$elem['NAME']. ' возникла ошибка: '. $IBlockElement->LAST_ERROR;
			} else echo 'Элемент ' .$elem['NAME']. ' успешно добавлен <br/>';
		}	
	}

?>