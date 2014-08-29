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
$this->setFrameMode(true);
?>
<div id="filter" class="filter">
<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo ($APPLICATION->GetCurPage(false) === '/')? "/catalog/vorota": "";?><?echo $arResult["FORM_ACTION"]?>" method="get">
	<?//new dBug($arResult["ITEMS"]);
	$k = 0;
	?>

		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			//new dBug($arItem);
			//если это цена
			if($k==1):
				$arItem1 = $arResult["ITEMS"]["BASE"];
				//new dBug($arResult);
			?>
				<div class="column">
					<h3 class="title">Цена</h3>
					<div class="slider1"></div>
					<div class="priceSpan">
						<span class="example-val" id="value1"></span>
						<span class="example-val" id="value2"></span>
					</div>
					<div class="range-values">
						<label>от</label><input type="text"
									value="" 											
									name="<?=$arItem1["VALUES"]["MIN"]["CONTROL_NAME"]?>"
									id="<?=$arItem1["VALUES"]["MIN"]["CONTROL_ID"]?>"
									onkeyup="smartFilter.keyup(this)">
						<label>до</label><input type="text" 
									value=""
									name="<?=$arItem1["VALUES"]["MAX"]["CONTROL_NAME"]?>"
									id="<?=$arItem1["VALUES"]["MAX"]["CONTROL_ID"]?>"
									onkeyup="smartFilter.keyup(this)">
						<span class="currency">руб.</span>
					</div>
				</div>
				<?
					$min = $arItem1['VALUES']['MIN']['VALUE'] ? $arItem1['VALUES']['MIN']['VALUE'] : 0;
					$max = $arItem1['VALUES']['MAX']['VALUE'] ? $arItem1['VALUES']['MAX']['VALUE'] : 1000;
					if ($min==$max){
						$max = $min + 1000;
					}
				?>
				<script>
				$(document).ready(function(){
					$(function(){
						var min=<?=$min?>, max=<?=$max?>, start=<?echo $arItem1['VALUES']['MIN']['HTML_VALUE']? $arItem1['VALUES']['MIN']['HTML_VALUE']: $min?>, end=<?echo $arItem1['VALUES']['MAX']['HTML_VALUE']? $arItem1['VALUES']['MAX']['HTML_VALUE']: $max?>,left1 = 0, left2 = 0;
						$('.slider1').noUiSlider({
							start: [ start, end ],
							step: 100,
							margin: 200,
							range: {
								'min': min,
								'max': max
							},
							serialization: {
								lower: [
									$.Link({
										target: function( value, handleElement, slider ){
											$(".column #value1").text(parseInt(value).toFixed());
											$(".column .range-values #<?=$arItem1['VALUES']['MIN']['CONTROL_ID']?>").val(parseInt(value).toFixed());
											left1 = (95-((max-value)*100/(max-min))<0 ? 0 : 95-((max-value)*100/(max-min))); //(100*value)/max-5;
											if(left1+15<=left2) $(".column #value1").attr('style', 'left:'+left1+'%');
										}
									})
								],
								upper: [
									$.Link({
										target: function( value, handleElement, slider ){
											$(".column #value2").text(parseInt(value).toFixed());
											$(".column .range-values #<?=$arItem1['VALUES']['MAX']['CONTROL_ID']?>").val(parseInt(value).toFixed());
											//left = (100*value)/max-5;
											left2 = 95-((max-value)*100/(max-min));
											if(left1+15<=left2) $(".column #value2").attr('style', 'left:'+left2+'%');
										}
										})
								]								
							},
							format: {
								decimals: 1
							}
						});

					});
				});
				</script>
			<?endif;?>
			<?if($arItem["PROPERTY_TYPE"] == "L" && $arItem['ID']!=1):?>
				<div class="column">
					<?//new dBug($arItem);?>
					<h3 class="title"><?=$arItem["NAME"]?></h3>
					<?foreach($arItem["VALUES"] as $val => $ar):?>
						<div class="radio-row">
							<input
								type="checkbox"
								value="<?echo $ar["HTML_VALUE"]?>"
								name="<?echo $ar["CONTROL_ID"]?>"
								id="<?echo $ar["CONTROL_ID"]?>"
								<?echo $ar["CHECKED"]? 'checked="checked"': ''?>
							/><label for="<?echo $ar["CONTROL_ID"]?>"><?echo $ar["VALUE"];?></label>
						</div>
					<?endforeach;?>
				</div>
			<?endif;?>
		<?$k++?>
		<?endforeach;?>
		<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input
				type="hidden"
				name="<?echo $arItem["CONTROL_NAME"]?>"
				id="<?echo $arItem["CONTROL_ID"]?>"
				value="<?echo $arItem["HTML_VALUE"]?>"
			/>
		<?endforeach;?>
		<div class="control-block">
			<?if ($APPLICATION->GetCurPage(false) === '/'):?>
			<a href="/" class="reset">Сбросить</a>
			<?else:?>
			<input type="submit" value="Сбросить" id="del_filter" name="del_filter" class="reset"/>
			<?endif;?>	
			<input class="button yellow" type="submit" id="set_filter"  type="submit" name="set_filter" value="Показать результат" />
		</div>

		<div class="modef" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?>>
			<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
			<a href="<?echo $arResult["FILTER_URL"]?>" class="showchild"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
			<!--<span class="ecke"></span>-->
		</div>
</form>
</div>
<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>');
</script>