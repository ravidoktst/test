<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
//new dBug($arResult);
$arrPropNo = array(50,51,60,61,65); //СВОЙСТВА КОТОРЫЕ НЕ ВЫВОДЯТСЯ В КАРТОЧКЕ СПРАВА
?>
<div class="item-detail simple-page" >
		<h1 class="title"><?=$arResult['NAME']?></h1>

		<div class="gallery">
			<div class="bx-wrapper" style="max-width: 100%;"><div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 256px;"><div class="bxslider" style="width: 515%; position: relative; left: 0px;">
				<div style="float: left; list-style: none; position: relative; width: 380px;"><img src="<?echo $arResult['DETAIL_PICTURE']['SRC'] ? $arResult['DETAIL_PICTURE']['SRC'] : '/img/nophoto.jpg'?>" alt=""></div>
				<?foreach($arResult['PROPERTIES']['PHOTO']['VALUE'] as $item):?>
					<div style="float: left; list-style: none; position: relative; width: 380px;"><img src="<?=CFile::GetPath($item)?>" alt=""></div>
				<?endforeach;?>
			</div></div><div class="bx-controls"></div></div>
			<div id="bx-pager" class="bx-pager">
				<?if($arResult['PROPERTIES']['PHOTO']['VALUE']):?>
					<a data-slide-index="0" href="" class="active"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>"></a>
				<?endif;?>
				<?foreach($arResult['PROPERTIES']['PHOTO']['VALUE'] as $key=>$item):?>
					<a data-slide-index="<?=$key+1?>" href=""><img src="<?=CFile::GetPath($item)?>"></a>
				<?endforeach;?>
			</div>
		</div>

		<div class="item-data" itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
			<div class="artnumber">Арт.: <?=$arResult['PROPERTIES']['ART']['VALUE']?></div>
			<div class="price"><?=CurrencyFormat($arResult['CATALOG_PRICE_1'], $arResult['CATALOG_CURRENCY_1']);?></div>
			<span style="display:none" itemprop="price"><?=$arResult['CATALOG_PRICE_1']?></span>
			<meta itemprop="currency" content="RUR" /><meta itemprop="availability" content="in_stock">
			<?if($arResult["CAN_BUY"]):?>
				<noindex>
				&nbsp;<a id="btnAdd" class="button blue" href="<?echo $arResult["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?>В корзину</a>
				</noindex>
			<?elseif((count($arResult["PRICES"]) > 0) || is_array($arResult["PRICE_MATRIX"])):?>
				<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
				<?$APPLICATION->IncludeComponent("bitrix:sale.notice.product", ".default", array(
							"NOTIFY_ID" => $arResult['ID'],
							"NOTIFY_URL" => htmlspecialcharsback($arResult["SUBSCRIBE_URL"]),
							"NOTIFY_USE_CAPTHA" => "N"
							),
							$component
						);?>
			<?endif?>&nbsp;


			<?foreach ($arResult['PROPERTIES'] as $item):?>
				<?if(!in_array($item['ID'],$arrPropNo)):?>
					<?if(is_array($item['VALUE'])):?>
						<div class="row">
							<span class="title"><?=$item['NAME']?></span>
							<span class="value"><?foreach($item['VALUE'] as $val){ echo $val.' '; }?></span>
						</div>				
					<?elseif($item['VALUE']):?>
						<div class="row">
							<span class="title"><?=$item['NAME']?></span>
							<span class="value"><?=$item['VALUE']?></span>
						</div>	
					<?endif;?>
				<?endif;?>			
			<?endforeach;?>
		</div>
		<?
			$res=$USER->GetByID($USER->GetID());
			$arUser=$res->GetNext();
			if($arResult['PROPERTIES']['FORUM_TOPIC_ID']['VALUE']){
				$res = CIBlockElement::GetList(array('SORT'=>'ASC'), array('IBCLOCK_ID'=>10,'ACTIVE'=>'Y','SECTION_ID'=>$arResult['PROPERTIES']['FORUM_TOPIC_ID']['VALUE']), false,  false, array());
				$nRew = $res->SelectedRowsCount();
			}else{
				$nRew = 0;
			}
		?>

		<ul class="tabs">
			<li class="active">Описание</li>
			<li>Характеристики</li>
			<li>Отзывы <span>(<?=$nRew?>)</span></li>
		</ul>
		<div class="panes">
			<div class="pane active">
				<?=htmlspecialchars_decode($arResult['DETAIL_TEXT'])?>
			</div>
			<div class="pane">
				<?=htmlspecialchars_decode($arResult['PROPERTIES']['FEATURE']['VALUE']['TEXT'])?>
			</div>
			<div class="pane">
				<?
					if($arResult['PROPERTIES']['FORUM_TOPIC_ID']['VALUE']):
				?>

					<ul class="reviews">
						<?
						while ($item=$res->GetNext()):
							//new dBug($res);
						?>

							<li>
								<div class="info"><?=$item['NAME']?> / <?=ConvertDateTime($item['DATE_CREATE'],'DD.MM.YYYY','ru')?></div>
								<div class="text"><?=$item['DETAIL_TEXT']?></div>
							</li>
							

						<?endwhile;?>
					</ul>

				<?endif;?>

				<div class="feedback-form horizontal" ng-controller="reviewForm" ng-init="user.name='<?=$arUser['NAME']?>';user.email='<?=$arUser['EMAIL']?>'; user.title='<?=$arResult['NAME']?>'; user.id='<?=$arResult['ID']?>';user.sectid='<?=$arResult['PROPERTIES']['FORUM_TOPIC_ID']['VALUE'];?>';" >
				    <h3 class="form-title">Оставить отзыв</h3>
				    <form action="" ng-submit="submitForm()" name="userForm">
				    	<input type="hidden" ng-model="user.title" required />
				        <input type="hidden" ng-model="user.id" required />
				        <input type="hidden" ng-model="user.sectid" />
				        <input type="text" placeholder="Представьтесь" ng-model="user.name" required>
				        <input type="email" placeholder="E-mail" ng-model="user.email" required >
				        <textarea placeholder="Ваш отзыв" ng-model="user.text" required=""></textarea>
				        <input class="button blue" type="submit" value="Отправить">
				    </form>
				</div>



			</div>
		</div>

</div>

