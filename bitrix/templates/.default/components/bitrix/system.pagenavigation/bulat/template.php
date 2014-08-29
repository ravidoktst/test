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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<?//new dBug($arResult);?>

<?if ($arResult["NavPageCount"] > 1):?>

	<div class="items-pager">

		<?if ($arResult["NavPageNomer"] > 1):?>

			<?if($arResult["bSavePage"]):?>
				<a class="prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>page=<?=($arResult["NavPageNomer"]-1)?>"></a>
			<?else:?>
				<?if ($arResult["NavPageNomer"] > 2):?>
					<a class="prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>page=<?=($arResult["NavPageNomer"]-1)?>"></a>
				<?else:?>
					<a class="prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>page=<?=($arResult["NavPageNomer"]-1)?>"></a>
				<?endif?>
			<?endif?>

		<?else:?>

		<?endif?>

		<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
			<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
				<span class="pages"><?=$arResult["nStartPage"]?></span>
			<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
				<a class="pages" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
			<?else:?>
				<a class="pages" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>page=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
			<?endif?>
			<?$arResult["nStartPage"]++?>
		<?endwhile?>

		<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
			<a class="next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>page=<?=($arResult["NavPageNomer"]+1)?>"></a>
		<?else:?>

		<?endif?>

	</div>
<?endif;?>