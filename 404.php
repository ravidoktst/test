<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->SetTitle("404 Not Found");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Страница не найдена</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?$APPLICATION->ShowHead(false);?>
	
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/main.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="/fav.ico" />

</head>
<body class="page-404">

	<div class="wrap">
		<div class="wrap-wrap">
			<h3>Страница не найдена</h3>
			<p>
				Вы можете перейти на <a href="/">главную страницу</a>
				или воспользоваться поиском
			</p>

			<div class="search-block" style="display:none">
				<form action="/search/" method="get">
					<input id="search-field" type="text" name="q" placeholder="Поиск..."/>
					<input type="submit" value=""/>
				</form>
			</div>

		</div>
	</div>

	<script>
		document.getElementById('search-field').focus();
	</script>

</body>
</html>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>