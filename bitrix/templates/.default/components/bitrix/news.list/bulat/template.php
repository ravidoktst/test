<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list simple-page">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<h1 class="title">Новости компании</h1>
<ul>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<li><a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<div class="column">
				<div class="image"><img src="<?echo $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : '/img/nophoto140.jpg';?>" alt=""></div>
				<div class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
			</div>
			<div class="column">
				<h3 class="name"><?=$arItem["NAME"]?></h3>
				<div class="text"><?=$arItem["PREVIEW_TEXT"]?></div>
			</div>
		</a>
	</li>
<?endforeach;?>
<?echo ($APPLICATION->GetCurPage(false) === '/')? '<a class="more-news" href="/news/">Все новости</a>': ""; ?>
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
