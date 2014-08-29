<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams, $arResult
 * @var CBitrixComponentTemplate $this
 * @var CMain $APPLICATION
 * @var CUser $USER
 */
CUtil::InitJSCore(array('ajax', 'fx'));
// ************************* Input params***************************************************************
$arParams["SHOW_LINK_TO_FORUM"] = ($arParams["SHOW_LINK_TO_FORUM"] == "N" ? "N" : "Y");
$arParams["FILES_COUNT"] = intVal(intVal($arParams["FILES_COUNT"]) > 0 ? $arParams["FILES_COUNT"] : 1);
$arParams["IMAGE_SIZE"] = (intVal($arParams["IMAGE_SIZE"]) > 0 ? $arParams["IMAGE_SIZE"] : 100);
if (LANGUAGE_ID == 'ru'):
	$path = str_replace(array("\\", "//"), "/", dirname(__FILE__)."/ru/script.php");
	include($path);
endif;
// *************************/Input params***************************************************************
if (!empty($arResult["MESSAGES"])):
if ($arResult["NAV_RESULT"] && $arResult["NAV_RESULT"]->NavPageCount > 1):
?>
<div class="reviews-navigation-box reviews-navigation-top">
	<div class="reviews-page-navigation">
		<?=$arResult["NAV_STRING"]?>
	</div>
	<div class="reviews-clear-float"></div>
</div>
<?
endif;
?>



<ul class="reviews">
<?
foreach ($arResult["MESSAGES"] as $res):
	//new dBug($res);
?>

	<li>
		<div class="info"><?=$res['AUTHOR_NAME']?> / <?=$res['POST_DATE']?></div>
		<div class="text"><?=$res['POST_MESSAGE_TEXT']?></div>
	</li>
	

<?endforeach;?>
</ul>

<?
endif;
?>


<script type="application/javascript">
	BX.message({
		no_topic_name : '<?=GetMessageJS("JERROR_NO_TOPIC_NAME")?>',
		no_message : '<?=GetMessageJS("JERROR_NO_MESSAGE")?>',
		max_len : '<?=GetMessageJS("JERROR_MAX_LEN")?>',
		f_author : ' <?=GetMessageJS("JQOUTE_AUTHOR_WRITES")?>:\n',
		f_cdm : '<?=GetMessageJS("F_DELETE_CONFIRM")?>',
		f_show : '<?=GetMessageJS("F_SHOW")?>',
		f_hide : '<?=GetMessageJS("F_HIDE")?>',
		f_wait : '<?=GetMessageJS("F_WAIT")?>',
		MINIMIZED_EXPAND_TEXT : '<?=CUtil::addslashes($arParams["MINIMIZED_EXPAND_TEXT"])?>',
		MINIMIZED_MINIMIZE_TEXT : '<?=CUtil::addslashes($arParams["MINIMIZED_MINIMIZE_TEXT"])?>'
	});
</script>
<?
include(__DIR__."/form.php");
?>