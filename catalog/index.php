<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Интернет магазин дверей, каталог дверей, купить двери в Чебоксарах по низким ценам");
$APPLICATION->SetPageProperty("description", "Интернет магазин Булат Двери предлагает широкий ассортимент продукции от мировых производителей в Чебоксарах по т 8 (800) 234-18-55");
$filterView = (COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID) == "eshop_adapt_vertical" ? "HORIZONTAL" : "VERTICAL");
?>
<?$APPLICATION->IncludeComponent("bitrix:catalog", "bulat", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "5",
	"HIDE_NOT_AVAILABLE" => "N",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/catalog/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"SET_STATUS_404" => "Y",
	"SET_TITLE" => "Y",
	"ADD_SECTIONS_CHAIN" => "Y",
	"ADD_ELEMENT_CHAIN" => "Y",
	"USE_ELEMENT_COUNTER" => "Y",
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "",
	"FILTER_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"FILTER_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"FILTER_PRICE_CODE" => array(
		0 => "BASE",
	),
	"FILTER_VIEW_MODE" => "HORIZONTAL",
	"USE_REVIEW" => "Y",
	"MESSAGES_PER_PAGE" => "10",
	"USE_CAPTCHA" => "Y",
	"REVIEW_AJAX_POST" => "Y",
	"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
	"FORUM_ID" => "1",
	"URL_TEMPLATES_READ" => "",
	"SHOW_LINK_TO_FORUM" => "Y",
	"POST_FIRST_MESSAGE" => "N",
	"USE_COMPARE" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"CONVERT_CURRENCY" => "Y",
	"CURRENCY_ID" => "RUB",
	"BASKET_URL" => "/personal/cart/",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"USE_PRODUCT_QUANTITY" => "Y",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"ADD_PROPERTIES_TO_BASKET" => "Y",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"PARTIAL_PRODUCT_PROPERTIES" => "N",
	"PRODUCT_PROPERTIES" => array(
	),
	"SHOW_TOP_ELEMENTS" => "N",
	"SECTION_COUNT_ELEMENTS" => "N",
	"SECTION_TOP_DEPTH" => "2",
	"SECTIONS_VIEW_MODE" => "LIST",
	"SECTIONS_SHOW_PARENT_NAME" => "N",
	"PAGE_ELEMENT_COUNT" => "10",
	"LINE_ELEMENT_COUNT" => "1",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"ELEMENT_SORT_FIELD2" => "id",
	"ELEMENT_SORT_ORDER2" => "desc",
	"LIST_PROPERTY_CODE" => array(
		0 => "",
		1 => "NEWPRODUCT",
		2 => "SALELEADER",
		3 => "SPECIALOFFER",
		4 => "",
	),
	"INCLUDE_SUBSECTIONS" => "Y",
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "-",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "",
		1 => "NEWPRODUCT",
		2 => "MANUFACTURER",
		3 => "MATERIAL",
		4 => "",
	),
	"DETAIL_META_KEYWORDS" => "-",
	"DETAIL_META_DESCRIPTION" => "-",
	"DETAIL_BROWSER_TITLE" => "-",
	"DETAIL_DISPLAY_NAME" => "N",
	"DETAIL_DETAIL_PICTURE_MODE" => "IMG",
	"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
	"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
	"LINK_IBLOCK_TYPE" => "",
	"LINK_IBLOCK_ID" => "",
	"LINK_PROPERTY_SID" => "",
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
	"USE_ALSO_BUY" => "N",
	"USE_STORE" => "Y",
	"USE_STORE_PHONE" => "Y",
	"USE_STORE_SCHEDULE" => "Y",
	"USE_MIN_AMOUNT" => "N",
	"STORE_PATH" => "/store/#store_id#",
	"MAIN_TITLE" => "Наличие на складах",
	"PAGER_TEMPLATE" => "bulat",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
	"PAGER_SHOW_ALL" => "N",
	"TEMPLATE_THEME" => "site",
	"ADD_PICT_PROP" => "-",
	"LABEL_PROP" => "-",
	"SHOW_DISCOUNT_PERCENT" => "Y",
	"SHOW_OLD_PRICE" => "Y",
	"DETAIL_SHOW_MAX_QUANTITY" => "N",
	"MESS_BTN_BUY" => "Купить",
	"MESS_BTN_ADD_TO_BASKET" => "В корзину",
	"MESS_BTN_COMPARE" => "Сравнение",
	"MESS_BTN_DETAIL" => "Подробнее",
	"MESS_NOT_AVAILABLE" => "Нет в наличии",
	"DETAIL_USE_VOTE_RATING" => "Y",
	"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
	"DETAIL_USE_COMMENTS" => "Y",
	"DETAIL_BLOG_USE" => "Y",
	"DETAIL_VK_USE" => "N",
	"DETAIL_FB_USE" => "Y",
	"DETAIL_FB_APP_ID" => "",
	"DETAIL_BRAND_USE" => "Y",
	"DETAIL_BRAND_PROP_CODE" => "-",
	"AJAX_OPTION_ADDITIONAL" => "",
	"SEF_URL_TEMPLATES" => array(
		"sections" => "",
		"section" => "#SECTION_CODE_PATH#/",
		"element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		"compare" => "compare/",
	)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>