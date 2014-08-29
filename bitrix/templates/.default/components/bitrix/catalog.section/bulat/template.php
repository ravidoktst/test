<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<nav class="right-side items-list">
<h1 class="title"><?=$arResult["NAME"]?></h1>
<ul>
	<?foreach($arResult["ITEMS"] as $arElement):?>
	<?
	//new dBug($arElement);
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	?>
	<li id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<a href="<?=$arElement['DETAIL_PAGE_URL']?>"><div class="image"><img src="<?echo $arElement["PREVIEW_PICTURE"]["SRC"] ? $arElement["PREVIEW_PICTURE"]["SRC"] : '/img/nophoto140.jpg';?>" alt="<?=$arElement['PREVIEW_PICTURE']['TITLE']?>"></div></a>
		<div class="item-name">
			<a href="<?=$arElement['DETAIL_PAGE_URL']?>"><?=$arElement['NAME']?></a>
		</div>
		<div class="action-block">
		    <div class="price">

		<?foreach($arResult["PRICES"] as $code=>$arPrice):?>
		<div>
			<?if($arPrice = $arElement["PRICES"][$code]):?>
				<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					<s><?=$arPrice["PRINT_VALUE"]?></s><br /><span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
				<?else:?>
					<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
				<?endif?>
			<?else:?>
				&nbsp;
			<?endif;?>
		</div>
		<?endforeach;?>

		    </div>

		<?if(count($arResult["PRICES"]) > 0):?>
		<div>
			<?if($arElement["CAN_BUY"]):?>
				<noindex>
				&nbsp;<a id="btnAdd" class="button blue" href="<?echo $arElement["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?></a>

				</noindex>
			<?elseif((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"])):?>
				<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
				<?$APPLICATION->IncludeComponent("bitrix:sale.notice.product", ".default", array(
							"NOTIFY_ID" => $arElement['ID'],
							"NOTIFY_URL" => htmlspecialcharsback($arElement["SUBSCRIBE_URL"]),
							"NOTIFY_USE_CAPTHA" => "N"
							),
							$component
						);?>
			<?endif?>&nbsp;
		</div>
		<?endif;?>

		<?
			if(CModule::IncludeModule('iblock'))
			{
			$arFilter = array("IBLOCK_ID"=>5,"ID"=>$arElement['ID']);
			$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("ID","NAME", "SHOW_COUNTER"));
			$ar_fields = $res->GetNext();
			}

			if($arElement['PROPERTIES']['FORUM_TOPIC_ID']['VALUE']){
				$res = CIBlockElement::GetList(array('SORT'=>'ASC'), array('IBCLOCK_ID'=>10,'ACTIVE'=>'Y','SECTION_ID'=>$arElement['PROPERTIES']['FORUM_TOPIC_ID']['VALUE']), false,  false, array());
				$nRew = $res->SelectedRowsCount();
			}else{
				$nRew = 0;
			}
		?>

		    <span class="views-count"><?echo $ar_fields['SHOW_COUNTER'] ? $ar_fields['SHOW_COUNTER'] : '0'; ?></span>
		    <span class="comments-count"><?=$nRew?></span>

		</div>	
	</li>
	<?endforeach;?>
</ul>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
</nav>
