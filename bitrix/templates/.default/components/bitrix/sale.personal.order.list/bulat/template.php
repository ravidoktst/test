<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
//new dBug($arResult);
?>

<table class="round-header" id="basket_items">
	<thead>
		<tr>
			<td>№</td>
			<td>Дата</td>
			<td>Наименование</td>
			<td>Цена</td>
			<td>Кол-во</td>
			<td>Сумма</td>
			<td><td>
		</tr>
	</thead>

	<tbody>
		<?foreach($arResult['ORDERS'] as $key => $val):?>
		<tr>
			<td><?=$val['ORDER']['ID']?></td>
			<td><?=date_format(date_create($val['ORDER']['DATE_STATUS']), 'd.m.Y')?></td>
			<td>
				<?foreach($val['BASKET_ITEMS'] as $item):?>
					<a href="<?=$item['DETAIL_PAGE_URL']?>" class="item"><?=TruncateText($item['NAME'], 35);?></a>
				<?endforeach;?>
			</td>
			<td>
				<?foreach($val['BASKET_ITEMS'] as $item):?>
					<span class="item"><?=CurrencyFormat($item['PRICE'], $item['CURRENCY']);?></span>
				<?endforeach;?>
			</td>
			<td>
				<?foreach($val['BASKET_ITEMS'] as $item):?>
					<span class="item"><?=$item['QUANTITY']?></span>
				<?endforeach;?>
			</td>
			<td><?=CurrencyFormat($val['ORDER']['PRICE'], $val['ORDER']['CURRENCY'])?></td>
			<td>
				<?foreach($val['BASKET_ITEMS'] as $item):?>
					<a id="btnAdd" class="button blue item" href="<?=$item['DETAIL_PAGE_URL']?>?action=ADD2BASKET&id=<?=$item['PRODUCT_ID']?>" rel="nofollow">Заказать</a>
				<?endforeach;?>				
			</td>
		</tr>
		<?endforeach;?>
	</tbody>
</table>

<?if($arResult['NAV_STRING']):?>
<?=$arResult['NAV_STRING']?>
<?endif;?>