<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("");?><?$APPLICATION->IncludeComponent(
	"exam:exam.list",
	"",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "22",
		"IBLOCK_TYPE" => "examlist"
	)
);?><?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>