<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контактная информация");
echo ' <div class="contacts simple-page"><h1 class="title">'; $APPLICATION->ShowTitle(false); echo '</h1>';?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => ""
	)
);

$res =CIBlockElement::GetList($arOrder=array('SORT'=>'ASC'), $arFilter=array('IBLOCK_ID'=>11,'ID'=>345), $arGroupBy=false, $arNavStartParams=false, $arSelectFields=array('PROPERTY_MAP'));
$item = $res->GetNext();
$coord = explode(',',$item['PROPERTY_MAP_VALUE']);
?>
<div class="feedback-form vertical" ng-controller="feedbackForm">
	<h3 class="form-title">Напишите нам</h3>
	<form action="" name="userForm" ng-submit="submitForm()">
		<input type="text" placeholder="Представьтесь" ng-model="user.name" required/>
		<input type="email" name="email" placeholder="E-mail" input-mask="{ mask:'a{1,20}@a{1,10}.a{1,5}' ,greedy: false}" ng-model="user.email" required/>
		<input type="text" ng-model="user.phone" input-mask="{mask: '+7(999)999-99-99'}" name="phone" placeholder="Телефон" />
		<textarea placeholder="Сообщение" ng-model="user.message" required></textarea>
		<input class="button blue" type="submit" value="Отправить"/>
	</form>
</div>

<hr/>

<h3 class="sub-title">Как нас найти:</h3>

<div class="map-wrapper">
	<div id="map" class="map" data-x="<?=$coord[0]?>" data-y="<?=$coord[1]?>"></div>
</div>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"> </script>
<?
echo '</div>';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>