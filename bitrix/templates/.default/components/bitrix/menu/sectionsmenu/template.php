<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<ul>

<?foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns):?>
	<li <?=$arResult["ALL_ITEMS"][$itemID]["SELECTED"] ? 'class="selected"' : '';?> ><a href="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>"><?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?></a>
		<?if($arColumns):?>
			<ul>
				<?foreach($arColumns as $itemID => $arColumns):?>
					<?foreach($arColumns as $itemID => $arColumns):?>
						<li><a href ="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>"><?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?></a>
							<?if($arColumns):?>
								<ul>
									<?foreach($arColumns as $itemID => $arColumns):?>
										<li><a href ="<?=$arResult["ALL_ITEMS"][$arColumns]["LINK"]?>"><?=$arResult["ALL_ITEMS"][$arColumns]["TEXT"]?></a></li>
									<?endforeach;?>
								</ul>	
							<?endif;?>
						</li>
					<?endforeach;?>
				<?endforeach;?>
			</ul>
		<?endif;?>
	</li>
<?endforeach;?>

</ul>
<?endif?>