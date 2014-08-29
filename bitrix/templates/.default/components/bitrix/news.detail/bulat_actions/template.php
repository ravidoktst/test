<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="action-detail simple-page">
	
	<?
	$arr = CIBlockElement::GetList(array('SORT'=>'ASC'), array('IBLOCK_ID'=>9,'ACTIVE'=>'Y','ID'=>$arResult['ID']), false,false,array());

    if($obEl = $arr->GetNextElement())
        {   
            $item = $obEl->GetProperties();
            
       
	//$item = $arr->GetNext();
	//new dBug($item);
}
	?>

	<h1 class="title">Акции</h1>

	<?if($arResult["DETAIL_PICTURE"]):?>

		<div class="action-image">
			<img src="<?=$arResult["DETAIL_PICTURE"]['SRC']?>" alt="">
			<div class="action-title"><?=$item['BANER_NAME']['VALUE']?></div>
			<div class="price">от <span><?=number_format($item['PRICE']['VALUE'], 0, ',', ' ')?></span> руб.</div>
		</div>
	<?endif?>

	<div class="action-name"><?=$arResult['NAME']?></div>

	<div class="text">
		<?echo $arResult["DETAIL_TEXT"];?>
	</div>

	<div class="feedback-form horizontal zakaz" ng-controller="aktionForm">
		<h3 class="form-title">Заказать гаражные ворота со скидкой</h3>
		<form action="" name="userForm" ng-submit="submitForm()">
			<input type="text" placeholder="Представьтесь" ng-model="user.name" required>
			<input type="text" placeholder="E-mail" ng-model="user.email" input-mask="{ mask:'a{1,20}@a{1,10}.a{1,5}' ,greedy: false}" required>
			<input type="text" placeholder="Телефон" ng-model="user.phone" input-mask="{mask: '+7(999)999-99-99'}"  required>
			<textarea placeholder="Комментарий" ng-model="user.koment"></textarea>
			<input class="button blue" type="submit" value="Отправить заявку">
		</form>
	</div>

	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>

	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>

	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?>
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>

	<a class="to-list" href="/action/">Возврат к списку</a>