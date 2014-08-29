<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Компания Булат Двери предлагает широкий ассортимент товаров по телефону 8 (800) 234-18-55 г.Чебоксары");
$APPLICATION->SetPageProperty("description", "Интернет магазин Булат Двери предлагает широкий ассортимент дверей, гаражных ворот от мировых производителей в Чебоксарах по т 8 (800) 234-18-55");
$APPLICATION->SetTitle("Булат Двери");?>
<div id="content">
<?$res=CIBlockElement::GetList(array('SORT'=>'ASC'), array('IBLOCK_ID'=>4,'ACTIVE'=>'Y'), false, false, array('*','PROPERTY_LINK_TO_ELEMENT'));
?>
		<div class="main-slider">
			<ul>
				<?while($item=$res->GetNext()):?>
				<li>
					<img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt=""/>
					<?if($item['PROPERTY_LINK_TO_ELEMENT_VALUE']):?>
						<?$elemRes = CIBlockElement::GetByID($item['PROPERTY_LINK_TO_ELEMENT_VALUE']);
						  $elem = $elemRes->GetNext();	
						?>
						<a class="to-detail" href="<?=$elem['DETAIL_PAGE_URL']?>">читать подробно ></a>
					<?endif;?>
				</li>
				<?endwhile;?>
			</ul>
			<div id="main-slider-pager"></div>
		</div>

		<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.smart.filter",
				"bulat",
				Array(
					"IBLOCK_TYPE" => 'catalog',
					"IBLOCK_ID" => 5,
					"SECTION_ID" => 16,
					"FILTER_NAME" => 'arrFilter',
					"PRICE_CODE" => array("BASE"),
					"CACHE_TYPE" => 'A',
					"CACHE_TIME" => 36000000,
					"CACHE_GROUPS" => 'Y',
					"SAVE_IN_SESSION" => "N",
					"XML_EXPORT" => "Y",
					"SECTION_TITLE" => "NAME",
					"SECTION_DESCRIPTION" => "DESCRIPTION",
					'HIDE_NOT_AVAILABLE' => 'N',
					"TEMPLATE_THEME" => 'site'
				),
				$component,
				array('HIDE_ICONS' => 'Y')
		);?>

		<nav class="sections-list">
		   <ul>
		   	<?$res=CIBlockSection::GetList(array('SORT'=>'ASC'), array('IBLOCK_ID'=>5,'ACTIVE'=>'Y', '!UF_PICTURE'=>NULL), false, array('UF_PICTURE'), false);
		   	while($item=$res->GetNext()):
			?>
			   <li><a href="<?=$item['SECTION_PAGE_URL']?>">
				   <div class="image"><img src="<?=CFIle::GetPath($item['UF_PICTURE'])?>" alt="<?=$item['NAME']?>"/></div>
				   <span><?=$item['NAME']?></span>
			   </a></li>
			<?endwhile;?>
		   </ul>
		</nav>

<?$APPLICATION->IncludeComponent("bitrix:news.list", "bulat", array(
	"IBLOCK_TYPE" => "news",
	"IBLOCK_ID" => "7",
	"NEWS_COUNT" => "2",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "200",
	"ACTIVE_DATE_FORMAT" => "j M Y",
	"SET_STATUS_404" => "N",
	"SET_TITLE" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
	"ADD_SECTIONS_CHAIN" => "Y",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"INCLUDE_SUBSECTIONS" => "Y",
	"PAGER_TEMPLATE" => "bulat",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

		<div class="hits">
			<h2 class="title">Хиты продаж</h2>
<?$APPLICATION->IncludeComponent("bitrix:catalog.top", "bulat", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "5",
	"ELEMENT_SORT_FIELD" => "RAND",
	"ELEMENT_SORT_ORDER" => "desc",
	"ELEMENT_SORT_FIELD2" => "",
	"ELEMENT_SORT_ORDER2" => "",
	"FILTER_NAME" => "",
	"HIDE_NOT_AVAILABLE" => "N",
	"ELEMENT_COUNT" => "4",
	"LINE_ELEMENT_COUNT" => "4",
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"OFFERS_LIMIT" => "4",
	"VIEW_MODE" => "SECTION",
	"TEMPLATE_THEME" => "",
	"ADD_PICT_PROP" => "-",
	"LABEL_PROP" => "-",
	"SHOW_DISCOUNT_PERCENT" => "N",
	"SHOW_OLD_PRICE" => "N",
	"MESS_BTN_BUY" => "В корзину",
	"MESS_BTN_ADD_TO_BASKET" => "В корзину",
	"MESS_BTN_DETAIL" => "Подробнее",
	"MESS_NOT_AVAILABLE" => "Нет в наличии",
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"DISPLAY_COMPARE" => "N",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"CONVERT_CURRENCY" => "N",
	"BASKET_URL" => "/personal/cart/",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"USE_PRODUCT_QUANTITY" => "N",
	"ADD_PROPERTIES_TO_BASKET" => "Y",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"PARTIAL_PRODUCT_PROPERTIES" => "N",
	"PRODUCT_PROPERTIES" => array(
	),
	"PRODUCT_QUANTITY_VARIABLE" => "quantity"
	),
	false
);?>
		</div>

	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>