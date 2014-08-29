<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<?if($_GET['ORDER_ID']):?>

<div class="cart simple-page">
	<h1 class="title">Корзина</h1>

	<div class="spasibo">
		<h3>Спасибо!</h3>
		<div class="text">
			Ваш заказ отправлен.<br>
			№ заказа <strong><?=$_GET['ORDER_ID']?></strong><br>
			Наши менеджеры свяжутся с Вами в ближайшее время.<br>
		</div>
		
		<a href="../../" class="button blue">Перейти на главную</a>
	</div>
</div>


<?else:?>
<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "bulat", array(
	"COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "PROPS",
		2 => "DELETE",
		3 => "PRICE",
		4 => "QUANTITY",
		5 => "SUM",
	),
	"PATH_TO_ORDER" => "/personal/cart/",
	"HIDE_COUPON" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "Y",
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
	"USE_PREPAYMENT" => "N",
	"QUANTITY_FLOAT" => "N",
	"SET_TITLE" => "Y",
	"ACTION_VARIABLE" => "action"
	),
	false
);?>
<?CModule::IncludeModule("sale");
$cntBasketItems = CSaleBasket::GetList(
	array(),
	array( 
	"FUSER_ID" => CSaleBasket::GetBasketUserID(),
	"LID" => SITE_ID,
	"ORDER_ID" => "NULL"
	), 
	array()
);
if($cntBasketItems){
$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "bulat", array(
	"PAY_FROM_ACCOUNT" => "Y",
	"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
	"COUNT_DELIVERY_TAX" => "N",
	"ALLOW_AUTO_REGISTER" => "Y",
	"SEND_NEW_USER_NOTIFY" => "Y",
	"DELIVERY_NO_AJAX" => "N",
	"DELIVERY_NO_SESSION" => "N",
	"TEMPLATE_LOCATION" => "popup",
	"DELIVERY_TO_PAYSYSTEM" => "d2p",
	"USE_PREPAYMENT" => "N",
	"PROP_1" => array(
		0 => "4",
		1 => "5",
	),
	"ALLOW_NEW_PROFILE" => "Y",
	"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
	"SHOW_STORES_IMAGES" => "N",
	"PATH_TO_BASKET" => "/personal/cart/",
	"PATH_TO_PERSONAL" => "/personal/order/",
	"PATH_TO_PAYMENT" => "/personal/cart/payment/",
	"PATH_TO_AUTH" => "/auth/",
	"SET_TITLE" => "Y",
	"PRODUCT_COLUMNS" => array(
	),
	"DISABLE_BASKET_REDIRECT" => "N"
	),
	false
);
}
?>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>