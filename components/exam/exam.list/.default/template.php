<?
	if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
	use Bitrix\Main;
	use Bitrix\Main\Localization\Loc as Loc;	
?>

<h1><?=Loc::getMessage('EXAM_LIST_TEMPLATE_TITLE')?></h1>

<div>
	<?if ($arResult["ITEMS"]):?> 
		<table class="exam-list">
			<thead>
				<tr>
					<th><?=Loc::getMessage('EXAM_LIST_TEMPLATE_EXAM_DATE')?></th>
					<th><?=Loc::getMessage('EXAM_LIST_TEMPLATE_EXAM_NAME')?></th>
					<th><?=Loc::getMessage('EXAM_LIST_TEMPLATE_TEACHER_NAME')?></th>
					<th><?=Loc::getMessage('EXAM_LIST_TEMPLATE_ROOM')?></th>
				</tr>
			</thead>
			<tbody>
				<?foreach($arResult["ITEMS"] as $item):?>
					<tr>
						<td class="date"><?=$item["DATE_ACTIVE_FROM"]?></td>
						<td class="name"><?=$item["NAME"]?></td>
						<td class="teacher"><?=$item["PROPERTIES"]["TEACHER"]["VALUE"]?></td>
						<td class="room"><?=$item["PROPERTIES"]["ROOM"]["VALUE"]?></td>
					</tr>
				<?endforeach;?>
			</tbody>
		</table>
	<?else:?>
		<?=Loc::getMessage('EXAM_LIST_TEMPLATE_NO_ITEMS')?>
	<?endif?> 
</div>
