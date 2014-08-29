<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
echo '<div class="about simple-page">
			<h1 class="title">';echo $APPLICATION->ShowTitle(false); echo'</h1>';
?>
<div class="image"><img src="/img/about-1.jpg" alt=""/></div>
<div class="image"><img src="/img/about-2.jpg" alt=""/></div>

<div class="text">

	<p>Вот уже более 10 лет команда профессионалов нашей компании делает жизнь своих заказчиков удобной и эстетичной.</p>
	<p>Накопленный за этот период опыт позволяет нам полностью удовлетворять запросы клиентов в подвижных ограждающих конструкциях и предлагать только качественную продукцию, адаптированную к эксплуатации в условиях российского климата.</p>
	<p>На рынке автоматических ворот и шлагбаумов действует огромное количество поставщиков – мы сотрудничаем только с надежными и проверенными. Вся продукция Hormann, Faac, Nice, Doorhan, Came, BFT, представленная на сайте, прошла необходимые испытания и обладает соответствующими сертификатами.</p>
	<p>Нам доверяют деловые партнеры, клиенты, сотрудники. С нами считаются на рынке, нас рекомендуют, и это – закономерный итог динамичного развития компании в условиях жесткой конкуренции.</p>

	<blockquote>Время – деньги! И мы считаем свои долгом экономить для своих клиентов оба этих ценнейших ресурса.</blockquote>

	<p>В каком регионе России вы бы ни находились, вы можете заказать у нас ворота, шлагбаумы, рольставни и комплектующие с доставкой и оплатить заказ удобным для вас способом.</p>
	<p>За годы рыночной деятельности компания «Ворота Города» доказала свою способность исполнять заказы в кратчайшие сроки и с неизменно высоким качеством.</p>

</div>
<?
echo '<div class="sertificates"><h3 class="title">Сертификаты</h3>';
CModule::IncludeModule("iblock");
$arFilter = Array("IBLOCK_ID"=>6, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y"); 
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array()); 
if(!empty($res)){
	echo '<ul class="bxslider">';
	while($ob = $res->GetNextElement())
	{
		$arItem = $ob->GetFields();
		echo '<li><a rel="fancybox" href="'.CFile::GetPath($arItem["PREVIEW_PICTURE"]).'"><img src="'.CFile::GetPath($arItem["PREVIEW_PICTURE"]).'" alt=""/></a></li>';
	}
	echo '</ul>';
}
echo '</div>';
echo '</div>';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>