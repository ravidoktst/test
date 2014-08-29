<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams, $arResult
 * @var CBitrixComponentTemplate $this
 * @var CMain $APPLICATION
 * @var CUser $USER
 */
?><? if ($arParams['SHOW_MINIMIZED'] == "Y")
{
	?>
	<div class="reviews-collapse reviews-minimized" style='position:relative; float:none;'>
		<a class="reviews-collapse-link" id="sw<?=$arParams["FORM_ID"]?>" onclick="window.UC.f<?=$arParams["FORM_ID"]?>.transverse()" href="javascript:void(0);"><?=$arParams['MINIMIZED_EXPAND_TEXT']?></a>
	</div>
	<?
}
?>

<?
	$res=$USER->GetByID($USER->GetID());
	$arUser=$res->GetNext();
?>

<div class="feedback-form horizontal" ng-controller="reviewForm" ng-init="user.name='<?=$arUser['NAME']?>';user.email='<?=$arUser['EMAIL']?>'; user.title='<?=$arResult['ELEMENT']['PRODUCT']['NAME']?>'; user.id='<?=$arResult['ELEMENT']['PRODUCT']['ID']?>';" >
    <h3 class="form-title">Оставить отзыв</h3>
    <form action="" ng-submit="submitForm()" name="userForm">
    	<input type="hidden" ng-model="user.title" required />
        <input type="hidden" ng-model="user.id" required />
        <input type="text" placeholder="Представьтесь" ng-model="user.name" required>
        <input type="email" placeholder="E-mail" ng-model="user.email" required >
        <textarea placeholder="Вопрос" ng-model="user.text" required=""></textarea>
        <input class="button blue" type="submit" value="Отправить">
    </form>
</div>
