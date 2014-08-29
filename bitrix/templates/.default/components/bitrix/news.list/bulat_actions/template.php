<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="actions-list simple-page">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<h1 class="title">Акции</h1>
<ul>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$arr = CIBlockElement::GetList(array('SORT'=>'ASC'), array('IBLOCK_ID'=>9,'ACTIVE'=>'Y','ID'=>$arItem['ID']), false,false,array('PROPERTY_PRICE','PROPERTY_BANER_NAME'));
	$item = $arr->GetNext();
	?>
	<li><a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<div class="action-image">
				<img src="<?echo $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : '/img/nophoto140.jpg';?>" alt="">
				<div class="action-title"><?=$item['PROPERTY_BANER_NAME_VALUE']?></div>
				<div class="price">от <span><?=number_format($item['PROPERTY_PRICE_VALUE'], 0, ',', ' ')?></span> руб.</div>
			</div>
			<h2 class="name"><?=$arItem["NAME"]?></h2>
			<div class="text"><?=$arItem["DETAIL_TEXT"]?></div>
		</a>
	</li>
<?endforeach;?>
<?echo ($APPLICATION->GetCurPage(false) === '/')? '<a class="more-news" href="/news/">Все новост</a>': ""; ?>
</ul>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
<?if (($arResult['NAV_RESULT']->nSelectedCount)<=$arParams['NEWS_COUNT'] && $APPLICATION->GetCurPage(false) !== '/'):?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.news-list ul').addClass('notLine');
	});
</script>
<?endif;?>
