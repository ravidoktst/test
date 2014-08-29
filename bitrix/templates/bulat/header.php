<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $USER;
if($_GET['out']=='Y'){
  $USER->logout();
   localRedirect('/');
}
?>
<!DOCTYPE html>
<html lang="ru">
	<head>

		<link rel="shortcut icon" type="image/x-icon"  href="/fav.ico" />
		<link rel="icon" href="/fav.ico" type="image/x-icon">
		<meta name="cmsmagazine" content="bd14f40502415cec1d00547f9f873fb0" />
		<?$APPLICATION->ShowHead(false);?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?$APPLICATION->ShowTitle()?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
  		<script>window.jQuery || document.write('<script src="/js/libs/jquery-2.0.3.min.js"><\/script>')</script>

  		<meta property="og:site_name" content="bulat-vorota.ru"/>
		
		<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/libs/jquery-1.11.0.min.js"><\/script>')</script>
	-->

		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/main.min.css');?>
	</head>
	<body ng-app="validationApp" <?echo ($APPLICATION->GetCurPage(false) === '/')? "class='main-page'": ""; ?> >
		<?if(CUser::IsAuthorized()):?>
			<div id="bitrix_panel">
			<?$APPLICATION->ShowPanel();?>
			</div>
		<?endif?>
		<!--[if lt IE 8]><![endif]-->
		<div id="container">
			<header id="header">
				<nav class="top-menu">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "topmenu", Array(
						"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
						"MENU_CACHE_TYPE" => "N",	// Тип кеширования
						"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
						"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
						"MAX_LEVEL" => "1",	// Уровень вложенности меню
						"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
						"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
						"DELAY" => "N",	// Откладывать выполнение шаблона меню
						"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
						),
						false
					);?> 
				</nav>
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
				?>
	  <?
      if($USER->IsAuthorized()):?>
        <a href="/personal/" class="users"><?=TruncateText($USER->GetFullName(),16)?></a>
        <a href="/?out=Y"><img class="exit" src="/img/exit.png">
      <?else:?>
      <span class="vhod">Вход</span>
      <?endif;?>
				<a <?=$cntBasketItems==0 ? '' : 'href="/personal/cart/"'?> class="top-cart nohover">
					<span class="title">Корзина:</span>
					<span class="value"><?=$cntBasketItems?></span>
				</a>
				<a class="logo" href="/"><img src="/img/logo.png" alt=""/></a>
				<div class="phone-block">
					<div class="title">для регионов РФ (бесплатный)</div>
					<div class="value">8 (800) 234-18-55</div>
				</div>
				<div class="phone-block">
					<div class="title">для звонков по Республике Чувашия</div>
					<div class="value">8 (83533) 4-18-55, 8-905-347-50-35</div>
				</div>

				<div class="contacts-block">
					<div class="address">г. Канаш, ул. Свободы, 26 б</div>
					<a href="mailto:buldv@list.ru">buldv@list.ru</a>
					<a class="to-detail" href="/contacts/">Контактная информация</a>
				</div>
				<!-- для раскрытия подсказок добавить класс result-ok -->
				<div class="search-with-suggestion" ng-controller="search">
					<form class="search-block" name="searchForm" ng-init="fl=true">
						<input type="submit" value=""/>
						<input id="search_box" name="q" type="text" ng-keyup="onKeyUp()" ng-minlength="3" ng-model="val" placeholder="Поиск по каталогу..." required autocomplete="off" ng-focus="focus()" ng-blur="blur()" ng-mouseleave="fl = true;" ng-mouseover="fl = false; focus()"/>
					</form>
					<table ng-mouseleave="fl = true; blur();" ng-mouseover="fl = false;">
					</table>
				</div>

				<nav class="main-menu">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "sectionsmenu", Array(
						"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
						"MENU_CACHE_TYPE" => "N",	// Тип кеширования
						"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
						"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
						"MAX_LEVEL" => "1",	// Уровень вложенности меню
						"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
						"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
						"DELAY" => "N",	// Откладывать выполнение шаблона меню
						"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
						),
						false
					);?>
		        </nav>

			</header>
			<div id="content">
			<?if($APPLICATION->GetCurDir() != '/'):?>
					<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb", Array(
						"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
						"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
						"SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
						),
						false
					);?>
			<?endif;?>
			