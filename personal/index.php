<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?>

<div class="personal simple-page">
	<h1 class="title">Личный кабинет</h1>
<?if($USER->IsAuthorized()):?>
<?
	$res=$USER->GetByID($USER->GetID());
	$arUser=$res->GetNext();
	//new dBug($USER->GetLogin());
?>
	<div class="text">
		<ul class="tabs">
			<li <?if(!$_GET['page']):?>class="active"<?endif;?>>Контактные данные</li>
			<li <?if($_GET['page']):?>class="active"<?endif;?> >История заказов</li>
		</ul>
		<div class="panes">
			<div class="pane <?if(!$_GET['page']):?>active<?endif;?> user" ng-controller="updateForm" ng-init="user.name='<?=$arUser['NAME']?>';user.phone='<?=$arUser['PERSONAL_PHONE']?>';user.email='<?=$arUser['EMAIL']?>';user.adres='<?=$arUser['PERSONAL_STREET']?>';fl = false;">
				<form class="auth-reg" action="" name="userForm" ng-submit="submitForm()">
					<label>Имя</label><input type="text" placeholder="Представтесь" ng-model="user.name" required>
					<label>Телефон</label><input type="phone" placeholder="Телефон" input-mask="{mask: '+7(999)999-99-99'}" ng-model="user.phone" value="<?=$arUser['PERSONAL_PHONE']?>">
					<label>E-mail</label><input type="email" placeholder="E-mail" input-mask="{ mask:'a{1,20}@a{1,10}.a{1,5}' ,greedy: false}"  ng-model="user.email" required value="<?=$arUser['EMAIL']?>">
					<label>Пароль</label><input type="password" placeholder="Пароль" ng-model="user.password" required>
					<span class="chenge" ng-click="fl = true;" ng-hide="fl">Сменить пароль</span>
					<input class="passToo" ng-show="fl" type="password" placeholder="Новый пароль" ng-model="user.passwordNew" >
					<label>Адрес</label><textarea placeholder="Адрес" ng-model="user.adres"></textarea>
					<input type="submit" value="Сохранить" class="button blue">
				</form>
			</div>
			<div class="pane <?if($_GET['page']):?>active<?endif;?>">

				<?
					if (isset($_GET['page']) && intval($_GET['page'])>0) {
					     $GLOBALS['PAGEN_1'] = $_REQUEST['PAGEN_1'] = $_GET['PAGEN_1'] = $_GET['page'];
					    unset($_GET['page'], $_REQUEST['page'], $GLOBALS['page']); 
					}
				?>
				<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order.list", "bulat", array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600",
					"CACHE_GROUPS" => "Y",
					"PATH_TO_DETAIL" => "order_detail.php?ID=#ID#",
					"PATH_TO_COPY" => "basket.php",
					"PATH_TO_CANCEL" => "order_cancel.php?ID=#ID#",
					"PATH_TO_BASKET" => "/personal/cart/",
					"ORDERS_PER_PAGE" => "20",
					"SET_TITLE" => "Y",
					"SAVE_IN_SESSION" => "Y",
					"NAV_TEMPLATE" => "bulat",
					"HISTORIC_STATUSES" => array(
						0 => "F",
					),
					"ID" => $ID
					),
					false
				);?>
			</div>		
		</div>
	</div>
<?else:?>
	<p>Вы не авторизованны на сайте.</p>
<?endif;?>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>